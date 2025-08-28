@extends('layout.master')

@section('main_content')
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
                                    <h4 class="hot-head1"><i class="fas fa-calendar-plus mr-2"></i>Create New Booking
                                        Appraisal</h4>
                                    <a href="{{ url()->previous() }}" class="btn btn-outline-secondary">
                                        <i class="fas fa-arrow-left mr-1"></i> Back
                                    </a>
                                </div>

                                <form id="create-appraisal-form" class="form theme-form" method="POST"
                                    action="{{ route('agent.booking-appraisals.store') }}">
                                    @csrf

                                    <!-- Hidden field to store hot lead ID if applicable -->
                                    @if (isset($hotlead))
                                        <input type="hidden" name="hot_lead_id" value="{{ $hotlead->id }}">
                                    @endif

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
                                                        value="{{ isset($hotlead) ? $hotlead->vendor_address : old('address') }}"
                                                        placeholder="Enter property address" required>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label" for="property_type">Property Type *</label>
                                                    <select class="form-control" id="property_type" name="property_type"
                                                        required>
                                                        <option value="">Select Property Type</option>
                                                        <option value="House"
                                                            {{ old('property_type') == 'House' ? 'selected' : '' }}>House
                                                        </option>
                                                        <option value="Unit"
                                                            {{ old('property_type') == 'Unit' ? 'selected' : '' }}>Unit
                                                        </option>
                                                        <option value="Townhouse"
                                                            {{ old('property_type') == 'Townhouse' ? 'selected' : '' }}>
                                                            Townhouse</option>
                                                        <option value="Apartment"
                                                            {{ old('property_type') == 'Apartment' ? 'selected' : '' }}>
                                                            Apartment</option>
                                                        <option value="Land"
                                                            {{ old('property_type') == 'Land' ? 'selected' : '' }}>Land
                                                        </option>
                                                        <option value="Acreage"
                                                            {{ old('property_type') == 'Acreage' ? 'selected' : '' }}>
                                                            Acreage</option>
                                                        <option value="Rural"
                                                            {{ old('property_type') == 'Rural' ? 'selected' : '' }}>Rural
                                                        </option>
                                                        <option value="Block of Units"
                                                            {{ old('property_type') == 'Block of Units' ? 'selected' : '' }}>
                                                            Block of Units</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label" for="land_size">Land Size</label>
                                                    <input class="form-control" id="land_size" name="land_size"
                                                        type="text" value="{{ old('land_size') }}"
                                                        placeholder="Enter land size">
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="card-header card-head1 pb-0">
                                                    <h4 class="ven-head1"><span>Appointment Details</span></h4>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label" for="appointment_date">Appointment Date
                                                        *</label>
                                                    <input class="form-control" id="appointment_date"
                                                        name="appointment_date" type="date"
                                                        value="{{ old('appointment_date') }}" required>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label" for="appointment_time">Appointment Time
                                                        *</label>
                                                    <input class="form-control" id="appointment_time"
                                                        name="appointment_time" type="time"
                                                        value="{{ old('appointment_time') }}" required>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label" for="lead_source">Lead Source *</label>
                                                    <select class="form-control" id="lead_source" name="lead_source"
                                                        required>
                                                        <option value="">Select Lead Source</option>
                                                        <option value="Letter Drop"
                                                            {{ (isset($hotlead) && $hotlead->lead_source == 'Letter Drop') || old('lead_source') == 'Letter Drop' ? 'selected' : '' }}>
                                                            Letter Drop</option>
                                                        <option value="Referral"
                                                            {{ (isset($hotlead) && $hotlead->lead_source == 'Referral') || old('lead_source') == 'Referral' ? 'selected' : '' }}>
                                                            Referral</option>
                                                        <option value="Previous Client"
                                                            {{ (isset($hotlead) && $hotlead->lead_source == 'Previous Client') || old('lead_source') == 'Previous Client' ? 'selected' : '' }}>
                                                            Previous Client</option>
                                                        <option value="OFI"
                                                            {{ (isset($hotlead) && $hotlead->lead_source == 'OFI') || old('lead_source') == 'OFI' ? 'selected' : '' }}>
                                                            OFI</option>
                                                        <option value="Bus Stop"
                                                            {{ (isset($hotlead) && $hotlead->lead_source == 'Bus Stop') || old('lead_source') == 'Bus Stop' ? 'selected' : '' }}>
                                                            Bus Stop</option>
                                                        <option value="Door knocking"
                                                            {{ (isset($hotlead) && $hotlead->lead_source == 'Door knocking') || old('lead_source') == 'Door knocking' ? 'selected' : '' }}>
                                                            Door knocking</option>
                                                        <option value="Property Management"
                                                            {{ (isset($hotlead) && $hotlead->lead_source == 'Property Management') || old('lead_source') == 'Property Management' ? 'selected' : '' }}>
                                                            Property Management</option>
                                                        <option value="Internet Search"
                                                            {{ (isset($hotlead) && $hotlead->lead_source == 'Internet Search') || old('lead_source') == 'Internet Search' ? 'selected' : '' }}>
                                                            Internet Search</option>
                                                        <option value="Rate My Agent"
                                                            {{ (isset($hotlead) && $hotlead->lead_source == 'Rate My Agent') || old('lead_source') == 'Rate My Agent' ? 'selected' : '' }}>
                                                            Rate My Agent</option>
                                                        <option value="Other"
                                                            {{ (isset($hotlead) && $hotlead->lead_source == 'Other') || old('lead_source') == 'Other' ? 'selected' : '' }}>
                                                            Other</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label" for="category">Category</label>
                                                    <select class="form-control" id="category" name="category">
                                                        <option value="">Select category</option>
                                                        <option value="Hot"
                                                            {{ (isset($hotlead) && $hotlead->category == 'hot') || old('category') == 'Hot' ? 'selected' : '' }}>
                                                            Hot</option>
                                                        <option value="Warm"
                                                            {{ (isset($hotlead) && $hotlead->category == 'warm') || old('category') == 'Warm' ? 'selected' : '' }}>
                                                            Warm</option>
                                                        <option value="Cold"
                                                            {{ (isset($hotlead) && $hotlead->category == 'cold') || old('category') == 'Cold' ? 'selected' : '' }}>
                                                            Cold</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-md-12">
                                                <div class="card-header card-head1 pb-0">
                                                    <h4 class="ven-head1"><span>Property Details</span></h4>
                                                </div>
                                            </div>

                                            <!-- Bedrooms -->
                                            <div class="col-md-12">
                                                <div class="mb-3">
                                                    <label class="form-label">Bedrooms</label>
                                                    <div class="button-group">
                                                        <button type="button" class="option-btn" data-field="bedrooms"
                                                            data-value="1">1</button>
                                                        <button type="button" class="option-btn" data-field="bedrooms"
                                                            data-value="2">2</button>
                                                        <button type="button" class="option-btn" data-field="bedrooms"
                                                            data-value="3">3</button>
                                                        <button type="button" class="option-btn" data-field="bedrooms"
                                                            data-value="4">4</button>
                                                        {{-- <button type="button" class="option-btn" data-field="bedrooms" data-value="5">5</button>
                                                    <button type="button" class="option-btn" data-field="bedrooms" data-value="6+">6+</button> --}}
                                                    </div>
                                                    <input type="hidden" id="bedrooms" name="bedrooms"
                                                        value="{{ old('bedrooms') }}">
                                                    <div class="custom-input-container" id="bedrooms-custom"
                                                        style="display: none;">
                                                        <label class="form-label">Enter number of bedrooms:</label>
                                                        <input type="number" class="form-control" min="6"
                                                            placeholder="Enter number" style="max-width: 200px;">
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Bathrooms -->
                                            <div class="col-md-12">
                                                <div class="mb-3">
                                                    <label class="form-label">Bathrooms</label>
                                                    <div class="button-group">
                                                        <button type="button" class="option-btn" data-field="bathrooms"
                                                            data-value="1">1</button>
                                                        <button type="button" class="option-btn" data-field="bathrooms"
                                                            data-value="2">2</button>
                                                        <button type="button" class="option-btn" data-field="bathrooms"
                                                            data-value="3">3</button>
                                                        <button type="button" class="option-btn" data-field="bathrooms"
                                                            data-value="4">4</button>
                                                        {{-- <button type="button" class="option-btn" data-field="bathrooms" data-value="5">5</button>
                                                    <button type="button" class="option-btn" data-field="bathrooms" data-value="6+">6+</button> --}}
                                                    </div>
                                                    <input type="hidden" id="bathrooms" name="bathrooms"
                                                        value="{{ old('bathrooms') }}">
                                                    <div class="custom-input-container" id="bathrooms-custom"
                                                        style="display: none;">
                                                        <label class="form-label">Enter number of bathrooms:</label>
                                                        <input type="number" class="form-control" min="6"
                                                            placeholder="Enter number" style="max-width: 200px;">
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Living Areas -->
                                            <div class="col-md-12">
                                                <div class="mb-3">
                                                    <label class="form-label">Living Areas</label>
                                                    <div class="button-group">
                                                        <button type="button" class="option-btn"
                                                            data-field="living_areas" data-value="1">1</button>
                                                        <button type="button" class="option-btn"
                                                            data-field="living_areas" data-value="2">2</button>
                                                        <button type="button" class="option-btn"
                                                            data-field="living_areas" data-value="3">3</button>
                                                        <button type="button" class="option-btn"
                                                            data-field="living_areas" data-value="4">4</button>
                                                        {{-- <button type="button" class="option-btn" data-field="living_areas" data-value="5">5</button>
                                                    <button type="button" class="option-btn" data-field="living_areas" data-value="6+">6+</button> --}}
                                                    </div>
                                                    <input type="hidden" id="living_areas" name="living_areas"
                                                        value="{{ old('living_areas') }}">
                                                    <div class="custom-input-container" id="living_areas-custom"
                                                        style="display: none;">
                                                        <label class="form-label">Enter number of living areas:</label>
                                                        <input type="number" class="form-control" min="6"
                                                            placeholder="Enter number" style="max-width: 200px;">
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Study -->
                                            <div class="col-md-12">
                                                <div class="mb-3">
                                                    <label class="form-label">Study</label>
                                                    <div class="button-group">
                                                        <button type="button" class="option-btn" data-field="study"
                                                            data-value="1">1</button>
                                                        <button type="button" class="option-btn" data-field="study"
                                                            data-value="2">2</button>
                                                        <button type="button" class="option-btn" data-field="study"
                                                            data-value="3">3</button>
                                                        {{-- <button type="button" class="option-btn" data-field="study" data-value="4">4</button>
                                                    <button type="button" class="option-btn" data-field="study" data-value="5">5</button>
                                                    <button type="button" class="option-btn" data-field="study" data-value="6+">6+</button> --}}
                                                    </div>
                                                    <input type="hidden" id="study" name="study"
                                                        value="{{ old('study') }}">
                                                    <div class="custom-input-container" id="study-custom"
                                                        style="display: none;">
                                                        <label class="form-label">Enter number of studies:</label>
                                                        <input type="number" class="form-control" min="6"
                                                            placeholder="Enter number" style="max-width: 200px;">
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Under Cover Parking -->
                                            <div class="col-md-12">
                                                <div class="mb-3">
                                                    <label class="form-label">Under Cover Parking</label>
                                                    <div class="button-group">
                                                        <button type="button" class="option-btn"
                                                            data-field="under_cover_parking" data-value="1">1</button>
                                                        <button type="button" class="option-btn"
                                                            data-field="under_cover_parking" data-value="2">2</button>
                                                        {{-- <button type="button" class="option-btn" data-field="under_cover_parking" data-value="3">3</button>
                                                    <button type="button" class="option-btn" data-field="under_cover_parking" data-value="4">4</button>
                                                    <button type="button" class="option-btn" data-field="under_cover_parking" data-value="5">5</button>
                                                    <button type="button" class="option-btn" data-field="under_cover_parking" data-value="6+">6+</button> --}}
                                                    </div>
                                                    <input type="hidden" id="under_cover_parking"
                                                        name="under_cover_parking"
                                                        value="{{ old('under_cover_parking') }}">
                                                    <div class="custom-input-container" id="under_cover_parking-custom"
                                                        style="display: none;">
                                                        <label class="form-label">Enter number of parking spaces:</label>
                                                        <input type="number" class="form-control" min="6"
                                                            placeholder="Enter number" style="max-width: 200px;">
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Parking Type -->
                                            <div class="col-md-6" id="under_cover_parking_type_div"
                                                style="display:none;">
                                                <div class="mb-3">
                                                    <label class="form-label" for="under_cover_parking_type">Parking
                                                        Type</label>
                                                    <select class="form-select" id="under_cover_parking_type"
                                                        name="under_cover_parking_type">
                                                        <option value="">Select type</option>
                                                        <option value="Garage"
                                                            {{ old('under_cover_parking_type') == 'Garage' ? 'selected' : '' }}>
                                                            Garage</option>
                                                        <option value="Carport"
                                                            {{ old('under_cover_parking_type') == 'Carport' ? 'selected' : '' }}>
                                                            Carport</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label" for="condition">Condition</label>
                                                    <select class="form-control" id="condition" name="condition">
                                                        <option value="">Select Condition</option>
                                                        <option value="Fully Renovated"
                                                            {{ old('condition') == 'Fully Renovated' ? 'selected' : '' }}>
                                                            Fully Renovated</option>
                                                        <option value="Updated Recently"
                                                            {{ old('condition') == 'Updated Recently' ? 'selected' : '' }}>
                                                            Updated Recently</option>
                                                        <option value="Updated a While Ago"
                                                            {{ old('condition') == 'Updated a While Ago' ? 'selected' : '' }}>
                                                            Updated a While Ago</option>
                                                        <option value="Neat and Tidy – Not Renovated"
                                                            {{ old('condition') == 'Neat and Tidy – Not Renovated' ? 'selected' : '' }}>
                                                            Neat and Tidy – Not Renovated</option>
                                                        <option value="Original – Needs Work"
                                                            {{ old('condition') == 'Original – Needs Work' ? 'selected' : '' }}>
                                                            Original – Needs Work</option>
                                                        <option value="Brand New"
                                                            {{ old('condition') == 'Brand New' ? 'selected' : '' }}>Brand
                                                            New</option>
                                                        <option value="Land value"
                                                            {{ old('condition') == 'Land value' ? 'selected' : '' }}>Land
                                                            value</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-md-12">
                                                <div class="mb-3">
                                                    <label class="form-label" for="what_was_updated">What was updated and
                                                        when?</label>
                                                    <textarea class="form-control" id="what_was_updated" name="what_was_updated" rows="3"
                                                        placeholder="E.g. Kitchen 2022, bathroom 2015, flooring and paint 2019">{{ old('what_was_updated') }}</textarea>
                                                </div>
                                            </div>

                                            <div class="col-md-12">
                                                <div class="card-header card-head1 pb-0">
                                                    <h4 class="ven-head1"><span>Vendor 1 Information</span></h4>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label" for="vendor1_first_name">First Name
                                                        *</label>
                                                    <input class="form-control" id="vendor1_first_name"
                                                        name="vendor1_first_name" type="text"
                                                        value="{{ isset($hotlead) ? $hotlead->vendor_first_name : old('vendor1_first_name') }}"
                                                        placeholder="Enter first name" required>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label" for="vendor1_last_name">Last Name *</label>
                                                    <input class="form-control" id="vendor1_last_name"
                                                        name="vendor1_last_name" type="text"
                                                        value="{{ isset($hotlead) ? $hotlead->vendor_last_name : old('vendor1_last_name') }}"
                                                        placeholder="Enter last name" required>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label" for="vendor1_mobile">Mobile *</label>
                                                    <input class="form-control" id="vendor1_mobile" name="vendor1_mobile"
                                                        type="text"
                                                        value="{{ isset($hotlead) ? $hotlead->vendor_mobile : old('vendor1_mobile') }}"
                                                        placeholder="Enter mobile number" required>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label" for="vendor1_email">Email *</label>
                                                    <input class="form-control" id="vendor1_email" name="vendor1_email"
                                                        type="email"
                                                        value="{{ isset($hotlead) ? $hotlead->vendor_email : old('vendor1_email') }}"
                                                        placeholder="Enter email address" required>
                                                </div>
                                            </div>

                                            <div class="col-md-12">
                                                <label class="form-label">Add Vendor?</label>
                                                <div class="mb-3 m-t-15 custom-radio-ml">
                                                    <div class="form-check radio radio-primary">
                                                        <input class="form-check-input" id="has_additional_vendor_yes"
                                                            type="radio" name="has_additional_vendor" value="1">
                                                        <label class="form-check-label"
                                                            for="has_additional_vendor_yes">Yes</label>
                                                    </div>
                                                    <div class="form-check radio radio-primary">
                                                        <input class="form-check-input" id="has_additional_vendor_no"
                                                            type="radio" name="has_additional_vendor" value="0">
                                                        <label class="form-check-label"
                                                            for="has_additional_vendor_no">No</label>
                                                    </div>
                                                </div>

                                                <!-- Vendor 2 Fields (Hidden by default) -->

                                                <div id="vendor2Fields" style="display: none;">
                                                    <div class="col-md-12">
                                                        <div class="card-header card-head1 pb-0">
                                                            <h4 class="ven-head1"><span>Vendor 2 Information (if
                                                                    applicable)</span>
                                                            </h4>
                                                        </div>
                                                    </div>
                                                    <div class="row">

                                                        <div class="col-md-6">
                                                            <div class="mb-3">
                                                                <label class="form-label" for="vendor2_first_name">First
                                                                    Name</label>
                                                                <input class="form-control" id="vendor2_first_name"
                                                                    name="vendor2_first_name" type="text"
                                                                    placeholder="First Name">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="mb-3">
                                                                <label class="form-label" for="vendor2_last_name">Last
                                                                    Name</label>
                                                                <input class="form-control" id="vendor2_last_name"
                                                                    name="vendor2_last_name" type="text"
                                                                    placeholder="Last Name">
                                                            </div>
                                                        </div>

                                                        <div class="col-md-6">
                                                            <div class="mb-3">
                                                                <label class="form-label"
                                                                    for="vendor2_mobile">Mobile</label>
                                                                <input class="form-control" id="vendor2_mobile"
                                                                    name="vendor2_mobile" type="text" placeholder="">
                                                            </div>
                                                        </div>

                                                        <div class="col-md-6">
                                                            <div class="mb-3">
                                                                <label class="form-label"
                                                                    for="vendor2_email">Email</label>
                                                                <input class="form-control" id="vendor2_email"
                                                                    name="vendor2_email" type="email" placeholder="">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- Main contact choice -->
                                                <div class="col-md-12">
                                                    <div class="mb-3">
                                                        <label class="form-label">Main point of contact</label>
                                                        <div class="form-check radio radio-primary">
                                                            <input class="form-check-input" id="main_contact_vendor1"
                                                                type="radio" name="main_contact" value="Vendor 1">
                                                            <label class="form-check-label"
                                                                for="main_contact_vendor1">Vendor 1</label>
                                                        </div>
                                                        <div class="form-check radio radio-primary">
                                                            <input class="form-check-input" id="main_contact_vendor2"
                                                                type="radio" name="main_contact" value="Vendor 2">
                                                            <label class="form-check-label"
                                                                for="main_contact_vendor2">Vendor 2</label>
                                                        </div>
                                                        <div class="form-check radio radio-primary">
                                                            <input class="form-check-input" id="main_contact_someone_else"
                                                                type="radio" name="main_contact" value="Someone Else">
                                                            <label class="form-check-label"
                                                                for="main_contact_someone_else">Someone Else</label>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- Someone Else fields (hidden by default) -->
                                                <div id="someone-else-fields" style="display: none;">
                                                    <div class="col-md-6">
                                                        <div class="mb-3">
                                                            <label class="form-label" for="main_contact_first_name">Main
                                                                contact's first name</label>
                                                            <input class="form-control" id="main_contact_first_name"
                                                                name="main_contact_first_name" type="text">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="mb-3">
                                                            <label class="form-label" for="main_contact_last_name">Last
                                                                name</label>
                                                            <input class="form-control" id="main_contact_last_name"
                                                                name="main_contact_last_name" type="text">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="mb-3">
                                                            <label class="form-label"
                                                                for="main_contact_mobile">Mobile</label>
                                                            <input class="form-control" id="main_contact_mobile"
                                                                name="main_contact_mobile" type="text">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="mb-3">
                                                            <label class="form-label"
                                                                for="main_contact_email">Email</label>
                                                            <input class="form-control" id="main_contact_email"
                                                                name="main_contact_email" type="email">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>





                                            <div class="col-md-12 form-field-hidden" id="lead_source_notes_container"
                                                style="display: none;">
                                                <div class="mb-3">
                                                    <label class="form-label" for="lead_source_notes">Lead Source
                                                        Notes</label>
                                                    <textarea class="form-control" id="lead_source_notes" name="lead_source_notes" rows="2"
                                                        placeholder="If the client's lead source wasn't in the list, briefly describe how they found us or who referred them">{{ old('lead_source_notes') }}</textarea>
                                                </div>
                                            </div>

                                            <div class="col-md-12">
                                                <div class="card-header card-head1 pb-0">
                                                    <h4 class="ven-head1"><span>Selling Details</span></h4>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label" for="is_vendor_selling">Is The Vendor
                                                        Selling? *</label>
                                                    <select class="form-control" id="is_vendor_selling"
                                                        name="is_vendor_selling" required>
                                                        <option value="">Select Option</option>
                                                        <option value="Yes"
                                                            {{ old('is_vendor_selling') == 'Yes' ? 'selected' : '' }}>Yes
                                                        </option>
                                                        <option value="Not Sure"
                                                            {{ old('is_vendor_selling') == 'Not Sure' ? 'selected' : '' }}>
                                                            Not Sure</option>
                                                        <option value="No"
                                                            {{ old('is_vendor_selling') == 'No' ? 'selected' : '' }}>No
                                                        </option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-md-6 form-field-hidden" id="moving_to_container"
                                                style="display: none;">
                                                <div class="mb-3">
                                                    <label class="form-label" for="moving_to">If Selling, WHERE is the
                                                        vendor moving to?</label>
                                                    <input class="form-control" id="moving_to" name="moving_to"
                                                        type="text" value="{{ old('moving_to') }}"
                                                        placeholder="Enter location">
                                                </div>
                                            </div>

                                            <div class="col-md-6 form-field-hidden" id="when_listing_container"
                                                style="display: none;">
                                                <div class="mb-3">
                                                    <label class="form-label" for="when_listing">If moving, WHEN are they
                                                        looking to have their property listed?</label>
                                                    <input class="form-control" id="when_listing" name="when_listing"
                                                        type="text" value="{{ old('when_listing') }}"
                                                        placeholder="Enter timeframe">
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="card-header card-head1 pb-0">
                                                    <h4 class="ven-head1"><span>Confirmation Details</span></h4>
                                                </div>
                                            </div>

                                            <!-- SMS Section -->
                                            <div class="col-md-12 mt-4">
                                                <div class="card-header card-head1 pb-0">
                                                    <h4>SMS Sample</h4>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="mb-3">
                                                    <label class="form-label">Follow Up SMS Template</label>
                                                    <select name="followup_sms_template" id="sms_template_select"
                                                        class="form-select">
                                                        <option value="">Please Select</option>
                                                        @forelse($smsTemplates as $template)
                                                            <option value="{{ $template->id }}"
                                                                data-content="{{ $template->content }}">
                                                                {{ $template->name }}</option>
                                                        @empty
                                                            <option value="" disabled>No SMS templates found</option>
                                                        @endforelse
                                                    </select>
                                                    @if (count($smsTemplates) === 0)
                                                        <div class="mt-2">
                                                            <a href="{{ route('agent.templates.index') }}"
                                                                class="btn btn-sm btn-outline-primary">
                                                                <i class="mdi mdi-plus me-1"></i>Create SMS Template
                                                            </a>
                                                        </div>
                                                    @endif
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">SMS Preview</label>
                                                    <textarea name="sms_preview" id="sms_preview" class="form-control" rows="3" readonly>Select a template to preview</textarea>
                                                </div>
                                            </div>

                                            <!-- Email Section -->
                                            <div class="col-md-12 mt-4">
                                                <div class="card-header card-head1 pb-0">
                                                    <h4>Email Sample</h4>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="mb-3">
                                                    <label class="form-label">Follow-up Email Template</label>
                                                    <select name="followup_email_template" id="email_template_select"
                                                        class="form-select">
                                                        <option value="">Please Select</option>
                                                        @forelse($emailTemplates as $template)
                                                            <option value="{{ $template->id }}"
                                                                data-content="{{ $template->content }}"
                                                                data-subject="{{ $template->subject }}">
                                                                {{ $template->name }}</option>
                                                        @empty
                                                            <option value="" disabled>No Email templates found
                                                            </option>
                                                        @endforelse
                                                    </select>
                                                    @if (count($emailTemplates) === 0)
                                                        <div class="mt-2">
                                                            <a href="{{ route('agent.templates.index') }}"
                                                                class="btn btn-sm btn-outline-primary">
                                                                <i class="mdi mdi-plus me-1"></i>Create Email Template
                                                            </a>
                                                        </div>
                                                    @endif
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Email Subject</label>
                                                    <input type="text" name="email_subject" id="email_subject"
                                                        class="form-control" readonly>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Email Preview</label>
                                                    <textarea name="email_preview" id="email_preview" class="form-control" rows="5" readonly>Select a template to preview</textarea>
                                                </div>
                                            </div>




                                            <div class="col-md-12 form-field-hidden" id="message_preview_container"
                                                style="display: none;">
                                                <div class="mb-3">
                                                    <label class="form-label" for="message_preview">Message
                                                        Preview</label>
                                                    <textarea class="form-control" id="message_preview" name="message_preview" rows="4"
                                                        placeholder="Message preview will appear here">{{ old('message_preview') }}</textarea>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label" for="save_to_crm">Save this Appraisal in the
                                                        CRM?</label>
                                                    <select class="form-control" id="save_to_crm" name="save_to_crm">
                                                        <option
                                                            value="Yes – create a record for tracking and lead ownership"
                                                            {{ old('save_to_crm', 'Yes – create a record for tracking and lead ownership') == 'Yes – create a record for tracking and lead ownership' ? 'selected' : '' }}
                                                            selected>Yes – create a record for tracking and lead ownership
                                                        </option>
                                                        <option value="No – do not save"
                                                            {{ old('save_to_crm') == 'No – do not save' ? 'selected' : '' }}>
                                                            No – do not save</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label" for="comparable_sales">Comparable Sales
                                                        Required</label>
                                                    <select class="form-control" id="comparable_sales"
                                                        name="comparable_sales">
                                                        <option value="">Select Option</option>
                                                        <option value="Yes - Printed + Emailed"
                                                            {{ old('comparable_sales') == 'Yes - Printed + Emailed' ? 'selected' : '' }}>
                                                            Yes - Printed + Emailed</option>
                                                        <option value="Yes - Email Only"
                                                            {{ old('comparable_sales') == 'Yes - Email Only' ? 'selected' : '' }}>
                                                            Yes - Email Only</option>
                                                        <option value="Yes - Printed Only"
                                                            {{ old('comparable_sales') == 'Yes - Printed Only' ? 'selected' : '' }}>
                                                            Yes - Printed Only</option>
                                                        <option value="No - Not Required"
                                                            {{ old('comparable_sales') == 'No - Not Required' ? 'selected' : '' }}>
                                                            No - Not Required</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-md-12">
                                                <div class="mb-3">
                                                    <label class="form-label" for="additional_notes">Additional
                                                        Notes</label>
                                                    <textarea class="form-control" id="additional_notes" name="additional_notes" rows="3"
                                                        placeholder="Enter any additional notes">{{ isset($hotlead) ? $hotlead->quick_notes : old('additional_notes') }}</textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="card-footer text-end">
                                        <button class="btn btn-primary" type="submit" id="submit-btn">
                                            <i class="fas fa-save mr-1"></i> Create Booking Appraisal
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
        .page-body1 {
            padding: 0px;
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

        .hot-head1,
        .ven-head1 h4 {
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

        /* Button Group Styles */
        .button-group {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
            margin-bottom: 10px;
        }

        .option-btn {
            border: 2px solid #e9ecef;
            background: white;
            color: #495057;
            padding: 12px 20px;
            border-radius: 50px;
            font-size: 14px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s ease;
            min-width: 60px;
            text-align: center;
        }

        .option-btn:hover {
            border-color: #007bff;
            color: #007bff;
            transform: translateY(-1px);
        }

        .option-btn.active {
            background: #2d3748;
            color: white;
            border-color: #2d3748;
        }

        .custom-input-container {
            margin-top: 15px;
            padding: 15px;
            background: #f8f9fa;
            border-radius: 8px;
            border: 1px solid #e9ecef;
        }

        .custom-input-container label {
            font-size: 13px;
            color: #6c757d;
            margin-bottom: 8px;
        }
    </style>

    <script>
        $(document).ready(function() {

            $("input[name='has_additional_vendor']").on("change", function() {
                if ($(this).val() === "1") {
                    $("#vendor2Fields").slideDown();
                } else {
                    $("#vendor2Fields").slideUp();
                    $("#vendor2Fields input").val(""); // clear values when hidden
                }
            });

            // Toggle "Someone Else" fields
            $("input[name='main_contact']").on("change", function() {
                if ($(this).val() === "Someone Else") {
                    $("#someone-else-fields").slideDown();
                } else {
                    $("#someone-else-fields").slideUp();
                    $("#someone-else-fields input").val(""); // clear values when hidden
                }
            });

            // Run on load (restore state if form is repopulated)
            if ($("input[name='has_additional_vendor']:checked").val() === "1") {
                $("#vendor2Fields").show();
            }
            if ($("input[name='main_contact']:checked").val() === "Someone Else") {
                $("#someone-else-fields").show();
            }
            // Check if we have a hotlead and prefill fields
            @if (isset($hotlead))
                console.log("Hot lead data loaded:", @json($hotlead));
            @endif

            // Handle option button clicks
            $('.option-btn').on('click', function() {
                const field = $(this).data('field');
                const value = $(this).data('value');

                // Remove active class from siblings
                $(this).siblings('.option-btn').removeClass('active');

                // Add active class to clicked button
                $(this).addClass('active');

                // Handle 6+ case
                if (value === '6+') {
                    $(`#${field}-custom`).show();

                    // For under_cover_parking, set a temporary value to keep parking type visible
                    if (field === 'under_cover_parking') {
                        $(`#${field}`).val('6'); // Set minimum value to keep parking type visible
                    } else {
                        $(`#${field}`).val(''); // Clear hidden field until custom value is entered
                    }

                    // Focus on custom input
                    $(`#${field}-custom input`).focus();
                } else {
                    $(`#${field}-custom`).hide();
                    $(`#${field}`).val(value);
                }

                // Special handling for under_cover_parking to show/hide parking type
                if (field === 'under_cover_parking') {
                    toggleParkingType();
                }
            });

            // Handle custom input changes
            $('.custom-input-container input').on('input', function() {
                const container = $(this).closest('.custom-input-container');
                const field = container.attr('id').replace('-custom', '');
                const value = $(this).val();

                if (value && parseInt(value) >= 6) {
                    $(`#${field}`).val(value);

                    // Special handling for under_cover_parking to show/hide parking type
                    if (field === 'under_cover_parking') {
                        toggleParkingType();
                    }
                }
            });

            // Set initial values based on old input (for form validation errors)
            @if (old('bedrooms'))
                setInitialValue('bedrooms', '{{ old('bedrooms') }}');
            @endif
            @if (old('bathrooms'))
                setInitialValue('bathrooms', '{{ old('bathrooms') }}');
            @endif
            @if (old('living_areas'))
                setInitialValue('living_areas', '{{ old('living_areas') }}');
            @endif
            @if (old('study'))
                setInitialValue('study', '{{ old('study') }}');
            @endif
            @if (old('under_cover_parking'))
                setInitialValue('under_cover_parking', '{{ old('under_cover_parking') }}');
            @endif

            function setInitialValue(field, value) {
                if (parseInt(value) >= 6) {
                    $(`.option-btn[data-field="${field}"][data-value="6+"]`).addClass('active');
                    $(`#${field}-custom`).show();
                    $(`#${field}-custom input`).val(value);
                } else {
                    $(`.option-btn[data-field="${field}"][data-value="${value}"]`).addClass('active');
                }
                $(`#${field}`).val(value);
            }

            function toggleParkingType() {
                const parkingValue = $('#under_cover_parking').val();
                const parkingTypeDiv = $('#under_cover_parking_type_div');

                if (parseInt(parkingValue) > 0) {
                    parkingTypeDiv.show();
                } else {
                    parkingTypeDiv.hide();
                    $('#under_cover_parking_type').val('');
                }
            }

            // Initialize parking type visibility on load
            toggleParkingType();

            $('#lead_source').change(function() {
                if ($(this).val() === 'Other') {
                    $('#lead_source_notes_container').show();
                } else {
                    $('#lead_source_notes_container').hide();
                }
            });

            $('#is_vendor_selling').change(function() {
                if ($(this).val() === 'Yes') {
                    $('#moving_to_container').show();
                    $('#when_listing_container').show();
                } else {
                    $('#moving_to_container').hide();
                    $('#when_listing_container').hide();
                }
            });

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
                const vendorName = $('#vendor1_first_name').val() || 'NAME';
                const appointmentDate = $('#appointment_date').val() ? new Date($('#appointment_date').val())
                    .toLocaleDateString() : 'DAY';
                const appointmentTime = $('#appointment_time').val() || 'TIME';

                if (smsOption === 'Message 1 - From Caitlyn') {
                    message =
                        `Hi ${vendorName}, Thank you for your time on the phone today — it was a pleasure speaking with you. Rob is looking forward to meeting with you on ${appointmentDate} at ${appointmentTime} to explore how he can best assist with your property goals. If there's anything you need in the lead-up, please feel free to reach out. Warm regards, Caitlyn Coster Executive Assistant to Robert Sheahan`;
                } else if (smsOption === 'Message 2 - From Caitlyn') {
                    message =
                        `Hi ${vendorName}, thanks again for your time today. Rob looks forward to meeting you on ${appointmentDate} at ${appointmentTime} to discuss your property plans. Let me know if I can help with anything before then. – Caitlyn, Executive Assistant to Robert Sheahan`;
                } else if (emailOption === 'Confirmation Email Version 1') {
                    message =
                        `Hi ${vendorName}, Thank you for your time on the phone today — it was lovely speaking with you. Rob is looking forward to meeting with you on ${appointmentDate} at ${appointmentTime} to discuss your property and how he can best support you with your real estate plans. Should you have any questions in the meantime, or if anything changes, please don't hesitate to get in touch. I'm here to help. Warm regards, Caitlyn Coster Executive Assistant to Robert Sheahan`;
                }

                $('#message_preview').val(message);
            }

            // Function to replace template placeholders with form data
            function replaceTemplatePlaceholders(content) {
                var vendorFirstName = $('#vendor1_first_name').val();
                var vendorLastName = $('#vendor1_last_name').val();
                var vendorEmail = $('#vendor1_email').val();
                var vendorMobile = $('#vendor1_mobile').val();
                var address = $('#address').val();
                var appointmentDate = $('#appointment_date').val();
                var appointmentTime = $('#appointment_time').val();

                // Create full vendor name
                var vendorFullName = '';
                if (vendorFirstName && vendorLastName) {
                    vendorFullName = vendorFirstName + ' ' + vendorLastName;
                } else if (vendorFirstName) {
                    vendorFullName = vendorFirstName;
                }

                // Format appointment date if available
                var formattedAppointmentDate = '';
                if (appointmentDate) {
                    formattedAppointmentDate = new Date(appointmentDate).toLocaleDateString();
                }

                // Replace placeholders only if data is available
                if (vendorFullName) {
                    content = content.replace(/\[Vendor Name\]/g, vendorFullName);
                }

                if (vendorFirstName) {
                    content = content.replace(/\[Vendor First Name\]/g, vendorFirstName);
                }

                if (vendorLastName) {
                    content = content.replace(/\[Vendor Last Name\]/g, vendorLastName);
                }

                if (vendorEmail) {
                    content = content.replace(/\[Vendor Email\]/g, vendorEmail);
                }

                if (vendorMobile) {
                    content = content.replace(/\[Vendor Mobile\]/g, vendorMobile)
                        .replace(/\[Phone Number\]/g, vendorMobile);
                }

                if (address) {
                    content = content.replace(/\[Property Address\/Location\]/g, address)
                        .replace(/\[Property Address\]/g, address)
                        .replace(/\[Property Location\]/g, address);
                }

                if (formattedAppointmentDate) {
                    content = content.replace(/\[Appointment Date\]/g, formattedAppointmentDate);
                }

                if (appointmentTime) {
                    content = content.replace(/\[Appointment Time\]/g, appointmentTime);
                }

                // Replace company-related placeholders
                content = content.replace(/\[Your Company Name\]/g, 'Your Company Name')
                    .replace(/\[Company Name\]/g, 'Your Company Name')
                    .replace(/\[Agent Name\]/g, 'Your Agent');

                return content;
            }

            // SMS Template Preview
            $('#sms_template_select').change(function() {
                var selectedOption = $(this).find('option:selected');
                var content = selectedOption.data('content');

                if (content) {
                    var previewContent = replaceTemplatePlaceholders(content);
                    $('#sms_preview').val(previewContent);
                } else {
                    $('#sms_preview').val('Select a template to preview');
                }
            });

            // Email Template Preview
            $('#email_template_select').change(function() {
                var selectedOption = $(this).find('option:selected');
                var content = selectedOption.data('content');
                var subject = selectedOption.data('subject');

                if (content) {
                    // Replace placeholders in subject
                    var previewSubject = replaceTemplatePlaceholders(subject || '');
                    $('#email_subject').val(previewSubject);

                    // Replace placeholders in content
                    var previewContent = replaceTemplatePlaceholders(content);
                    $('#email_preview').val(previewContent);
                } else {
                    $('#email_subject').val('');
                    $('#email_preview').val('Select a template to preview');
                }
            });

            // Update previews when vendor information changes
            $('#vendor1_first_name, #vendor1_last_name, #vendor1_email, #vendor1_mobile, #address, #appointment_date, #appointment_time')
                .on('keyup change', function() {
                    // Update SMS preview if a template is selected
                    if ($('#sms_template_select').val()) {
                        $('#sms_template_select').trigger('change');
                    }

                    // Update Email preview if a template is selected
                    if ($('#email_template_select').val()) {
                        $('#email_template_select').trigger('change');
                    }

                    // Update confirmation message preview
                    updateMessagePreview();
                });

            function toggleUpdatedField() {
                let condition = $("#condition").val();
                if (condition === "Updated Recently" || condition === "Updated a While Ago") {
                    $("#what_was_updated").closest(".col-md-12").show();
                } else {
                    $("#what_was_updated").closest(".col-md-12").hide();
                    $("#what_was_updated").val(""); // optional: clear text if hidden
                }
            }

            // Run on page load (in case of old value from validation)
            toggleUpdatedField();

            // Run whenever the dropdown changes
            $("#condition").on("change", toggleUpdatedField);
            // Form submission handling
            $('#create-appraisal-form').on('submit', function(e) {
                e.preventDefault();
                var form = $(this);
                var submitBtn = $('#submit-btn');

                // Clear previous validation errors
                $('.form-control').removeClass('is-invalid');
                $('.invalid-feedback').remove();

                submitBtn.prop('disabled', true).html(
                    '<i class="fas fa-spinner fa-spin mr-1"></i> Processing...');

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
                        submitBtn.prop('disabled', false).html(
                            '<i class="fas fa-save mr-1"></i> Create Booking Appraisal');

                        if (xhr.status === 422) {
                            var errors = xhr.responseJSON.errors;
                            $.each(errors, function(key, value) {
                                $('#' + key).addClass('is-invalid');
                                $('#' + key).after('<div class="invalid-feedback">' +
                                    value[0] + '</div>');
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

            $('#lead_source').trigger('change');
            $('#is_vendor_selling').trigger('change');
        });
    </script>
@endsection
