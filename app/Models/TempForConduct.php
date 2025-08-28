<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TempForConduct extends Model
{
    use HasFactory;

    protected $table = 'temp_for_conduct';

    protected $fillable = [
        'agent_id',
        'name',
        'type',
        'subject',
        'content',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function agent()
    {
        return $this->belongsTo(Agent::class);
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeByType($query, $type)
    {
        return $query->where('type', $type);
    }

    public function scopeByAgent($query, $agentId = null)
    {
        return $query->where('agent_id', $agentId ?? auth()->guard('agent')->user()->id);
    }
}