<?php

namespace App\Console\Commands\Wenku8;

use DiDom\Document;
use App\Models\Wenku8Chapter;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class SaveWenku8Chapter extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'wenku8:save-chapter-form-file';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '從爬取回來的檔案新增 wenku8 章節';

    private $lostDataId = [];

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        //
        $catalogs = collect();
        $files    = Storage::disk('wenku8')->directories('novels');
        usort($files, function ($a, $b) {
            $aid = pathinfo($a)['basename'];
            $bid = pathinfo($b)['basename'];

            return $aid - $bid;
        });
        //

        foreach ($files as $path) {
            $id   = pathinfo($path)['basename'];
            $path = $path.'/catalog.html';
            if (Storage::disk('wenku8')->exists($path)) {
                $this->info('UUID:'.$id.' start');
                $html    = Storage::disk('wenku8')->get($path);
                $catalog = $this->parseCatalogHtml($html, $id);
                if (count($catalog) > 0) {
                    $catalogs->put($id, $catalog);
                }
            }
        }

        if (Wenku8Chapter::count() === 0) {
            $chunks = $catalogs->collapse()->chunk(1000);
            foreach ($chunks as $group =>  $chunk) {
                $this->info('Group: '.$group.' start');
                \DB::table('wenku8_chapters')->insert($chunk->toArray());
            }
        } else {
            foreach ($catalogs as $id => $chunk) {
                $this->info('UUID:'.$id.' save');
                foreach ($chunk as $catalog) {
                    $wenku8Chapter = Wenku8Chapter::where('url', $catalog['url'])->count();
                    if ($wenku8Chapter > 0) {
                        Wenku8Chapter::create($catalog);
                    }
                }
            }
        }
    }

    public function parseCatalogHtml($html, $id)
    {
        try {
            $catalogs = [];
            $document = new Document($html);
            if (empty($document)) {
                throw new \Exception('Content is empty');
            }

            $table    = $document->first('table');
            if ($table) {
                $sequence = 0;
                foreach ($table->find('tr') as $tr) {
                    //
                    $tds = $tr->find('td');
                    // 是 episode
                    if (count($tds) == 1) {
                        $episode  = $tr->first('td')->text();
                        $sequence = $sequence + 1;
                    }

                    // 是章節
                    if (count($tds) > 1) {
                        foreach ($tds as $td) {
                            if ($td->has('a')) {
                                $catalogs[] = [
                                    'wenku8_id' => $id,
                                    'url'       => $td->first('a')->attr('href'),
                                    'title'     => $td->text(),
                                    'episode'   => $episode,
                                    'sequence'  => $sequence
                                ];
                            }
                        }
                    }
                }
            }
        } catch (\Throwable $th) {
            $this->lostDataId[] = $id;
        }

        return $catalogs;
    }
}
