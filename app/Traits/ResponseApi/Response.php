<?php

namespace App\Traits\ResponseApi;

trait Response
{
    public function sendResponse($header, $data, $status, $code)
    {
        return response()->json([
            'status' => $status,
            'code' => $code,
            $header => $data
        ]);
    }
}
