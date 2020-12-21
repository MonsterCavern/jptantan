<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Nesk\Puphpeteer\Puppeteer;
use DiDom\Document;

class CrawlerWenku8Data implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $url;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($url)
    {
        $this->url = $url;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $html     = $this->scrape($this->url);
        $document = new Document($html);
        $title    = $document->first('title');
        dd($title->text());
    }

    public function scrape(String $url)
    {
        $puppeteer = new Puppeteer; // 新建 Puppeteer 例項
        $browser   = $puppeteer->launch(); // 啟動無頭瀏覽器
        $page      = $browser->newPage(); // 開啟新的標籤頁
        try {
            $page->tryCatch->goto($url); // 訪問頁面
            $html = $page->content();
            $browser->close();
        } catch (\Exception $error) {
            throw new $error;
        }

        return $html; // 返回 js 渲染後的頁面
    }
}
