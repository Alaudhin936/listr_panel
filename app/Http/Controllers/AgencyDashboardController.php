<?php



namespace App\Http\Controllers;

use App\Models\Agent;
use App\Models\HotLead;
use App\Models\JustListed;
use Illuminate\Http\Request;
use App\Models\BookingAppraisal;
use App\Models\ConductAppraisal;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AgencyDashboardController extends Controller
{
    public function index()
    {
        $agency = Auth::user(); // Using users table for agency
        $agencyId = $agency->id;

        $agents = Agent::where('agency_id', $agencyId)->get();
        $agentIds = $agents->pluck('id')->toArray();

        $totalAgents = $agents->count();
        $totalHotLeads = HotLead::whereIn('agent_id', $agentIds)->count();
        $totalBookingAppraisals = BookingAppraisal::whereIn('agent_id', $agentIds)->count();
        $totalConductAppraisals = ConductAppraisal::whereIn('agent_id', $agentIds)->count();
        $totalJustListed = JustListed::whereIn('agent_id', $agentIds)->count();

        $months = [];
        $hotLeadsData = [];
        $bookingAppraisalsData = [];
        $conductAppraisalsData = [];
        $justListedData = [];
        $agentRegistrationData = [];

        for ($i = 5; $i >= 0; $i--) {
            $date = now()->subMonths($i);
            $months[] = $date->format('M Y');
            
            $hotLeadsData[] = HotLead::whereIn('agent_id', $agentIds)
                ->whereYear('created_at', $date->year)
                ->whereMonth('created_at', $date->month)
                ->count();
                
            $bookingAppraisalsData[] = BookingAppraisal::whereIn('agent_id', $agentIds)
                ->whereYear('created_at', $date->year)
                ->whereMonth('created_at', $date->month)
                ->count();
                
            $conductAppraisalsData[] = ConductAppraisal::whereIn('agent_id', $agentIds)
                ->whereYear('created_at', $date->year)
                ->whereMonth('created_at', $date->month)
                ->count();
                
            $justListedData[] = JustListed::whereIn('agent_id', $agentIds)
                ->whereYear('created_at', $date->year)
                ->whereMonth('created_at', $date->month)
                ->count();

            $agentRegistrationData[] = Agent::where('agency_id', $agencyId)
                ->whereYear('created_at', $date->year)
                ->whereMonth('created_at', $date->month)
                ->count();
        }

        // Top performing agents
        $topAgents = Agent::where('agency_id', $agencyId)
            ->withCount([
                'hotLeads',
                'bookingAppraisals',
                'conductAppraisals',
                'justListed'
            ])
            ->orderBy('hot_leads_count', 'desc')
            ->take(5)
            ->get();

        // Recent agent activities
        $recentHotLeads = HotLead::whereIn('agent_id', $agentIds)
            ->with('agent')
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        $recentBookings = BookingAppraisal::whereIn('agent_id', $agentIds)
            ->with('agent')
            ->orderBy('created_at', 'desc')
            ->take(3)
            ->get();

        // Agent performance summary
        $agentPerformance = Agent::where('agency_id', $agencyId)
            ->select('id', 'name', 'email')
            ->withCount([
                'hotLeads as hot_leads_count',
                'bookingAppraisals as bookings_count',
                'conductAppraisals as appraisals_count',
                'justListed as listings_count'
            ])
            ->get()
         ->map(function ($agent) {
        $agent->conversion_rate = $agent->hot_leads_count > 0 
            ? round(($agent->appraisals_count / $agent->hot_leads_count) * 100, 1) 
            : 0;
        $agent->listing_rate = $agent->appraisals_count > 0 
            ? round(($agent->listings_count / $agent->appraisals_count) * 100, 1) 
            : 0;
        return $agent;
    });

        return view('agency.agency-dashboard', compact(
            'agency',
            'totalAgents',
            'totalHotLeads',
            'totalBookingAppraisals',
            'totalConductAppraisals',
            'totalJustListed',
            'months',
            'hotLeadsData',
            'bookingAppraisalsData',
            'conductAppraisalsData',
            'justListedData',
            'agentRegistrationData',
            'topAgents',
            'recentHotLeads',
            'recentBookings',
            'agentPerformance'
        ));
    }
}

