

<?php $__env->startSection('main_content'); ?>
<div class="container-fluid">
    <div class="card-header pb-0 p-3 d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="fw-bold text-dark mb-1">
                <i class="mdi mdi-account-hard-hat me-3 text-primary"></i>Trade Persons Management
            </h3>
        </div>
        <button type="button" class="btn btn-primary btn-lg px-4 shadow-sm" data-bs-toggle="modal" data-bs-target="#tradePersonModal">
            <i class="mdi mdi-plus me-2"></i>Add New Trade Person
        </button>
    </div>

    <!-- Success/Error Messages -->
    <div id="alert-container"></div>

    <!-- Trade Persons Grid -->
    <div class="row g-4" id="trade-persons-container">
        <?php $__empty_1 = true; $__currentLoopData = $tradePersons; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tradePerson): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
        <div class="col-lg-6 col-xl-4" id="trade-person-card-<?php echo e($tradePerson->id); ?>">
            <div class="card trade-person-card h-100 shadow-sm border-0">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <div class="flex-grow-1">
                            <h5 class="card-title mb-2 fw-bold text-dark"><?php echo e($tradePerson->name); ?></h5>
                            <span class="badge badge-profession fs-6 px-3 py-2 rounded-pill">
                                <i class="mdi mdi-hammer-wrench me-1"></i>
                                <?php echo e($tradePerson->profession); ?>

                            </span>
                        </div>
                        <div class="dropdown">
                            <button class="btn btn-light btn-sm rounded-circle p-2 shadow-sm dropdown-toggle-custom" 
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="mdi mdi-dots-vertical text-muted"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu-end shadow border-0 py-2">
                                <a href="javascript:void(0);" class="dropdown-item edit-trade-person px-3 py-2" 
                                   data-id="<?php echo e($tradePerson->id); ?>"
                                   data-name="<?php echo e($tradePerson->name); ?>"
                                   data-profession="<?php echo e($tradePerson->profession); ?>"
                                   data-email="<?php echo e($tradePerson->email); ?>"
                                   data-phone="<?php echo e($tradePerson->phone); ?>">
                                    <i class="mdi mdi-pencil me-2 text-primary"></i>
                                    <span class="fw-medium">Edit</span>
                                </a>
                                <a href="javascript:void(0);" class="dropdown-item toggle-status px-3 py-2" 
                                   data-id="<?php echo e($tradePerson->id); ?>">
                                    <i class="mdi <?php echo e($tradePerson->is_active ? 'mdi-eye-off me-2 text-warning' : 'mdi-eye me-2 text-success'); ?>"></i>
                                    <span class="fw-medium"><?php echo e($tradePerson->is_active ? 'Deactivate' : 'Activate'); ?></span>
                                </a>
                                <hr class="dropdown-divider my-2">
                                <a href="javascript:void(0);" class="dropdown-item delete-trade-person px-3 py-2 text-danger" 
                                   data-id="<?php echo e($tradePerson->id); ?>">
                                    <i class="mdi mdi-delete me-2"></i>
                                    <span class="fw-medium">Delete</span>
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="mb-3 p-3 bg-light rounded">
                        <div class="d-flex align-items-center mb-2">
                            <i class="mdi mdi-email-outline me-2 text-primary"></i>
                            <small class="text-muted fw-medium">EMAIL</small>
                        </div>
                        <p class="mb-0 fw-medium text-dark"><?php echo e($tradePerson->email); ?></p>
                    </div>

                    <div class="mb-4 p-3 bg-light rounded">
                        <div class="d-flex align-items-center mb-2">
                            <i class="mdi mdi-phone me-2 text-info"></i>
                            <small class="text-muted fw-medium">PHONE</small>
                        </div>
                        <p class="mb-0 fw-medium text-dark"><?php echo e($tradePerson->phone); ?></p>
                    </div>

                    <div class="d-flex justify-content-between align-items-center pt-3 border-top">
                        <div>
                            <span class="badge <?php echo e($tradePerson->is_active ? 'badge-success-soft' : 'badge-warning-soft'); ?> px-3 py-2 rounded-pill">
                                <i class="mdi <?php echo e($tradePerson->is_active ? 'mdi-check-circle' : 'mdi-clock'); ?> me-1"></i>
                                <?php echo e($tradePerson->is_active ? 'Active' : 'Inactive'); ?>

                            </span>
                        </div>
                        <small class="text-muted">
                            <i class="mdi mdi-calendar me-1"></i>
                            <?php echo e($tradePerson->created_at->diffForHumans()); ?>

                        </small>
                    </div>
                </div>
            </div>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-body text-center py-5">
                    <div class="empty-state">
                        <i class="mdi mdi-account-hard-hat display-1 text-muted mb-4"></i>
                        <h4 class="fw-bold text-dark mb-2">No Trade Persons Found</h4>
                        <p class="text-muted mb-4 lead">Add your first trade person to get started</p>
                        <button type="button" class="btn btn-primary btn-lg px-5 shadow-sm" data-bs-toggle="modal" data-bs-target="#tradePersonModal">
                            <i class="mdi mdi-plus me-2"></i>Add First Trade Person
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <?php endif; ?>
    </div>
</div>

<!-- Trade Person Modal -->
<div class="modal fade" id="tradePersonModal" tabindex="-1" aria-labelledby="tradePersonModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            <form id="tradePersonForm">
                <?php echo csrf_field(); ?>
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title fw-bold" id="tradePersonModalLabel">
                        <i class="mdi mdi-plus-circle me-2"></i>Add New Trade Person
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">
                    <input type="hidden" id="trade_person_id" name="trade_person_id">
                    <input type="hidden" id="form_method" value="POST">
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="trade_person_name" class="form-label fw-bold">
                                    <i class="mdi mdi-account me-1 text-primary"></i>Name 
                                    <span class="text-danger">*</span>
                                </label>
                                <input type="text" class="form-control form-control-lg" id="trade_person_name" name="name" required>
                                <div class="invalid-feedback" id="name-error"></div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="trade_person_profession" class="form-label fw-bold">
                                    <i class="mdi mdi-hammer-wrench me-1 text-primary"></i>Profession 
                                    <span class="text-danger">*</span>
                                </label>
                                <input type="text" class="form-control form-control-lg" id="trade_person_profession" name="profession" required>
                                <div class="invalid-feedback" id="profession-error"></div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="trade_person_email" class="form-label fw-bold">
                                    <i class="mdi mdi-email me-1 text-primary"></i>Email 
                                    <span class="text-danger">*</span>
                                </label>
                                <input type="email" class="form-control form-control-lg" id="trade_person_email" name="email" required>
                                <div class="invalid-feedback" id="email-error"></div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="trade_person_phone" class="form-label fw-bold">
                                    <i class="mdi mdi-phone me-1 text-primary"></i>Phone 
                                    <span class="text-danger">*</span>
                                </label>
                                <input type="text" class="form-control form-control-lg" id="trade_person_phone" name="phone" required>
                                <div class="invalid-feedback" id="phone-error"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer bg-light p-4">
                    <button type="button" class="btn btn-secondary btn-lg px-4" data-bs-dismiss="modal">
                        <i class="mdi mdi-close me-1"></i>Cancel
                    </button>
                    <button type="submit" class="btn btn-primary btn-lg px-5 shadow-sm">
                        <span class="spinner-border spinner-border-sm d-none me-2" id="submit-spinner"></span>
                        <i class="mdi mdi-check me-1" id="submit-icon"></i>
                        <span id="submit-text">Save Trade Person</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Ensure Material Design Icons are loaded -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@mdi/font@6.9.96/css/materialdesignicons.min.css">

<script>
$(document).ready(function() {
    // Initialize tooltips
    $('[data-bs-toggle="tooltip"]').tooltip();

    $('#tradePersonForm').submit(function(e) {
        e.preventDefault();
        
        const formData = $(this).serialize();
        const isEdit = $('#trade_person_id').val();
        const url = isEdit ? "<?php echo e(route('agent.trade-persons.update', ':id')); ?>".replace(':id', $('#trade_person_id').val()) : "<?php echo e(route('agent.trade-persons.store')); ?>";
        const method = isEdit ? 'PUT' : 'POST';
        
        // Show loading state
        $('#submit-spinner').removeClass('d-none');
        $('#submit-icon').addClass('d-none');
        $('#submit-text').text(isEdit ? 'Updating...' : 'Saving...');
        $('button[type="submit"]').prop('disabled', true);
        
        // Clear previous errors
        $('.is-invalid').removeClass('is-invalid');
        $('.invalid-feedback').text('');

        $.ajax({
            url: url,
            method: method,
            data: formData,
            success: function(response) {
                if (response.success) {
                    showAlert('success', response.message);
                    $('#tradePersonModal').modal('hide');
                    
                    // Reload page to show updated trade persons
                    setTimeout(() => {
                        location.reload();
                    }, 1000);
                }
            },
            error: function(xhr) {
                const errors = xhr.responseJSON?.errors || {};
                
                // Display field errors
                Object.keys(errors).forEach(field => {
                    $(`#trade_person_${field}`).addClass('is-invalid');
                    $(`#${field}-error`).text(errors[field][0]);
                });
                
                showAlert('danger', xhr.responseJSON?.message || 'An error occurred');
            },
            complete: function() {
                // Hide loading state
                $('#submit-spinner').addClass('d-none');
                $('#submit-icon').removeClass('d-none');
                $('#submit-text').text($('#trade_person_id').val() ? 'Update Trade Person' : 'Save Trade Person');
                $('button[type="submit"]').prop('disabled', false);
            }
        });
    });

    // Handle edit trade person
    $(document).on('click', '.edit-trade-person', function() {
        const data = $(this).data();
        
        $('#trade_person_id').val(data.id);
        $('#trade_person_name').val(data.name);
        $('#trade_person_profession').val(data.profession);
        $('#trade_person_email').val(data.email);
        $('#trade_person_phone').val(data.phone);
        
        $('#tradePersonModalLabel').html('<i class="mdi mdi-pencil me-2"></i>Edit Trade Person');
        $('#submit-text').text('Update Trade Person');
        $('#tradePersonModal').modal('show');
    });

    // Handle delete trade person
    $(document).on('click', '.delete-trade-person', function() {
        const tradePersonId = $(this).data('id');
        
        if (confirm('🗑️ Are you sure you want to delete this trade person?\n\nThis action cannot be undone.')) {
            $.ajax({
                url: "<?php echo e(route('agent.trade-persons.destroy', ':id')); ?>".replace(':id', tradePersonId),
                method: 'DELETE',
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    if (response.success) {
                        showAlert('success', response.message);
                        $(`#trade-person-card-${tradePersonId}`).fadeOut(300, function() {
                            $(this).remove();
                        });
                    }
                },
                error: function(xhr) {
                    showAlert('danger', xhr.responseJSON?.message || 'An error occurred');
                }
            });
        }
    });

    // Handle toggle status
    $(document).on('click', '.toggle-status', function() {
        const tradePersonId = $(this).data('id');
        
        $.ajax({
            url: "<?php echo e(route('agent.trade-persons.toggle-status', ':id')); ?>".replace(':id', tradePersonId),
            method: 'PATCH',
            data: {
                _token: $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                if (response.success) {
                    showAlert('success', response.message);
                    // Reload to show updated status
                    setTimeout(() => {
                        location.reload();
                    }, 1000);
                }
            },
            error: function(xhr) {
                showAlert('danger', xhr.responseJSON?.message || 'An error occurred');
            }
        });
    });

    // Reset modal when closed
    $('#tradePersonModal').on('hidden.bs.modal', function() {
        $('#tradePersonForm')[0].reset();
        $('#trade_person_id').val('');
        $('#tradePersonModalLabel').html('<i class="mdi mdi-plus-circle me-2"></i>Add New Trade Person');
        $('#submit-text').text('Save Trade Person');
        $('.is-invalid').removeClass('is-invalid');
        $('.invalid-feedback').text('');
    });

    // Show alert function
    function showAlert(type, message) {
        const icons = {
            'success': 'mdi-check-circle',
            'danger': 'mdi-alert-circle',
            'warning': 'mdi-alert',
            'info': 'mdi-information'
        };
        
        const alertHtml = `
            <div class="alert alert-${type} alert-dismissible fade show shadow-sm border-0" role="alert">
                <i class="mdi ${icons[type]} me-2"></i>
                ${message}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        `;
        
        $('#alert-container').html(alertHtml);
        
        // Auto dismiss after 5 seconds
        setTimeout(() => {
            $('.alert').alert('close');
        }, 5000);
    }
});


</script>

<style>
.modal-backdrop.show {
    background-color: rgba(0, 0, 0, 0.15) !important;
}

/* Trade Person Cards */
.trade-person-card {
    transition: all 0.3s ease;
    border: 1px solid #e9ecef !important;
    border-radius: 12px;
}

.trade-person-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 30px rgba(0,0,0,0.15) !important;
    border-color: #007bff !important;
}

/* Custom Dropdown Button */
.dropdown-toggle-custom {
    border: none !important;
    background: #f8f9fa !important;
    transition: all 0.2s ease;
}

.dropdown-toggle-custom:hover {
    background: #e9ecef !important;
    transform: scale(1.05);
}

.dropdown-toggle-custom:focus {
    box-shadow: 0 0 0 3px rgba(0,123,255,0.25);
}

/* Dropdown Menu */
.dropdown-menu {
    border-radius: 10px;
    padding: 8px 0;
    min-width: 200px;
    box-shadow: 0 8px 25px rgba(0,0,0,0.15);
}

.dropdown-item {
    padding: 12px 16px;
    border-radius: 6px;
    margin: 2px 8px;
    transition: all 0.2s ease;
    font-size: 14px;
}

.dropdown-item:hover {
    background: #f8f9fa;
    transform: translateX(5px);
    color: #495057;
}

.dropdown-item.text-danger:hover {
    background: #fee;
    color: #dc3545;
}

/* Custom Badges */
.badge-profession {
    background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
    color: white;
    font-weight: 500;
}

.badge-success-soft {
    background: #d4edda;
    color: #155724;
    border: 1px solid #c3e6cb;
}

.badge-warning-soft {
    background: #fff3cd;
    color: #856404;
    border: 1px solid #ffeaa7;
}

/* Modal Enhancements */
.modal-content {
    border-radius: 15px;
    overflow: hidden;
}

.modal-header {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    border: none;
}

.form-control:focus, .form-select:focus {
    border-color: #667eea;
    box-shadow: 0 0 0 3px rgba(102,126,234,0.1);
}

.form-control-lg, .form-select-lg {
    padding: 12px 16px;
    font-size: 16px;
}

/* Button Enhancements */
.btn {
    border-radius: 8px;
    font-weight: 500;
    transition: all 0.3s ease;
}

.btn-primary {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    border: none;
    box-shadow: 0 4px 15px rgba(102,126,234,0.3);
}

.btn-primary:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(102,126,234,0.4);
}

.btn-lg {
    padding: 12px 24px;
    font-size: 16px;
}

/* Empty State */
.empty-state {
    padding: 40px 20px;
}

.empty-state i {
    opacity: 0.5;
}

/* Responsive */
@media (max-width: 768px) {
    .trade-person-card {
        margin-bottom: 20px;
    }
    
    .dropdown-menu {
        min-width: 180px;
    }
    
    .btn-lg {
        padding: 10px 20px;
        font-size: 14px;
    }
}

/* Loading Animation */
.spinner-border-sm {
    width: 1rem;
    height: 1rem;
}

/* Alert Enhancements */
.alert {
    border-radius: 10px;
    border: none;
    font-weight: 500;
}

.alert-success {
    background: linear-gradient(135deg, #d4edda 0%, #c3e6cb 100%);
    color: #155724;
}

.alert-danger {
    background: linear-gradient(135deg, #f8d7da 0%, #f5c6cb 100%);
    color: #721c24;
}

/* Ensure Material Design Icons display properly */
.mdi {
    display: inline-block;
    font: normal normal normal 24px/1 "Material Design Icons";
    font-size: inherit;
    text-rendering: auto;
    line-height: inherit;
    -webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;
}
</style>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\ADMIN\Desktop\listr\resources\views/agents/trade-person/index.blade.php ENDPATH**/ ?>