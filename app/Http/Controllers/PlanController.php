<?php

namespace App\Http\Controllers;

use App\Models\Plan;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Exception;

class PlanController extends Controller
{
    /**
     * Display the plan management page
     */
    public function index()
    {
        return view('admin.plans.index');
    }

    /**
     * Get all plans for display
     */
    public function getPlans()
    {
    
            $plans = Plan::orderBy('type')
                        ->orderBy('price')
                        ->get();
            return response()->json([
                'success' => true,
                'data' => $plans
            ]);
        
    }

    /**
     * Get active plans for public display
     */
    public function getActivePlans()
    {
        try {
            $agencyPlans = Plan::where('type', 'agency')
                              ->where('is_active', true)
                              ->orderBy('price')
                              ->get();

            $agentPlans = Plan::where('type', 'agent')
                             ->where('is_active', true)
                             ->orderBy('price')
                             ->get();

            return response()->json([
                'success' => true,
                'data' => [
                    'agency' => $agencyPlans,
                    'agent' => $agentPlans
                ]
            ]);

        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to fetch active plans'
            ], 500);
        }
    }

    /**
     * Duplicate a plan
     */
    public function duplicate(Plan $plan)
    {
        try {
            $newPlan = $plan->replicate();
            $newPlan->name = $plan->name . ' (Copy)';
            $newPlan->is_active = false; // Deactivate by default
            $newPlan->save();

            return response()->json([
                'success' => true,
                'message' => 'Plan duplicated successfully',
                'data' => $newPlan
            ]);

        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to duplicate plan'
            ], 500);
        }
    }


    /**
     * Store a new plan
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|string|max:255',
                'type' => 'required|in:agency,agent',
                'price' => 'required|numeric|min:0',
                'duration_days' => 'required|integer|min:1',
                'max_agents' => 'nullable|integer|min:1',
                'is_active' => 'boolean'
            ]);

            // Ensure max_agents is null for agent plans
            $maxAgents = $request->type === 'agent' ? null : $request->max_agents;

            $plan = Plan::create([
                'name' => $request->name,
                'type' => $request->type,
                'price' => $request->price,
                'duration_days' => $request->duration_days,
                'max_agents' => $maxAgents,
                'is_active' => $request->boolean('is_active', true)
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Plan created successfully',
                'data' => $plan
            ]);

        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $e->errors()
            ], 422);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to create plan'
            ], 500);
        }
    }

    /**
     * Show a specific plan
     */
    public function show(Plan $plan)
    {
        try {
            return response()->json([
                'success' => true,
                'data' => $plan
            ]);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Plan not found'
            ], 404);
        }
    }

    /**
     * Update an existing plan
     */
    public function update(Request $request, Plan $plan)
    {
        try {
            $request->validate([
                'name' => 'required|string|max:255',
                'type' => 'required|in:agency,agent',
                'price' => 'required|numeric|min:0',
                'duration_days' => 'required|integer|min:1',
                'max_agents' => 'nullable|integer|min:1',
                'is_active' => 'boolean'
            ]);

            // Ensure max_agents is null for agent plans
            $maxAgents = $request->type === 'agent' ? null : $request->max_agents;

            $plan->update([
                'name' => $request->name,
                'type' => $request->type,
                'price' => $request->price,
                'duration_days' => $request->duration_days,
                'max_agents' => $maxAgents,
                'is_active' => $request->boolean('is_active', true)
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Plan updated successfully',
                'data' => $plan->fresh()
            ]);

        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $e->errors()
            ], 422);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to update plan'
            ], 500);
        }
    }

    /**
     * Delete a plan
     */
    public function destroy(Plan $plan)
    {
        try {
            // Check if plan is being used by any subscriptions
            // Uncomment this when you have subscriptions table
            /*
            if ($plan->subscriptions()->exists()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Cannot delete plan that has active subscriptions'
                ], 400);
            }
            */

            $plan->delete();

            return response()->json([
                'success' => true,
                'message' => 'Plan deleted successfully'
            ]);

        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to delete plan'
            ], 500);
        }
    }

    /**
     * Toggle plan status
     */
    public function toggleStatus(Plan $plan)
    {
        try {
            $plan->update([
                'is_active' => !$plan->is_active
            ]);

            $status = $plan->is_active ? 'activated' : 'deactivated';

            return response()->json([
                'success' => true,
                'message' => "Plan {$status} successfully",
                'data' => $plan->fresh()
            ]);

        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to update plan status'
            ], 500);
        }
    }

    /**
     * Get plans by type
     */
    public function getPlansByType(Request $request)
    {
        try {
            $type = $request->get('type');
            
            if (!in_array($type, ['agency', 'agent'])) {
                return response()->json([
                    'success' => false,
                    'message' => 'Invalid plan type'
                ], 400);
            }

            $plans = Plan::where('type', $type)
                        ->where('is_active', true)
                        ->orderBy('price')
                        ->get();

            return response()->json([
                'success' => true,
                'data' => $plans
            ]);

        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to fetch plans'
            ], 500);
        }
    }
}