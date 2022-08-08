<?php

namespace App\Traits\Api;

trait ResponsesTrait
{
    public function success($data, $message)
    {
        $response = [
            'success' => True,
            'result' => $data,
            'message' => $message,
        ];
        return response()->json($response, 200);
    }

    public function failed($message)
    {
        $response = [
            'success' => False,
            'message' => $message
        ];
        return response()->json($response, 404);
    }

}
