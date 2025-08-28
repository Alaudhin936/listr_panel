@extends('agencylayout.master')

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
	.dataTables_length select {
    -webkit-appearance: auto !important;
    -moz-appearance: auto !important;
    appearance: auto !important;
    background-image: none !important; /* Remove any custom arrow */
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
                                    <i class="fas fa-users me-2"></i>Agent Management
                                </h4>
                                <a href="{{ route('agency.agents.create') }}" class="btn btn-primary">
                                    <i class="fas fa-plus me-1"></i> Add New Agent
                                </a>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="agents-table" class="table table-hover" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>Phone</th>
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
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.datatables.net/1.13.8/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.8/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.5.0/js/responsive.bootstrap5.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
$(document).ready(function() {
    // Initialize DataTable
    const table = $('#agents-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('agency.agents.index') }}",
        columns: [
            { data: 'name', name: 'name' },
            { data: 'email', name: 'email' },
            { data: 'phone', name: 'phone' },
            { data: 'status_badge', name: 'status' },
            { data: 'created_at', name: 'created_at' },
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
            emptyTable: 'No agents found',
            info: 'Showing _START_ to _END_ of _TOTAL_ agents',
            infoEmpty: 'Showing 0 to 0 of 0 agents',
            infoFiltered: '(filtered from _MAX_ total agents)',
            lengthMenu: 'Show _MENU_ agents',
            search: '_INPUT_',
            searchPlaceholder: 'Search agents...',
            zeroRecords: 'No matching agents found'
        },
        dom: '<"top"<"row"<"col-md-6"l><"col-md-6"f>>>rt<"bottom"<"row"<"col-md-6"i><"col-md-6"p>>>'
    });

    // View agent details
    $(document).on('click', '.view-btn', function() {
        const agentId = $(this).data('id');
        
        $.ajax({
            url: "{{ route('agency.agents.show', '') }}/" + agentId,
            type: 'GET',
            success: function(response) {
                if (response.success) {
                    const agent = response.data;
                    
                    // Create modal content
const modalContent = `
<div class="modal fade" id="agentDetailsModal" tabindex="-1" aria-hidden="true">
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
                        <h5 class="modal-title mb-0 fw-bold text-dark">Agent Details</h5>
                    </div>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <div class="mb-4">
                    <h6 class="fw-bold mb-3 text-uppercase text-sm text-muted">Personal Information</h6>
                    <div class="d-flex mb-3">
                        <div class="flex-shrink-0 text-muted me-3">
                            <i class="fas fa-user"></i>
                        </div>
                        <div class="flex-grow-1">
                            <div class="small text-muted">Full Name</div>
                            <div>${agent.name}</div>
                        </div>
                    </div>
                    <div class="d-flex mb-3">
                        <div class="flex-shrink-0 text-muted me-3">
                            <i class="fas fa-envelope"></i>
                        </div>
                        <div class="flex-grow-1">
                            <div class="small text-muted">Email</div>
                            <div>${agent.email}</div>
                        </div>
                    </div>
                    <div class="d-flex mb-3">
                        <div class="flex-shrink-0 text-muted me-3">
                            <i class="fas fa-phone"></i>
                        </div>
                        <div class="flex-grow-1">
                            <div class="small text-muted">Phone</div>
                            <div>${agent.phone}</div>
                        </div>
                    </div>
                    <div class="d-flex">
                        <div class="flex-shrink-0 text-muted me-3">
                            <i class="fas fa-info-circle"></i>
                        </div>
                        <div class="flex-grow-1">
                            <div class="small text-muted">Status</div>
                            <span class="badge ${agent.status === 'Active' ? 'bg-success' : 'bg-warning'}">
                                ${agent.status}
                            </span>
                        </div>
                    </div>
                </div>

                <div class="mb-4">
                   
                    <div class="d-flex">
                        <div class="flex-shrink-0 text-muted me-3">
                            <i class="fas fa-city"></i>
                        </div>
                        <div class="flex-grow-1">
                            <div class="small text-muted">City/State/Zip</div>
                            <div>${agent.city}, ${agent.state} ${agent.zipcode}</div>
                        </div>
                    </div>
                </div>

                <div class="mb-0">
                    <h6 class="fw-bold mb-3 text-uppercase text-sm text-muted">Account Information</h6>
                    <div class="d-flex mb-3">
                        <div class="flex-shrink-0 text-muted me-3">
                            <i class="fas fa-calendar-plus"></i>
                        </div>
                        <div class="flex-grow-1">
                            <div class="small text-muted">Created At</div>
                            <div>${agent.created_at}</div>
                        </div>
                    </div>
                    <div class="d-flex">
                        <div class="flex-shrink-0 text-muted me-3">
                            <i class="fas fa-calendar-check"></i>
                        </div>
                        <div class="flex-grow-1">
                            <div class="small text-muted">Last Updated</div>
                            <div>${agent.updated_at}</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer border-0 bg-light">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                    <i class="fas fa-times me-1"></i> Close
                </button>
                <a href="{{ route('agency.agents.edit', '') }}/${agent.id}" class="btn btn-primary">
                    <i class="fas fa-edit me-1"></i> Edit Agent
                </a>
            </div>
        </div>
    </div>
</div>
`;

                    // Append modal to body and show it
                    $('body').append(modalContent);
                    const modal = new bootstrap.Modal(document.getElementById('agentDetailsModal'));
                    modal.show();
                    
                    // Remove modal from DOM after it's hidden
                    $('#agentDetailsModal').on('hidden.bs.modal', function () {
                        $(this).remove();
                    });
                }
            },
            error: function(xhr) {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Failed to load agent details',
                    timer: 2000,
                    showConfirmButton: false
                });
            }
        });
    });

    // Delete agent
    $(document).on('click', '.delete-btn', function() {
        const agentId = $(this).data('id');
        
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
                    url: "{{ route('agency.agents.destroy', '') }}/" + agentId,
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
});
</script>
@endsection