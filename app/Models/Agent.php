<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Agent extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $guard = 'agent'; 

    protected $table = 'agents';

    protected $fillable = [
        'agency_id',     
        'name',
        'email',
        'password',
        'address_line1',
        'address_line2',
        'state',
        'city',
        'zipcode',
        'phone',
        'status',
        'plan_id',
        'plan_start_date',
        'plan_end_date',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
     public function isIndependent()
    {
        return is_null($this->agency_id);
    }

    public function getFullAddressAttribute()
    {
        $address = $this->address_line1;
        if ($this->address_line2) {
            $address .= ', ' . $this->address_line2;
        }
        $address .= ', ' . $this->city . ', ' . $this->state . ' ' . $this->zipcode;
        return $address;
    }

    // Relationship methods for dashboard functionality
    public function hotLeads()
    {
        return $this->hasMany(HotLead::class, 'agent_id');
    }

    public function bookingAppraisals()
    {
        return $this->hasMany(BookingAppraisal::class, 'agent_id');
    }

    public function conductAppraisals()
    {
        return $this->hasMany(ConductAppraisal::class, 'agent_id');
    }

    public function justListed()
    {
        return $this->hasMany(JustListed::class, 'agent_id');
    }
    public function agency()
    {
        return $this->belongsTo(User::class, 'agency_id');
    }

    public function isActive()
    {
        return $this->status === 'active';
    }

    public function isPending()
    {
        return $this->status === 'pending';
    }
    
}
