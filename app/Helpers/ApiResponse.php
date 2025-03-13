<?php

namespace App\Helpers;

use Illuminate\Http\JsonResponse;

class ApiResponse {


    public static function success($data = null, $message = 'Operación exitosa', $code = 200, $meta = null): JsonResponse
    {
        return new JsonResponse([
            'status' => 'success',
            'code' => $code,
            'message' => $message,
            'data' => $data,
            'meta' => $meta,
        ],$code);
        // return response()->json([
        //     'status' => 'success',
        //     'code' => $code,
        //     'message' => $message,
        //     'data' => $data,
        //     'meta' => $meta,
        // ], $code);
    }

    public static function error($message = 'Error', $code = 400, $errors = null): JsonResponse
    {

        return new JsonResponse([
            'status' => 'error',
            'code' => $code,
            'message' => $message,
            'data' => [
                'errors' => $errors
            ]
        ],$code);
        // return response()->json([
        //     'status' => 'error',
        //     'code' => $code,
        //     'message' => $message,
        //     'data' => [
        //         'errors' => $errors
        //     ]
        // ], $code);
    }
}





?>
