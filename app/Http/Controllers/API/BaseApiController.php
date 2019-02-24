<?php

namespace App\Http\Controllers\Api;

trait BaseApiController
{
    function apiResponse($result = null, $error = null, $code = 200)
    {
        $response = [
            'status' => $code == 200 ? true : false,
            'data' => $result,
            'error' => $error
        ];
        return response()->json($response, $code,['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8'],
            JSON_UNESCAPED_UNICODE);
    }
    
}