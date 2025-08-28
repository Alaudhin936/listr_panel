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
    .card {
        border: none;
        box-shadow: 0 0.15rem 1.75rem 0 rgba(33, 40, 50, 0.05);
        border-radius: 0.75rem;
        background-color: #fff;
        margin-bottom: 1.5rem;
    }
    .card-header {
        background: #fff;
        border-bottom: 1px solid rgba(0, 0, 0, 0.05);
        border-radius: 0.75rem 0.75rem 0 0 !important;
        padding: 1.5rem;
    }
    .page-title {
        color: #212529;
        font-weight: 700;
        margin: 0;
        font-size: 2rem;
    }
    .breadcrumb {
        background: none;
        padding: 0;
        margin: 0;
    }
    .breadcrumb-item {
        color: #6c757d;
        font-size: 0.875rem;
    }
    .breadcrumb-item.active {
        color: #212529;
        font-weight: 500;
    }
    .breadcrumb-item + .breadcrumb-item::before {
        color: #6c757d;
        content: ">";
    }
    .btn-export {
        background: #000;
        border: none;
        color: #fff;
        padding: 0.5rem 1.25rem;
        border-radius: 0.375rem;
        font-weight: 500;
        transition: all 0.2s ease;
    }
    .btn-export:hover {
        background: #333;
        color: #fff;
        transform: translateY(-1px);
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
        white-space: nowrap;
    }
    .table td {
        padding: 1rem;
        vertical-align: middle;
        border-top: 1px solid rgba(0, 0, 0, 0.03);
    }
    .badge {
        font-weight: 500;
        padding: 0.35em 0.75em;
        font-size: 0.75em;
        border-radius: 0.375rem;
    }
    .dataTables_wrapper .dataTables_length select {
        border: 1px solid #ced4da;
        border-radius: 0.375rem;
        padding: 0.25rem 0.5rem;
    }
    .dataTables_wrapper .dataTables_filter input {
        border: 1px solid #ced4da;
        border-radius: 0.375rem;
        padding: 0.5rem 0.75rem;
        margin-left: 0.5rem;
    }
    .dataTables_wrapper .dataTables_info {
        color: #6c757d;
        font-size: 0.875rem;
    }
    .dataTables_wrapper .dataTables_paginate .paginate_button {
        border: 1px solid #dee2e6;
        border-radius: 0.375rem;
        margin: 0 0.125rem;
        padding: 0.375rem 0.75rem;
        color: #495057;
    }
    .dataTables_wrapper .dataTables_paginate .paginate_button.current {
        background: #000;
        border-color: #000;
        color: #fff;
    }
    .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
        background: #e9ecef;
        border-color: #dee2e6;
    }
    .export-buttons {
        display: flex;
        gap: 0.5rem;
        align-items: center;
    }
    .stats-summary {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        border-radius: 0.75rem;
        padding: 2rem;
        margin-bottom: 1.5rem;
    }
    .stats-summary h3 {
        font-size: 2.5rem;
        font-weight: 700;
        margin: 0;
    }
    .stats-summary p {
        margin: 0;
        opacity: 0.9;
    }
</style>

<div class="page-wrapper compact-wrapper" id="pageWrapper">
    <div class="page-body-wrapper">
        <div class="page-body1">
            <div class="container-fluid">
                <!-- Page Header -->
                <div class="row mb-4">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="row align-items-center">
                                    <div class="col">
                                        <h1 class="page-title">Invoices & Payments Overview</h1>
                                        <nav aria-label="breadcrumb">
                                            <ol class="breadcrumb">
                                                <li class="breadcrumb-item">
                                                    <a href="{{ route('admin.subscription') }}">Dashboard</a>
                                                </li>
                                                <li class="breadcrumb-item active">Invoices</li>
                                            </ol>
                                        </nav>
                                    </div>
                                    <div class="col-auto">
                                        <div class="export-buttons">
                                            <button class="btn btn-export" onclick="exportToPDF()">
                                                <i class="fas fa-file-pdf me-1"></i> Export PDF
                                            </button>
                                            <button class="btn btn-export" onclick="exportToExcel()">
                                                <i class="fas fa-file-excel me-1"></i> Export Excel
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Revenue Summary -->
                <div class="row mb-4">
                    <div class="col-12">
                        <div class="stats-summary">
                            <div class="row align-items-center">
                                <div class="col-md-6">
                                    <h3 id="total-revenue">A$0</h3>
                                    <p>Total Revenue from All Subscriptions</p>
                                </div>
                                <div class="col-md-6 text-md-end">
                                    <p class="mb-1">Active Subscriptions: <span id="active-count">0</span></p>
                                    <p class="mb-0">Pending Payments: <span id="pending-count">0</span></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Invoices Table -->
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title mb-0">
                                    <i class="fas fa-receipt me-2"></i>All Invoices & Payments
                                </h5>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="invoices-detail-table" class="table table-hover" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>Subscribers</th>
                                                <th>Amount</th>
                                                <th>Date</th>
                                                <th>Status</th>
                                                <th>Plan Start</th>
                                                <th>Plan End</th>
                                                <th>Email</th>
                                                <th>Phone</th>
                                            </tr>
                                        </thead>
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
<script src="https://cdn.datatables.net/1.13.8/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.8/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.5.0/js/responsive.bootstrap5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.bootstrap5.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.html5.min.js"></script>

<script>
$(document).ready(function() {
    // Initialize DataTable
    const invoicesTable = $('#invoices-detail-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: "{{ route('admin.invoices.data') }}",
            dataSrc: function(json) {
                // Update summary stats
                updateSummaryStats(json);
                return json.data;
            }
        },
        columns: [
            { data: 'subscribers', name: 'name' },
            { 
                data: 'amount', 
                name: 'amount',
                render: function(data, type, row) {
                    return '<strong>' + data + '</strong>';
                }
            },
            { data: 'date', name: 'plan_start_date' },
            { 
                data: 'payment_status', 
                name: 'status',
                orderable: false
            },
            { 
                data: 'plan_start_date',
                name: 'plan_start_date',
                render: function(data, type, row) {
                    return data ? new Date(data).toLocaleDateString() : '-';
                }
            },
            { 
                data: 'plan_end_date',
                name: 'plan_end_date', 
                render: function(data, type, row) {
                    return data ? new Date(data).toLocaleDateString() : '-';
                }
            },
            { data: 'email', name: 'email' },
            { data: 'phone', name: 'phone' }
        ],
        order: [[2, 'desc']], // Order by date
        pageLength: 25,
        lengthMenu: [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
        responsive: true,
        dom: '<"top"<"row"<"col-md-6"l><"col-md-6"f>>>rt<"bottom"<"row"<"col-md-6"i><"col-md-6"p>>>',
        language: {
            emptyTable: 'No invoice records found',
            info: 'Showing _START_ to _END_ of _TOTAL_ invoices',
            infoEmpty: 'Showing 0 to 0 of 0 invoices',
            infoFiltered: '(filtered from _MAX_ total invoices)',
            lengthMenu: 'Show _MENU_ invoices per page',
            search: 'Search invoices:',
            searchPlaceholder: 'Search by name, email, phone...',
            zeroRecords: 'No matching invoice records found',
            processing: '<div class="d-flex justify-content-center"><div class="spinner-border" role="status"><span class="visually-hidden">Loading...</span></div></div>'
        }
    });

    // Update summary statistics
    function updateSummaryStats(data) {
        if (data.summary) {
            $('#total-revenue').text('A + numberWithCommas(data.summary.totalRevenue || 0));
            $('#active-count').text(data.summary.activeCount || 0);
            $('#pending-count').text(data.summary.pendingCount || 0);
        }
    }

    // Number formatting helper
    function numberWithCommas(x) {
        return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    }
});

// Export functions
function exportToPDF() {
    window.open("{{ route('admin.invoices.export', 'pdf') }}", '_blank');
}

function exportToExcel() {
    window.open("{{ route('admin.invoices.export', 'excel') }}", '_blank');
}
</script>
@endsection