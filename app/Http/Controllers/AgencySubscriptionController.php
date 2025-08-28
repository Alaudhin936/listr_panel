<?php

namespace App\Http\Controllers;

use App\Models\Plan;
use App\Models\User;
use Illuminate\Http\Request;
use Razorpay\Api\Api;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class AgencySubscriptionController extends Controller
{
    private $razorpayKey;
    private $razorpaySecret;

    public function __construct()
    {
        $this->razorpayKey = env('RAZORPAY_KEY');
        $this->razorpaySecret = env('RAZORPAY_SECRET');
    }

    public function showSubscriptionPlans()
    {
        // Show only agency plans for agencies, agent plans for private agents
        $userType = Auth::guard('web')->check() ? 'agency' : 'agent';
        $plans = Plan::where('type', $userType)->where('is_active', true)->get();
        
        return view('agencylayout.subscription.plans', compact('plans'));
    }

    public function initiatePayment(Request $request)
    {
        $request->validate([
            'plan_id' => 'required|exists:plans,id'
        ]);

        $plan = Plan::findOrFail($request->plan_id);
        $user = Auth::user();

        // Create Razorpay order
        $api = new Api($this->razorpayKey, $this->razorpaySecret);

        $receiptId = Str::random(10);
        $orderData = [
            'receipt' => $receiptId,
            'amount' => $plan->price * 100, // Razorpay expects amount in paise
            'currency' => 'INR',
            'payment_capture' => 1
        ];

        try {
            $razorpayOrder = $api->order->create($orderData);
            
            // Save the order ID to user for verification later
            $user->update([
                'plan_id' => $plan->id,
                'payment_status' => 'pending',
                'razorpay_order_id' => $razorpayOrder['id']
            ]);

            return view('agencylayout.subscription.payment', [
                'key' => $this->razorpayKey,
                'order' => $razorpayOrder,
                'plan' => $plan,
                'user' => $user
            ]);

        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Payment initiation failed: ' . $e->getMessage());
        }
    }

    public function handlePaymentSuccess(Request $request)
    {
        $user = Auth::user();
        $plan = Plan::findOrFail($user->plan_id);

        // Verify the payment signature
        $api = new Api($this->razorpayKey, $this->razorpaySecret);

        $attributes = [
            'razorpay_order_id' => $request->razorpay_order_id,
            'razorpay_payment_id' => $request->razorpay_payment_id,
            'razorpay_signature' => $request->razorpay_signature
        ];

        try {
            $api->utility->verifyPaymentSignature($attributes);

            // Update user payment details and plan dates
            $user->update([
                'payment_status' => 'paid',
                'razorpay_payment_id' => $request->razorpay_payment_id,
                'razorpay_signature' => $request->razorpay_signature,
                'plan_start_date' => now(),
                'plan_end_date' => now()->addDays($plan->duration_days)
            ]);

            return redirect()->route('dashboard')->with('success', 'Payment successful and plan activated!');

        } catch (\Exception $e) {
            $user->update(['payment_status' => 'failed']);
            return redirect()->route('subscription.plans')->with('error', 'Payment verification failed: ' . $e->getMessage());
        }
    }

    public function handlePaymentFailure()
    {
        $user = Auth::user();
        $user->update(['payment_status' => 'failed']);
        
        return redirect()->route('subscription.plans')->with('error', 'Payment failed. Please try again.');
    }
}