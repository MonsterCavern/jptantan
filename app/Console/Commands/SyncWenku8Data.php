<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Jobs\CrawlerWenku8Data;

class SyncWenku8Data extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'wenku8:sync';

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
        $baseUrl = 'https://www.wenku8.net/book/';
        // $max     = 2860;
        $max     = 1;

        for ($i = 1; $i <= $max; $i++) {
            $url = $baseUrl.$i.'.htm';
            CrawlerWenku8Data::dispatch($url)
                ->onConnection('sync')
                ->onQueue('wenku8');
        }
    }
}
