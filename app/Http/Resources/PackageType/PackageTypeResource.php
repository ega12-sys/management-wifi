<?php

namespace App\Http\Resources\PackageType;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PackageTypeResource extends JsonResource
{
  /**
   * Transform the resource into an array.
   *
   * @return array<string, mixed>
   */
  public function toArray(Request $request): array
  {
    /* Resource ini bertugas menentukan data apa yang boleh dikirim Laravel ke React.  */
    return [
      'code' => $this->code,
      'description' => $this->description,
      'created_at' => $this->created_at,
      'updated_at' => $this->updated_at,
    ];
  }
}
