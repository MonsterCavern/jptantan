<?php

namespace App\Jobs;

use DiDom\Document;
use App\Models\Wenku8;
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
        $htmls = $this->scrape($this->uuids);
        //
        foreach ($htmls as $id => $html) {
            $attributes = [];
            $document   = new Document($html);
            Storage::disk('wenku8')->put($id.'/index.html', $html);

            $span = $document->find('span.hottext');
            if ($span) {
                foreach ($span as $content) {
                    if ('內容簡介︰' === $content->text()) {
                        $attributes['summary'] = $content->nextSibling('span')->text();
                    }
                }
            }

            //
            $table = $document->first('table');
            if ($table) {
                //
                foreach ($table->find('td') as $td) {
                    $info = explode('︰', $td->text());
                    if ($info[0] === '文庫分類') {
                        $attributes['publishing'] = $info[1];
                    }
                    if ($info[0] === '小說作者') {
                        $attributes['author'] = $info[1];
                    }
                    if ($info[0] === '文章狀態') {
                        $attributes['status'] = $info[1];
                    }
                    if ($info[0] === '最後更新') {
                        $attributes['lasted_at'] = $info[1];
                    }
                }
                // 封面
                $table = $table->nextSibling('table');
                if ($table) {
                    $image                 = $table->first('img');
                    $attributes['url_img'] = ($image ? $image->attr('src') : null);
                }
            }
            //
            $title = $document->first('title');
            if ($title->text() === '出現錯誤') {
                $attributes['status'] = '紀錄遺失';
            } else {
                $info                = explode('-', $title->text());
                $attributes['title'] = trim($info[0]);
            }
            //

            Wenku8::updateOrCreate(['id' => $id], array_merge([
                'id'         => $id,
                'url'        => "https://www.wenku8.net/modules/article/articleinfo.php?id={$id}&charset=big5",
                'title'      => '無',
                'author'     => '無',
                'publishing' => '無',
                'lasted_at'  => date('Y-m-d H:i:s')
            ], $attributes));
        }

        return true;
    }

    private function scrape(array $ids)
    {
        $puppeteer = new Puppeteer; // 新建 Puppeteer 例項
        $browser   = $puppeteer->launch(); // 啟動無頭瀏覽器
        $page      = $browser->newPage(); // 開啟新的標籤頁
        $htmls     = [];

        foreach ($ids as $id) {
            // if (Storage::disk('wenku8')->exists($id.'/index.html')) {
            //     $content = Storage::disk('wenku8')->get($id.'/index.html');
            // } else {
            $url = "https://www.wenku8.net/modules/article/articleinfo.php?id={$id}&charset=big5";
            try {
                $page->tryCatch->goto($url); // 訪問頁面
                $content =  $page->content();
            } catch (\Exception $error) {
                // throw new $error;
                $content = null;
            }
            // }
            $htmls[$id] = $content;
        }
        $browser->close();

        return $htmls; // 返回 js 渲染後的頁面
    }
}
