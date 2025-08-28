<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConductAppraisal extends Model
{
    use HasFactory;

    protected $fillable = [
        'agent_id',
        'agency_id',
        'hotleads_id',
        'booking_appraisal_id',
        
        // Vendor Information
        'vendor1_first_name',
        'vendor1_last_name',
        'vendor1_mobile',
        'vendor1_email',
        'vendor1_address',
        'has_additional_vendor',
        'vendor2_first_name',
        'vendor2_last_name',
        'vendor2_mobile',
        'vendor2_email',
        
        // Property Details
        'property_type',
        'property_type_quick',
        'more_property_type',
        'other_property_type',
        'property_type_detailed',
        'property_condition',
        'bedrooms',
        'bathrooms',
        'living_areas',
        'toilets',
        'car_spaces',
        'kitchen_condition',
        'kitchen_details',
        'year_built',
        'exterior_material',
        'storeys',
        'land_size',
        'trade_persons',
        'land_size_quick',
        'more_bedrooms',
        'more_bathrooms',
        'more_living_areas',
        
        // Additional Info Section
        'agent_notes',
        'property_photos',
        
        // Detailed Section Arrays
        'bedroom_details',
        'bathroom_details',
        'living_area_details',
        
        // Heating & Cooling
        'heating',
        'cooling',
        'split_systems',
        
        // Features
        'extra_features',
        'outdoor_features',
        'outdoor_features_detailed',
        
        // Meeting Summary
        'sale_method',
        'key_dates_discussed',
        'auction_date',
        'preferred_launch',
        'first_open',
        'commission_discussed',
        'commission_details',
        'marketing_discussed',
        'other_notes',
        
        // Contacts
        'professional_contacts',
        
        // Smart Send
        'follow_up_sms',
        'sms_message',
        'follow_up_email',
        'send_proposal',
        'include_price',
        'price_information',
        'proposal_method',
        'comparable_sales',
        'personalized_message',
        'vendor_motivation',
        
        // Photos
        'photos',
        'comparable_photos',
        
        // Status
        'converted_to_just_listed'
    ];

    protected $casts = [
        'kitchen_details' => 'array',
        'property_photos' => 'array',
        'photos' => 'array',
        'comparable_photos' => 'array',
        'heating' => 'array',
        'cooling' => 'array',
        'extra_features' => 'array',
        'outdoor_features' => 'array',
        'outdoor_features_detailed' => 'array',
        'marketing_discussed' => 'array',
        'professional_contacts' => 'array',
        'comparable_sales' => 'array',
        'bedroom_details' => 'array',
        'bathroom_details' => 'array',
        'living_area_details' => 'array',
        'has_additional_vendor' => 'boolean',
        'key_dates_discussed' => 'boolean',
        'commission_discussed' => 'boolean',
        'send_proposal' => 'boolean',
        'include_price' => 'boolean',
        'converted_to_just_listed' => 'boolean',
        'auction_date' => 'date',
        'preferred_launch' => 'date',
        'first_open' => 'date',
        'trade_persons'=>'array'
    ];

    public function agent()
    {
        return $this->belongsTo(Agent::class);
    }

    public function agency()
    {
        return $this->belongsTo(User::class, 'agency_id');
    }

    public function bookingAppraisal()
    {
        return $this->belongsTo(BookingAppraisal::class);
    }

    public function hotLead()
    {
        return $this->belongsTo(HotLead::class, 'hotleads_id');
    }
    
}