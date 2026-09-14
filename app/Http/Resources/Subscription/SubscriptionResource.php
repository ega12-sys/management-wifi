<?php

namespace App\Http\Resources\Subscription;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SubscriptionResource extends JsonResource
{
  /**
   * Transform the resource into an array.
   *
   * @return array<string, mixed>
   */
  public function toArray(Request $request): array
  {
    return [
      'Kode' => $this->code,
      'Kode_Customer' => $this->whenLoaded('customer', function () {
        return [
          'Kode' => $this->customer->code,
          'Nama' => $this->customer->name,
        ];
      }),
      'Kode_Paket' => $this->whenLoaded('package', function () {
        return [
          'Kode' => $this->package->code,
          'Nama' => $this->package->name,
        ];
      }),
      'Tgl_Mulai' => $this->tgl_mulai,
      'Tgl_Akhir' => $this->tgl_akhir,
      'Harga'     => $this->price,
      'Status'    => $this->status
    ];
  }
}
