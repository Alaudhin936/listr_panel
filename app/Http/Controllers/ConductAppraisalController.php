<?php

namespace App\Http\Controllers;

use App\Models\Appraisal;
use App\Models\TradePerson;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\TempForConduct;
use App\Models\BookingAppraisal;
use App\Models\ConductAppraisal;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Http;

class ConductAppraisalController extends Controller
{
    public function index(Request $request)
{
    $query = ConductAppraisal::with(['agent', 'agency'])
        ->where('agent_id', Auth::guard('agent')->user()->id)
        ->latest();
  if (request()->has('start_date') && request()->start_date != '') {
            $query->whereDate('created_at', '>=', request()->start_date);
        }
        
        if (request()->has('end_date') && request()->end_date != '') {
            $query->whereDate('created_at', '<=', request()->end_date);
        }
    if ($request->ajax()) {
        return datatables()->of($query)
            ->addColumn('address', function ($appraisal) {
                return $appraisal->vendor1_address ?? 'N/A';
            })
            ->addColumn('vendor_name', function ($appraisal) {
                return ($appraisal->vendor1_first_name ?? '') . ' ' . ($appraisal->vendor1_last_name ?? '');
            })
            ->addColumn('contact_info', function ($appraisal) {
                return ($appraisal->vendor1_mobile ?? 'N/A') . '<br>' . ($appraisal->vendor1_email ?? '');
            })
            ->addColumn('appointment', function ($appraisal) {
                return $appraisal->created_at;
            })
            ->addColumn('actions', function ($appraisal) {
                $isConverted = $appraisal->converted_to_just_listed == 1;

                $viewBtn = '
                    <button class="action-btn btn-outline-secondary btn-view view-btn" 
                        data-id="'.$appraisal->id.'" 
                        style="color:black;border:1px solid black;">
                        <i class="fas fa-eye me-1"></i>
                    </button>';


                $deleteBtn = '
                    <button class="action-btn btn-outline-danger btn-delete delete-btn '.($isConverted ? 'disabled' : '').'" 
                        data-id="'.$appraisal->id.'" 
                        style="color:black;border:1px solid black;" 
                        '.($isConverted ? 'disabled' : '').'>
                        <i class="fas fa-trash me-1"></i>
                    </button>';
$justListedBtn = '<a href="'.($isConverted ? '#' : route('agent.conduct-appraisals.just-listed.create', $appraisal->id)).'" 
                     class="action-btn just-listed-btn '.($isConverted ? 'disabled' : '').'" 
                     title="Just Listed"
                     style="color:black; background:none; border:none; border:1px solid black;">
                     <i class="fas fa-arrow-right"></i>
                 </a>';
                return '
                    <div class="action-buttons">
                        '.$viewBtn.'
                        '.$deleteBtn.'
                        '.$justListedBtn.'
                    </div>';
            })
            ->rawColumns(['contact_info', 'actions'])
            ->make(true);
    }

    return view('agents.conduct-appraisal.index');
}
public function createJustListed(ConductAppraisal $appraisal)
{
    $appraisalData = $appraisal->toArray();
    
    return view('agents.just-listed.create', compact('appraisalData', 'appraisal'));
}

  public function create()
{
    $tradePersons = TradePerson::where('agent_id', auth()->guard('agent')->user()->id)
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

    return view('agents.conduct-appraisal.create', compact('tradePersons', 'emailTemplates', 'smsTemplates'));
}

public function store(Request $request)
{
    $uploadPath = public_path('uploads');
    if (!File::exists($uploadPath)) {
        File::makeDirectory($uploadPath, 0755, true);
    }

    $validated = $request->validate([
        // Vendor 1
        'vendor1_first_name' => 'nullable|string',
        'vendor1_last_name' => 'nullable|string',
        'vendor1_mobile' => 'nullable|string',
        'vendor1_email' => 'nullable|email',
        'vendor1_address' => 'nullable|string',
        
        // Vendor 2
        'has_additional_vendor' => 'nullable|boolean',
        'vendor2_first_name' => 'nullable|string',
        'vendor2_last_name' => 'nullable|string',
        'vendor2_mobile' => 'nullable|string',
        'vendor2_email' => 'nullable|email',
        
        // Property details
        'property_type' => 'nullable|string',
        'property_type_quick' => 'nullable|string',
        'more_property_type' => 'nullable|string',
        'other_property_type' => 'nullable|string',
        'property_type_detailed' => 'nullable|string',
        'property_condition' => 'nullable|string',
        'bedrooms' => 'nullable|integer',
        'bathrooms' => 'nullable|integer',
        'living_areas' => 'nullable|integer',
        'toilets' => 'nullable|integer',
        'car_spaces' => 'nullable|integer',
        'kitchen_condition' => 'nullable|string',
        'year_built' => 'nullable',
        'exterior_material' => 'nullable|string',
        'storeys' => 'nullable|string',
        'land_size' => 'nullable|numeric',
        'land_size_quick' => 'nullable|numeric',
        'more_bedrooms' => 'nullable|integer',
        'more_bathrooms' => 'nullable|integer',
        'more_living_areas' => 'nullable|integer',
        'bedrooms_quick' => 'nullable|string',
'bathrooms_quick' => 'nullable|string', 
'living_areas_quick' => 'nullable|string',
'car_spaces_quick' => 'nullable|string',
'property_condition_quick' => 'nullable|string',
'car_accommodation_type' => 'nullable|string',
'more_car_spaces' => 'nullable|integer',
'car_accommodation_spec' => 'nullable|string',
'other_exterior_material' => 'nullable|string',
'other_year_built' => 'nullable|string',
'outdoor_features_other' => 'nullable|string',
        // Additional Info Section
        'agent_notes' => 'nullable|string',

        // Heating & Cooling
        'split_systems' => 'nullable|integer',
        
        'sale_method' => 'nullable|string',
        'key_dates_discussed' => 'nullable|boolean',
        'auction_date' => 'nullable|date',
        'preferred_launch' => 'nullable|date',
        'first_open' => 'nullable|date',
        'commission_discussed' => 'nullable|boolean',
        'commission_details' => 'nullable|string',
        'other_notes' => 'nullable|string',
        'comparable_sales' => 'nullable|string', 
        // Smart Send
        'follow_up_sms' => 'nullable|string',
        'sms_message' => 'nullable|string',
        'send_proposal' => 'nullable|boolean',
        'include_price' => 'nullable|boolean',
        'price_information' => 'nullable|string',
        'proposal_method' => 'nullable|string',
        'personalized_message' => 'nullable|string',
        'vendor_motivation' => 'nullable|string',
        'trade_persons' => 'nullable|array',
        'trade_persons.*' => 'exists:trade_persons,id',
        // Arrays/JSON fields
        'heating' => 'nullable|array',
        'cooling' => 'nullable|array',
        'extra_features' => 'nullable|array',
        'outdoor_features' => 'nullable|array',
        'outdoor_features_detailed' => 'nullable|array',
        'marketing_discussed' => 'nullable|array',
        'professional_contacts' => 'nullable|array',
        'bedroom_details' => 'nullable|array',
        'bathroom_details' => 'nullable|array',
        'living_area_details' => 'nullable|array',
        'kitchen_details' => 'nullable|array',
        
        // Photos
        'photos.*' => 'nullable|image',
        'property_photos.*' => 'nullable|image',
        'comparable_photos.*' => 'nullable|image',
        // Add to your validation rules:
        'main_contact' => 'nullable|string',
        'main_contact_first_name' => 'nullable|string',
        'main_contact_last_name' => 'nullable|string',
        'main_contact_mobile' => 'nullable|string',
        'main_contact_email' => 'nullable|email',

        'study_type' => 'nullable|string',
        'kitchen_condition_quick' => 'nullable|string',

        'auction_eoi_date' => 'nullable|date',
        'photography_date' => 'nullable|date',
        'internet_launch_date' => 'nullable|date',
        'first_open_inspection_date' => 'nullable|date',
        'marketing_package' => 'nullable|string',
        'commission_proposal' => 'nullable|string',
        'second_agent' => 'nullable|string',
        'contact_who' => 'nullable|string',

        'marketing_discussed_checkboxes' => 'nullable|array',
        'agent_id' => 'nullable|exists:agents,id',
        'agency_id' => 'nullable|exists:users,id',
        'booking_appraisal_id' => 'nullable|exists:booking_appraisals,id',
        'hotleads_id' => 'nullable|exists:hot_leads,id'
    ]);
    $validated['booking_appraisal_id'] = $request->booking_appraisal_id;

    $propertyPhotoPaths = [];
    if ($request->hasFile('property_photos')) {
        foreach ($request->file('property_photos') as $photo) {
            if ($photo->isValid()) {
                $filename = Str::random(20) . '.' . $photo->getClientOriginalExtension();
                $photo->move($uploadPath, $filename);
                $propertyPhotoPaths[] = 'uploads/' . $filename;
            }
        }
        $validated['property_photos'] = $propertyPhotoPaths;
    }

    $photoPaths = [];
    if ($request->hasFile('photos')) {
        foreach ($request->file('photos') as $photo) {
            if ($photo->isValid()) {
                $filename = Str::random(20) . '.' . $photo->getClientOriginalExtension();
                $photo->move($uploadPath, $filename);
                $photoPaths[] = 'uploads/' . $filename;
            }
        }
        $validated['photos'] = $photoPaths;
    }

    // Handle comparable photos
    $comparablePhotoPaths = [];
    if ($request->hasFile('comparable_photos')) {
        foreach ($request->file('comparable_photos') as $photo) {
            if ($photo->isValid()) {
                $filename = Str::random(20) . '.' . $photo->getClientOriginalExtension();
                $photo->move($uploadPath, $filename);
                $comparablePhotoPaths[] = 'uploads/' . $filename;
            }
        }
        $validated['comparable_photos'] = $comparablePhotoPaths;
    }

    $kitchenDetails = [];
    if ($request->has('kitchen_details')) {
        foreach ($request->kitchen_details as $index => $kitchen) {
            $kitchenDetails[] = [
                'benchtops' => $kitchen['benchtops'] ?? null,
                'cooktop' => $kitchen['cooktop'] ?? null,
                'cabinetry' => $kitchen['cabinetry'] ?? null,
                'pantry' => $kitchen['pantry'] ?? null,
                'dishwasher' => $kitchen['dishwasher'] ?? null,
                'condition' => $kitchen['condition'] ?? null,
            ];
        }
        $validated['kitchen_details'] = $kitchenDetails;
    }

    $arrayFields = [
        'heating', 'cooling', 'extra_features', 'outdoor_features',
        'outdoor_features_detailed', 'marketing_discussed', 'professional_contacts',
        'comparable_sales', 'bedroom_details', 'bathroom_details', 'living_area_details'
    ];

    foreach ($arrayFields as $field) {
        if (isset($validated[$field])) {
            $validated[$field] = $validated[$field];
        }
    }

    // Set agent and agency IDs
    if (auth()->guard('agent')->check()) {
        $validated['agent_id'] = auth()->guard('agent')->user()->id;
        $validated['agency_id'] = auth()->guard('agent')->user()->agency_id;
    } else {
        $validated['agent_id'] = null;
        $validated['agency_id'] = null;
    }

    // Create the appraisal
    $appraisal = ConductAppraisal::create($validated);

// In your main store method
if (!empty($validated['trade_persons'])) {
    $this->sendTradePersonNotifications($validated['trade_persons'], $request, $appraisal);
}

// Update booking appraisal status if applicable
if ($validated['booking_appraisal_id']) {
    BookingAppraisal::where('id', $validated['booking_appraisal_id'])->update(['converted_to_conduct_appraisal' => true]);
}

return response()->json(['success' => true, 'message' => 'Appraisal submitted successfully!']);
}
/**
 * Send notifications to selected trade persons
 */
private function sendTradePersonNotifications($tradePersonIds, $request, $appraisal)
{
    try {
        // Get selected trade persons
        $tradePersons = TradePerson::whereIn('id', $tradePersonIds)->get();
        
        if ($tradePersons->isEmpty()) {
            Log::warning('No trade persons found for notification');
            return;
        }

        foreach ($tradePersons as $tradePerson) {
            Log::info('Processing trade person notifications', [
                'trade_person_name' => $tradePerson->name,
                'trade_person_phone' => $tradePerson->phone,
                'trade_person_email' => $tradePerson->email,
                'follow_up_sms' => $request->follow_up_sms,
                'sms_message' => $request->sms_message,
                'follow_up_email' => $request->follow_up_email,
            ]);

            // Send SMS notification if follow_up_sms and sms_message are provided
            if (!empty($request->follow_up_sms) && !empty($request->sms_message) && !empty($tradePerson->phone)) {
                Log::info('Sending SMS to trade person', ['trade_person' => $tradePerson->name]);
                $this->sendTradePersonSMS($tradePerson, $request->sms_message);
            } else {
                Log::info('SMS not sent - conditions not met', [
                    'follow_up_sms_empty' => empty($request->follow_up_sms),
                    'sms_message_empty' => empty($request->sms_message),
                    'phone_empty' => empty($tradePerson->phone),
                ]);
            }
            
            // Send Email notification - now uses HTML template instead of follow_up_email
            if (!empty($tradePerson->email)) {
                Log::info('Sending email to trade person', ['trade_person' => $tradePerson->name]);
                $this->sendTradePersonEmail($tradePerson, $request);
            } else {
                Log::info('Email not sent - no email address', [
                    'email_empty' => empty($tradePerson->email),
                ]);
            }
        }
        
        Log::info('Trade person notifications sent successfully', [
            'trade_persons_count' => $tradePersons->count(),
            'appraisal_id' => $appraisal->id
        ]);
        
    } catch (\Exception $e) {
        Log::error('Failed to send trade person notifications: ' . $e->getMessage());
        // Don't throw exception to avoid breaking the appraisal creation process
    }
}

/**
 * Send SMS notification to trade person
 */
private function sendTradePersonSMS($tradePerson, $smsMessage)
{
    try {
        $username = config('services.clicksend.username'); 
        $apiKey   = config('services.clicksend.api_key');
        $senderId = env('CLICKSEND_FROM', 'LISTR');
        $formattedPhone = $this->formatPhoneNumber($tradePerson->phone);

        Log::info('Sending SMS to trade person', [
            'trade_person' => $tradePerson->name,
            'phone' => $formattedPhone
        ]);

        $response = Http::withBasicAuth($username, $apiKey)
            ->post('https://rest.clicksend.com/v3/sms/send', [
                'messages' => [[
                    'to'   => $formattedPhone,
                    'body' => $smsMessage,
                    'from' => $senderId
                ]]
            ]);

        $data = $response->json();
        Log::info('ClickSend SMS response for trade person', $data);

        if (!$response->successful()) {
            throw new \Exception('Failed to send SMS via ClickSend');
        }

        // Retry if INVALID_SENDER_ID
        if (isset($data['data']['messages'][0]['status']) && 
            $data['data']['messages'][0]['status'] === 'INVALID_SENDER_ID') {
            Log::warning('Invalid Sender ID detected for trade person SMS, retrying with blank sender');

            $response = Http::withBasicAuth($username, $apiKey)
                ->post('https://rest.clicksend.com/v3/sms/send', [
                    'messages' => [[
                        'to'   => $formattedPhone,
                        'body' => $smsMessage,
                        'from' => ''
                    ]]
                ]);

            if (!$response->successful()) {
                throw new \Exception('Failed to send SMS after fallback');
            }
        }

    } catch (\Exception $e) {
        Log::error('Failed to send SMS to trade person: ' . $e->getMessage(), [
            'trade_person' => $tradePerson->name,
            'phone' => $tradePerson->phone
        ]);
    }
}

/**
 * Generate professional HTML email template
 */
private function generateEmailTemplate($tradePerson, $request)
{
    $agentName = auth()->guard('agent')->user()->first_name ?? 'Agent';
    $agentMobile = auth()->guard('agent')->user()->mobile ?? '';
    $agencyName = auth()->guard('agent')->user()->agency->name ?? 'Real Estate Agency';
    $propertyAddress = $request->vendor1_address ?? 'Property Address';
    $propertyType = $request->property_type ?? 'Property';
    $tradeType = $tradePerson->trade_type ?? 'Trade Service';
    
    return '
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>New Property Lead</title>
    </head>
    <body style="margin: 0; padding: 0; font-family: -apple-system, BlinkMacSystemFont, \'Segoe UI\', Roboto, sans-serif; background-color: #f8fafc;">
        <div style="max-width: 600px; margin: 0 auto; background: white; border-radius: 12px; overflow: hidden; box-shadow: 0 4px 20px rgba(0,0,0,0.08);">
            
            <!-- Header -->
            <div style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); padding: 40px 30px; text-align: center; color: white;">
                <div style="width: 60px; height: 60px; background: white; border-radius: 50%; margin: 0 auto 20px; display: flex; align-items: center; justify-content: center; font-weight: bold; color: #667eea; font-size: 24px;">
                    🏠
                </div>
                <h1 style="margin: 0 0 8px 0; font-size: 28px; font-weight: 600;">New Property Lead</h1>
                <p style="margin: 0; opacity: 0.9; font-size: 16px;">Opportunity at ' . htmlspecialchars($propertyAddress) . '</p>
            </div>
            
            <!-- Main Content -->
            <div style="padding: 40px 30px;">
                <!-- Greeting -->
                <div style="margin-bottom: 30px;">
                    <h2 style="color: #1a202c; font-size: 22px; margin: 0 0 12px 0;">Hello ' . htmlspecialchars($tradePerson->name) . ',</h2>
                    <p style="color: #4a5568; margin: 0; font-size: 16px; line-height: 1.6;">I hope this message finds you well. I have a new property opportunity that matches your expertise.</p>
                </div>
                
                <!-- Property Details Card -->
                <div style="background: #f7fafc; border-radius: 8px; padding: 25px; margin-bottom: 30px; border-left: 4px solid #667eea;">
                    <h3 style="color: #2d3748; margin: 0 0 16px 0; font-size: 18px; font-weight: 600;">Property Details</h3>
                    <table style="width: 100%; border-collapse: collapse;">
                        <tr>
                            <td style="padding: 8px 0; color: #718096; font-weight: 500; width: 120px;">Address:</td>
                            <td style="padding: 8px 0; color: #2d3748; font-weight: 600;">' . htmlspecialchars($propertyAddress) . '</td>
                        </tr>
                        <tr>
                            <td style="padding: 8px 0; color: #718096; font-weight: 500;">Property Type:</td>
                            <td style="padding: 8px 0; color: #2d3748; font-weight: 600;">' . htmlspecialchars($propertyType) . '</td>
                        </tr>
                        <tr>
                            <td style="padding: 8px 0; color: #718096; font-weight: 500;">Service Required:</td>
                            <td style="padding: 8px 0; color: #2d3748; font-weight: 600;">' . htmlspecialchars($tradeType) . '</td>
                        </tr>
                    </table>
                </div>
                
                <!-- Message -->
                <div style="margin-bottom: 30px;">
                    <h3 style="color: #2d3748; margin: 0 0 12px 0; font-size: 18px;">Why I Thought of You</h3>
                    <p style="color: #4a5568; margin: 0; font-size: 16px; line-height: 1.6;">Based on your excellent reputation and quality workmanship, I believe you would be perfect for this opportunity. The property owner is looking for a reliable professional to assess and provide a quote.</p>
                </div>
                
                <!-- Call to Action -->
                <div style="background: #edf2f7; border-radius: 8px; padding: 25px; text-align: center; margin-bottom: 30px;">
                    <h3 style="color: #2d3748; margin: 0 0 12px 0; font-size: 18px;">Ready to Connect?</h3>
                    <p style="color: #4a5568; margin: 0 0 20px 0; font-size: 16px;">Contact me to discuss this opportunity further</p>
                    <div style="background: #667eea; color: white; padding: 12px 30px; border-radius: 6px; display: inline-block; text-decoration: none; font-weight: 600; font-size: 16px;">
                        📞 ' . htmlspecialchars($agentMobile) . '
                    </div>
                </div>
            </div>
            
            <!-- Footer -->
            <div style="background: #2d3748; color: white; padding: 30px; text-align: center;">
                <div style="margin-bottom: 20px;">
                    <h4 style="margin: 0 0 8px 0; font-size: 18px; font-weight: 600;">' . htmlspecialchars($agentName) . '</h4>
                    <p style="margin: 0; opacity: 0.8;">' . htmlspecialchars($agencyName) . '</p>
                </div>
                
                <div style="border-top: 1px solid #4a5568; padding-top: 20px; font-size: 14px; opacity: 0.7;">
                    <p style="margin: 0;">Thank you for your continued partnership</p>
                </div>
            </div>
            
        </div>
    </body>
    </html>';
}

/**
 * Send email notification to trade person with HTML template
 */
private function sendTradePersonEmail($tradePerson, $request)
{
    try {
        $username = config('services.clicksend.username');
        $apiKey = config('services.clicksend.api_key');
        $emailAddressId = config('services.clicksend.email_address_id');

        // Get property address for subject
        $propertyAddress = $request->vendor1_address ?? 'Property Address';
        $subject = 'New Property Lead - ' . $propertyAddress;

        // Generate HTML email template
        $htmlContent = $this->generateEmailTemplate($tradePerson, $request);

        Log::info('Sending email to trade person', [
            'trade_person' => $tradePerson->name,
            'email' => $tradePerson->email,
            'subject' => $subject
        ]);

        $payload = [
            'to' => [
                ['email' => $tradePerson->email]
            ],
            'subject' => $subject,
            'body' => $htmlContent,
            'from' => [
                'email_address_id' => (int)$emailAddressId,
                'name' => 'Property Leads'
            ]
        ];

        $response = Http::withBasicAuth($username, $apiKey)
            ->timeout(30)
            ->post('https://rest.clicksend.com/v3/email/send', $payload);

        $result = $response->json();
        Log::info('ClickSend Email API Response for trade person', $result);

        if ($response->failed()) {
            Log::error('ClickSend Email API Error for trade person', [
                'status' => $response->status(), 
                'response' => $result
            ]);
            throw new \Exception('Failed to send Email via ClickSend: ' . json_encode($result));
        }

    } catch (\Exception $e) {
        Log::error('Failed to send email to trade person: ' . $e->getMessage(), [
            'trade_person' => $tradePerson->name,
            'email' => $tradePerson->email
        ]);
    }
}

/**
 * Format phone number for international use (for SMS sending)
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
  public function show(ConductAppraisal $appraisal)
{
    $tradePersonsData = [];
    if (!empty($appraisal->trade_persons)) {
        $tradePersonIds = is_string($appraisal->trade_persons) 
            ? json_decode($appraisal->trade_persons, true) 
            : $appraisal->trade_persons;
            
        if (is_array($tradePersonIds) && !empty($tradePersonIds)) {
            $tradePersonsData = Tradeperson::whereIn('id', $tradePersonIds)
                ->active() 
                ->select('id', 'name', 'profession', 'email', 'phone', 'is_active')
                ->get();
        }
    }

    // Add trade persons data to the appraisal
    $appraisalData = $appraisal->toArray();
    $appraisalData['trade_persons_data'] = $tradePersonsData;

    return response()->json([
        'success' => true,
        'data' => $appraisalData
    ]);
}
    public function edit(ConductAppraisal $appraisal)
    {
       

        return view('agents.conduct-appraisal.edit', compact('appraisal'));
    }


    public function update(Request $request, ConductAppraisal $appraisal)
    {
        if ($appraisal->agent_id !== auth()->id()) {
            abort(403);
        }

        $validated = $request->validate([
            // Same validation rules as store method
            // ...
        ]);

        // Handle updates similar to store method
        // ...

        $appraisal->update($validated);

        return redirect()->route('agents.conduct-appraisal.index')
            ->with('success', 'Appraisal updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ConductAppraisal $appraisal)
    {
      
        $appraisal->delete();

        return response()->json([
            'success' => true,
            'message' => 'Appraisal deleted successfully.'
        ]);
    }
}