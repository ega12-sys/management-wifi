<?php

use App\Http\Controllers\Api\Customer\CustomerController;
use App\Http\Controllers\Api\Package\PackageController;
use App\Http\Controllers\Api\PackageType\PackageTypeController;
use App\Http\Controllers\Invoice\InvoiceController;
use App\Http\Controllers\Subscription\SubscriptionController;
use App\Models\Package;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
  return $request->user();
})->middleware('auth:sanctum');

Route::apiResource('package-types', PackageTypeController::class);
Route::apiResource('packages', PackageController::class);
Route::apiResource('customers', CustomerController::class);
Route::apiResource('subscriptions', SubscriptionController::class);
Route::apiResource('invoices', InvoiceController::class);
