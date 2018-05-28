<?php

namespace App\Services\WebCrawler;

use DiDom\Document;

/**
 *
 */
class BoketeCrawlerService
{
    private $baseurl = 'https://bokete.jp/boke/';
    
    public function crawler()
    {
        // code...
    }
    
    public function getPopularList()
    {
        $url         = $this->baseurl.'popular';
        $PopularList = [];
        try {
            $document    = new Document($url, true);
            $PopularList = $document->find('.boke');
        } catch (\Exception $e) {
            //
        }
        dump($PopularList);
    }
}
