<?php

namespace App\Http\Controllers\Api\Customer;

use App\Http\Controllers\Controller;
use App\Http\Requests\Customer\StoreCustomerRequest;
use App\Http\Requests\Customer\UpdateCustomerRequest;
use App\Http\Resources\Customer\CustomerResource;
use App\Http\Traits\ApiResponse;
use App\Models\Customer;

class CustomerController extends Controller
{
  use ApiResponse;
  /**
   * Display a listing of the resource.
   */
  public function index()
  {
    $customers = Customer::query()->paginate(10);

    return response()->json([
      'success' => true,
      'message' => 'Data customer berhasil diambil',
      'data' => CustomerResource::collection($customers),
      'meta' => [
        'current_page' => $customers->currentPage(),
        'last_page' => $customers->lastPage(),
        'per_page' => $customers->perPage(),
        'total' => $customers->total(),
      ],
    ]);
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(StoreCustomerRequest $request)
  {
    $customer = Customer::create($request->validated());

    return $this->successResponse(
      new CustomerResource($customer),
      "Customer Berhasil di Tambahkan",
      201
    );
  }

  /**
   * Display the specified resource.
   */
  public function show(Customer $customer)
  {
    return $this->successResponse(
      new CustomerResource($customer),
      "Customer Berhasil di Temukan"
    );
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(UpdateCustomerRequest $request, Customer $customer)
  {
    $customer->update($request->validated());

    return $this->successResponse(
      new CustomerResource($customer),
      "Customer Berhasil di Perbarui"
    );
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(Customer $customer)
  {
    $customer->delete();

    return $this->successResponse(
      null,
      "Customer Berhasil di Hapus"
    );
  }
}
