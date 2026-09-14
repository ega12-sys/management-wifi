<?php

namespace App\Http\Resources\Package;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PackageResource extends JsonResource
{
  /**
   * Transform the resource into an array.
   *
   * @return array<string, mixed>
   */
  public function toArray(Request $request): array
  {
    return [
      'Kode'        => $this->code,
      'Nama'        => $this->name,
      'Type_Paket'  => $this->whenLoaded('packageType', function () {
        return [
          'code' => $this->packageType->code,
          'name' => $this->packageType->description,
        ];
      }),
      'Kecepatan'   => $this->speed,
      'Harga'       => $this->price,
      'Deskripsi'   => $this->description,
      'Status'      => $this->status
    ];
  }
}
