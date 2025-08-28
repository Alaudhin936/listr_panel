@extends('layout.master')

@section('main_content')
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
    .form-label {
        font-weight: 500;
        color: #495057;
        margin-bottom: 0.5rem;
    }
    .form-control, .form-select {
        border-radius: 0.375rem;
        padding: 0.5rem 1rem;
        border: 1px solid #ced4da;
        transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
    }
    .form-control:focus, .form-select:focus {
        border-color: #000;
        box-shadow: 0 0 0 0.25rem rgba(0, 0, 0, 0.1);
    }
    .invalid-feedback {
        color: #dc3545;
        font-size: 0.875rem;
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
    .tradespeople-container {
        border: 1px solid #dee2e6;
        border-radius: 0.375rem;
        padding: 1rem;
        max-height: 200px;
        overflow-y: auto;
    }
    .tradesperson-checkbox {
        margin-right: 0.5rem;
    }
    .template-preview {
        background-color: #f8f9fa;
        border: 1px solid #dee2e6;
        border-radius: 0.375rem;
        padding: 1rem;
        min-height: 100px;
    }
</style>

<div class="page-wrapper compact-wrapper" id="pageWrapper">
    <div class="page-body-wrapper">
        <div class="page-body1">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header pb-0">
                                <div class="d-flex justify-content-between align-items-center">
                                    <h4 class="hot-head1">
                                        <i class="fas fa-edit me-2"></i>Edit Hot Lead
                                    </h4>
                                    <div>
                                        <span class="badge {{ $hotLead->category === 'hot' ? 'badge-hot' : 'badge-warm' }}">
                                            {{ ucfirst($hotLead->category) }} Lead
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <form id="editHotLeadForm" action="{{ route('agent.hotleads.update', $hotLead->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    
                                    <div class="row mb-4">
                                        <div class="col-md-6">
                                            <h5 class="mb-3">Vendor Information</h5>
                                            
                                            <div class="mb-3">
                                                <label for="vendor_first_name" class="form-label">First Name <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" id="vendor_first_name" name="vendor_first_name" 
                                                    value="{{ old('vendor_first_name', $hotLead->vendor_first_name) }}" required>
                                                <div class="invalid-feedback"></div>
                                            </div>
                                            
                                            <div class="mb-3">
                                                <label for="vendor_last_name" class="form-label">Last Name <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" id="vendor_last_name" name="vendor_last_name" 
                                                    value="{{ old('vendor_last_name', $hotLead->vendor_last_name) }}" required>
                                                <div class="invalid-feedback"></div>
                                            </div>
                                            
                                            <div class="mb-3">
                                                <label for="vendor_mobile" class="form-label">Mobile <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" id="vendor_mobile" name="vendor_mobile" 
                                                    value="{{ old('vendor_mobile', $hotLead->vendor_mobile) }}" required>
                                                <div class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-6">
                                            <h5 class="mb-3">&nbsp;</h5>
                                            
                                            <div class="mb-3">
                                                <label for="vendor_email" class="form-label">Email</label>
                                                <input type="email" class="form-control" id="vendor_email" name="vendor_email" 
                                                    value="{{ old('vendor_email', $hotLead->vendor_email) }}">
                                                <div class="invalid-feedback"></div>
                                            </div>
                                            
                                            <div class="mb-3">
                                                <label for="vendor_address" class="form-label">Address</label>
                                                <textarea class="form-control" id="vendor_address" name="vendor_address" rows="2">{{ old('vendor_address', $hotLead->vendor_address) }}</textarea>
                                                <div class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="row mb-4">
                                        <div class="col-md-6">
                                            <h5 class="mb-3">Lead Details</h5>
                                            
                                            <div class="mb-3">
                                                <label for="category" class="form-label">Category <span class="text-danger">*</span></label>
                                                <select class="form-select" id="category" name="category" required>
                                                    <option value="hot" {{ old('category', $hotLead->category) === 'hot' ? 'selected' : '' }}>Hot</option>
                                                    <option value="warm" {{ old('category', $hotLead->category) === 'warm' ? 'selected' : '' }}>Warm</option>
                                                </select>
                                                <div class="invalid-feedback"></div>
                                            </div>
                                            
                                            <div class="mb-3">
                                                <label for="lead_source" class="form-label">Lead Source</label>
                                                <input type="text" class="form-control" id="lead_source" name="lead_source" 
                                                    value="{{ old('lead_source', $hotLead->lead_source) }}">
                                                <div class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-6">
                                            <h5 class="mb-3">Notes</h5>
                                            
                                            <div class="mb-3">
                                                <label for="quick_notes" class="form-label">Quick Notes</label>
                                                <textarea class="form-control" id="quick_notes" name="quick_notes" rows="3">{{ old('quick_notes', $hotLead->quick_notes) }}</textarea>
                                                <div class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="row mb-4">
                                        <div class="col-md-6">
                                            <h5 class="mb-3">Tradespeople</h5>
                                            
                                            <div class="mb-3">
                                                <label class="form-label">Selected Tradespeople</label>
                                                <div class="tradespeople-container">
                                                    @foreach(['Plumber', 'Electrician', 'Carpenter', 'Painter', 'Handyman'] as $trade)
                                                    <div class="form-check">
                                                        <input class="form-check-input tradesperson-checkbox" type="checkbox" 
                                                            name="selected_tradespeople[]" value="{{ $trade }}" id="trade_{{ $loop->index }}"
                                                            {{ in_array($trade, old('selected_tradespeople', $hotLead->selected_tradespeople ?? [])) ? 'checked' : '' }}>
                                                        <label class="form-check-label" for="trade_{{ $loop->index }}">
                                                            {{ $trade }}
                                                        </label>
                                                    </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                            
                                            <div class="mb-3">
                                                <label for="tradesperson_contact_option" class="form-label">Contact Option</label>
                                                <select class="form-select" id="tradesperson_contact_option" name="tradesperson_contact_option">
                                                    <option value="">Select an option</option>
                                                    <option value="contact_vendor" {{ old('tradesperson_contact_option', $hotLead->tradesperson_contact_option) === 'contact_vendor' ? 'selected' : '' }}>
                                                        Tradesperson to Contact Vendor
                                                    </option>
                                                    <option value="contact_agent" {{ old('tradesperson_contact_option', $hotLead->tradesperson_contact_option) === 'contact_agent' ? 'selected' : '' }}>
                                                        Tradesperson to Contact Agent
                                                    </option>
                                                    <option value="vendor_contact" {{ old('tradesperson_contact_option', $hotLead->tradesperson_contact_option) === 'vendor_contact' ? 'selected' : '' }}>
                                                        Vendor to Contact Tradesperson
                                                    </option>
                                                </select>
                                                <div class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-6">
                                            <h5 class="mb-3">Follow-up Templates</h5>
                                            
                                            <div class="mb-3">
                                                <label for="followup_sms_template" class="form-label">SMS Template</label>
                                                <select class="form-select" id="followup_sms_template" name="followup_sms_template">
                                                    <option value="">Select a template</option>
                                                    <option value="template1" {{ old('followup_sms_template', $hotLead->followup_sms_template) === 'template1' ? 'selected' : '' }}>
                                                        Template 1 - General Follow-up
                                                    </option>
                                                    <option value="template2" {{ old('followup_sms_template', $hotLead->followup_sms_template) === 'template2' ? 'selected' : '' }}>
                                                        Template 2 - Urgent Follow-up
                                                    </option>
                                                </select>
                                                <div class="invalid-feedback"></div>
                                            </div>
                                            
                                            <div class="mb-3">
                                                <label for="sms_preview" class="form-label">SMS Preview</label>
                                                <div class="template-preview" id="sms_preview">
                                                    {{ $hotLead->sms_preview ?? 'Select a template to preview' }}
                                                </div>
                                                <input type="hidden" name="sms_preview" id="sms_preview_input" value="{{ old('sms_preview', $hotLead->sms_preview) }}">
                                            </div>
                                            
                                            <div class="mb-3">
                                                <label for="followup_email_template" class="form-label">Email Template</label>
                                                <select class="form-select" id="followup_email_template" name="followup_email_template">
                                                    <option value="">Select a template</option>
                                                    <option value="template1" {{ old('followup_email_template', $hotLead->followup_email_template) === 'template1' ? 'selected' : '' }}>
                                                        Template 1 - General Follow-up
                                                    </option>
                                                    <option value="template2" {{ old('followup_email_template', $hotLead->followup_email_template) === 'template2' ? 'selected' : '' }}>
                                                        Template 2 - Detailed Follow-up
                                                    </option>
                                                </select>
                                                <div class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="mb-4">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="privacy_consent" name="privacy_consent" 
                                                value="1" {{ old('privacy_consent', $hotLead->privacy_consent) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="privacy_consent">
                                                Vendor has given privacy consent
                                            </label>
                                        </div>
                                    </div>
                                    
                                    <div class="d-flex justify-content-end">
                                        <a href="{{ route('agent.hotleads.index') }}" class="btn btn-outline-secondary me-2">
                                            <i class="fas fa-times me-1"></i> Cancel
                                        </a>
                                        <button type="submit" class="btn btn-primary">
                                            <i class="fas fa-save me-1"></i> Save Changes
                                        </button>
                                    </div>
                                </form>
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
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
$(document).ready(function() {
    // Handle form submission
    $('#editHotLeadForm').on('submit', function(e) {
        e.preventDefault();
        
        const form = $(this);
        const submitBtn = form.find('button[type="submit"]');
        const originalBtnText = submitBtn.html();
        
        // Reset validation
        form.find('.is-invalid').removeClass('is-invalid');
        form.find('.invalid-feedback').text('');
        
        // Show loading state
        submitBtn.prop('disabled', true);
        submitBtn.html('<i class="fas fa-spinner fa-spin me-1"></i> Saving...');
        
        $.ajax({
            url: form.attr('action'),
            type: 'POST',
            data: form.serialize(),
            success: function(response) {
                if (response.success) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Success!',
                        text: response.message,
                        timer: 2000,
                        showConfirmButton: false
                    }).then(() => {
                        window.location.href = response.redirect;
                    });
                }
            },
            error: function(xhr) {
                submitBtn.prop('disabled', false);
                submitBtn.html(originalBtnText);
                
                if (xhr.status === 422) {
                    const errors = xhr.responseJSON.errors;
                    for (const field in errors) {
                        const input = form.find('[name="' + field + '"]');
                        const feedback = input.next('.invalid-feedback');
                        
                        input.addClass('is-invalid');
                        feedback.text(errors[field][0]);
                    }
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        text: 'Something went wrong. Please try again.',
                        timer: 2000,
                        showConfirmButton: false
                    });
                }
            }
        });
    });
    
    // Handle SMS template change
    $('#followup_sms_template').on('change', function() {
        const template = $(this).val();
        let preview = '';
        
        if (template === 'template1') {
            preview = `Hi, this is a follow-up regarding your recent inquiry. Please let us know if you need any assistance.`;
        } else if (template === 'template2') {
            preview = ` Hi,we have limited availability for your requested service. Please contact us ASAP to schedule.`;
        } else {
            preview = 'Select a template to preview';
        }
        
        $('#sms_preview').text(preview);
        $('#sms_preview_input').val(preview);
    });
    
    // Handle email template change
    $('#followup_email_template').on('change', function() {
        const template = $(this).val();
        // You can implement similar preview functionality for email templates
    });
});
</script>
@endsection