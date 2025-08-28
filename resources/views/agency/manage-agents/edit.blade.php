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
                                <h4 class="hot-head1"><i class="fas fa-user-edit mr-2"></i>Edit Agent</h4>
                                <a href="{{ route('agency.agents.index') }}" class="btn btn-outline-secondary">
                                    <i class="fas fa-arrow-left mr-1"></i> Back to List
                                </a>
                            </div>
                            
                            <form id="edit-agent-form" class="form theme-form" method="POST" action="{{ route('agency.agents.update', $agent->id) }}">
                                @csrf
                                @method('PUT')
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="card-header card-head1 pb-0 ">
                                                <h4 class="ven-head1 "><span>Personal Information</span></h4>
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label" for="name">Full Name *</label>
                                                <input class="form-control" id="name" name="name" type="text" value="{{ $agent->name }}" required>
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label" for="email">Email Address *</label>
                                                <input class="form-control" id="email" name="email" type="email" value="{{ $agent->email }}" required>
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label" for="phone">Phone Number *</label>
                                                <input class="form-control" id="phone" name="phone" type="text" value="{{ $agent->phone }}" required>
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label" for="status">Status *</label>
                                                <select class="form-control" id="status" name="status" required>
                                                    <option value="active" {{ $agent->status == 'active' ? 'selected' : '' }}>Active</option>
                                                    <option value="pending" {{ $agent->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                                </select>
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-12">
                                            <div class="card-header card-head1 pb-0">
                                                <h4 class="ven-head1"><span>Address Information</span></h4>
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label class="form-label" for="address_line1">Address Line 1 *</label>
                                                <input class="form-control" id="address_line1" name="address_line1" type="text" value="{{ $agent->address_line1 }}" required>
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label class="form-label" for="address_line2">Address Line 2</label>
                                                <input class="form-control" id="address_line2" name="address_line2" type="text" value="{{ $agent->address_line2 }}" placeholder="Enter address line 2 (optional)">
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label" for="city">City *</label>
                                                <input class="form-control" id="city" name="city" type="text" value="{{ $agent->city }}" required>
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label" for="state">State *</label>
                                                <input class="form-control" id="state" name="state" type="text" value="{{ $agent->state }}" required>
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label class="form-label" for="zipcode">Zip Code *</label>
                                                <input class="form-control" id="zipcode" name="zipcode" type="text" value="{{ $agent->zipcode }}" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="card-footer text-end">
                                    <button class="btn btn-primary" type="submit" id="submit-btn">
                                        <i class="fas fa-save mr-1"></i> Update Agent
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
    .form-control {
        border: 2px solid #e9ecef;
        border-radius: 8px;
        padding: 12px 15px;
        font-size: 14px;
        transition: all 0.3s ease;
    }
    .form-control:focus {
        border-color: #007bff;
        box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
    }
    .form-control.is-invalid {
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
    $('#edit-agent-form').on('submit', function(e) {
        e.preventDefault();
        var form = $(this);
        var submitBtn = $('#submit-btn');
        
        // Clear previous validation errors
        $('.form-control').removeClass('is-invalid');
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
                submitBtn.prop('disabled', false).html('<i class="fas fa-save mr-1"></i> Update Agent');
                
                if (xhr.status === 422) {
                    var errors = xhr.responseJSON.errors;
                    $.each(errors, function(key, value) {
                        $('#' + key).addClass('is-invalid');
                        $('#' + key).after('<div class="invalid-feedback">' + value[0] + '</div>');
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
});
</script>
@endsection