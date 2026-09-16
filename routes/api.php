<?php

use App\Http\Controllers\Api\Customer\CustomerController;
use App\Http\Controllers\Api\Invoice\InvoiceController;
use App\Http\Controllers\Api\Package\PackageController;
use App\Http\Controllers\Api\PackageType\PackageTypeController;
use App\Http\Controllers\Api\Payment\PaymentController;
use App\Http\Controllers\Api\Subscription\SubscriptionController;
use App\Http\Controllers\Auth\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
  Route::post('/logout', [AuthController::class, 'logout']);
  Route::get('/user', function (Request $request) {
    return response()->json([
      'user' => $request->user(),
    ]);
  });
});

Route::apiResource('package-types', PackageTypeController::class);
Route::apiResource('packages', PackageController::class);
Route::apiResource('customers', CustomerController::class);
Route::apiResource('subscriptions', SubscriptionController::class);
Route::apiResource('invoices', InvoiceController::class);
Route::apiResource('payments', PaymentController::class);
