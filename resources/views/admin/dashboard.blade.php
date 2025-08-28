@extends('adminlayout.master')

@section('styles')
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
<style>
    body {
        background: #f8f9fa;
    }
    
    .dashboard-wrapper {
        background: linear-gradient(135deg, #ffffff 0%, #f8f9fa 100%);
        min-height: 100vh;
        padding: 20px 0;
    }
    
    .dashboard-card {
        background: #ffffff;
        border-radius: 16px;
        padding: 28px;
        margin-bottom: 24px;
        border: 1px solid #e3e6f0;
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.08);
        position: relative;
        overflow: hidden;
        transition: all 0.3s ease;
    }
    
    .dashboard-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.12);
        border-color: #d1ecf1;
    }
    
    .dashboard-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: linear-gradient(90deg, #4e73df, #1cc88a, #36b9cc);
        border-radius: 16px 16px 0 0;
    }
    
    .card-content {
        position: relative;
        z-index: 1;
    }
    
    .card-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 20px;
    }
    
    .card-icon {
        width: 55px;
        height: 55px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 22px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.15);
        transition: all 0.3s ease;
    }
    
    .card-icon:hover {
        transform: scale(1.05);
    }
    
    .card-icon.users { 
        background: linear-gradient(135deg, #4e73df 0%, #6f86ff 100%);
    }
    .card-icon.revenue { 
        background: linear-gradient(135deg, #1cc88a 0%, #36d89a 100%);
    }
    .card-icon.agencies { 
        background: linear-gradient(135deg, #36b9cc 0%, #5ad5e5 100%);
    }
    .card-icon.agents { 
        background: linear-gradient(135deg, #f6c23e 0%, #f8d347 100%);
    }
    .card-icon.pending { 
        background: linear-gradient(135deg, #fd7e14 0%, #ff8c42 100%);
    }
    .card-icon.active { 
        background: linear-gradient(135deg, #28a745 0%, #34ce57 100%);
    }
    .card-icon.expired { 
        background: linear-gradient(135deg, #e74a3b 0%, #f56565 100%);
    }
    .card-icon.inactive { 
        background: linear-gradient(135deg, #858796 0%, #9ca3af 100%);
    }
    
    .card-stats {
        flex: 1;
        text-align: right;
    }
    
    .card-value {
        font-size: 2.8rem;
        font-weight: 700;
        color: #2c3e50;
        margin: 0;
        line-height: 1;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }
    
    .card-label {
        font-size: 0.95rem;
        color: #6c757d;
        margin-top: 8px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    
    .card-trend {
        display: flex;
        align-items: center;
        justify-content: flex-end;
        margin-top: 12px;
        padding: 6px 12px;
        border-radius: 20px;
        font-size: 0.85rem;
        font-weight: 600;
        width: fit-content;
        margin-left: auto;
    }
    
    .trend-up {
        background: #d1f2eb;
        color: #28a745;
        border: 1px solid #c3e6cb;
    }
    
    .trend-down {
        background: #f8d7da;
        color: #dc3545;
        border: 1px solid #f5c6cb;
    }
    
    .trend-neutral {
        background: #fff3cd;
        color: #856404;
        border: 1px solid #ffeaa7;
    }
    
    .trend-icon {
        margin-right: 5px;
        font-size: 12px;
    }
    
    .progress-container {
        margin-top: 20px;
    }
    
    .progress-label {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 8px;
        font-size: 0.85rem;
        color: #6c757d;
        font-weight: 500;
    }
    
    .progress-bar {
        width: 100%;
        height: 6px;
        background: #f1f3f4;
        border-radius: 10px;
        overflow: hidden;
        position: relative;
    }
    
    .progress-fill {
        height: 100%;
        border-radius: 10px;
        width: 0%;
        transition: width 1.2s ease;
        position: relative;
    }
    
    .progress-fill.users { background: linear-gradient(90deg, #4e73df, #6f86ff); }
    .progress-fill.revenue { background: linear-gradient(90deg, #1cc88a, #36d89a); }
    .progress-fill.agencies { background: linear-gradient(90deg, #36b9cc, #5ad5e5); }
    .progress-fill.agents { background: linear-gradient(90deg, #f6c23e, #f8d347); }
    .progress-fill.pending { background: linear-gradient(90deg, #fd7e14, #ff8c42); }
    .progress-fill.active { background: linear-gradient(90deg, #28a745, #34ce57); }
    .progress-fill.expired { background: linear-gradient(90deg, #e74a3b, #f56565); }
    .progress-fill.inactive { background: linear-gradient(90deg, #858796, #9ca3af); }
    
    .chart-container {
        background: #ffffff;
        border-radius: 16px;
        padding: 30px;
        border: 1px solid #e3e6f0;
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.08);
        margin-top: 30px;
    }
    
    .chart-header {
        display: flex;
        align-items: center;
        margin-bottom: 25px;
        padding-bottom: 20px;
        border-bottom: 2px solid #f1f3f4;
    }
    
    .chart-icon {
        width: 45px;
        height: 45px;
        border-radius: 12px;
        background: linear-gradient(135deg, #4e73df 0%, #6f86ff 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 20px;
        box-shadow: 0 4px 15px rgba(78, 115, 223, 0.3);
    }
    
    .chart-title {
        font-size: 1.4rem;
        font-weight: 700;
        margin: 0;
        color: #2c3e50;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }
    
    .chart-subtitle {
        font-size: 0.9rem;
        color: #6c757d;
        margin: 5px 0 0 0;
        font-weight: 500;
    }
    
    .page-header {
        background: transparent;
        padding: 20px 0;
        margin-bottom: 30px;
    }
    
    .page-title h3 {
        color: #2c3e50;
        font-size: 2.2rem;
        font-weight: 700;
        margin: 0;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }
    
    .breadcrumb {
        background: #ffffff;
        border-radius: 12px;
        padding: 12px 20px;
        border: 1px solid #e3e6f0;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
    }
    
    .breadcrumb-item a {
        color: #4e73df;
        text-decoration: none;
        font-weight: 500;
    }
    
    .breadcrumb-item.active {
        color: #6c757d;
        font-weight: 600;
    }
    
    .breadcrumb-item + .breadcrumb-item::before {
        color: #6c757d;
    }
    
    /* Stats Summary Cards */
    .stats-summary {
        background: linear-gradient(135deg, #4e73df 0%, #6f86ff 100%);
        color: white;
        border-radius: 16px;
        padding: 25px;
        margin-bottom: 30px;
        box-shadow: 0 8px 25px rgba(78, 115, 223, 0.3);
    }
    
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 20px;
        margin-top: 20px;
    }
    
    .stat-item {
        text-align: center;
        padding: 15px;
        background: rgba(255, 255, 255, 0.1);
        border-radius: 12px;
        backdrop-filter: blur(10px);
    }
    
    .stat-value {
        font-size: 1.8rem;
        font-weight: 700;
        margin-bottom: 5px;
    }
    
    .stat-label {
        font-size: 0.9rem;
        opacity: 0.9;
    }
    
    /* Animation for cards on load */
    .dashboard-card {
        opacity: 0;
        transform: translateY(20px);
        animation: fadeInUp 0.5s ease forwards;
    }
    
    .dashboard-card:nth-child(1) { animation-delay: 0.1s; }
    .dashboard-card:nth-child(2) { animation-delay: 0.2s; }
    .dashboard-card:nth-child(3) { animation-delay: 0.3s; }
    
    @keyframes fadeInUp {
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    
    @media (max-width: 768px) {
        .dashboard-card {
            margin-bottom: 20px;
            padding: 24px;
        }
        
        .card-value {
            font-size: 2.2rem;
        }
        
        .card-header {
            flex-direction: column;
            text-align: center;
            gap: 15px;
        }
        
        .card-stats {
            text-align: center;
        }
        
        .card-trend {
            margin: 10px auto 0;
        }
        
        .page-title h3 {
            font-size: 1.8rem;
        }
        
        .stats-grid {
            grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
            gap: 15px;
        }
    }
    
    @media (max-width: 576px) {
        .dashboard-wrapper {
            padding: 15px 0;
        }
        
        .chart-container {
            padding: 20px;
            margin-top: 20px;
        }
        
        .card-value {
            font-size: 2rem;
        }
        
        .card-header {
            gap: 12px;
        }
    }
    </style>
    @endsection
@section('main_content')
<div class="dashboard-wrapper">
    

    <div class="container-fluid">
        <div class="row">
			  <div class="col-xl-4 col-md-6 col-sm-12">
                <div class="dashboard-card">
                    <div class="card-content">
                        <div class="card-header">
                            <div class="card-icon agencies">
                                <i class="fas fa-building"></i>
                            </div>
                            <div class="card-stats">
                                <div class="card-value">{{ number_format($totalAgencies) }}</div>
                                <div class="card-label">Total Agencies</div>
                            </div>
                        </div>
                        <div class="card-trend trend-up">
                            <i class="fas fa-arrow-up trend-icon"></i>
                            <span>+8% from last month</span>
                        </div>
                        <div class="progress-container">
                            <div class="progress-bar">
                                <div class="progress-fill agencies" style="width: 78%"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
          <div class="col-xl-4 col-md-6 col-sm-12">
    <div class="dashboard-card">
        <div class="card-content">
            <div class="card-header">
                <div class="card-icon users">
                    <i class="fas fa-user-tie"></i> <!-- Changed icon to represent agents -->
                </div>
                <div class="card-stats">
                    <div class="card-value">{{ number_format($totalAgents) }}</div> <!-- Changed to totalAgents -->
                    <div class="card-label">Total Agents</div> <!-- Changed label -->
                </div>
            </div>
            <div class="card-trend trend-up">
                <i class="fas fa-arrow-up trend-icon"></i>
                <span>+12% from last month</span>
            </div>
            <div class="progress-container">
                <div class="progress-bar">
                    <div class="progress-fill users" style="width: 85%"></div>
                </div>
            </div>
        </div>
    </div>
</div>
            
            <div class="col-xl-4 col-md-6 col-sm-12">
                <div class="dashboard-card">
                    <div class="card-content">
                        <div class="card-header">
                            <div class="card-icon revenue">
                                <i class="fas fa-dollar-sign"></i>
                            </div>
                            <div class="card-stats">
                                <div class="card-value">${{ number_format($monthlyRevenue, 0) }}</div>
                                <div class="card-label">Monthly Revenue</div>
                            </div>
                        </div>
                        <div class="card-trend trend-up">
                            <i class="fas fa-arrow-up trend-icon"></i>
                            <span>+18% from last month</span>
                        </div>
                        <div class="progress-container">
                            <div class="progress-bar">
                                <div class="progress-fill revenue" style="width: 92%"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
          
        </div>

        <!-- Second Row - New Stats -->
        <div class="row">
            <div class="col-xl-4 col-md-6 col-sm-12">
                <div class="dashboard-card">
                    <div class="card-content">
                        <div class="card-header">
                            <div class="card-icon" style="background: linear-gradient(135deg, #ff9a9e 0%, #fad0c4 100%);">
                                <i class="fas fa-fire"></i>
                            </div>
                            <div class="card-stats">
                                <div class="card-value">{{ number_format($hotLeadsCount) }}</div>
                                <div class="card-label">Hot Leads</div>
                            </div>
                        </div>
                        <div class="card-trend trend-up">
                            <i class="fas fa-arrow-up trend-icon"></i>
                            <span>+15% from last month</span>
                        </div>
                        <div class="progress-container">
                            <div class="progress-bar">
                                <div class="progress-fill" style="width: 75%; background: linear-gradient(90deg, #ff9a9e, #fad0c4);"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-xl-4 col-md-6 col-sm-12">
                <div class="dashboard-card">
                    <div class="card-content">
                        <div class="card-header">
                            <div class="card-icon" style="background: linear-gradient(135deg, #a18cd1 0%, #fbc2eb 100%);">
                                <i class="fas fa-calendar-check"></i>
                            </div>
                            <div class="card-stats">
                                <div class="card-value">{{ number_format($bookingAppraisalCount) }}</div>
                                <div class="card-label">Booking Appraisals</div>
                            </div>
                        </div>
                        <div class="card-trend trend-up">
                            <i class="fas fa-arrow-up trend-icon"></i>
                            <span>+10% from last month</span>
                        </div>
                        <div class="progress-container">
                            <div class="progress-bar">
                                <div class="progress-fill" style="width: 65%; background: linear-gradient(90deg, #a18cd1, #fbc2eb);"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-xl-4 col-md-6 col-sm-12">
                <div class="dashboard-card">
                    <div class="card-content">
                        <div class="card-header">
                            <div class="card-icon" style="background: linear-gradient(135deg, #84fab0 0%, #8fd3f4 100%);">
                                <i class="fas fa-clipboard-check"></i>
                            </div>
                            <div class="card-stats">
                                <div class="card-value">{{ number_format($conductAppraisalCount) }}</div>
                                <div class="card-label">Conduct Appraisals</div>
                            </div>
                        </div>
                        <div class="card-trend trend-up">
                            <i class="fas fa-arrow-up trend-icon"></i>
                            <span>+12% from last month</span>
                        </div>
                        <div class="progress-container">
                            <div class="progress-bar">
                                <div class="progress-fill" style="width: 70%; background: linear-gradient(90deg, #84fab0, #8fd3f4);"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-xl-4 col-md-6 col-sm-12">
                <div class="dashboard-card">
                    <div class="card-content">
                        <div class="card-header">
                            <div class="card-icon" style="background: linear-gradient(135deg, #ffc3a0 0%, #ffafbd 100%);">
                                <i class="fas fa-home"></i>
                            </div>
                            <div class="card-stats">
                                <div class="card-value">{{ number_format($justListedCount) }}</div>
                                <div class="card-label">Just Listed</div>
                            </div>
                        </div>
                        <div class="card-trend trend-up">
                            <i class="fas fa-arrow-up trend-icon"></i>
                            <span>+8% from last month</span>
                        </div>
                        <div class="progress-container">
                            <div class="progress-bar">
                                <div class="progress-fill" style="width: 60%; background: linear-gradient(90deg, #ffc3a0, #ffafbd);"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Chart Section -->
        <div class="row">
            <div class="col-12">
                <div class="chart-container">
                    <div class="chart-header">
                        <div class="chart-icon">
                            <i class="fas fa-chart-line" style="color: white; font-size: 18px;"></i>
                        </div>
                        <div>
                            <div class="chart-title">Business Analytics - Last 6 Months</div>
                            <div class="chart-subtitle">Comprehensive overview of platform growth and performance metrics</div>
                        </div>
                    </div>
                    
                    <div style="height: 400px; position: relative;">
                        <canvas id="trendsChart" width="100%" height="400"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Animate progress bars
        setTimeout(() => {
            document.querySelectorAll('.progress-fill').forEach(bar => {
                const width = bar.style.width;
                bar.style.width = '0%';
                setTimeout(() => {
                    bar.style.width = width;
                }, 100);
            });
        }, 500);
        
        // Chart configuration
        const ctx = document.getElementById('trendsChart').getContext('2d');
        const chartData = @json($chartData);
        
        const gradient1 = ctx.createLinearGradient(0, 0, 0, 400);
        gradient1.addColorStop(0, 'rgba(102, 126, 234, 0.8)');
        gradient1.addColorStop(1, 'rgba(102, 126, 234, 0.1)');
        
        const gradient2 = ctx.createLinearGradient(0, 0, 0, 400);
        gradient2.addColorStop(0, 'rgba(67, 233, 123, 0.8)');
        gradient2.addColorStop(1, 'rgba(67, 233, 123, 0.1)');
        
        const gradient3 = ctx.createLinearGradient(0, 0, 0, 400);
        gradient3.addColorStop(0, 'rgba(79, 172, 254, 0.8)');
        gradient3.addColorStop(1, 'rgba(79, 172, 254, 0.1)');
        
        const gradient4 = ctx.createLinearGradient(0, 0, 0, 400);
        gradient4.addColorStop(0, 'rgba(240, 147, 251, 0.8)');
        gradient4.addColorStop(1, 'rgba(240, 147, 251, 0.1)');
        
        const chart = new Chart(ctx, {
            type: 'line',
			  data: {
                labels: chartData.map(item => item.month),
                datasets: [
          {
                    label: 'Agents', 
                    data: chartData.map(item => item.agents),
                    borderColor: '#43e97b',
                    backgroundColor: gradient2,
                    borderWidth: 3,
                    tension: 0.4,
                    fill: true,
                    pointRadius: 6,
                    pointHoverRadius: 8,
                    pointBackgroundColor: '#43e97b',
                    pointBorderColor: '#ffffff',
                    pointBorderWidth: 2
                }, {
                    label: 'Agencies',
                    data: chartData.map(item => item.agencies),
                    borderColor: '#4facfe',
                    backgroundColor: gradient3,
                    borderWidth: 3,
                    tension: 0.4,
                    fill: true,
                    pointRadius: 6,
                    pointHoverRadius: 8,
                    pointBackgroundColor: '#4facfe',
                    pointBorderColor: '#ffffff',
                    pointBorderWidth: 2
                }, {
                    label: 'Revenue (K)',
                    data: chartData.map(item => Math.round(item.revenue / 1000)),
                    borderColor: '#f093fb',
                    backgroundColor: gradient4,
                    borderWidth: 3,
                    tension: 0.4,
                    fill: true,
                    pointRadius: 6,
                    pointHoverRadius: 8,
                    pointBackgroundColor: '#f093fb',
                    pointBorderColor: '#ffffff',
                    pointBorderWidth: 2
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'top',
                        labels: {
                            usePointStyle: true,
                            padding: 25,
                            font: {
                                size: 13,
                                weight: '600'
                            },
                            color: '#2c3e50'
                        }
                    },
                    tooltip: {
                        mode: 'index',
                        intersect: false,
                        backgroundColor: 'rgba(255, 255, 255, 0.95)',
                        titleColor: '#2c3e50',
                        bodyColor: '#2c3e50',
                        borderColor: 'rgba(102, 126, 234, 0.3)',
                        borderWidth: 1,
                        cornerRadius: 10,
                        displayColors: true,
                        padding: 15,
                        titleFont: {
                            size: 14,
                            weight: 'bold'
                        },
                        bodyFont: {
                            size: 13
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: {
                            color: 'rgba(102, 126, 234, 0.1)',
                            drawBorder: false
                        },
                        ticks: {
                            color: '#7f8c8d',
                            font: {
                                size: 12,
                                weight: '500'
                            },
                            padding: 10
                        }
                    },
                    x: {
                        grid: {
                            color: 'rgba(102, 126, 234, 0.1)',
                            drawBorder: false
                        },
                        ticks: {
                            color: '#7f8c8d',
                            font: {
                                size: 12,
                                weight: '500'
                            },
                            padding: 10
                        }
                    }
                },
                interaction: {
                    intersect: false,
                    mode: 'index'
                },
                elements: {
                    point: {
                        hoverBackgroundColor: '#ffffff',
                        hoverBorderWidth: 3
                    }
                }
            }
        });
    });
</script>
@endsection