@extends('agencylayout.master')

@section('css')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/animate.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/chartist.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/prism.css') }}">
@endsection

@section('main_content')
<div class="container-fluid">
    <div class="page-title">
        <div class="row">
            <div class="col-sm-6">
                <h3>Agency Dashboard</h3>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('agency.dashboard') }}"><i data-feather="home"></i></a></li>
                    <li class="breadcrumb-item">Dashboard</li>
                    <li class="breadcrumb-item active">Agency Overview</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<!-- Container-fluid starts-->
<div class="container-fluid dashboard-default">
    <div class="row">
        <!-- Welcome Card FIRST -->
      <!-- Welcome Card FIRST - Updated to match second card height -->
<div class="col-md-6">
    <div class="card profile-greeting h-100">
        <div class="card-header pb-0">
            <div class="d-flex justify-content-between">
                <div class="flex-grow-1">
                    <p class="square-after f-w-600 header-text-primary">
                        Welcome Dashboard<i class="fa fa-circle"></i>
                    </p>
                    <h4>Agency Management</h4>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="row align-items-center h-100">
                <div class="col-md-8">
                    <div class="d-flex align-items-center">
                        <!-- Date and Weather Section -->
                        <div class="weather-section d-flex align-items-center me-4">
                            <h2 class="f-w-400 mb-0 me-3 text-dark"> 
                                <span>{{ date('d') }}<sup><i class="fa fa-circle-o f-10"></i></sup>{{ date('M') }}</span>
                            </h2>
                            <div class="span sun-bg">
                                <i class="icofont icofont-building font-primary"></i>
                            </div>
                        </div>
                        
                        <!-- Welcome Message Section -->
                        <div class="welcome-section flex-grow-1">
                            <h5 class="mb-1 text-dark">
                                <span>Welcome Back</span> {{ auth()->user()->name }} 
                            </h5>
                            <span class="font-primary f-w-700 d-block text-dark">{{ date('l') }}</span>
                            <p class="mb-0 text-dark-50">Manage your agency performance!</p>
                        </div>
                    </div>
                </div>
                
                <!-- Right Section - Time and Agents -->
                <div class="col-md-4">
                    <div class="d-flex flex-column align-items-md-end align-items-start h-100 justify-content-center">
                        <!-- Time Badge -->
                        <div class="badge f-12 text-dark mb-3">
                            <i class="fa fa-clock-o me-1"></i>
                            <span id="txt">{{ date('H:i A') }}</span>
                        </div>
                        
                        <div class="text-center text-md-end">
                            <span class="badge badge-primary fs-5 px-3 py-2 d-block mb-1">{{ $totalAgents }}</span>
                            <span class="font-primary f-14 f-w-500 text-primary">Total Agents</span>
                        </div>
                        
                        <!-- Additional spacing content to match chart card height -->
                        <div class="mt-4">
                            <div class="d-flex justify-content-end">
                                <div class="text-center me-3">
                                    <div class="bg-light rounded p-2">
                                        <i class="fa fa-users text-primary"></i>
                                    </div>
                                    <small class="text-muted d-block mt-1">Active</small>
                                </div>
                                <div class="text-center">
                                    <div class="bg-light rounded p-2">
                                        <i class="fa fa-chart-line text-success"></i>
                                    </div>
                                    <small class="text-muted d-block mt-1">Growth</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

        <!-- Agency Performance Chart SECOND -->
        <div class="col-md-6">
            <div class="card agency-overview">
                <div class="card-header pb-0">
                    <div class="d-flex justify-content-between">
                        <div class="flex-grow-1">
                            <p class="square-after f-w-600 header-text-primary">
                                Agency Overview<i class="fa fa-circle"></i>
                            </p>
                            <h4>Current Metrics</h4>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="agency-metrics">
                        <canvas id="agency-overview-chart" style="height: 250px;"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <!-- Big Monthly Performance Chart THIRD -->
        <div class="col-12">
            <div class="card total-growth">
                <div class="card-header pb-0">
                    <div class="d-flex justify-content-between">
                        <div class="flex-grow-1">
                            <p class="square-after f-w-600 header-text-primary">
                                Agency Performance<i class="fa fa-circle"></i>
                            </p>
                            <h4>Last 6 Months Overview - All Agents</h4>
                        </div>
                    </div>
                </div>
                <div class="card-body pb-0">
                    <div class="growth-chart">
                        <canvas id="monthly-performance-chart" style="height: 400px;"></canvas>
                    </div>
                </div>
            </div>
        </div>

      

        <!-- Top Performing Agents -->
        <div class="col-xl-4 col-md-6">
            <div class="card appointment-detail">
                <div class="card-header pb-0">
                    <div class="d-flex justify-content-between">
                        <div class="flex-grow-1">
                            <p class="square-after f-w-600 header-text-primary">
                                Top Performing Agents<i class="fa fa-circle"></i>
                            </p>
                            <h4>Top {{ $topAgents->count() }}</h4>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive theme-scrollbar">
                        <table class="table">
                            <tbody>
                                @forelse($topAgents as $agent)
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="agent-avatar me-3">
                                                <div class="avatar-circle bg-primary">
                                                    {{ strtoupper(substr($agent->name, 0, 2)) }}
                                                </div>
                                            </div>
                                            <div class="flex-grow-1">
                                                <span class="f-w-600">{{ $agent->name }}</span>
                                                <p class="mb-0 text-muted f-12">{{ $agent->hot_leads_count }} hot leads</p>
                                                <span class="badge badge-light-success f-10">
                                                    {{ $agent->just_listed_count }} listings
                                                </span>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td class="text-center text-muted">No agents found</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Agency Activities -->
        <div class="col-xl-4 col-md-6">
            <div class="card">
                <div class="card-header pb-0">
                    <div class="d-flex justify-content-between">
                        <div class="flex-grow-1">
                            <p class="square-after f-w-600 header-text-primary">
                                Recent Hot Leads<i class="fa fa-circle"></i>
                            </p>
                            <h4>Latest Activities</h4>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="activity-timeline">
                        @forelse($recentHotLeads as $lead)
                        <div class="d-flex">
                            <div class="activity-line"></div>
                            <div class="activity-dot-primary"></div>
                            <div class="flex-grow-1">
                                <span class="f-w-600 d-block">{{ $lead->vendor_first_name }} {{ $lead->vendor_last_name }}</span>
                                <p class="mb-0 f-12">{{ Str::limit($lead->vendor_address, 30) }}</p>
                                <small class="text-muted">By: {{ $lead->agent->name ?? 'N/A' }} - {{ $lead->created_at->diffForHumans() }}</small>
                            </div>
                        </div>
                        @empty
                        <div class="d-flex">
                            <div class="activity-dot-secondary"></div>
                            <div class="flex-grow-1">
                                <span class="f-w-600 d-block">No recent hot leads</span>
                                <p class="mb-0">Agent activities will appear here</p>
                            </div>
                        </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>

        <!-- Agency Quick Stats -->
        <div class="col-xl-4 col-md-6">
            <div class="card our-todolist">
                <div class="card-header pb-0">
                    <div class="d-flex justify-content-between">
                        <div class="flex-grow-1">
                            <p class="square-after f-w-600 header-text-primary">
                                Agency Stats<i class="fa fa-circle"></i>
                            </p>
                            <h4>Performance</h4>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="activity-timeline todo-timeline">
                        <div class="d-flex">
                            <div class="activity-line"></div>
                            <div class="activity-dot-primary"></div>
                            <div class="flex-grow-1">
                                <p class="mt-0 todo-font">
                                    <span class="font-primary">This Month</span>
                                </p>
                                <div class="d-flex mt-0">
                                    <div class="flex-grow-1">
                                        <span class="f-w-600">
                                            New Hot Leads 
                                            <i class="fa fa-circle circle-dot-primary pull-right"></i>
                                        </span>
                                        <p class="mb-0">{{ $hotLeadsData[5] ?? 0 }} leads generated</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex">
                            <div class="activity-dot-success"></div>
                            <div class="flex-grow-1">
                                <p class="mt-0 todo-font">
                                    <span class="font-primary">Agency Conversion</span>
                                </p>
                                <span class="f-w-600">
                                    {{ $totalHotLeads > 0 ? round(($totalConductAppraisals / $totalHotLeads) * 100, 1) : 0 }}% 
                                    <i class="fa fa-circle circle-dot-success pull-right"></i>
                                </span>
                                <p class="mb-0">Hot leads to appraisals</p>
                            </div>
                        </div>
                        <div class="d-flex">
                            <div class="activity-dot-warning"></div>
                            <div class="flex-grow-1">
                                <p class="mt-0 todo-font">
                                    <span class="font-primary">Listing Success</span>
                                </p>
                                <span class="f-w-600">
                                    {{ $totalConductAppraisals > 0 ? round(($totalJustListed / $totalConductAppraisals) * 100, 1) : 0 }}% 
                                    <i class="fa fa-circle circle-dot-warning pull-right"></i>
                                </span>
                                <p class="mb-0">Appraisals to listings</p>
                            </div>
                        </div>
                        <div class="d-flex">
                            <div class="activity-dot-info"></div>
                            <div class="flex-grow-1">
                                <p class="mt-0 todo-font">
                                    <span class="font-primary">New Agents</span>
                                </p>
                                <span class="f-w-600">
                                    {{ $agentRegistrationData[5] ?? 0 }} 
                                    <i class="fa fa-circle circle-dot-info pull-right"></i>
                                </span>
                                <p class="mb-0">Joined this month</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Agent Performance Table -->
        <div class="col-12">
            <div class="card">
                <div class="card-header pb-0">
                    <div class="d-flex justify-content-between">
                        <div class="flex-grow-1">
                            <p class="square-after f-w-600 header-text-primary">
                                Agent Performance Summary<i class="fa fa-circle"></i>
                            </p>
                            <h4>All Agents Statistics</h4>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive theme-scrollbar">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Agent Name</th>
                                    <th>Hot Leads</th>
                                    <th>Bookings</th>
                                    <th>Appraisals</th>
                                    <th>Listings</th>
                                    <th>Conversion Rate</th>
                                    <th>Listing Rate</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($agentPerformance as $agent)
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="agent-avatar me-3">
                                                <div class="avatar-circle bg-secondary">
                                                    {{ strtoupper(substr($agent->name, 0, 2)) }}
                                                </div>
                                            </div>
                                            <div>
                                                <span class="f-w-600">{{ $agent->name }}</span>
                                                <p class="mb-0 text-muted f-12">{{ $agent->email }}</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="badge badge-light-danger">{{ $agent->hot_leads_count }}</span>
                                    </td>
                                    <td>
                                        <span class="badge badge-light-success">{{ $agent->bookings_count }}</span>
                                    </td>
                                    <td>
                                        <span class="badge badge-light-warning">{{ $agent->appraisals_count }}</span>
                                    </td>
                                    <td>
                                        <span class="badge badge-light-info">{{ $agent->listings_count }}</span>
                                    </td>
                                    <td>
                                        <span class="f-w-600 {{ $agent->conversion_rate >= 50 ? 'text-success' : ($agent->conversion_rate >= 25 ? 'text-warning' : 'text-danger') }}">
                                            {{ $agent->conversion_rate }}%
                                        </span>
                                    </td>
                                    <td>
                                        <span class="f-w-600 {{ $agent->listing_rate >= 60 ? 'text-success' : ($agent->listing_rate >= 30 ? 'text-warning' : 'text-danger') }}">
                                            {{ $agent->listing_rate }}%
                                        </span>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="7" class="text-center text-muted">No agents found</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="{{ asset('assets/js/chart/apex-chart/apex-chart.js') }}"></script>
<script src="{{ asset('assets/js/prism/prism.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Agency Overview Doughnut Chart
    const overviewCtx = document.getElementById('agency-overview-chart').getContext('2d');
    new Chart(overviewCtx, {
        type: 'doughnut',
        data: {
            labels: ['Hot Leads', 'Bookings', 'Appraisals', 'Listings'],
            datasets: [{
                data: [{{ $totalHotLeads }}, {{ $totalBookingAppraisals }}, {{ $totalConductAppraisals }}, {{ $totalJustListed }}],
                backgroundColor: [
                    '#FF6B35',
                    '#28a745',
                    '#ffc107',
                    '#17a2b8'
                ],
                borderWidth: 0,
                cutout: '60%'
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'bottom',
                    labels: {
                        padding: 15,
                        font: {
                            size: 12
                        }
                    }
                }
            }
        }
    });

    // Monthly Performance Chart - Agency Wide
    const ctx = document.getElementById('monthly-performance-chart').getContext('2d');
    new Chart(ctx, {
        type: 'line',
        data: {
            labels: @json($months),
            datasets: [{
                label: 'Hot Leads',
                data: @json($hotLeadsData),
                borderColor: '#FF6B35',
                backgroundColor: 'rgba(255, 107, 53, 0.1)',
                tension: 0.4,
                borderWidth: 3,
                pointRadius: 5,
                pointHoverRadius: 7
            }, {
                label: 'Booking Appraisals',
                data: @json($bookingAppraisalsData),
                borderColor: '#28a745',
                backgroundColor: 'rgba(40, 167, 69, 0.1)',
                tension: 0.4,
                borderWidth: 3,
                pointRadius: 5,
                pointHoverRadius: 7
            }, {
                label: 'Conduct Appraisals',
                data: @json($conductAppraisalsData),
                borderColor: '#ffc107',
                backgroundColor: 'rgba(255, 193, 7, 0.1)',
                tension: 0.4,
                borderWidth: 3,
                pointRadius: 5,
                pointHoverRadius: 7
            }, {
                label: 'Just Listed',
                data: @json($justListedData),
                borderColor: '#17a2b8',
                backgroundColor: 'rgba(23, 162, 184, 0.1)',
                tension: 0.4,
                borderWidth: 3,
                pointRadius: 5,
                pointHoverRadius: 7
            }, {
                label: 'Agent Registrations',
                data: @json($agentRegistrationData),
                borderColor: '#6f42c1',
                backgroundColor: 'rgba(111, 66, 193, 0.1)',
                tension: 0.4,
                borderWidth: 3,
                pointRadius: 5,
                pointHoverRadius: 7
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'top',
                    labels: {
                        padding: 20,
                        font: {
                            size: 14
                        }
                    }
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    grid: {
                        color: 'rgba(0,0,0,0.1)'
                    },
                    ticks: {
                        font: {
                            size: 12
                        }
                    }
                },
                x: {
                    grid: {
                        color: 'rgba(0,0,0,0.1)'
                    },
                    ticks: {
                        font: {
                            size: 12
                        }
                    }
                }
            }
        }
    });

    // Hot Leads Mini Chart
    const hotLeadsChart = new ApexCharts(document.querySelector("#hot-leads-chart"), {
        series: [{
            name: 'Hot Leads',
            data: @json(array_slice($hotLeadsData, -6))
        }],
        chart: {
            type: 'area',
            height: 120,
            sparkline: {
                enabled: true
            }
        },
        stroke: {
            curve: 'smooth'
        },
        fill: {
            opacity: 0.3,
        },
        colors: ['#FF6B35']
    });
    hotLeadsChart.render();

    // Conduct Appraisals Donut Chart
    const conductChart = new ApexCharts(document.querySelector("#conduct-chart"), {
        series: [{{ $totalConductAppraisals }}, {{ max(50 - $totalConductAppraisals, 0) }}],
        chart: {
            type: 'donut',
            height: 100
        },
        labels: ['Completed', 'Target Remaining'],
        colors: ['#ffc107', '#e9ecef'],
        legend: {
            show: false
        },
        dataLabels: {
            enabled: false
        }
    });
    conductChart.render();

    // Just Listed Mini Chart
    const justListedChart = new ApexCharts(document.querySelector("#just-listed-chart"), {
        series: [{
            name: 'Just Listed',
            data: @json(array_slice($justListedData, -6))
        }],
        chart: {
            type: 'bar',
            height: 120,
            sparkline: {
                enabled: true
            }
        },
        colors: ['#17a2b8'],
        plotOptions: {
            bar: {
                columnWidth: '80%'
            }
        }
    });
    justListedChart.render();

    // Update time
    function updateTime() {
        const now = new Date();
        const timeString = now.toLocaleTimeString('en-US', {
            hour: '2-digit',
            minute: '2-digit',
            hour12: true
        });
        document.getElementById('txt').textContent = timeString;
    }
    
    updateTime();
    setInterval(updateTime, 60000);
});
</script>

<style>
  *{
    font-family: 'poppins',sans-serif;
  }
	/* Ensure both welcome and agency overview cards have equal height */
.profile-greeting, .agency-overview {
    box-shadow: 0 4px 20px rgba(0,0,0,0.1);
    border-radius: 15px;
    min-height: 400px; /* Set minimum height to match chart card */
}

.profile-greeting .card-body, .agency-overview .card-body {
    min-height: 300px; /* Ensure body content has enough height */
}

/* Make sure the card header styling is consistent */
.profile-greeting .card-header, .agency-overview .card-header {
    border-radius: 15px 15px 0 0;
    min-height: 80px; /* Consistent header height */
}

/* Existing styles with updates */
.icon-wrapper {
    width: 50px;
    height: 50px;
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
}

.sun-bg {
    background: rgba(255, 255, 255, 0.2);
    padding: 12px; /* Increased padding */
    border-radius: 50%;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
}

/* Enhanced welcome card specific styling */
.profile-greeting .weather-section h2 {
    font-size: 2rem;
}

.profile-greeting .welcome-section h5 {
    font-size: 1.2rem;
    margin-bottom: 8px;
}

.profile-greeting .badge {
    background: rgba(255, 255, 255, 0.9);
    border-radius: 20px;
    padding: 8px 15px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
}

/* Additional icons styling in welcome card */
.profile-greeting .bg-light {
    background-color: rgba(255, 255, 255, 0.8) !important;
    border-radius: 8px;
    width: 40px;
    height: 40px;
    display: flex;
    align-items: center;
    justify-content: center;
}

.profile-greeting .bg-light i {
    font-size: 16px;
}

/* Activity dots and other existing styles */
.activity-dot-primary {
    width: 12px;
    height: 12px;
    border-radius: 50%;
    background-color: #FF6B35;
    margin-right: 15px;
    margin-top: 5px;
    flex-shrink: 0;
}

.activity-dot-success {
    width: 12px;
    height: 12px;
    border-radius: 50%;
    background-color: #28a745;
    margin-right: 15px;
    margin-top: 5px;
    flex-shrink: 0;
}

.activity-dot-warning {
    width: 12px;
    height: 12px;
    border-radius: 50%;
    background-color: #ffc107;
    margin-right: 15px;
    margin-top: 5px;
    flex-shrink: 0;
}

.activity-dot-info {
    width: 12px;
    height: 12px;
    border-radius: 50%;
    background-color: #17a2b8;
    margin-right: 15px;
    margin-top: 5px;
    flex-shrink: 0;
}

.activity-dot-secondary {
    width: 12px;
    height: 12px;
    border-radius: 50%;
    background-color: #6c757d;
    margin-right: 15px;
    margin-top: 5px;
    flex-shrink: 0;
}

.circle-dot-primary {
    color: #FF6B35;
}

.circle-dot-success {
    color: #28a745;
}

.circle-dot-warning {
    color: #ffc107;
}

.circle-dot-info {
    color: #17a2b8;
}

.avatar-circle {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-weight: 600;
    font-size: 14px;
}

/* Big chart card enhancement */
.total-growth {
    box-shadow: 0 4px 20px rgba(0,0,0,0.1);
    border-radius: 15px;
}

.total-growth .card-header {
    border-radius: 15px 15px 0 0;
}

/* Activity line for timeline */
.activity-line {
    position: absolute;
    left: 6px;
    top: 20px;
    bottom: -20px;
    width: 1px;
    background-color: #e9ecef;
}

.activity-timeline .d-flex {
    position: relative;
    margin-bottom: 20px;
}

.activity-timeline .d-flex:last-child .activity-line {
    display: none;
}

/* Ensure equal heights in Bootstrap grid */
.row > [class*="col-"] {
    display: flex;
    flex-direction: column;
}

.row > [class*="col-"] > .card {
    flex: 1;
}
.icon-wrapper {
    width: 50px;
    height: 50px;
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
}

.activity-dot-primary {
    width: 12px;
    height: 12px;
    border-radius: 50%;
    background-color: #FF6B35;
    margin-right: 15px;
    margin-top: 5px;
    flex-shrink: 0;
}

.activity-dot-success {
    width: 12px;
    height: 12px;
    border-radius: 50%;
    background-color: #28a745;
    margin-right: 15px;
    margin-top: 5px;
    flex-shrink: 0;
}

.activity-dot-warning {
    width: 12px;
    height: 12px;
    border-radius: 50%;
    background-color: #ffc107;
    margin-right: 15px;
    margin-top: 5px;
    flex-shrink: 0;
}

.activity-dot-info {
    width: 12px;
    height: 12px;
    border-radius: 50%;
    background-color: #17a2b8;
    margin-right: 15px;
    margin-top: 5px;
    flex-shrink: 0;
}

.activity-dot-secondary {
    width: 12px;
    height: 12px;
    border-radius: 50%;
    background-color: #6c757d;
    margin-right: 15px;
    margin-top: 5px;
    flex-shrink: 0;
}

.circle-dot-primary {
    color: #FF6B35;
}

.circle-dot-success {
    color: #28a745;
}

.circle-dot-warning {
    color: #ffc107;
}

.circle-dot-info {
    color: #17a2b8;
}

.round-badge-success {
    background-color: #28a745;
    color: white;
}

.progress-1 {
    height: 100%;
    width: 100%;
    border-radius: inherit;
}

.avatar-circle {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-weight: 600;
    font-size: 14px;
}





.sun-bg {
    background: rgba(255, 255, 255, 0.2);
    padding: 8px;
    border-radius: 50%;
}

/* Agency overview card */
.agency-overview {
    box-shadow: 0 4px 20px rgba(0,0,0,0.1);
    border-radius: 15px;
}

/* Big chart card enhancement */
.total-growth {
    box-shadow: 0 4px 20px rgba(0,0,0,0.1);
    border-radius: 15px;
}

.total-growth .card-header {
    border-radius: 15px 15px 0 0;
}

/* Activity line for timeline */
.activity-line {
    position: absolute;
    left: 6px;
    top: 20px;
    bottom: -20px;
    width: 1px;
    background-color: #e9ecef;
}

.activity-timeline .d-flex {
    position: relative;
    margin-bottom: 20px;
}

.activity-timeline .d-flex:last-child .activity-line {
    display: none;
}
</style>
@endsection