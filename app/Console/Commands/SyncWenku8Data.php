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
    protected $signature = 'wenku8:sync {--id=} {--max=}';

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
        $options = $this->options();
        if (! $options['id'] && ! $options['max']) {
            $this->error('需要設定選項!');
            exit;
        }
        // $max     = 2861;
        $max  = $this->option('max');
        $uuid = $this->option('id');

        if ($max && $max > 0) {
            for ($i = 1; $i <= $max; $i++) {
                $this->info('UUID: '.$i.' Join Job');
                CrawlerWenku8Data::dispatch($i)->onConnection('database')->onQueue('wenku8');
            }
        }

        if ($uuid && $uuid > 0) {
            $this->info('UUID: '.$uuid.' Join Job');
            CrawlerWenku8Data::dispatch($uuid)->onConnection('database')->onQueue('wenku8');
        }
    }
}
