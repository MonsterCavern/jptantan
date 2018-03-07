<?php 
namespace App\Traits;

/**
 *
 */
trait DataTable
{
    public function dataTable($model = Object, $resquest = Object)
    {
        // dd($resquest->all());
        $query = $this->serialize($resquest->all());
        
        $urls = UrlMap::skip($skip)->take($take);
        $urls = $urls->orderby();
        $urls = $urls->get();
    }
    
    public function serialize($query=[])
    {
        $skip = $resquest->start?$res->start:0;
        $take = $resquest->length?$res->length:0;
    }
}
