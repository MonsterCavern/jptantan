<?php

namespace App\Console\Commands\Wenku8;

use App\Models\Wenku8;
use Illuminate\Console\Command;
use App\Jobs\CrawlerWenku8Cover;

class SaveCoverImage extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'wenku8:save-cover-image {--id=*}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '保存 wenku8 資料的封面';

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

        $wenku8 = Wenku8::whereNotNull('url_img')->whereNull('cover_id');
        if ($ids) {
            $wenku8 = $wenku8->whereIn('id', $ids);
        }
        $wenku8 = $wenku8->get();

        foreach ($wenku8 as $data) {
            $this->info('UUID:'.$data->id.' Join Cover Download Job');
            $path = pathinfo($data->url_img);

            CrawlerWenku8Cover::dispatch($data->id, $data->id.'/cover.'.$path['extension'], 'wenku8')
                ->onConnection('database')
                ->onQueue('wenku8');
        }
    }
}
