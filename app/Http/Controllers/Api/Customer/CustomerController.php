<?php

namespace App\Http\Controllers\Api\Customer;

use App\Http\Controllers\Controller;
use App\Http\Requests\Customer\StoreCustomerRequest;
use App\Http\Requests\Customer\UpdateCustomerRequest;
use App\Http\Resources\Customer\CustomerResource;
use App\Models\Customer;

class CustomerController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index()
  {
    $vaData = Customer::query()->paginate(10);

    return CustomerResource::collection($vaData);
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(StoreCustomerRequest $request)
  {
    $customer = Customer::create($request->validated());

    return (new CustomerResource($customer))
      ->response()
      ->setStatusCode(201);
  }

  /**
   * Display the specified resource.
   */
  public function show(Customer $customer)
  {
    return (new CustomerResource($customer));
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(UpdateCustomerRequest $request, Customer $customer)
  {
    $customer->update($request->validated());

    return new CustomerResource($customer);
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(Customer $customer)
  {
    $customer->delete();

    return response()->json([
      'message' => 'Customer deleted successfully.',
    ]);
  }
}
