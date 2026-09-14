<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PackageType extends Model
{
  use HasFactory;

  protected $fillable = [
    'code',
    'description',
  ];

  public function getRouteKeyName(): string
  {
    return 'code';
  }

  public function packages()
  {
    return $this->hasMany(Package::class, 'package_type_code', 'code');
  }
}
