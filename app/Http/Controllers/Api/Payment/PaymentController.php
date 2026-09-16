<?php

namespace App\Http\Controllers\Api\Payment;

use App\Http\Controllers\Controller;
use App\Http\Requests\Payment\StorePaymentRequest;
use App\Http\Requests\Payment\UpdatePaymentRequest;
use App\Http\Resources\Payment\PaymentResource;
use App\Models\Payment;

class PaymentController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index()
  {
    $vaData = Payment::with('invoice')->paginate(10);

    return PaymentResource::collection($vaData);
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(StorePaymentRequest $request)
  {
    $payment = Payment::create($request->validated());

    return new PaymentResource($payment)
      ->response()
      ->setStatusCode(201);
  }

  /**
   * Display the specified resource.
   */
  public function show(Payment $payment)
  {
    return new PaymentResource($payment->load('invoice'));
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(UpdatePaymentRequest $request, Payment $payment)
  {
    $payment->update($request->validated());

    return new PaymentResource($payment->load('invoice'));
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(Payment $payment)
  {
    $payment->delete();

    return response()->json([
      'message' => 'Payment deleted successfully.',
    ]);
  }
}
