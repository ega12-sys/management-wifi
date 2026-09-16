<?php

namespace App\Http\Resources\Payment;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PaymentResource extends JsonResource
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
      'Data_Invoice' => $this->whenLoaded('invoice', function () {
        return [
          'Kode' => $this->invoice->code,
          'Invoice_Number' => $this->invoice->invoice_number
        ];
      }),
      'Tgl_Bayar'     => $this->tgl_bayar,
      'Jumlah'        => $this->amount,
      'Metode_Bayar'  => $this->metode_pembayaran,
      'Catatan'       => $this->notes
    ];
  }
}
