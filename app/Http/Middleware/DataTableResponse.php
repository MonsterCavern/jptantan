<?php

namespace App\Http\Middleware;

use Closure;
use App\Json;

class DataTableResponse
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // before
        $response = $next($request);
        // after
        if (isset($request->draw)) {
            $draw = $request->draw;
        } else {
            $draw = 0;
        }

        if (isset($request->draw)) {
            $draw = $request->draw;
        } else {
            $draw = 0;
        }
        $content = Json::Decode($response->getContent());
        // add table config
        $content = Json::Encode([
          'draw'            => (int)$draw,
          'data'            => $content['data'],
          'recordsFiltered'    => $content['amount'],
          'recordsTotal' => $request->length
        ]);
        $response->setContent($content);
        return $response;
    }
}
