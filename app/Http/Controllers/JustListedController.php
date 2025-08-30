<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\JustListed;
use Illuminate\Http\Request;
use App\Models\JustListedForm;
use App\Models\ConductAppraisal;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class JustListedController extends Controller
{
    public function index(Request $request)
    {
        $query = JustListed::with(['agent', 'agency'])
            ->where('agent_id', Auth::guard('agent')->user()->id)
            ->latest();

        // Date range filter
        if ($request->has('start_date') && $request->start_date != '') {
            $query->whereDate('created_at', '>=', $request->start_date);
        }
        if ($request->has('end_date') && $request->end_date != '') {
            $query->whereDate('created_at', '<=', $request->end_date);
        }

        if ($request->ajax()) {
            return datatables()->of($query)
                ->addColumn('address', function ($listing) {
                    return $listing->property_address ?? 'N/A';
                })
                ->addColumn('vendor_name', function ($listing) {
                    return ($listing->vendor1_first_name ?? '') . ' ' . ($listing->vendor1_last_name ?? '');
                })
                ->addColumn('contact_info', function ($listing) {
                    return ($listing->vendor1_mobile ?? 'N/A') . '<br>' . ($listing->vendor1_email ?? '');
                })
                ->addColumn('appointment', function ($listing) {
                    return $listing->created_at->format('Y-m-d H:i'); // Formatted date
                })
                ->addColumn('actions', function ($listing) {
                    return '<div class="action-buttons">
                                <a href="' . route('agent.just-listed.edit', $listing->id) . '" class="action-btn btn-edit">
                                    <i class="fas fa-edit me-1"></i> Edit
                                </a>
                                <a href="' . route('agent.just-listed.destroy', $listing->id) . '" class="action-btn btn-delete">
                                    <i class="fas fa-trash me-1"></i> Delete
                                </a>
                            </div>';
                })
                ->rawColumns(['contact_info', 'actions'])
                ->make(true);
        }

        return view('agents.just-listed.index');
    }

    public function create()
    {

      $allAppraisals = ConductAppraisal::where('agent_id', Auth::guard('agent')->user()->id)
    ->orderBy('created_at', 'desc') // Most recent first
    ->get();

        // dd($allAppraisals);
        return view('agents.just-listed.create', compact('allAppraisals'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'vendor1_address' => 'required|string',
            'vendor1_first_name' => 'required|string|max:255',
            'vendor1_last_name' => 'required|string|max:255',
            'vendor1_mobile' => 'required|string|max:20',
            'vendor1_email' => 'required|email|max:255',

            // Vendor 2 validation (conditional)
            'vendor2_first_name' => 'nullable|required_if:has_additional_vendor,1|string|max:255',
            'vendor2_last_name' => 'nullable|required_if:has_additional_vendor,1|string|max:255',
            'vendor2_mobile' => 'nullable|required_if:has_additional_vendor,1|string|max:20',
            'vendor2_email' => 'nullable|required_if:has_additional_vendor,1|email|max:255',

            // Main contact validation
            'main_contact' => 'required|string',
            'main_contact_first_name' => 'nullable|required_if:main_contact,Someone else|string|max:255',
            'main_contact_last_name' => 'nullable|required_if:main_contact,Someone else|string|max:255',
            'main_contact_mobile' => 'nullable|required_if:main_contact,Someone else|string|max:20',
            'main_contact_email' => 'nullable|required_if:main_contact,Someone else|email|max:255',

            // Campaign details
            'method_of_sale' => 'nullable',
            'auction_date' => 'nullable|required_if:method_of_sale,Auction|date',
            'first_open_date' => 'nullable|date',
            'expressions_closing_date' => 'nullable|required_if:method_of_sale,Expression\'s Of Interest|date',
            'other_method_details' => 'nullable|required_if:method_of_sale,Other|string',
            'potential_auction_discussed' => 'nullable|string',
            'forthcoming_auction_date' => 'nullable|date',
            'campaign_overview_notes' => 'nullable|string',
            'campaign_recipient' => 'nullable|string',
            'custom_email' => 'nullable|email',

            // Agents
            'first_agent' => 'string',
            'first_agent_other' => 'nullable|required_if:first_agent,Other|string',
            'second_agent' => 'nullable|string',
            'second_agent_other' => 'nullable|required_if:second_agent,Other|string',
            'third_agent' => 'nullable|string',
            'third_agent_other' => 'nullable|required_if:third_agent,Other|string',

            // Privacy
            // 'privacy_consent' => 'required|boolean',
            'privacy_consent_trades' => 'nullable|boolean',

            // Marketing package
            'marketing_package' => 'nullable|string',

            // Photography services
            'photography_services' => 'nullable|array',
            'other_photography_requirements' => 'nullable|string',
            'photography_supplier' => 'nullable|string',

            // Copywriting
            'copywriting_services' => 'nullable|array',
            'copywriting_supplier' => 'nullable|string',

            // Floorplan
            'floorplan_services' => 'nullable|array',
            'floorplan_supplier' => 'nullable|string',

            // Supplier preferences
            'supplier_preferences' => 'nullable|string',

            // Property access for suppliers
            'supplier_access_method' => 'nullable|string',
            'vacant_access_type' => 'nullable|string',
            'keysafe_code' => 'nullable|string',
            'keysafe_location' => 'nullable|string',
            'other_keysafe_location' => 'nullable|string',
            'supplier_message' => 'nullable|string',

            // Other marketing
            'other_marketing_details' => 'nullable|string',

            // Other suppliers
            'supplier_name' => 'nullable|string',
            'supplier_category' => 'nullable|string',
            'supplier_requirements' => 'nullable|string',
            'supplier_mobile' => 'nullable|string',
            'supplier_email' => 'nullable|email',
            'supplier_contact_method' => 'nullable|string',

            // Appointment dates
            'all_appointments_date' => 'nullable|date',
            'floorplan_copywriting_date' => 'nullable|date',
            'photography_date' => 'nullable|date',
            'video_date' => 'nullable|date',
            'custom_booking_instructions' => 'nullable|string',
            'booking_handler' => 'nullable|string',
            'save_as_default' => 'nullable|boolean',

            // Property access
            'occupancy_status' => 'nullable',
            'renters_name' => 'nullable',
            'renters_phone' => 'nullable|string',
            'property_access' => 'string|nullable',
            'other_access_arrangements' => 'nullable|required_if:property_access,Other|string',
            'keysafe_type' => 'nullable|string',
            'key_location_text' => 'nullable|string',
            'key_location_photo' => 'nullable|file',
            'alarm_system' => 'nullable|string',
            'alarm_instructions' => 'nullable|string',
            'additional_notes' => 'nullable|string',

            // Trades
            'trades_contacts' => 'nullable|array',
            'other_trades_contact' => 'nullable|string',
            'trades_contact_method' => 'nullable|string',
            'trades_require_access' => 'nullable|array',
            'other_trades_needed' => 'nullable|string',
            'trades_access_method' => 'nullable|string',
            'vacant_access_instructions' => 'nullable|string',
            'vacant_access_code' => 'nullable|string',
            'painting_notes' => 'nullable|string',
            'gardening_notes' => 'nullable|string',

            'conduct_appraisal_id' => 'nullable|exists:conduct_appraisals,id',
        ]);

        // Process array fields
        $arrayFields = [
            'photography_services',
            'copywriting_services',
            'floorplan_services',
            'appointment_schedule_options',
            'trades_contacts',
            'trades_require_access'
        ];

        foreach ($arrayFields as $field) {
            if (isset($validated[$field])) {
                $validated[$field] = json_encode($validated[$field]);
            }
        }

        $validated['conduct_appraisal_id'] = $request->conduct_appraisal_id;
        $validated['agent_id'] = Auth::guard('agent')->user()->id;
        $validated['agency_id'] = Auth::guard('agent')->user()->agency_id;

        // Handle file upload
        if ($request->hasFile('key_location_photo')) {
            $path = $request->file('key_location_photo')->store('key_locations', 'public');
            $validated['key_location_photo'] = $path;
        }

        $form = JustListed::create($validated);

        if ($validated['conduct_appraisal_id']) {
            ConductAppraisal::where('id', $validated['conduct_appraisal_id'])->update(['converted_to_just_listed' => true]);
        }

        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Just Listed form submitted successfully!',
                'data' => $form
            ]);
        }

        return redirect()->back()->with('success', 'Just Listed form submitted successfully!');
    }

    public function show($id)
    {
        $form = JustListed::where('id', $id)
            ->where('agent_id', Auth::guard('agent')->user()->id)
            ->firstOrFail();

        // Format the date fields directly
        $form->auction_date = $form->auction_date
            ? Carbon::parse($form->auction_date)->format('d M Y')
            : null;

        $form->first_open_date = $form->first_open_date
            ? Carbon::parse($form->first_open_date)->format('d M Y')
            : null;

        $form->expressions_closing_date = $form->expressions_closing_date
            ? Carbon::parse($form->expressions_closing_date)->format('d M Y')
            : null;

        return response()->json([
            'success' => true,
            'data' => $form
        ]);
    }

    public function destroy($id)
    {
        $appraisal = JustListed::findOrFail($id);

        if (Auth::guard('agent')->user()->id !== $appraisal->agent_id) {
            abort(403, 'Unauthorized action.');
        }

        $appraisal->delete();

        return response()->json([
            'success' => true,
            'message' => 'Just Listed form deleted successfully'
        ]);
    }
}
