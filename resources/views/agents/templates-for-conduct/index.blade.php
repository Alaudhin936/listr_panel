@extends('layout.master')

@section('main_content')
<div class="container-fluid">
    <div class="card-header pb-0 p-3 d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="fw-bold text-dark mb-1">
                <i class="mdi mdi-file-document-multiple me-3 text-primary"></i>Template Management
            </h3>
        </div>
        <button type="button" class="btn btn-primary btn-lg px-4 shadow-sm" data-bs-toggle="modal" data-bs-target="#tempForConductModal">
            <i class="mdi mdi-plus me-2"></i>Add New Template
        </button>
    </div>

    <div id="alert-container"></div>

    <!-- Templates Grid -->
    <div class="row g-4" id="tempForConduct-container">
        @forelse($templates as $template)
        <div class="col-lg-6 col-xl-4" id="tempForConduct-card-{{ $template->id }}">
            <div class="card tempForConduct-card h-100 shadow-sm border-0">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <div class="flex-grow-1">
                            <h5 class="card-title mb-2 fw-bold text-dark">{{ $template->name }}</h5>
                            <span class="badge {{ $template->type === 'email' ? 'badge-email' : 'badge-sms' }} fs-6 px-3 py-2 rounded-pill">
                                <i class="mdi {{ $template->type === 'email' ? 'mdi-email' : 'mdi-message-text' }} me-1"></i>
                                {{ strtoupper($template->type) }}
                            </span>
                        </div>
                        <div class="dropdown">
                            <button class="btn btn-light btn-sm rounded-circle p-2 shadow-sm dropdown-toggle-custom" 
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="mdi mdi-dots-vertical text-muted"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu-end shadow border-0 py-2">
                                <a href="javascript:void(0);" class="dropdown-item edit-tempForConduct px-3 py-2" 
                                   data-id="{{ $template->id }}"
                                   data-name="{{ $template->name }}"
                                   data-type="{{ $template->type }}"
                                   data-content="{{ $template->content }}"
                                   data-subject="{{ $template->subject }}">
                                    <i class="mdi mdi-pencil me-2 text-primary"></i>
                                    <span class="fw-medium">Edit Template</span>
                                </a>
                                <a href="javascript:void(0);" class="dropdown-item toggle-status px-3 py-2" 
                                   data-id="{{ $template->id }}">
                                    <i class="mdi {{ $template->is_active ? 'mdi-eye-off me-2 text-warning' : 'mdi-eye me-2 text-success' }}"></i>
                                    <span class="fw-medium">{{ $template->is_active ? 'Deactivate' : 'Activate' }}</span>
                                </a>
                                <hr class="dropdown-divider my-2">
                                <a href="javascript:void(0);" class="dropdown-item delete-tempForConduct px-3 py-2 text-danger" 
                                   data-id="{{ $template->id }}">
                                    <i class="mdi mdi-delete me-2"></i>
                                    <span class="fw-medium">Delete Template</span>
                                </a>
                            </div>
                        </div>
                    </div>

                    @if($template->type === 'email' && $template->subject)
                    <div class="mb-3 p-3 bg-light rounded">
                        <div class="d-flex align-items-center mb-1">
                            <i class="mdi mdi-email-outline me-2 text-primary"></i>
                            <small class="text-muted fw-medium">SUBJECT</small>
                        </div>
                        <p class="mb-0 fw-medium text-dark">{{ Str::limit($template->subject, 50) }}</p>
                    </div>
                    @endif

                    <div class="mb-4">
                        <div class="d-flex align-items-center mb-2">
                            <i class="mdi mdi-text me-2 text-info"></i>
                            <small class="text-muted fw-medium">CONTENT PREVIEW</small>
                        </div>
                        <p class="mb-0 text-dark lh-base">{{ Str::limit($template->content, 120) }}</p>
                    </div>

                    <div class="d-flex justify-content-between align-items-center pt-3 border-top">
                        <div>
                            <span class="badge {{ $template->is_active ? 'badge-success-soft' : 'badge-warning-soft' }} px-3 py-2 rounded-pill">
                                <i class="mdi {{ $template->is_active ? 'mdi-check-circle' : 'mdi-clock' }} me-1"></i>
                                {{ $template->is_active ? 'Active' : 'Inactive' }}
                            </span>
                        </div>
                        <small class="text-muted">
                            <i class="mdi mdi-calendar me-1"></i>
                            {{ $template->created_at->diffForHumans() }}
                        </small>
                    </div>
                </div>
            </div>
        </div>
        @empty
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-body text-center py-5">
                    <div class="empty-state">
                        <i class="mdi mdi-email-outline display-1 text-muted mb-4"></i>
                        <h4 class="fw-bold text-dark mb-2">No Templates Found</h4>
                        <p class="text-muted mb-4 lead">Create your first template to get started with automated messaging</p>
                        <button type="button" class="btn btn-primary btn-lg px-5 shadow-sm" data-bs-toggle="modal" data-bs-target="#tempForConductModal">
                            <i class="mdi mdi-plus me-2"></i>Create First Template
                        </button>
                    </div>
                </div>
            </div>
        </div>
        @endforelse
    </div>
</div>

<!-- TempForConduct Modal -->
<div class="modal fade" id="tempForConductModal" tabindex="-1" aria-labelledby="tempForConductModalLabel" aria-hidden="true" >
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            <form id="tempForConductForm">
                @csrf
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title fw-bold" id="tempForConductModalLabel">
                        <i class="mdi mdi-plus-circle me-2"></i>Add New Template
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">
                    <input type="hidden" id="tempForConduct_id" name="tempForConduct_id">
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="tempForConduct_name" class="form-label fw-bold">
                                    <i class="mdi mdi-tag me-1 text-primary"></i>Template Name 
                                    <span class="text-danger">*</span>
                                </label>
                                <input type="text" class="form-control form-control-lg" id="tempForConduct_name" name="name" required>
                                <div class="invalid-feedback" id="name-error"></div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="tempForConduct_type" class="form-label fw-bold">
                                    <i class="mdi mdi-format-list-bulleted me-1 text-primary"></i>Type 
                                    <span class="text-danger">*</span>
                                </label>
                                <select class="form-select form-select-lg" id="tempForConduct_type" name="type" required>
                                    <option value="">Select Type</option>
                                    <option value="email">📧 Email Template</option>
                                    <option value="sms">📱 SMS Template</option>
                                </select>
                                <div class="invalid-feedback" id="type-error"></div>
                            </div>
                        </div>
                    </div>

                    <div class="mb-3" id="subject-field" style="display: none;">
                        <label for="tempForConduct_subject" class="form-label fw-bold">
                            <i class="mdi mdi-email me-1 text-primary"></i>Email Subject 
                            <span class="text-danger">*</span>
                        </label>
                        <input type="text" class="form-control form-control-lg" id="tempForConduct_subject" name="subject">
                        <div class="invalid-feedback" id="subject-error"></div>
                    </div>

                    <div class="mb-3">
                        <label for="tempForConduct_content" class="form-label fw-bold">
                            <i class="mdi mdi-text me-1 text-primary"></i>Template Content 
                            <span class="text-danger">*</span>
                        </label>
                        <textarea class="form-control" id="tempForConduct_content" name="content" rows="8" required 
                                  placeholder="Enter your template content here..."></textarea>
                        <div class="invalid-feedback" id="content-error"></div>
                        <small class="text-muted mt-1">
                            Available placeholders: <code>@{{TradeName}}</code>, <code>@{{PropertyAddress}}</code>, <code>@{{TradeType}}</code>, <code>@{{AgentName}}</code>, <code>@{{AgentMobile}}</code>
                        </small>
                    </div>
                </div>
                <div class="modal-footer bg-light p-4">
                    <button type="button" class="btn btn-secondary btn-lg px-4" data-bs-dismiss="modal">
                        <i class="mdi mdi-close me-1"></i>Cancel
                    </button>
                    <button type="submit" class="btn btn-primary btn-lg px-5 shadow-sm">
                        <span class="spinner-border spinner-border-sm d-none me-2" id="submit-spinner"></span>
                        <i class="mdi mdi-check me-1" id="submit-icon"></i>
                        <span id="submit-text">Save Template</span>
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
    // Define placeholders in JavaScript
   const placeholders = [
    "@{{TradeName}}",
    "@{{PropertyAddress}}",
    "@{{TradeType}}",
    "@{{AgentName}}",
    "@{{AgentMobile}}"
];

    
    // Initialize tooltips
    $('[data-bs-toggle="tooltip"]').tooltip();
    
    $('#tempForConduct_type').change(function() {
        const type = $(this).val();
        if (type === 'email') {
            $('#subject-field').show();
            $('#tempForConduct_subject').attr('required', true);
        } else {
            $('#subject-field').hide();
            $('#tempForConduct_subject').attr('required', false);
        }
    });

    $('#tempForConductForm').submit(function(e) {
        e.preventDefault();
        
        const formData = $(this).serialize();
        const isEdit = $('#tempForConduct_id').val();
        const url = isEdit ? "{{ route('agent.tempforconduct.update', ':id') }}".replace(':id', $('#tempForConduct_id').val()) : "{{ route('agent.tempforconduct.store') }}";
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
                    $('#tempForConductModal').modal('hide');
                    
                    // Reload page to show updated templates
                    setTimeout(() => {
                        location.reload();
                    }, 1000);
                }
            },
            error: function(xhr) {
                if (xhr.status === 403) {
                    showAlert('warning', 'Unauthorized action. This template does not belong to you.');
                    $('#tempForConductModal').modal('hide');
                } else {
                    const errors = xhr.responseJSON?.errors || {};
                    
                    // Display field errors
                    Object.keys(errors).forEach(field => {
                        $(`#tempForConduct_${field}`).addClass('is-invalid');
                        $(`#${field}-error`).text(errors[field][0]);
                    });
                    
                    showAlert('danger', xhr.responseJSON?.message || 'An error occurred');
                }
            },
            complete: function() {
                // Hide loading state
                $('#submit-spinner').addClass('d-none');
                $('#submit-icon').removeClass('d-none');
                $('#submit-text').text($('#tempForConduct_id').val() ? 'Update Template' : 'Save Template');
                $('button[type="submit"]').prop('disabled', false);
            }
        });
    });

    // Handle edit template
    $(document).on('click', '.edit-tempForConduct', function() {
        const data = $(this).data();
        
        $('#tempForConduct_id').val(data.id);
        $('#tempForConduct_name').val(data.name);
        $('#tempForConduct_type').val(data.type).trigger('change');
        $('#tempForConduct_subject').val(data.subject);
        $('#tempForConduct_content').val(data.content);
        
        $('#tempForConductModalLabel').html('<i class="mdi mdi-pencil me-2"></i>Edit Template');
        $('#submit-text').text('Update Template');
        $('#tempForConductModal').modal('show');
    });

    // Handle delete template
    $(document).on('click', '.delete-tempForConduct', function() {
        const templateId = $(this).data('id');
        
        if (confirm('🗑️ Are you sure you want to delete this template?\n\nThis action cannot be undone.')) {
            $.ajax({
                url: "{{ route('agent.tempforconduct.destroy', ':id') }}".replace(':id', templateId),
                method: 'DELETE',
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    if (response.success) {
                        showAlert('success', response.message);
                        $(`#tempForConduct-card-${templateId}`).fadeOut(300, function() {
                            $(this).remove();
                            
                            // Check if no templates left and show empty state
                            if ($('#tempForConduct-container .col-lg-6').length === 0) {
                                location.reload();
                            }
                        });
                    }
                },
                error: function(xhr) {
                    if (xhr.status === 403) {
                        showAlert('warning', 'Unauthorized action. This template does not belong to you.');
                    } else {
                        showAlert('danger', xhr.responseJSON?.message || 'An error occurred');
                    }
                }
            });
        }
    });

    // Handle toggle status
    $(document).on('click', '.toggle-status', function() {
        const templateId = $(this).data('id');
        
        $.ajax({
            url: "{{ route('agent.tempforconduct.toggle-status', ':id') }}".replace(':id', templateId),
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
                if (xhr.status === 403) {
                    showAlert('warning', 'Unauthorized action. This template does not belong to you.');
                } else {
                    showAlert('danger', xhr.responseJSON?.message || 'An error occurred');
                }
            }
        });
    });

    // Reset modal when closed
    $('#tempForConductModal').on('hidden.bs.modal', function() {
        $('#tempForConductForm')[0].reset();
        $('#tempForConduct_id').val('');
        $('#tempForConductModalLabel').html('<i class="mdi mdi-plus-circle me-2"></i>Add New Template');
        $('#submit-text').text('Save Template');
        $('#subject-field').hide();
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

/* Template Cards */
.tempForConduct-card {
    transition: all 0.3s ease;
    border: 1px solid #e9ecef !important;
    border-radius: 12px;
}

.tempForConduct-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 30px rgba(0,0,0,0.15) !important;
    border-color: #007bff !important;
}

/* Custom Badges */
.badge-email {
    background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
    color: white;
    font-weight: 500;
}

.badge-sms {
    background: linear-gradient(135deg, #007bff 0%, #3b82f6 100%);
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
    .tempForConduct-card {
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

.alert-warning {
    background: linear-gradient(135deg, #fff3cd 0%, #ffeaa7 100%);
    color: #856404;
    border: none;
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

.bg-light {
    background-color: #f8f9fa !important;
}

.badge {
    font-size: 0.75em;
}

.is-invalid {
    border-color: #dc3545;
    padding-right: calc(1.5em + 0.75rem);
    background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 12 12' width='12' height='12' fill='none' stroke='%23dc3545'%3e%3ccircle cx='6' cy='6' r='4.5'/%3e%3cpath d='m5.8 3.6.4.4.4-.4'/%3e%3cpath d='M6 7v2'/%3e%3c/svg%3e");
    background-repeat: no-repeat;
    background-position: right calc(0.375em + 0.1875rem) center;
    background-size: calc(0.75em + 0.375rem) calc(0.75em + 0.375rem);
}

.invalid-feedback {
    display: block;
    width: 100%;
    margin-top: 0.25rem;
    font-size: 0.875em;
    color: #dc3545;
}
</style>
@endsection