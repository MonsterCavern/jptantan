<?php

namespace App\Console\Commands\Wenku8;

use Illuminate\Support\Facades\Storage;
use Illuminate\Console\Command;
use App\Models\Wenku8;
use App\Jobs\CrawlerWenku8Catalog;

class SyncWenku8Catalog extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'wenku8:sync-catalog {--id=*}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '同步 wenku8 章節目錄';

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
        $ids = $this->option('id');
        if (empty($ids)) {
            $wenku8s = Wenku8::whereNotNull('url_catalog')
                // ->take(1)
                ->get();

            foreach ($wenku8s as $wenku8) {
                $id       = $wenku8->id;
                $filePath = 'novels/'.$id.'/catalog.html';
                if (Storage::disk('wenku8')->exists($filePath)) {
                    $content = Storage::disk('wenku8')->get($filePath);
                    if ($content) {
                        continue;
                    }
                }
                //
                $this->info('UUID: '.$id.' Join to Job');
                $ids[] = $id;
            }
        }

        $chunks = array_chunk($ids, 1);
        foreach ($chunks as $chunk) {
            CrawlerWenku8Catalog::dispatch($chunk)->onConnection('database')->onQueue('wenku8-catalog');
        }
    }
}
