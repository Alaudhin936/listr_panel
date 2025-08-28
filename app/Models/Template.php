<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Template extends Model
{
    use HasFactory;

    protected $fillable = [
        'agent_id',
        'name',
        'type',
        'content',
        'subject',
        'is_active'
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function agent()
    {
        return $this->belongsTo(Agent::class);
    }

    public function scopeEmail($query)
    {
        return $query->where('type', 'email');
    }

    public function scopeSms($query)
    {
        return $query->where('type', 'sms');
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}