<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function resSuccess($message, $data = [], $code = 200)
    {
        return response()->json([
            'result' => true,
            'message' => $message,
            'data' => $data,
            'code' => $code
        ], $code);
    }

    public function resError($message, $data = [], $code = 422)
    {
        return response()->json([
            'result' => false,
            'message' => $message,
            'data' => $data,
            'code' => $code
        ], $code);
    }
}
