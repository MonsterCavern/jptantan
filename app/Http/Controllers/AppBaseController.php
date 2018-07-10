<?php

namespace App\Http\Controllers;

use Illuminate\Http\Exceptions\HttpResponseException;
use App\Utils\ResponseUtil;
use Response;

/**
 * @SWG\Swagger(
 *   basePath="/api/v1",
 *   @SWG\Info(
 *     title="Laravel Generator APIs",
 *     version="1.0.0",
 *   )
 * )
 * This class should be parent class for other API controllers
 * Class AppBaseController
 */
class AppBaseController extends Controller
{
    public function sendPaginateResponse($result, $message)
    {
        $response = ResponseUtil::makeResponse($message, $result['data']);
      
        foreach ($result as $key => $value) {
            if ($key != 'data') {
                $response[$key] = $value;
            }
        }

        return Response::json($response);
    }
  
    public function sendResponse($result, $message)
    {
        return Response::json(ResponseUtil::makeResponse($message, $result));
    }

    public function sendError($error, $code = 403)
    {
        throw new HttpResponseException(Response::json(ResponseUtil::makeError($error), $code));
    }
}
