<?php

use App\Http\Middleware\HandleInertiaRequests;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Middleware\AddLinkHeadersForPreloadedAssets;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(web: __DIR__.'/../routes/web.php', api: __DIR__.'/../routes/api.php', commands: __DIR__.'/../routes/console.php', health: '/up')
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->web(append: [HandleInertiaRequests::class, AddLinkHeadersForPreloadedAssets::class]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        $exceptions->render(function (Throwable $e, Request $request) {
            if ($request->expectsJson() || $request->is('api/*')) {
                return;
            }

            if ($request->inertia()) {
                $code = $e instanceof HttpExceptionInterface ? $e->getStatusCode() : 500;

                return Inertia::render('Exceptions', [
                    'code' => $code,
                    'status' => getVarValue(self::HTTP_MSG, $code),
                    'message' => $e->getMessage(),
                ])
                    ->toResponse($request)
                    ->setStatusCode($code);
            }
        });
    })
    ->create();
