<?php

namespace App\Models;

//use App\Models\Package;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
  protected $fillable = [
    'code',
    'name',
    'phone',
    'email',
    'address',
    'status',
    'installation_date'
  ];

  public function getRouteKeyName(): string
  {
    return 'code';
  }

  public function subcriptions()
  {
    return $this->hasMany(Subscription::class, 'customer_code', 'code');
  }

  public function invoices()
  {
    return $this->hasMany(Invoice::class, 'customer_code', 'code');
  }
}
