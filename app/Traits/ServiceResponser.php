<?php

namespace App\Traits;

use Illuminate\Http\Response;

trait ServiceResponser
{

    public function successResponse($message, $description, $code = Response::HTTP_OK)
    {
        return response()->json(['error' => false, 'code' => $code, 'response' => $message, 'description' => $description], $code);
    }

    public function errorResponse($message, $description, $code = Response::HTTP_INTERNAL_SERVER_ERROR)
    {
        return response()->json(['error' => false, 'code' => $code, 'response' => $message, 'description' => $description], $code);
    }
}
