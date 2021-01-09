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
            Storage::disk('wenku8')->put('novels/'.$id.'/index.html', $html);

            $span = $document->find('span.hottext');
            if ($span) {
                foreach ($span as $content) {
                    if ('内容简介：' === $content->text()) {
                        $attributes['summary'] = $content->nextSibling('span')->text();
                    }
                }
            }

            //
            $table = $document->first('table');
            if ($table) {
                // 編碼為 gbk
                foreach ($table->find('td') as $td) {
                    $info = explode('：', $td->text());
                    if ($info[0] === '文库分类') {
                        $attributes['publishing'] = $info[1];
                    }
                    if ($info[0] === '小说作者') {
                        $attributes['author'] = $info[1];
                    }
                    if ($info[0] === '文章状态') {
                        $attributes['status'] = $info[1];
                    }
                    if ($info[0] === '最后更新') {
                        $attributes['lasted_at'] = $info[1];
                    }
                    if ($info[0] === '全文长度') {
                        $attributes['word_length'] = preg_replace('/\D/', '', $info[1]);
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
            $catalog = $document->find('a[href^=https://www.wenku8.net/novel]');
            if ($catalog) {
                foreach ($catalog as $element) {
                    if ($element->text() === '小说目录') {
                        $attributes['url_catalog'] = $element->attr('href');
                        break;
                    }
                }
            }

            //
            $title = $document->first('title');
            if (empty($title) || $title->text() === '出现错误') {
                $attributes['status'] = '紀錄遺失';
            } else {
                $info                = explode('-', $title->text());
                $attributes['title'] = trim($info[0]);
            }

            // 轉繁體
            foreach ($attributes as $key => $attribute) {
                $attributes[$key] = opencc($attribute);
            }

            //
            $wenku8 = Wenku8::firstOrCreate(['id' => $id], array_merge([
                'id'         => $id,
                'url'        => "https://www.wenku8.net/modules/article/articleinfo.php?id={$id}",
                'title'      => '無',
                'author'     => '無',
                'publishing' => '無',
                'lasted_at'  => date('Y-m-d H:i:s')
            ], $attributes));

            if ($wenku8->title === '無') {
                $wenku8->fill($attributes)->save();
            }
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
            $content = null;
            if (Storage::disk('wenku8')->exists('novels/'.$id.'/index.html')) {
                $content = Storage::disk('wenku8')->get('novels/'.$id.'/index.html');
            }

            if (! $content) {
                $url = "https://www.wenku8.net/modules/article/articleinfo.php?id={$id}&charset=gbk";
                try {
                    $page->tryCatch->goto($url); // 訪問頁面
                    $content =  $page->content();
                } catch (\Exception $error) {
                    // throw new $error;
                    $content = null;
                }
            }
            $htmls[$id] = $content;
        }
        $browser->close();

        return $htmls; // 返回 js 渲染後的頁面
    }
}
