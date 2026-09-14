<?php

namespace App\Http\Controllers\Invoice;

use App\Http\Controllers\Controller;
use App\Http\Requests\Customer\StoreCustomerRequest;
use App\Http\Requests\Invoice\UpdateInvoiceRequest;
use App\Http\Resources\Invoice\InvoiceResource;
use App\Models\Invoice;

class InvoiceController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index()
  {
    $vaData = Invoice::with(['customer', 'subscription'])->paginate(10);

    return InvoiceResource::collection($vaData);
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(StoreCustomerRequest $request)
  {
    $invoice = Invoice::create($request->validated());

    return new InvoiceResource($invoice)
      ->response()
      ->setStatusCode(201);
  }

  /**
   * Display the specified resource.
   */
  public function show(Invoice $invoice)
  {
    return new InvoiceResource($invoice->load(['customer', 'subscription']));
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(UpdateInvoiceRequest $request, Invoice $invoice)
  {
    $invoice->update($request->validated());

    return new InvoiceResource($invoice->load(['customer', 'subscription  ']));
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(Invoice $invoice)
  {
    $invoice->delete();

    return response()->json([
      'message' => 'Invoice deleted successfully.',
    ]);
  }
}
