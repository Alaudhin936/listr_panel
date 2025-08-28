@extends('agencylayout.master')

@section('main_content')
   <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.datatables.net/1.13.8/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.8/js/dataTables.bootstrap5.min.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.bootstrap5.min.css">
<script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.5.0/js/responsive.bootstrap5.min.js"></script>
<div class="page-wrapper compact-wrapper" id="pageWrapper">
    <div class="page-body-wrapper">
        <div class="page-body1">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-header pb-0 d-flex justify-content-between align-items-center">
                                <h4 class="hot-head1"><i class="fas fa-fire mr-2"></i>Create Hot Lead</h4>
                                <a href="{{ route('agency.hotleads.index') }}" class="btn btn-outline-secondary">
                                    <i class="fas fa-arrow-left mr-1"></i> Back to List
                                </a>
                            </div>
                            
                            <form id="create-hotlead-form" class="form theme-form" method="POST" action="{{ route('agency.hotleads.store') }}">
                                @csrf
                                <div class="card-body">
                                    <div class="row">

                                        {{-- Vendor Information --}}
                                        <div class="col-md-12">
                                            <div class="card-header card-head1 pb-0">
                                                <h4 class="ven-head1"><span>Vendor Information</span></h4>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label">First Name *</label>
                                                <input type="text" name="vendor_first_name" id="vendor_first_name" class="form-control" placeholder="Enter first name" required>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label">Last Name *</label>
                                                <input type="text" name="vendor_last_name" id="vendor_last_name" class="form-control" placeholder="Enter last name" required>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label">Mobile *</label>
                                                <input type="text" name="vendor_mobile" id="vendor_mobile" class="form-control" required>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label">Email</label>
                                                <input type="email" name="vendor_email" id="vendor_email" class="form-control">
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label class="form-label">Address</label>
                                                <textarea name="vendor_address" id="vendor_address" class="form-control" rows="3"></textarea>
                                            </div>
                                        </div>

                                        {{-- Category --}}
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label class="form-label">Category *</label>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="category" value="hot" id="cat_hot" required>
                                                    <label class="form-check-label" for="cat_hot">Hot</label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="category" value="warm" id="cat_warm">
                                                    <label class="form-check-label" for="cat_warm">Warm</label>
                                                </div>
                                            </div>
                                        </div>

                                        {{-- Quick Notes --}}
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label class="form-label">Quick Notes</label>
                                                <textarea name="quick_notes" id="quick_notes" class="form-control" rows="3"></textarea>
                                            </div>
                                        </div>

                                        {{-- Lead Source --}}
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label class="form-label">Lead Source</label>
                                                <select name="lead_source" id="lead_source" class="form-select">
                                                    <option value="">Please Select</option>
                                                    <option value="tbc1">TBC</option>
                                                    <option value="tbc2">TBC</option>
                                                </select>
                                            </div>
                                        </div>

                                        {{-- Selected Tradespeople --}}
                                        <div class="col-md-12">
                                            <div class="card-header card-head1 pb-0">
                                                <h4>Contacts to Maximize Your Price</h4>
                                            </div>
                                            <label class="form-label">Selected Tradespeople:</label>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="selected_tradespeople[]" value="Antony Mahon (conveyancer)" id="tradesperson1">
                                                <label class="form-check-label" for="tradesperson1">Antony Mahon (conveyancer)</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="selected_tradespeople[]" value="Scott (Window Cleaner)" id="tradesperson2">
                                                <label class="form-check-label" for="tradesperson2">Scott (Window Cleaner)</label>
                                            </div>
                                            <!-- Add more tradespeople as needed -->
                                        </div>

                                        {{-- Tradesperson Contact Option --}}
                                        <div class="col-md-12 mt-3">
                                            <label class="form-label">Tradesperson Contact Option</label>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="tradesperson_contact_option" value="contact_vendor" id="contact_vendor">
                                                <label class="form-check-label" for="contact_vendor">Tradesperson to Contact Vendor</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="tradesperson_contact_option" value="contact_agent" id="contact_agent">
                                                <label class="form-check-label" for="contact_agent">Tradesperson to Contact Agent</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="tradesperson_contact_option" value="vendor_contact" id="vendor_contact">
                                                <label class="form-check-label" for="vendor_contact">Vendor to Contact Tradesperson</label>
                                            </div>
                                        </div>

                                        {{-- Privacy Consent --}}
                                        <div class="col-md-12 mt-3">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="privacy_consent" value="1" id="privacy_consent">
                                                <label class="form-check-label" for="privacy_consent"><b>Privacy Consent</b><br>I consent to my contact details being shared with approved suppliers to assist in marketing and preparing my property for sale.</label>
                                            </div>
                                        </div>

                                        {{-- SMS Section --}}
                                        <div class="col-md-12 mt-4">
                                            <div class="card-header card-head1 pb-0">
                                                <h4>SMS Sample</h4>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label class="form-label">Follow Up SMS Template</label>
                                                <select name="followup_sms_template" class="form-select">
                                                    <option value="">Please Select</option>
                                                    <option value="template01">Template 01</option>
                                                    <option value="template02">Template 02</option>
                                                </select>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">SMS Preview</label>
                                                <textarea name="sms_preview" class="form-control" rows="3">Hi {First Name}, Before driving off, I just wanted to thank you...</textarea>
                                            </div>
                                        </div>

                                        {{-- Email Section --}}
                                        <div class="col-md-12 mt-4">
                                            <div class="card-header card-head1 pb-0">
                                                <h4>Email Sample</h4>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label class="form-label">Follow-up Email Template</label>
                                                <select name="followup_email_template" class="form-select">
                                                    <option value="">Please Select</option>
                                                    <option value="killer1">Insert Killer emails</option>
                                                </select>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                
                                <div class="card-footer text-end">
                                    <button class="btn btn-primary" type="submit" id="submit-btn">
                                        <i class="fas fa-save mr-1"></i> Save & Close
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

<style>
    body {
        font-family: 'Montserrat', sans-serif;
    }
    .page-wrapper {
        background: #f8f9fa;
        min-height: 100vh;
    }
    .card {
        border: none;
        box-shadow: 0 0.15rem 1.75rem 0 rgba(33, 40, 50, 0.15);
        border-radius: 10px;
        margin-bottom: 30px;
    }
    .card-header {
        background: white;
        border-bottom: 1px solid #e9ecef;
        border-radius: 10px 10px 0 0 !important;
        padding: 20px 25px;
    }
    .card-head1 {
        background: transparent !important;
        border: none !important;
        padding: 15px 0 10px 0 !important;
        margin: 20px 0 10px 0;
        border-bottom: 2px solid #e9ecef !important;
    }
    .hot-head1, .ven-head1 h4 {
        color: #495057;
        font-weight: 600;
        margin: 0;
        font-size: 1.5rem;
    }
    .ven-head1 span {
        color: #007bff;
        font-weight: 600;
        font-size: 1.2rem;
    }
    .form-label {
        color: #495057;
        font-weight: 500;
        margin-bottom: 8px;
    }
    .form-control, .form-select {
        border: 2px solid #e9ecef;
        border-radius: 8px;
        padding: 12px 15px;
        font-size: 14px;
        transition: all 0.3s ease;
    }
    .form-control:focus, .form-select:focus {
        border-color: #007bff;
        box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
    }
    .form-control.is-invalid, .form-select.is-invalid {
        border-color: #dc3545;
    }
    .invalid-feedback {
        display: block;
        color: #dc3545;
        font-size: 12px;
        margin-top: 5px;
    }
    .btn-primary {
        background: linear-gradient(45deg, #007bff, #0056b3);
        border: none;
        border-radius: 8px;
        padding: 12px 30px;
        font-weight: 500;
        transition: all 0.3s ease;
    }
    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(0, 123, 255, 0.3);
    }
    .btn-outline-secondary {
        border: 2px solid #6c757d;
        color: #6c757d;
        border-radius: 8px;
        padding: 10px 20px;
        font-weight: 500;
        transition: all 0.3s ease;
    }
    .btn-outline-secondary:hover {
        background: #6c757d;
        color: white;
        transform: translateY(-2px);
    }
    .card-footer {
        background: #f8f9fa;
        border-top: 1px solid #e9ecef;
        border-radius: 0 0 10px 10px;
        padding: 20px 25px;
    }
  
    .container {
        max-width: 100%;
    }
    .mb-3 {
        margin-bottom: 1.5rem;
    }
    .m-t-15 {
        margin-top: 15px;
    }
    .form-check-label {
        cursor: pointer;
        line-height: 1.4;
    }
    .form-check-input:checked {
        background-color: #007bff;
        border-color: #007bff;
    }
    .theme-form .row {
        margin: 0;
    }
</style>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
$(document).ready(function() {
    $('#create-hotlead-form').on('submit', function(e) {
        e.preventDefault();
        var form = $(this);
        var submitBtn = $('#submit-btn');
        
        // Clear previous validation errors
        $('.form-control').removeClass('is-invalid');
        $('.form-select').removeClass('is-invalid');
        $('.form-check-input').removeClass('is-invalid');
        $('.invalid-feedback').remove();
        
        submitBtn.prop('disabled', true).html('<i class="fas fa-spinner fa-spin mr-1"></i> Processing...');
        
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
                        showConfirmButton: false,
                        timer: 1500,
                        background: '#fff',
                        customClass: {
                            popup: 'animated fadeInUp'
                        }
                    }).then(function() {
                        window.location.href = response.redirect;
                    });
                }
            },
            error: function(xhr) {
                submitBtn.prop('disabled', false).html('<i class="fas fa-save mr-1"></i> Save & Close');
                
                if (xhr.status === 422) {
                    var errors = xhr.responseJSON.errors;
                    $.each(errors, function(key, value) {
                        var element = $('[name="' + key + '"]');
                        
                        if (element.length) {
                            // For radio buttons and checkboxes
                            if (element.attr('type') === 'radio' || element.attr('type') === 'checkbox') {
                                element.addClass('is-invalid');
                                element.closest('.form-check').after('<div class="invalid-feedback">' + value[0] + '</div>');
                            } 
                            // For select elements
                            else if (element.is('select')) {
                                element.addClass('is-invalid');
                                element.after('<div class="invalid-feedback">' + value[0] + '</div>');
                            }
                            // For other input types
                            else {
                                element.addClass('is-invalid');
                                element.after('<div class="invalid-feedback">' + value[0] + '</div>');
                            }
                        }
                    });
                    
                    // Scroll to first error
                    var firstError = $('.is-invalid').first();
                    if (firstError.length) {
                        $('html, body').animate({
                            scrollTop: firstError.offset().top - 100
                        }, 500);
                    }
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        text: 'Something went wrong. Please try again.',
                        customClass: {
                            popup: 'animated fadeInUp'
                        }
                    });
                }
            }
        });
    });

    // Remove validation errors when user starts typing
    $('input, select, textarea').on('keyup change', function() {
        $(this).removeClass('is-invalid');
        $(this).next('.invalid-feedback').remove();
    });
    
    // Enhanced form validation feedback
    $('input[required], select[required]').on('blur', function() {
        if (!$(this).val()) {
            $(this).addClass('is-invalid');
            if (!$(this).next('.invalid-feedback').length) {
                $(this).after('<div class="invalid-feedback">This field is required.</div>');
            }
        }
    });
    
    // For radio buttons
    $('input[type="radio"][required]').on('change', function() {
        var name = $(this).attr('name');
        if (!$('input[name="' + name + '"]:checked').length) {
            $('input[name="' + name + '"]').addClass('is-invalid');
            if (!$('input[name="' + name + '"]').next('.invalid-feedback').length) {
                $('input[name="' + name + '"]').first().closest('.form-check').after('<div class="invalid-feedback">This field is required.</div>');
            }
        } else {
            $('input[name="' + name + '"]').removeClass('is-invalid');
            $('input[name="' + name + '"]').next('.invalid-feedback').remove();
        }
    });
});
</script>
@endsection