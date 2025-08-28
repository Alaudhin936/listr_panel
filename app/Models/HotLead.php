<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HotLead extends Model
{
    use HasFactory;

    protected $fillable = [
        'agent_id',
        'agency_id',
        'vendor_first_name',
        'vendor_last_name',
        'vendor_mobile',
        'vendor_email',
        'vendor_address',
        'category',
        'quick_notes',
        'lead_source',
        'selected_tradespeople',
        'tradesperson_contact_option',
        'privacy_consent',
        'followup_sms_template',
        'sms_preview',
        'followup_email_template',
        'is_draft',
        'converted_to_booking_appraisal'
    ];

    protected $casts = [
        'selected_tradespeople' => 'array',
        'privacy_consent' => 'boolean',
         'converted_to_booking_appraisal' => 'boolean'
    ];

   public function agent()
{
    return $this->belongsTo(Agent::class, 'agent_id', 'id');
}
public function followupEmailTemplate()
{
    return $this->belongsTo(Template::class, 'followup_email_template_id');
}

public function followupSmsTemplate()
{
    return $this->belongsTo(Template::class, 'followup_sms_template_id');
}

}