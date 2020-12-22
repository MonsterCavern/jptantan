<?php

namespace App\Jobs;

use DiDom\Document;
use Illuminate\Bus\Queueable;
use Nesk\Puphpeteer\Puppeteer;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class CrawlerWenku8Data implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $url;

    protected $uuid;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($uuid)
    {
        // $baseUrl    = "https://www.wenku8.net/book/";
        $baseUrl    = 'https://www.wenku8.net/modules/article/articleinfo.php';
        $this->url  = $baseUrl."?id={$uuid}&charset=big5";
        $this->uuid = $uuid;
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
        $info     = explode('-', $title->text());

        $result = $this->updateIndex($this->uuid, [
            'url'        => $this->url,
            'title'      => trim($info[0]),
            'author'     => trim($info[1]),
            'publishing' => trim($info[2]),
            'updated_at' => date('Y-m-d H:i:s')
        ]);

        return $result;
    }

    private function scrape(String $url)
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

    private function updateIndex($index, $data)
    {
        //
        $wenku8Index     = Storage::disk('wenku8')->get('index.json');
        $wenku8IndexData = json_decode($wenku8Index, true);

        $wenku8IndexData['data'][$index] = $data;
        $wenku8IndexData['length']       = count($wenku8IndexData['data']);

        $json   = json_encode($wenku8IndexData, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);
        $result = Storage::disk('wenku8')->put('index.json', $json);

        return $result;
    }
}
