<?php

namespace App;

use Illuminate\Support\Facades\Response;

trait ApiResponse
{
    public static function success($data = [], $message = "",  $code = 200, $headers = [], $options = 0){
        return Response::json(array_merge($data, ['message' => $message]), $code, $headers, $options);
    }
}
