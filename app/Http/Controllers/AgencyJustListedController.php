<?php

namespace App\Http\Controllers;

use App\Models\JustListed;
use App\Models\Agent;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Auth;

class AgencyJustListedController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $listings = JustListed::with(['agent'])
                ->where('agency_id', Auth::user()->id)
                ->select([
                    'id',
                    'agent_id',
                    'vendor1_first_name',
                    'vendor1_last_name',
                    'vendor1_mobile',
                    'vendor1_email',
                    'vendor1_address',
                    'method_of_sale',
                    'auction_date',
                    'first_open_date',
                    'created_at',
                    'updated_at'
                ])
                ->latest();

            if ($request->has('agent_id') && $request->agent_id != '') {
                $listings->where('agent_id', $request->agent_id);
            }

            if ($request->has('start_date') && $request->start_date != '') {
                $listings->whereDate('created_at', '>=', $request->start_date);
            }
            if ($request->has('end_date') && $request->end_date != '') {
                $listings->whereDate('created_at', '<=', $request->end_date);
            }

            return DataTables::of($listings)
                ->addColumn('vendor_name', function($listing) {
                    return $listing->vendor1_first_name . ' ' . $listing->vendor1_last_name;
                })
                ->addColumn('contact_info', function($listing) {
                    return $listing->vendor1_mobile . '<br>' . $listing->vendor1_email;
                })
                ->addColumn('property_address', function($listing) {
                    return $listing->vendor1_address;
                })
                ->addColumn('sale_details', function($listing) {
                    $details = $listing->method_of_sale;
                    if ($listing->auction_date) {
                        $details .= ' (Auction: ' . $listing->auction_date->format('M d, Y') . ')';
                    }
                    if ($listing->first_open_date) {
                        $details .= ' (First Open: ' . $listing->first_open_date->format('M d, Y') . ')';
                    }
                    return $details;
                })
                ->addColumn('agent_name', function($listing) {
                    return $listing->agent ? $listing->agent->name : 'N/A';
                })
                ->addColumn('action', function($listing) {
                    return '
                        <div class="action-buttons">
                            <button class="action-btn btn-outline-secondary btn-view view-btn" data-id="' . $listing->id . '" style="color:black;border:1px solid black;">
                                <i class="fas fa-eye me-1"></i> 
                            </button>
                            
                        </div>
                    ';
                })
                ->rawColumns(['contact_info', 'sale_details', 'action'])
                ->make(true);
        }

        $agents = Agent::where('agency_id', Auth::user()->id)
            ->orderBy('name')
            ->get();

        return view('agency.just-listed.index', compact('agents'));
    }

    public function show($id)
    {
        $listing = JustListed::with(['agent', 'hotLead'])->findOrFail($id);
        
        // Format dates for display
        $listing->formatted_auction_date = $listing->auction_date ? $listing->auction_date->format('M d, Y') : null;
        $listing->formatted_first_open_date = $listing->first_open_date ? $listing->first_open_date->format('M d, Y') : null;
        $listing->formatted_expressions_closing_date = $listing->expressions_closing_date ? $listing->expressions_closing_date->format('M d, Y') : null;
        $listing->formatted_all_appointments_date = $listing->all_appointments_date ? $listing->all_appointments_date->format('M d, Y') : null;
        $listing->formatted_photography_date = $listing->photography_date ? $listing->photography_date->format('M d, Y') : null;
        $listing->formatted_video_date = $listing->video_date ? $listing->video_date->format('M d, Y') : null;
        
        return response()->json([
            'success' => true,
            'data' => $listing
        ]);
    }

    public function destroy($id)
    {
        $listing = JustListed::findOrFail($id);
        $listing->delete();
        
        return response()->json([
            'success' => true,
            'message' => 'Just Listed property deleted successfully'
        ]);
    }
}