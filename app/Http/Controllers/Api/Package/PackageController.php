<?php

namespace App\Http\Controllers\Api\Package;

use App\Http\Controllers\Controller;
use App\Http\Requests\Package\StorePackageRequest;
use App\Http\Requests\Package\UpdatePackageRequest;
use App\Http\Resources\Package\PackageResource;
use App\Http\Traits\ApiResponse;
use App\Models\Package;
use Illuminate\Http\JsonResponse;

class PackageController extends Controller
{
  use ApiResponse;
  /**
   * Display a listing of the resource.
   */
  public function index()
  {
    $packages = Package::with('packageType')->paginate(10);

    return response()->json([
      'success' => true,
      'message' => 'Data paket berhasil diambil',
      'data' => PackageResource::collection($packages),
      'meta' => [
        'current_page' => $packages->currentPage(),
        'last_page' => $packages->lastPage(),
        'per_page' => $packages->perPage(),
        'total' => $packages->total(),
      ],
    ]);
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(StorePackageRequest $request)
  {
    $package = Package::create($request->validated());

    return $this->successResponse(
      new PackageResource($package),
      "Paket Berhasil di Tambahkan",
      201
    );
  }

  /**
   * Display the specified resource.
   */
  public function show(Package $package)
  {
    return $this->successResponse(
      new PackageResource($package->load('packageType')),
      "Paket Berhasil di Temukan"
    );
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(UpdatePackageRequest $request, Package $package)
  {
    $package->update($request->validated());
    $package->load('packageType'); //relasi ke tabel tipe paket

    return $this->successResponse(
      new PackageResource($package),
      "Paket Berhasil di Perbarui"
    );
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(Package $package): JsonResponse
  {
    $package->delete();

    return $this->successResponse(
      null,
      "Paket Berhasil di Hapus"
    );
  }
}
