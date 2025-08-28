@extends('layout.master')

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
                <h3>Agent Dashboard</h3>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('agent.dashboard') }}"><i data-feather="home"></i></a></li>
                    <li class="breadcrumb-item">Dashboard</li>
                    <li class="breadcrumb-item active">Overview</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<!-- Container-fluid starts-->
<div class="container-fluid dashboard-default">
    <div class="row">
        <!-- Welcome Card FIRST -->
        <div class="col-md-6">
            <div class="card profile-greeting">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-md-8">
                            <div class="d-flex align-items-center">
                                <!-- Date and Weather Section -->
                                <div class="weather-section d-flex align-items-center me-4">
                                    <h2 class="f-w-400 mb-0 me-3"> 
                                        <span>{{ date('d') }}<sup><i class="fa fa-circle-o f-10"></i></sup>{{ date('M') }}</span>
                                    </h2>
                                    <div class="span sun-bg">
                                        <i class="icofont icofont-sun font-primary"></i>
                                    </div>
                                </div>
                                
                                <!-- Welcome Message Section -->
                                <div class="welcome-section flex-grow-1">
                                    <h5 class="mb-1">
                                        <span>Welcome Back</span> {{ auth()->guard('agent')->user()->name }} 
                                    </h5>
                                    <span class="font-primary f-w-700 d-block">{{ date('l') }}</span>
                                    <p class="mb-0">Have a productive day ahead!</p>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Right Section - Time and Leads -->
                        <div class="col-md-4">
                            <div class="d-flex flex-column align-items-md-end align-items-start">
                                <!-- Time Badge -->
                                <div class="badge badge-light-primary f-12 text-dark mb-3">
                                    <i class="fa fa-clock-o me-1"></i>
                                    <span id="txt">{{ date('H:i A') }}</span>
                                </div>
                                
                                <!-- Active Leads -->
                                <div class="text-center text-md-end">
                                    <span class="badge badge-primary text-light fs-5 px-3 py-2 d-block mb-1">{{ $hotLeadsCount + $bookingAppraisalsCount }}</span>
                                    <span class="font-primary f-14 f-w-500">Total Active Leads</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Big Monthly Performance Chart SECOND -->
        <div class="col-12">
            <div class="card total-growth">
                <div class="card-header pb-0">
                    <div class="d-flex justify-content-between">
                        <div class="flex-grow-1">
                            <p class="square-after f-w-600 header-text-primary">
                                Monthly Performance<i class="fa fa-circle"></i>
                            </p>
                            <h4>Last 6 Months Overview</h4>
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

       <!-- Count Cards Row - Fixed Alignment -->
<div class="row">
    <div class="col-xl-3 col-lg-6 col-md-6">
        <div class="card stats-card h-100">
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="flex-grow-1">
                        <p class="square-after f-w-600 header-text-primary mb-1">
                            Hot Leads<i class="fa fa-circle"></i>
                        </p>
                        <h3 class="mb-0 f-w-700">{{ $hotLeadsCount }}</h3>
                    </div>
                    <div class="icon-wrapper bg-primary">
                        <i class="icofont icofont-fire font-white f-20"></i>
                    </div>
                </div>
            </div>
            <div class="card-body p-0">
                <div class="chart-container">
                    <div id="hot-leads-chart" style="height: 100px;"></div>
                </div>
                <div class="card-footer-info">
                    <div class="d-flex justify-content-between align-items-center px-3 pb-2">
                        <span class="badge badge-light-danger">Active</span>
                        <small class="text-muted">This Month</small>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-lg-6 col-md-6">
        <div class="card stats-card h-100">
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="flex-grow-1">
                        <p class="square-after f-w-600 header-text-primary mb-1">
                            Booking Appraisals<i class="fa fa-circle"></i>
                        </p>
                        <h3 class="mb-0 f-w-700">{{ $bookingAppraisalsCount }}</h3>
                    </div>
                    <div class="icon-wrapper bg-success">
                        <i class="icofont icofont-calendar font-white f-20"></i>
                    </div>
                </div>
            </div>
            <div class="card-body p-0">
                <div class="chart-container d-flex flex-column justify-content-center px-3">
                    <div class="progress mb-2" style="height: 8px;">
                        <div class="progress-bar bg-success" 
                             style="width: {{ $bookingAppraisalsCount > 0 ? min(($bookingAppraisalsCount / 20) * 100, 100) : 0 }}%">
                        </div>
                    </div>
                </div>
                <div class="card-footer-info">
                    <div class="d-flex justify-content-between align-items-center px-3 pb-2">
                        <span class="badge badge-light-success">+{{ $bookingAppraisalsCount }}</span>
                        <small class="text-muted">Bookings</small>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-lg-6 col-md-6">
        <div class="card stats-card h-100">
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="flex-grow-1">
                        <p class="square-after f-w-600 header-text-primary mb-1">
                            Conduct Appraisals<i class="fa fa-circle"></i>
                        </p>
                        <h3 class="mb-0 f-w-700">{{ $conductAppraisalsCount }}</h3>
                    </div>
                    <div class="icon-wrapper bg-warning">
                        <i class="icofont icofont-building font-white f-20"></i>
                    </div>
                </div>
            </div>
            <div class="card-body p-0">
                <div class="chart-container d-flex justify-content-center align-items-center">
                    <div id="conduct-chart" style="height: 80px; width: 80px;"></div>
                </div>
                <div class="card-footer-info">
                    <div class="d-flex justify-content-between align-items-center px-3 pb-2">
                        <span class="badge badge-light-warning">Completed</span>
                        <small class="text-muted">{{ $conductAppraisalsCount }}</small>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-lg-6 col-md-6">
        <div class="card stats-card h-100">
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="flex-grow-1">
                        <p class="square-after f-w-600 header-text-primary mb-1">
                            Just Listed<i class="fa fa-circle"></i>
                        </p>
                        <h3 class="mb-0 f-w-700">{{ $justListedCount }}</h3>
                    </div>
                    <div class="icon-wrapper bg-info">
                        <i class="icofont icofont-home font-white f-20"></i>
                    </div>
                </div>
            </div>
            <div class="card-body p-0">
                <div class="chart-container">
                    <div id="just-listed-chart" style="height: 100px;"></div>
                </div>
                <div class="card-footer-info">
                    <div class="d-flex justify-content-between align-items-center px-3 pb-2">
                        <span class="badge badge-light-info">{{ $justListedData[5] ?? 0 }}</span>
                        <small class="text-muted">This Month</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

        <!-- Recent Hot Leads -->
        <div class="col-xl-4 col-md-6">
            <div class="card appointment-detail">
                <div class="card-header pb-0">
                    <div class="d-flex justify-content-between">
                        <div class="flex-grow-1">
                            <p class="square-after f-w-600 header-text-primary">
                                Recent Hot Leads<i class="fa fa-circle"></i>
                            </p>
                            <h4>Latest {{ $recentHotLeads->count() }}</h4>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive theme-scrollbar">
                        <table class="table">
                            <tbody>
                                @forelse($recentHotLeads as $lead)
                                <tr>
                                    <td>
                                        <div class="d-flex">
                                            <div class="flex-grow-1">
                                                <span class="f-w-600">{{ $lead->vendor_first_name }} {{ $lead->vendor_last_name }}</span>
                                                <p class="mb-0 text-muted f-12">{{ Str::limit($lead->vendor_address, 30) }}</p>
                                                <span class="badge badge-light-{{ $lead->category == 'hot' ? 'danger' : 'primary' }} f-10">
                                                    {{ ucfirst($lead->category) }}
                                                </span>
                                            </div>
                                            <p class="f-w-500 mb-0 f-12 text-muted">{{ $lead->created_at->diffForHumans() }}</p>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td class="text-center text-muted">No hot leads yet</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Bookings -->
        <div class="col-xl-4 col-md-6">
            <div class="card">
                <div class="card-header pb-0">
                    <div class="d-flex justify-content-between">
                        <div class="flex-grow-1">
                            <p class="square-after f-w-600 header-text-primary">
                                Recent Bookings<i class="fa fa-circle"></i>
                            </p>
                            <h4>Upcoming</h4>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="activity-timeline">
                        @forelse($recentBookings as $booking)
                        <div class="d-flex">
                            <div class="activity-line"></div>
                            <div class="activity-dot-primary"></div>
                            <div class="flex-grow-1">
                                <span class="f-w-600 d-block">{{ $booking->vendor1_first_name }} {{ $booking->vendor1_last_name }}</span>
                                <p class="mb-0 f-12">{{ Str::limit($booking->address, 40) }}</p>
                                <small class="text-muted">{{ \Carbon\Carbon::parse($booking->appointment_date)->format('M d, Y') }}</small>
                            </div>
                        </div>
                        @empty
                        <div class="d-flex">
                            <div class="activity-dot-secondary"></div>
                            <div class="flex-grow-1">
                                <span class="f-w-600 d-block">No recent bookings</span>
                                <p class="mb-0">Start booking appraisals to see them here</p>
                            </div>
                        </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>

        <!-- Quick Stats -->
        <div class="col-xl-4 col-md-6">
            <div class="card our-todolist">
                <div class="card-header pb-0">
                    <div class="d-flex justify-content-between">
                        <div class="flex-grow-1">
                            <p class="square-after f-w-600 header-text-primary">
                                Quick Stats<i class="fa fa-circle"></i>
                            </p>
                            <h4>Overview</h4>
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
                                    <span class="font-primary">Conversion Rate</span>
                                </p>
                                <span class="f-w-600">
                                    {{ $hotLeadsCount > 0 ? round(($conductAppraisalsCount / $hotLeadsCount) * 100, 1) : 0 }}% 
                                    <i class="fa fa-circle circle-dot-success pull-right"></i>
                                </span>
                                <p class="mb-0">Hot leads to appraisals</p>
                            </div>
                        </div>
                        <div class="d-flex">
                            <div class="activity-dot-warning"></div>
                            <div class="flex-grow-1">
                                <p class="mt-0 todo-font">
                                    <span class="font-primary">Listing Rate</span>
                                </p>
                                <span class="f-w-600">
                                    {{ $conductAppraisalsCount > 0 ? round(($justListedCount / $conductAppraisalsCount) * 100, 1) : 0 }}% 
                                    <i class="fa fa-circle circle-dot-warning pull-right"></i>
                                </span>
                                <p class="mb-0">Appraisals to listings</p>
                            </div>
                        </div>
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
    // Monthly Performance Chart - Now bigger
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
        series: [{{ $conductAppraisalsCount }}, {{ max(10 - $conductAppraisalsCount, 0) }}],
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

	/* Agent Dashboard Cards - Fixed Alignment */
.stats-card {
    border-radius: 15px;
    box-shadow: 0 4px 15px rgba(0,0,0,0.08);
    border: none;
    transition: all 0.3s ease;
    min-height: 200px; /* Fixed minimum height */
    display: flex;
    flex-direction: column;
}

.stats-card:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(0,0,0,0.15);
}

.stats-card .card-header {
    padding: 1.25rem 1.25rem 0.75rem 1.25rem;
    border-bottom: none;
    background: transparent;
    flex-shrink: 0; /* Prevent header from shrinking */
}

.stats-card .card-body {
    flex-grow: 1; /* Allow body to grow and fill space */
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    padding: 0;
}

.stats-card h3 {
    font-size: 2rem;
    color: #2c3e50;
    font-weight: 700;
}

.icon-wrapper {
    width: 50px;
    height: 50px;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
}

.icon-wrapper.bg-primary {
    background: linear-gradient(135deg, #FF6B35 0%, #F7931E 100%);
}

.icon-wrapper.bg-success {
    background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);
}

.icon-wrapper.bg-warning {
    background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
}

.icon-wrapper.bg-info {
    background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
}

/* Chart containers - ensure consistent height */
.chart-container {
    flex-grow: 1;
    display: flex;
    align-items: center;
    justify-content: center;
    min-height: 100px;
    padding: 0.5rem 0;
}

/* Card footer info - consistent positioning */
.card-footer-info {
    flex-shrink: 0;
    margin-top: auto;
    border-top: 1px solid #f8f9fa;
    padding-top: 0.5rem;
}

/* Progress bar styling */
.progress {
    border-radius: 10px;
    background-color: #f8f9fa;
    height: 8px;
}

.progress-bar {
    border-radius: 10px;
}

/* Badge styling */
.badge {
    font-size: 0.75rem;
    padding: 0.25rem 0.5rem;
    border-radius: 6px;
}

/* Header text styling */
.header-text-primary {
    font-weight: 600;
    font-size: 0.85rem;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    color: #6c757d;
}

.square-after::after {
    content: '';
    display: inline-block;
    width: 4px;
    height: 4px;
    background-color: currentColor;
    border-radius: 50%;
    margin-left: 8px;
    vertical-align: middle;
}

/* Responsive adjustments */
@media (max-width: 1200px) {
    .stats-card {
        min-height: 180px;
    }
    
    .stats-card h3 {
        font-size: 1.8rem;
    }
}

@media (max-width: 768px) {
    .stats-card {
        margin-bottom: 1rem;
        min-height: 160px;
    }
    
    .stats-card h3 {
        font-size: 1.6rem;
    }
    
    .icon-wrapper {
        width: 45px;
        height: 45px;
    }
}

/* Enhanced welcome card styling - keep existing */
.profile-greeting {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: black;
    border-radius: 15px;
    box-shadow: 0 4px 20px rgba(0,0,0,0.1);
}

.profile-greeting h5, 
.profile-greeting p, 
.profile-greeting span {
    color: black;
}

.profile-greeting .badge-light-primary {
    background-color: rgba(255, 255, 255, 0.2);
    color: black;
    border: none;
}

.sun-bg {
    background: rgba(255, 255, 255, 0.2);
    padding: 8px;
    border-radius: 50%;
}

/* Big chart card enhancement */
.total-growth {
    box-shadow: 0 4px 20px rgba(0,0,0,0.1);
    border-radius: 15px;
}

.total-growth .card-header {
    border-radius: 15px 15px 0 0;
}

/* Activity dots */
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
.row {
    display: flex;
    flex-wrap: wrap;
}

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

.circle-dot-success {
    color: #28a745;
}

.circle-dot-warning {
    color: #ffc107;
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

/* Enhanced welcome card styling */
.profile-greeting {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
}

.profile-greeting .badge-light-primary {
    background-color: rgba(255, 255, 255, 0.2);
    color: white;
    border: none;
}

.sun-bg {
    background: rgba(255, 255, 255, 0.2);
    padding: 8px;
    border-radius: 50%;
}

/* Big chart card enhancement */
.total-growth {
    box-shadow: 0 4px 20px rgba(0,0,0,0.1);
    border-radius: 15px;
}

.total-growth .card-header {
    border-radius: 15px 15px 0 0;
}
</style>
@endsection