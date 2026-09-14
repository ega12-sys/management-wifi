<?php

namespace App\Http\Controllers\Api\PackageType;

use App\Http\Controllers\Controller;
use App\Http\Requests\PackageType\StorePackageTypeRequest;
use App\Http\Requests\PackageType\UpdatePackageTypeRequest;
use App\Http\Resources\PackageType\PackageTypeResource;
use App\Models\PackageType;
use Illuminate\Http\JsonResponse;

class PackageTypeController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index()
  {
    $packageTypes = PackageType::query()->latest()->paginate(10);

    return PackageTypeResource::collection($packageTypes);
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(StorePackageTypeRequest $request)
  {
    $packageType = PackageType::create($request->validated());

    return (new PackageTypeResource($packageType))
      ->response()
      ->setStatusCode(201);
  }

  /**
   * Display the specified resource.
   */
  public function show(PackageType $packageType)
  {
    return new PackageTypeResource($packageType);
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(UpdatePackageTypeRequest $request, PackageType $packageType)
  {
    $packageType->update($request->validated());

    return new PackageTypeResource($packageType->fresh());
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(PackageType $packageType): JsonResponse
  {
    $packageType->delete();

    return response()->json([
      'message' => 'Package type deleted successfully.',
    ]);
  }
}
