<?php

namespace App\Http\Controllers;

use App\Models\PackageService;
use App\Models\PackageType;
use App\Models\TradePerson;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PackageCatagoryController extends Controller
{
    public function index()
    {
        $agentId = Auth::guard('agent')->user()->id;
        $packages = PackageType::where('agent_id', $agentId)->get();
        $suppliers = TradePerson::where('agent_id', $agentId)->get();
        $services = PackageService::where('agent_id', $agentId)
            ->get()
            ->groupBy('package_id');
        return view('agents.package.index', compact('packages', 'services', 'suppliers'));
    }

    public function store(Request $request)
    {

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'color_code' => 'required'
        ]);

        $package = PackageType::create([
            'name' => $validated['name'],
            'agent_id' =>  Auth::guard('agent')->user()->id,
            'color_code' => $validated['color_code'],
            'description' => $request->description
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Package Type added successfully!'
        ]);
    }

    public function destroy($id)
    {
        $package = PackageType::find($id);

        if ($package) {
            $package->delete();
            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false]);
    }

    public function serviceStore(Request $request)
    {
        $request->validate([
            'package_id' => 'required|exists:package_types,id',
            'supplier_id' => 'required|exists:trade_persons,id',
            'categories' => 'required|array',
            'categories.*.name' => 'required|string',
            'categories.*.services' => 'required|array|min:1',
            'categories.*.services.*' => 'required|string',
        ]);

        $agentId = Auth::guard('agent')->user()->id;

        foreach ($request->categories as $category) {
            PackageService::create([
                'service_catagory' => $category['name'],
                'services'        => json_encode($category['services']),
                'package_id'      => $request->package_id,
                'supplier_id'     => $request->supplier_id,
                'agent_id'        => $agentId,
                'booking_date'    => now()->format('Y-m-d'), 
            ]);
        }

        return response()->json([
            'success' => true,
            'message' => 'Services added successfully!'
        ]);
    }
}
