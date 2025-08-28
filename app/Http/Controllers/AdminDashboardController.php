<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Agent;
use App\Models\HotLead;
use App\Models\BookingAppraisal;
use App\Models\ConductAppraisal;
use App\Models\JustListed;
use Carbon\Carbon;
use DB;

class AdminDashboardController extends Controller
{
    public function index()
    {
        // Existing stats
        $totalUsers = User::count();
        $totalAgents = Agent::count();
        $totalAgencies = User::count();
        $monthlyRevenue = 0; // You can update this with your actual revenue logic
        
        // New stats
        $hotLeadsCount = HotLead::count();
        $bookingAppraisalCount = BookingAppraisal::count();
        $conductAppraisalCount = ConductAppraisal::count();
        $justListedCount = JustListed::count();
        
        // Chart data (example - you can modify as needed)
        $chartData = $this->getChartData();

        return view('admin.dashboard', compact(
            'totalUsers',
            'totalAgents',
            'totalAgencies',
            'monthlyRevenue',
            'hotLeadsCount',
            'bookingAppraisalCount',
            'conductAppraisalCount',
            'justListedCount',
            'chartData'
        ));
    }

    private function getChartData()
    {
        // Example chart data - replace with your actual data
        $months = [];
        $data = [];
        
        for ($i = 5; $i >= 0; $i--) {
            $date = Carbon::now()->subMonths($i);
            $months[] = $date->format('M Y');
            
            $data[] = [
                'month' => $date->format('M Y'),
                'users' => rand(50, 200),
                'agents' => rand(5, 30),
                'agencies' => rand(2, 15),
                'revenue' => rand(5000, 20000),
            ];
        }
        
        return $data;
    }
}