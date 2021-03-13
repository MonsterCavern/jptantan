<?php

namespace App\Traits;

use Nesk\Puphpeteer\Puppeteer;

trait PuPHPeteer
{
    protected $userOptions = [
        'stop_timeout' => 1
    ];

    public function scrape($url)
    {
        $content   = null;
        //
        $puppeteer = new Puppeteer($this->userOptions); // 新建 Puppeteer 例項
        $browser   = $puppeteer->launch(); // 啟動無頭瀏覽器
        $page      = $browser->newPage(); // 開啟新的標籤頁

        try {
            $page->tryCatch->goto($url); // 訪問頁面
            $content = $page->content();
        } catch (\Exception $error) {
            $content = null;
        }

        $browser->close();

        return $content; // 返回 js 渲染後的頁面s
    }

    public function scrapes(array $items)
    {
        $puppeteer = new Puppeteer([
            'stop_timeout' => 1
        ]); // 新建 Puppeteer 例項

        $browser   = $puppeteer->launch(); // 啟動無頭瀏覽器
        $page      = $browser->newPage(); // 開啟新的標籤頁

        foreach ($items as $id => $item) {
            try {
                $page->tryCatch->goto($item['url']); // 訪問頁面
                $content = $page->content();
            } catch (\Exception $error) {
                $content = null;
            }
            $items[$id]['html'] = $content;
        }

        $browser->close();

        return $items; // 返回 js 渲染後的頁面s
    }
}
