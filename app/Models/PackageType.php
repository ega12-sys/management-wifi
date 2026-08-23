<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PackageType extends Model
{
    public function packages()
    {
        return $this->hasMany(Package::class, 'package_type_code', 'code');
    }
}
