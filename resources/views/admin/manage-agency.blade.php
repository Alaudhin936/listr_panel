@extends('adminlayout.master')

@section('main_content')
<link href="https://cdn.datatables.net/1.13.8/css/dataTables.bootstrap5.min.css" rel="stylesheet">
<link href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.bootstrap5.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<style>
  
		.dataTables_length select {
    -webkit-appearance: auto !important;
    -moz-appearance: auto !important;
    appearance: auto !important;
    background-image: none !important; /* Remove any custom arrow */
}


    .page-wrapper {
        background: #f8f9fa;
        min-height: 100vh;
    }
    .status-select {
    padding: 0.25rem 0.5rem;
    font-size: 0.875rem;
    border-radius: 0.25rem;
    border: 1px solid #ced4da;
    min-width: 100px;
    background-color: white;
}
.status-select:focus {
    border-color: #000;
    outline: none;
    box-shadow: 0 0 0 0.2rem rgba(0, 0, 0, 0.1);
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
    .badge-danger {
        background-color: #dc3545;
    }
    .btn-sm {
        padding: 0.25rem 0.5rem;
        font-size: 0.875rem;
        border-radius: 0.25rem;
    }
    .btn-outline-secondary {
        border-color: #6c757d;
        color: #6c757d;
    }
    .btn-outline-secondary:hover {
        background-color: #6c757d;
        color: #fff;
    }
    .btn-outline-primary {
        border-color: #000;
        color: #000;
    }
    .btn-outline-primary:hover {
        background-color: #000;
        color: #fff;
    }
    .btn-outline-danger {
        border-color: #dc3545;
        color: #dc3545;
    }
    .btn-outline-danger:hover {
        background-color: #dc3545;
        color: #fff;
    }
    .btn-outline-success {
        border-color: #28a745;
        color: #28a745;
    }
    .btn-outline-success:hover {
        background-color: #28a745;
        color: #fff;
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
    .nav-tabs {
        border-bottom: 1px solid #dee2e6;
    }
    .nav-tabs .nav-link {
        border: none;
        color: #495057;
        font-weight: 700;
        padding: 0.75rem 1.5rem;
        border-radius: 0;
        margin-right: 0.5rem;
    }
    .nav-tabs .nav-link:hover {
        border-color: transparent;
        color: #000;
    }
    .nav-tabs .nav-link.active {
        color: #000;
        background-color: transparent;
        border-bottom: 2px solid #000;
		 font-weight: 700;

    }
    .tab-content {
        padding: 1.5rem 0;
    }
    /* Form styles for register tab */
    .register-form {
        padding: 1.5rem;
        background: #fff;
        border-radius: 0.5rem;
        box-shadow: 0 0.15rem 1.75rem 0 rgba(33, 40, 50, 0.05);
    }
    .form-group {
        margin-bottom: 1.25rem;
    }
    .form-control {
        border: 1px solid #ced4da;
        border-radius: 0.375rem;
        padding: 0.5rem 0.75rem;
    }
    .form-label {
        font-weight: 500;
        margin-bottom: 0.5rem;
    }
    .password-toggle {
        position: absolute;
        right: 10px;
        top: 50%;
        transform: translateY(-50%);
        cursor: pointer;
    }
    .password-input-group {
        position: relative;
    }
.custom-modal-size .modal-dialog {
    max-width: 800px; /* Adjust this value as needed */
    width: 90%;
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
                                <h4 class="hot-head1" style="font-family: "Montserrat", sans-serif;
  font-weight: 800;">
                                    <i class="fas fa-users me-2"></i>Agency Management
                                </h4>
                                <a href="#" class="btn btn-primary" id="show-register-tab">
                                    <i class="fas fa-plus me-1"></i> Register New Agency
                                </a>
                            </div>
                            <div class="card-body">
                                <!-- Tabs Navigation -->
                                <ul class="nav nav-tabs" id="agencyTabs" role="tablist">
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link {{ $activeTab === 'manage' ? 'active' : '' }}" style="font-weight:600px;"
                                                id="manage-tab" data-bs-toggle="tab" 
                                                data-bs-target="#manage" type="button" role="tab" 
                                                aria-controls="manage" aria-selected="{{ $activeTab === 'manage' ? 'true' : 'false' }}">
                                            Manage Agencies
                                        </button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link {{ $activeTab === 'register' ? 'active' : '' }}" 
                                                id="register-tab" data-bs-toggle="tab" 
                                                data-bs-target="#register" type="button" role="tab" 
                                                aria-controls="register" aria-selected="{{ $activeTab === 'register' ? 'true' : 'false' }}">
                                            Register
                                        </button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link {{ $activeTab === 'new' ? 'active' : '' }}"  style="font-weight:600px;"
                                                id="new-tab" data-bs-toggle="tab" 
                                                data-bs-target="#new" type="button" role="tab" 
                                                aria-controls="new" aria-selected="{{ $activeTab === 'new' ? 'true' : 'false' }}">
                                            New Applications
                                        </button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link {{ $activeTab === 'inactive' ? 'active' : '' }}" style="font-weight:600px;" 
                                                id="inactive-tab" data-bs-toggle="tab" 
                                                data-bs-target="#inactive" type="button" role="tab" 
                                                aria-controls="inactive" aria-selected="{{ $activeTab === 'inactive' ? 'true' : 'false' }}">
                                            Inactive Agencies
                                        </button>
                                    </li>
                                </ul>

                                <!-- Tabs Content -->
                                <div class="tab-content" id="agencyTabsContent">
                                    <!-- Manage Agencies Tab -->
                                    <div class="tab-pane fade {{ $activeTab === 'manage' ? 'show active' : '' }}" 
                                         id="manage" role="tabpanel" aria-labelledby="manage-tab">
                                        <div class="table-responsive">
                                            <table id="manage-agencies-table" class="table table-hover" style="width:100%">
                                                <thead>
                                                    <tr>
                                                        <th>Name</th>
                                                        <th>Email</th>
                                                        <th>Contact</th>
                                                        <th>Status</th>
                                                        <th>Created</th>
                                                        <th class="text-end">Actions</th>
                                                    </tr>
                                                </thead>
                                            </table>
                                        </div>
                                    </div>

                                    <!-- Register Tab -->
                                    <div class="tab-pane fade {{ $activeTab === 'register' ? 'show active' : '' }}" 
                                         id="register" role="tabpanel" aria-labelledby="register-tab">
                                        <div class="register-form">
                                            <form id="agency-registration-form" method="POST" action="{{ route('agency.store') }}">
                                                @csrf
                                                <h5 class="mb-4">Register New Agency</h5>
                                                
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="form-label">Agency Name</label>
                                                            <input type="text" class="form-control" name="name" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="form-label">Registration Number</label>
                                                            <input type="text" class="form-control" name="register_number" required>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="form-label">Address Line 1</label>
                                                    <input type="text" class="form-control" name="address_line1" required>
                                                </div>

                                                <div class="form-group">
                                                    <label class="form-label">Address Line 2 (Optional)</label>
                                                    <input type="text" class="form-control" name="address_line2">
                                                </div>

                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label class="form-label">State</label>
                                                            <input type="text" class="form-control" name="state" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label class="form-label">City</label>
                                                            <input type="text" class="form-control" name="city" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label class="form-label">Zipcode</label>
                                                            <input type="text" class="form-control" name="zipcode" required>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="form-label">Email Address</label>
                                                    <input type="email" class="form-control" name="email" required>
                                                </div>

                                                <div class="form-group">
                                                    <label class="form-label">Contact Person</label>
                                                    <input type="text" class="form-control" name="contact_person" required>
                                                </div>

                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="form-label">Phone</label>
                                                            <input type="tel" class="form-control" name="phone" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="form-label">Landline (Optional)</label>
                                                            <input type="tel" class="form-control" name="landline">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="form-label">Password</label>
                                                    <div class="password-input-group">
                                                        <input type="password" class="form-control" name="password" id="password" required>
                                                        <span class="password-toggle" onclick="togglePassword('password')">
                                                            <i class="fas fa-eye"></i>
                                                        </span>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="form-label">Confirm Password</label>
                                                    <div class="password-input-group">
                                                        <input type="password" class="form-control" name="password_confirmation" id="password_confirmation" required>
                                                        <span class="password-toggle" onclick="togglePassword('password_confirmation')">
                                                            <i class="fas fa-eye"></i>
                                                        </span>
                                                    </div>
                                                </div>

                                                <div class="form-group form-check">
                                                    <input type="checkbox" class="form-check-input" id="terms" required>
                                                    <label class="form-check-label" for="terms">I agree to the terms and conditions</label>
                                                </div>

                                                <button type="submit" class="btn btn-primary">Register Agency</button>
                                            </form>
                                        </div>
                                    </div>

                                    <!-- New Applications Tab -->
                                    <div class="tab-pane fade {{ $activeTab === 'new' ? 'show active' : '' }}" 
                                         id="new" role="tabpanel" aria-labelledby="new-tab">
                                        <div class="table-responsive">
                                            <table id="new-applications-table" class="table table-hover" style="width:100%">
                                                <thead>
                                                    <tr>
                                                        <th>Name</th>
                                                        <th>Email</th>
                                                        <th>Contact</th>
                                                        <th>Status</th>
                                                        <th>Created</th>
                                                        <th class="text-end">Actions</th>
                                                    </tr>
                                                </thead>
                                            </table>
                                        </div>
                                    </div>

                                    <!-- Inactive Agencies Tab -->
                                    <div class="tab-pane fade {{ $activeTab === 'inactive' ? 'show active' : '' }}" 
                                         id="inactive" role="tabpanel" aria-labelledby="inactive-tab">
                                        <div class="table-responsive">
                                            <table id="inactive-agencies-table" class="table table-hover" style="width:100%">
                                                <thead>
                                                    <tr>
                                                        <th>Name</th>
                                                        <th>Email</th>
                                                        <th>Contact</th>
                                                        <th>Status</th>
                                                        <th>Created</th>
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
    </div>
</div>

<!-- Details Modal Template -->
<div id="modal-template" style="display: none;" class="modal-dialog custom-modal-size modal-dialog-centered">
    <div class="modal fade" id="agencyDetailsModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow-lg">
                <div class="modal-header bg-light border-0 py-3">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0 me-3">
                            <div class="avatar bg-soft-primary text-primary rounded-circle">
                                <i class="fas fa-user-tie"></i>
                            </div>
                        </div>
                        <div class="flex-grow-1">
                            <h5 class="modal-title mb-0 fw-bold text-dark">Agency Details</h5>
                        </div>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">
                    <div class="mb-4">
                        <h6 class="fw-bold mb-3 text-uppercase text-sm text-muted">Agency Information</h6>
                        <div class="d-flex mb-3">
                            <div class="flex-shrink-0 text-muted me-3">
                                <i class="fas fa-building"></i>
                            </div>
                            <div class="flex-grow-1">
                                <div class="small text-muted">Agency Name</div>
                                <div id="agency-name"></div>
                            </div>
                        </div>
                        <div class="d-flex mb-3">
                            <div class="flex-shrink-0 text-muted me-3">
                                <i class="fas fa-id-card"></i>
                            </div>
                            <div class="flex-grow-1">
                                <div class="small text-muted">Registration Number</div>
                                <div id="agency-reg-no"></div>
                            </div>
                        </div>
                        <div class="d-flex mb-3">
                            <div class="flex-shrink-0 text-muted me-3">
                                <i class="fas fa-envelope"></i>
                            </div>
                            <div class="flex-grow-1">
                                <div class="small text-muted">Email</div>
                                <div id="agency-email"></div>
                            </div>
                        </div>
                        <div class="d-flex mb-3">
                            <div class="flex-shrink-0 text-muted me-3">
                                <i class="fas fa-phone"></i>
                            </div>
                            <div class="flex-grow-1">
                                <div class="small text-muted">Phone</div>
                                <div id="agency-phone"></div>
                            </div>
                        </div>
                        <div class="d-flex">
                            <div class="flex-shrink-0 text-muted me-3">
                                <i class="fas fa-info-circle"></i>
                            </div>
                            <div class="flex-grow-1">
                                <div class="small text-muted">Status</div>
                                <span id="agency-status" class="badge"></span>
                            </div>
                        </div>
                    </div>

                    <div class="mb-4">
                        <h6 class="fw-bold mb-3 text-uppercase text-sm text-muted">Address Information</h6>
                        <div class="d-flex mb-3">
                            <div class="flex-shrink-0 text-muted me-3">
                                <i class="fas fa-map-marker-alt"></i>
                            </div>
                            <div class="flex-grow-1">
                                <div class="small text-muted">Address Line 1</div>
                                <div id="agency-address1"></div>
                            </div>
                        </div>
                        <div class="d-flex mb-3">
                            <div class="flex-shrink-0 text-muted me-3">
                                <i class="fas fa-map-marker-alt"></i>
                            </div>
                            <div class="flex-grow-1">
                                <div class="small text-muted">Address Line 2</div>
                                <div id="agency-address2"></div>
                            </div>
                        </div>
                        <div class="d-flex">
                            <div class="flex-shrink-0 text-muted me-3">
                                <i class="fas fa-city"></i>
                            </div>
                            <div class="flex-grow-1">
                                <div class="small text-muted">City/State/Zip</div>
                                <div id="agency-location"></div>
                            </div>
                        </div>
                    </div>

                    <div class="mb-0">
                        <h6 class="fw-bold mb-3 text-uppercase text-sm text-muted">Contact Information</h6>
                        <div class="d-flex mb-3">
                            <div class="flex-shrink-0 text-muted me-3">
                                <i class="fas fa-user"></i>
                            </div>
                            <div class="flex-grow-1">
                                <div class="small text-muted">Contact Person</div>
                                <div id="agency-contact-person"></div>
                            </div>
                        </div>
                        <div class="d-flex mb-3">
                            <div class="flex-shrink-0 text-muted me-3">
                                <i class="fas fa-phone-alt"></i>
                            </div>
                            <div class="flex-grow-1">
                                <div class="small text-muted">Landline</div>
                                <div id="agency-landline"></div>
                            </div>
                        </div>
                    </div>

                    <div class="mt-4">
                        <h6 class="fw-bold mb-3 text-uppercase text-sm text-muted">Account Information</h6>
                        <div class="d-flex mb-3">
                            <div class="flex-shrink-0 text-muted me-3">
                                <i class="fas fa-calendar-plus"></i>
                            </div>
                            <div class="flex-grow-1">
                                <div class="small text-muted">Created At</div>
                                <div id="agency-created"></div>
                            </div>
                        </div>
                        <div class="d-flex">
                            <div class="flex-shrink-0 text-muted me-3">
                                <i class="fas fa-calendar-check"></i>
                            </div>
                            <div class="flex-grow-1">
                                <div class="small text-muted">Last Updated</div>
                                <div id="agency-updated"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer border-0 bg-light">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                        <i class="fas fa-times me-1"></i> Close
                    </button>
                   
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
<script>
$(document).ready(function() {
    // Initialize Bootstrap tabs
    const tabElms = document.querySelectorAll('button[data-bs-toggle="tab"]');
    tabElms.forEach(tabEl => {
        tabEl.addEventListener('shown.bs.tab', function (event) {
            // Reload DataTables when tab is shown
            const target = event.target.getAttribute('data-bs-target');
            if (target === '#manage') {
                manageAgenciesTable.ajax.reload();
            } else if (target === '#new') {
                newApplicationsTable.ajax.reload();
            } else if (target === '#inactive') {
                inactiveAgenciesTable.ajax.reload();
            }
        });
    });

    // Show register tab when "Register New Agency" button is clicked
    $('#show-register-tab').click(function(e) {
        e.preventDefault();
        const registerTab = new bootstrap.Tab(document.getElementById('register-tab'));
        registerTab.show();
    });

    // Password toggle functionality
    function togglePassword(fieldId) {
        const field = document.getElementById(fieldId);
        const icon = field.nextElementSibling.querySelector('i');
        if (field.type === "password") {
            field.type = "text";
            icon.classList.remove('fa-eye');
            icon.classList.add('fa-eye-slash');
        } else {
            field.type = "password";
            icon.classList.remove('fa-eye-slash');
            icon.classList.add('fa-eye');
        }
    }

    // Initialize DataTables
    const manageAgenciesTable = $('#manage-agencies-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('agency.getAgencies') }}",
        columns: [
            { data: 'name', name: 'name' },
            { data: 'email', name: 'email' },
            { data: 'phone', name: 'phone' },
{ 
    data: 'status', 
    name: 'status',
    render: function(data, type, row) {
        let badgeClass = 'badge-warning';
        if (data === 'approved') badgeClass = 'badge-success';
        if (data === 'active') badgeClass = 'badge-primary';
        if (data === 'in_active' || data === 'rejected') badgeClass = 'badge-danger';
        
        return `
            <div class="d-flex align-items-center">
                <select class="status-select form-select form-select-sm" data-id="${row.id}">
                    <option value="active" ${data === 'active' ? 'selected' : ''}>Active</option>
                    <option value="in_active" ${data === 'in_active' ? 'selected' : ''}>Inactive</option>
                </select>
                <span></span>
            </div>
        `;
    }
},            { data: 'created_at', name: 'created_at' },
            { 
                data: 'action', 
                name: 'action', 
                orderable: false, 
                searchable: false,
                className: 'text-end'
            }
        ],
        order: [[0, 'desc']],
        pageLength: 10,
        responsive: true,
        language: {
            emptyTable: 'No agencies found',
            info: 'Showing _START_ to _END_ of _TOTAL_ agencies',
            infoEmpty: 'Showing 0 to 0 of 0 agencies',
            infoFiltered: '(filtered from _MAX_ total agencies)',
            lengthMenu: 'Show _MENU_ agencies',
            search: '_INPUT_',
            searchPlaceholder: 'Search agencies...',
            zeroRecords: 'No matching agencies found'
        },
        dom: '<"top"<"row"<"col-md-6"l><"col-md-6"f>>>rt<"bottom"<"row"<"col-md-6"i><"col-md-6"p>>>'
    });

    const newApplicationsTable = $('#new-applications-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('agency.getNewApplications') }}",
        columns: [
            { data: 'name', name: 'name' },
            { data: 'email', name: 'email' },
            { data: 'phone', name: 'phone' },
{ 
    data: 'status', 
    name: 'status',
    render: function(data, type, row) {
        let badgeClass = 'badge-warning';
        if (data === 'approved') badgeClass = 'badge-success';
        if (data === 'active') badgeClass = 'badge-primary';
        if (data === 'in_active' || data === 'rejected') badgeClass = 'badge-danger';
        
        return `
             <div class="d-flex align-items-center">
                        <select class="status-select form-select form-select-sm" data-id="${row.id}">
                            <option value="active" ${data === 'approved' || data === 'active' ? 'selected' : ''}>Approve</option>
                            <option value="pending" ${data === 'pending' ? 'selected' : ''}>Pending Approval</option>
                        </select>
                                              <span</span>

                    </div>
        `;
    }
},             { data: 'created_at', name: 'created_at' },
            { 
                data: 'action', 
                name: 'action', 
                orderable: false, 
                searchable: false,
                className: 'text-end'
            }
        ],
        order: [[0, 'desc']],
        pageLength: 10,
        responsive: true,
        language: {
            emptyTable: 'No new applications found',
            info: 'Showing _START_ to _END_ of _TOTAL_ applications',
            infoEmpty: 'Showing 0 to 0 of 0 applications',
            infoFiltered: '(filtered from _MAX_ total applications)',
            lengthMenu: 'Show _MENU_ applications',
            search: '_INPUT_',
            searchPlaceholder: 'Search applications...',
            zeroRecords: 'No matching applications found'
        },
        dom: '<"top"<"row"<"col-md-6"l><"col-md-6"f>>>rt<"bottom"<"row"<"col-md-6"i><"col-md-6"p>>>'
    });

    const inactiveAgenciesTable = $('#inactive-agencies-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('agency.getInactiveAgencies') }}",
        columns: [
            { data: 'name', name: 'name' },
            { data: 'email', name: 'email' },
            { data: 'phone', name: 'phone' },
{ 
    data: 'status', 
    name: 'status',
    render: function(data, type, row) {
        let badgeClass = 'badge-warning';
        if (data === 'approved') badgeClass = 'badge-success';
        if (data === 'active') badgeClass = 'badge-primary';
        if (data === 'in_active' || data === 'rejected') badgeClass = 'badge-danger';
        
        return `
            <div class="d-flex align-items-center">
                <select class="status-select form-select form-select-sm" data-id="${row.id}">
                    <option value="active" ${data === 'active' ? 'selected' : ''}>Active</option>
                    <option value="in_active" ${data === 'in_active' ? 'selected' : ''}>Inactive</option>
                </select>
                <span ></span>
            </div>
        `;
    }
},             { data: 'created_at', name: 'created_at' },
            { 
                data: 'action', 
                name: 'action', 
                orderable: false, 
                searchable: false,
                className: 'text-end'
            }
        ],
        order: [[0, 'desc']],
        pageLength: 10,
        responsive: true,
        language: {
            emptyTable: 'No inactive agencies found',
            info: 'Showing _START_ to _END_ of _TOTAL_ agencies',
            infoEmpty: 'Showing 0 to 0 of 0 agencies',
            infoFiltered: '(filtered from _MAX_ total agencies)',
            lengthMenu: 'Show _MENU_ agencies',
            search: '_INPUT_',
            searchPlaceholder: 'Search agencies...',
            zeroRecords: 'No matching agencies found'
        },
        dom: '<"top"<"row"<"col-md-6"l><"col-md-6"f>>>rt<"bottom"<"row"<"col-md-6"i><"col-md-6"p>>>'
    });

   // View agency details
$(document).on('click', '.view-btn', function() {
    const agencyId = $(this).data('id');
    
    $.ajax({
        url: "{{ route('agency.show', '') }}/" + agencyId,
        type: 'GET',
        success: function(response) {
            if (response.success) {
                const agency = response.data;
                
                // Create modal from template
                const modalHtml = $('#modal-template').html();
                const $modal = $(modalHtml).appendTo('body');
                
                // Populate modal with data
                $modal.find('#agency-name').text(agency.name);
                $modal.find('#agency-reg-no').text(agency.register_number);
                $modal.find('#agency-email').text(agency.email);
                $modal.find('#agency-phone').text(agency.phone);
                
                // Set status badge
                let statusClass = 'badge-warning';
                if (agency.status === 'Approved') statusClass = 'badge-success';
                if (agency.status === 'Inactive') statusClass = 'badge-danger';
                $modal.find('#agency-status').text(agency.status).addClass(statusClass);
                
                $modal.find('#agency-address1').text(agency.address_line1);
                $modal.find('#agency-address2').text(agency.address_line2 || 'N/A');
                $modal.find('#agency-location').text(`${agency.city}, ${agency.state} ${agency.zipcode}`);
                $modal.find('#agency-contact-person').text(agency.contact_person);
                $modal.find('#agency-landline').text(agency.landline || 'N/A');
                $modal.find('#agency-created').text(new Date(agency.created_at).toLocaleString());
                $modal.find('#agency-updated').text(new Date(agency.updated_at).toLocaleString());
                
                // Set edit button href
                $modal.find('#edit-agency-btn').attr('href', `/agency/${agencyId}/edit`);
                
                // Initialize and show modal
                const modal = new bootstrap.Modal($modal[0]);
                modal.show();
                
                // Remove modal from DOM after it's hidden
                $modal.on('hidden.bs.modal', function () {
                    $(this).remove();
                });
            }
        },
        error: function(xhr) {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Failed to load agency details',
                timer: 2000,
                showConfirmButton: false
            });
        }
    });
});
// Status update handler
$(document).on('change', '.status-select', function() {
    const select = $(this);
    const agencyId = select.data('id');
    const newStatus = select.val();
    
    Swal.fire({
        title: 'Confirm Status Change',
        text: `Are you sure you want to change status to ${newStatus}?`,
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#000',
        cancelButtonColor: '#6c757d',
        confirmButtonText: 'Update',
        cancelButtonText: 'Cancel'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: `https://spiderdesk.asia/listr/agency/${agencyId}/update-status`,
                type: 'POST',
                data: {
                    status: newStatus,
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    if (response.success) {
                        // Reload all tables to reflect changes
                        manageAgenciesTable.ajax.reload(null, false);
                        newApplicationsTable.ajax.reload(null, false);
                        inactiveAgenciesTable.ajax.reload(null, false);
                        
                        Swal.fire({
                            icon: 'success',
                            title: 'Updated!',
                            text: response.message,
                            timer: 1500,
                            showConfirmButton: false
                        });
                    }
                },
                error: function() {
                    Swal.fire('Error', 'Failed to update status', 'error');
                    select.val(select.data('previous-value')); // Revert on error
                }
            });
        } else {
            select.val(select.data('previous-value')); // Revert if cancelled
        }
    });
});

    // Delete agency
    $(document).on('click', '.delete-btn', function() {
        const agencyId = $(this).data('id');
        
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
                    url: "{{ route('agency.destroy', '') }}/" + agencyId,
                    type: 'DELETE',
                    data: {
                        _token: "{{ csrf_token() }}"
                    },
                    success: function(response) {
                        if (response.success) {
                            manageAgenciesTable.ajax.reload(null, false);
                            Swal.fire({
                                icon: 'success',
                                title: 'Deleted!',
                                text: response.message,
                                timer: 2000,
                                showConfirmButton: false
                            });
                        }
                    },
                    error: function(xhr) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error!',
                            text: 'Something went wrong.',
                            timer: 2000,
                            showConfirmButton: false
                        });
                    }
                });
            }
        });
    });

    // Approve agency
    $(document).on('click', '.approve-btn', function() {
        const agencyId = $(this).data('id');
        
        Swal.fire({
            title: 'Approve Agency?',
            text: "This agency will be approved and activated.",
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#28a745',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Yes, approve it!',
            cancelButtonText: 'Cancel',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "{{ route('agency.approve', '') }}/" + agencyId,
                    type: 'POST',
                    data: {
                        _token: "{{ csrf_token() }}"
                    },
                    success: function(response) {
                        if (response.success) {
                            newApplicationsTable.ajax.reload(null, false);
                            manageAgenciesTable.ajax.reload(null, false);
                            Swal.fire({
                                icon: 'success',
                                title: 'Approved!',
                                text: response.message,
                                timer: 2000,
                                showConfirmButton: false
                            });
                        }
                    },
                    error: function(xhr) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error!',
                            text: 'Something went wrong.',
                            timer: 2000,
                            showConfirmButton: false
                        });
                    }
                });
            }
        });
    });

    // Reject agency
    $(document).on('click', '.reject-btn', function() {
        const agencyId = $(this).data('id');
        
        Swal.fire({
            title: 'Reject Agency?',
            text: "This agency application will be rejected.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#dc3545',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Yes, reject it!',
            cancelButtonText: 'Cancel',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "{{ route('agency.reject', '') }}/" + agencyId,
                    type: 'POST',
                    data: {
                        _token: "{{ csrf_token() }}"
                    },
                    success: function(response) {
                        if (response.success) {
                            newApplicationsTable.ajax.reload(null, false);
                            Swal.fire({
                                icon: 'success',
                                title: 'Rejected!',
                                text: response.message,
                                timer: 2000,
                                showConfirmButton: false
                            });
                        }
                    },
                    error: function(xhr) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error!',
                            text: 'Something went wrong.',
                            timer: 2000,
                            showConfirmButton: false
                        });
                    }
                });
            }
        });
    });

    // Activate agency
    $(document).on('click', '.activate-btn', function() {
        const agencyId = $(this).data('id');
        
        Swal.fire({
            title: 'Activate Agency?',
            text: "This agency will be activated and marked as approved.",
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#28a745',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Yes, activate it!',
            cancelButtonText: 'Cancel',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "{{ route('agency.activate', '') }}/" + agencyId,
                    type: 'POST',
                    data: {
                        _token: "{{ csrf_token() }}"
                    },
                    success: function(response) {
                        if (response.success) {
                            inactiveAgenciesTable.ajax.reload(null, false);
                            manageAgenciesTable.ajax.reload(null, false);
                            Swal.fire({
                                icon: 'success',
                                title: 'Activated!',
                                text: response.message,
                                timer: 2000,
                                showConfirmButton: false
                            });
                        }
                    },
                    error: function(xhr) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error!',
                            text: 'Something went wrong.',
                            timer: 2000,
                            showConfirmButton: false
                        });
                    }
                });
            }
        });
    });

    // Handle form submission
    $('#agency-registration-form').submit(function(e) {
        e.preventDefault();
        
        const form = $(this);
        const submitBtn = form.find('button[type="submit"]');
        const originalBtnText = submitBtn.html();
        
        submitBtn.prop('disabled', true).html('<i class="fas fa-spinner fa-spin"></i> Processing...');
        
        $.ajax({
            url: form.attr('action'),
            type: 'POST',
            data: form.serialize(),
            success: function(response) {
                Swal.fire({
                    icon: 'success',
                    title: 'Success!',
                    text: response.message || 'Agency registered successfully',
                    timer: 2000,
                    showConfirmButton: false
                }).then(() => {
                    // Reset form
                    form.trigger('reset');
                    // Reload tables
                    manageAgenciesTable.ajax.reload();
                    newApplicationsTable.ajax.reload();
                    // Switch to manage tab
                    const manageTab = new bootstrap.Tab(document.getElementById('manage-tab'));
                    manageTab.show();
                });
            },
            error: function(xhr) {
                let errorMessage = 'Something went wrong. Please try again.';
                if (xhr.responseJSON && xhr.responseJSON.errors) {
                    errorMessage = '';
                    const errors = xhr.responseJSON.errors;
                    for (const key in errors) {
                        errorMessage += errors[key][0] + '\n';
                    }
                }
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: errorMessage,
                    timer: 3000,
                    showConfirmButton: false
                });
            },
            complete: function() {
                submitBtn.prop('disabled', false).html(originalBtnText);
            }
        });
    });
});
</script>
@endsection