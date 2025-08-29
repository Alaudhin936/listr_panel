

<?php $__env->startSection('main_content'); ?>
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.datatables.net/1.13.8/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.8/js/dataTables.bootstrap5.min.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.bootstrap5.min.css">
<script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.5.0/js/responsive.bootstrap5.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<div class="page-wrapper compact-wrapper" id="pageWrapper">
    <div class="page-body-wrapper">
        <div class="page-body1">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-header pb-0 d-flex justify-content-between align-items-center">
                                <h4 class="hot-head1"><i class="fas fa-edit mr-2"></i>Edit Booking Appraisal</h4>
                                <a href="<?php echo e(route('agent.booking-appraisals.index')); ?>" class="btn btn-outline-secondary">
                                    <i class="fas fa-arrow-left mr-1"></i> Back to List
                                </a>
                            </div>
                            
                            <form id="edit-appraisal-form" class="form theme-form" method="POST" action="<?php echo e(route('agent.booking-appraisals.update', $bookingAppraisal->id)); ?>">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('PUT'); ?>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="card-header card-head1 pb-0">
                                                <h4 class="ven-head1"><span>Property Information</span></h4>
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label" for="address">Address *</label>
                                                <input class="form-control" id="address" name="address" type="text" 
                                                    value="<?php echo e(old('address', $bookingAppraisal->address)); ?>" required>
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label" for="property_type">Property Type *</label>
                                                <select class="form-control" id="property_type" name="property_type" required>
                                                    <option value="">Select Property Type</option>
                                                    <option value="House" <?php echo e(old('property_type', $bookingAppraisal->property_type) == 'House' ? 'selected' : ''); ?>>House</option>
                                                    <option value="Unit" <?php echo e(old('property_type', $bookingAppraisal->property_type) == 'Unit' ? 'selected' : ''); ?>>Unit</option>
                                                    <option value="Townhouse" <?php echo e(old('property_type', $bookingAppraisal->property_type) == 'Townhouse' ? 'selected' : ''); ?>>Townhouse</option>
                                                    <option value="Apartment" <?php echo e(old('property_type', $bookingAppraisal->property_type) == 'Apartment' ? 'selected' : ''); ?>>Apartment</option>
                                                    <option value="Land" <?php echo e(old('property_type', $bookingAppraisal->property_type) == 'Land' ? 'selected' : ''); ?>>Land</option>
                                                    <option value="Acreage" <?php echo e(old('property_type', $bookingAppraisal->property_type) == 'Acreage' ? 'selected' : ''); ?>>Acreage</option>
                                                    <option value="Rural" <?php echo e(old('property_type', $bookingAppraisal->property_type) == 'Rural' ? 'selected' : ''); ?>>Rural</option>
                                                    <option value="Block of Units" <?php echo e(old('property_type', $bookingAppraisal->property_type) == 'Block of Units' ? 'selected' : ''); ?>>Block of Units</option>
                                                </select>
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label" for="land_size">Land Size</label>
                                                <input class="form-control" id="land_size" name="land_size" type="text" 
                                                    value="<?php echo e(old('land_size', $bookingAppraisal->land_size)); ?>">
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-12">
                                            <div class="card-header card-head1 pb-0">
                                                <h4 class="ven-head1"><span>Property Details</span></h4>
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-3">
                                            <div class="mb-3">
                                                <label class="form-label" for="bedrooms">Bedrooms</label>
                                                <input class="form-control" id="bedrooms" name="bedrooms" type="number" min="0" 
                                                    value="<?php echo e(old('bedrooms', $bookingAppraisal->bedrooms)); ?>">
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-3">
                                            <div class="mb-3">
                                                <label class="form-label" for="bathrooms">Bathrooms</label>
                                                <input class="form-control" id="bathrooms" name="bathrooms" type="number" min="0" 
                                                    value="<?php echo e(old('bathrooms', $bookingAppraisal->bathrooms)); ?>">
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-3">
                                            <div class="mb-3">
                                                <label class="form-label" for="living_areas">Living Areas</label>
                                                <input class="form-control" id="living_areas" name="living_areas" type="number" min="0" 
                                                    value="<?php echo e(old('living_areas', $bookingAppraisal->living_areas)); ?>">
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-3">
                                            <div class="mb-3">
                                                <label class="form-label" for="study">Study</label>
                                                <input class="form-control" id="study" name="study" type="number" min="0" 
                                                    value="<?php echo e(old('study', $bookingAppraisal->study)); ?>">
                                            </div>
                                        </div>
                                        
                                      <div class="col-md-6">
    <div class="mb-3">
        <label class="form-label" for="under_cover_parking">Under Cover Parking</label>
        <input class="form-control" id="under_cover_parking" name="under_cover_parking" 
               type="number" min="0" 
               value="<?php echo e(old('under_cover_parking', $bookingAppraisal->under_cover_parking)); ?>" 
               placeholder="0"
               oninput="toggleParkingType()">
    </div>
</div>

<div class="col-md-6" id="under_cover_parking_type_div" style="<?php echo e(old('under_cover_parking', $bookingAppraisal->under_cover_parking) > 0 ? '' : 'display: none;'); ?>">
    <div class="mb-3">
        <label class="form-label" for="under_cover_parking_type">Parking Type</label>
        <select class="form-select" id="under_cover_parking_type" name="under_cover_parking_type">
            <option value="">Select type</option>
            <option value="Garage" <?php echo e(old('under_cover_parking_type', $bookingAppraisal->under_cover_parking_type) == 'Garage' ? 'selected' : ''); ?>>Garage</option>
            <option value="Carport" <?php echo e(old('under_cover_parking_type', $bookingAppraisal->under_cover_parking_type) == 'Carport' ? 'selected' : ''); ?>>Carport</option>
        </select>
    </div>
</div>
                                        
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label" for="condition">Condition</label>
                                                <select class="form-control" id="condition" name="condition">
                                                    <option value="">Select Condition</option>
                                                    <option value="Fully Renovated" <?php echo e(old('condition', $bookingAppraisal->condition) == 'Fully Renovated' ? 'selected' : ''); ?>>Fully Renovated</option>
                                                    <option value="Updated Recently" <?php echo e(old('condition', $bookingAppraisal->condition) == 'Updated Recently' ? 'selected' : ''); ?>>Updated Recently</option>
                                                    <option value="Updated a While Ago" <?php echo e(old('condition', $bookingAppraisal->condition) == 'Updated a While Ago' ? 'selected' : ''); ?>>Updated a While Ago</option>
                                                    <option value="Neat and Tidy – Not Renovated" <?php echo e(old('condition', $bookingAppraisal->condition) == 'Neat and Tidy – Not Renovated' ? 'selected' : ''); ?>>Neat and Tidy – Not Renovated</option>
                                                    <option value="Original – Needs Work" <?php echo e(old('condition', $bookingAppraisal->condition) == 'Original – Needs Work' ? 'selected' : ''); ?>>Original – Needs Work</option>
                                                    <option value="Brand New" <?php echo e(old('condition', $bookingAppraisal->condition) == 'Brand New' ? 'selected' : ''); ?>>Brand New</option>
                                                    <option value="Land value" <?php echo e(old('condition', $bookingAppraisal->condition) == 'Land value' ? 'selected' : ''); ?>>Land value</option>
                                                </select>
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label class="form-label" for="what_was_updated">What was updated and when?</label>
                                                <textarea class="form-control" id="what_was_updated" name="what_was_updated" rows="3"><?php echo e(old('what_was_updated', $bookingAppraisal->what_was_updated)); ?></textarea>
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-12">
                                            <div class="card-header card-head1 pb-0">
                                                <h4 class="ven-head1"><span>Vendor 1 Information</span></h4>
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label" for="vendor1_first_name">First Name *</label>
                                                <input class="form-control" id="vendor1_first_name" name="vendor1_first_name" type="text" 
                                                    value="<?php echo e(old('vendor1_first_name', $bookingAppraisal->vendor1_first_name)); ?>" required>
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label" for="vendor1_last_name">Last Name *</label>
                                                <input class="form-control" id="vendor1_last_name" name="vendor1_last_name" type="text" 
                                                    value="<?php echo e(old('vendor1_last_name', $bookingAppraisal->vendor1_last_name)); ?>" required>
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label" for="vendor1_mobile">Mobile *</label>
                                                <input class="form-control" id="vendor1_mobile" name="vendor1_mobile" type="text" 
                                                    value="<?php echo e(old('vendor1_mobile', $bookingAppraisal->vendor1_mobile)); ?>" required>
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label" for="vendor1_email">Email *</label>
                                                <input class="form-control" id="vendor1_email" name="vendor1_email" type="email" 
                                                    value="<?php echo e(old('vendor1_email', $bookingAppraisal->vendor1_email)); ?>" required>
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-12">
                                            <div class="card-header card-head1 pb-0">
                                                <h4 class="ven-head1"><span>Vendor 2 Information (if applicable)</span></h4>
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label" for="vendor2_first_name">First Name</label>
                                                <input class="form-control" id="vendor2_first_name" name="vendor2_first_name" type="text" 
                                                    value="<?php echo e(old('vendor2_first_name', $bookingAppraisal->vendor2_first_name)); ?>">
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label" for="vendor2_last_name">Last Name</label>
                                                <input class="form-control" id="vendor2_last_name" name="vendor2_last_name" type="text" 
                                                    value="<?php echo e(old('vendor2_last_name', $bookingAppraisal->vendor2_last_name)); ?>">
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label" for="vendor2_mobile">Mobile</label>
                                                <input class="form-control" id="vendor2_mobile" name="vendor2_mobile" type="text" 
                                                    value="<?php echo e(old('vendor2_mobile', $bookingAppraisal->vendor2_mobile)); ?>">
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label" for="vendor2_email">Email</label>
                                                <input class="form-control" id="vendor2_email" name="vendor2_email" type="email" 
                                                    value="<?php echo e(old('vendor2_email', $bookingAppraisal->vendor2_email)); ?>">
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-12">
                                            <div class="card-header card-head1 pb-0">
                                                <h4 class="ven-head1"><span>Appointment Details</span></h4>
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label" for="appointment_date">Appointment Date *</label>
                                                <input class="form-control" id="appointment_date" name="appointment_date" type="date" 
                                                    value="<?php echo e(old('appointment_date', $bookingAppraisal->appointment_date)); ?>" required>
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label" for="appointment_time">Appointment Time *</label>
                                                <input class="form-control" id="appointment_time" name="appointment_time" type="time" 
                                                    value="<?php echo e(old('appointment_time', $bookingAppraisal->appointment_time)); ?>" required>
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label" for="lead_source">Lead Source *</label>
                                                <select class="form-control" id="lead_source" name="lead_source" required>
                                                    <option value="">Select Lead Source</option>
                                                    <option value="Letter Drop" <?php echo e(old('lead_source', $bookingAppraisal->lead_source) == 'Letter Drop' ? 'selected' : ''); ?>>Letter Drop</option>
                                                    <option value="Referral" <?php echo e(old('lead_source', $bookingAppraisal->lead_source) == 'Referral' ? 'selected' : ''); ?>>Referral</option>
                                                    <option value="Previous Client" <?php echo e(old('lead_source', $bookingAppraisal->lead_source) == 'Previous Client' ? 'selected' : ''); ?>>Previous Client</option>
                                                    <option value="OFI" <?php echo e(old('lead_source', $bookingAppraisal->lead_source) == 'OFI' ? 'selected' : ''); ?>>OFI</option>
                                                    <option value="Bus Stop" <?php echo e(old('lead_source', $bookingAppraisal->lead_source) == 'Bus Stop' ? 'selected' : ''); ?>>Bus Stop</option>
                                                    <option value="Door knocking" <?php echo e(old('lead_source', $bookingAppraisal->lead_source) == 'Door knocking' ? 'selected' : ''); ?>>Door knocking</option>
                                                    <option value="Property Management" <?php echo e(old('lead_source', $bookingAppraisal->lead_source) == 'Property Management' ? 'selected' : ''); ?>>Property Management</option>
                                                    <option value="Internet Search" <?php echo e(old('lead_source', $bookingAppraisal->lead_source) == 'Internet Search' ? 'selected' : ''); ?>>Internet Search</option>
                                                    <option value="Rate My Agent" <?php echo e(old('lead_source', $bookingAppraisal->lead_source) == 'Rate My Agent' ? 'selected' : ''); ?>>Rate My Agent</option>
                                                    <option value="Other" <?php echo e(old('lead_source', $bookingAppraisal->lead_source) == 'Other' ? 'selected' : ''); ?>>Other</option>
                                                </select>
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label" for="category">Category</label>
                                                <input class="form-control" id="category" name="category" type="text" 
                                                    value="<?php echo e(old('category', $bookingAppraisal->category)); ?>">
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-12 form-field-hidden" id="lead_source_notes_container" style="<?php echo e(old('lead_source', $bookingAppraisal->lead_source) == 'Other' ? '' : 'display: none;'); ?>">
                                            <div class="mb-3">
                                                <label class="form-label" for="lead_source_notes">Lead Source Notes</label>
                                                <textarea class="form-control" id="lead_source_notes" name="lead_source_notes" rows="2"><?php echo e(old('lead_source_notes', $bookingAppraisal->lead_source_notes)); ?></textarea>
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-12">
                                            <div class="card-header card-head1 pb-0">
                                                <h4 class="ven-head1"><span>Selling Details</span></h4>
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label" for="is_vendor_selling">Is The Vendor Selling? *</label>
                                                <select class="form-control" id="is_vendor_selling" name="is_vendor_selling" required>
                                                    <option value="">Select Option</option>
                                                    <option value="Yes" <?php echo e(old('is_vendor_selling', $bookingAppraisal->is_vendor_selling) == 'Yes' ? 'selected' : ''); ?>>Yes</option>
                                                    <option value="Not Sure" <?php echo e(old('is_vendor_selling', $bookingAppraisal->is_vendor_selling) == 'Not Sure' ? 'selected' : ''); ?>>Not Sure</option>
                                                    <option value="No" <?php echo e(old('is_vendor_selling', $bookingAppraisal->is_vendor_selling) == 'No' ? 'selected' : ''); ?>>No</option>
                                                </select>
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-6 form-field-hidden" id="moving_to_container" style="<?php echo e(in_array(old('is_vendor_selling', $bookingAppraisal->is_vendor_selling), ['Yes', 'Not Sure']) ? '' : 'display: none;'); ?>">
                                            <div class="mb-3">
                                                <label class="form-label" for="moving_to">If Selling, WHERE is the vendor moving to?</label>
                                                <input class="form-control" id="moving_to" name="moving_to" type="text" 
                                                    value="<?php echo e(old('moving_to', $bookingAppraisal->moving_to)); ?>">
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-6 form-field-hidden" id="when_listing_container" style="<?php echo e(in_array(old('is_vendor_selling', $bookingAppraisal->is_vendor_selling), ['Yes', 'Not Sure']) ? '' : 'display: none;'); ?>">
                                            <div class="mb-3">
                                                <label class="form-label" for="when_listing">If moving, WHEN are they looking to have their property listed?</label>
                                                <input class="form-control" id="when_listing" name="when_listing" type="text" 
                                                    value="<?php echo e(old('when_listing', $bookingAppraisal->when_listing)); ?>">
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-12">
                                            <div class="card-header card-head1 pb-0">
                                                <h4 class="ven-head1"><span>Confirmation Details</span></h4>
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label" for="send_confirmation_sms">Send Confirmation SMS</label>
                                                <select class="form-control" id="send_confirmation_sms" name="send_confirmation_sms">
                                                    <option value="">Select Option</option>
                                                    <option value="Message 1 - From Caitlyn" <?php echo e(old('send_confirmation_sms', $bookingAppraisal->send_confirmation_sms) == 'Message 1 - From Caitlyn' ? 'selected' : ''); ?>>Message 1 - From Caitlyn</option>
                                                    <option value="Message 2 - From Caitlyn" <?php echo e(old('send_confirmation_sms', $bookingAppraisal->send_confirmation_sms) == 'Message 2 - From Caitlyn' ? 'selected' : ''); ?>>Message 2 - From Caitlyn</option>
                                                </select>
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label" for="send_confirmation_email">Send Confirmation Email</label>
                                                <select class="form-control" id="send_confirmation_email" name="send_confirmation_email">
                                                    <option value="">Select Option</option>
                                                    <option value="Confirmation Email Version 1" <?php echo e(old('send_confirmation_email', $bookingAppraisal->send_confirmation_email) == 'Confirmation Email Version 1' ? 'selected' : ''); ?>>Confirmation Email Version 1</option>
                                                </select>
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-12 form-field-hidden" id="message_preview_container" style="<?php echo e(old('send_confirmation_sms', $bookingAppraisal->send_confirmation_sms) || old('send_confirmation_email', $bookingAppraisal->send_confirmation_email) ? '' : 'display: none;'); ?>">
                                            <div class="mb-3">
                                                <label class="form-label" for="message_preview">Message Preview</label>
                                                <textarea class="form-control" id="message_preview" name="message_preview" rows="4"><?php echo e(old('message_preview', $bookingAppraisal->message_preview)); ?></textarea>
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label" for="save_to_crm">Save this Appraisal in the CRM?</label>
                                                <select class="form-control" id="save_to_crm" name="save_to_crm">
                                                    <option value="Yes – create a record for tracking and lead ownership" <?php echo e(old('save_to_crm', $bookingAppraisal->save_to_crm) == 'Yes – create a record for tracking and lead ownership' ? 'selected' : ''); ?>>Yes – create a record for tracking and lead ownership</option>
                                                    <option value="No – do not save" <?php echo e(old('save_to_crm', $bookingAppraisal->save_to_crm) == 'No – do not save' ? 'selected' : ''); ?>>No – do not save</option>
                                                </select>
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label" for="comparable_sales">Comparable Sales Required</label>
                                                <select class="form-control" id="comparable_sales" name="comparable_sales">
                                                    <option value="">Select Option</option>
                                                    <option value="Yes - Printed + Emailed" <?php echo e(old('comparable_sales', $bookingAppraisal->comparable_sales) == 'Yes - Printed + Emailed' ? 'selected' : ''); ?>>Yes - Printed + Emailed</option>
                                                    <option value="Yes - Email Only" <?php echo e(old('comparable_sales', $bookingAppraisal->comparable_sales) == 'Yes - Email Only' ? 'selected' : ''); ?>>Yes - Email Only</option>
                                                    <option value="Yes - Printed Only" <?php echo e(old('comparable_sales', $bookingAppraisal->comparable_sales) == 'Yes - Printed Only' ? 'selected' : ''); ?>>Yes - Printed Only</option>
                                                    <option value="No - Not Required" <?php echo e(old('comparable_sales', $bookingAppraisal->comparable_sales) == 'No - Not Required' ? 'selected' : ''); ?>>No - Not Required</option>
                                                </select>
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label" for="added_to_calendar">Has this been added to Agent's calendar?</label>
                                                <select class="form-control" id="added_to_calendar" name="added_to_calendar">
                                                    <option value="">Select Option</option>
                                                    <option value="Yes" <?php echo e(old('added_to_calendar', $bookingAppraisal->added_to_calendar) == 'Yes' ? 'selected' : ''); ?>>Yes</option>
                                                    <option value="No" <?php echo e(old('added_to_calendar', $bookingAppraisal->added_to_calendar) == 'No' ? 'selected' : ''); ?>>No</option>
                                                </select>
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label class="form-label" for="additional_notes">Additional Notes</label>
                                                <textarea class="form-control" id="additional_notes" name="additional_notes" rows="3"><?php echo e(old('additional_notes', $bookingAppraisal->additional_notes)); ?></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="card-footer text-end">
                                    <button class="btn btn-primary" type="submit" id="submit-btn">
                                        <i class="fas fa-save mr-1"></i> Update Booking Appraisal
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
     .page-body1{
        padding:0px;
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
    .form-field-hidden {
        display: none;
    }
    textarea.form-control {
        min-height: 100px;
    }
</style>
<script>
function toggleParkingType() {
    const parkingInput = document.getElementById('under_cover_parking');
    const parkingTypeDiv = document.getElementById('under_cover_parking_type_div');
    if (parseInt(parkingInput.value) > 0) {
        parkingTypeDiv.style.display = 'block';
    } else {
        parkingTypeDiv.style.display = 'none';
        document.getElementById('under_cover_parking_type').value = '';
    }
}

// Ensure correct state on page load if editing
document.addEventListener('DOMContentLoaded', toggleParkingType);
</script>
<script>

$(document).ready(function() {
    // Show/hide lead source notes when "Other" is selected
    $('#lead_source').change(function() {
        if ($(this).val() === 'Other') {
            $('#lead_source_notes_container').show();
        } else {
            $('#lead_source_notes_container').hide();
        }
    });
    
    // Show/hide selling details based on vendor selling status
    $('#is_vendor_selling').change(function() {
        if ($(this).val() === 'Yes' || $(this).val() === 'Not Sure') {
            $('#moving_to_container').show();
            $('#when_listing_container').show();
        } else {
            $('#moving_to_container').hide();
            $('#when_listing_container').hide();
        }
    });
    
    // Show message preview when confirmation options are selected
    $('#send_confirmation_sms, #send_confirmation_email').change(function() {
        if ($('#send_confirmation_sms').val() || $('#send_confirmation_email').val()) {
            $('#message_preview_container').show();
            updateMessagePreview();
        } else {
            $('#message_preview_container').hide();
        }
    });
    
    function updateMessagePreview() {
        let message = '';
        const smsOption = $('#send_confirmation_sms').val();
        const emailOption = $('#send_confirmation_email').val();
        const vendorName = $('#vendor1_first_name').val() || '<?php echo e($bookingAppraisal->vendor1_first_name); ?>' || 'NAME';
        const appointmentDate = $('#appointment_date').val() ? new Date($('#appointment_date').val()).toLocaleDateString() : '<?php echo e($bookingAppraisal->appointment_date); ?>' || 'DAY';
        const appointmentTime = $('#appointment_time').val() || '<?php echo e($bookingAppraisal->appointment_time); ?>' || 'TIME';
        
        if (smsOption === 'Message 1 - From Caitlyn') {
            message = `Hi ${vendorName}, Thank you for your time on the phone today — it was a pleasure speaking with you. Rob is looking forward to meeting with you on ${appointmentDate} at ${appointmentTime} to explore how he can best assist with your property goals. If there's anything you need in the lead-up, please feel free to reach out. Warm regards, Caitlyn Coster Executive Assistant to Robert Sheahan`;
        } else if (smsOption === 'Message 2 - From Caitlyn') {
            message = `Hi ${vendorName}, thanks again for your time today. Rob looks forward to meeting you on ${appointmentDate} at ${appointmentTime} to discuss your property plans. Let me know if I can help with anything before then. – Caitlyn, Executive Assistant to Robert Sheahan`;
        } else if (emailOption === 'Confirmation Email Version 1') {
            message = `Hi ${vendorName}, Thank you for your time on the phone today — it was lovely speaking with you. Rob is looking forward to meeting with you on ${appointmentDate} at ${appointmentTime} to discuss your property and how he can best support you with your real estate plans. Should you have any questions in the meantime, or if anything changes, please don't hesitate to get in touch. I'm here to help. Warm regards, Caitlyn Coster Executive Assistant to Robert Sheahan`;
        }
        
        $('#message_preview').val(message);
    }
    
    // Initialize fields based on current values
    if ($('#lead_source').val() === 'Other') {
        $('#lead_source_notes_container').show();
    }
    
    if ($('#is_vendor_selling').val() === 'Yes' || $('#is_vendor_selling').val() === 'Not Sure') {
        $('#moving_to_container').show();
        $('#when_listing_container').show();
    }
    
    if ($('#send_confirmation_sms').val() || $('#send_confirmation_email').val()) {
        $('#message_preview_container').show();
    }
    
    // Form submission handling
    $('#edit-appraisal-form').on('submit', function(e) {
        e.preventDefault();
        var form = $(this);
        var submitBtn = $('#submit-btn');
        
        // Clear previous validation errors
        $('.form-control').removeClass('is-invalid');
        $('.invalid-feedback').remove();
        
        submitBtn.prop('disabled', true).html('<i class="fas fa-spinner fa-spin mr-1"></i> Updating...');
        
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
                submitBtn.prop('disabled', false).html('<i class="fas fa-save mr-1"></i> Update Booking Appraisal');
                
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

    $('input, select, textarea').on('keyup change', function() {
        $(this).removeClass('is-invalid');
        $(this).next('.invalid-feedback').remove();
    });
    
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
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\ADMIN\Desktop\listr\resources\views/agents/booking-appraisal/edit.blade.php ENDPATH**/ ?>