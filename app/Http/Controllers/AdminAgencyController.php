<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\Facades\DataTables;

class AdminAgencyController extends Controller
{
    public function index(Request $request)
    {
        $activeTab = $request->get('tab', 'manage');
        return view('admin.manage-agency', compact('activeTab'));
    }

    public function getAgencies(Request $request)
    {
        if ($request->ajax()) {
            $data = User::where('status', 'active')->latest()->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('status_badge', function($row) {
                    $badgeClass = $row->status == 'Approved' ? 'badge-success' : 'badge-warning';
                    return '<span class="badge '.$badgeClass.'">'.$row->status.'</span>';
                })
                   ->editColumn('created_at', function($row) {
                return $row->created_at->format('d/m/Y H:i:s'); 
            })
                ->addColumn('action', function($row) {
                    $btn = '<button class="btn btn-outline-primary btn-sm view-btn me-1" data-id="'.$row->id.'" style="background-color:blue">
                                <i class="fas fa-eye"></i>
                            </button>';
                    $btn .= '<button class="btn btn-outline-danger btn-sm delete-btn" data-id="'.$row->id.'"style="background-color:red">
                                <i class="fas fa-trash"></i>
                            </button>';
                    return $btn;
                })
                ->rawColumns(['status_badge', 'action'])
                ->make(true);
        }
    }
public function updateStatus(Request $request, $id)
{
    $validStatuses = ['active', 'approved', 'in_active', 'rejected'];
    
    if (!in_array($request->status, $validStatuses)) {
        return response()->json(['success' => false, 'message' => 'Invalid status'], 400);
    }

    $agency = User::findOrFail($id);
    $agency->status = $request->status;
    $agency->save();

    return response()->json([
        'success' => true,
        'message' => 'Status updated successfully'
    ]);
}
    public function getNewApplications(Request $request)
{
    if ($request->ajax()) {
        // Get applications created within the last 5 days
        $fiveDaysAgo = now()->subDays(5);
        $data = User::where('status', 'pending')
                   ->where('created_at', '>=', $fiveDaysAgo)
                   ->latest()
                   ->get();
                   
        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('status_badge', function($row) {
                return '<span class="badge badge-warning">'.$row->status.'</span>';
            })
            ->editColumn('created_at', function($row) {
                return $row->created_at->format('d/m/Y H:i:s'); 
            })
            ->addColumn('days_left', function($row) use ($fiveDaysAgo) {
                $expiresAt = $row->created_at->addDays(5);
                $daysLeft = now()->diffInDays($expiresAt, false);
                return $daysLeft > 0 ? $daysLeft . ' days left' : 'Expired';
            })
            ->addColumn('action', function($row) {
                $btn = '<button class="btn btn-outline-primary btn-sm view-btn me-1" data-id="'.$row->id.'"style="background-color:blue">
                            <i class="fas fa-eye"></i>
                        </button>';
                            $btn .= '<button class="btn btn-outline-danger btn-sm delete-btn" data-id="'.$row->id.'"style="background-color:red">
                                <i class="fas fa-trash"></i>
                            </button>';
              
                return $btn;
            })
            ->rawColumns(['status_badge', 'action'])
            ->make(true);
    }
}

    public function getInactiveAgencies(Request $request)
    {
        if ($request->ajax()) {
            $data = User::where('status', 'in_active')->latest()->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('status_badge', function($row) {
                    return '<span class="badge badge-danger">'.$row->status.'</span>';
                })
                   ->editColumn('created_at', function($row) {
                return $row->created_at->format('d/m/Y H:i:s'); 
            })
                ->addColumn('action', function($row) {
                    $btn = '<button class="btn btn-outline-primary btn-sm view-btn me-1" data-id="'.$row->id.'"style="background-color:blue">
                                <i class="fas fa-eye"></i>
                            </button>';
                                $btn .= '<button class="btn btn-outline-danger btn-sm delete-btn" data-id="'.$row->id.'"style="background-color:red">
                                <i class="fas fa-trash"></i>
                            </button>';
                 
                    return $btn;
                })
                ->rawColumns(['status_badge', 'action'])
                ->make(true);
        }
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'register_number' => 'required|string|max:255|unique:users',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'address_line1' => 'required|string|max:255',
            'state' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'zipcode' => 'required|string|max:20',
            'contact_person' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
        ]);

        $user = User::create([
            'name' => $request->name,
            'register_number' => $request->register_number,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'address_line1' => $request->address_line1,
            'address_line2' => $request->address_line2,
            'state' => $request->state,
            'city' => $request->city,
            'zipcode' => $request->zipcode,
            'contact_person' => $request->contact_person,
            'phone' => $request->phone,
            'landline' => $request->landline,
            'status' => 'pending',
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Agency registration submitted successfully! It will be reviewed soon.'
        ]);
    }

    public function show($id)
    {
        $agency = User::findOrFail($id);
        return response()->json([
            'success' => true,
            'data' => $agency
        ]);
    }

    public function approve($id)
    {
        $agency = User::findOrFail($id);
        $agency->update(['status' => 'active']);
        
        return response()->json([
            'success' => true,
            'message' => 'Agency approved successfully!'
        ]);
    }

    public function reject($id)
    {
        $agency = User::findOrFail($id);
        $agency->update(['status' => 'Rejected']);
        
        return response()->json([
            'success' => true,
            'message' => 'Agency rejected successfully!'
        ]);
    }

    public function activate($id)
    {
        $agency = User::findOrFail($id);
        $agency->update(['status' => 'active']);
        
        return response()->json([
            'success' => true,
            'message' => 'Agency activated successfully!'
        ]);
    }

    public function destroy($id)
    {
        $agency = User::findOrFail($id);
        $agency->delete();
        
        return response()->json([
            'success' => true,
            'message' => 'Agency deleted successfully!'
        ]);
    }
}