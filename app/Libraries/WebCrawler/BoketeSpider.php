<?php

namespace App\Libraries\Webcrawler;

use DiDom\Document;

/**
 *
 */
class BoketeSpider
{
    public function __construct($url)
    {
        $this->url = $url;
        try {
            $this->crawler = new Document($url, true);
        } catch (\Exception $e) {
            var_dump($e);
        }
    }
    
    public function getListUrl()
    {
        return $this->crawler->find('a.boke-text::attr(href)');
    }
    
    public function getNumber()
    {
        return $this->crawler->find('.modal-dialog::attr(data-boke-id)');
    }
    
    public function getContent()
    {
        return $this->crawler->find('.modal-content')[0]->find('input::attr(value)')[1];
    }
    
    public function getStarts()
    {
        $start = $this->crawler->find('.boke-stars')[0]->find('a::text')[1];
        $start = preg_replace('/[^0-9]/', '', $start);

        return $start;
    }
    
    public function getReleasedTime()
    {
        return $this->crawler->find('.boke-information-label')[0]->find('a::text')[0];
    }
}
