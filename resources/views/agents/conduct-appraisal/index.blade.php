@extends('layout.master')

@section('main_content')
    <link href="https://cdn.datatables.net/1.13.8/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.bootstrap5.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .feature-tags {
            display: flex;
            flex-wrap: wrap;
            gap: 0.5rem;
        }

        .feature-tag {
            background: linear-gradient(135deg, #4f46e5 0%, #7c3aed 100%);
            color: white;
            padding: 0.25rem 0.75rem;
            border-radius: 1rem;
            font-size: 0.875rem;
            font-weight: 500;
        }

        .photo-gallery {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            gap: 1rem;
        }

        .photo-item {
            position: relative;
            overflow: hidden;
            border-radius: 0.5rem;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .photo-item img {
            width: 100%;
            height: 150px;
            object-fit: cover;
            transition: transform 0.3s ease;
        }

        .photo-item:hover img {
            transform: scale(1.05);
        }

        .photo-label {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            background: rgba(0, 0, 0, 0.7);
            color: white;
            padding: 0.25rem 0.5rem;
            font-size: 0.75rem;
            text-align: center;
        }

        .action-buttons {
            display: flex;
            gap: 8px;
            justify-content: flex-end;
        }

        .dataTables_length select {
            -webkit-appearance: auto !important;
            -moz-appearance: auto !important;
            appearance: auto !important;
            background-image: none !important;
        }

        .action-btn.btn-just-listed {
            background-color: #17a2b8;
            color: white;
        }

        .action-btn.btn-just-listed:hover {
            background-color: #138496;
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

        .d-flex>.flex-shrink-0 {
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

        .page-body1 {
            padding: 0px;
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
                                        <i class="fas fa-home me-2"></i>Conduct Appraisals
                                    </h4>
                                    <a href="{{ route('agent.appraisals.create') }}" class="btn btn-primary">
                                        <i class="fas fa-plus me-1"></i> New Appraisal
                                    </a>
                                </div>
                                <div class="card-body">
                                    <!-- Filters Section -->
                                    <div class="row mb-4">
                                        <div class="col-md-6">
                                            <label class="form-label">Filter by Date Range</label>
                                            <div class="position-relative">
                                                <input type="text" class="form-control" id="dateRange"
                                                    placeholder="Select date range">
                                                <i class="fas fa-calendar-alt position-absolute"
                                                    style="right: 10px; top: 50%; transform: translateY(-50%); color: #6c757d;"></i>
                                            </div>

                                            <!-- Dual Calendar -->
                                            <div class="dual-calendar-container mt-3" id="dualCalendarContainer"
                                                style="display: none;">
                                                <div class="dual-calendar-wrapper d-flex justify-content-between gap-3">
                                                    <!-- From -->
                                                    <div class="calendar-section w-50">
                                                        <div
                                                            class="calendar-header d-flex justify-content-between align-items-center mb-2">
                                                            <button class="btn btn-sm btn-outline-secondary prev-month"
                                                                data-calendar="from">
                                                                <i class="fas fa-chevron-left"></i>
                                                            </button>
                                                            <h6 class="current-month mb-0" id="fromCurrentMonth"></h6>
                                                            <button class="btn btn-sm btn-outline-secondary next-month"
                                                                data-calendar="from">
                                                                <i class="fas fa-chevron-right"></i>
                                                            </button>
                                                        </div>
                                                        <div class="calendar-body" id="fromCalendarBody"></div>
                                                    </div>

                                                    <!-- To -->
                                                    <div class="calendar-section w-50">
                                                        <div
                                                            class="calendar-header d-flex justify-content-between align-items-center mb-2">
                                                            <button class="btn btn-sm btn-outline-secondary prev-month"
                                                                data-calendar="to">
                                                                <i class="fas fa-chevron-left"></i>
                                                            </button>
                                                            <h6 class="current-month mb-0" id="toCurrentMonth"></h6>
                                                            <button class="btn btn-sm btn-outline-secondary next-month"
                                                                data-calendar="to">
                                                                <i class="fas fa-chevron-right"></i>
                                                            </button>
                                                        </div>
                                                        <div class="calendar-body" id="toCalendarBody"></div>
                                                    </div>
                                                </div>

                                                <div class="calendar-footer mt-3">
                                                    <div class="selected-dates mb-2">
                                                        <span class="me-3">From: <strong id="selectedFromDisplay">Not
                                                                selected</strong></span>
                                                        <span>To: <strong id="selectedToDisplay">Not
                                                                selected</strong></span>
                                                    </div>
                                                    <div>
                                                        <button class="btn btn-sm btn-outline-secondary me-2"
                                                            id="clearDates">Clear</button>
                                                        <button class="btn btn-sm btn-primary"
                                                            id="applyDates">Apply</button>
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
                                                    <th>Created At</th>
                                                    <th>Just Listed_conversion</th>
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
        $(document).ready(function () {
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
                    url: "{{ route('agent.appraisals.index') }}",
                    data: function (d) {
                        d.start_date = selectedFromDate ? selectedFromDate.format('YYYY-MM-DD') : '';
                        d.end_date = selectedToDate ? selectedToDate.format('YYYY-MM-DD') : '';
                    }
                },
                columns: [
                    {
                        data: 'address',
                        name: 'vendor1_address',
                        render: function (data) {
                            return data || 'N/A';
                        }
                    },
                    {
                        data: 'vendor_name',
                        name: 'vendor1_first_name',
                        render: function (data, type, row) {
                            return (row.vendor1_first_name || '') + ' ' + (row.vendor1_last_name || '') || 'N/A';
                        }
                    },
                    {
                        data: 'contact_info',
                        name: 'vendor1_mobile',
                        render: function (data, type, row) {
                            return (row.vendor1_mobile || 'N/A') + '<br>' + (row.vendor1_email || '');
                        }
                    },
                    {
                        data: 'created_at',
                        name: 'created_at',
                        render: function (data) {
                            return data ? new Date(data).toLocaleString() : 'N/A';
                        }
                    },
                    {
                        data: 'converted_to_just_listed',
                        name: 'converted_to_just_listed',
                        render: function (data) {
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
                    emptyTable: 'No appraisals found',
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

            // View appraisal details
            $(document).on('click', '.view-btn', function () {
                const appraisalId = $(this).data('id');

                $.ajax({
                    url: "{{ route('agent.appraisals.show', '') }}/" + appraisalId,
                    type: 'GET',
                    success: function (response) {
                        if (response.success) {
                            const appraisal = response.data;
            const modalContent = `
    <!-- View Conduct Appraisal Modal -->
    <div class="modal fade" id="appraisalDetailsModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered">
            <div class="modal-content border-0 shadow-lg">
                <!-- Header -->
                <div class="modal-header border-0 bg-gradient text-dark position-relative overflow-hidden" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); min-height: 80px;">
                    <div class="d-flex align-items-center position-relative">
                        <div class="me-4 p-3 bg-white bg-opacity-20 rounded-circle">
                            <i class="fas fa-home fa-2x text-dark"></i>
                        </div>
                        <div>
                            <h3 class="modal-title mb-1 fw-bold">Conduct Appraisal Details</h3>
                            <p class="mb-0 opacity-90">Comprehensive property appraisal overview</p>
                        </div>
                    </div>
                    <button type="button" class="btn-close btn-close-white position-relative" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body p-0">
                    <div class="container-fluid p-4">
                        <div class="row g-4">
                            <!-- Property Details -->
                            <div class="col-lg-6">
                                <div class="card border-0 h-100 shadow-sm text-dark" style="background: linear-gradient(135deg, #ffffff 0%, #f8fafc 100%);">
                                    <div class="card-header bg-light border-bottom">
                                        <div class="d-flex align-items-center">
                                            <div class="me-3 p-2 bg-white bg-opacity-10 rounded text-primary">
                                                <i class="fas fa-home"></i>
                                            </div>
                                            <div>
                                                <h5 class="mb-1 fw-bold text-dark">Property Details</h5>
                                                <small class="text-muted">Detailed property specifications</small>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body p-4 text-dark">
                                        <div class="row g-3">
                                            <div class="col-md-6">
                                                <div class="form-floating">
                                                    <div class="form-control bg-white border-2 text-dark fw-semibold" style="padding-top: 1.625rem; border-color: #e0e7ff !important;">
                                                        ${appraisal.vendor1_address || 'N/A'}
                                                    </div>
                                                    <label class="text-muted fw-medium">
                                                        <i class="fas fa-map-marker-alt me-2 text-danger"></i>Address
                                                    </label>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-floating">
                                                    <div class="form-control bg-white border-2 text-dark fw-semibold" style="padding-top: 1.625rem; border-color: #e0e7ff !important;">
                                                        ${appraisal.property_type || 'N/A'} ${appraisal.other_property_type ? '(' + appraisal.other_property_type + ')' : ''}
                                                    </div>
                                                    <label class="text-muted fw-medium">
                                                        <i class="fas fa-home me-2 text-primary"></i>Property Type
                                                    </label>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-floating">
                                                    <div class="form-control bg-white border-2 text-dark fw-semibold" style="padding-top: 1.625rem; border-color: #e0e7ff !important;">
                                                        ${appraisal.property_condition || 'N/A'}
                                                    </div>
                                                    <label class="text-muted fw-medium">
                                                        <i class="fas fa-paint-roller me-2 text-warning"></i>Condition
                                                    </label>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-floating">
                                                    <div class="form-control bg-white border-2 text-dark fw-semibold" style="padding-top: 1.625rem; border-color: #e0e7ff !important;">
                                                        ${appraisal.bedrooms || 'N/A'}
                                                    </div>
                                                    <label class="text-muted fw-medium">
                                                        <i class="fas fa-bed me-2 text-info"></i>Bedrooms
                                                    </label>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-floating">
                                                    <div class="form-control bg-white border-2 text-dark fw-semibold" style="padding-top: 1.625rem; border-color: #e0e7ff !important;">
                                                        ${appraisal.bathrooms || 'N/A'}
                                                    </div>
                                                    <label class="text-muted fw-medium">
                                                        <i class="fas fa-bath me-2 text-success"></i>Bathrooms
                                                    </label>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-floating">
                                                    <div class="form-control bg-white border-2 text-dark fw-semibold" style="padding-top: 1.625rem; border-color: #e0e7ff !important;">
                                                        ${appraisal.land_size_quick || 'N/A'} ${appraisal.land_size ? 'sqm' : ''}
                                                    </div>
                                                    <label class="text-muted fw-medium">
                                                        <i class="fas fa-ruler-combined me-2 text-secondary"></i>Land Size
                                                    </label>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-floating">
                                                    <div class="form-control bg-white border-2 text-dark fw-semibold" style="padding-top: 1.625rem; border-color: #e0e7ff !important;">
                                                        ${appraisal.year_built || 'N/A'}
                                                    </div>
                                                    <label class="text-muted fw-medium">
                                                        <i class="fas fa-calendar me-2 text-info"></i>Year Built
                                                    </label>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-floating">
                                                    <div class="form-control bg-white border-2 text-dark fw-semibold" style="padding-top: 1.625rem; border-color: #e0e7ff !important;">
                                                        ${appraisal.storeys || 'N/A'}
                                                    </div>
                                                    <label class="text-muted fw-medium">
                                                        <i class="fas fa-building me-2 text-primary"></i>Storeys
                                                    </label>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-floating">
                                                    <div class="form-control bg-white border-2 text-dark fw-semibold" style="padding-top: 1.625rem; border-color: #e0e7ff !important;">
                                                        ${appraisal.exterior_material || 'N/A'}
                                                    </div>
                                                    <label class="text-muted fw-medium">
                                                        <i class="fas fa-paint-brush me-2 text-warning"></i>Exterior Material
                                                    </label>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-floating">
                                                    <div class="form-control bg-white border-2 text-dark fw-semibold" style="padding-top: 1.625rem; border-color: #e0e7ff !important;">
                                                        ${appraisal.living_areas || 'N/A'}
                                                    </div>
                                                    <label class="text-muted fw-medium">
                                                        <i class="fas fa-couch me-2 text-success"></i>Living Areas
                                                    </label>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-floating">
                                                    <div class="form-control bg-white border-2 text-dark fw-semibold" style="padding-top: 1.625rem; border-color: #e0e7ff !important;">
                                                        ${appraisal.toilets || 'N/A'}
                                                    </div>
                                                    <label class="text-muted fw-medium">
                                                        <i class="fas fa-toilet me-2 text-secondary"></i>Toilets
                                                    </label>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-floating">
                                                    <div class="form-control bg-white border-2 text-dark fw-semibold" style="padding-top: 1.625rem; border-color: #e0e7ff !important;">
                                                        ${appraisal.car_spaces || 'N/A'}
                                                    </div>
                                                    <label class="text-muted fw-medium">
                                                        <i class="fas fa-car me-2 text-dark"></i>Car Spaces
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

                                            ${appraisal.has_additional_vendor ? `
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

                            <!-- Professional Contacts -->
                            <div class="col-lg-6">
                                <div class="card border-0 h-100 shadow-sm text-dark" style="background: linear-gradient(135deg, #ffffff 0%, #f8fafc 100%);">
                                    <div class="card-header bg-light border-bottom">
                                        <div class="d-flex align-items-center">
                                            <div class="me-3 p-2 bg-white bg-opacity-10 rounded text-success">
                                                <i class="fas fa-address-book"></i>
                                            </div>
                                            <div>
                                                <h5 class="mb-1 fw-bold text-dark">Professional Contacts</h5>
                                                <small class="text-muted">Recommended professionals</small>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body p-4 text-dark">
                                        <div class="form-floating">
                                            <div class="form-control bg-light border text-dark" style="padding-top: 1.625rem; min-height: 80px;">
                                                <div class="feature-tags">
                                                    ${Array.isArray(appraisal.professional_contacts) && appraisal.professional_contacts.length > 0 ?
                                    appraisal.professional_contacts.map(item => `<span class="feature-tag">${item}</span>`).join('') :
                                    '<span class="text-muted">No professional contacts</span>'}
                                                </div>
                                            </div>
                                            <label class="text-muted fw-medium">
                                                <i class="fas fa-users me-2 text-primary"></i>Professional Contacts
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Trade Person Details - Enhanced -->
                            <div class="col-lg-6">
                                <div class="card border-0 h-100 shadow-sm text-dark" style="background: linear-gradient(135deg, #ffffff 0%, #f8fafc 100%);">
                                    <div class="card-header bg-light border-bottom">
                                        <div class="d-flex align-items-center justify-content-between">
                                            <div class="d-flex align-items-center">
                                                <div class="me-3 p-2 bg-white bg-opacity-10 rounded text-warning">
                                                    <i class="fas fa-tools"></i>
                                                </div>
                                                <div>
                                                    <h5 class="mb-1 fw-bold text-dark">Trade Person Details</h5>
                                                    <small class="text-muted">Professional service providers</small>
                                                </div>
                                            </div>
                                            ${Array.isArray(appraisal.trade_persons_data) && appraisal.trade_persons_data.length > 0 ? `
                                            <span class="badge bg-warning text-dark">${appraisal.trade_persons_data.length} Trade${appraisal.trade_persons_data.length !== 1 ? 's' : ''}</span>
                                            ` : ''}
                                        </div>
                                    </div>
                                    <div class="card-body p-4 text-dark">
                                        ${Array.isArray(appraisal.trade_persons_data) && appraisal.trade_persons_data.length > 0 ? 
                                            appraisal.trade_persons_data.map((person, index) => `
                                            <div class="trade-person-item mb-4 p-3 bg-light rounded border ${index !== appraisal.trade_persons_data.length - 1 ? 'border-bottom mb-3' : ''}">
                                                <div class="row g-2">
                                                    <div class="col-md-6">
                                                        <div class="d-flex align-items-center mb-2">
                                                            <i class="fas fa-user me-2 text-primary"></i>
                                                            <strong class="text-dark">${person.name || 'N/A'}</strong>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="d-flex align-items-center mb-2">
                                                            <i class="fas fa-briefcase me-2 text-info"></i>
                                                            <span class="badge bg-info text-white">${person.profession || 'N/A'}</span>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="d-flex align-items-center mb-2">
                                                            <i class="fas fa-phone me-2 text-success"></i>
                                                            ${person.phone ? `<a href="tel:${person.phone}" class="text-success text-decoration-none fw-semibold">${person.phone}</a>` : '<span class="text-muted">No phone</span>'}
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="d-flex align-items-center mb-2">
                                                            <i class="fas fa-envelope me-2 text-warning"></i>
                                                            ${person.email ? `<a href="mailto:${person.email}" class="text-warning text-decoration-none fw-semibold">${person.email}</a>` : '<span class="text-muted">No email</span>'}
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="d-flex align-items-center">
                                                            <i class="fas fa-toggle-${person.is_active ? 'on text-success' : 'off text-danger'} me-2"></i>
                                                            <span class="badge bg-${person.is_active ? 'success' : 'danger'}">${person.is_active ? 'Active' : 'Inactive'}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            `).join('') : 
                                            `<div class="text-center py-4">
                                                <i class="fas fa-hard-hat fa-3x text-muted mb-3"></i>
                                                <p class="text-muted mb-0">No trade persons assigned</p>
                                            </div>`
                                        }
                                    </div>
                                </div>
                            </div>

                            <!-- Property Features -->
                            <div class="col-lg-6">
                                <div class="card border-0 h-100 shadow-sm text-dark" style="background: linear-gradient(135deg, #ffffff 0%, #f8fafc 100%);">
                                    <div class="card-header bg-light border-bottom">
                                        <div class="d-flex align-items-center">
                                            <div class="me-3 p-2 bg-white bg-opacity-10 rounded text-success">
                                                <i class="fas fa-star"></i>
                                            </div>
                                            <div>
                                                <h5 class="mb-1 fw-bold text-dark">Property Features</h5>
                                                <small class="text-muted">Additional features & amenities</small>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body p-4 text-dark">
                                        <div class="row g-3">
                                            <div class="col-12">
                                                <div class="form-floating">
                                                    <div class="form-control bg-light border text-dark" style="padding-top: 1.625rem; min-height: 80px;">
                                                        <div class="feature-tags">
                                                            ${Array.isArray(appraisal.extra_features) && appraisal.extra_features.length > 0 ?
                                    appraisal.extra_features.map(item => `<span class="feature-tag">${item}</span>`).join('') :
                                    '<span class="text-muted">No extra features</span>'}
                                                        </div>
                                                    </div>
                                                    <label class="text-muted fw-medium">
                                                        <i class="fas fa-plus-circle me-2 text-success"></i>Extra Features
                                                    </label>
                                                </div>
                                            </div>

                                            <div class="col-12">
                                                <div class="form-floating">
                                                    <div class="form-control bg-light border text-dark" style="padding-top: 1.625rem; min-height: 80px;">
                                                        <div class="feature-tags">
                                                            ${Array.isArray(appraisal.outdoor_features) && appraisal.outdoor_features.length > 0 ?
                                    appraisal.outdoor_features.map(item => `<span class="feature-tag">${item}</span>`).join('') :
                                    '<span class="text-muted">No outdoor features</span>'}
                                                        </div>
                                                    </div>
                                                    <label class="text-muted fw-medium">
                                                        <i class="fas fa-tree me-2 text-warning"></i>Outdoor Features
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Meeting Summary -->
                            <div class="col-lg-6">
                                <div class="card border-0 h-100 shadow-sm text-dark" style="background: linear-gradient(135deg, #ffffff 0%, #f8fafc 100%);">
                                    <div class="card-header bg-light border-bottom">
                                        <div class="d-flex align-items-center">
                                            <div class="me-3 p-2 bg-white bg-opacity-10 rounded text-info">
                                                <i class="fas fa-clipboard-list"></i>
                                            </div>
                                            <div>
                                                <h5 class="mb-1 fw-bold text-dark">Meeting Summary</h5>
                                                <small class="text-muted">Appraisal discussion points</small>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body p-4 text-dark">
                                        <div class="row g-3">
                                            <div class="col-md-6">
                                                <div class="form-floating">
                                                    <div class="form-control bg-light border text-dark fw-semibold" style="padding-top: 1.625rem;">
                                                        ${appraisal.sale_method || 'N/A'}
                                                    </div>
                                                    <label class="text-muted fw-medium">
                                                        <i class="fas fa-tag me-2 text-primary"></i>Sale Method
                                                    </label>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-floating">
                                                    <div class="form-control bg-light border text-dark fw-semibold" style="padding-top: 1.625rem;">
                                                        ${appraisal.auction_date || 'N/A'}
                                                    </div>
                                                    <label class="text-muted fw-medium">
                                                        <i class="fas fa-gavel me-2 text-warning"></i>Auction Date
                                                    </label>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-floating">
                                                    <div class="form-control bg-light border text-dark fw-semibold" style="padding-top: 1.625rem;">
                                                        ${appraisal.preferred_launch || 'N/A'}
                                                    </div>
                                                    <label class="text-muted fw-medium">
                                                        <i class="fas fa-rocket me-2 text-danger"></i>Preferred Launch
                                                    </label>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-floating">
                                                    <div class="form-control bg-light border text-dark fw-semibold" style="padding-top: 1.625rem;">
                                                        ${appraisal.first_open || 'N/A'}
                                                    </div>
                                                    <label class="text-muted fw-medium">
                                                        <i class="fas fa-door-open me-2 text-success"></i>First Open
                                                    </label>
                                                </div>
                                            </div>

                                         

                                            <div class="col-12">
                                                <div class="form-floating">
                                                    <div class="form-control bg-light border text-dark" style="padding-top: 1.625rem; min-height: 80px;">
                                                        <div class="feature-tags">
                                                            ${Array.isArray(appraisal.marketing_discussed) && appraisal.marketing_discussed.length > 0 ?
                                    appraisal.marketing_discussed.map(item => `<span class="feature-tag">${item}</span>`).join('') :
                                    '<span class="text-muted">No marketing discussed</span>'}
                                                        </div>
                                                    </div>
                                                    <label class="text-muted fw-medium">
                                                        <i class="fas fa-bullhorn me-2 text-info"></i>Marketing Discussed
                                                    </label>
                                                </div>
                                            </div>

                                            <div class="col-12">
                                                <div class="form-floating">
                                                    <div class="form-control bg-light border text-dark fw-semibold" style="padding-top: 1.625rem;">
                                                        ${appraisal.commission_discussed ? 'Discussed' : 'Not discussed'} ${appraisal.commission_details ? '(' + appraisal.commission_details + ')' : ''}
                                                    </div>
                                                    <label class="text-muted fw-medium">
                                                        <i class="fas fa-percentage me-2 text-danger"></i>Commission
                                                    </label>
                                                </div>
                                            </div>

                                            <div class="col-12">
                                                <div class="form-floating">
                                                    <div class="form-control bg-light border text-dark" style="padding-top: 1.625rem; min-height: 80px;">
                                                        ${appraisal.agent_notes || '<span class="text-muted">No agent notes</span>'}
                                                    </div>
                                                    <label class="text-muted fw-medium">
                                                        <i class="fas fa-sticky-note me-2 text-warning"></i>Agent Notes
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Smart Send -->
                            <div class="col-lg-6">
                                <div class="card border-0 h-100 shadow-sm text-dark" style="background: linear-gradient(135deg, #ffffff 0%, #f8fafc 100%);">
                                    <div class="card-header bg-light border-bottom">
                                        <div class="d-flex align-items-center">
                                            <div class="me-3 p-2 bg-white bg-opacity-10 rounded text-primary">
                                                <i class="fas fa-paper-plane"></i>
                                            </div>
                                            <div>
                                                <h5 class="mb-1 fw-bold text-dark">Smart Send</h5>
                                                <small class="text-muted">Follow-up communication</small>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body p-4 text-dark">
                                        <div class="row g-3">
                                            <div class="col-md-6">
                                                <div class="form-floating">
                                                    <div class="form-control bg-light border text-dark fw-semibold" style="padding-top: 1.625rem;">
                                                        ${appraisal.follow_up_sms || 'N/A'}
                                                    </div>
                                                    <label class="text-muted fw-medium">
                                                        <i class="fas fa-sms me-2 text-success"></i>Follow Up SMS
                                                    </label>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-floating">
                                                    <div class="form-control bg-light border text-dark fw-semibold" style="padding-top: 1.625rem;">
                                                        ${appraisal.follow_up_email || 'N/A'}
                                                    </div>
                                                    <label class="text-muted fw-medium">
                                                        <i class="fas fa-envelope me-2 text-info"></i>Follow Up Email
                                                    </label>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-floating">
                                                    <div class="form-control bg-light border text-dark fw-semibold" style="padding-top: 1.625rem;">
                                                        ${appraisal.proposal_method || 'N/A'}
                                                    </div>
                                                    <label class="text-muted fw-medium">
                                                        <i class="fas fa-file-contract me-2 text-primary"></i>Proposal Method
                                                    </label>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-floating">
                                                    <div class="form-control bg-light border text-dark fw-semibold" style="padding-top: 1.625rem;">
                                                        ${appraisal.send_proposal ? 'Yes' : 'No'} ${appraisal.include_price ? '(with price)' : ''}
                                                    </div>
                                                    <label class="text-muted fw-medium">
                                                        <i class="fas fa-file-alt me-2 text-warning"></i>Send Proposal
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Comparable Sales -->
                            <div class="col-lg-6">
                                <div class="card border-0 h-100 shadow-sm text-dark" style="background: linear-gradient(135deg, #ffffff 0%, #f8fafc 100%);">
                                    <div class="card-header bg-light border-bottom">
                                        <div class="d-flex align-items-center">
                                            <div class="me-3 p-2 bg-white bg-opacity-10 rounded text-info">
                                                <i class="fas fa-chart-line"></i>
                                            </div>
                                            <div>
                                                <h5 class="mb-1 fw-bold text-dark">Comparable Sales</h5>
                                                <small class="text-muted">Market comparison data</small>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body p-4 text-dark">
                                        <div class="form-floating">
                                            <div class="form-control bg-light border text-dark" style="padding-top: 1.625rem; min-height: 80px;">
                                                <div class="feature-tags">
                                                    ${Array.isArray(appraisal.comparable_sales) && appraisal.comparable_sales.length > 0 ?
                                    appraisal.comparable_sales.map(item => `<span class="feature-tag">${item}</span>`).join('') :
                                    '<span class="text-muted">No comparable sales</span>'}
                                                </div>
                                            </div>
                                            <label class="text-muted fw-medium">
                                                <i class="fas fa-home me-2 text-warning"></i>Comparable Sales
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Appraisal Photos Section -->
                            ${Array.isArray(appraisal.photos) && appraisal.photos.length > 0 ? `
                            <div class="col-12">
                                <div class="card border-0 shadow-sm text-dark" style="background: linear-gradient(135deg, #ffffff 0%, #f8fafc 100%);">
                                    <div class="card-header bg-light border-bottom">
                                        <div class="d-flex align-items-center">
                                            <div class="me-3 p-2 bg-white bg-opacity-10 rounded text-success">
                                                <i class="fas fa-camera"></i>
                                            </div>
                                            <div>
                                                <h5 class="mb-1 fw-bold text-dark">Appraisal Photos</h5>
                                                <small class="text-muted">Visual documentation of the appraisal</small>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body p-4">
                                        <div class="photo-gallery">
                                            ${appraisal.photos.map((photo, index) => `
                                                <div class="photo-item">
                                                    <img src="{{ asset('${photo}') }}" alt="Appraisal photo ${index + 1}" class="img-fluid rounded">
                                                    <div class="photo-label">Photo ${index + 1}</div>
                                                </div>
                                            `).join('')}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            ` : ''}

                            <!-- Property Photos Section -->
                            ${Array.isArray(appraisal.property_photos) && appraisal.property_photos.length > 0 ? `
                            <div class="col-12">
                                <div class="card border-0 shadow-sm text-dark" style="background: linear-gradient(135deg, #ffffff 0%, #f8fafc 100%);">
                                    <div class="card-header bg-light border-bottom">
                                        <div class="d-flex align-items-center">
                                            <div class="me-3 p-2 bg-white bg-opacity-10 rounded text-primary">
                                                <i class="fas fa-home"></i>
                                            </div>
                                            <div>
                                                <h5 class="mb-1 fw-bold text-dark">Property Photos</h5>
                                                <small class="text-muted">Property visual documentation</small>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body p-4">
                                        <div class="photo-gallery">
                                            ${appraisal.property_photos.map((photo, index) => `
                                                <div class="photo-item">
                                                    <img src="{{ asset('${photo}') }}" alt="Property photo ${index + 1}" class="img-fluid rounded">
                                                    <div class="photo-label">Property ${index + 1}</div>
                                                </div>
                                            `).join('')}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            ` : ''}

                            <!-- Comparable Photos Section -->
                            ${Array.isArray(appraisal.comparable_photos) && appraisal.comparable_photos.length > 0 ? `
                            <div class="col-12">
                                <div class="card border-0 shadow-sm text-dark" style="background: linear-gradient(135deg, #ffffff 0%, #f8fafc 100%);">
                                    <div class="card-header bg-light border-bottom">
                                        <div class="d-flex align-items-center">
                                            <div class="me-3 p-2 bg-white bg-opacity-10 rounded text-info">
                                                <i class="fas fa-search-dollar"></i>
                                            </div>
                                            <div>
                                                <h5 class="mb-1 fw-bold text-dark">Comparable Sales Photos</h5>
                                                <small class="text-muted">Market comparison photos</small>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body p-4">
                                        <div class="photo-gallery">
                                            ${appraisal.comparable_photos.map((photo, index) => `
                                                <div class="photo-item">
                                                    <img src="{{ asset('${photo}') }}" alt="Comparable photo ${index + 1}" class="img-fluid rounded">
                                                    <div class="photo-label">Comparable ${index + 1}</div>
                                                </div>
                                            `).join('')}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            ` : ''}


                            <!-- Additional Notes -->
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
                                                ${appraisal.other_notes || '<span class="text-muted">No additional notes</span>'}
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
                            Appraisal conducted on: <strong class="text-dark">${new Date(appraisal.created_at).toLocaleDateString()}</strong>
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

    <style>
        .feature-tags {
            display: flex;
            flex-wrap: wrap;
            gap: 6px;
        }
        
        .feature-tag {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 4px 10px;
            border-radius: 15px;
            font-size: 12px;
            font-weight: 500;
        }
        
        .photo-gallery {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
        }
        
        .photo-item {
            position: relative;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            transition: transform 0.3s ease;
        }
        
        .photo-item:hover {
            transform: translateY(-5px);
        }
        
        .photo-item img {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }
        
        .photo-label {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            background: linear-gradient(transparent, rgba(0,0,0,0.8));
            color: white;
            padding: 10px;
            font-size: 14px;
            font-weight: 500;
        }
    </style>
    `;

                            $('body').append(modalContent);
                            const modal = new bootstrap.Modal(document.getElementById('appraisalDetailsModal'));
                            modal.show();

                            // Remove modal from DOM after it's hidden
                            $('#appraisalDetailsModal').on('hidden.bs.modal', function () {
                                $(this).remove();
                            });
                        }
                    },
                    error: function (xhr) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'Failed to load appraisal details',
                            timer: 2000,
                            showConfirmButton: false
                        });
                    }
                });
            });

            // Delete appraisal
            $(document).on('click', '.delete-btn', function () {
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
                            url: "{{ route('agent.appraisals.destroy', '') }}/" + appraisalId,
                            type: 'DELETE',
                            data: {
                                _token: "{{ csrf_token() }}"
                            },
                            success: function (response) {
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
                            error: function (xhr) {
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