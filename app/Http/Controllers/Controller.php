<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

/**
* @OA\Info(
*      version="1.0.0",
*      title="Dokumentasi API",
*      description="Badan Perencanaan Pembangunan Daerah Lampung Timur",
*      @OA\Contact(
*          email="hi.wasissubekti02@gmail.com"
*      ),
*      @OA\License(
*          name="Apache 2.0",
*          url="http://www.apache.org/licenses/LICENSE-2.0.html"
*      )
* )
*
* @OA\Server(
*      url=L5_SWAGGER_CONST_HOST,
*      description="Demo API Server"
* )
 */

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public $SUCCESS_CODE = 200;
    public $VALIDATION_FAILED_CODE = 422;
    public $SERVER_ERROR_CODE = 500;

    public function sendSuccessResponse($data, $type)
    {
        return response()->json([
            'body'      => $data,
            'status'    => true,
            '__type'    => $type
        ], $this->SUCCESS_CODE);
    }

    public function sendFailedResponse($data, $type)
    {
        return response()->json([
            'body'      => $data,
            'status'    => false,
            '__type'    => $type
        ], $this->SERVER_ERROR_CODE);
    }

    public function sendValidationFailedResponse($data)
    {
        return response()->json([
            $data,
        ], $this->VALIDATION_FAILED_CODE);
    }
}
