<?php

namespace App\Macros;

use Illuminate\Support\Facades\Response;

class ResponseMacro
{
    public function success()
    {
        return function ($message, $data = [], $status = 200) {
            $response_format = [
                'status' => true,
                'message' => $message,
                'data' => $data,
            ];

            return Response::json($response_format, $status);
        };
    }

    public function errorResponse()
    {
        return function ($message, $data = [], $status = 400) {
            $response_format = [
                'status' => false,
                'message' => $message,
                'errors' => $data,
            ];

            return Response::json($response_format, $status);
        };
    }
}
