@extends('adminlayout.master')

@section('main_content')
<link href="https://cdn.datatables.net/1.13.8/css/dataTables.bootstrap5.min.css" rel="stylesheet">
<link href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.bootstrap5.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<style>
    
    .page-wrapper {
        background: #f8f9fa;
        min-height: 100vh;
    }
    .stats-card {
        border: none;
        box-shadow: 0 0.15rem 1.75rem 0 rgba(33, 40, 50, 0.05);
        border-radius: 0.75rem;
        background: #fff;
        transition: transform 0.2s ease;
    }
    .stats-card:hover {
        transform: translateY(-2px);
    }
    .stats-value {
        font-size: 2rem;
        font-weight: 700;
        color: #212529;
        margin: 0;
    }
    .stats-label {
        color: #6c757d;
        font-size: 0.875rem;
        margin: 0;
    }
    .stats-change {
        font-size: 0.75rem;
        font-weight: 500;
    }
    .change-positive {
        color: #28a745;
    }
    .change-negative {
        color: #dc3545;
    }
    .stats-icon {
        width: 48px;
        height: 48px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.25rem;
        color: #fff;
    }
    .icon-revenue {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    }
    .icon-agencies {
        background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
    }
    .icon-agents {
        background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
    }
    .card {
        border: none;
        box-shadow: 0 0.15rem 1.75rem 0 rgba(33, 40, 50, 0.05);
        border-radius: 0.75rem;
        background-color: #fff;
    }
    .card-header {
        background: #fff;
        border-bottom: 1px solid rgba(0, 0, 0, 0.05);
        border-radius: 0.75rem 0.75rem 0 0 !important;
        padding: 1.5rem;
    }
    .card-title {
        color: #212529;
        font-weight: 600;
        margin: 0;
        font-size: 1.25rem;
    }
    .btn-link {
        color: #000;
        text-decoration: none;
        font-weight: 500;
        font-size: 0.875rem;
    }
    .btn-link:hover {
        color: #333;
        text-decoration: underline;
    }
    .chart-container {
        position: relative;
        height: 300px;
        width: 100%;
    }
    .table {
        margin-bottom: 0;
        color: #212529;
    }
    .table thead th {
        border-top: none;
        border-bottom: 2px solid rgba(0, 0, 0, 0.05);
        font-weight: 600;
        color: #495057;
        padding: 1rem;
        background-color: #f8f9fa;
    }
    .table td {
        padding: 1rem;
        vertical-align: middle;
        border-top: 1px solid rgba(0, 0, 0, 0.03);
    }
    .badge {
        font-weight: 500;
        padding: 0.35em 0.65em;
        font-size: 0.75em;
        border-radius: 0.375rem;
    }
    .donut-chart {
        width: 200px;
        height: 200px;
        margin: 0 auto;
        position: relative;
    }
    .donut-legend {
        display: flex;
        justify-content: center;
        gap: 20px;
        margin-top: 1rem;
    }
    .legend-item {
        display: flex;
        align-items: center;
        gap: 8px;
        font-size: 0.875rem;
    }
    .legend-color {
        width: 12px;
        height: 12px;
        border-radius: 50%;
    }
    .refresh-btn {
        background: none;
        border: none;
        color: #6c757d;
        font-size: 1rem;
        cursor: pointer;
        transition: color 0.2s ease;
    }
    .refresh-btn:hover {
        color: #000;
    }
    .section-title {
        color: #212529;
        font-weight: 600;
        margin-bottom: 1.5rem;
        font-size: 1.5rem;
    }
</style>

<div class="page-wrapper compact-wrapper" id="pageWrapper">
    <div class="page-body-wrapper">
        <div class="page-body1">
            <div class="container-fluid">
                <!-- Dashboard Header -->
                <div class="row mb-4">
                    <div class="col-12">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h4 class="section-title mb-0">
                                    <i class="fas fa-chart-line me-2"></i>Monthly Overview
                                </h4>
                                <p class="text-muted mb-0">Track new sign-ups, renewals, and cancellations month over month.</p>
                            </div>
                            <button class="refresh-btn" onclick="refreshDashboard()">
                                <i class="fas fa-sync-alt"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Stats Cards -->
                <div class="row mb-4">
                    <div class="col-xl-4 col-md-6 mb-3">
                        <div class="stats-card p-3">
                            <div class="d-flex align-items-center">
                                <div class="stats-icon icon-revenue me-3">
                                    <i class="fas fa-dollar-sign"></i>
                                </div>
                                <div class="flex-grow-1">
                                    <h3 class="stats-value">A${{ number_format($monthlyRevenue, 0) }}</h3>
                                    <p class="stats-label">MRR This Month</p>
                                    <small class="stats-change {{ $revenueChange >= 0 ? 'change-positive' : 'change-negative' }}">
                                        <i class="fas fa-arrow-{{ $revenueChange >= 0 ? 'up' : 'down' }}"></i>
                                        {{ number_format(abs($revenueChange), 1) }}%
                                    </small>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-md-6 mb-3">
                        <div class="stats-card p-3">
                            <div class="d-flex align-items-center">
                                <div class="stats-icon icon-agencies me-3">
                                    <i class="fas fa-building"></i>
                                </div>
                                <div class="flex-grow-1">
                                    <h3 class="stats-value">{{ $totalAgencies }}</h3>
                                    <p class="stats-label">Total Agencies</p>
                                    <small class="stats-change {{ $agencyChange >= 0 ? 'change-positive' : 'change-negative' }}">
                                        <i class="fas fa-arrow-{{ $agencyChange >= 0 ? 'up' : 'down' }}"></i>
                                        {{ number_format(abs($agencyChange), 1) }}%
                                    </small>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-md-6 mb-3">
                        <div class="stats-card p-3">
                            <div class="d-flex align-items-center">
                                <div class="stats-icon icon-agents me-3">
                                    <i class="fas fa-users"></i>
                                </div>
                                <div class="flex-grow-1">
                                    <h3 class="stats-value">{{ $totalAgents }}</h3>
                                    <p class="stats-label">Total Agents</p>
                                    <small class="stats-change {{ $agentChange >= 0 ? 'change-positive' : 'change-negative' }}">
                                        <i class="fas fa-arrow-{{ $agentChange >= 0 ? 'up' : 'down' }}"></i>
                                        {{ number_format(abs($agentChange), 1) }}%
                                    </small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <!-- Subscription Trends Chart -->
                    <div class="col-xl-8 mb-4">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h5 class="card-title">Our Total Subscription</h5>
                                <small class="text-muted">Last 6 Months - Track new sign-ups, renewals, and cancellations month over month</small>
                            </div>
                            <div class="card-body">
                                <div class="chart-container">
                                    <canvas id="subscriptionChart"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Plan Distribution -->
                    <div class="col-xl-4 mb-4">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title">Plan Distribution</h5>
                            </div>
                            <div class="card-body text-center">
                                <div class="donut-chart">
                                    <canvas id="planChart" width="200" height="200"></canvas>
                                    <div style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%);">
                                        <div style="font-size: 2rem; font-weight: bold; color: #212529;">{{ floor(($totalAgents / max($totalAgencies, 1)) * 100) }}%</div>
                                        <div style="font-size: 0.875rem; color: #6c757d;">Agencies</div>
                                    </div>
                                </div>
                                <div class="donut-legend">
                                    <div class="legend-item">
                                        <div class="legend-color" style="background-color: #212529;"></div>
                                        <span>Agencies</span>
                                    </div>
                                    <div class="legend-item">
                                        <div class="legend-color" style="background-color: #e9ecef;"></div>
                                        <span>Agents</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Invoices & Payments Overview -->
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h5 class="card-title">Invoices & Payments Overview</h5>
                                <a href="{{ route('admin.invoices.detail') }}" class="btn-link">
                                    View All Invoices <i class="fas fa-arrow-right ms-1"></i>
                                </a>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="invoices-table" class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th>Subscribers</th>
                                                <th>Amount</th>
                                                <th>Date</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($recentPayments as $payment)
                                            <tr>
                                                <td>{{ $payment['subscriber'] }}</td>
                                                <td>{{ $payment['amount'] }}</td>
                                                <td>{{ $payment['date'] }}</td>
                                                <td>
                                                    <span class="badge bg-{{ $payment['status'] === 'Paid' ? 'success' : ($payment['status'] === 'Pending' ? 'warning' : 'danger') }}">
                                                        {{ $payment['status'] }}
                                                    </span>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
$(document).ready(function() {
    // Subscription Trends Chart
    const ctx = document.getElementById('subscriptionChart').getContext('2d');
    const chartData = @json($chartData);
    
    new Chart(ctx, {
        type: 'line',
        data: {
            labels: chartData.months,
            datasets: [
                {
                    label: 'New',
                    data: chartData.new,
                    borderColor: '#dc3545',
                    backgroundColor: 'rgba(220, 53, 69, 0.1)',
                    fill: true,
                    tension: 0.4
                },
                {
                    label: 'Renewal',
                    data: chartData.renewals,
                    borderColor: '#6f42c1',
                    backgroundColor: 'rgba(111, 66, 193, 0.1)',
                    fill: true,
                    tension: 0.4
                },
                {
                    label: 'Cancellation',
                    data: chartData.cancellations,
                    borderColor: '#ffc107',
                    backgroundColor: 'rgba(255, 193, 7, 0.1)',
                    fill: true,
                    tension: 0.4
                }
            ]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'bottom',
                    labels: {
                        padding: 20,
                        usePointStyle: true
                    }
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    grid: {
                        display: true,
                        color: 'rgba(0,0,0,0.05)'
                    }
                },
                x: {
                    grid: {
                        display: false
                    }
                }
            }
        }
    });

    // Plan Distribution Chart
    const planCtx = document.getElementById('planChart').getContext('2d');
    const agenciesCount = {{ $totalAgencies }};
    const agentsCount = {{ $totalAgents }};
    
    new Chart(planCtx, {
        type: 'doughnut',
        data: {
            datasets: [{
                data: [agenciesCount, agentsCount],
                backgroundColor: ['#212529', '#e9ecef'],
                borderWidth: 0,
                cutout: '70%'
            }]
        },
        options: {
            responsive: false,
            plugins: {
                legend: {
                    display: false
                }
            }
        }
    });
});

function refreshDashboard() {
    location.reload();
}
</script>
@endsection