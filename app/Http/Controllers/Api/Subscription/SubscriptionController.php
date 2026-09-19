<?php

namespace App\Http\Controllers\Api\Subscription;

use App\Http\Controllers\Controller;
use App\Http\Requests\Subscription\StoreSubscriptionRequest;
use App\Http\Requests\Subscription\UpdateSubscriptionRequest;
use App\Http\Resources\Subscription\SubscriptionResource;
use App\Http\Traits\ApiResponse;
use App\Models\Subscription;

class SubscriptionController extends Controller
{
  use ApiResponse;
  /**
   * Display a listing of the resource.
   */
  public function index()
  {
    $subscriptions = Subscription::with('customer', 'package')->paginate(10);

    return response()->json([
      'success' => true,
      'message' => 'Data pelanggan berhasil diambil',
      'data' => SubscriptionResource::collection($subscriptions),
      'meta' => [
        'current_page' => $subscriptions->currentPage(),
        'last_page' => $subscriptions->lastPage(),
        'per_page' => $subscriptions->perPage(),
        'total' => $subscriptions->total(),
      ],
    ]);
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(StoreSubscriptionRequest $request)
  {
    $subscription = Subscription::create($request->validated());

    return $this->successResponse(
      new SubscriptionResource($subscription),
      "Pelanggan Berhasil di Tambahkan",
      201
    );
  }

  /**
   * Display the specified resource.
   */
  public function show(Subscription $subscription)
  {
    return $this->successResponse(
      new SubscriptionResource($subscription->load('customer', 'package')),
      "Pelanggan Berhasil di Temukan"
    );
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(UpdateSubscriptionRequest $request, Subscription $subscription)
  {
    $subscription->update($request->validated());

    return $this->successResponse(
      new SubscriptionResource($subscription),
      "Pelanggan Berhasil di Perbarui"
    );
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(Subscription $subscription)
  {
    $subscription->delete();

    return $this->successResponse(
      null,
      "Pelanggan Berhasil di Hapus"
    );
  }
}
