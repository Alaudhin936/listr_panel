<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Agent;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Log;

class AgentSignupController extends Controller
{
    /**
     * Show the agent registration form.
     */
    public function showAgentRegistration()
    {
        return view('others.authentication.agent-register');
    }

    /**
     * Send OTP for registration
     */
    public function sendOTP(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'      => ['required', 'string', 'max:255'],
            'email'     => ['required', 'string', 'email', 'max:255', 'unique:agents,email'],
            'address_line1' => ['required', 'string', 'max:500'],
            'address_line2' => ['nullable', 'string', 'max:500'],
            'state'     => ['required', 'string', 'max:100'],
            'city'      => ['required', 'string', 'max:100'],
            'zipcode'   => ['required', 'string', 'max:20'],
            'phone'     => ['required', 'string', 'max:20', 'unique:agents,phone'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors()->first()
            ]);
        }

        try {
            // Generate 4-digit OTP
            $otp = rand(1000, 9999);

            // Store temporary data in session
            $tempData = $request->all();
            $tempData['otp'] = $otp;
            $tempData['otp_expires'] = now()->addMinutes(10);

            Session::put('agent_registration_temp', $tempData);

            // Send OTP via ClickSend
            $this->sendClickSendSMS($request->phone, "Your agent registration OTP is: {$otp}. Valid for 10 minutes.");

            return response()->json([
                'success' => true,
                'message' => 'OTP sent successfully!',
                'temp_data' => encrypt(json_encode($tempData))
            ]);

        } catch (\Exception $e) {
            Log::error('Agent Signup OTP failed: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Failed to send OTP. Please try again.'
            ]);
        }
    }

    /**
     * Resend OTP for registration
     */
    public function resendOTP(Request $request)
    {
        try {
            $tempData = json_decode(decrypt($request->temp_data), true);

            // Generate new OTP
            $otp = rand(1000, 9999);
            $tempData['otp'] = $otp;
            $tempData['otp_expires'] = now()->addMinutes(10);

            Session::put('agent_registration_temp', $tempData);

            // Send OTP via ClickSend
            $this->sendClickSendSMS($tempData['phone'], "Your agent registration OTP is: {$otp}. Valid for 10 minutes.");

            return response()->json([
                'success' => true,
                'message' => 'OTP resent successfully!'
            ]);

        } catch (\Exception $e) {
            Log::error('Agent Resend OTP failed: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Failed to resend OTP.'
            ]);
        }
    }


    public function verifyOTP(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'otp1' => ['required', 'numeric'],
            'otp2' => ['required', 'numeric'],
            'otp3' => ['required', 'numeric'],
            'otp4' => ['required', 'numeric'],
            'temp_data' => ['required']
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors()->first()
            ]);
        }
        try {
            $enteredOTP = $request->otp1 . $request->otp2 . $request->otp3 . $request->otp4;

            $tempData = json_decode(decrypt($request->temp_data), true);

            if (!$tempData || !isset($tempData['otp'])) {
                return response()->json([
                    'success' => false,
                    'message' => 'Session expired. Please try again.'
                ]);
            }
            if (now() > $tempData['otp_expires']) {
                return response()->json([
                    'success' => false,
                    'message' => 'OTP has expired. Please request a new one.'
                ]);
            }

            if ($enteredOTP != $tempData['otp']) {
                return response()->json([
                    'success' => false,
                    'message' => 'Invalid OTP. Please try again.'
                ]);
            }

            $agent = Agent::create([
                'agency_id'     => $tempData['agency_id'] ?? null,
                'name'          => $tempData['name'],
                'email'         => $tempData['email'],
                'password'      => Hash::make('default123'), // Default password since we're using OTP
                'address_line1' => $tempData['address_line1'],
                'address_line2' => $tempData['address_line2'],
                'state'         => $tempData['state'],
                'city'          => $tempData['city'],
                'zipcode'       => $tempData['zipcode'],
                'phone'         => $tempData['phone'],
                'status'=>'pending',

            ]);

            // Clear session data
            Session::forget('agent_registration_temp');

            // Auto login after registration
            Auth::guard('agent')->login($agent);

            return response()->json([
                'success' => true,
                'message' => 'Registration successful! Welcome to your dashboard.',
                'redirect' => route('agent.dashboard')
            ]);

        } catch (\Exception $e) {
            Log::error('Agent Registration failed: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Registration failed. Please try again.'
            ]);
        }
    }

    /**
     * Send SMS via ClickSend API (with fallback sender)
     */
    private function sendClickSendSMS($phone, $message)
    {
        $username = config('services.clicksend.username');
        $apiKey   = config('services.clicksend.api_key');

        $senderId = env('CLICKSEND_FROM');
        if (empty($senderId)) {
            $senderId = 'LISTR';
        }

        $formattedPhone = $this->formatPhoneNumber($phone);

        Log::info('Sending SMS via ClickSend', [
            'to' => $formattedPhone,
            'sender' => $senderId,
            'username' => $username,
            'apiKey_set' => $apiKey ? true : false
        ]);

        $response = Http::withBasicAuth($username, $apiKey)
            ->post('https://rest.clicksend.com/v3/sms/send', [
                'messages' => [
                    [
                        'to'   => $formattedPhone,
                        'body' => $message,
                        'from' => $senderId
                    ]
                ]
            ]);

        if (!$response->successful()) {
            throw new \Exception('Failed to send SMS via ClickSend');
        }

        $data = $response->json();
        Log::info('ClickSend raw response', ['body' => $data]);

        if (isset($data['data']['messages'][0]['status']) &&
            $data['data']['messages'][0]['status'] === 'INVALID_SENDER_ID') {

            Log::warning('Invalid Sender ID detected, retrying with blank sender');

            $response = Http::withBasicAuth($username, $apiKey)
                ->post('https://rest.clicksend.com/v3/sms/send', [
                    'messages' => [
                        [
                            'to'   => $formattedPhone,
                            'body' => $message,
                            'from' => '' // fallback to shared ClickSend number
                        ]
                    ]
                ]);

            if (!$response->successful()) {
                throw new \Exception('Failed to send SMS after fallback');
            }

            return $response->json();
        }

        return $data;
    }

    /**
     * Format phone number for international SMS
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
