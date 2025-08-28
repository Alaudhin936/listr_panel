<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class ContactApiController extends Controller
{
    public function send(Request $request)
    {

        // Validate form data
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'subject' => 'nullable|string|max:255',
            'message' => 'required|string',
        ]);

        try {
            // Take credentials from .env
            $username = env('CLICKSEND_USERNAME');
            $apiKey = env('CLICKSEND_API_KEY');
            $emailAddressId = env('CLICKSEND_EMAIL_ADDRESS_ID');

            // Build email payload
            $payload = [
                'messages' => [
                    [
                        'to' => 'alaudhin.r@spiderindia.net', 
                        'subject' => $request->subject ?? 'New Message from Contact Form',
                        'body' => "Name: {$request->name}\nEmail: {$request->email}\nMessage: {$request->message}",
                        'from' => [
                            'email_address_id' => (int)$emailAddressId,
                            'name' => 'Property Leads'
                        ]
                    ]
                ]
            ];

            // Send POST request to ClickSend API
            $response = Http::withBasicAuth($username, $apiKey)
                ->timeout(30)
                ->post('https://rest.clicksend.com/v3/email/send', $payload);

            $result = $response->json();
            Log::info('ClickSend Email API Response', $result);

            if ($response->failed()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Failed to send email',
                    'details' => $result
                ], 500);
            }

            return response()->json(['success' => true, 'message' => 'Email sent successfully']);

        } catch (\Exception $e) {
            Log::error('Error sending email', ['message' => $e->getMessage()]);
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }
}