<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Traits\DataTable;
use App\Model\UrlMap;

class UrlMapController extends Controller
{
    use DataTable;
    
    // public function __construct()
    // {
    //     $this->DefaultModel = UrlMap::class;
    // }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $res)
    {
        // $skip = $res->start?$res->start:0;
        // $take = $res->length?$res->length:0;
        // $urls = UrlMap::skip($skip)->take($take);
        //
        // $urls = $urls->get();
        // $amount = UrlMap::count();
        
        $urls = $this->dataTable(UrlMap::class, $res);
        dd($urls);
        return [
          'data'   => $urls,
          'amount' => $amount
        ];
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\UrlMap  $urlMap
     * @return \Illuminate\Http\Response
     */
    public function show(UrlMap $urlMap)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\UrlMap  $urlMap
     * @return \Illuminate\Http\Response
     */
    public function edit(UrlMap $urlMap)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\UrlMap  $urlMap
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, UrlMap $urlMap)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\UrlMap  $urlMap
     * @return \Illuminate\Http\Response
     */
    public function destroy(UrlMap $urlMap)
    {
        //
    }
}
