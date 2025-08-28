<?php

namespace App\Http\Controllers;

use App\Models\Agent;
use App\Models\HotLead;
use App\Models\Template;
use App\Models\Tradeperson;
use Illuminate\Http\Request;
use App\Models\TempForConduct;
use App\Models\BookingAppraisal;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class BookingAppraisalController extends Controller
{
    public function createConductAppraisal(BookingAppraisal $bookingAppraisal)
    {
        $bookingData = $bookingAppraisal->toArray();
        $tradePersons = Tradeperson::where('agent_id', auth()->guard('agent')->user()->id)
            ->active()
            ->get();

        $emailTemplates = TempForConduct::where('agent_id', auth()->guard('agent')->user()->id)
            ->active()
            ->byType('email')
            ->get();

        $smsTemplates = TempForConduct::where('agent_id', auth()->guard('agent')->user()->id)
            ->active()
            ->byType('sms')
            ->get();

        return view('agents.conduct-appraisal.create', compact('bookingData', 'bookingAppraisal', 'tradePersons', 'emailTemplates', 'smsTemplates'));
    }
    public function index(Request $request)
    {
        $query = BookingAppraisal::with('agent')
            ->select('*')
            ->where('agent_id', Auth::guard('agent')->user()->id)
            ->latest();

        if (request()->has('start_date') && request()->start_date != '') {
            $query->whereDate('created_at', '>=', request()->start_date);
        }

        if (request()->has('end_date') && request()->end_date != '') {
            $query->whereDate('created_at', '<=', request()->end_date);
        }

        $appraisals = $query->get();

        if ($request->ajax()) {
            return datatables()->of($appraisals)
                ->addColumn('vendor_name', function ($appraisal) {
                    return $appraisal->vendor1_first_name . ' ' . $appraisal->vendor1_last_name;
                })
                ->addColumn('contact_info', function ($appraisal) {
                    return $appraisal->vendor1_mobile . '<br>' . $appraisal->vendor1_email;
                })
                ->addColumn('appointment', function ($appraisal) {
                    if ($appraisal->appointment_date) {
                        return $appraisal->appointment_date . ' ' . $appraisal->appointment_time;
                    }
                    return null;
                })

                ->addColumn('status', function ($appraisal) {
                    return '<span class="badge bg-success">Scheduled</span>';
                })
                ->addColumn('edit_url', function ($appraisal) {
                    return route('agent.booking-appraisals.edit', $appraisal->id);
                })

                ->addColumn('actions', function ($appraisal) {
                    $isConverted = $appraisal->converted_to_conduct_appraisal == 1;

                    $viewBtn = '<button class="action-btn btn-outline-secondary btn-view view-btn"
                    data-id="' . $appraisal->id . '"
                    style="color:black;border:1px solid black;">
                    <i class="fas fa-eye me-1"></i>
                </button>';

                    // Edit button
                    $editBtn = '<a href="' . ($isConverted ? '#' :  route('agent.booking-appraisals.edit', $appraisal->id)) . '"
                   class="action-btn btn btn-outline-primary ' . ($isConverted ? 'disabled' : '') . '"
                   style="color:black;border:1px solid black;"
                   title="Edit">
                   <i class="fas fa-edit"></i>
               </a>';

                    // Delete button
                    $deleteBtn = '<button class="action-btn btn-outline-danger btn-delete delete-btn ' . ($isConverted ? 'disabled' : '') . '"
                      data-id="' . $appraisal->id . '"
                      style="color:black;border:1px solid black;"
                      ' . ($isConverted ? 'disabled' : '') . '>
                      <i class="fas fa-trash me-1"></i>
                  </button>';

                    $conductBtn = '<a href="' . ($isConverted ? '#' : route('agent.booking-appraisals.conduct-appraisal.create', $appraisal->id)) . '"
                   class="action-btn conduct-btn ' . ($isConverted ? 'disabled' : '') . '"
                   title="Conduct Appraisal"
                   style="color:black; background:none; border:none; border:1px solid black;">
                   <i class="fas fa-arrow-right"></i>
              </a>';


                    return '
        <div class="action-buttons">
            ' . $viewBtn . '
            ' . $editBtn . '
            ' . $deleteBtn . '
            ' . $conductBtn . '
        </div>
    ';
                })

                ->rawColumns(['contact_info', 'status', 'actions'])
                ->make(true);
        }

        return view('agents.booking-appraisal.index');
    }

    public function create()
    {
        $smsTemplates = Template::where('type', 'sms')
            ->where('is_active', true)
            ->get();

        $emailTemplates = Template::where('type', 'email')
            ->where('is_active', true)
            ->get();
        $agents = Agent::where('agency_id', Auth::guard('agent')->user()->agency_id)->get();
        return view('agents.booking-appraisal.create', compact('agents', 'smsTemplates', 'emailTemplates'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'address' => 'nullable|string',
            'property_type' => 'nullable|string',
            'bedrooms' => 'nullable|integer',
            'bathrooms' => 'nullable|integer',
            'living_areas' => 'nullable|integer',
            'study' => 'nullable',
            'under_cover_parking' => 'nullable|integer',
            'condition' => 'nullable|string',
            'what_was_updated' => 'nullable|string',
            'land_size' => 'nullable|string',
            'vendor1_first_name' => 'nullable|string',
            'vendor1_last_name' => 'nullable|string',
            'vendor1_mobile' => 'nullable|string',
            'vendor1_email' => 'nullable|email',
            'vendor2_first_name' => 'nullable|string',
            'vendor2_last_name' => 'nullable|string',
            'vendor2_mobile' => 'nullable|string',
            'vendor2_email' => 'nullable|email',
            'appointment_date' => 'nullable|date',
            'appointment_time' => 'nullable',
            'lead_source' => 'nullable|string',
            'lead_source_notes' => 'nullable|string',
            'category' => 'nullable|string',
            'is_vendor_selling' => 'nullable|string',
            'moving_to' => 'nullable|string',
            'when_listing' => 'nullable|string',
            'send_confirmation_sms' => 'nullable|string',
            'send_confirmation_email' => 'nullable|string',
            'message_preview' => 'nullable|string',
            'save_to_crm' => 'nullable|string',
            'comparable_sales' => 'nullable|string',
            'additional_notes' => 'nullable|string',
            'under_cover_parking_type' => 'nullable|string',
            'followup_sms_template' => 'nullable|exists:templates,id',
            'sms_preview' => 'nullable|string',
            'followup_email_template' => 'nullable|exists:templates,id',
            'email_subject' => 'nullable|string',
            'email_preview' => 'nullable|string'
        ]);

        try {
            $appraisal = BookingAppraisal::create([
                'hot_lead_id' => $request->hot_lead_id,
                'agency_id' => Auth::guard('agent')->user()->agency_id,
                'agent_id' => Auth::guard('agent')->user()->id,
                'address' => $request->address,
                'property_type' => $request->property_type,
                'bedrooms' => $request->bedrooms,
                'bathrooms' => $request->bathrooms,
                'living_areas' => $request->living_areas,
                'study' => $request->study,
                'under_cover_parking' => $request->under_cover_parking,
                'under_cover_parking_type' => $request->under_cover_parking_type,
                'condition' => $request->condition,
                'what_was_updated' => $request->what_was_updated,
                'land_size' => $request->land_size,
                'vendor1_first_name' => $request->vendor1_first_name,
                'vendor1_last_name' => $request->vendor1_last_name,
                'vendor1_mobile' => $request->vendor1_mobile,
                'property_listed_when' => $request->property_listed_when,
                'vendor_moving_to' => $request->vendor_moving_to,
                'vendor1_email' => $request->vendor1_email,
                'vendor2_first_name' => $request->vendor2_first_name,
                'vendor2_last_name' => $request->vendor2_last_name,
                'vendor2_mobile' => $request->vendor2_mobile,
                'vendor2_email' => $request->vendor2_email,
                'someone_email' => $request->someone_email,
                'someone_first_name' => $request->someone_first_name,
                'someone_last_name' => $request->someone_last_name,
                'someone_mobile' => $request->someone_mobile,
                'appointment_date' => $request->appointment_date,
                'appointment_time' => $request->appointment_time,
                'lead_source' => $request->lead_source,
                'lead_source_notes' => $request->lead_source_notes,
                'category' => $request->category,
                'who_is_preparing' => $request->who_is_preparing,
                'comparable_notes' =>  $request->comparable_notes,
                'comparable_date_range' =>  $request->comparable_date_range,
                'comparable_types' => $request->comparable_types,
                'is_vendor_selling' => $request->is_vendor_selling,
                'moving_to' => $request->moving_to,
                'when_listing' => $request->when_listing,
                'send_confirmation_sms' => $request->send_confirmation_sms,
                'send_confirmation_email' => $request->send_confirmation_email,
                'message_preview' => $request->sms_preview,
                'save_to_crm' => $request->save_to_crm,
                'comparable_sales' => $request->comparable_sales,
                'additional_notes' => $request->additional_notes,
                'followup_sms_template' => $request->followup_sms_template,
                'sms_preview' => $request->sms_preview,
                'followup_email_template' => $request->followup_email_template,
                'email_subject' => $request->email_subject,
                'email_preview' => $request->email_preview,
            ]);

            if ($request->hot_lead_id) {
                HotLead::where('id', $request->hot_lead_id)->update(['converted_to_booking_appraisal' => true]);
            }

            // Send SMS if template selected
            $smsSuccess = false;
            if ($request->followup_sms_template && $request->vendor1_mobile && $request->sms_preview) {
                try {
                    $smsSuccess = $this->sendAppraisalSMS($request->vendor1_mobile, $request->sms_preview);

                    Log::info('Booking Appraisal SMS Sent', [
                        'appraisal_id' => $appraisal->id,
                        'vendor_mobile' => $request->vendor1_mobile,
                        'success' => $smsSuccess
                    ]);
                } catch (\Exception $e) {
                    Log::error('Booking Appraisal SMS Failed', [
                        'appraisal_id' => $appraisal->id,
                        'vendor_mobile' => $request->vendor1_mobile,
                        'error' => $e->getMessage()
                    ]);
                }
            }

            // Send Email if template selected
            $emailSuccess = false;
            if ($request->followup_email_template && $request->vendor1_email) {
                try {
                    // Fetch template content from DB
                    $template = DB::table('templates')->find($request->followup_email_template);
                    $emailContent = $template ? $template->content : $request->email_preview;

                    $emailSuccess = $this->sendAppraisalEmail(
                        $request->vendor1_email,
                        $request->email_subject ?: 'Appointment Confirmation',
                        $emailContent,
                        $request->vendor1_first_name . ' ' . $request->vendor1_last_name
                    );

                    Log::info('Booking Appraisal Email Sent', [
                        'appraisal_id' => $appraisal->id,
                        'vendor_email' => $request->vendor1_email,
                        'success' => $emailSuccess
                    ]);
                } catch (\Exception $e) {
                    Log::error('Booking Appraisal Email Failed', [
                        'appraisal_id' => $appraisal->id,
                        'vendor_email' => $request->vendor1_email,
                        'error' => $e->getMessage()
                    ]);
                }
            }

            $message = 'Booking Appraisal created successfully!';
            $messagingStatus = [];

            if ($request->followup_sms_template && $request->vendor1_mobile) {
                $messagingStatus[] = $smsSuccess ? 'SMS sent successfully' : 'SMS sending failed';
            }

            if ($request->followup_email_template && $request->vendor1_email) {
                $messagingStatus[] = $emailSuccess ? 'Email sent successfully' : 'Email sending failed';
            }

            if (!empty($messagingStatus)) {
                $message .= ' ' . implode('. ', $messagingStatus) . '.';
            }

            return response()->json([
                'success' => true,
                'message' => $message,
                'redirect' => route('agent.booking-appraisals.index'),
                'sms_sent' => $smsSuccess,
                'email_sent' => $emailSuccess
            ]);
        } catch (\Exception $e) {
            Log::error('Booking Appraisal Creation Failed', [
                'error' => $e->getMessage(),
                'vendor_mobile' => $request->vendor1_mobile,
                'vendor_email' => $request->vendor1_email
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Failed to create booking appraisal. Please try again.'
            ], 500);
        }
    }

    /**
     * Send SMS for booking appraisal
     */
    private function sendAppraisalSMS($phone, $message)
    {
        try {
            $username = config('services.clicksend.username');
            $apiKey = config('services.clicksend.api_key');
            $senderId = env('CLICKSEND_FROM', 'LISTR');

            $formattedPhone = $this->formatPhoneNumber($phone);

            Log::info('Sending Booking Appraisal SMS', [
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

            if (
                isset($data['data']['messages'][0]['status']) &&
                $data['data']['messages'][0]['status'] === 'INVALID_SENDER_ID'
            ) {

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
            Log::error('Booking Appraisal SMS Exception: ' . $e->getMessage());
            return false;
        }
    }

    /**
     * Send Email for booking appraisal via ClickSend
     */
    private function sendAppraisalEmail($email, $subject, $content, $vendorName = '')
    {
        try {
            $username = config('services.clicksend.username');
            $apiKey = config('services.clicksend.api_key');
            $emailAddressId = config('services.clicksend.email_address_id');

            Log::info('Sending Booking Appraisal Email', [
                'to' => $email,
                'subject' => $subject,
                'username' => $username,
                'api_key_set' => !empty($apiKey),
                'email_address_id' => $emailAddressId
            ]);

            $htmlContent = $this->createAppraisalEmailHTML($content, $subject, $vendorName);

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
            Log::error('Booking Appraisal Email Exception: ' . $e->getMessage());
            return false;
        }
    }

    /**
     * Create HTML email template for booking appraisal
     */
    private function createAppraisalEmailHTML($content, $subject, $vendorName = '')
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


    public function show(Request $request, BookingAppraisal $bookingAppraisal)
    {
        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'data' => $bookingAppraisal->load('agent')
            ]);
        }

        return view('agents.booking-appraisal.show', compact('bookingAppraisal'));
    }

    public function edit(BookingAppraisal $bookingAppraisal)
    {
        $agents = Agent::where('id', Auth::guard('agent')->user()->id)->get();
        return view('agents.booking-appraisal.edit', compact('bookingAppraisal', 'agents'));
    }

    public function update(Request $request, BookingAppraisal $bookingAppraisal)
    {
        $request->validate([
            'address' => 'nullable|string',
            'property_type' => 'nullable|string',
            'bedrooms' => 'nullable|integer',
            'bathrooms' => 'nullable|integer',
            'living_areas' => 'nullable|integer',
            'study' => 'nullable|integer',
            'under_cover_parking' => 'nullable|integer',
            'condition' => 'nullable|string',
            'what_was_updated' => 'nullable|string',
            'land_size' => 'nullable|string',
            'vendor1_first_name' => 'nullable|string',
            'vendor1_last_name' => 'nullable|string',
            'vendor1_mobile' => 'nullable|string',
            'vendor1_email' => 'nullable|email',
            'vendor2_first_name' => 'nullable|string',
            'vendor2_last_name' => 'nullable|string',
            'vendor2_mobile' => 'nullable|string',
            'vendor2_email' => 'nullable|email',
            'appointment_date' => 'nullable|date',
            'appointment_time' => 'nullable',
            'lead_source' => 'nullable|string',
            'lead_source_notes' => 'nullable|string',
            'category' => 'nullable|string',
            'is_vendor_selling' => 'nullable|string',
            'moving_to' => 'nullable|string',
            'when_listing' => 'nullable|string',
            'send_confirmation_sms' => 'nullable|string',
            'send_confirmation_email' => 'nullable|string',
            'message_preview' => 'nullable|string',
            'save_to_crm' => 'nullable|string',
            'comparable_sales' => 'nullable|string',
            'added_to_calendar' => 'nullable|string',
            'additional_notes' => 'nullable|string',
            'under_cover_parking_type' => 'nullable|string'

        ]);

        $bookingAppraisal->update([
            'agent_id' => Auth::guard('agent')->user()->id, // Fixed: was using agency_id
            'address' => $request->address,
            'property_type' => $request->property_type,
            'bedrooms' => $request->bedrooms,
            'bathrooms' => $request->bathrooms,
            'living_areas' => $request->living_areas,
            'study' => $request->study,
            'under_cover_parking' => $request->under_cover_parking,
            'under_cover_parking_type' => $request->under_cover_parking_type,
            'condition' => $request->condition,
            'what_was_updated' => $request->what_was_updated,
            'land_size' => $request->land_size,
            'vendor1_first_name' => $request->vendor1_first_name,
            'vendor1_last_name' => $request->vendor1_last_name,
            'vendor1_mobile' => $request->vendor1_mobile,
            'vendor1_email' => $request->vendor1_email,
            'vendor2_first_name' => $request->vendor2_first_name,
            'vendor2_last_name' => $request->vendor2_last_name,
            'vendor2_mobile' => $request->vendor2_mobile,
            'vendor2_email' => $request->vendor2_email,
            'appointment_date' => $request->appointment_date,
            'appointment_time' => $request->appointment_time,
            'lead_source' => $request->lead_source,
            'lead_source_notes' => $request->lead_source_notes,
            'category' => $request->category,
            'is_vendor_selling' => $request->is_vendor_selling,
            'moving_to' => $request->moving_to,
            'when_listing' => $request->when_listing,
            'send_confirmation_sms' => $request->send_confirmation_sms,
            'send_confirmation_email' => $request->send_confirmation_email,
            'message_preview' => $request->message_preview,
            'save_to_crm' => $request->save_to_crm,
            'comparable_sales' => $request->comparable_sales,
            'added_to_calendar' => $request->added_to_calendar,
            'additional_notes' => $request->additional_notes,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Hot lead created successfully!',
            'redirect' => route('agent.booking-appraisals.index')
        ]);
    }

    public function destroy(BookingAppraisal $bookingAppraisal)
    {
        $bookingAppraisal->delete();
        return response()->json(['success' => 'Booking appraisal deleted successfully.']);
    }
}
