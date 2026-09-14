<?php

namespace App\Http\Resources\Customer;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CustomerResource extends JsonResource
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
      'Name' => $this->name,
      'Telepon' => $this->phone,
      'Email' => $this->email,
      'Alamat' => $this->address,
      'Status' => $this->status,
      'Tgl_Instalasi' => $this->installation_date
    ];
  }
}
