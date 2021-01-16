<?php

namespace App\Jobs;

use App\Models\Wenku8;
use App\Traits\PuPHPeteer;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class CrawlerWenku8Catalog implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    use PuPHPeteer;

    protected $uuids;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(array $uuids)
    {
        $this->uuids = $uuids;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //
        $wenku8s = Wenku8::whereIn('id', $this->uuids)->get();
        $items   = $wenku8s->mapWithKeys(function ($item) {
            return [
                $item->id => [
                    'id'  => $item->id,
                    'url' => $item->url_catalog,
                ]
            ];
        })->all();
        $items = $this->scrapes($items);

        foreach ($items as $item) {
            $filePath = 'novels/'.$item['id'].'/catalog.html';
            Storage::disk('wenku8')->put($filePath, $item['html']);
        }
    }
}
