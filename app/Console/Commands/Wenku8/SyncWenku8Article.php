<?php

namespace App\Console\Commands\Wenku8;

use App\Models\Wenku8;
use Illuminate\Console\Command;
use App\Jobs\CrawlerWenku8Article;

class SyncWenku8Article extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'wenku8:sync-article {--id=*}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '同步 wenku8 文章資料';

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
        $wenku8s = Wenku8::take(10)->get();
        foreach ($wenku8s as $wenku8) {
            $baseUrl  = pathinfo($wenku8->url_catalog)['dirname'];
            $chapters = $wenku8->chapters;
            foreach ($chapters as $chapter) {
                $url = $baseUrl.'/'.$chapter->url;
                CrawlerWenku8Article::dispatch($chapter, $url)->onConnection('database')->onQueue('wenku8-article');
            }
        }
    }
}
