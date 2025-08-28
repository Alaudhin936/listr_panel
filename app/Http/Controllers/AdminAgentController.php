<?php

namespace App\Http\Controllers;

use App\Models\Agent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\Facades\DataTables;

class AdminAgentController extends Controller
{
    public function index(Request $request)
    {
        $activeTab = $request->get('tab', 'manage');
        return view('admin.manage-agent', compact('activeTab'));
    }

    public function getAgents(Request $request)
    {
        if ($request->ajax()) {
            $data = Agent::where('status', 'active')->latest()->get();
            return DataTables::of($data)
                ->addIndexColumn()
              
                ->editColumn('created_at', function($row) {
                    return $row->created_at->format('d/m/Y H:i:s'); 
                })
                ->addColumn('action', function($row) {
                    $btn = '<button class="btn btn-outline-primary btn-sm view-btn me-1" data-id="'.$row->id.'"style="background-color:blue;">
                                <i class="fas fa-eye"></i>
                            </button>';
                    $btn .= '<button class="btn btn-outline-danger btn-sm delete-btn" data-id="'.$row->id.'"style="background-color:red;">
                                <i class="fas fa-trash"></i>
                            </button>';
                    return $btn;
                })
                ->rawColumns(['status', 'action'])
                ->make(true);
        }
    }

    public function getNewApplications(Request $request)
    {
        if ($request->ajax()) {
            $data = Agent::where('status', 'pending')->latest()->get();
            return DataTables::of($data)
                ->addIndexColumn()
               
                ->editColumn('created_at', function($row) {
                    return $row->created_at->format('d/m/Y H:i:s'); 
                })
                ->addColumn('action', function($row) {
                    $btn = '<button class="btn btn-outline-primary btn-sm view-btn me-1" data-id="'.$row->id.'"style="background-color:blue;">
                                <i class="fas fa-eye"></i>
                            </button>';
                       $btn .= '<button class="btn btn-outline-danger btn-sm delete-btn" data-id="'.$row->id.'"style="background-color:red;">
                                <i class="fas fa-trash"></i>
                            </button>';
                    return $btn;
                })
                ->rawColumns(['status', 'action'])
                ->make(true);
        }
    }

    public function getInactiveAgents(Request $request)
    {
        if ($request->ajax()) {
            $data = Agent::where('status', 'in_active')->latest()->get();
            return DataTables::of($data)
                ->addIndexColumn()
              
                ->editColumn('created_at', function($row) {
                    return $row->created_at->format('d/m/Y H:i:s'); 
                })
                ->addColumn('action', function($row) {
                    $btn = '<button class="btn btn-outline-primary btn-sm view-btn me-1" data-id="'.$row->id.'"style="background-color:blue;">
                                <i class="fas fa-eye"></i>
                            </button>';
                     $btn .= '<button class="btn btn-outline-danger btn-sm delete-btn" data-id="'.$row->id.'"style="background-color:red;">
                                <i class="fas fa-trash"></i>
                            </button>';
                    return $btn;
                })
                ->rawColumns(['status', 'action'])
                ->make(true);
        }
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:agents',
            'password' => 'required|string|min:8|confirmed',
            'address_line1' => 'required|string|max:255',
            'state' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'zipcode' => 'required|string|max:20',
            'phone' => 'required|string|max:20',
        ]);

        $agent = Agent::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'address_line1' => $request->address_line1,
            'address_line2' => $request->address_line2,
            'state' => $request->state,
            'city' => $request->city,
            'zipcode' => $request->zipcode,
            'phone' => $request->phone,
            'status' => 'pending',
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Agent registration submitted successfully! It will be reviewed soon.'
        ]);
    }

    public function show($id)
    {
        $agent = Agent::findOrFail($id);
        return response()->json([
            'success' => true,
            'data' => $agent
        ]);
    }

    public function updateStatus(Request $request, $id)
    {
        $validStatuses = ['active', 'pending', 'in_active', 'rejected'];
        
        if (!in_array($request->status, $validStatuses)) {
            return response()->json(['success' => false, 'message' => 'Invalid status'], 400);
        }

        $agent = Agent::findOrFail($id);
        $agent->status = $request->status;
        $agent->save();

        return response()->json([
            'success' => true,
            'message' => 'Status updated successfully'
        ]);
    }

    public function approve($id)
    {
        $agent = Agent::findOrFail($id);
        $agent->update(['status' => 'active']);
        
        return response()->json([
            'success' => true,
            'message' => 'Agent approved successfully!'
        ]);
    }

    public function reject($id)
    {
        $agent = Agent::findOrFail($id);
        $agent->update(['status' => 'rejected']);
        
        return response()->json([
            'success' => true,
            'message' => 'Agent rejected successfully!'
        ]);
    }

    public function activate($id)
    {
        $agent = Agent::findOrFail($id);
        $agent->update(['status' => 'active']);
        
        return response()->json([
            'success' => true,
            'message' => 'Agent activated successfully!'
        ]);
    }

    public function destroy($id)
    {
        $agent = Agent::findOrFail($id);
        $agent->delete();
        
        return response()->json([
            'success' => true,
            'message' => 'Agent deleted successfully!'
        ]);
    }
}