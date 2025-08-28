<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Plan extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'type',
        'price',
        'duration_days',
        'max_agents',
        'is_active',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'duration_days' => 'integer',
        'max_agents' => 'integer',
        'is_active' => 'boolean',
    ];

    protected $dates = [
        'deleted_at'
    ];

    /**
     * Scope to get only active plans
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope to get plans by type
     */
    public function scopeByType($query, $type)
    {
        return $query->where('type', $type);
    }

    /**
     * Get formatted price in AUD
     */
    public function getFormattedPriceAttribute()
    {
        return 'A$' . number_format($this->price, 2);
    }

    /**
     * Get duration in human readable format
     */
    public function getFormattedDurationAttribute()
    {
        $days = $this->duration_days;
        
        if ($days === 30) {
            return '1 Month';
        } elseif ($days === 365) {
            return '1 Year';
        } elseif ($days === 7) {
            return '1 Week';
        } elseif ($days % 30 === 0) {
            $months = $days / 30;
            return $months . ($months === 1 ? ' Month' : ' Months');
        } elseif ($days % 365 === 0) {
            $years = $days / 365;
            return $years . ($years === 1 ? ' Year' : ' Years');
        } else {
            return $days . ($days === 1 ? ' Day' : ' Days');
        }
    }

    /**
     * Get status badge HTML
     */
    public function getStatusBadgeAttribute()
    {
        if ($this->is_active) {
            return '<span class="badge bg-success">Active</span>';
        } else {
            return '<span class="badge bg-danger">Inactive</span>';
        }
    }

    /**
     * Get max agents display text
     */
    public function getMaxAgentsDisplayAttribute()
    {
        if ($this->type === 'agent') {
            return 'N/A';
        }
        
        return $this->max_agents ? $this->max_agents : 'Unlimited';
    }

    /**
     * Check if plan is for agencies
     */
    public function isAgencyPlan()
    {
        return $this->type === 'agency';
    }

    /**
     * Check if plan is for agents
     */
    public function isAgentPlan()
    {
        return $this->type === 'agent';
    }

    /**
     * Get plan features based on type and attributes
     */
    public function getFeaturesAttribute()
    {
        $features = [];
        
        // Common features
        $features[] = $this->formatted_duration . ' access';
        
        if ($this->isAgencyPlan()) {
            if ($this->max_agents) {
                $features[] = 'Up to ' . $this->max_agents . ' agents';
            } else {
                $features[] = 'Unlimited agents';
            }
            $features[] = 'Agency dashboard access';
            $features[] = 'Agent management';
            $features[] = 'Reports and analytics';
        } else {
            $features[] = 'Individual agent account';
            $features[] = 'Client management';
            $features[] = 'Lead tracking';
        }
        
        return $features;
    }

    /**
     * Calculate plan end date from start date
     */
    public function calculateEndDate($startDate = null)
    {
        $startDate = $startDate ? \Carbon\Carbon::parse($startDate) : now();
        return $startDate->addDays($this->duration_days);
    }

    /**
     * Check if plan has unlimited agents
     */
    public function hasUnlimitedAgents()
    {
        return $this->isAgencyPlan() && is_null($this->max_agents);
    }

    /**
     * Get price per day
     */
    public function getPricePerDayAttribute()
    {
        return round($this->price / $this->duration_days, 2);
    }

    // Uncomment these when you implement subscriptions
    /*
    public function subscriptions()
    {
        return $this->hasMany(Subscription::class);
    }

    public function agencies()
    {
        return $this->hasManyThrough(Agency::class, Subscription::class);
    }

    public function agents()
    {
        return $this->hasManyThrough(Agent::class, Subscription::class);
    }
    */
}