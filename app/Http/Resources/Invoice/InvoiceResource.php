<?php

namespace App\Http\Resources\Invoice;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class InvoiceResource extends JsonResource
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
      'DataCustomer' => $this->whenLoaded('customer', function () {
        return [
          'Kode' => $this->customer->code,
          'Name' => $this->customer->name
        ];
      }),
      'DataPelanggan' => $this->whenLoaded('subscription', function () {
        return [
          'Kode' => $this->subscription->code
        ];
      }),
      'NomorInvoice' => $this->invoice_number,
      'PeriodeTagihan' => $this->periode_tagihan,
      'TglJthTmp' => $this->tgl_jatuh_tempo,
      'Jumlah'  => $this->amount,
      'Status' => $this->status
    ];
  }
}
