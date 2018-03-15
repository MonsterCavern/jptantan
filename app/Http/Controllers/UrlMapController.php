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
        $urls = $this->dataTable(UrlMap::class, $res);
        return $urls;
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
    public function store(Request $request, UrlMap $urlMap)
    {
        return response()->json([
          'code'    => 200,
          'message' => 'sucess'
        ]);
      
        // 驗證 資料
        $request->validate([
          'title' => 'required|max:255',
          'url' => 'required|url|unique:url_maps',
        ]);
        
        // 過濾 URL
        $data = $request->all();
        $parseUrl = parse_url($data['url']);
        $data['scheme']   = $parseUrl['scheme'];
        $data['host']     = $parseUrl['host'];
        $data['path']     = $parseUrl['path']??'';
        $data['query']    = $parseUrl['query']??'';
        $data['fragment'] = $parseUrl['fragment']??'';
      
        // Save
        $res = $urlMap->insert($data);
        if ($res) {
            return response()->json([
              'code'    => 200,
              'message' => 'sucess'
            ]);
        } else {
            return response()->json([
              'code'    => 200,
              'message' => 'faild'
            ]);
        }
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
