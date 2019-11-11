<?php

namespace App\Helpers\General\Traits;

/**
 * Responses for Api
 */
trait ApiResponsesTrait
{
    /**
     * Return response error
     *
     * @param string $message
     * @param array $errors
     * @param integer $code
     * @return void
     * @author Stiven Castillo <stivencastillo.90@gmail.com>
     */
    public function responseError(string $message = '', array $errors = [], int $code = 400)
    {
        return response()->json([
            'data' => [],
            'status' => $code,
            'meta' => [
                'message' => $message,
                'errors' => $errors
            ]
        ], $code);
    }

    /**
     * Return success response
     *
     * @param array $data
     * @param array $meta
     * @param integer $code
     * @return void
     * @author Stiven Castillo <stivencastillo.90@gmail.com>
     */
    public function responseSuccess($data, array $meta = [], int $code = 200)
    {
        return response()->json([
            'data' => $data,
            'status' => $code,
            'meta' => $meta
        ], $code);
    }
}
