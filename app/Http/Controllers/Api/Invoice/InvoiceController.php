<?php

namespace App\Http\Controllers\Api\Invoice;

use App\Http\Controllers\Controller;
use App\Http\Requests\Customer\StoreCustomerRequest;
use App\Http\Requests\Invoice\UpdateInvoiceRequest;
use App\Http\Resources\Invoice\InvoiceResource;
use App\Http\Traits\ApiResponse;
use App\Models\Invoice;

class InvoiceController extends Controller
{
  use ApiResponse;
  /**
   * Display a listing of the resource.
   */
  public function index()
  {
    $invoices = Invoice::with(['customer', 'subscription'])->paginate(10);

    return response()->json([
      'success' => true,
      'message' => 'Data invoice berhasil diambil',
      'data' => InvoiceResource::collection($invoices),
      'meta' => [
        'current_page' => $invoices->currentPage(),
        'last_page' => $invoices->lastPage(),
        'per_page' => $invoices->perPage(),
        'total' => $invoices->total(),
      ],
    ]);
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(StoreCustomerRequest $request)
  {
    $invoice = Invoice::create($request->validated());

    return $this->successResponse(
      new InvoiceResource($invoice),
      "Invoice Berhasil di Tambahkan",
      201
    );
  }

  /**
   * Display the specified resource.
   */
  public function show(Invoice $invoice)
  {
    return $this->successResponse(
      new InvoiceResource($invoice->load(['customer', 'subscription'])),
      "Invoice Berhasil di Temukan",
    );
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(UpdateInvoiceRequest $request, Invoice $invoice)
  {
    $invoice->update($request->validated());

    return $this->successResponse(
      new InvoiceResource($invoice->load(['customer', 'subscription  '])),
      "Invoice Berhasil di Perbarui"
    );
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(Invoice $invoice)
  {
    $invoice->delete();

    return $this->successResponse(
      null,
      "Invoice Berhasil di Hapus"
    );
  }
}
