<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Agent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class SubscriptionController extends Controller
{
    public function index()
    {
        // Calculate monthly revenue and statistics
        $currentMonth = Carbon::now()->startOfMonth();
        $lastMonth = Carbon::now()->subMonth()->startOfMonth();
        
        // Monthly revenue calculation (assuming revenue per agency/plan)
        $monthlyRevenue = User::where('status', 'active')
            ->whereNotNull('plan_start_date')
            ->whereBetween('plan_start_date', [$currentMonth, Carbon::now()])
            ->count() * 500; // Assuming $500 per plan
            
        $lastMonthRevenue = User::where('status', 'Approved')
            ->whereNotNull('plan_start_date')
            ->whereBetween('plan_start_date', [$lastMonth, $currentMonth])
            ->count() * 500;
            
        $revenueChange = $lastMonthRevenue > 0 ? 
            (($monthlyRevenue - $lastMonthRevenue) / $lastMonthRevenue) * 100 : 0;

        // Total agencies
        $totalAgencies = User::count();
        $lastMonthAgencies = User::where('created_at', '<', $currentMonth)->count();
        $agencyChange = $lastMonthAgencies > 0 ? 
            (($totalAgencies - $lastMonthAgencies) / $lastMonthAgencies) * 100 : 0;

        // Total agents
        $totalAgents = Agent::count();
        $lastMonthAgents = Agent::where('created_at', '<', $currentMonth)->count();
        $agentChange = $lastMonthAgents > 0 ? 
            (($totalAgents - $lastMonthAgents) / $lastMonthAgents) * 100 : 0;

        // Chart data for last 6 months
        $chartData = $this->getSubscriptionTrends();
        
        // Recent invoices/payments data
        $recentPayments = $this->getRecentPayments();

        return view('admin.subscription', compact(
            'monthlyRevenue', 'revenueChange', 'totalAgencies', 'agencyChange',
            'totalAgents', 'agentChange', 'chartData', 'recentPayments'
        ));
    }

    public function getInvoicesData(Request $request)
    {
        $query = User::select([
            'id',
            'name',
            'email', 
            'phone',
            'status',
            'plan_start_date',
            'plan_end_date',
            'created_at'
        ])
        ->whereNotNull('plan_start_date');

        return datatables($query)
            ->addColumn('amount', function ($agency) {
                return 'A$' . number_format(500, 2); // Fixed amount per plan
            })
            ->addColumn('date', function ($agency) {
                return $agency->plan_start_date ? 
                    Carbon::parse($agency->plan_start_date)->format('d-m-y') : '-';
            })
            ->addColumn('payment_status', function ($agency) {
                $status = $this->getPaymentStatus($agency);
                $badgeClass = match($status) {
                    'Paid' => 'success',
                    'Pending' => 'warning',
                    'Failed' => 'danger',
                    default => 'secondary'
                };
                return "<span class='badge bg-{$badgeClass}'>{$status}</span>";
            })
            ->addColumn('subscribers', function ($agency) {
                return $agency->name;
            })
            ->rawColumns(['payment_status'])
            ->make(true);
    }

    public function invoicesDetail()
    {
        return view('admin.invoice');
    }

    public function exportInvoices($type)
    {
        $invoices = User::select([
            'name',
            'email',
            'phone', 
            'status',
            'plan_start_date',
            'plan_end_date',
            'created_at'
        ])
        ->whereNotNull('plan_start_date')
        ->orderBy('plan_start_date', 'desc')
        ->get();

        if ($type === 'pdf') {
            return $this->exportToPDF($invoices);
        } elseif ($type === 'excel') {
            return $this->exportToExcel($invoices);
        }

        return redirect()->back();
    }

    private function getSubscriptionTrends()
    {
        $months = [];
        $newSubscriptions = [];
        $renewals = [];
        $cancellations = [];

        for ($i = 5; $i >= 0; $i--) {
            $date = Carbon::now()->subMonths($i);
            $months[] = $date->format('M');
            
            $startOfMonth = $date->startOfMonth();
            $endOfMonth = $date->endOfMonth();
            
            // New subscriptions (new agencies)
            $new = User::whereBetween('created_at', [$startOfMonth, $endOfMonth])->count();
            $newSubscriptions[] = $new;
            
            // Renewals (agencies with plan renewals)
            $renewalsCount = User::whereBetween('plan_start_date', [$startOfMonth, $endOfMonth])
                ->where('created_at', '<', $startOfMonth)->count();
            $renewals[] = $renewalsCount;
            
            // Cancellations (agencies marked as inactive)
            $cancelCount = User::where('status', 'Inactive')
                ->whereBetween('updated_at', [$startOfMonth, $endOfMonth])->count();
            $cancellations[] = $cancelCount;
        }

        return [
            'months' => $months,
            'new' => $newSubscriptions,
            'renewals' => $renewals,
            'cancellations' => $cancellations
        ];
    }

    private function getRecentPayments()
    {
        return User::select([
            'id', 'name', 'email', 'status', 'plan_start_date', 'created_at'
        ])
        ->whereNotNull('plan_start_date')
        ->orderBy('plan_start_date', 'desc')
        ->limit(6)
        ->get()
        ->map(function ($agency) {
            return [
                'id' => $agency->id,
                'subscriber' => $agency->name,
                'amount' => 'A$500',
                'date' => Carbon::parse($agency->plan_start_date)->format('d-m-y'),
                'status' => $this->getPaymentStatus($agency)
            ];
        });
    }

    private function getPaymentStatus($agency)
    {
        if (!$agency->plan_end_date) {
            return 'Pending';
        }
        
        $now = Carbon::now();
        $planEnd = Carbon::parse($agency->plan_end_date);
        
        if ($agency->status === 'Approved' && $planEnd->isFuture()) {
            return 'Paid';
        } elseif ($agency->status === 'Pending') {
            return 'Pending';
        } else {
            return 'Failed';
        }
    }

    private function exportToPDF($invoices)
    {
        $pdf = app('dompdf.wrapper');
        $html = view('admin.invoice-export', compact('invoices'))->render();
        $pdf->loadHTML($html);
        
        return $pdf->download('invoices-' . date('Y-m-d') . '.pdf');
    }

    private function exportToExcel($invoices)
    {
        $filename = 'invoices-' . date('Y-m-d') . '.csv';
        
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ];

        $callback = function() use ($invoices) {
            $file = fopen('php://output', 'w');
            
            // Add CSV headers
            fputcsv($file, [
                'Agency Name',
                'Email',
                'Phone',
                'Amount',
                'Status', 
                'Plan Start',
                'Plan End',
                'Created Date'
            ]);

            // Add data rows
            foreach ($invoices as $invoice) {
                fputcsv($file, [
                    $invoice->name,
                    $invoice->email,
                    $invoice->phone,
                    'A$500.00',
                    $this->getPaymentStatus($invoice),
                    $invoice->plan_start_date ? Carbon::parse($invoice->plan_start_date)->format('Y-m-d') : '-',
                    $invoice->plan_end_date ? Carbon::parse($invoice->plan_end_date)->format('Y-m-d') : '-',
                    $invoice->created_at->format('Y-m-d')
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}