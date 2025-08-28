<?php

namespace App\Http\Controllers;

use App\Models\HotLead;
use App\Models\JustListed;
use Illuminate\Http\Request;
use App\Models\BookingAppraisal;
use App\Models\ConductAppraisal;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AgentDashboardController extends Controller
{
    public function index()
    {
        $agent = Auth::guard('agent')->user();
        $agentId = $agent->id;

        // Get counts for the current agent
        $hotLeadsCount = HotLead::where('agent_id', $agentId)->count();
        $conductAppraisalsCount = ConductAppraisal::where('agent_id', $agentId)->count();
        $bookingAppraisalsCount = BookingAppraisal::where('agent_id', $agentId)->count();
        $justListedCount = JustListed::where('agent_id', $agentId)->count();

        // Get recent data for charts (last 6 months)
        $months = [];
        $hotLeadsData = [];
        $conductAppraisalsData = [];
        $bookingAppraisalsData = [];
        $justListedData = [];

        for ($i = 5; $i >= 0; $i--) {
            $date = now()->subMonths($i);
            $months[] = $date->format('M Y');
            
            $hotLeadsData[] = HotLead::where('agent_id', $agentId)
                ->whereYear('created_at', $date->year)
                ->whereMonth('created_at', $date->month)
                ->count();
                
            $conductAppraisalsData[] = ConductAppraisal::where('agent_id', $agentId)
                ->whereYear('created_at', $date->year)
                ->whereMonth('created_at', $date->month)
                ->count();
                
            $bookingAppraisalsData[] = BookingAppraisal::where('agent_id', $agentId)
                ->whereYear('created_at', $date->year)
                ->whereMonth('created_at', $date->month)
                ->count();
                
            $justListedData[] = JustListed::where('agent_id', $agentId)
                ->whereYear('created_at', $date->year)
                ->whereMonth('created_at', $date->month)
                ->count();
        }

        // Recent activities
        $recentHotLeads = HotLead::where('agent_id', $agentId)
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        $recentBookings = BookingAppraisal::where('agent_id', $agentId)
            ->orderBy('created_at', 'desc')
            ->take(3)
            ->get();

        return view('agents.agent-dashboard', compact(
            'agent',
            'hotLeadsCount',
            'conductAppraisalsCount', 
            'bookingAppraisalsCount',
            'justListedCount',
            'months',
            'hotLeadsData',
            'conductAppraisalsData',
            'bookingAppraisalsData',
            'justListedData',
            'recentHotLeads',
            'recentBookings'
        ));
    }
}
