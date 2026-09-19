<?php

namespace App\Http\Controllers\Api\Payment;

use App\Http\Controllers\Controller;
use App\Http\Requests\Payment\StorePaymentRequest;
use App\Http\Requests\Payment\UpdatePaymentRequest;
use App\Http\Resources\Payment\PaymentResource;
use App\Http\Traits\ApiResponse;
use App\Models\Payment;

class PaymentController extends Controller
{
  use ApiResponse;
  /**
   * Display a listing of the resource.
   */
  public function index()
  {
    $payments = Payment::with('invoice')->paginate(10);

    return response()->json([
      'success' => true,
      'message' => 'Data payment berhasil diambil',
      'data' => PaymentResource::collection($payments),
      'meta' => [
        'current_page' => $payments->currentPage(),
        'last_page' => $payments->lastPage(),
        'per_page' => $payments->perPage(),
        'total' => $payments->total(),
      ],
    ]);
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(StorePaymentRequest $request)
  {
    $payment = Payment::create($request->validated());

    return $this->successResponse(
      new PaymentResource($payment),
      "Payment Berhasil di Tambahkan",
      201
    );
  }

  /**
   * Display the specified resource.
   */
  public function show(Payment $payment)
  {
    return $this->successResponse(
      new PaymentResource($payment->load('invoice')),
      "Paymen Berhasil di Temukan"
    );
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(UpdatePaymentRequest $request, Payment $payment)
  {
    $payment->update($request->validated());

    return $this->successResponse(
      new PaymentResource($payment->load('invoice')),
      "Payment Berhasil di Perbarui"
    );
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(Payment $payment)
  {
    $payment->delete();

    return $this->successResponse(
      null,
      "Payment Berhasil di Hapus"
    );
  }
}
