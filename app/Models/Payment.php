<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
  protected $fillable = [
    'code',
    'invoice_code',
    'tgl_bayar',
    'amount',
    'metode_pembayaran',
    'notes'
  ];

  public function getRouteKeyName()
  {
    return 'code';
  }

  public function invoice()
  {
    return $this->belongsTo(Invoice::class, 'invoice_code', 'code');
  }
}
