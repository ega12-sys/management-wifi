<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

return Application::configure(basePath: dirname(__DIR__))
  ->withRouting(
    web: __DIR__ . '/../routes/web.php',
    api: __DIR__ . '/../routes/api.php',
    commands: __DIR__ . '/../routes/console.php',
    health: '/up',
  )
  ->withMiddleware(function (Middleware $middleware): void {
    //
  })
  ->withExceptions(function (Exceptions $exceptions): void {
    $exceptions->shouldRenderJsonWhen(
      fn(Request $request) => $request->is('api/*') || $request->expectsJson(),
    );

    //error validasi
    $exceptions->render(function (
      \Illuminate\Validation\ValidationException $e,
      Request $request
    ) {
      return response()->json([
        'success' => false,
        'message' => 'Data yang diberikan tidak valid',
        'errors' => $e->errors(),
      ], 422);
    });

    /*
    // endpoint ada tapi model kosong
    $exceptions->render(function (
      \Illuminate\Database\Eloquent\ModelNotFoundException $e,
      Request $request
    ) {
      if ($request->is('api/*')) {
        $model = class_basename($e->getModel());

        return response()->json([
          'success' => false,
          'message' => $model . ' tidak ditemukan',
        ], 404);
      }
    });
  */

    // 404 API khusus tidak ada endpoint
    $exceptions->render(function (
      NotFoundHttpException $e,
      Request $request
    ) {
      if ($request->is('api/*')) {
        return response()->json([
          'success' => false,
          'message' => 'Endpoint tidak ditemukan',
        ], 404);
      }
    });

    //belum login atau tidak ada token
    $exceptions->render(function (
      \Illuminate\Auth\AuthenticationException $e,
      Request $request
    ) {
      if ($request->is('api/*')) {
        return response()->json([
          'success' => false,
          'message' => 'Unauthenticated.',
        ], 401);
      }
    });
  })->create();
