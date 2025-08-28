<?php

namespace App\Http\Controllers;

use App\Models\ConductAppraisal;
use App\Models\Agent;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class AgencyConductAppraisalController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $appraisals = ConductAppraisal::with('agent')
                ->where('agency_id', Auth::user()->id)
                ->select([
                    'id',
                    'agent_id',
                    'vendor1_address',
                    'vendor1_first_name',
                    'vendor1_last_name',
                    'vendor1_mobile',
                    'vendor1_email',
                    'property_type',
                    'bedrooms',
                    'bathrooms',
                    'land_size',
                    'created_at',
                    'updated_at'
                ])
				->latest();

            if ($request->has('agent_id') && $request->agent_id != '') {
                $appraisals->where('agent_id', $request->agent_id);
            }

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
                ->addColumn('property_details', function($appraisal) {
                    return $appraisal->property_type . ', ' . 
                           $appraisal->bedrooms . 'bd, ' . 
                           $appraisal->bathrooms . 'ba, ' . 
                           $appraisal->land_size . 'sqm';
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
                ->rawColumns(['contact_info', 'property_details', 'action'])
                ->make(true);
        }
        $agents = Agent::where('agency_id', Auth::user()->id)
            ->orderBy('name')
            ->get();

        return view('agency.conduct-appraisal.index', compact('agents'));
    }

   public function show($id)
{
    $appraisal = ConductAppraisal::with('agent')->findOrFail($id);
    
    $photos = [];
    if ($appraisal->photos) {
        $photoArray = is_array($appraisal->photos) ? $appraisal->photos : json_decode($appraisal->photos, true);
        
        if ($photoArray) {
            foreach ($photoArray as $photo) {
                if ($photo) { 
                    $photos[] = asset($photo); 
                }
            }
        }
    }
    
    $comparablePhotos = [];
    if ($appraisal->comparable_photos) {
        $comparableArray = is_array($appraisal->comparable_photos) ? $appraisal->comparable_photos : json_decode($appraisal->comparable_photos, true);
        
        if ($comparableArray) {
            foreach ($comparableArray as $photo) {
                if ($photo) { 
                    $comparablePhotos[] = asset($photo);  
                }
            }
        }
    }
    
    $appraisal->formatted_photos = $photos;
    $appraisal->formatted_comparable_photos = $comparablePhotos;
    
    return response()->json([
        'success' => true,
        'data' => $appraisal
    ]);
}
    public function destroy($id)
    {
        $appraisal = ConductAppraisal::findOrFail($id);
        
        // Delete associated photos
        if ($appraisal->photos) {
            foreach (json_decode($appraisal->photos) as $photo) {
                Storage::delete($photo);
            }
        }
        
        if ($appraisal->comparable_photos) {
            foreach (json_decode($appraisal->comparable_photos) as $photo) {
                Storage::delete($photo);
            }
        }
        
        $appraisal->delete();
        
        return response()->json([
            'success' => true,
            'message' => 'Conduct appraisal deleted successfully'
        ]);
    }
}