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
        border-radius: 0.5rem;
        margin-bottom: 1.5rem;
        background-color: #fff;
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }
    .card:hover {
        transform: translateY(-2px);
        box-shadow: 0 0.25rem 2rem 0 rgba(33, 40, 50, 0.1);
    }
    .card-header {
        background: #fff;
        border-bottom: 1px solid rgba(0, 0, 0, 0.05);
        border-radius: 0.5rem 0.5rem 0 0 !important;
        padding: 1.25rem 1.5rem;
        display: flex;
        justify-content: space-between;
        align-items: center;
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
    .plan-card {
        position: relative;
        border: 2px solid #f8f9fa;
        border-radius: 1rem;
        padding: 2rem;
        text-align: center;
        height: 100%;
        transition: all 0.3s ease;
        background: #000;
        color: #fff;
    }
    .plan-card:hover {
        border-color: #333;
        transform: translateY(-5px);
        box-shadow: 0 1rem 3rem rgba(33, 40, 50, 0.15);
    }
    .plan-card.featured {
        border-color: #fff;
        background: linear-gradient(135deg, #000 0%, #333 100%);
        color: #fff;
    }
    .plan-card.featured:hover {
        border-color: #fff;
    }
    .plan-type-badge {
        position: absolute;
        top: -10px;
        left: 50%;
        transform: translateX(-50%);
        background: #fff;
        color: #000;
        padding: 0.25rem 1rem;
        border-radius: 50px;
        font-size: 0.75rem;
        font-weight: 600;
        text-transform: uppercase;
    }
    .plan-card.featured .plan-type-badge {
        background: #000;
        color: #fff;
    }
    .plan-title {
        font-size: 1.5rem;
        font-weight: 700;
        margin: 1rem 0 0.5rem 0;
        color: #fff;
    }
    .plan-card.featured .plan-title {
        color: #fff;
    }
    .plan-price {
        font-size: 3rem;
        font-weight: 800;
        color: #fff;
        margin: 1rem 0;
        line-height: 1;
    }
    .plan-card.featured .plan-price {
        color: #fff;
    }
    .plan-currency {
        font-size: 1.2rem;
        font-weight: 600;
        vertical-align: top;
    }
    .plan-duration {
        color: #adb5bd;
        font-size: 0.9rem;
        margin-bottom: 2rem;
    }
    .plan-card.featured .plan-duration {
        color: #e9ecef;
    }
    .plan-feature {
        display: flex;
        align-items: center;
        margin-bottom: 0.75rem;
        font-size: 0.95rem;
    }
    .plan-feature i {
        color: #28a745;
        margin-right: 0.75rem;
        font-size: 0.8rem;
    }
    .plan-card.featured .plan-feature i {
        color: #90ff90;
    }
    .plan-actions {
        margin-top: 2rem;
        display: flex;
        gap: 0.5rem;
        justify-content: center;
        flex-wrap: wrap;
    }
    .btn-outline-dark {
        border-color: #fff;
        color: #fff;
        background: transparent;
    }
    .btn-outline-dark:hover {
        background-color: #fff;
        color: #000;
    }
    .btn-outline-light {
        border-color: #fff;
        color: #fff;
        background: transparent;
    }
    .btn-outline-light:hover {
        background-color: #fff;
        color: #000;
    }
    .status-active {
        color: #28a745;
        font-weight: 600;
    }
    .status-inactive {
        color: #dc3545;
        font-weight: 600;
    }
    .section-title {
        color: #212529;
        font-weight: 700;
        font-size: 2rem;
        margin: 2rem 0 1.5rem 0;
        text-align: center;
        position: relative;
    }
    .section-title::after {
        content: '';
        display: block;
        width: 60px;
        height: 3px;
        background: #000;
        margin: 0.5rem auto;
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
    .form-group {
        margin-bottom: 1.25rem;
    }
    .form-control {
        border: 1px solid #ced4da;
        border-radius: 0.375rem;
        padding: 0.5rem 0.75rem;
        transition: all 0.2s ease;
    }
    .form-control:focus {
        border-color: #000;
        box-shadow: 0 0 0 0.2rem rgba(0, 0, 0, 0.1);
    }
    .form-label {
        font-weight: 500;
        margin-bottom: 0.5rem;
        color: #495057;
    }
    .form-select {
        border: 1px solid #ced4da;
        border-radius: 0.375rem;
        padding: 0.5rem 0.75rem;
    }
    .form-select:focus {
        border-color: #000;
        box-shadow: 0 0 0 0.2rem rgba(0, 0, 0, 0.1);
    }
    .form-check-input:checked {
        background-color: #000;
        border-color: #000;
    }
    .empty-state {
        text-align: center;
        padding: 4rem 2rem;
        color: #6c757d;
    }
    .empty-state i {
        font-size: 4rem;
        margin-bottom: 1rem;
        opacity: 0.5;
    }
</style>

<div class="page-wrapper compact-wrapper" id="pageWrapper">
    <div class="page-body-wrapper">
        <div class="page-body1">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="hot-head1">
                                    <i class="fas fa-layer-group me-2"></i>Plan Management
                                </h4>
                                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#planModal">
                                    <i class="fas fa-plus me-1"></i> Create New Plan
                                </button>
                            </div>
                        </div>

                        <!-- Agency Plans Section -->
                        <h2 class="section-title">Agency Plans</h2>
                        <div class="row" id="agency-plans">
                            <!-- Agency plans will be loaded here -->
                        </div>

                        <!-- Agent Plans Section -->
                        <h2 class="section-title">Agent Plans</h2>
                        <div class="row" id="agent-plans">
                            <!-- Agent plans will be loaded here -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Plan Modal -->
<div class="modal fade" id="planModal" tabindex="-1" aria-labelledby="planModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="planModalLabel">Create New Plan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="planForm">
                    @csrf
                    <input type="hidden" id="plan_id" name="plan_id">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name" class="form-label">Plan Name</label>
                                <input type="text" class="form-control" id="name" name="name" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="type" class="form-label">Plan Type</label>
                                <select class="form-select" id="type" name="type" required>
                                    <option value="">Select Type</option>
                                    <option value="agency">Agency</option>
                                    <option value="agent">Agent</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="price" class="form-label">Price (AUD)</label>
                                <div class="input-group">
                                    <span class="input-group-text">A$</span>
                                    <input type="number" class="form-control" id="price" name="price" step="0.01" min="0" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="duration_days" class="form-label">Duration (Days)</label>
                                <input type="number" class="form-control" id="duration_days" name="duration_days" min="1" required>
                            </div>
                        </div>
                    </div>
                    <div class="form-group" id="max_agents_group">
                        <label for="max_agents" class="form-label">Maximum Agents (Leave empty for unlimited)</label>
                        <input type="number" class="form-control" id="max_agents" name="max_agents" min="0">
                    </div>
                    <div class="form-group">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="is_active" name="is_active" checked>
                            <label class="form-check-label" for="is_active">
                                Active Plan
                            </label>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" id="savePlanBtn">Save Plan</button>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
$(document).ready(function() {
    loadPlans();

    // Show/hide max_agents field based on plan type
    $('#type').change(function() {
        if ($(this).val() === 'agent') {
            $('#max_agents_group').hide();
            $('#max_agents').val('');
        } else {
            $('#max_agents_group').show();
        }
    });

    // Save plan
    $('#savePlanBtn').click(function() {
        const form = $('#planForm');
        const planId = $('#plan_id').val();
        const url = planId ? "{{ route('admin.plans.update', ['plan' => ':id']) }}".replace(':id', planId) : "{{ route('admin.plans.store') }}";
        const method = planId ? 'PUT' : 'POST';
        
        const formData = {
            name: $('#name').val(),
            type: $('#type').val(),
            price: $('#price').val(),
            duration_days: $('#duration_days').val(),
            max_agents: $('#max_agents').val() || null,
            is_active: $('#is_active').is(':checked') ? 1 : 0,
            _token: $('input[name="_token"]').val()
        };

        if (method === 'PUT') {
            formData._method = 'PUT';
        }

        $.ajax({
            url: url,
            type: 'POST',
            data: formData,
            success: function(response) {
                if (response.success) {
                    $('#planModal').modal('hide');
                    form.trigger('reset');
                    loadPlans();
                    Swal.fire({
                        icon: 'success',
                        title: 'Success!',
                        text: response.message,
                        timer: 2000,
                        showConfirmButton: false
                    });
                }
            },
            error: function(xhr) {
                let errorMessage = 'Something went wrong. Please try again.';
                if (xhr.responseJSON && xhr.responseJSON.errors) {
                    const errors = xhr.responseJSON.errors;
                    errorMessage = Object.values(errors).flat().join('\n');
                }
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: errorMessage,
                    showConfirmButton: true
                });
            }
        });
    });

    // Load plans
    function loadPlans() {
        $.get("{{ route('admin.plans.list') }}", function(response) {
            if (response.success) {
                renderPlans(response.data);
            }
        });
    }

    // Render plans
    function renderPlans(plans) {
        const agencyContainer = $('#agency-plans');
        const agentContainer = $('#agent-plans');
        
        agencyContainer.empty();
        agentContainer.empty();

        const agencyPlans = plans.filter(plan => plan.type === 'agency');
        const agentPlans = plans.filter(plan => plan.type === 'agent');

        if (agencyPlans.length === 0) {
            agencyContainer.html(`
                <div class="col-12">
                    <div class="empty-state">
                        <i class="fas fa-building"></i>
                        <h4>No Agency Plans</h4>
                        <p>Create your first agency plan to get started.</p>
                    </div>
                </div>
            `);
        } else {
            agencyPlans.forEach((plan, index) => {
                agencyContainer.append(createPlanCard(plan, index === 0));
            });
        }

        if (agentPlans.length === 0) {
            agentContainer.html(`
                <div class="col-12">
                    <div class="empty-state">
                        <i class="fas fa-user-tie"></i>
                        <h4>No Agent Plans</h4>
                        <p>Create your first agent plan to get started.</p>
                    </div>
                </div>
            `);
        } else {
            agentPlans.forEach((plan, index) => {
                agentContainer.append(createPlanCard(plan, index === 0));
            });
        }
    }

    // Create plan card HTML
    function createPlanCard(plan, isFeatured = false) {
        const featuredClass = isFeatured ? 'featured' : '';
        const statusClass = plan.is_active ? 'status-active' : 'status-inactive';
        const statusText = plan.is_active ? 'Active' : 'Inactive';
        const statusIcon = plan.is_active ? 'fas fa-check-circle' : 'fas fa-times-circle';
        
        const durationText = plan.duration_days === 30 ? '/ month' : 
                           plan.duration_days === 365 ? '/ year' : 
                           `/ ${plan.duration_days} days`;

        const maxAgentsFeature = plan.max_agents ? 
            `<div class="plan-feature"><i class="fas fa-check"></i> Up to ${plan.max_agents} agents</div>` : 
            `<div class="plan-feature"><i class="fas fa-check"></i> Unlimited agents</div>`;

        const editBtnClass = isFeatured ? 'btn-outline-light' : 'btn-outline-dark';
        const deleteBtnClass = isFeatured ? 'btn-outline-light' : 'btn-outline-dark';

        return `
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="plan-card ${featuredClass}">
                    <div class="plan-type-badge">${plan.type}</div>
                    <h3 class="plan-title">${plan.name}</h3>
                    <div class="plan-price">
                        <span class="plan-currency">A$</span>${parseFloat(plan.price).toFixed(2)}
                    </div>
                  
                    <div class="plan-features ">
                        <div class="plan-feature">
                            <i class="fas fa-check"></i> 
                            ${plan.duration_days} days access
                        </div>
                        ${plan.type === 'agency' ? maxAgentsFeature : ''}
                        <div class="plan-feature">
                            <i class="${statusIcon}"></i> 
                            Status: <span class="${statusClass}">${statusText}</span>
                        </div>
                    </div>

                    <div class="plan-actions">
                        <button class="btn btn-sm ${editBtnClass} edit-plan-btn" data-id="${plan.id}">
                            <i class="fas fa-edit"></i> Edit
                        </button>
                        <button class="btn btn-sm ${deleteBtnClass} delete-plan-btn" data-id="${plan.id}">
                            <i class="fas fa-trash"></i> Delete
                        </button>
                    </div>
                </div>
            </div>
        `;
    }

    // Edit plan
    $(document).on('click', '.edit-plan-btn', function() {
        const planId = $(this).data('id');
        
        $.get("{{ route('admin.plans.show', ['plan' => ':id']) }}".replace(':id', planId), function(response) {
            if (response.success) {
                const plan = response.data;
                
                $('#plan_id').val(plan.id);
                $('#name').val(plan.name);
                $('#type').val(plan.type);
                $('#price').val(plan.price);
                $('#duration_days').val(plan.duration_days);
                $('#max_agents').val(plan.max_agents || '');
                $('#is_active').prop('checked', plan.is_active);
                
                $('#planModalLabel').text('Edit Plan');
                
                // Show/hide max_agents field
                if (plan.type === 'agent') {
                    $('#max_agents_group').hide();
                } else {
                    $('#max_agents_group').show();
                }
                
                $('#planModal').modal('show');
            }
        });
    });

    // Delete plan
    $(document).on('click', '.delete-plan-btn', function() {
        const planId = $(this).data('id');
        
        Swal.fire({
            title: 'Are you sure?',
            text: "This action cannot be undone!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#000',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'Cancel'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "{{ route('admin.plans.destroy', ['plan' => ':id']) }}".replace(':id', planId),
                    type: 'DELETE',
                    data: {
                        _token: $('input[name="_token"]').val()
                    },
                    success: function(response) {
                        if (response.success) {
                            loadPlans();
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
                            text: 'Failed to delete plan.',
                            showConfirmButton: true
                        });
                    }
                });
            }
        });
    });

    // Reset modal on close
    $('#planModal').on('hidden.bs.modal', function() {
        $('#planForm').trigger('reset');
        $('#plan_id').val('');
        $('#planModalLabel').text('Create New Plan');
        $('#max_agents_group').show();
    });
});
</script>

@endsection