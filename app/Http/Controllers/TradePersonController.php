<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\TradePerson;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class TradePersonController extends Controller
{
    public function index()
    {
        $tradePersons = TradePerson::where('agent_id', Auth::guard('agent')->user()->id)
            ->latest()
            ->get();
            
        return view('agents.trade-person.index', compact('tradePersons'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'profession' => 'required|string|max:255',
            'email' => [
                'required', 
                'email', 
                Rule::unique('trade_persons')->where(function ($query) {
                    return $query->where('agent_id', Auth::guard('agent')->user()->id);
                })
            ],
            'phone' => 'required|string|max:20',
        ]);

        try {
            TradePerson::create([
                'agent_id' =>Auth::guard('agent')->user()->id, // Associate with authenticated agent
                'name' => $request->name,
                'profession' => $request->profession,
                'email' => $request->email,
                'phone' => $request->phone,
                'is_active' => true,
            ]);

            return response()->json([
                'success' => true,
                'message' => '✅ Trade person added successfully!'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error adding trade person: ' . $e->getMessage()
            ], 500);
        }
    }

    public function update(Request $request, TradePerson $tradePerson)
    {
        // Ensure the trade person belongs to the authenticated agent
        if ($tradePerson->agent_id !== Auth::id()) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized action.'
            ], 403);
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'profession' => 'required|string|max:255',
            'email' => [
                'required', 
                'email', 
                Rule::unique('trade_persons')
                    ->ignore($tradePerson->id)
                    ->where(function ($query) {
                        return $query->where('agent_id', Auth::id());
                    })
            ],
            'phone' => 'required|string|max:20',
        ]);

        try {
            $tradePerson->update([
                'name' => $request->name,
                'profession' => $request->profession,
                'email' => $request->email,
                'phone' => $request->phone,
            ]);

            return response()->json([
                'success' => true,
                'message' => '✅ Trade person updated successfully!'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error updating trade person: ' . $e->getMessage()
            ], 500);
        }
    }

    public function destroy(TradePerson $tradePerson)
    {
        if ($tradePerson->agent_id !== Auth::guard('agent')->user()->id) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized action.'
            ], 403);
        }

        try {
            $tradePerson->delete();

            return response()->json([
                'success' => true,
                'message' => '✅ Trade person deleted successfully!'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error deleting trade person: ' . $e->getMessage()
            ], 500);
        }
    }

    public function toggleStatus(TradePerson $tradePerson)
    {
        if ($tradePerson->agent_id !== Auth::guard('agent')->user()->id) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized action.'
            ], 403);
        }

        try {
            $tradePerson->update([
                'is_active' => !$tradePerson->is_active
            ]);

            $status = $tradePerson->is_active ? 'activated' : 'deactivated';

            return response()->json([
                'success' => true,
                'message' => "✅ Trade person {$status} successfully!"
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error updating status: ' . $e->getMessage()
            ], 500);
        }
    }

   
}