<?php

namespace App\Jobs;

use App\Traits\PuPHPeteer;
use App\Models\Wenku8Chapter;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class CrawlerWenku8Article implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    use PuPHPeteer;

    protected $chapter;
    protected $url;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Wenku8Chapter $chapter, $url)
    {
        //
        $this->chapter = $chapter;
        $this->url     = $url;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //
        $chapter = $this->chapter;
        $url     = $this->url;

        $wenku8Id = $chapter->wenku8_id;
        $sequence = $chapter->sequence;
        $fileName = pathinfo($chapter->url)['filename'];
        $filePath = 'novels/'.$wenku8Id.'/'.$sequence.'/'.$fileName.'.html';

        $html = $this->scrape($url);
        Storage::disk('wenku8')->put($filePath, $html);
    }
}
