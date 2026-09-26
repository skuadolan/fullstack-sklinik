<?php

namespace App\Http\Controllers;

use App\Traits\HttpCode;
use Illuminate\Http\JsonResponse;
use Inertia\Inertia;
use Inertia\Response;

abstract class Controller
{
    use HttpCode;

    protected static function inertiaView($component, $props = []): Response
    {
        return Inertia::render($component, $props);
    }

    protected static function apiJsonResponse($code, $status, $message, $metaData = [], $headers = []): JsonResponse
    {
        $status = getVarValue(self::HTTP_MSG, $code);

        return response()->json(arryApiReturn($code, $status, $message, $metaData), $status, $headers, JSON_PRETTY_PRINT);
    }
}
