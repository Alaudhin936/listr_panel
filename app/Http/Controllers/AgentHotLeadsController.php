<?php

namespace App\Http\Controllers;

use App\Models\HotLead;
use App\Models\Template;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class AgentHotLeadsController extends Controller
{
   public function index()
    {
        if (request()->ajax()) {
            $agent = Auth::guard('agent')->user();
            
            $hotLeads = HotLead::where('agent_id', $agent->id)
                            ->select([
                                'id',
                                'vendor_first_name',
                                'vendor_last_name',
                                'vendor_mobile',
                                'vendor_email',
                                'vendor_address',
                                'category',
                                'lead_source',
                                'converted_to_booking_appraisal',
                                'created_at',
                                'updated_at'
                            ])
                            ->latest();
            
            // Date range filter
            if (request()->has('start_date') && request()->start_date != '') {
                $hotLeads->whereDate('created_at', '>=', request()->start_date);
            }
            
            if (request()->has('end_date') && request()->end_date != '') {
                $hotLeads->whereDate('created_at', '<=', request()->end_date);
            }
            
            return DataTables::of($hotLeads)
                ->addColumn('vendor_name', function($hotLead) {
                    return $hotLead->vendor_first_name . ' ' . $hotLead->vendor_last_name;
                })
                ->addColumn('vendor_contact', function($hotLead) {
                    return $hotLead->vendor_mobile;
                })
             ->addColumn('action', function($hotLead) {
    $isConverted = $hotLead->converted_to_booking_appraisal == 1;

    // View button (always active)
    $viewBtn = '<button class="action-btn btn-outline-secondary btn-view view-btn" 
                        data-id="' . $hotLead->id . '" 
                        style="color:black;border:1px solid black;">
                    <i class="fas fa-eye me-1"></i>
                </button>';

    // Edit button
    $editBtn = '<a style="color:black;border:1px solid black;" 
                    href="'.($isConverted ? '#' : route('agent.hotleads.edit', $hotLead->id)).'" 
                    class="action-btn btn btn-outline-primary '.($isConverted ? 'disabled' : '').'" 
                    title="Edit">
                    <i class="fas fa-edit"></i>
                </a>';

    // Delete button
    $deleteBtn = '<button class="action-btn btn-outline-danger btn-delete delete-btn '.($isConverted ? 'disabled' : '').'" 
                          data-id="' . $hotLead->id . '" 
                          style="color:black;border:1px solid black;" 
                          '.($isConverted ? 'disabled' : '').'>
                      <i class="fas fa-trash me-1"></i>
                  </button>';
$bookBtn = '<a class="action-btn book-btn '.($isConverted ? 'disabled' : '').'" 
                href="'.($isConverted ? '#' : route('agent.hotleads.booking-appraisal.create', $hotLead->id)).'" 
                title="Create Booking Appraisal" 
                style="color:black; background:none; border:none;border:1px solid black;">
                <i class="fas fa-arrow-right"></i>
           </a>';


    return '
        <div class="action-buttons">
            '.$viewBtn.'
            '.$editBtn.'
            '.$deleteBtn.'
            '.$bookBtn.'
        </div>
    ';
})

                ->rawColumns(['category', 'action'])
                ->make(true);
        }

        return view('agents.hotleads.index');
    }


    public function changeStatus(Request $request, HotLead $hotlead)
    {
        $request->validate([
            'status' => 'required|in:New,Follow Up,Converted'
        ]);

        // Verify the hot lead belongs to the authenticated agent
        if ($hotlead->agent_id !== Auth::guard('agent')->id()) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized action!'
            ], 403);
        }

        $hotlead->update(['status' => $request->status]);

        return response()->json([
            'success' => true,
            'message' => 'Status updated successfully!'
        ]);
    }

 public function create()
{
    $smsTemplates = Template::where('type', 'sms')
        ->where('is_active', true)
        ->get();
    
    $emailTemplates = Template::where('type', 'email')
        ->where('is_active', true)
        ->get();
    
    return view('agents.hotleads.create', [
        'smsTemplates' => $smsTemplates,    
        'emailTemplates' => $emailTemplates
    ]);
}

public function store(Request $request)
{
    $request->validate([
        'vendor_first_name' => 'required|string|max:255',
        'vendor_last_name' => 'required|string|max:255',
        'vendor_mobile' => 'required|string|max:20',
        'vendor_email' => 'nullable|email|max:255',
        'vendor_address' => 'nullable|string',
        'category' => 'required|in:hot,warm,cold',
        'quick_notes' => 'nullable|string',
        'lead_source' => 'nullable|string|max:255',
        'selected_tradespeople' => 'nullable|array',
        'tradesperson_contact_option' => 'nullable|string|max:255',
        'privacy_consent' => 'nullable|boolean',
        'followup_sms_template' => 'nullable|exists:templates,id',
        'sms_preview' => 'nullable|string',
        'followup_email_template' => 'nullable|exists:templates,id',
        'email_subject' => 'nullable|string',
        'email_preview' => 'nullable|string'
    ]);

    try {
        $agent = Auth::guard('agent')->user();

        // Create the hot lead
        $hotLead = HotLead::create([
            'agent_id' => $agent->id,
            'agency_id' => $agent->agency_id,
            'vendor_first_name' => $request->vendor_first_name,
            'vendor_last_name' => $request->vendor_last_name,
            'vendor_mobile' => $request->vendor_mobile,
            'vendor_email' => $request->vendor_email,
            'vendor_address' => $request->vendor_address,
            'category' => $request->category,
            'quick_notes' => $request->quick_notes,
            'lead_source' => $request->lead_source,
            'selected_tradespeople' => $request->selected_tradespeople,
            'tradesperson_contact_option' => $request->tradesperson_contact_option,
            'privacy_consent' => $request->has('privacy_consent'),
            'followup_sms_template' => $request->followup_sms_template,
            'sms_preview' => $request->sms_preview,
            'followup_email_template' => $request->followup_email_template,
        ]);

        $smsSuccess = false;
        if ($request->followup_sms_template && $request->vendor_mobile && $request->sms_preview) {
            try {
                $smsSuccess = $this->sendHotLeadSMS($request->vendor_mobile, $request->sms_preview);
                
                Log::info('Hot Lead SMS Sent', [
                    'hot_lead_id' => $hotLead->id,
                    'vendor_mobile' => $request->vendor_mobile,
                    'success' => $smsSuccess
                ]);
                
            } catch (\Exception $e) {
                Log::error('Hot Lead SMS Failed', [
                    'hot_lead_id' => $hotLead->id,
                    'vendor_mobile' => $request->vendor_mobile,
                    'error' => $e->getMessage()
                ]);
            }
        }

        $emailSuccess = false;
        if ($request->followup_email_template && $request->vendor_email) {
            try {
                // Fetch template content from DB
                $template = DB::table('templates')->find($request->followup_email_template);
                $emailContent = $template ? $template->content : $request->email_preview;

                $emailSuccess = $this->sendHotLeadEmail(
                    $request->vendor_email,
                    $request->email_subject ?: 'Follow-up Information',
                    $emailContent,
                    $request->vendor_first_name . ' ' . $request->vendor_last_name
                );
                
                Log::info('Hot Lead Email Sent', [
                    'hot_lead_id' => $hotLead->id,
                    'vendor_email' => $request->vendor_email,
                    'success' => $emailSuccess
                ]);
                
            } catch (\Exception $e) {
                Log::error('Hot Lead Email Failed', [
                    'hot_lead_id' => $hotLead->id,
                    'vendor_email' => $request->vendor_email,
                    'error' => $e->getMessage()
                ]);
            }
        }

        $message = 'Hot lead created successfully!';
        $messagingStatus = [];
        
        if ($request->followup_sms_template && $request->vendor_mobile) {
            $messagingStatus[] = $smsSuccess ? 'SMS sent successfully' : 'SMS sending failed';
        }
        
        if ($request->followup_email_template && $request->vendor_email) {
            $messagingStatus[] = $emailSuccess ? 'Email sent successfully' : 'Email sending failed';
        }
        
        if (!empty($messagingStatus)) {
            $message .= ' ' . implode('. ', $messagingStatus) . '.';
        }

        return response()->json([
            'success' => true,
            'message' => $message,
            'redirect' => route('agent.hotleads.index'),
            'sms_sent' => $smsSuccess,
            'email_sent' => $emailSuccess
        ]);

    } catch (\Exception $e) {
        Log::error('Hot Lead Creation Failed', [
            'error' => $e->getMessage(),
            'vendor_mobile' => $request->vendor_mobile,
            'vendor_email' => $request->vendor_email
        ]);

        return response()->json([
            'success' => false,
            'message' => 'Failed to create hot lead. Please try again.'
        ], 500);
    }
}

/**
 * Send SMS to hot lead vendor
 */
private function sendHotLeadSMS($phone, $message)
{
    try {
        $username = config('services.clicksend.username');
        $apiKey = config('services.clicksend.api_key');
        $senderId = env('CLICKSEND_FROM', 'LISTR');
        
        $formattedPhone = $this->formatPhoneNumber($phone);

        Log::info('Sending Hot Lead SMS', [
            'to' => $formattedPhone,
            'sender' => $senderId,
            'username' => $username,
            'apiKey_set' => $apiKey ? true : false
        ]);

        $response = Http::withBasicAuth($username, $apiKey)
            ->timeout(30)
            ->post('https://rest.clicksend.com/v3/sms/send', [
                'messages' => [
                    [
                        'to' => $formattedPhone,
                        'body' => $message,
                        'from' => $senderId
                    ]
                ]
            ]);

        if (!$response->successful()) {
            Log::error('ClickSend SMS API Error', [
                'status' => $response->status(),
                'response' => $response->json()
            ]);
            throw new \Exception('Failed to send SMS via ClickSend');
        }

        $data = $response->json();
        Log::info('ClickSend SMS Response', $data);

        if (isset($data['data']['messages'][0]['status']) && 
            $data['data']['messages'][0]['status'] === 'INVALID_SENDER_ID') {
            
            Log::warning('Invalid Sender ID detected, retrying with blank sender');

            $response = Http::withBasicAuth($username, $apiKey)
                ->timeout(30)
                ->post('https://rest.clicksend.com/v3/sms/send', [
                    'messages' => [
                        [
                            'to' => $formattedPhone,
                            'body' => $message,
                            'from' => ''
                        ]
                    ]
                ]);

            if (!$response->successful()) {
                throw new \Exception('Failed to send SMS after fallback');
            }
        }

        return true;

    } catch (\Exception $e) {
        Log::error('Hot Lead SMS Exception: ' . $e->getMessage());
        return false;
    }
}

/**
 * Send Email to hot lead vendor via ClickSend
 */
private function sendHotLeadEmail($email, $subject, $content, $vendorName = '')
{
    try {
        $username = config('services.clicksend.username');
        $apiKey = config('services.clicksend.api_key');
        $emailAddressId = config('services.clicksend.email_address_id');

        Log::info('Sending Hot Lead Email', [
            'to' => $email,
            'subject' => $subject,
            'username' => $username,
            'api_key_set' => !empty($apiKey),
            'email_address_id' => $emailAddressId
        ]);

        $htmlContent = $this->createHotLeadEmailHTML($content, $subject, $vendorName);

        $payload = [
            'to' => [
                ['email' => $email]
            ],
            'subject' => $subject,
            'body' => $htmlContent,
            'from' => [
                'email_address_id' => (int)$emailAddressId,
                'name' => 'Agent Portal'
            ]
        ];

        $response = Http::withBasicAuth($username, $apiKey)
            ->timeout(30)
            ->post('https://rest.clicksend.com/v3/email/send', $payload);

        $result = $response->json();
        Log::info('ClickSend Email API Response', $result);

        if ($response->failed()) {
            Log::error('ClickSend Email API Error', [
                'status' => $response->status(),
                'response' => $result
            ]);
            throw new \Exception('Failed to send Email via ClickSend: ' . json_encode($result));
        }

        return true;

    } catch (\Exception $e) {
        Log::error('Hot Lead Email Exception: ' . $e->getMessage());
        return false;
    }
}

/**
 * Create HTML email template for hot lead
 */
private function createHotLeadEmailHTML($content, $subject, $vendorName = '')
{
    $greeting = $vendorName ? "Hello {$vendorName}," : "Hello,";
    $formattedContent = nl2br($content);
    
    return "
    <!DOCTYPE html>
    <html lang='en'>
    <head>
        <meta charset='UTF-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
        <title>{$subject}</title>
        <style>
            body { margin: 0; padding: 0; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background-color: #f5f5f5; }
            .container { max-width: 600px; margin: 0 auto; background-color: #ffffff; }
            .header { background: linear-gradient(135deg, #28a745 0%, #20c997 100%); padding: 30px 20px; text-align: center; }
            .header h1 { color: #ffffff; margin: 0; font-size: 24px; font-weight: 600; }
            .content { padding: 30px; }
            .greeting { font-size: 18px; color: #333333; margin-bottom: 20px; }
            .message { font-size: 16px; color: #555555; line-height: 1.6; margin-bottom: 20px; }
            .footer { background-color: #f8f9fa; padding: 20px; text-align: center; border-top: 1px solid #e9ecef; }
            .footer p { margin: 5px 0; color: #6c757d; font-size: 14px; }
        </style>
    </head>
    <body>
        <div class='container'>
            <div class='header'>
                <h1>{$subject}</h1>
            </div>
            <div class='content'>
                <div class='greeting'>{$greeting}</div>
                <div class='message'>{$formattedContent}</div>
            </div>
            <div class='footer'>
                <p><strong>Agent Portal Team</strong></p>
                <p>This is an automated message from your real estate agent.</p>
                <p>&copy; " . date('Y') . " All rights reserved.</p>
            </div>
        </div>
    </body>
    </html>";
}

/**
 * Format phone number for international use
 */
private function formatPhoneNumber($phone)
{
    $phone = preg_replace('/[^0-9+]/', '', $phone);
    
    if (!str_starts_with($phone, '+')) {
        if (str_starts_with($phone, '61')) {
            $phone = '+' . $phone;
        } elseif (str_starts_with($phone, '0')) {
            $phone = '+61' . substr($phone, 1);
        } else {
            $phone = '+61' . $phone;
        }
    }
    
    return $phone;
}

public function show(Request $request, HotLead $hotLead)
{
    if ($hotLead->agent_id !== Auth::guard('agent')->id()) {
        abort(403, 'Unauthorized action.');
    }

    $hotLead->load([
        'followupEmailTemplate:id,name,content', 
        'followupSmsTemplate:id,name,content'
    ]);

    if ($request->ajax()) {
        return response()->json([
            'success' => true,
            'data' => [
                'id' => $hotLead->id,
                'vendor_first_name' => $hotLead->vendor_first_name,
                'vendor_last_name' => $hotLead->vendor_last_name,
                'vendor_mobile' => $hotLead->vendor_mobile,
                'vendor_email' => $hotLead->vendor_email,
                'vendor_address' => $hotLead->vendor_address,
                'category' => $hotLead->category,
                'agent' => $hotLead->agent ? ['name' => $hotLead->agent->name] : null,
                'lead_source' => $hotLead->lead_source,
                'created_at' => $hotLead->created_at,
                'quick_notes' => $hotLead->quick_notes,
                'followup_email_template' => $hotLead->followupEmailTemplate ? $hotLead->followupEmailTemplate->content : null,
                'followup_sms_template' => $hotLead->followupSmsTemplate ? $hotLead->followupSmsTemplate->content : null,
            ]
        ]);
    }

    return view('agents.hotleads.show', compact('hotLead'));
}


    public function edit(HotLead $hotLead)
    {
        if ($hotLead->agent_id !== Auth::guard('agent')->id()) {
            abort(403, 'Unauthorized action.');
        }

        return view('agents.hotleads.edit', compact('hotLead'));
    }

    public function update(Request $request, HotLead $hotLead)
    {
        if ($hotLead->agent_id !== Auth::guard('agent')->id()) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized action!'
            ], 403);
        }

        $request->validate([
            'vendor_first_name' => 'required|string|max:255',
            'vendor_last_name' => 'required|string|max:255',
            'vendor_mobile' => 'required|string|max:20',
            'vendor_email' => 'nullable|email|max:255',
            'vendor_address' => 'nullable|string',
            'category' => 'required|in:hot,warm',
            'quick_notes' => 'nullable|string',
            'lead_source' => 'nullable|string|max:255',
            'selected_tradespeople' => 'nullable|array',
            'tradesperson_contact_option' => 'nullable|string|max:255',
            'privacy_consent' => 'nullable|boolean',
            'followup_sms_template' => 'nullable|string|max:255',
            'sms_preview' => 'nullable|string',
            'followup_email_template' => 'nullable|string|max:255'
        ]);

        $hotLead->update([
            'vendor_first_name' => $request->vendor_first_name,
            'vendor_last_name' => $request->vendor_last_name,
            'vendor_mobile' => $request->vendor_mobile,
            'vendor_email' => $request->vendor_email,
            'vendor_address' => $request->vendor_address,
            'category' => $request->category,
            'quick_notes' => $request->quick_notes,
            'lead_source' => $request->lead_source,
            'selected_tradespeople' => $request->selected_tradespeople,
            'tradesperson_contact_option' => $request->tradesperson_contact_option,
            'privacy_consent' => $request->has('privacy_consent'),
            'followup_sms_template' => $request->followup_sms_template,
            'sms_preview' => $request->sms_preview,
            'followup_email_template' => $request->followup_email_template
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Hot lead updated successfully!',
            'redirect' => route('agent.hotleads.index')
        ]);
    }

    public function destroy(HotLead $hotLead)
    {
        if ($hotLead->agent_id !== Auth::guard('agent')->id()) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized action!'
            ], 403);
        }

        $hotLead->delete();
        
        return response()->json([
            'success' => true,
            'message' => 'Hot lead deleted successfully!'
        ]);
    }
}