<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class AgencyLoginController extends Controller
{
    /**
     * Show the agency login form.
     */
    public function agencyLogin()
    {
        return view('others.authentication.login');
    }

    public function create()
    {
        return view('others.authentication.sign-up');
    }

    /**
     * Send OTP for login
     */
    public function sendLoginOTP(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => ['required', 'string']
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors()->first()
            ]);
        }

        try {
            $username = $request->username;
            $agency = null;
            $contact_method = null;
            $contact_value = null;

            // Determine if input is email or phone
            if (filter_var($username, FILTER_VALIDATE_EMAIL)) {
                // Input is an email
                $agency = User::where('email', $username)->first();
                $contact_method = 'email';
                $contact_value = $username;
            } else {
                // Input is a phone number - normalize it and search
                $normalizedPhone = $this->normalizePhoneNumber($username);
                
                // Try to find agency with normalized phone number
                $agency = $this->findAgencyByPhone($normalizedPhone);
                
                $contact_method = 'phone';
                $contact_value = $agency ? $agency->phone : $username; // Use stored phone format for sending SMS
            }

            if (!$agency) {
                return response()->json([
                    'success' => false,
                    'message' => 'No agency found with this ' . $contact_method . '.'
                ]);
            }

            // Generate 4-digit OTP
            $otp = rand(1000, 9999);

            Session::put('agency_login_otp', [
                'otp' => $otp,
                'agency_id' => $agency->id,
                'contact_method' => $contact_method,
                'contact_value' => $contact_value,
                'expires' => now()->addMinutes(10)
            ]);

            if ($contact_method === 'email') {
                $this->sendEmailOTP($agency->email, $otp, $agency->name);
            } else {
                $this->sendSMSOTP($contact_value, $otp);
            }

            return response()->json([
                'success' => true,
                'message' => 'OTP sent successfully!'
            ]);

        } catch (\Exception $e) {
            Log::error('Agency Login OTP failed: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Failed to send OTP. Please try again.'
            ]);
        }
    }

    /**
     * Resend OTP for login
     */
    public function resendLoginOTP(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => ['required', 'string']
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors()->first()
            ]);
        }

        try {
            $username = $request->username;
            
            // Find agency to verify they exist
            if (filter_var($username, FILTER_VALIDATE_EMAIL)) {
                $agency = User::where('email', $username)->first();
            } else {
                // Use normalized phone search
                $normalizedPhone = $this->normalizePhoneNumber($username);
                $agency = $this->findAgencyByPhone($normalizedPhone);
            }

            if (!$agency) {
                return response()->json([
                    'success' => false,
                    'message' => 'Agency not found.'
                ]);
            }

            // Generate new OTP
            $otp = rand(1000, 9999);

            // Determine contact method and value
            $contact_method = filter_var($username, FILTER_VALIDATE_EMAIL) ? 'email' : 'phone';
            $contact_value = $contact_method === 'email' ? $username : $agency->phone;
            
            Session::put('agency_login_otp', [
                'otp' => $otp,
                'agency_id' => $agency->id,
                'contact_method' => $contact_method,
                'contact_value' => $contact_value,
                'expires' => now()->addMinutes(10)
            ]);

            // Resend OTP based on contact method
            if ($contact_method === 'email') {
                $this->sendEmailOTP($agency->email, $otp, $agency->name);
            } else {
                $this->sendSMSOTP($contact_value, $otp);
            }

            return response()->json([
                'success' => true,
                'message' => 'OTP resent successfully!'
            ]);

        } catch (\Exception $e) {
            Log::error('Agency Resend OTP failed: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Failed to resend OTP.'
            ]);
        }
    }

    /**
     * Verify OTP and login
     */
    public function verifyLoginOTP(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'otp1' => ['required', 'numeric'],
            'otp2' => ['required', 'numeric'],
            'otp3' => ['required', 'numeric'],
            'otp4' => ['required', 'numeric'],
            'username' => ['required', 'string']
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors()->first()
            ]);
        }

        try {
            $enteredOTP = $request->otp1 . $request->otp2 . $request->otp3 . $request->otp4;
            $loginData = Session::get('agency_login_otp');

            if (!$loginData) {
                return response()->json([
                    'success' => false,
                    'message' => 'Session expired. Please try again.'
                ]);
            }

            if (now() > $loginData['expires']) {
                return response()->json([
                    'success' => false,
                    'message' => 'OTP has expired. Please request a new one.'
                ]);
            }

            if ($enteredOTP != $loginData['otp']) {
                return response()->json([
                    'success' => false,
                    'message' => 'Invalid OTP. Please try again.'
                ]);
            }

            // For phone verification, we need to check if the input phone matches the stored phone
            if ($loginData['contact_method'] === 'phone') {
                $inputPhone = $this->normalizePhoneNumber($request->username);
                $storedPhone = $this->normalizePhoneNumber($loginData['contact_value']);
                
                if ($inputPhone !== $storedPhone) {
                    return response()->json([
                        'success' => false,
                        'message' => 'Invalid request. Please start over.'
                    ]);
                }
            } else {
                // For email, do exact match
                if ($request->username != $loginData['contact_value']) {
                    return response()->json([
                        'success' => false,
                        'message' => 'Invalid request. Please start over.'
                    ]);
                }
            }

            $agency = User::find($loginData['agency_id']);
            
            if (!$agency) {
                return response()->json([
                    'success' => false,
                    'message' => 'Agency not found.'
                ]);
            }

            Session::forget('agency_login_otp');

            Auth::login($agency, $request->has('remember'));
            $request->session()->regenerate();

            return response()->json([
                'success' => true,
                'message' => 'Login successful!',
                'redirect' => route('agency.dashboard')
            ]);

        } catch (\Exception $e) {
            Log::error('Agency Login failed: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Login failed. Please try again.'
            ]);
        }
    }

    /**
     * Logout agency
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }

    /**
     * Normalize phone number to a standard format for comparison
     */
    private function normalizePhoneNumber($phone)
    {
        // Remove all non-numeric characters except +
        $phone = preg_replace('/[^0-9+]/', '', $phone);
        
        // Convert to standard international format (+61...)
        if (!str_starts_with($phone, '+')) {
            if (str_starts_with($phone, '61')) {
                $phone = '+' . $phone;
            }
            elseif (str_starts_with($phone, '0')) {
                $phone = '+61' . substr($phone, 1);
            }
            else {
                $phone = '+61' . $phone;
            }
        }
        
        return $phone;
    }

    /**
     * Find agency by phone number using normalized comparison
     */
    private function findAgencyByPhone($inputPhone)
    {
        // Try multiple phone format variations to avoid fetching all records
        $phoneVariations = $this->getPhoneVariations($inputPhone);
        
        // Try to find agency using any of the phone variations
        foreach ($phoneVariations as $variation) {
            $agency = User::where('phone', $variation)->first();
            if ($agency) {
                return $agency;
            }
        }
        
        // If no direct match found, fall back to normalize and compare all
        // This handles cases where stored format doesn't match our variations
        $agencies = User::whereNotNull('phone')->get();
        
        foreach ($agencies as $agency) {
            $normalizedStoredPhone = $this->normalizePhoneNumber($agency->phone);
            if ($normalizedStoredPhone === $inputPhone) {
                return $agency;
            }
        }
        
        return null;
    }

    /**
     * Generate possible phone number variations for database lookup
     */
    private function getPhoneVariations($phone)
    {
        $normalizedPhone = $this->normalizePhoneNumber($phone);
        
        // Generate common variations that might be stored in database
        $variations = [
            $normalizedPhone, // +61412345678
        ];
        
        // Remove +61 and add 0 prefix (Australian local format)
        if (str_starts_with($normalizedPhone, '+61')) {
            $localNumber = '0' . substr($normalizedPhone, 3);
            $variations[] = $localNumber; // 0412345678
            
            // Also add without country code
            $variations[] = substr($normalizedPhone, 3); // 412345678
            
            // Add version without + but with 61
            $variations[] = substr($normalizedPhone, 1); // 61412345678
        }
        
        return array_unique($variations);
    }

    /**
     * Send SMS OTP via ClickSend API with automatic sender fallback
     */
    private function sendSMSOTP($phone, $otp)
    {
        $message = "Your agency login OTP is: {$otp}. Valid for 10 minutes.";
        
        $username = config('services.clicksend.username'); 
        $apiKey   = config('services.clicksend.api_key');
        $senderId = env('CLICKSEND_FROM', 'LISTR');
        $formattedPhone = $this->formatPhoneNumber($phone);

        Log::info('Agency Login - Sending SMS OTP', [
            'phone' => $formattedPhone,
            'clicksend_username' => $username,
            'clicksend_api_key_set' => $apiKey ? true : false,
            'sender' => $senderId
        ]);

        $response = Http::withBasicAuth($username, $apiKey)
            ->post('https://rest.clicksend.com/v3/sms/send', [
                'messages' => [[
                    'to'   => $formattedPhone,
                    'body' => $message,
                    'from' => $senderId
                ]]
            ]);

        $data = $response->json();
        Log::info('ClickSend SMS response (agency login)', $data);

        if (!$response->successful()) {
            throw new \Exception('Failed to send SMS via ClickSend');
        }

        // Retry if INVALID_SENDER_ID
        if (isset($data['data']['messages'][0]['status']) && 
            $data['data']['messages'][0]['status'] === 'INVALID_SENDER_ID') {
            Log::warning('Invalid Sender ID detected, retrying with blank sender');

            $response = Http::withBasicAuth($username, $apiKey)
                ->post('https://rest.clicksend.com/v3/sms/send', [
                    'messages' => [[
                        'to'   => $formattedPhone,
                        'body' => $message,
                        'from' => ''
                    ]]
                ]);

            if (!$response->successful()) {
                throw new \Exception('Failed to send SMS after fallback');
            }
            return $response->json();
        }

        return $data;
    }

/**
 * Send Email OTP via ClickSend API with HTML template
 */
public function sendEmailOTP($email, $otp, $name = '')
{
    try {
        $username = config('services.clicksend.username');
        $apiKey = config('services.clicksend.api_key');
        $emailAddressId = config('services.clicksend.email_address_id');

        $subject = 'Your Agency Login OTP Code';
        
        // HTML Email Template
        $htmlBody = $this->getOTPEmailTemplate($otp, $name);

        // Log config check
        Log::info('ClickSend Email Configuration Check', [
            'username' => $username,
            'api_key_set' => !empty($apiKey),
            'email_address_id' => $emailAddressId,
            'recipient' => $email
        ]);

        $payload = [
            'to' => [
                ['email' => $email]
            ],
            'subject' => $subject,
            'body' => $htmlBody,
            'from' => [
                'email_address_id' => (int)$emailAddressId,
                'name' => 'Agency Portal'
            ]
        ];

        $response = Http::withBasicAuth($username, $apiKey)
            ->timeout(30)
            ->post('https://rest.clicksend.com/v3/email/send', $payload);

        $result = $response->json();
        Log::info('ClickSend Email API Response', $result);

        if ($response->failed()) {
            Log::error('ClickSend Email API Error', ['status' => $response->status(), 'response' => $result]);
            throw new \Exception('Failed to send Email via ClickSend: ' . json_encode($result));
        }

        return true;

    } catch (\Exception $e) {
        Log::error('Email Sending Exception: ' . $e->getMessage());
        return false;
    }
}

/**
 * Get HTML email template for OTP
 */
private function getOTPEmailTemplate($otp, $name = '')
{
    $logoUrl = config('app.url') . '/images/logo.png'; // Update this path to your logo
    $greeting = $name ? "Hello {$name}," : "Hello,";
    
    return "
    <!DOCTYPE html>
    <html lang='en'>
    <head>
        <meta charset='UTF-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
        <title>Agency Login OTP</title>
        <style>
            body { margin: 0; padding: 0; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background-color: #f5f5f5; }
            .container { max-width: 600px; margin: 0 auto; background-color: #ffffff; }
            .header { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); padding: 40px 20px; text-align: center; }
            .logo { max-width: 200px; height: auto; margin-bottom: 20px; }
            .header h1 { color: #ffffff; margin: 0; font-size: 24px; font-weight: 600; }
            .content { padding: 40px 30px; text-align: center; }
            .greeting { font-size: 18px; color: #333333; margin-bottom: 20px; }
            .message { font-size: 16px; color: #666666; line-height: 1.6; margin-bottom: 30px; }
            .otp-container { background-color: #f8f9fa; border: 2px dashed #667eea; border-radius: 10px; padding: 25px; margin: 30px 0; }
            .otp-label { font-size: 14px; color: #666666; margin-bottom: 10px; text-transform: uppercase; letter-spacing: 1px; }
            .otp-code { font-size: 32px; font-weight: bold; color: #667eea; letter-spacing: 8px; font-family: 'Courier New', monospace; }
            .expiry { font-size: 14px; color: #e74c3c; margin-top: 15px; font-weight: 500; }
            .security-note { background-color: #fff3cd; border-left: 4px solid #ffc107; padding: 15px; margin: 30px 0; text-align: left; }
            .security-note strong { color: #856404; }
            .security-note p { margin: 5px 0; color: #856404; font-size: 14px; }
            .footer { background-color: #f8f9fa; padding: 20px; text-align: center; border-top: 1px solid #e9ecef; }
            .footer p { margin: 5px 0; color: #6c757d; font-size: 14px; }
            .support { margin-top: 30px; padding-top: 20px; border-top: 1px solid #e9ecef; }
            .support p { font-size: 14px; color: #666666; }
        </style>
    </head>
    <body>
        <div class='container'>
            <div class='header'>
               
                <h1>Agency Login Verification</h1>
            </div>
            
            <div class='content'>
                <div class='greeting'>{$greeting}</div>
                
                <div class='message'>
                    You have requested to login to your agency account. Please use the following One-Time Password (OTP) to complete your authentication.
                </div>
                
                <div class='otp-container'>
                    <div class='otp-label'>Your OTP Code</div>
                    <div class='otp-code'>{$otp}</div>
                    <div class='expiry'>⏰ This code will expire in 10 minutes</div>
                </div>
                
                <div class='security-note'>
                    <strong>🔒 Security Notice:</strong>
                    <p>• Never share this OTP with anyone</p>
                    <p>• Our team will never ask for your OTP</p>
                    <p>• If you didn't request this, please ignore this email</p>
                </div>
                
                <div class='support'>
                    <p>Having trouble? Contact our support team for assistance.</p>
                </div>
            </div>
            
            <div class='footer'>
                <p><strong>Agency Portal Team</strong></p>
                <p>This is an automated message, please do not reply to this email.</p>
                <p>&copy; " . date('Y') . " All rights reserved.</p>
            </div>
        </div>
    </body>
    </html>";
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
}