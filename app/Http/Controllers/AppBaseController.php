<?php

namespace App\Http\Controllers;

use Illuminate\Http\Exceptions\HttpResponseException;
use App\Utils\ResponseUtil;
use Response;

/**
 * @OA\OpenApi(
 *   @OA\Info(
 *     title="Laravel Generator APIs",
 *     version="1.0.0",
 *   ),
 *   @OA\Server(
 *     description="Api server",
 *     url="/api",
 *   ),
 *
 * )
 * This class should be parent class for other API controllers
 * Class AppBaseController
 */
class AppBaseController extends Controller
{
    public function sendResponse($result, $message)
    {
        return Response::json(ResponseUtil::makeResponse($message, $result));
    }

    public function sendError($error, $code = 404)
    {
        throw new HttpResponseException(Response::json(ResponseUtil::makeResponse($error, [], $code), $code));
    }
    
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
}
