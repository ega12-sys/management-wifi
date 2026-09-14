<?php

namespace App\Models;

use App\Models\Customer;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
  protected $fillable = [
    'code',
    'Tgl',
    'customer_code',
    'subscription_code',
    'tgl_invoice',
    'tgl_jatuh_tempo',
    'total_amount',
    'status',
  ];

  public function getRouteKeyName()
  {
    return 'code';
  }

  public function customer()
  {
    return $this->belongsTo(Customer::class, 'customer_code', 'code');
  }

  public function subscription()
  {
    return $this->belongsTo(Subscription::class, 'subscription_code', 'code');
  }

  public function payments()
  {
    return $this->hasMany(Payment::class, 'payment_code', 'code');
  }
}
