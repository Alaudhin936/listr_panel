<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\TempForConduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class TempForConductController extends Controller
{
    public function index()
    {
        $templates = TempForConduct::where('agent_id', Auth::guard('agent')->user()->id)->latest()->get();
        return view('agents.templates-for-conduct.index', compact('templates'));
    }

    public function store(Request $request)
    {
        $rules = [
            'name' => 'required|string|max:255',
            'type' => 'required|in:email,sms',
            'content' => 'required|string',
        ];

        if ($request->type === 'email') {
            $rules['subject'] = 'required|string|max:255';
        }

        $request->validate($rules);

        try {
            TempForConduct::create([
                'agent_id' => Auth::guard('agent')->user()->id,
                'name' => $request->name,
                'type' => $request->type,
                'subject' => $request->type === 'email' ? $request->subject : null,
                'content' => $request->content,
                'is_active' => true,
            ]);

            return response()->json([
                'success' => true,
                'message' => '✅ Template created successfully!'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error creating template: ' . $e->getMessage()
            ], 500);
        }
    }

    public function update(Request $request, TempForConduct $tempForConduct)
    {
        // Ensure the template belongs to the authenticated agent
        if ($tempForConduct->agent_id !== Auth::guard('agent')->user()->id) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized action.'
            ], 403);
        }

        $rules = [
            'name' => 'required|string|max:255',
            'type' => 'required|in:email,sms',
            'content' => 'required|string',
        ];

        if ($request->type === 'email') {
            $rules['subject'] = 'required|string|max:255';
        }

        $request->validate($rules);

        try {
            $tempForConduct->update([
                'name' => $request->name,
                'type' => $request->type,
                'subject' => $request->type === 'email' ? $request->subject : null,
                'content' => $request->content,
            ]);

            return response()->json([
                'success' => true,
                'message' => '✅ Template updated successfully!'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error updating template: ' . $e->getMessage()
            ], 500);
        }
    }

    public function destroy(TempForConduct $tempForConduct)
    {
        if ($tempForConduct->agent_id !== Auth::id()) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized action.'
            ], 403);
        }

        try {
            $tempForConduct->delete();

            return response()->json([
                'success' => true,
                'message' => '✅ Template deleted successfully!'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error deleting template: ' . $e->getMessage()
            ], 500);
        }
    }

    public function toggleStatus(TempForConduct $tempForConduct)
    {
        // Ensure the template belongs to the authenticated agent
        if ($tempForConduct->agent_id !== Auth::id()) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized action.'
            ], 403);
        }

        try {
            $tempForConduct->update([
                'is_active' => !$tempForConduct->is_active
            ]);

            $status = $tempForConduct->is_active ? 'activated' : 'deactivated';

            return response()->json([
                'success' => true,
                'message' => "✅ Template {$status} successfully!"
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error updating status: ' . $e->getMessage()
            ], 500);
        }
    }

  
}