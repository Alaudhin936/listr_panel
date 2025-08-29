<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PackageService extends Model
{
    use HasFactory;

    protected $fillable = [
        'service_catagory','services','package_id','supplier_id','agent_id',
        'booking_date'
    ];
}
