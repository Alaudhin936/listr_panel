<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TradePerson extends Model
{
    use HasFactory;
protected $table="trade_persons";
    protected $fillable = [
        'agent_id',
        'name',
        'profession',
        'email',
        'phone',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeByProfession($query, $profession)
    {
        return $query->where('profession', $profession);
    }
}