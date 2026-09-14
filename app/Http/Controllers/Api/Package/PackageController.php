<?php

namespace App\Http\Controllers\Api\Package;

use App\Http\Controllers\Controller;
use App\Http\Requests\Package\StorePackageRequest;
use App\Http\Requests\Package\UpdatePackageRequest;
use App\Http\Resources\Package\PackageResource;
use App\Models\Package;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PackageController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index()
  {
    $vaData = Package::with('packageType')->paginate(10);

    return PackageResource::collection($vaData);
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(StorePackageRequest $request)
  {
    $package = Package::create($request->validated());

    return (new PackageResource($package))
      ->response()
      ->setStatusCode(201);
  }

  /**
   * Display the specified resource.
   */
  public function show(Package $package)
  {
    return new PackageResource($package->load('packageType'));
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(UpdatePackageRequest $request, Package $package)
  {
    $package->update($request->validated());
    $package->load('packageType'); //relasi ke tabel tipe paket

    return new PackageResource($package);
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(Package $package): JsonResponse
  {
    $package->delete();

    return response()->json([
      'message' => 'Package deleted successfully.',
    ]);
  }
}
