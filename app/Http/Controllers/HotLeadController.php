<?php

namespace App\Http\Controllers;

use App\Models\Agent;
use App\Models\HotLead;
use App\Models\Template;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class HotLeadController extends Controller
{
    public function createBookingAppraisal(HotLead $hotlead)
{
     // Get SMS and Email templates
    $smsTemplates = Template::where('type', 'sms')
        ->where('is_active', true)
        ->get();
    
    $emailTemplates = Template::where('type', 'email')
        ->where('is_active', true)
        ->get();
    $agents = Agent::where('agency_id', Auth::guard('agent')->user()->agency_id)->get();
    
    return view('agents.booking-appraisal.create', compact('agents', 'hotlead','smsTemplates', 'emailTemplates'));
}
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $hotLeads = HotLead::with('agent')
                ->where('agency_id', Auth::user()->id)
                ->select([
                    'id',
                    'agent_id',
                    'vendor_first_name',
                    'vendor_last_name',
                    'vendor_mobile',
                    'vendor_email',
                    'vendor_address',
                    'category',
                    'lead_source',
                    'created_at',
                    'updated_at'
                ])
				->latest();

            // Apply agent filter if provided
            if ($request->has('agent_id') && $request->agent_id != '') {
                $hotLeads->where('agent_id', $request->agent_id);
            }
            

            // Apply date range filter if provided
            if ($request->has('start_date') && $request->start_date != '') {
                $hotLeads->whereDate('created_at', '>=', $request->start_date);
            }
            if ($request->has('end_date') && $request->end_date != '') {
                $hotLeads->whereDate('created_at', '<=', $request->end_date);
            }

            return DataTables::of($hotLeads)
                ->addColumn('vendor_name', function($hotLead) {
                    return $hotLead->vendor_first_name . ' ' . $hotLead->vendor_last_name;
                })
                ->addColumn('vendor_contact', function($hotLead) {
                    return $hotLead->vendor_mobile;
                })
                ->addColumn('agent_name', function($hotLead) {
                    return $hotLead->agent ? $hotLead->agent->name : 'N/A';
                })
                ->addColumn('action', function($hotLead) {
                    return '
                        <div class="action-buttons">
                            <button class="action-btn btn-view view-btn" data-id="' . $hotLead->id . '"style="color:black;border:1px solid black;">
                                <i class="fas fa-eye me-1"></i> 
                            </button>
                            
                        </div>
                    ';
                })
                ->rawColumns(['category', 'action'])
                ->make(true);
        }

        $agents = Agent::where('agency_id', Auth::user()->id)
            ->orderBy('name')
            ->get();

        return view('agency.hotleads.index', compact('agents'));
    }

    public function show($id)
    {
        $hotLead = HotLead::with('agent')->findOrFail($id);
        
        return response()->json([
            'success' => true,
            'data' => $hotLead
        ]);
    }

    public function destroy($id)
    {
        $hotLead = HotLead::findOrFail($id);
        $hotLead->delete();
        
        return response()->json([
            'success' => true,
            'message' => 'Hot lead deleted successfully'
        ]);
    }
}