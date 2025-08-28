<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Agent;
use App\Models\HotLead;
use App\Models\JustListed;
use Illuminate\Http\Request;
use App\Models\BookingAppraisal;
use App\Models\ConductAppraisal;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class AdminAuthController extends Controller
{
    /**
     * Show the admin login form.
     */
    public function showLoginForm()
    {
        return view('admin.login');
    }

    /**
     * Handle admin login request.
     */
    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        $credentials = $request->only('username', 'password');
        $remember = $request->boolean('remember');

        if (Auth::guard('admin')->attempt($credentials, $remember)) {
            $request->session()->regenerate();
            return redirect()->intended(route('admin.dashboard'));
        }

        throw ValidationException::withMessages([
            'username' => __('These credentials do not match our records.'),
        ]);
    }
    /**
     * Handle admin logout request.
     */
    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('admin.login');
    }

    /**
     * Show the admin dashboard.
     */
   
      public function dashboard()
    {
        // Existing stats
        $totalUsers = User::count();
        $totalAgents = Agent::count();
        $totalAgencies = User::count();
        $monthlyRevenue = 0; 
        
        // New stats
        $hotLeadsCount = HotLead::count();
        $bookingAppraisalCount = BookingAppraisal::count();
        $conductAppraisalCount = ConductAppraisal::count();
        $justListedCount = JustListed::count();
           // Agent status counts
        $activeAgents = Agent::where('status', 'active')->count();
        $pendingAgents = Agent::where('status', 'pending')->count();
        $inactiveAgents = Agent::where('status', 'inactive')->count();
        
        // Static values for other metrics
        $activeSubscriptions = 6;
        $expiredSubscriptions = 6;
        $monthlyRevenue = 6;
        $pendingApprovals = 6;
        
 // Chart data for last 6 months
        $chartData = $this->getSubscriptionTrendsData();
        return view('admin.dashboard', compact(
            'totalUsers',
            'totalAgents',
            'totalAgencies',
            'monthlyRevenue',
             'pendingAgents',
            'inactiveAgents',
            'activeSubscriptions',
            'expiredSubscriptions',
            'pendingApprovals',
            'hotLeadsCount',
            'bookingAppraisalCount',
            'conductAppraisalCount',
            'justListedCount',
            'chartData'
        ));
    }
    
    private function getSubscriptionTrendsData()
    {
        // Static data for the chart
        $months = ['March', 'April', 'May', 'June', 'July', 'August'];
        $data = [
            ['month' => 'March', 'users' => 300, 'agents' => 250, 'agencies' => 350, 'revenue' => 400],
            ['month' => 'April', 'users' => 200, 'agents' => 400, 'agencies' => 300, 'revenue' => 350],
            ['month' => 'May', 'users' => 500, 'agents' => 300, 'agencies' => 200, 'revenue' => 250],
            ['month' => 'June', 'users' => 300, 'agents' => 400, 'agencies' => 450, 'revenue' => 350],
            ['month' => 'July', 'users' => 500, 'agents' => 350, 'agencies' => 300, 'revenue' => 200],
            ['month' => 'August', 'users' => 400, 'agents' => 450, 'agencies' => 400, 'revenue' => 500]
        ];
        
        return $data;
    }
}