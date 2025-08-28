<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookingAppraisal extends Model
{
    use HasFactory;
    protected $table = "booking_appraisals";
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
        'vendor_moving_to',
        'property_listed_when',
        'category',
        'is_vendor_selling',
        'moving_to',
        'comparable_types',
        'comparable_notes',
        'who_is_preparing',
        'comparable_date_range',
        'when_listing',
        'send_confirmation_sms',
        'send_confirmation_email',
        'message_preview',
        'someone_email',
        'someone_mobile',
        'someone_first_name',
        'someone_last_name',
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
