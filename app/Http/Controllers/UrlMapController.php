<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\GoogleTranslationService;
use App\Traits\DataTable;
use App\Models\UrlMap;
use App\Utils\Util;

class UrlMapController extends Controller
{
    use DataTable;
    
    public function autoTranslate()
    {
        $mssage = [];
        $rows   = UrlMap::select('id', 'content')->where('is_cached', 0)->get();
        // dd($rows);
        if ($rows) {
            $GTService = new GoogleTranslationService;
            foreach ($rows as $row) {
                // urlid
                $GTService->auto($row->id, $row->content);
                // 更新 is_cached
                $mssage['id']     = $row->id;
                $mssage['status'] = UrlMap::where('id', $row->id)->update(['is_cached' => 1]);
            }
        }
        
        return response()->json([
          'code'    => 200,
          'message' => $mssage
        ]);
    }
    
    public function autoParser(Request $request)
    {
        $url   = ($request->url) ?? 'https://ncode.syosetu.com/n2267be/2/';
        $parse = new HtmlParserController;
        $res   = $parse->parserSyosetu($url);
        // dd($url, $res);
        $status = UrlMap::where('url', $url)->update(['content' => Util::JsonEncode($res)]);

        return response()->json([
          'code'    => 200,
          'message' => $status
        ]);
    }
    
    /**
     * Display a listing of the resource.
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $urls = $this->dataTable(UrlMap::class, $request);

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
     * @param  \App\Models\UrlMap  $urlMap
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
          'url'   => 'required|url|unique:url_maps',
        ]);
        
        // 過濾 URL
        $data             = $request->all();
        $parseUrl         = parse_url($data['url']);
        $data['scheme']   = $parseUrl['scheme'];
        $data['host']     = $parseUrl['host'];
        $data['path']     = $parseUrl['path'] ?? '';
        $data['query']    = $parseUrl['query'] ?? '';
        $data['fragment'] = $parseUrl['fragment'] ?? '';
      
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
     * @param  \App\Models\UrlMap  $urlMap
     * @return \Illuminate\Http\Response
     */
    public function show(UrlMap $urlMap)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\UrlMap  $urlMap
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
     * @param  \App\Models\UrlMap  $urlMap
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, UrlMap $urlMap)
    {
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\UrlMap  $urlMap
     * @return \Illuminate\Http\Response
     */
    public function destroy(UrlMap $urlMap)
    {
        //
    }
}
