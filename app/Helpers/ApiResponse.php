<?php

namespace App\Helpers;

class ApiResponse
{
    /**
     * Return a success JSON response.
     *
     * @param mixed $data
     * @param string $message
     * @param int $code
     * @return \Illuminate\Http\JsonResponse
     */
    public static function success($data = [], $message = 'Success', $code = 200)
    {
        return response()->json([
            'status' => 'success',
            'message' => $message,
            'data' => $data,
            'timestamp' => now()->toIso8601String(),
        ], $code);
    }

    /**
     * Return an error JSON response.
     *
     * @param string $message
     * @param int $code
     * @param mixed $errors
     * @return \Illuminate\Http\JsonResponse
     */
    public static function error($message = 'Error', $code = 400, $errors = [])
    {
        return response()->json([
            'status' => 'error',
            'message' => $message,
            'errors' => $errors,
            'timestamp' => now()->toIso8601String(),
        ], $code);
    }
}
