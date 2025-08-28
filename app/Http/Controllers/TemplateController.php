<?php

namespace App\Http\Controllers;

use App\Models\Template;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TemplateController extends Controller
{
    /**
     * Display templates for the authenticated agent
     */
    public function index()
    {
        $templates = Template::where('agent_id', auth()->guard('agent')->user()->id)
            ->orderBy('type')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('agents.master-list.index', compact('templates'));
    }

    /**
     * Store a newly created template
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'type' => 'required|in:email,sms',
            'content' => 'required|string',
            'subject' => 'required_if:type,email|string|max:255|nullable',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        $template = Template::create([
            'agent_id' => auth()->guard('agent')->user()->id,
            'name' => $request->name,
            'type' => $request->type,
            'content' => $request->content,
            'subject' => $request->type === 'email' ? $request->subject : null,
            'is_active' => true
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Template created successfully!',
            'template' => $template
        ]);
    }

    /**
     * Update the specified template
     */
    public function update(Request $request, Template $template)
    {
        // Ensure the template belongs to the authenticated agent
        if ($template->agent_id !== auth()->guard('agent')->user()->id) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized access.'
            ], 403);
        }

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'type' => 'required|in:email,sms',
            'content' => 'required|string',
            'subject' => 'required_if:type,email|string|max:255|nullable',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        $template->update([
            'name' => $request->name,
            'type' => $request->type,
            'content' => $request->content,
            'subject' => $request->type === 'email' ? $request->subject : null,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Template updated successfully!',
            'template' => $template->fresh()
        ]);
    }

    /**
     * Remove the specified template
     */
    public function destroy(Template $template)
    {
        // Ensure the template belongs to the authenticated agent
        if ($template->agent_id !== auth()->guard('agent')->user()->id) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized access.'
            ], 403);
        }

        $template->delete();

        return response()->json([
            'success' => true,
            'message' => 'Template deleted successfully!'
        ]);
    }

    /**
     * Toggle template status
     */
    public function toggleStatus(Template $template)
    {
        // Ensure the template belongs to the authenticated agent
        if ($template->agent_id !== auth()->guard('agent')->user()->id) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized access.'
            ], 403);
        }

        $template->update([
            'is_active' => !$template->is_active
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Template status updated successfully!',
            'is_active' => $template->is_active
        ]);
    }

    /**
     * Get templates for dropdown (used in forms)
     */
    public function getTemplates(Request $request)
    {
        $type = $request->get('type', 'email'); // Default to email
        
        $templates = Template::where('agent_id', auth()->guard('agent')->user()->id)
            ->where('type', $type)
            ->where('is_active', true)
            ->select('id', 'name', 'content', 'subject')
            ->get();

        return response()->json([
            'success' => true,
            'templates' => $templates
        ]);
    }
}