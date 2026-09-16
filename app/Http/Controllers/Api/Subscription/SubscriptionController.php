<?php

namespace App\Http\Controllers\Api\Subscription;

use App\Http\Controllers\Controller;
use App\Http\Requests\Subscription\StoreSubscriptionRequest;
use App\Http\Requests\Subscription\UpdateSubscriptionRequest;
use App\Http\Resources\Subscription\SubscriptionResource;
use App\Models\Subscription;

class SubscriptionController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index()
  {
    $vaData = Subscription::with('customer', 'package')->paginate(10);

    return SubscriptionResource::collection($vaData);
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(StoreSubscriptionRequest $request)
  {
    $subscription = Subscription::create($request->validated());

    return (new SubscriptionResource($subscription))
      ->response()
      ->setStatusCode(201);
  }

  /**
   * Display the specified resource.
   */
  public function show(Subscription $subscription)
  {
    return new SubscriptionResource($subscription->load('customer', 'package'));
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(UpdateSubscriptionRequest $request, Subscription $subscription)
  {
    $subscription->update($request->validated());

    return new SubscriptionResource($subscription);
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(Subscription $subscription)
  {
    $subscription->delete();

    return response()->json([
      'message' => 'Subscription deleted successfully.',
    ]);
  }
}
