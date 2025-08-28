@extends('layout.master')


@section('main_content')
<meta name="csrf-token" content="{{ csrf_token() }}">
<script src="https://cdn.datatables.net/1.13.8/js/jquery.dataTables.min.js"></script>

<link href="https://cdn.datatables.net/1.13.8/css/dataTables.bootstrap5.min.css" rel="stylesheet">
<link href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.bootstrap5.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<style>
    .action-buttons {
        display: flex;
        gap: 8px;
        justify-content: flex-end;
    }
	.dataTables_length select {
    -webkit-appearance: auto !important;
    -moz-appearance: auto !important;
    appearance: auto !important;
    background-image: none !important; /* Remove any custom arrow */
}
	/* Override white text in modal headers */
#listingDetailsModal .modal-header,
#listingDetailsModal .modal-header *,
#listingDetailsModal .card-header,
#listingDetailsModal .card-header *,
#listingDetailsModal .text-white {
   color: #000 !important;
}

/* Ensure close button is visible */
#listingDetailsModal .btn-close-white {
   filter: invert(1);
   color: #000 !important;
}

/* Ensure all text in the modal is black */
#listingDetailsModal,
#listingDetailsModal * {
   color: #000 !important;
}

/* Exception for links to keep them styled */
#listingDetailsModal a {
   color: #0d6efd !important;
}

/* Ensure icons are visible */
#listingDetailsModal .fas,
#listingDetailsModal .fa {
   color: #000 !important;
}

/* Special handling for feature tags if they exist */
#listingDetailsModal .feature-tag {
   color: #000 !important;
   background-color: #e9ecef !important;
}
	.modal-content {
        border: none;
        border-radius: 0.5rem;
    }
    .modal-header {
        border-bottom: 1px solid rgba(0, 0, 0, 0.05);
        padding: 1rem 1.5rem;
    }
    .modal-title {
        font-weight: 600;
    }
    .modal-body {
        padding: 1.5rem;
    }
    .detail-item {
        margin-bottom: 1rem;
    }
    .detail-label {
        font-weight: 600;
        color: #6c757d;
        margin-bottom: 0.25rem;
    }
    .detail-value {
        color: #212529;
        font-size: 1rem;
    }
    .modal-content {
        border-radius: 0.5rem;
        overflow: hidden;
    }
    .modal-header {
        padding: 1rem 1.5rem;
    }
    .modal-body {
        padding: 1.5rem;
    }
    .modal-footer {
        padding: 1rem 1.5rem;
    }
    .avatar {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 40px;
        height: 40px;
        border-radius: 50%;
    }
    .bg-soft-primary {
        background-color: rgba(0, 0, 0, 0.1);
    }
    .text-primary {
        color: #000;
    }
    .text-sm {
        font-size: 0.75rem;
    }
    .d-flex > .flex-shrink-0 {
        width: 24px;
        text-align: center;
    }
    .vendor-name {
        font-weight: 500;
        color: #212529;
    }
    .vendor-contact {
        font-size: 0.875rem;
        color: #6c757d;
    }
    .agent-badge {
        background-color: #e9ecef;
        color: #495057;
        padding: 0.25rem 0.5rem;
        border-radius: 0.25rem;
        font-size: 0.75rem;
        font-weight: 500;
    }
    


    .action-btn {
        display: inline-flex;
        align-items: center;
        gap: 4px;
        padding: 6px 12px;
        font-size: 0.875rem;
        font-weight: 500;
        border: none;
        border-radius: 6px;
        cursor: pointer;
        transition: all 0.2s ease;
        color: #fff;
        text-decoration: none;
    }

  
    .action-btn.btn-view:hover {
        background-color: #0056b3;
    }


    .action-btn.btn-edit:hover {
        background-color: #1e7e34;
    }

  

    .action-btn.btn-delete:hover {
        background-color: #a71d2a;
    }

    /* Icon spacing fix */
    .action-btn i {
        font-size: 0.85rem;
    }

 
    .page-wrapper {
        background: #f8f9fa;
        min-height: 100vh;
    }
    .card {
        border: none;
        box-shadow: 0 0.15rem 1.75rem 0 rgba(33, 40, 50, 0.05);
        border-radius: 0.5rem;
        margin-bottom: 1.5rem;
        background-color: #fff;
    }
    .card-header {
        background: #fff;
        border-bottom: 1px solid rgba(0, 0, 0, 0.05);
        border-radius: 0.5rem 0.5rem 0 0 !important;
        padding: 1.25rem 1.5rem;
    }
    .hot-head1 {
        color: #212529;
        font-weight: 600;
        margin: 0;
        font-size: 1.5rem;
    }
    .btn-primary {
        background-color: #000;
        border-color: #000;
        color: #fff;
        border-radius: 0.375rem;
        padding: 0.5rem 1rem;
        font-weight: 500;
        transition: all 0.2s ease;
    }
    .btn-primary:hover {
        background-color: #333;
        border-color: #333;
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
    }
    .badge-success {
        background-color: #28a745;
    }
    .badge-warning {
        background-color: #ffc107;
        color: #212529;
    }
    
    .avatar {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 40px;
        height: 40px;
        border-radius: 50%;
    }
    .bg-soft-primary {
        background-color: rgba(0, 0, 0, 0.1);
    }
    .text-primary {
        color: #000;
    }
    .text-sm {
        font-size: 0.75rem;
    }
    .d-flex > .flex-shrink-0 {
        width: 24px;
        text-align: center;
    }
    .vendor-name {
        font-weight: 500;
        color: #212529;
    }
    .vendor-contact {
        font-size: 0.875rem;
        color: #6c757d;
    }
    
    /* Calendar Filter Styles */
    .date-picker-container {
        position: relative;
    }
    .date-input-wrapper {
        position: relative;
    }
    .date-input {
        background: rgba(255, 255, 255, 0.9);
        border: 1px solid #ced4da;
        border-radius: 10px;
        padding: 12px 45px 12px 15px;
        font-weight: 500;
        transition: all 0.3s ease;
    }
    .date-input:focus {
        background: white;
        border-color: #000;
        box-shadow: 0 0 0 0.2rem rgba(0, 0, 0, 0.25);
    }
    .date-icon {
        position: absolute;
        right: 15px;
        top: 50%;
        transform: translateY(-50%);
        color: #666;
        pointer-events: none;
    }
    .dual-calendar-container {
        position: absolute;
        top: 100%;
        left: 0;
        z-index: 1000;
        background: white;
        border-radius: 10px;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        padding: 15px;
        width: 650px;
    }
    .dual-calendar-wrapper {
        display: flex;
        gap: 20px;
    }
    .calendar-section {
        flex: 1;
    }
    .calendar-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 10px;
    }
    .current-month {
        margin: 0;
        font-size: 1rem;
        font-weight: 600;
    }
    .calendar-body {
        display: grid;
        grid-template-columns: repeat(7, 1fr);
        gap: 5px;
    }
    .calendar-day-header {
        text-align: center;
        font-weight: 600;
        font-size: 0.8rem;
        padding: 5px;
        color: #666;
    }
    .calendar-day {
        text-align: center;
        padding: 8px;
        border-radius: 5px;
        cursor: pointer;
        font-size: 0.9rem;
        transition: all 0.2s ease;
    }
    .calendar-day:hover:not(.disabled) {
        background-color: #f0f0f0;
    }
    .calendar-day.disabled {
        color: #ccc;
        cursor: not-allowed;
    }
    .calendar-day.today {
        background-color: #e6f7ff;
        color: #1890ff;
        font-weight: 600;
    }
    .calendar-day.selected-from,
    .calendar-day.selected-to {
        background-color: #000;
        color: white;
        font-weight: 600;
    }
    .calendar-day.in-range {
        background-color: #f0f5ff;
        color: #000;
    }
    .calendar-footer {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-top: 15px;
        padding-top: 15px;
        border-top: 1px solid #eee;
    }
    .selected-dates {
        display: flex;
        gap: 15px;
    }
    .selected-from,
    .selected-to {
        font-size: 0.9rem;
    }
    
    /* Modal Styles */
    .modal-content {
        border: none;
        box-shadow: 0 0.5rem 1.5rem rgba(0, 0, 0, 0.15);
        border-radius: 0.5rem;
    }
    .modal-header {
        border-bottom: 1px solid rgba(0, 0, 0, 0.05);
        padding: 1.25rem 1.5rem;
    }
    .modal-body {
        padding: 1.5rem;
    }
    .modal-footer {
        border-top: 1px solid rgba(0, 0, 0, 0.05);
        padding: 1rem 1.5rem;
    }
    .detail-item {
        margin-bottom: 1rem;
    }
    .detail-label {
        font-size: 0.75rem;
        text-transform: uppercase;
        color: #6c757d;
        font-weight: 600;
        margin-bottom: 0.25rem;
    }
    .detail-value {
        font-size: 0.9rem;
        color: #212529;
    }
     .page-body1{
        padding:0px;
    }
</style>
<div class="page-wrapper compact-wrapper" id="pageWrapper">
    <div class="page-body-wrapper">
        <div class="page-body1">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header pb-0 d-flex justify-content-between align-items-center">
                                <h4 class="hot-head1">
                                    <i class="fas fa-home me-2"></i>Just Listed Properties
                                </h4>
                                <a href="{{ route('agent.just-listed.create') }}" class="btn btn-primary">
                                    <i class="fas fa-plus me-1"></i> New Listing
                                </a>
                            </div>
                            <div class="card-body">
                                <!-- Filters Section -->
                                <div class="row mb-4">
                                    <div class="col-md-6">
                                        <label class="form-label">Filter by Date Range</label>
                                        <div class="position-relative">
                                            <input type="text" class="form-control" id="dateRange" placeholder="Select date range">
                                            <i class="fas fa-calendar-alt position-absolute" style="right: 10px; top: 50%; transform: translateY(-50%); color: #6c757d;"></i>
                                        </div>

                                        <!-- Dual Calendar -->
                                        <div class="dual-calendar-container mt-3" id="dualCalendarContainer" style="display: none;">
                                            <div class="dual-calendar-wrapper d-flex justify-content-between gap-3">
                                                <!-- From -->
                                                <div class="calendar-section w-50">
                                                    <div class="calendar-header d-flex justify-content-between align-items-center mb-2">
                                                        <button class="btn btn-sm btn-outline-secondary prev-month" data-calendar="from">
                                                            <i class="fas fa-chevron-left"></i>
                                                        </button>
                                                        <h6 class="current-month mb-0" id="fromCurrentMonth"></h6>
                                                        <button class="btn btn-sm btn-outline-secondary next-month" data-calendar="from">
                                                            <i class="fas fa-chevron-right"></i>
                                                        </button>
                                                    </div>
                                                    <div class="calendar-body" id="fromCalendarBody"></div>
                                                </div>

                                                <!-- To -->
                                                <div class="calendar-section w-50">
                                                    <div class="calendar-header d-flex justify-content-between align-items-center mb-2">
                                                        <button class="btn btn-sm btn-outline-secondary prev-month" data-calendar="to">
                                                            <i class="fas fa-chevron-left"></i>
                                                        </button>
                                                        <h6 class="current-month mb-0" id="toCurrentMonth"></h6>
                                                        <button class="btn btn-sm btn-outline-secondary next-month" data-calendar="to">
                                                            <i class="fas fa-chevron-right"></i>
                                                        </button>
                                                    </div>
                                                    <div class="calendar-body" id="toCalendarBody"></div>
                                                </div>
                                            </div>

                                            <div class="calendar-footer mt-3">
                                                <div class="selected-dates mb-2">
                                                    <span class="me-3">From: <strong id="selectedFromDisplay">Not selected</strong></span>
                                                    <span>To: <strong id="selectedToDisplay">Not selected</strong></span>
                                                </div>
                                                <div>
                                                    <button class="btn btn-sm btn-outline-secondary me-2" id="clearDates">Clear</button>
                                                    <button class="btn btn-sm btn-primary" id="applyDates">Apply</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="table-responsive">
                                    <table id="just-listed-table" class="table table-hover" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>Property Address</th>
                                                <th>Vendor</th>
                                                <th>Contact Info</th>
                                                <th>Created At</th>
                                                <th class="text-end">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody></tbody>
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
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
<script>
$(document).ready(function() {
    // Calendar variables
    let fromCurrentMonth = moment();
    let toCurrentMonth = moment().add(1, 'month');
    let selectedFromDate = null;
    let selectedToDate = null;

    // Initialize DataTable
    const table = $('#just-listed-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: "{{ route('agent.just-listed.index') }}",
            data: function(d) {
                d.start_date = selectedFromDate ? selectedFromDate.format('YYYY-MM-DD') : '';
                d.end_date = selectedToDate ? selectedToDate.format('YYYY-MM-DD') : '';
            }
        },
        columns: [
            { 
                data: 'vendor1_address', 
                name: 'vendor1_address',
                render: function(data) {
                    return data || 'N/A';
                }
            },
            { 
                data: 'vendor_name', 
                name: 'vendor1_first_name',
                render: function(data, type, row) {
                    return (row.vendor1_first_name || '') + ' ' + (row.vendor1_last_name || '') || 'N/A';
                }
            },
            { 
                data: 'contact_info', 
                name: 'vendor1_mobile',
                render: function(data, type, row) {
                    return (row.vendor1_mobile || 'N/A') + '<br>' + (row.vendor1_email || '');
                }
            },
            { 
                data: 'created_at', 
                name: 'created_at',
                render: function(data) {
                    return data ? new Date(data).toLocaleString() : 'N/A';
                }
            },
            { 
                data: 'actions', 
                name: 'actions', 
                orderable: false, 
                searchable: false,
                className: 'text-end',
                render: function(data, type, row) {
                    return `
                        <div class="action-buttons">
                            <button class="action-btn btn-outline-secondary btn-view view-btn"  data-id="${row.id}"  style="color:black;border:1px solid black;">
                                <i class="fas fa-eye me-1"></i> 
                            </button>
                           
                            <button class="action-btn btn-delete delete-btn btn-outline-danger" data-id="${row.id}"style="color:black;border:1px solid black;">
                                <i class="fas fa-trash me-1"></i> 
                            </button>
                        </div>
                    `;
                }
            }
        ],
        order: [[3, 'desc']],
        pageLength: 10,
        responsive: true,
        language: {
            emptyTable: 'No listings found',
            info: 'Showing _START_ to _END_ of _TOTAL_ listings',
            infoEmpty: 'Showing 0 to 0 of 0 listings',
            infoFiltered: '(filtered from _MAX_ total listings)',
            lengthMenu: 'Show _MENU_ listings',
            search: '_INPUT_',
            searchPlaceholder: 'Search listings...',
            zeroRecords: 'No matching listings found'
        },
        dom: '<"top"<"row"<"col-md-6"l><"col-md-6"f>>>rt<"bottom"<"row"<"col-md-6"i><"col-md-6"p>>>'
    });

    // Calendar functions
    function generateDualCalendar(month, calendarType) {
        const startOfMonth = month.clone().startOf('month');
        const endOfMonth = month.clone().endOf('month');
        const startDate = startOfMonth.clone().startOf('week');
        const endDate = endOfMonth.clone().endOf('week');

        const calendarBody = $(`#${calendarType}CalendarBody`);
        calendarBody.empty();

        // Add day headers
        const days = ['Su', 'Mo', 'Tu', 'We', 'Th', 'Fr', 'Sa'];
        days.forEach(day => {
            calendarBody.append(`<div class="calendar-day-header">${day}</div>`);
        });

        // Add days
        const currentDate = startDate.clone();
        while (currentDate.isBefore(endDate)) {
            const day = currentDate.date();
            const isCurrentMonth = currentDate.isSame(month, 'month');
            const isToday = currentDate.isSame(moment(), 'day');
            const isSelectedFrom = selectedFromDate && currentDate.isSame(selectedFromDate, 'day');
            const isSelectedTo = selectedToDate && currentDate.isSame(selectedToDate, 'day');
            const isInRange = selectedFromDate && selectedToDate &&
                currentDate.isAfter(selectedFromDate, 'day') &&
                currentDate.isBefore(selectedToDate, 'day');

            let dayClass = 'calendar-day';
            if (!isCurrentMonth) dayClass += ' disabled';
            if (isToday) dayClass += ' today';
            if (isSelectedFrom) dayClass += ' selected-from';
            if (isSelectedTo) dayClass += ' selected-to';
            if (isInRange) dayClass += ' in-range';

            calendarBody.append(`
                <div class="${dayClass}" data-date="${currentDate.format('YYYY-MM-DD')}" data-calendar="${calendarType}">
                    ${day}
                </div>
            `);

            currentDate.add(1, 'day');
        }

        // Update month header
        $(`#${calendarType}CurrentMonth`).text(month.format('MMMM YYYY'));
    }

    function updateSelectedDatesDisplay() {
        const fromDisplay = selectedFromDate ? selectedFromDate.format('DD MMM YYYY') : 'Not selected';
        const toDisplay = selectedToDate ? selectedToDate.format('DD MMM YYYY') : 'Not selected';

        $('#selectedFromDisplay').text(fromDisplay);
        $('#selectedToDisplay').text(toDisplay);
    }

    function updateDateRangeInput() {
        let dateRangeText = '';
        if (selectedFromDate && selectedToDate) {
            dateRangeText = selectedFromDate.format('DD MMM YYYY') + ' - ' + selectedToDate.format('DD MMM YYYY');
        } else if (selectedFromDate) {
            dateRangeText = selectedFromDate.format('DD MMM YYYY') + ' - Select end date';
        }
        $('#dateRange').val(dateRangeText);

        // Refresh the table
        table.draw();
    }

    function refreshBothCalendars() {
        generateDualCalendar(fromCurrentMonth, 'from');
        generateDualCalendar(toCurrentMonth, 'to');
        updateSelectedDatesDisplay();
    }

    // Initialize calendars
    refreshBothCalendars();

    // Show/hide calendar
    $('#dateRange').click(function (e) {
        e.stopPropagation();
        $('#dualCalendarContainer').toggle();
    });

    // Handle month navigation
    $(document).on('click', '.prev-month', function (e) {
        e.stopPropagation();
        const calendarType = $(this).data('calendar');
        if (calendarType === 'from') {
            fromCurrentMonth.subtract(1, 'month');
        } else {
            toCurrentMonth.subtract(1, 'month');
        }
        refreshBothCalendars();
    });

    $(document).on('click', '.next-month', function (e) {
        e.stopPropagation();
        const calendarType = $(this).data('calendar');
        if (calendarType === 'from') {
            fromCurrentMonth.add(1, 'month');
        } else {
            toCurrentMonth.add(1, 'month');
        }
        refreshBothCalendars();
    });

    $(document).on('click', '.calendar-day:not(.disabled)', function (e) {
        e.stopPropagation();
        const dateStr = $(this).data('date');
        const date = moment(dateStr);

        if (!selectedFromDate || (selectedFromDate && selectedToDate)) {
            selectedFromDate = date;
            selectedToDate = null;
        }
        else if (selectedFromDate && !selectedToDate) {
            if (date.isBefore(selectedFromDate)) {
                selectedToDate = selectedFromDate;
                selectedFromDate = date;
            } else {
                selectedToDate = date;
            }
            $('#dualCalendarContainer').hide();
        }

        refreshBothCalendars();
        updateDateRangeInput();
    });

    $(document).on('click', '#applyDates', function (e) {
        e.stopPropagation();
        $('#dualCalendarContainer').hide();
        updateDateRangeInput();
    });

    $(document).on('click', '#clearDates', function (e) {
        e.stopPropagation();
        selectedFromDate = null;
        selectedToDate = null;
        $('#dateRange').val('');
        refreshBothCalendars();
        updateDateRangeInput();
    });

    $(document).on('click', '.dual-calendar-container', function (e) {
        e.stopPropagation();
    });

    $(document).click(function (e) {
        if (!$(e.target).closest('.date-input-wrapper, .dual-calendar-container').length) {
            $('#dualCalendarContainer').hide();
        }
    });

    // View listing details
    $(document).on('click', '.view-btn', function() {
function formatDate(dateString) {
    if (!dateString) return 'N/A';
    const date = new Date(dateString);
    return date.toLocaleDateString('en-GB', { 
        day: '2-digit', month: 'short', year: 'numeric' 
    });
}
        const listingId = $(this).data('id');
        
        $.ajax({
            url: "{{ route('agent.just-listed.show', '') }}/" + listingId,
            type: 'GET',
            success: function(response) {
                if (response.success) {
                    const listing = response.data;
                    
                    // Create modal content
                    const modalContent = `
<div class="modal fade" id="listingDetailsModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg">
            <!-- Header -->
            <div class="modal-header border-0 bg-gradient text-white position-relative overflow-hidden" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); min-height: 80px;">
                <div class="d-flex align-items-center position-relative">
                    <div class="me-4 p-3 bg-white bg-opacity-20 rounded-circle">
                        <i class="fas fa-home fa-2x text-white"></i>
                    </div>
                    <div>
                        <h3 class="modal-title mb-1 fw-bold">Just Listed Property Details</h3>
                        <p class="mb-0 opacity-90">Comprehensive property listing overview</p>
                    </div>
                </div>
                <button type="button" class="btn-close btn-close-white position-relative" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body p-0">
                <div class="container-fluid p-4">
                    <div class="row g-4">
                        <!-- Vendor Information -->
                        <div class="col-lg-6">
                            <div class="card border-0 h-100 position-relative overflow-hidden" style="background: linear-gradient(135deg, #f8faff 0%, #f1f5ff 100%); box-shadow: 0 8px 32px rgba(79, 70, 229, 0.15);">
                                
                                
                                <div class="card-header border-0 bg-gradient text-white position-relative" style="background: linear-gradient(135deg, #4f46e5 0%, #7c3aed 100%);">
                                    <div class="d-flex align-items-center">
                                        <div class="me-3 p-2 bg-white bg-opacity-20 rounded">
                                            <i class="fas fa-user-tie"></i>
                                        </div>
                                        <div>
                                            <h5 class="mb-1 fw-bold">Vendor Information</h5>
                                            <small class="opacity-90">Primary & secondary contacts</small>
                                        </div>
                                    </div>
                                </div>

                                <div class="card-body p-4 position-relative">
                                    <div class="row g-3">
                                        <div class="col-md-6">
                                            <div class="form-floating">
                                                <div class="form-control bg-white border-2 fw-semibold" style="padding-top: 1.625rem; border-color: #e0e7ff !important;">
                                                    ${listing.vendor1_first_name || 'N/A'} ${listing.vendor1_last_name || ''}
                                                </div>
                                               <label class="text-muted fw-medium">
            <i class="fas fa-user me-2 text-primary"></i>Vendor Name
        </label>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-floating">
                                                <div class="form-control bg-white border-2 fw-semibold" style="padding-top: 1.625rem; border-color: #e0e7ff !important;">
                                                    ${listing.vendor1_mobile ? `<a href="tel:${listing.vendor1_mobile}" class="text-primary text-decoration-none fw-bold">${listing.vendor1_mobile}</a>` : 'N/A'}
                                                </div>
                                                <label class="text-muted fw-medium">
                                                    <i class="fas fa-phone me-2 text-success"></i>Mobile
                                                </label>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="form-floating">
                                                <div class="form-control bg-white border-2 fw-semibold" style="padding-top: 1.625rem; border-color: #e0e7ff !important;">
                                                    ${listing.vendor1_email ? `<a href="mailto:${listing.vendor1_email}" class="text-primary text-decoration-none fw-bold">${listing.vendor1_email}</a>` : 'N/A'}
                                                </div>
                                                <label class="text-muted fw-medium">
                                                    <i class="fas fa-envelope me-2 text-info"></i>Email
                                                </label>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="form-floating">
                                                <div class="form-control bg-white border-2 fw-semibold" style="padding-top: 1.625rem; border-color: #e0e7ff !important;">
                                                    ${listing.vendor1_address || 'N/A'}
                                                </div>
                                                <label class="text-muted fw-medium">
                                                    <i class="fas fa-map-marker-alt me-2 text-danger"></i>Address
                                                </label>
                                            </div>
                                        </div>

                                        <!-- Secondary Vendor - Only show if has_additional_vendor is true -->
                                        ${listing.has_additional_vendor && (listing.vendor2_first_name || listing.vendor2_last_name || listing.vendor2_mobile || listing.vendor2_email) ? `
                                        <div class="col-12"><hr class="my-3"></div>
                                        <div class="col-md-6">
                                            <div class="form-floating">
                                                <div class="form-control bg-white border-2 fw-semibold" style="padding-top: 1.625rem; border-color: #e0e7ff !important;">
                                                    ${(listing.vendor2_first_name || '') + ' ' + (listing.vendor2_last_name || '') || 'N/A'}
                                                </div>
                                                <label class="text-muted fw-medium">
                                                    <i class="fas fa-user me-2 text-primary"></i>Secondary Vendor
                                                </label>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-floating">
                                                <div class="form-control bg-white border-2 fw-semibold" style="padding-top: 1.625rem; border-color: #e0e7ff !important;">
                                                    ${listing.vendor2_mobile ? `<a href="tel:${listing.vendor2_mobile}" class="text-primary text-decoration-none fw-bold">${listing.vendor2_mobile}</a>` : 'N/A'}
                                                </div>
                                                <label class="text-muted fw-medium">
                                                    <i class="fas fa-phone me-2 text-success"></i>Mobile
                                                </label>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="form-floating">
                                                <div class="form-control bg-white border-2 fw-semibold" style="padding-top: 1.625rem; border-color: #e0e7ff !important;">
                                                    ${listing.vendor2_email ? `<a href="mailto:${listing.vendor2_email}" class="text-primary text-decoration-none fw-bold">${listing.vendor2_email}</a>` : 'N/A'}
                                                </div>
                                                <label class="text-muted fw-medium">
                                                    <i class="fas fa-envelope me-2 text-info"></i>Email
                                                </label>
                                            </div>
                                        </div>
                                        ` : ''}
                                    </div>
                                </div>
                            </div>
                        </div>

                        

                        <!-- Campaign Details -->
                        <div class="col-lg-6">
                            <div class="card border-0 h-100 shadow-sm" style="background: linear-gradient(135deg, #ffffff 0%, #f8fafc 100%);">
                                <div class="card-header bg-light border-bottom">
                                    <div class="d-flex align-items-center">
                                        <div class="me-3 p-2 bg-success bg-opacity-10 rounded text-success">
                                            <i class="fas fa-bullhorn"></i>
                                        </div>
                                        <div>
                                            <h5 class="mb-1 fw-bold">Campaign Details</h5>
                                            <small class="text-muted">Sales & marketing information</small>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="card-body p-4">
                                    <div class="row g-3">
                                        <div class="col-md-6">
                                            <div class="form-floating">
                                                <div class="form-control bg-light border fw-semibold" style="padding-top: 1.625rem;">
                                                    ${listing.method_of_sale || 'N/A'} ${listing.other_method_details ? '(' + listing.other_method_details + ')' : ''}
                                                </div>
                                                <label class="text-muted fw-medium">
                                                    <i class="fas fa-tag me-2 text-primary"></i>Method of Sale
                                                </label>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-floating">
                                                <div class="form-control bg-light border fw-semibold" style="padding-top: 1.625rem;">
                                                    ${formatDate(listing.auction_date)}
                                                </div>
                                                <label class="text-muted fw-medium">
                                                    <i class="fas fa-gavel me-2 text-warning"></i>Auction Date
                                                </label>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-floating">
                                                <div class="form-control bg-light border fw-semibold" style="padding-top: 1.625rem;">
                                                       ${formatDate(listing.first_open_date)}
                                                </div>
                                                <label class="text-muted fw-medium">
                                                    <i class="fas fa-door-open me-2 text-danger"></i>First Open Date
                                                </label>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-floating">
                                                <div class="form-control bg-light border fw-semibold" style="padding-top: 1.625rem;">
                                                   ${formatDate(listing.expressions_closing_date)}
                                                </div>
                                                <label class="text-muted fw-medium">
                                                    <i class="fas fa-calendar-check me-2 text-info"></i>Expressions Closing
                                                </label>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="form-floating">
                                                <div class="form-control bg-light border fw-semibold" style="padding-top: 1.625rem;">
                                                    ${listing.potential_auction_discussed || 'N/A'}
                                                </div>
                                                <label class="text-muted fw-medium">
                                                    <i class="fas fa-comment-dollar me-2 text-success"></i>Potential Auction Discussed
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Agent Order -->
                        <div class="col-lg-12">
                            <div class="card border-0 h-100 shadow-sm" style="background: linear-gradient(135deg, #ffffff 0%, #f8fafc 100%);">
                                <div class="card-header bg-light border-bottom">
                                    <div class="d-flex align-items-center">
                                        <div class="me-3 p-2 bg-info bg-opacity-10 rounded text-info">
                                            <i class="fas fa-user-tie"></i>
                                        </div>
                                        <div>
                                            <h5 class="mb-1 fw-bold">Display Order of Agents</h5>
                                            <small class="text-muted">Agent priority listing</small>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body p-4">
                                    <div class="row g-3">
                                        <div class="col-md-6">
                                            <div class="form-floating">
                                                <div class="form-control bg-light border fw-semibold" style="padding-top: 1.625rem;">
                                                    ${listing.first_agent === 'other' ? listing.first_agent_other : listing.first_agent || 'N/A'}
                                                </div>
                                                <label class="text-muted fw-medium">
                                                    <i class="fas fa-user-tie me-2 text-primary"></i>First Agent
                                                </label>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-floating">
                                                <div class="form-control bg-light border fw-semibold" style="padding-top: 1.625rem;">
                                                    ${listing.second_agent === 'other' ? listing.second_agent_other : listing.second_agent || 'N/A'}
                                                </div>
                                                <label class="text-muted fw-medium">
                                                    <i class="fas fa-user-tie me-2 text-success"></i>Second Agent
                                                </label>
                                            </div>
                                        </div>

                                        <!-- Third Agent - Only show if has_third_agent is true -->
                                        ${listing.has_third_agent && (listing.third_agent || listing.third_agent_other) ? `
                                        <div class="col-12">
                                            <div class="form-floating">
                                                <div class="form-control bg-light border fw-semibold" style="padding-top: 1.625rem;">
                                                    ${listing.third_agent === 'other' ? listing.third_agent_other : listing.third_agent || 'N/A'}
                                                </div>
                                                <label class="text-muted fw-medium">
                                                    <i class="fas fa-user-tie me-2 text-warning"></i>Third Agent
                                                </label>
                                            </div>
                                        </div>
                                        ` : ''}
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Marketing Services - Only show if has marketing services -->
                        ${(listing.photography_services && Array.isArray(listing.photography_services) && listing.photography_services.length > 0) || 
                          (listing.copywriting_services && Array.isArray(listing.copywriting_services) && listing.copywriting_services.length > 0) || 
                          (listing.floorplan_services && Array.isArray(listing.floorplan_services) && listing.floorplan_services.length > 0) || 
                          listing.photography_supplier || listing.copywriting_supplier || listing.floorplan_supplier || 
                          listing.other_photography_requirements || listing.other_marketing_details ? `
                        <div class="col-12">
                            <div class="card border-0 shadow-sm" style="background: linear-gradient(135deg, #ffffff 0%, #f8fafc 100%);">
                                <div class="card-header bg-light border-bottom">
                                    <div class="d-flex align-items-center">
                                        <div class="me-3 p-2 bg-primary bg-opacity-10 rounded text-primary">
                                            <i class="fas fa-ad"></i>
                                        </div>
                                        <div>
                                            <h5 class="mb-1 fw-bold">Marketing Services</h5>
                                            <small class="text-muted">Photography, copywriting & floorplan</small>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body p-4">
                                    <div class="row g-3">
                                        ${(listing.photography_services && Array.isArray(listing.photography_services) && listing.photography_services.length > 0) ? `
                                        <div class="col-md-4">
                                            <div class="form-floating">
                                                <div class="form-control bg-light border" style="padding-top: 1.625rem; min-height: 80px;">
                                                    <div class="feature-tags">
                                                        ${listing.photography_services.map(item => `<span class="feature-tag">${item}</span>`).join('')}
                                                    </div>
                                                </div>
                                                <label class="text-muted fw-medium">
                                                    <i class="fas fa-camera me-2 text-danger"></i>Photography Services
                                                </label>
                                            </div>
                                        </div>
                                        ` : ''}

                                        ${(listing.copywriting_services && Array.isArray(listing.copywriting_services) && listing.copywriting_services.length > 0) ? `
                                        <div class="col-md-4">
                                            <div class="form-floating">
                                                <div class="form-control bg-light border" style="padding-top: 1.625rem; min-height: 80px;">
                                                    <div class="feature-tags">
                                                        ${listing.copywriting_services.map(item => `<span class="feature-tag">${item}</span>`).join('')}
                                                    </div>
                                                </div>
                                                <label class="text-muted fw-medium">
                                                    <i class="fas fa-pen-fancy me-2 text-info"></i>Copywriting Services
                                                </label>
                                            </div>
                                        </div>
                                        ` : ''}

                                        ${(listing.floorplan_services && Array.isArray(listing.floorplan_services) && listing.floorplan_services.length > 0) ? `
                                        <div class="col-md-4">
                                            <div class="form-floating">
                                                <div class="form-control bg-light border" style="padding-top: 1.625rem; min-height: 80px;">
                                                    <div class="feature-tags">
                                                        ${listing.floorplan_services.map(item => `<span class="feature-tag">${item}</span>`).join('')}
                                                    </div>
                                                </div>
                                                <label class="text-muted fw-medium">
                                                    <i class="fas fa-ruler-combined me-2 text-success"></i>Floorplan Services
                                                </label>
                                            </div>
                                        </div>
                                        ` : ''}

                                        ${listing.photography_supplier ? `
                                        <div class="col-md-4">
                                            <div class="form-floating">
                                                <div class="form-control bg-light border fw-semibold" style="padding-top: 1.625rem;">
                                                    ${listing.photography_supplier}
                                                </div>
                                                <label class="text-muted fw-medium">
                                                    <i class="fas fa-user-tie me-2 text-primary"></i>Photography Supplier
                                                </label>
                                            </div>
                                        </div>
                                        ` : ''}

                                        ${listing.copywriting_supplier ? `
                                        <div class="col-md-4">
                                            <div class="form-floating">
                                                <div class="form-control bg-light border fw-semibold" style="padding-top: 1.625rem;">
                                                    ${listing.copywriting_supplier}
                                                </div>
                                                <label class="text-muted fw-medium">
                                                    <i class="fas fa-user-tie me-2 text-info"></i>Copywriting Supplier
                                                </label>
                                            </div>
                                        </div>
                                        ` : ''}

                                        ${listing.floorplan_supplier ? `
                                        <div class="col-md-4">
                                            <div class="form-floating">
                                                <div class="form-control bg-light border fw-semibold" style="padding-top: 1.625rem;">
                                                    ${listing.floorplan_supplier}
                                                </div>
                                                <label class="text-muted fw-medium">
                                                    <i class="fas fa-user-tie me-2 text-success"></i>Floorplan Supplier
                                                </label>
                                            </div>
                                        </div>
                                        ` : ''}

                                        ${listing.other_photography_requirements ? `
                                        <div class="col-12">
                                            <div class="form-floating">
                                                <div class="form-control bg-light border fw-semibold" style="padding-top: 1.625rem;">
                                                    ${listing.other_photography_requirements}
                                                </div>
                                                <label class="text-muted fw-medium">
                                                    <i class="fas fa-comment me-2 text-warning"></i>Other Photography Requirements
                                                </label>
                                            </div>
                                        </div>
                                        ` : ''}

                                        ${listing.other_marketing_required && listing.other_marketing_details ? `
                                        <div class="col-12">
                                            <div class="form-floating">
                                                <div class="form-control bg-light border fw-semibold" style="padding-top: 1.625rem;">
                                                    ${listing.other_marketing_details}
                                                </div>
                                                <label class="text-muted fw-medium">
                                                    <i class="fas fa-bullhorn me-2 text-danger"></i>Other Marketing Details
                                                </label>
                                            </div>
                                        </div>
                                        ` : ''}
                                    </div>
                                </div>
                            </div>
                        </div>
                        ` : ''}

                        <!-- Other Suppliers - Only show if needed -->
                        ${listing.other_supplier_needed && (listing.supplier_name || listing.supplier_category || listing.supplier_requirements) ? `
                        <div class="col-12">
                            <div class="card border-0 shadow-sm" style="background: linear-gradient(135deg, #ffffff 0%, #f8fafc 100%);">
                                <div class="card-header bg-light border-bottom">
                                    <div class="d-flex align-items-center">
                                        <div class="me-3 p-2 bg-success bg-opacity-10 rounded text-success">
                                            <i class="fas fa-tools"></i>
                                        </div>
                                        <div>
                                            <h5 class="mb-1 fw-bold">Other Suppliers</h5>
                                            <small class="text-muted">Additional service providers</small>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body p-4">
                                    <div class="row g-3">
                                        ${listing.supplier_name ? `
                                        <div class="col-md-6">
                                            <div class="form-floating">
                                                <div class="form-control bg-light border fw-semibold" style="padding-top: 1.625rem;">
                                                    ${listing.supplier_name}
                                                </div>
                                                <label class="text-muted fw-medium">
                                                    <i class="fas fa-tools me-2 text-primary"></i>Supplier Name
                                                </label>
                                            </div>
                                        </div>
                                        ` : ''}

                                        ${listing.supplier_category ? `
                                        <div class="col-md-6">
                                            <div class="form-floating">
                                                <div class="form-control bg-light border fw-semibold" style="padding-top: 1.625rem;">
                                                    ${listing.supplier_category}
                                                </div>
                                                <label class="text-muted fw-medium">
                                                    <i class="fas fa-tags me-2 text-info"></i>Category
                                                </label>
                                            </div>
                                        </div>
                                        ` : ''}

                                        ${listing.supplier_requirements ? `
                                        <div class="col-12">
                                            <div class="form-floating">
                                                <div class="form-control bg-light border fw-semibold" style="padding-top: 1.625rem;">
                                                    ${listing.supplier_requirements}
                                                </div>
                                                <label class="text-muted fw-medium">
                                                    <i class="fas fa-clipboard-list me-2 text-warning"></i>Requirements
                                                </label>
                                            </div>
                                        </div>
                                        ` : ''}

                                        ${listing.supplier_mobile ? `
                                        <div class="col-md-6">
                                            <div class="form-floating">
                                                <div class="form-control bg-light border fw-semibold" style="padding-top: 1.625rem;">
                                                    <a href="tel:${listing.supplier_mobile}" class="text-primary text-decoration-none fw-bold">${listing.supplier_mobile}</a>
                                                </div>
                                                <label class="text-muted fw-medium">
                                                    <i class="fas fa-phone me-2 text-success"></i>Mobile
                                                </label>
                                            </div>
                                        </div>
                                        ` : ''}

                                        ${listing.supplier_email ? `
                                        <div class="col-md-6">
                                            <div class="form-floating">
                                                <div class="form-control bg-light border fw-semibold" style="padding-top: 1.625rem;">
                                                    <a href="mailto:${listing.supplier_email}" class="text-primary text-decoration-none fw-bold">${listing.supplier_email}</a>
                                                </div>
                                                <label class="text-muted fw-medium">
                                                    <i class="fas fa-envelope me-2 text-danger"></i>Email
                                                </label>
                                            </div>
                                        </div>
                                        ` : ''}
                                    </div>
                                </div>
                            </div>
                        </div>
                        ` : ''}
                        <!-- Property Access -->
                        <div class="col-lg-6">
                            <div class="card border-0 h-100 shadow-sm" style="background: linear-gradient(135deg, #ffffff 0%, #f8fafc 100%);">
                                <div class="card-header bg-light border-bottom">
                                    <div class="d-flex align-items-center">
                                        <div class="me-3 p-2 bg-warning bg-opacity-10 rounded text-warning">
                                            <i class="fas fa-key"></i>
                                        </div>
                                        <div>
                                            <h5 class="mb-1 fw-bold">Property Access Details</h5>
                                            <small class="text-muted">Access & security information</small>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body p-4">
                                    <div class="row g-3">
                                        ${listing.occupancy_status ? `
                                        <div class="col-md-6">
                                            <div class="form-floating">
                                                <div class="form-control bg-light border fw-semibold" style="padding-top: 1.625rem;">
                                                    ${listing.occupancy_status}
                                                </div>
                                                <label class="text-muted fw-medium">
                                                    <i class="fas fa-home me-2 text-primary"></i>Occupancy Status
                                                </label>
                                            </div>
                                        </div>
                                        ` : ''}

                                        ${listing.occupancy_status === 'rented' && listing.renters_name ? `
                                        <div class="col-md-6">
                                            <div class="form-floating">
                                                <div class="form-control bg-light border fw-semibold" style="padding-top: 1.625rem;">
                                                    ${listing.renters_name}
                                                </div>
                                                <label class="text-muted fw-medium">
                                                    <i class="fas fa-user me-2 text-info"></i>Renter's Name
                                                </label>
                                            </div>
                                        </div>
                                        ` : ''}

                                        ${listing.occupancy_status === 'rented' && listing.renters_phone ? `
                                        <div class="col-md-6">
                                            <div class="form-floating">
                                                <div class="form-control bg-light border fw-semibold" style="padding-top: 1.625rem;">
                                                    <a href="tel:${listing.renters_phone}" class="text-primary text-decoration-none fw-bold">${listing.renters_phone}</a>
                                                </div>
                                                <label class="text-muted fw-medium">
                                                    <i class="fas fa-phone me-2 text-success"></i>Renter's Phone
                                                </label>
                                            </div>
                                        </div>
                                        ` : ''}

                                        ${listing.property_access ? `
                                        <div class="col-md-6">
                                            <div class="form-floating">
                                                <div class="form-control bg-light border fw-semibold" style="padding-top: 1.625rem;">
                                                    ${listing.property_access}
                                                </div>
                                                <label class="text-muted fw-medium">
                                                    <i class="fas fa-key me-2 text-warning"></i>Property Access
                                                </label>
                                            </div>
                                        </div>
                                        ` : ''}

                                        ${listing.other_access_arrangements ? `
                                        <div class="col-12">
                                            <div class="form-floating">
                                                <div class="form-control bg-light border fw-semibold" style="padding-top: 1.625rem;">
                                                    ${listing.other_access_arrangements}
                                                </div>
                                                <label class="text-muted fw-medium">
                                                    <i class="fas fa-info-circle me-2 text-danger"></i>Other Access Arrangements
                                                </label>
                                            </div>
                                        </div>
                                        ` : ''}

                                        

                                      

                                        ${(listing.keysafe_location || listing.other_keysafe_location) ? `
                                        <div class="col-md-6">
                                            <div class="form-floating">
                                                <div class="form-control bg-light border fw-semibold" style="padding-top: 1.625rem;">
                                                    ${listing.keysafe_location === 'other' ? listing.other_keysafe_location : listing.keysafe_location}
                                                </div>
                                                <label class="text-muted fw-medium">
                                                    <i class="fas fa-map-marker-alt me-2 text-info"></i>Keysafe Location
                                                </label>
                                            </div>
                                        </div>
                                        ` : ''}

                                        ${listing.alarm_system ? `
                                        <div class="col-12">
                                            <div class="form-floating">
                                                <div class="form-control bg-light border fw-semibold" style="padding-top: 1.625rem;">
                                                    ${listing.alarm_system} ${listing.alarm_instructions ? '(' + listing.alarm_instructions + ')' : ''}
                                                </div>
                                                <label class="text-muted fw-medium">
                                                    <i class="fas fa-bell me-2 text-danger"></i>Alarm System
                                                </label>
                                            </div>
                                        </div>
                                        ` : ''}
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Trades - Only show if has trade information -->
                        ${(listing.trades_no_access && Array.isArray(listing.trades_no_access) && listing.trades_no_access.length > 0) || 
                          (listing.trades_require_access && Array.isArray(listing.trades_require_access) && listing.trades_require_access.length > 0) || 
                          listing.other_trades_needed || listing.trades_contact_method || listing.vacant_access_instructions || 
                          listing.painting_notes || listing.gardening_notes ? `
                        <div class="col-lg-6">
                            <div class="card border-0 h-100 shadow-sm" style="background: linear-gradient(135deg, #ffffff 0%, #f8fafc 100%);">
                                <div class="card-header bg-light border-bottom">
                                    <div class="d-flex align-items-center">
                                        <div class="me-3 p-2 bg-primary bg-opacity-10 rounded text-primary">
                                            <i class="fas fa-tools"></i>
                                        </div>
                                        <div>
                                            <h5 class="mb-1 fw-bold">Trades</h5>
                                            <small class="text-muted">Trade services information</small>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body p-4">
                                    <div class="row g-3">
                                        ${(listing.trades_no_access && Array.isArray(listing.trades_no_access) && listing.trades_no_access.length > 0) ? `
                                        <div class="col-12">
                                            <div class="form-floating">
                                                <div class="form-control bg-light border" style="padding-top: 1.625rem; min-height: 80px;">
                                                    <div class="feature-tags">
                                                        ${listing.trades_no_access.map(item => `<span class="feature-tag">${item}</span>`).join('')}
                                                    </div>
                                                </div>
                                                <label class="text-muted fw-medium">
                                                    <i class="fas fa-ban me-2 text-danger"></i>No Access Required
                                                </label>
                                            </div>
                                        </div>
                                        ` : ''}

                                        ${(listing.trades_require_access && Array.isArray(listing.trades_require_access) && listing.trades_require_access.length > 0) ? `
                                        <div class="col-12">
                                            <div class="form-floating">
                                                <div class="form-control bg-light border" style="padding-top: 1.625rem; min-height: 80px;">
                                                    <div class="feature-tags">
                                                        ${listing.trades_require_access.map(item => `<span class="feature-tag">${item}</span>`).join('')}
                                                    </div>
                                                </div>
                                                <label class="text-muted fw-medium">
                                                    <i class="fas fa-check-circle me-2 text-success"></i>Require Access
                                                </label>
                                            </div>
                                        </div>
                                        ` : ''}

                                        ${listing.other_trades_needed ? `
                                        <div class="col-md-6">
                                            <div class="form-floating">
                                                <div class="form-control bg-light border fw-semibold" style="padding-top: 1.625rem;">
                                                    ${listing.other_trades_needed}
                                                </div>
                                                <label class="text-muted fw-medium">
                                                    <i class="fas fa-tools me-2 text-primary"></i>Other Trades Needed
                                                </label>
                                            </div>
                                        </div>
                                        ` : ''}

                                        ${listing.trades_contact_method ? `
                                        <div class="col-md-7">
                                            <div class="form-floating">
                                                <div class="form-control bg-light border fw-semibold" style="padding-top: 1.625rem;">
                                                    ${listing.trades_contact_method}
                                                </div>
                                                <label class="text-muted fw-medium">
                                                    <i class="fas fa-comments me-2 text-info"></i>Contact Method
                                                </label>
                                            </div>
                                        </div>
                                        ` : ''}

                                        ${listing.vacant_access_instructions ? `
                                        <div class="col-12">
                                            <div class="form-floating">
                                                <div class="form-control bg-light border fw-semibold" style="padding-top: 1.625rem;">
                                                    ${listing.vacant_access_instructions}
                                                </div>
                                                <label class="text-muted fw-medium">
                                                    <i class="fas fa-key me-2 text-warning"></i>Vacant Access Instructions
                                                </label>
                                            </div>
                                        </div>
                                        ` : ''}

                                        ${listing.painting_notes ? `
                                        <div class="col-md-6">
                                            <div class="form-floating">
                                                <div class="form-control bg-light border fw-semibold" style="padding-top: 1.625rem;">
                                                    ${listing.painting_notes}
                                                </div>
                                                <label class="text-muted fw-medium">
                                                    <i class="fas fa-paint-roller me-2 text-success"></i>Painting Notes
                                                </label>
                                            </div>
                                        </div>
                                        ` : ''}

                                        ${listing.gardening_notes ? `
                                        <div class="col-md-6">
                                            <div class="form-floating">
                                                <div class="form-control bg-light border fw-semibold" style="padding-top: 1.625rem;">
                                                    ${listing.gardening_notes}
                                                </div>
                                                <label class="text-muted fw-medium">
                                                    <i class="fas fa-leaf me-2 text-success"></i>Gardening Notes
                                                </label>
                                            </div>
                                        </div>
                                        ` : ''}
                                    </div>
                                </div>
                            </div>
                        </div>
                        ` : ''}

                        <!-- Agent Controls -->
                        <div class="col-lg-6">
                            <div class="card border-0 h-100 shadow-sm" style="background: linear-gradient(135deg, #ffffff 0%, #f8fafc 100%);">
                                <div class="card-header bg-light border-bottom">
                                    <div class="d-flex align-items-center">
                                        <div class="me-3 p-2 bg-primary bg-opacity-10 rounded text-primary">
                                            <i class="fas fa-user-cog"></i>
                                        </div>
                                        <div>
                                            <h5 class="mb-1 fw-bold">Agent Controls</h5>
                                            <small class="text-muted">Listing status & privacy</small>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body p-4">
                                    <div class="row g-3">
                                        ${listing.listing_status ? `
                                        <div class="col-md-6">
                                            <div class="form-floating">
                                                <div class="form-control bg-light border fw-semibold" style="padding-top: 1.625rem;">
                                                    ${listing.listing_status}
                                                </div>
                                                <label class="text-muted fw-medium">
                                                    <i class="fas fa-tag me-2 text-primary"></i>Listing Status
                                                </label>
                                            </div>
                                        </div>
                                        ` : ''}

                                        ${listing.open_home_attendance ? `
                                        <div class="col-md-7">
                                            <div class="form-floating">
                                                <div class="form-control bg-light border fw-semibold" style="padding-top: 1.625rem;">
                                                    ${listing.open_home_attendance}
                                                </div>
                                                <label class="text-muted fw-medium">
                                                    <i class="fas fa-users me-2 text-info"></i>Open Home Attendance
                                                </label>
                                            </div>
                                        </div>
                                        ` : ''}

                                        <div class="col-12">
                                            <div class="form-floating">
                                                <div class="form-control bg-light border fw-semibold" style="padding-top: 1.625rem;">
                                                    ${listing.privacy_consent ? 'Yes' : 'No'}
                                                </div>
                                                <label class="text-muted fw-medium">
                                                    <i class="fas fa-check-circle me-2 text-success"></i>Privacy Consent
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Tasks - Only show if there are tasks -->
                        ${listing.assign_task || listing.assign_additional_task ? `
                        <div class="col-12">
                            <div class="card border-0 shadow-sm" style="background: linear-gradient(135deg, #ffffff 0%, #f8fafc 100%);">
                                <div class="card-header bg-light border-bottom">
                                    <div class="d-flex align-items-center">
                                        <div class="me-3 p-2 bg-warning bg-opacity-10 rounded text-warning">
                                            <i class="fas fa-tasks"></i>
                                        </div>
                                        <div>
                                            <h5 class="mb-1 fw-bold">Tasks</h5>
                                            <small class="text-muted">Primary & additional tasks</small>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body p-4">
                                    <div class="row g-3">
                                        ${listing.assign_task ? `
                                        <div class="col-lg-6">
                                            <div class="card border-0 h-100 shadow-sm" style="background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);">
                                                <div class="card-header bg-light border-bottom">
                                                    <div class="d-flex align-items-center">
                                                        <div class="me-3 p-2 bg-primary bg-opacity-10 rounded text-primary">
                                                            <i class="fas fa-tasks"></i>
                                                        </div>
                                                        <div>
                                                            <h6 class="mb-0 fw-bold">Primary Task</h6>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="card-body p-4">
                                                    <div class="row g-3">
                                                        ${listing.task_template ? `
                                                        <div class="col-12">
                                                            <div class="form-floating">
                                                                <div class="form-control bg-white border fw-semibold" style="padding-top: 1.625rem;">
                                                                    ${listing.task_template}
                                                                </div>
                                                                <label class="text-muted fw-medium">
                                                                    <i class="fas fa-clipboard-list me-2 text-primary"></i>Template
                                                                </label>
                                                            </div>
                                                        </div>
                                                        ` : ''}

                                                        ${listing.task_message ? `
                                                        <div class="col-12">
                                                            <div class="form-floating">
                                                                <div class="form-control bg-white border fw-semibold" style="padding-top: 1.625rem;">
                                                                    ${listing.task_message}
                                                                </div>
                                                                <label class="text-muted fw-medium">
                                                                    <i class="fas fa-comment me-2 text-info"></i>Message
                                                                </label>
                                                            </div>
                                                        </div>
                                                        ` : ''}

                                                        ${listing.task_recipient ? `
                                                        <div class="col-md-6">
                                                            <div class="form-floating">
                                                                <div class="form-control bg-white border fw-semibold" style="padding-top: 1.625rem;">
                                                                    ${listing.task_recipient}
                                                                </div>
                                                                <label class="text-muted fw-medium">
                                                                    <i class="fas fa-user me-2 text-success"></i>Recipient
                                                                </label>
                                                            </div>
                                                        </div>
                                                        ` : ''}

                                                        ${listing.task_method ? `
                                                        <div class="col-md-6">
                                                            <div class="form-floating">
                                                                <div class="form-control bg-white border fw-semibold" style="padding-top: 1.625rem;">
                                                                    ${listing.task_method}
                                                                </div>
                                                                <label class="text-muted fw-medium">
                                                                    <i class="fas fa-paper-plane me-2 text-warning"></i>Method
                                                                </label>
                                                            </div>
                                                        </div>
                                                        ` : ''}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        ` : ''}

                                        ${listing.assign_additional_task ? `
                                        <div class="col-lg-6">
                                            <div class="card border-0 h-100 shadow-sm" style="background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);">
                                                <div class="card-header bg-light border-bottom">
                                                    <div class="d-flex align-items-center">
                                                        <div class="me-3 p-2 bg-primary bg-opacity-10 rounded text-primary">
                                                            <i class="fas fa-tasks"></i>
                                                        </div>
                                                        <div>
                                                            <h6 class="mb-0 fw-bold">Additional Task</h6>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="card-body p-4">
                                                    <div class="row g-3">
                                                        ${listing.additional_task_template ? `
                                                        <div class="col-12">
                                                            <div class="form-floating">
                                                                <div class="form-control bg-white border fw-semibold" style="padding-top: 1.625rem;">
                                                                    ${listing.additional_task_template}
                                                                </div>
                                                                <label class="text-muted fw-medium">
                                                                    <i class="fas fa-clipboard-list me-2 text-primary"></i>Template
                                                                </label>
                                                            </div>
                                                        </div>
                                                        ` : ''}

                                                        ${listing.additional_task_message ? `
                                                        <div class="col-12">
                                                            <div class="form-floating">
                                                                <div class="form-control bg-white border fw-semibold" style="padding-top: 1.625rem;">
                                                                    ${listing.additional_task_message}
                                                                </div>
                                                                <label class="text-muted fw-medium">
                                                                    <i class="fas fa-comment me-2 text-info"></i>Message
                                                                </label>
                                                            </div>
                                                        </div>
                                                        ` : ''}

                                                        ${listing.additional_task_recipient ? `
                                                        <div class="col-md-6">
                                                            <div class="form-floating">
                                                                <div class="form-control bg-white border fw-semibold" style="padding-top: 1.625rem;">
                                                                    ${listing.additional_task_recipient}
                                                                </div>
                                                                <label class="text-muted fw-medium">
                                                                    <i class="fas fa-user me-2 text-success"></i>Recipient
                                                                </label>
                                                            </div>
                                                        </div>
                                                        ` : ''}

                                                        ${listing.additional_task_method ? `
                                                        <div class="col-md-6">
                                                            <div class="form-floating">
                                                                <div class="form-control bg-white border fw-semibold" style="padding-top: 1.625rem;">
                                                                    ${listing.additional_task_method}
                                                                </div>
                                                                <label class="text-muted fw-medium">
                                                                    <i class="fas fa-paper-plane me-2 text-warning"></i>Method
                                                                </label>
                                                            </div>
                                                        </div>
                                                        ` : ''}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        ` : ''}
                                    </div>
                                </div>
                            </div>
                        </div>
                        ` : ''}

                        <!-- Additional Notes - Only show if there are notes -->
                        ${listing.additional_notes && listing.additional_notes.trim() !== '' ? `
                        <div class="col-12">
                            <div class="card border-0 shadow-sm" style="background: linear-gradient(135deg, #ffffff 0%, #f8fafc 100%);">
                                <div class="card-header bg-light border-bottom">
                                    <div class="d-flex align-items-center">
                                        <div class="me-3 p-2 bg-info bg-opacity-10 rounded text-info">
                                            <i class="fas fa-sticky-note"></i>
                                        </div>
                                        <div>
                                            <h5 class="mb-1 fw-bold">Additional Notes</h5>
                                            <small class="text-muted">Extra information & comments</small>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body p-4">
                                    <div class="form-floating">
                                        <div class="form-control bg-light border fw-semibold" style="padding-top: 1.625rem; min-height: 100px;">
                                            ${listing.additional_notes}
                                        </div>
                                        <label class="text-muted fw-medium">
                                            <i class="fas fa-comment-dots me-2 text-primary"></i>Notes
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        ` : ''}
                    </div>
                </div>
            </div>

            <!-- Footer -->
            <div class="modal-footer border-0 bg-light">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                    <i class="fas fa-times me-2"></i>Close
                </button>
                
            </div>
        </div>
    </div>
</div>
`;

                    // Append modal to body and show it
                    $('body').append(modalContent);
                    const modal = new bootstrap.Modal(document.getElementById('listingDetailsModal'));
                    modal.show();
                    
                    // Remove modal from DOM after it's hidden
                    $('#listingDetailsModal').on('hidden.bs.modal', function () {
                        $(this).remove();
                    });
                }
            },
            error: function(xhr) {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Failed to load listing details',
                    timer: 2000,
                    showConfirmButton: false
                });
            }
        });
    });

    // Delete listing
    $(document).on('click', '.delete-btn', function() {
        const listingId = $(this).data('id');
        
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#000',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'Cancel',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "{{ route('agent.just-listed.destroy', '') }}/" + listingId,
                    type: 'DELETE',
                    data: {
                        _token: "{{ csrf_token() }}"
                    },
                    success: function(response) {
                        if (response.success) {
                            table.ajax.reload(null, false);
                            Swal.fire({
                                icon: 'success',
                                title: 'Deleted!',
                                text: response.message,
                                timer: 2000,
                                showConfirmButton: false
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error!',
                                text: response.message || 'Something went wrong',
                                timer: 2000,
                                showConfirmButton: false
                            });
                        }
                    },
                    error: function(xhr) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error!',
                            text: xhr.responseJSON?.message || 'Something went wrong',
                            timer: 2000,
                            showConfirmButton: false
                        });
                    }
                });
            }
        });
    });
});
</script>
@endsection