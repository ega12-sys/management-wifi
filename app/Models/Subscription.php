<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
  protected $fillable = [
    'code',
    'customer_code',
    'package_code',
    'tgl_mulai',
    'tgl_akhir',
    'price',
    'status',
  ];

  public function getRouteKeyName()
  {
    return 'code';
  }

  public function package()
  {
    return $this->belongsTo(Package::class, 'package_code', 'code');
  }

  public function customer()
  {
    return $this->belongsTo(Customer::class, 'customer_code', 'code');
  }

  public function invoices()
  {
    return $this->hasMany(Invoice::class, 'subscription_code', 'code');
  }
}
