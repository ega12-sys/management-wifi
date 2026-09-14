<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
  protected $fillable = [
    'code',
    'name',
    'package_type_code',
    'speed',
    'price',
    'description',
    'status'
  ];

  public function getRouteKeyName(): string
  {
    return 'code';
  }

  public function subcriptions()
  {
    return $this->hasMany(Subscription::class, 'package_code', 'code');
  }

  public function packageType()
  {
    return $this->belongsTo(PackageType::class, 'package_type_code', 'code');
  }
}
