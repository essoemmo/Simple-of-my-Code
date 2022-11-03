<?php

namespace App\Traits;

trait ResponseTrait
{
    public static function successResponse($message = '',$data = [])
    {
        $response = [
            'success' => 1,
            'message' => $message,
            'data' => $data,
        ];
        return response()->json($response, 200);
    }


    public static function faildResponse($statusCode , $message = '')
    {
        $response = [
            'success' => 0,
            'message' => $message,
        ];
        return response()->json($response, $statusCode);
    }
}
