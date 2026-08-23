<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    public function customers()
    {
        return $this->hasMany(Customer::class, 'package_code', 'code');
    }

    public function packageType()
    {
        require $this->belongsTo(PackageType::class, 'package_type_code', 'code');
    }
}
