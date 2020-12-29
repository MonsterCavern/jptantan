<?php

namespace App\Jobs;

use App\Models\Wenku8;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class CrawlerWenku8Cover implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $id;

    protected $path;

    protected $disk;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($id, $path, $disk)
    {
        //
        $this->id   = $id;
        $this->path = $path;
        $this->disk = $disk;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $wenku8 = Wenku8::find($this->id);
        //Get the file
        try {
            $content = file_get_contents($wenku8->url_img);
            $result  = Storage::disk($this->disk)->put($this->path, $content);
            if ($result) {
                $file = Storage::disk($this->disk)->get($this->path);
            }
        } catch (\Throwable $th) {
            throw $th;
        }
        //
        // dd($file);
    }
}
