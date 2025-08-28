

<?php $__env->startSection('main_content'); ?>
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
    .action-btn.btn-conduct {
    background-color: #28a745;
    color: white;
}

.action-btn.btn-conduct:hover {
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
                                    <i class="fas fa-calendar-check me-2"></i>Booking Appraisals
                                </h4>
                                <a href="<?php echo e(route('agent.booking-appraisals.create')); ?>" class="btn btn-primary">
                                    <i class="fas fa-plus me-1"></i> New Booking Appraisal
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
                                    <table id="appraisals-table" class="table table-hover" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>Property Address</th>
                                                <th>Vendor</th>
                                                <th>Contact Info</th>
                                                <th>Appointment</th>
                                                <th>Appraisal Conversion</th>
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
    const table = $('#appraisals-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: "<?php echo e(route('agent.booking-appraisals.index')); ?>",
            data: function(d) {
                d.start_date = selectedFromDate ? selectedFromDate.format('YYYY-MM-DD') : '';
                d.end_date = selectedToDate ? selectedToDate.format('YYYY-MM-DD') : '';
            }
        },
        columns: [
            { 
                data: 'address', 
                name: 'address',
                render: function(data) {
                    return data || 'N/A';
                }
            },
            { 
                data: 'vendor_name', 
                name: 'vendor_name',
                render: function(data) {
                    return data || 'N/A';
                }
            },
            { 
                data: 'contact_info', 
                name: 'contact_info',
                render: function(data) {
                    return data || 'N/A';
                }
            },
            { 
                data: 'appointment', 
                name: 'appointment',
                render: function(data) {
                    return data ? new Date(data).toLocaleString() : 'N/A';
                }
            },
   { 
    data: 'converted_to_conduct_appraisal', 
    name: 'converted_to_conduct_appraisal',
    render: function(data) {
        return data ? 
            '<span class="badge bg-success"><i class="fas fa-check"></i> Converted</span>' : 
            '<span class="badge bg-secondary">Not Converted</span>';
    }
},
            
            { 
                data: 'actions', 
                name: 'actions', 
                orderable: false, 
               
            }
        ],
        order: [[3, 'desc']],
        pageLength: 10,
        responsive: true,
        language: {
            emptyTable: 'No booking appraisals found',
            info: 'Showing _START_ to _END_ of _TOTAL_ appraisals',
            infoEmpty: 'Showing 0 to 0 of 0 appraisals',
            infoFiltered: '(filtered from _MAX_ total appraisals)',
            lengthMenu: 'Show _MENU_ appraisals',
            search: '_INPUT_',
            searchPlaceholder: 'Search appraisals...',
            zeroRecords: 'No matching appraisals found'
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

    // View booking appraisal details
    $(document).on('click', '.view-btn', function() {
        const appraisalId = $(this).data('id');
        
        $.ajax({
            url: "<?php echo e(route('agent.booking-appraisals.show', '')); ?>/" + appraisalId,
            type: 'GET',
            success: function(response) {
                if (response.success) {
                    const appraisal = response.data;
                    
                    // Format appointment date
                    let appointmentDate = 'N/A';
                    if (appraisal.appointment) {
                        const date = new Date(appraisal.appointment);
                        appointmentDate = date.toLocaleDateString('en-US', {
                            weekday: 'long',
                            year: 'numeric',
                            month: 'long',
                            day: 'numeric',
                            hour: '2-digit',
                            minute: '2-digit'
                        });
                    }
                    
                    // Format status with badge
                    let statusBadge = '';
                    if (appraisal.status) {
                        let badgeClass = 'badge-secondary';
                        if (appraisal.status === 'completed') badgeClass = 'badge-success';
                        if (appraisal.status === 'pending') badgeClass = 'badge-warning';
                        if (appraisal.status === 'cancelled') badgeClass = 'badge-danger';
                        
                        statusBadge = `<span class="badge ${badgeClass}">
                            ${appraisal.status.charAt(0).toUpperCase() + appraisal.status.slice(1)}
                        </span>`;
                    }
                    
                    // Create modal content
                    const modalContent = `
<!-- View Booking Appraisal Modal -->
<div class="modal fade" id="appraisalDetailsModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg">
            <!-- Header -->
            <div class="modal-header border-0 bg-gradient text-dark position-relative overflow-hidden" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); min-height: 80px;">
                <div class="d-flex align-items-center position-relative">
                    <div class="me-4 p-3 bg-white bg-opacity-20 rounded-circle">
                        <i class="fas fa-calendar-check fa-2x text-dark"></i>
                    </div>
                    <div>
                        <h3 class="modal-title mb-1 fw-bold">Booking Appraisal Details</h3>
                        <p class="mb-0 opacity-90">Comprehensive booking overview</p>
                    </div>
                </div>
                <button type="button" class="btn-close btn-close-white position-relative" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body p-0">
                <div class="container-fluid p-4">
                    <div class="row g-4">
                        <!-- Property Information -->
                        <div class="col-lg-6">
                            <div class="card border-0 h-100 position-relative overflow-hidden" style="background: linear-gradient(135deg, #f8faff 0%, #f1f5ff 100%); box-shadow: 0 8px 32px rgba(79, 70, 229, 0.15);">
                               
                                <div class="card-header border-0 bg-gradient text-dark position-relative" style="background: linear-gradient(135deg, #4f46e5 0%, #7c3aed 100%);">
                                    <div class="d-flex align-items-center">
                                        <div class="me-3 p-2 bg-white bg-opacity-20 rounded">
                                            <i class="fas fa-info-circle"></i>
                                        </div>
                                        <div>
                                            <h5 class="mb-1 fw-bold text-dark">Property Information</h5>
                                            <small class="opacity-90 text-dark">Basic property details</small>
                                        </div>
                                    </div>
                                </div>

                                <div class="card-body p-4 position-relative text-dark">
                                    <div class="row g-3">
                                        <div class="col-12">
                                            <div class="form-floating">
                                                <div class="form-control bg-white border-2 text-dark fw-semibold" style="padding-top: 1.625rem; border-color: #e0e7ff !important;">
                                                    ${appraisal.address || 'N/A'}
                                                </div>
                                                <label class="text-muted fw-medium">
                                                    <i class="fas fa-map-marker-alt me-2 text-danger"></i>Address
                                                </label>
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-6">
                                            <div class="form-floating">
                                                <div class="form-control bg-white border-2 text-dark fw-semibold" style="padding-top: 1.625rem; border-color: #e0e7ff !important;">
                                                    ${appraisal.property_type || 'N/A'}
                                                </div>
                                                <label class="text-muted fw-medium">
                                                    <i class="fas fa-home me-2 text-primary"></i>Property Type
                                                </label>
                                            </div>
                                        </div>

                                        <div class="col-md-8">
                                            <div class="form-floating">
                                                <div class="form-control bg-white border-2 text-dark fw-semibold" style="padding-top: 1.625rem; border-color: #e0e7ff !important;">
                                                    ${appraisal.condition || 'N/A'}
                                                </div>
                                                <label class="text-muted fw-medium">
                                                    <i class="fas fa-hammer me-2 text-warning"></i>Condition
                                                </label>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-floating">
                                                <div class="form-control bg-white border-2 text-dark fw-semibold" style="padding-top: 1.625rem; border-color: #e0e7ff !important;">
                                                    ${appraisal.bedrooms || 'N/A'}
                                                </div>
                                                <label class="text-muted fw-medium">
                                                    <i class="fas fa-bed me-2 text-info"></i>Bedrooms
                                                </label>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-floating">
                                                <div class="form-control bg-white border-2 text-dark fw-semibold" style="padding-top: 1.625rem; border-color: #e0e7ff !important;">
                                                    ${appraisal.bathrooms || 'N/A'}
                                                </div>
                                                <label class="text-muted fw-medium">
                                                    <i class="fas fa-bath me-2 text-success"></i>Bathrooms
                                                </label>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-floating">
                                                <div class="form-control bg-white border-2 text-dark fw-semibold" style="padding-top: 1.625rem; border-color: #e0e7ff !important;">
                                                    ${appraisal.land_size || 'N/A'}
                                                </div>
                                                <label class="text-muted fw-medium">
                                                    <i class="fas fa-ruler-combined me-2 text-secondary"></i>Land Size
                                                </label>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="form-floating">
                                                <div class="form-control bg-white border-2 text-dark fw-semibold" style="padding-top: 1.625rem; border-color: #e0e7ff !important;">
                                                    ${appraisal.under_cover_parking || 'N/A'}
                                                </div>
                                                <label class="text-muted fw-medium">
                                                    <i class="fas fa-car me-2 text-dark"></i>Parking
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Vendor Information -->
                        <div class="col-lg-6">
                            <div class="card border-0 h-100 shadow-sm text-dark" style="background: linear-gradient(135deg, #ffffff 0%, #f8fafc 100%);">
                                <div class="card-header bg-light border-bottom">
                                    <div class="d-flex align-items-center">
                                        <div class="me-3 p-2 bg-white bg-opacity-10 rounded text-primary">
                                            <i class="fas fa-user-tie"></i>
                                        </div>
                                        <div>
                                            <h5 class="mb-1 fw-bold text-dark">Vendor Information</h5>
                                            <small class="text-muted">Primary & secondary contacts</small>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body p-4 text-dark">
                                    <div class="row g-3">
                                        <div class="col-md-6">
                                            <div class="form-floating">
                                                <div class="form-control bg-light border text-dark fw-semibold" style="padding-top: 1.625rem;">
                                                    ${appraisal.vendor1_first_name || 'N/A'} ${appraisal.vendor1_last_name || ''}
                                                </div>
                                                <label class="text-muted fw-medium">
                                                    <i class="fas fa-user me-2 text-primary"></i>Primary Vendor
                                                </label>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-floating">
                                                <div class="form-control bg-light border text-dark fw-semibold" style="padding-top: 1.625rem;">
                                                    ${appraisal.vendor1_mobile ? `<a href="tel:${appraisal.vendor1_mobile}" class="text-primary text-decoration-none fw-bold">${appraisal.vendor1_mobile}</a>` : 'N/A'}
                                                </div>
                                                <label class="text-muted fw-medium">
                                                    <i class="fas fa-phone me-2 text-success"></i>Mobile
                                                </label>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="form-floating">
                                                <div class="form-control bg-light border text-dark fw-semibold" style="padding-top: 1.625rem;">
                                                    ${appraisal.vendor1_email ? `<a href="mailto:${appraisal.vendor1_email}" class="text-primary text-decoration-none fw-bold">${appraisal.vendor1_email}</a>` : 'N/A'}
                                                </div>
                                                <label class="text-muted fw-medium">
                                                    <i class="fas fa-envelope me-2 text-info"></i>Email
                                                </label>
                                            </div>
                                        </div>

                                        ${appraisal.vendor2_first_name ? `
                                        <div class="col-md-6">
                                            <div class="form-floating">
                                                <div class="form-control bg-light border text-dark fw-semibold" style="padding-top: 1.625rem;">
                                                    ${appraisal.vendor2_first_name || 'N/A'} ${appraisal.vendor2_last_name || ''}
                                                </div>
                                                <label class="text-muted fw-medium">
                                                    <i class="fas fa-user me-2 text-primary"></i>Secondary Vendor
                                                </label>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-floating">
                                                <div class="form-control bg-light border text-dark fw-semibold" style="padding-top: 1.625rem;">
                                                    ${appraisal.vendor2_mobile ? `<a href="tel:${appraisal.vendor2_mobile}" class="text-primary text-decoration-none fw-bold">${appraisal.vendor2_mobile}</a>` : 'N/A'}
                                                </div>
                                                <label class="text-muted fw-medium">
                                                    <i class="fas fa-phone me-2 text-success"></i>Mobile
                                                </label>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="form-floating">
                                                <div class="form-control bg-light border text-dark fw-semibold" style="padding-top: 1.625rem;">
                                                    ${appraisal.vendor2_email ? `<a href="mailto:${appraisal.vendor2_email}" class="text-primary text-decoration-none fw-bold">${appraisal.vendor2_email}</a>` : 'N/A'}
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

                        <!-- Appointment Details -->
                        <div class="col-lg-6">
                            <div class="card border-0 h-100 shadow-sm text-dark" style="background: linear-gradient(135deg, #ffffff 0%, #f8fafc 100%);">
                                <div class="card-header bg-light border-bottom">
                                    <div class="d-flex align-items-center">
                                        <div class="me-3 p-2 bg-white bg-opacity-10 rounded text-success">
                                            <i class="fas fa-calendar-alt"></i>
                                        </div>
                                        <div>
                                            <h5 class="mb-1 fw-bold text-dark">Appointment Details</h5>
                                            <small class="text-muted">Booking information</small>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body p-4 text-dark">
                                    <div class="row g-3">
                                        <div class="col-md-6">
                                            <div class="form-floating">
                                                <div class="form-control bg-light border text-dark fw-semibold" style="padding-top: 1.625rem;">
                                                    ${appraisal.appointment_date || 'Not scheduled'}
                                                </div>
                                                <label class="text-muted fw-medium">
                                                    <i class="fas fa-calendar-day me-2 text-primary"></i>Appointment Date
                                                </label>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-floating">
                                                <div class="form-control bg-light border text-dark fw-semibold" style="padding-top: 1.625rem;">
                                                    ${appraisal.appointment_time || 'Not specified'}
                                                </div>
                                                <label class="text-muted fw-medium">
                                                    <i class="fas fa-clock me-2 text-info"></i>Appointment Time
                                                </label>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="form-floating">
                                                <div class="form-control bg-light border text-dark" style="padding-top: 1.625rem;">
                                                    <div>
                                                        ${appraisal.send_confirmation_sms ? '<span class="badge bg-success me-2">SMS</span>' : ''}
                                                        ${appraisal.send_confirmation_email ? '<span class="badge bg-success">Email</span>' : ''}
                                                        ${!appraisal.send_confirmation_sms && !appraisal.send_confirmation_email ? 'No reminders' : ''}
                                                    </div>
                                                </div>
                                                <label class="text-muted fw-medium">
                                                    <i class="fas fa-bell me-2 text-warning"></i>Reminders
                                                </label>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-floating">
                                                <div class="form-control bg-light border text-dark" style="padding-top: 1.625rem;">
                                                    <span class="badge ${appraisal.category === 'urgent' ? 'bg-danger' : 'bg-warning text-dark'}">
                                                        ${appraisal.category ? appraisal.category.charAt(0).toUpperCase() + appraisal.category.slice(1) : 'N/A'}
                                                    </span>
                                                </div>
                                                <label class="text-muted fw-medium">
                                                    <i class="fas fa-tag me-2 text-danger"></i>Category
                                                </label>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-floating">
                                                <div class="form-control bg-light border text-dark fw-semibold" style="padding-top: 1.625rem;">
                                                    ${appraisal.agent ? appraisal.agent.name : 'N/A'}
                                                </div>
                                                <label class="text-muted fw-medium">
                                                    <i class="fas fa-user-tie me-2 text-secondary"></i>Agent
                                                </label>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="form-floating">
                                                <div class="form-control bg-light border text-dark fw-semibold" style="padding-top: 1.625rem;">
                                                    ${new Date(appraisal.created_at).toLocaleString()}
                                                </div>
                                                <label class="text-muted fw-medium">
                                                    <i class="fas fa-calendar-plus me-2 text-success"></i>Created
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Additional Information -->
                        <div class="col-lg-6">
                            <div class="card border-0 h-100 shadow-sm text-dark" style="background: linear-gradient(135deg, #ffffff 0%, #f8fafc 100%);">
                                <div class="card-header bg-light border-bottom">
                                    <div class="d-flex align-items-center">
                                        <div class="me-3 p-2 bg-white bg-opacity-10 rounded text-info">
                                            <i class="fas fa-info-circle"></i>
                                        </div>
                                        <div>
                                            <h5 class="mb-1 fw-bold text-dark">Additional Information</h5>
                                            <small class="text-muted">Lead & vendor details</small>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body p-4 text-dark">
                                    <div class="row g-3">
                                        <div class="col-md-6">
                                            <div class="form-floating">
                                                <div class="form-control bg-light border text-dark fw-semibold" style="padding-top: 1.625rem;">
                                                    ${appraisal.lead_source || 'N/A'}
                                                </div>
                                                <label class="text-muted fw-medium">
                                                    <i class="fas fa-source me-2 text-primary"></i>Lead Source
                                                </label>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-floating">
                                                <div class="form-control bg-light border text-dark fw-semibold" style="padding-top: 1.625rem;">
                                                    ${appraisal.is_vendor_selling ? 'Yes' : 'No'}
                                                </div>
                                                <label class="text-muted fw-medium">
                                                    <i class="fas fa-home me-2 text-success"></i>Selling Status
                                                </label>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="form-floating">
                                                <div class="form-control bg-light border text-dark fw-semibold" style="padding-top: 1.625rem;">
                                                    ${appraisal.lead_source_notes || 'N/A'}
                                                </div>
                                                <label class="text-muted fw-medium">
                                                    <i class="fas fa-sticky-note me-2 text-warning"></i>Lead Notes
                                                </label>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-floating">
                                                <div class="form-control bg-light border text-dark fw-semibold" style="padding-top: 1.625rem;">
                                                    ${appraisal.moving_to || 'N/A'}
                                                </div>
                                                <label class="text-muted fw-medium">
                                                    <i class="fas fa-map-marker-alt me-2 text-danger"></i>Moving To
                                                </label>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-floating">
                                                <div class="form-control bg-light border text-dark fw-semibold" style="padding-top: 1.625rem;">
                                                    ${appraisal.when_listing || 'N/A'}
                                                </div>
                                                <label class="text-muted fw-medium">
                                                    <i class="fas fa-calendar-check me-2 text-info"></i>When Listing
                                                </label>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="form-floating">
                                                <div class="form-control bg-light border text-dark fw-semibold" style="padding-top: 1.625rem;">
                                                    ${appraisal.comparable_sales || 'N/A'}
                                                </div>
                                                <label class="text-muted fw-medium">
                                                    <i class="fas fa-chart-line me-2 text-primary"></i>Comparable Sales
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Notes Section -->
                        <div class="col-12">
                            <div class="card border-0 shadow-sm text-dark" style="background: linear-gradient(135deg, #ffffff 0%, #f8fafc 100%);">
                                <div class="card-header bg-light border-bottom">
                                    <div class="d-flex align-items-center">
                                        <div class="me-3 p-2 bg-white bg-opacity-10 rounded text-warning">
                                            <i class="fas fa-sticky-note"></i>
                                        </div>
                                        <div>
                                            <h5 class="mb-1 fw-bold text-dark">Additional Notes</h5>
                                            <small class="text-muted">Extra comments & observations</small>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body p-4">
                                    <div class="form-floating">
                                        <div class="form-control bg-light border text-dark" style="padding-top: 1.625rem; min-height: 120px;">
                                            ${appraisal.additional_notes || '<span class="text-muted">No additional notes</span>'}
                                        </div>
                                        <label class="text-muted fw-medium">
                                            <i class="fas fa-notes me-2"></i>Notes & Comments
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Footer -->
            <div class="modal-footer border-0 bg-light p-4">
                <div class="d-flex justify-content-between w-100 align-items-center">
                    <div class="text-muted small">
                        <i class="fas fa-info-circle me-1"></i>
                        Booking created on: <strong class="text-dark">${new Date(appraisal.created_at).toLocaleDateString()}</strong>
                    </div>
                    <div>
                        <button type="button" class="btn btn-outline-secondary me-2" data-bs-dismiss="modal">
                            <i class="fas fa-times me-2"></i>Close
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
`;

                    // Append modal to body and show it
                    $('body').append(modalContent);
                    const modal = new bootstrap.Modal(document.getElementById('appraisalDetailsModal'));
                    modal.show();
                    
                    // Remove modal from DOM after it's hidden
                    $('#appraisalDetailsModal').on('hidden.bs.modal', function () {
                        $(this).remove();
                    });
                }
            },
            error: function(xhr) {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Failed to load booking appraisal details',
                    timer: 2000,
                    showConfirmButton: false
                });
            }
        });
    });

    // Delete booking appraisal
    $(document).on('click', '.delete-btn', function() {
        const appraisalId = $(this).data('id');
        
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
                    url: "<?php echo e(route('agent.booking-appraisals.destroy', '')); ?>/" + appraisalId,
                    type: 'DELETE',
                    data: {
                        _token: "<?php echo e(csrf_token()); ?>"
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
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\ADMIN\Desktop\listr\resources\views/agents/booking-appraisal/index.blade.php ENDPATH**/ ?>