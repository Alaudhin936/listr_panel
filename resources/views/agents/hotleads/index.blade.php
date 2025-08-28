@extends('layout.master')

@section('main_content')
<link href="https://cdn.datatables.net/1.13.8/css/dataTables.bootstrap5.min.css" rel="stylesheet">
<link href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.bootstrap5.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<style>
    /* Wrapper for action buttons */
    .action-buttons {
        display: flex;
        gap: 8px;
        justify-content: center;
        align-items: center;
    }
	.dataTables_length select {
    -webkit-appearance: auto !important;
    -moz-appearance: auto !important;
    appearance: auto !important;
    background-image: none !important; 
}


    /* Common button styles */
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
        cursor: pointer;
    }

  

    .action-btn.btn-view:hover {
        background-color: #0056b3;
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
    .badge-hot {
        background-color: #dc3545;
        color: white;
    }
    .badge-warm {
        background-color: #fd7e14;
        color: white;
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
    .action-btn.btn-book {
    background-color: #28a745;
}

.action-btn.btn-book:hover {
    background-color: #218838;
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
                                    <i class="fas fa-fire me-2"></i>Hot Leads Management
                                </h4>
                                <a href="{{ route('agent.hotleads.create') }}" class="btn btn-primary">
                                    <i class="fas fa-plus me-1"></i> Add New Hot Lead
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
                                    <table id="hotleads-table" class="table table-hover" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>Vendor</th>
                                                <th>Contact</th>
                                                <th>Category</th>
                                                <th>Created</th>
                                                <th>Booking Conversion</th>
                                                <th class="text-end">Actions</th>
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
    const table = $('#hotleads-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: "{{ route('agent.hotleads.index') }}",
            data: function(d) {
                d.start_date = selectedFromDate ? selectedFromDate.format('YYYY-MM-DD') : '';
                d.end_date = selectedToDate ? selectedToDate.format('YYYY-MM-DD') : '';
            }
        },
        columns: [
            { 
                data: 'vendor_name', 
                name: 'vendor_name',
                render: function(data, type, row) {
                    return `<div class="vendor-name">${row.vendor_first_name} ${row.vendor_last_name}</div>
                            <div class="vendor-contact">${row.vendor_address || 'No address'}</div>`;
                }
            },
            { 
                data: 'vendor_contact', 
                name: 'vendor_contact',
                render: function(data, type, row) {
                    return `<div>${row.vendor_mobile || 'No phone'}</div>
                            <div>${row.vendor_email || 'No email'}</div>`;
                }
            },
            { 
                data: 'category', 
                name: 'category',
                render: function(data) {
                    const badgeClass = data === 'hot' ? 'badge-hot' : 'badge-warm';
                    return `<span class="badge ${badgeClass}">${data.charAt(0).toUpperCase() + data.slice(1)}</span>`;
                }
            },
           { 
                data: 'created_at', 
                name: 'created_at',
                render: function(data) {
                    return new Date(data).toLocaleDateString('en-US', {
                        year: 'numeric',
                        month: 'short',
                        day: 'numeric',
                        hour: '2-digit',
                        minute: '2-digit'
                    });
                }
            },
       { 
    data: 'converted_to_booking_appraisal', 
    name: 'converted_to_booking_appraisal',
    render: function(data) {
        return data ? 
            '<span class="badge bg-success"><i class="fas fa-check"></i> Converted</span>' : 
            '<span class="badge bg-secondary">Not Converted</span>';
    }
},
    
            { 
                data: 'action', 
                name: 'action', 
                orderable: false, 
                
            }
        ],
        order: [[4, 'desc']],
        pageLength: 10,
        responsive: true,
        language: {
            emptyTable: 'No hot leads found',
            info: 'Showing _START_ to _END_ of _TOTAL_ hot leads',
            infoEmpty: 'Showing 0 to 0 of 0 hot leads',
            infoFiltered: '(filtered from _MAX_ total hot leads)',
            lengthMenu: 'Show _MENU_ hot leads',
            search: '_INPUT_',
            searchPlaceholder: 'Search hot leads...',
            zeroRecords: 'No matching hot leads found'
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

    // View hot lead details
    $(document).on('click', '.view-btn', function() {
        const hotleadId = $(this).data('id');
        
        $.ajax({
            url: "{{ route('agent.hotleads.show', '') }}/" + hotleadId,
            type: 'GET',
            success: function(response) {
                if (response.success) {
                    const hotlead = response.data;
                    
                    // Format selected tradespeople
                    let tradespeople = 'None selected';
                    if (hotlead.selected_tradespeople && hotlead.selected_tradespeople.length > 0) {
                        tradespeople = hotlead.selected_tradespeople.map(t => `<li>${t}</li>`).join('');
                        tradespeople = `<ul class="mb-0">${tradespeople}</ul>`;
                    }

                    // Format contact option
                    let contactOption = 'Not specified';
                    if (hotlead.tradesperson_contact_option) {
                        const options = {
                            'contact_vendor': 'Tradesperson to Contact Vendor',
                            'contact_agent': 'Tradesperson to Contact Agent',
                            'vendor_contact': 'Vendor to Contact Tradesperson'
                        };
                        contactOption = options[hotlead.tradesperson_contact_option] || hotlead.tradesperson_contact_option;
                    }

                    // Create modal content
                    const modalContent = `
<!-- View Hot Lead Modal -->
<div class="modal fade" id="hotleadDetailsModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content" style="border: none; border-radius: 16px; box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 8px 10px -6px rgba(0, 0, 0, 0.1);">
            <!-- Header -->
            <div class="modal-header border-0 py-4 px-4" style="background: #fff;">
                <div class="d-flex align-items-center">
                    <div class="me-3 p-3 rounded-circle" style="background: #fef2f2; color: #dc2626;">
                        <i class="fas fa-fire fa-lg"></i>
                    </div>
                    <div>
                        <h3 class="modal-title mb-1 fw-bold" style="color: #1e293b; font-size: 1.5rem;">Hot Lead Details</h3>
                        <p class="mb-0" style="color: #64748b; font-size: 0.875rem;">Comprehensive lead information overview</p>
                    </div>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="font-size: 0.875rem;"></button>
            </div>

            <div class="modal-body p-0">
                <div class="container-fluid px-4 pb-4">
                    <div class="row g-4">
                        <!-- Vendor Information -->
                        <div class="col-lg-6">
                            <div class="card h-100" style="border: 1px solid #e2e8f0; border-radius: 12px; box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1);">
                                <div class="card-header border-0 py-3 px-4" style="background: #f8fafc; border-radius: 12px 12px 0 0;">
                                    <div class="d-flex align-items-center">
                                        <div class="me-3 p-2 rounded" style="background: #eff6ff; color: #2563eb;">
                                            <i class="fas fa-user-tie"></i>
                                        </div>
                                        <div>
                                            <h5 class="mb-1 fw-semibold" style="color: #1e293b; font-size: 1.1rem;">Vendor Information</h5>
                                            <small style="color: #64748b;">Primary contact details</small>
                                        </div>
                                    </div>
                                </div>

                                <div class="card-body p-4">
                                    <div class="row g-3">
                                        <div class="col-12">
                                            <label class="form-label fw-medium mb-2" style="color: #374151; font-size: 0.875rem;">
                                                <i class="fas fa-user me-2" style="color: #6b7280;"></i>Full Name
                                            </label>
                                            <div class="form-control border" style="background: #f9fafb; border-color: #d1d5db; font-weight: 600; color: #1f2937;">
                                                ${hotlead.vendor_first_name || 'N/A'} ${hotlead.vendor_last_name || ''}
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-6">
                                            <label class="form-label fw-medium mb-2" style="color: #374151; font-size: 0.875rem;">
                                                <i class="fas fa-phone me-2" style="color: #059669;"></i>Mobile
                                            </label>
                                            <div class="form-control border" style="background: #f9fafb; border-color: #d1d5db; font-weight: 600; color: #1f2937;">
                                                ${hotlead.vendor_mobile ? `<a href="tel:${hotlead.vendor_mobile}" class="text-decoration-none" style="color: #2563eb; font-weight: 600;">${hotlead.vendor_mobile}</a>` : 'N/A'}
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <label class="form-label fw-medium mb-2" style="color: #374151; font-size: 0.875rem;">
                                                <i class="fas fa-envelope me-2" style="color: #0891b2;"></i>Email
                                            </label>
                                            <div class="form-control border" style="background: #f9fafb; border-color: #d1d5db; font-weight: 600; color: #1f2937;">
                                                ${hotlead.vendor_email ? `<a href="mailto:${hotlead.vendor_email}" class="text-decoration-none" style="color: #2563eb; font-weight: 600;">${hotlead.vendor_email}</a>` : 'N/A'}
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <label class="form-label fw-medium mb-2" style="color: #374151; font-size: 0.875rem;">
                                                <i class="fas fa-map-marker-alt me-2" style="color: #dc2626;"></i>Address
                                            </label>
                                            <div class="form-control border" style="background: #f9fafb; border-color: #d1d5db; font-weight: 600; color: #1f2937; min-height: 80px;">
                                                ${hotlead.vendor_address || 'N/A'}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Lead Details -->
                        <div class="col-lg-6">
                            <div class="card h-100" style="border: 1px solid #e2e8f0; border-radius: 12px; box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1);">
                                <div class="card-header border-0 py-3 px-4" style="background: #f8fafc; border-radius: 12px 12px 0 0;">
                                    <div class="d-flex align-items-center">
                                        <div class="me-3 p-2 rounded" style="background: #f0f9ff; color: #0ea5e9;">
                                            <i class="fas fa-info-circle"></i>
                                        </div>
                                        <div>
                                            <h5 class="mb-1 fw-semibold" style="color: #1e293b; font-size: 1.1rem;">Lead Details</h5>
                                            <small style="color: #64748b;">Lead classification & tracking</small>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body p-4">
                                    <div class="row g-3">
                                        <div class="col-md-6">
                                            <label class="form-label fw-medium mb-2" style="color: #374151; font-size: 0.875rem;">
                                                <i class="fas fa-tag me-2" style="color: #6b7280;"></i>Category
                                            </label>
                                            <div class="form-control border d-flex align-items-center" style="background: #f9fafb; border-color: #d1d5db;">
                                                <span class="badge fs-6 px-3 py-2 ${hotlead.category === 'hot' ? 'bg-danger' : 'bg-warning text-dark'}">
                                                    ${hotlead.category ? hotlead.category.charAt(0).toUpperCase() + hotlead.category.slice(1) : 'N/A'}
                                                </span>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <label class="form-label fw-medium mb-2" style="color: #374151; font-size: 0.875rem;">
                                                <i class="fas fa-user-tie me-2" style="color: #6b7280;"></i>Agent
                                            </label>
                                            <div class="form-control border" style="background: #f9fafb; border-color: #d1d5db; font-weight: 600; color: #1f2937;">
                                                ${hotlead.agent ? hotlead.agent.name : 'N/A'}
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <label class="form-label fw-medium mb-2" style="color: #374151; font-size: 0.875rem;">
                                                <i class="fas fa-source me-2" style="color: #6b7280;"></i>Lead Source
                                            </label>
                                            <div class="form-control border" style="background: #f9fafb; border-color: #d1d5db; font-weight: 600; color: #1f2937;">
                                                ${hotlead.lead_source || 'N/A'}
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <label class="form-label fw-medium mb-2" style="color: #374151; font-size: 0.875rem;">
                                                <i class="fas fa-calendar me-2" style="color: #6b7280;"></i>Created Date
                                            </label>
                                            <div class="form-control border" style="background: #f9fafb; border-color: #d1d5db; font-weight: 600; color: #1f2937;">
                                                ${hotlead.created_at ? new Date(hotlead.created_at).toLocaleString() : 'N/A'}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Tradespeople Section -->
                        <div class="col-lg-6">
                            <div class="card h-100" style="border: 1px solid #e2e8f0; border-radius: 12px; box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1);">
                                <div class="card-header border-0 py-3 px-4" style="background: #f8fafc; border-radius: 12px 12px 0 0;">
                                    <div class="d-flex align-items-center">
                                        <div class="me-3 p-2 rounded" style="background: #f0fdf4; color: #059669;">
                                            <i class="fas fa-users-cog"></i>
                                        </div>
                                        <div>
                                            <h5 class="mb-1 fw-semibold" style="color: #1e293b; font-size: 1.1rem;">Tradespeople</h5>
                                            <small style="color: #64748b;">Assigned professionals</small>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body p-4">
                                    <div class="row g-3">
                                        <div class="col-12">
                                            <label class="form-label fw-medium mb-2" style="color: #374151; font-size: 0.875rem;">
                                                <i class="fas fa-users me-2" style="color: #6b7280;"></i>Selected Tradespeople
                                            </label>
                                            <div class="form-control border" style="background: #f9fafb; border-color: #d1d5db; min-height: 100px; color: #1f2937;">
                                                ${tradespeople}
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <label class="form-label fw-medium mb-2" style="color: #374151; font-size: 0.875rem;">
                                                <i class="fas fa-phone-alt me-2" style="color: #6b7280;"></i>Contact Option
                                            </label>
                                            <div class="form-control border" style="background: #f9fafb; border-color: #d1d5db; font-weight: 600; color: #1f2937;">
                                                ${contactOption}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Communication Section -->
                        <div class="col-lg-6">
                            <div class="card h-100" style="border: 1px solid #e2e8f0; border-radius: 12px; box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1);">
                                <div class="card-header border-0 py-3 px-4" style="background: #f8fafc; border-radius: 12px 12px 0 0;">
                                    <div class="d-flex align-items-center">
                                        <div class="me-3 p-2 rounded" style="background: #fefbeb; color: #d97706;">
                                            <i class="fas fa-comments"></i>
                                        </div>
                                        <div>
                                            <h5 class="mb-1 fw-semibold" style="color: #1e293b; font-size: 1.1rem;">Communication</h5>
                                            <small style="color: #64748b;">Templates & messaging</small>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body p-4">
                                    <div class="row g-3">
                                        <div class="col-12">
                                            <label class="form-label fw-medium mb-2" style="color: #374151; font-size: 0.875rem;">
                                                <i class="fas fa-sms me-2" style="color: #6b7280;"></i>SMS Template
                                            </label>
                                            <div class="form-control border" style="background: #f9fafb; border-color: #d1d5db; min-height: 100px; color: #1f2937;">
                                                ${hotlead.followup_sms_template ? `<pre class="mb-0" style="color: #1f2937; font-size: 0.875rem; line-height: 1.4; white-space: pre-wrap;">${hotlead.followup_sms_template}</pre>` : '<span style="color: #9ca3af;">No SMS template</span>'}
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <label class="form-label fw-medium mb-2" style="color: #374151; font-size: 0.875rem;">
                                                <i class="fas fa-envelope me-2" style="color: #6b7280;"></i>Email Template
                                            </label>
                                            <div class="form-control border" style="background: #f9fafb; border-color: #d1d5db; min-height: 100px; color: #1f2937;">
                                                ${hotlead.followup_email_template ? `<pre class="mb-0" style="color: #1f2937; font-size: 0.875rem; line-height: 1.4; white-space: pre-wrap;">${hotlead.followup_email_template}</pre>` : '<span style="color: #9ca3af;">No email template</span>'}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Quick Notes Section -->
                        <div class="col-12">
                            <div class="card" style="border: 1px solid #e2e8f0; border-radius: 12px; box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1);">
                                <div class="card-header border-0 py-3 px-4" style="background: #f8fafc; border-radius: 12px 12px 0 0;">
                                    <div class="d-flex align-items-center">
                                        <div class="me-3 p-2 rounded" style="background: #fef3c7; color: #d97706;">
                                            <i class="fas fa-sticky-note"></i>
                                        </div>
                                        <div>
                                            <h5 class="mb-1 fw-semibold" style="color: #1e293b; font-size: 1.1rem;">Quick Notes</h5>
                                            <small style="color: #64748b;">Additional information & remarks</small>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body p-4">
                                    <label class="form-label fw-medium mb-2" style="color: #374151; font-size: 0.875rem;">
                                        <i class="fas fa-note-sticky me-2" style="color: #6b7280;"></i>Notes & Comments
                                    </label>
                                    <div class="form-control border" style="background: #f9fafb; border-color: #d1d5db; min-height: 120px; color: #1f2937;">
                                        ${hotlead.quick_notes ? hotlead.quick_notes : '<span style="color: #9ca3af;">No notes available</span>'}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Footer -->
            <div class="modal-footer border-0 px-4 py-4" style="background: #f8fafc; border-radius: 0 0 16px 16px;">
                <div class="d-flex justify-content-between w-100 align-items-center">
                    <div class="small" style="color: #64748b;">
                        <i class="fas fa-info-circle me-1"></i>
                        Lead information last updated: <strong style="color: #1e293b;">${new Date().toLocaleDateString()}</strong>
                    </div>
                    <button type="button" class="btn px-4 py-2" data-bs-dismiss="modal" style="background: #1e293b; color: white; border: none; border-radius: 8px; font-weight: 500;">
                        <i class="fas fa-times me-2"></i>Close
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
`;

                    // Append modal to body and show it
                    $('body').append(modalContent);
                    const modal = new bootstrap.Modal(document.getElementById('hotleadDetailsModal'));
                    modal.show();
                    
                    // Remove modal from DOM after it's hidden
                    $('#hotleadDetailsModal').on('hidden.bs.modal', function () {
                        $(this).remove();
                    });
                }
            },
            error: function(xhr) {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Failed to load hot lead details',
                    timer: 2000,
                    showConfirmButton: false
                });
            }
        });
    });

    // Delete hot lead
    $(document).on('click', '.delete-btn', function() {
        const hotleadId = $(this).data('id');
        
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
                    url: "{{ route('agent.hotleads.destroy', '') }}/" + hotleadId,
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