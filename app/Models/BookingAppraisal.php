<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookingAppraisal extends Model
{
    use HasFactory;
protected $table="booking_appraisals";
    protected $fillable = [
        'hot_lead_id',
        'agency_id',
        'agent_id',
        'address',
        'property_type',
        'bedrooms',
        'bathrooms',
        'living_areas',
        'study',
        'under_cover_parking',
        'condition',
        'what_was_updated',
        'land_size',
        'vendor1_first_name',
        'vendor1_last_name',
        'vendor1_mobile',
        'vendor1_email',
        'vendor2_first_name',
        'vendor2_last_name',
        'vendor2_mobile',
        'vendor2_email',
        'appointment_date',
        'appointment_time',
        'lead_source',
        'lead_source_notes',
        'category',
        'is_vendor_selling',
        'moving_to',
        'when_listing',
        'send_confirmation_sms',
        'send_confirmation_email',
        'message_preview',
        'save_to_crm',
        'comparable_sales',
        'added_to_calendar',
        'additional_notes',
        'is_draft',
        'converted_to_conduct_appraisal',
        'under_cover_parking_type'
    ];

    public function agency()
    {
        return $this->belongsTo(User::class, 'agency_id');
    }

    public function agent()
    {
        return $this->belongsTo(Agent::class, 'agent_id');
    }
}