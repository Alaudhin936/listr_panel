<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JustListed extends Model
{
    use HasFactory;
protected $table="just_listed";
    protected $fillable = [
        'hotleads_id',
        'agent_id',
        'agency_id',
        
        // Vendor 1
        'vendor1_first_name',
        'vendor1_last_name',
        'vendor1_mobile',
        'vendor1_email',
        'vendor1_address',
        
        // Vendor 2
        'has_additional_vendor',
        'vendor2_first_name',
        'vendor2_last_name',
        'vendor2_mobile',
        'vendor2_email',
        
        // Main point of contact
        'main_contact',
        'main_contact_first_name',
        'main_contact_last_name',
        'main_contact_mobile',
        'main_contact_email',
        
        // Campaign Details
        'method_of_sale',
        'auction_date',
        'first_open_date',
        'expressions_closing_date',
        'other_method_details',
        'potential_auction_discussed',
        
        // Display Order of Agents
        'first_agent',
        'first_agent_other',
        'second_agent',
        'second_agent_other',
        'has_third_agent',
        'third_agent',
        'third_agent_other',
        
        // Privacy Consent
        'privacy_consent',
        
        // Photography Services
        'photography_services',
        'other_photography_requirements',
        'photography_supplier',
        
        // Copywriting Services
        'copywriting_services',
        'copywriting_supplier',
        
        // Floorplan Services
        'floorplan_services',
        'floorplan_supplier',
        
        // Other Marketing Services
        'other_marketing_required',
        'other_marketing_details',
        
        // Other Suppliers
        'other_supplier_needed',
        'supplier_name',
        'supplier_category',
        'supplier_requirements',
        'supplier_mobile',
        'supplier_email',
        'supplier_contact_method',
        
        // Appointment Dates
        'appointment_schedule_options',
        'all_appointments_date',
        'photography_date',
        'video_date',
        'custom_booking_instructions',
        'proofs_destination',
        
        // Property Access Details
        'occupancy_status',
        'renters_name',
        'renters_phone',
        'property_access',
        'other_access_arrangements',
        'keysafe_type',
        'keysafe_code',
        'keysafe_location',
        'other_keysafe_location',
        'alarm_system',
        'alarm_instructions',
        'additional_notes',
        
        // Trades
        'trades_no_access',
        'trades_require_access',
        'other_trades_needed',
        'trades_contact_method',
        'vacant_access_instructions',
        'painting_notes',
        'gardening_notes',
        
        // Agent Controls
        'listing_status',
        'open_home_attendance',
        'assign_task',
        'task_template',
        'task_message',
        'task_recipient',
        'task_method',
        'assign_additional_task',
        'additional_task_template',
        'additional_task_message',
        'additional_task_recipient',
        'additional_task_method',
    ];

    protected $casts = [
        'photography_services' => 'array',
        'copywriting_services' => 'array',
        'floorplan_services' => 'array',
        'appointment_schedule_options' => 'array',
        'trades_no_access' => 'array',
        'trades_require_access' => 'array',
        'has_additional_vendor' => 'boolean',
        'has_third_agent' => 'boolean',
        'privacy_consent' => 'boolean',
        'other_marketing_required' => 'boolean',
        'other_supplier_needed' => 'boolean',
        'assign_task' => 'boolean',
        'assign_additional_task' => 'boolean',
        'auction_date' => 'date',
        'first_open_date' => 'date',
        'expressions_closing_date' => 'date',
        'all_appointments_date' => 'date',
        'photography_date' => 'date',
        'video_date' => 'date',
    ];

    // Relationships
    public function hotLead()
    {
        return $this->belongsTo(HotLead::class, 'hotleads_id');
    }

// In JustListed model
public function agent()
{
    return $this->belongsTo(Agent::class);
}

public function agency()
{
    return $this->belongsTo(User::class);
}
}