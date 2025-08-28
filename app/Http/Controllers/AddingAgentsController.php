<?php

namespace App\Http\Controllers;

use App\Models\Agent;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Validation\Rules\Password;

class AddingAgentsController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $agents = Agent::where('agency_id', auth()->id())
                         ->select(['id', 'name', 'email', 'phone', 'status', 'created_at'])
				->latest();
            
            return DataTables::of($agents)
                ->addColumn('status_badge', function($row) {
                    $icon = $row->status === 'active' ? 'check-circle' : 'clock';
                    $color = $row->status === 'active' ? 'success' : 'warning';
                    return '<span class="badge badge-'.$color.'"><i class="fas fa-'.$icon.' mr-1"></i>'.ucfirst($row->status).'</span>';
                })
                ->addColumn('action', function($row) {
                    return '
                        <button class="btn btn-sm btn-outline-secondary view-btn" data-id="'.$row->id.'" title="View Details">
                            <i class="fas fa-eye" style="color:black"></i>
                        </button>
                        <a href="'.route('agency.agents.edit', $row->id).'" class="btn btn-sm btn-outline-primary" title="Edit">
                            <i class="fas fa-edit" style="color:black"></i>
                        </a>
                        <button class="btn btn-sm btn-outline-danger delete-btn" data-id="'.$row->id.'" title="Delete">
                            <i class="fas fa-trash" style="color:black"></i>
                        </button>
                    ';
                })
                ->editColumn('created_at', function($row) {
                    return $row->created_at->format('d M Y');
                })
                ->rawColumns(['status_badge', 'action'])
                ->make(true);
        }
        
        return view('agency.manage-agents.index');
    }

    public function show(Agent $agent)
    {
        if ($agent->agency_id !== auth()->id()) {
            abort(403);
        }

        return response()->json([
            'success' => true,
            'data' => [
                'name' => $agent->name,
                'email' => $agent->email,
                'phone' => $agent->phone,
                'status' => ucfirst($agent->status),
                'address' => $agent->address_line1 . ($agent->address_line2 ? ', ' . $agent->address_line2 : ''),
                'city' => $agent->city,
                'state' => $agent->state,
                'zipcode' => $agent->zipcode,
                'created_at' => $agent->created_at->format('d M Y, h:i A'),
                'updated_at' => $agent->updated_at->format('d M Y, h:i A')
            ]
        ]);
    }

    public function create()
    {
        return view('agency.manage-agents.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:agents'],
            'password' => ['required', Rules\Password::defaults()],
            'address_line1' => ['required', 'string', 'max:255'],
            'address_line2' => ['nullable', 'string', 'max:255'],
            'city' => ['required', 'string', 'max:255'],
            'state' => ['required', 'string', 'max:255'],
            'zipcode' => ['required', 'string', 'max:20'],
            'phone' => ['required', 'string', 'max:20'],
        ]);

        try {
            Agent::create([
                'agency_id' => auth()->id(),
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'address_line1' => $request->address_line1,
                'address_line2' => $request->address_line2,
                'city' => $request->city,
                'state' => $request->state,
                'zipcode' => $request->zipcode,
                'phone' => $request->phone,
                'status' => 'active',
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Agent created successfully!',
                'redirect' => route('agency.agents.index')
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error creating agent: ' . $e->getMessage()
            ], 500);
        }
    }

    public function edit(Agent $agent)
    {
        if ($agent->agency_id !== auth()->id()) {
            abort(403);
        }

        return view('agency.manage-agents.edit', compact('agent'));
    }

    public function update(Request $request, Agent $agent)
    {
        if ($agent->agency_id !== auth()->id()) {
            abort(403);
        }

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:agents,email,'.$agent->id],
            'address_line1' => ['required', 'string', 'max:255'],
            'address_line2' => ['nullable', 'string', 'max:255'],
            'city' => ['required', 'string', 'max:255'],
            'state' => ['required', 'string', 'max:255'],
            'zipcode' => ['required', 'string', 'max:20'],
            'phone' => ['required', 'string', 'max:20'],
            'status' => ['required', 'in:active,pending'],
        ]);

        try {
            $agent->update($request->except('password'));

            return response()->json([
                'success' => true,
                'message' => 'Agent updated successfully!',
                'redirect' => route('agency.agents.index')
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error updating agent: ' . $e->getMessage()
            ], 500);
        }
    }

    public function destroy(Agent $agent)
    {
        if ($agent->agency_id !== auth()->id()) {
            abort(403);
        }

        try {
            $agent->delete();
            return response()->json([
                'success' => true,
                'message' => 'Agent deleted successfully!'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error deleting agent: ' . $e->getMessage()
            ], 500);
        }
    }
}