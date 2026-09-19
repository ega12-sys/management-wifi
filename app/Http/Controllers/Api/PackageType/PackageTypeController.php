<?php

namespace App\Http\Controllers\Api\PackageType;

use App\Http\Controllers\Controller;
use App\Http\Requests\PackageType\StorePackageTypeRequest;
use App\Http\Requests\PackageType\UpdatePackageTypeRequest;
use App\Http\Resources\PackageType\PackageTypeResource;
use App\Http\Traits\ApiResponse;
use App\Models\PackageType;
use Illuminate\Http\JsonResponse;

class PackageTypeController extends Controller
{
  use ApiResponse;
  /**
   * Display a listing of the resource.
   */
  public function index()
  {
    $packageTypes = PackageType::query()->paginate(10);

    return response()->json([
      'success' => true,
      'message' => 'Data tipe paket berhasil diambil',
      'data' => PackageTypeResource::collection($packageTypes),
      'meta' => [
        'current_page' => $packageTypes->currentPage(),
        'last_page' => $packageTypes->lastPage(),
        'per_page' => $packageTypes->perPage(),
        'total' => $packageTypes->total(),
      ],
    ]);
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(StorePackageTypeRequest $request)
  {
    $packageType = PackageType::create($request->validated());

    return $this->successResponse(
      new PackageTypeResource($packageType),
      "Tipe Paket Berhasil di Tambahkan",
      201
    );
  }

  /**
   * Display the specified resource.
   */
  public function show(PackageType $packageType)
  {
    return $this->successResponse(
      new PackageTypeResource($packageType),
      "Tipe Paket Berhasil di Temukan"
    );
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(UpdatePackageTypeRequest $request, PackageType $packageType)
  {
    $packageType->update($request->validated());

    return $this->successResponse(
      new PackageTypeResource($packageType->fresh()),
      "Tipe Paket Berhasil di Perbarui"
    );
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(PackageType $packageType): JsonResponse
  {
    $packageType->delete();

    return $this->successResponse(
      null,
      "Tipe Paket Berhasil di Hapus"
    );
  }
}
