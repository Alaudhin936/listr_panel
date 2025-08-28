<?php

namespace App\Http\Controllers;

use App\Models\BookingAppraisal;
use App\Models\Agent;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Auth;

class AgencyBookingAppraisalController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $appraisals = BookingAppraisal::with('agent')
                ->where('agency_id', Auth::user()->id)
                ->select([
                    'id',
                    'agent_id',
                    'address',
                    'vendor1_first_name',
                    'vendor1_last_name',
                    'vendor1_mobile',
                    'vendor1_email',
                    'appointment_date',
                    'appointment_time',
                    'category',
                    'lead_source',
                    'created_at',
                    'updated_at'
                ])
				->latest();

            // Apply agent filter if provided
            if ($request->has('agent_id') && $request->agent_id != '') {
                $appraisals->where('agent_id', $request->agent_id);
            }

            // Apply date range filter if provided
            if ($request->has('start_date') && $request->start_date != '') {
                $appraisals->whereDate('created_at', '>=', $request->start_date);
            }
            if ($request->has('end_date') && $request->end_date != '') {
                $appraisals->whereDate('created_at', '<=', $request->end_date);
            }

            return DataTables::of($appraisals)
                ->addColumn('vendor_name', function($appraisal) {
                    return $appraisal->vendor1_first_name . ' ' . $appraisal->vendor1_last_name;
                })
                ->addColumn('contact_info', function($appraisal) {
                    return $appraisal->vendor1_mobile . '<br>' . $appraisal->vendor1_email;
                })
                ->addColumn('appointment', function($appraisal) {
                    if ($appraisal->appointment_date) {
                        return $appraisal->appointment_date . ' ' . $appraisal->appointment_time;
                    }
                    return 'Not scheduled';
                })
                ->addColumn('status', function($appraisal) {
                    $badgeClass = $appraisal->category === 'urgent' ? 'badge-hot' : 'badge-warm';
                    return '<span class="badge ' . $badgeClass . '">' . ucfirst($appraisal->category) . '</span>';
                })
                ->addColumn('agent_name', function($appraisal) {
                    return $appraisal->agent ? $appraisal->agent->name : 'N/A';
                })
                ->addColumn('action', function($appraisal) {
                    return '
                        <div class="action-buttons">
                            <button class="action-btn btn-outline-secondary btn-view view-btn" data-id="' . $appraisal->id . '"style="color:black;border:1px solid black;">
                                <i class="fas fa-eye me-1"></i> 
                            </button>
                           
                        </div>
                    ';
                })
                ->rawColumns(['contact_info', 'status', 'action'])
                ->make(true);
        }

        // Get all agents for the filter dropdown
        $agents = Agent::where('agency_id', Auth::user()->id)
            ->orderBy('name')
            ->get();

        return view('agency.booking-appraisals.index', compact('agents'));
    }

    public function show($id)
    {
        $appraisal = BookingAppraisal::with('agent')->findOrFail($id);
        
        return response()->json([
            'success' => true,
            'data' => $appraisal
        ]);
    }

    public function destroy($id)
    {
        $appraisal = BookingAppraisal::findOrFail($id);
        $appraisal->delete();
        
        return response()->json([
            'success' => true,
            'message' => 'Booking appraisal deleted successfully'
        ]);
    }
}