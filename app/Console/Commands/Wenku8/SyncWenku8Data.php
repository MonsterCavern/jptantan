<?php

namespace App\Console\Commands\Wenku8;

use App\Models\Wenku8;
use App\Jobs\CrawlerWenku8Data;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class SyncWenku8Data extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'wenku8:sync {--id=*}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '同步網站 wenku8 的資料';

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
        if (Wenku8::count() === 0 && Storage::disk('wenku8')->exists('index.json')) {
            $wenku8Index     = Storage::disk('wenku8')->get('index.json');
            $wenku8IndexData = json_decode($wenku8Index, true);
            ksort($wenku8IndexData['data']);
            // 暫存檔塞進資料庫
            $data = $wenku8IndexData['data'];
            $max  = max(array_keys($data));
            for ($uuid = 1; $uuid <= $max; $uuid++) {
                $this->info('UUID:'.$uuid.' update');
                $attributes = $data[$uuid] ?? null;
                if (! $attributes) {
                    $attributes = [
                        'title'      => '無',
                        'author'     => '無',
                        'url'        => '無',
                        'publishing' => '無',
                        'status'     => '紀錄遺失'
                    ];
                }
                Wenku8::updateOrCreate(['id' => $uuid], $attributes);
            }
            //
            $json = json_encode($wenku8IndexData, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);
            Storage::disk('wenku8')->put('index.json', $json);
        }

        //
        $ids  = $this->option('id');
        $max  = Wenku8::max('id') + 5;
        if ($ids) {
            CrawlerWenku8Data::dispatch($ids)->onConnection('database')->onQueue('wenku8');
        } else {
            $index = [];
            for ($i = 1; $i <= $max; $i++) {
                $this->info('UUID:'.$i.' Start');
                $wenku8 = Wenku8::where('status', '=', '連載中')
                    ->where('lasted_at', '<', \Carbon\Carbon::now()->copy()->firstOfMonth())
                    ->find($i);

                if (! $wenku8) {
                    $this->info('UUID:'.$i.' Join Job');
                    $index[] = $i;
                }

                if (count($index) % 10 === 0) {
                    CrawlerWenku8Data::dispatch($index)->onConnection('database')->onQueue('wenku8');
                    $index = [];
                }
            }
            //
            if (count($index) > 0) {
                CrawlerWenku8Data::dispatch($index)->onConnection('database')->onQueue('wenku8');
            }
        }
    }
}
