<?php

namespace App\Traits;

use Illuminate\Http\JsonResponse;

trait ResponseTrait
{
    // success response api
    public static function successResponse(string $message = '', $data = [], int $statusCode = 200): JsonResponse
    {
        $response = [
            'status_code' => $statusCode,
            'message' => $message,
            'data' => $data,
        ];

        return response()->json($response, 200);
    }

    // success response api
    public static function successResponsePaginate($data, string $message = '', int $statusCode = 200): JsonResponse
    {
        $response = [
            'status_code' => $statusCode,
            'message' => $message,
            'data' => $data['data'],
            'links' => $data['links'],
            'meta' => $data['meta'],
        ];

        return response()->json($response, 200);
    }

    // fail response api
    public static function failResponse(int $statusCode, string $message = ''): JsonResponse
    {
        $response = [
            'status_code' => $statusCode,
            'message' => $message,
        ];

        return response()->json($response, $statusCode);
    }
}
