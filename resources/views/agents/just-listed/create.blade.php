@extends('layout.master')

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
                                    <h4 class="hot-head1"><i class="fas fa-home mr-2"></i>Just Listed Form</h4>
                                    <a href="{{ url()->previous() }}" class="btn btn-outline-secondary">
                                        <i class="fas fa-arrow-left mr-1"></i> Back
                                    </a>
                                </div>

                                <div class="container-fluid py-4">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="card">
                                                <div class="card-header d-flex justify-content-between align-items-center">
                                                    <h4>Appraisal Data</h4>

                                                </div>
                                                <div class="card-body">
                                                    <div class="table-container" id="appraisalForm">
                                                        <table class="table table-hover" id="appraisalTable">
                                                            <thead>
                                                                <tr>
                                                                    <th>Select</th>
                                                                    <th>Full Name</th>
                                                                    <th>Property Address</th>
                                                                    <th>Created</th> <!-- Updated header -->
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @foreach ($allAppraisals as $appraisal)
                                                                    <tr data-appraisal='@json($appraisal)'>
                                                                        <td>
                                                                            <div class="form-check form-switch">
                                                                                <input
                                                                                    class="form-check-input select-checkbox"
                                                                                    type="checkbox" role="switch"
                                                                                    id="flexSwitchCheck{{ $appraisal->id }}">
                                                                            </div>
                                                                        </td>
                                                                        <td>{{ $appraisal->vendor1_first_name }}
                                                                            {{ $appraisal->vendor1_last_name }}</td>
                                                                        <td>{{ $appraisal->vendor1_address }}</td>
                                                                        <td>{{ $appraisal->created_at->diffForHumans() }}
                                                                        </td> <!-- Human-readable -->
                                                                    </tr>
                                                                @endforeach
                                                            </tbody>
                                                        </table>


                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <form id="justListedForm" class="form theme-form" enctype="multipart/form-data">
                                    <div class="card-body">
                                        <div class="row">
                                            <!-- Address Field at the Top (Requirement 45) -->
                                            <div class="col-md-8">
                                                <div class="card-header mb-2">
                                                    <h4>Property Address *</h4>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label" for="property_address">Address</label>
                                                    <textarea class="form-control" id="property_address" name="vendor1_address" rows="3" required>{{ $appraisalData['vendor1_address'] ?? old('property_address') }}</textarea>
                                                </div>
                                            </div>

                                            <div class="col-md-12">
                                                <div class="card-header mb-2">
                                                    <h4>Vendor 1:</h4>
                                                </div>
                                            </div>
                                            <!-- In your just listed form view -->
                                            @if (isset($appraisalData))
                                                <input type="hidden" name="conduct_appraisal_id"
                                                    value="{{ $appraisal->id }}">
                                            @endif

                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label" for="vendor1_first_name">First Name *</label>
                                                    <input class="form-control" id="vendor1_first_name"
                                                        name="vendor1_first_name" type="text"
                                                        value="{{ $appraisalData['vendor1_first_name'] ?? old('vendor1_first_name') }}"
                                                        placeholder="First Name" required>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label" for="vendor1_last_name">Last Name *</label>
                                                    <input class="form-control" id="vendor1_last_name"
                                                        name="vendor1_last_name" type="text"
                                                        value="{{ $appraisalData['vendor1_last_name'] ?? old('vendor1_last_name') }}"
                                                        placeholder="Last Name" required>
                                                </div>
                                            </div>

                                            <div class="col-md-12">
                                                <div class="mb-3">
                                                    <label class="form-label" for="vendor1_mobile">Mobile *</label>
                                                    <input class="form-control" id="vendor1_mobile" name="vendor1_mobile"
                                                        type="text"
                                                        value="{{ $appraisalData['vendor1_mobile'] ?? old('vendor1_mobile') }}"
                                                        placeholder="" required>
                                                </div>
                                            </div>

                                            <div class="col-md-12">
                                                <div class="mb-3">
                                                    <label class="form-label" for="vendor1_email">Email *</label>
                                                    <input class="form-control" id="vendor1_email" name="vendor1_email"
                                                        type="email"
                                                        value="{{ $appraisalData['vendor1_email'] ?? old('vendor1_email') }}"
                                                        placeholder="" required>
                                                </div>
                                            </div>

                                            <!-- Pre-fill additional vendor if exists -->
                                            @if (isset($appraisalData['vendor2_first_name']) && $appraisalData['vendor2_first_name'])
                                                <script>
                                                    $(document).ready(function() {
                                                        // Check the "Add vendor" radio button
                                                        $('#has_additional_vendor_yes').prop('checked', true);
                                                        $('#vendor2Fields').show();

                                                        // Pre-fill vendor 2 fields
                                                        $('#vendor2_first_name').val('{{ $appraisalData['vendor2_first_name'] }}');
                                                        $('#vendor2_last_name').val('{{ $appraisalData['vendor2_last_name'] }}');
                                                        $('#vendor2_mobile').val('{{ $appraisalData['vendor2_mobile'] }}');
                                                        $('#vendor2_email').val('{{ $appraisalData['vendor2_email'] }}');
                                                    });
                                                </script>
                                            @endif

                                            <!-- Add vendor? -->
                                            <div class="col-md-12">
                                                <label class="form-label">Add Vendor?</label>
                                                <div class="mb-3 m-t-15 custom-radio-ml">
                                                    <div class="form-check radio radio-primary">
                                                        <input class="form-check-input" id="has_additional_vendor_yes"
                                                            type="radio" name="has_additional_vendor" value="1">
                                                        <label class="form-check-label"
                                                            for="has_additional_vendor_yes">Yes</label>
                                                    </div>
                                                    <div class="form-check radio radio-primary"> <input
                                                            class="form-check-input" id="has_additional_vendor_no"
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
                                            </div>

                                            <!-- Main point of contact -->
                                            <div class="col-md-12">
                                                <div class="mb-3">
                                                    <label class="form-label" for="main_contact">Main point of contact for
                                                        supplier bookings:</label>
                                                    <select class="form-select digits" id="main_contact"
                                                        name="main_contact">
                                                        {{-- <option value="">Please Select</option> --}}
                                                        <option value="Vendor 1">Vendor 1</option>
                                                        <option value="Vendor 2">Vendor 2</option>
                                                        <option value="Someone else">Someone else</option>
                                                    </select>
                                                </div>

                                                <!-- Hidden input field for 'Someone else' -->
                                                <div id="otherContactInput" style="display: none;">
                                                    <div class="row">
                                                          <div class="card-header card-head1 pb-0">
                                                            <h4 class="ven-head1"><span>Main Contact</span>
                                                            </h4>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="mb-3">
                                                                <label class="form-label"
                                                                    for="main_contact_first_name">First Name</label>
                                                                <input class="form-control" id="main_contact_first_name"
                                                                    name="main_contact_first_name" type="text"
                                                                    placeholder="First Name">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="mb-3">
                                                                <label class="form-label"
                                                                    for="main_contact_last_name">Last
                                                                    Name</label>
                                                                <input class="form-control" id="main_contact_last_name"
                                                                    name="main_contact_last_name" type="text"
                                                                    placeholder="Last Name">
                                                            </div>
                                                        </div>

                                                        <div class="col-md-12">
                                                            <div class="mb-3">
                                                                <label class="form-label"
                                                                    for="main_contact_mobile">Mobile</label>
                                                                <input class="form-control" id="main_contact_mobile"
                                                                    name="main_contact_mobile" type="text"
                                                                    placeholder="">
                                                            </div>
                                                        </div>

                                                        <div class="col-md-12">
                                                            <div class="mb-3">
                                                                <label class="form-label"
                                                                    for="main_contact_email">Email</label>
                                                                <input class="form-control" id="main_contact_email"
                                                                    name="main_contact_email" type="email"
                                                                    placeholder="">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            {{-- {{-- <!-- Privacy Consent --> --}}
                                            <div class="col-md-12">
                                                <div class="mb-3">
                                                    <div class="form-check checkbox mb-0">
                                                        <input class="form-check-input" id="privacy_consent"
                                                            type="checkbox" name="privacy_consent" value="1">
                                                        <label class="form-check-label" for="privacy_consent"><b>Privacy
                                                                Consent</b><br>I consent to my contact details being shared
                                                            with approved suppliers to assist in marketing and preparing my
                                                            property for sale.</label>
                                                    </div>
                                                </div>
                                            </div>
<div class="card mb-4 shadow-sm p-3">
    <h5 class="fw-bold mb-3">Supplier Booking Options</h5>

    <!-- Optional Message Toggle -->
    <div class="form-check form-switch mb-3">
        <input class="form-check-input" type="checkbox" id="toggleSupplierMessage">
        <label class="form-check-label" for="toggleSupplierMessage">Optional Message for Suppliers</label>
    </div>

    <div class="mb-3" id="supplierMessageContainer" style="display: none;">
        <label for="supplier_message" class="form-label">Enter your message</label>
        <textarea class="form-control" id="supplier_message" name="supplier_message" rows="3" placeholder="Type your message here..."></textarea>
    </div>

    <!-- Who Handles Supplier Bookings -->
    <label class="form-label fw-bold">Who should handle the supplier bookings?</label>
    <div class="form-check">
        <input class="form-check-input" type="radio" name="booking_handler" id="vendorHandler" value="vendor" checked>
        <label class="form-check-label" for="vendorHandler">
            Vendor to receive calls from Suppliers
        </label>
    </div>
    <div class="form-check">
        <input class="form-check-input" type="radio" name="booking_handler" id="agentHandler" value="agent">
        <label class="form-check-label" for="agentHandler">
            Agent - I'll coordinate directly
        </label>
    </div>
    <div class="form-check">
        <input class="form-check-input" type="radio" name="booking_handler" id="adminHandler" value="admin">
        <label class="form-check-label" for="adminHandler">
            Admin / PA will confirm all appointments
        </label>
    </div>
</div>

                                            <!-- Accordion Sections -->
                                            <div class="col-sm-12 col-lg-12">
                                                <div class="accordion accordion-flush" id="accordionFlushExample">

                                                    <!-- Campaign Overview Section (Requirement 46, 54, 56) -->
                                                    <div class="accordion-item">
                                                        <h2 class="accordion-header" id="flush-headingCampaign">
                                                            <button class="accordion-button collapsed" type="button"
                                                                data-bs-toggle="collapse"
                                                                data-bs-target="#flush-collapseCampaign"
                                                                aria-expanded="false"
                                                                aria-controls="flush-collapseCampaign" >
                                                                Campaign Overview
                                                            </button>
                                                        </h2>
                                                        <div id="flush-collapseCampaign"
                                                            class="accordion-collapse collapse"
                                                            aria-labelledby="flush-headingCampaign"
                                                            data-bs-parent="#accordionFlushExample">
                                                            <div class="accordion-body">
                                                                <div class="mb-3">
                                                                    <label class="form-label">Method of Sale:</label>
                                                                    <select class="form-select digits" id="method_of_sale"
                                                                        name="method_of_sale">
                                                                        <option value="">Please Select</option>
                                                                        <option value="Off Market">Off Market</option>
                                                                        <option value="Auction">Auction</option>
                                                                        <option value="Expression's Of Interest">
                                                                            Expression's Of Interest
                                                                        </option>
                                                                        <option value="Private Sale">Private Sale</option>
                                                                        <option
                                                                            value="Off Market To Start. Auction if needed.">
                                                                            Off Market
                                                                            To Start. Auction if needed.</option>
                                                                        <option value="Forthcoming Auction">Forthcoming
                                                                            Auction</option>
                                                                        <option value="Other">Other</option>
                                                                    </select>
                                                                </div>

                                                                <!-- Inputs for each option (initially hidden) -->
                                                                <div class="sale-option" id="input-auction"
                                                                    style="display: none;">
                                                                    <div class="mb-3">
                                                                        <label class="form-label">Auction date</label>
                                                                        <input class="form-control digits" type="date"
                                                                            name="auction_date"
                                                                            value="{{ date('Y-m-d') }}">
                                                                    </div>
                                                                    <div class="mb-3">
                                                                        <label class="form-label">First Open for
                                                                            Inspection</label>
                                                                        <input class="form-control digits" type="date"
                                                                            name="first_open_date"
                                                                            value="{{ date('Y-m-d') }}">
                                                                    </div>
                                                                </div>

                                                                <div class="sale-option" id="input-expression"
                                                                    style="display: none;">
                                                                    <div class="mb-3">
                                                                        <label class="form-label">Expression's of Interest
                                                                            Closing
                                                                            Date</label>
                                                                        <input class="form-control digits" type="date"
                                                                            name="expressions_closing_date"
                                                                            value="{{ date('Y-m-d') }}">
                                                                    </div>
                                                                    <div class="mb-3">
                                                                        <label class="form-label">First Open for
                                                                            Inspection</label>
                                                                        <input class="form-control digits" type="date"
                                                                            name="first_open_date"
                                                                            value="{{ date('Y-m-d') }}">
                                                                    </div>
                                                                </div>

                                                                <div class="sale-option" id="input-private"
                                                                    style="display: none;">
                                                                    <div class="mb-3">
                                                                        <label class="form-label">First Open for
                                                                            Inspection</label>
                                                                        <input class="form-control digits" type="date"
                                                                            name="first_open_date"
                                                                            value="{{ date('Y-m-d') }}">
                                                                    </div>
                                                                </div>

                                                                <div class="mb-3 sale-option" id="input-offmarketauction"
                                                                    style="display: none;">
                                                                    <label class="form-label">Has a potential auction date
                                                                        been
                                                                        discussed?</label>
                                                                    <input type="text" class="form-control"
                                                                        name="potential_auction_discussed" placeholder="">
                                                                </div>

                                                                <div class="mb-3 sale-option" id="input-forthcoming"
                                                                    style="display: none;">
                                                                    <label class="form-label">Auction date (if
                                                                        known)</label>
                                                                    <input class="form-control digits" type="date"
                                                                        name="forthcoming_auction_date"
                                                                        value="{{ date('Y-m-d') }}">
                                                                </div>

                                                                <div class="mb-3 sale-option" id="input-other"
                                                                    style="display: none;">
                                                                    <label class="form-label">If Other, Please Specify
                                                                        Method of Sale
                                                                        Details:</label>
                                                                    <textarea class="form-control" name="other_method_details" rows="3"></textarea>
                                                                </div>

                                                                <!-- Campaign Overview Notes (Requirement 46) -->
                                                                <div class="mb-3">
                                                                    <label class="form-label">Campaign Overview
                                                                        Notes</label>
                                                                    <textarea class="form-control" name="campaign_overview_notes" rows="3"
                                                                        placeholder="Enter campaign overview notes here..."></textarea>
                                                                </div>

                                                                <!-- Who should receive campaign overview (Requirement 56) -->
                                                                <div class="mb-3">
                                                                    <label class="form-label">Who should receive the
                                                                        campaign overview?</label>
                                                                    <select class="form-select digits"
                                                                        id="campaign_recipient" name="campaign_recipient">
                                                                        <option value="">Please Select</option>
                                                                        <option value="My receptionist">My receptionist
                                                                        </option>
                                                                        <option value="My Assistant (PA)">My Assistant (PA)
                                                                        </option>
                                                                        <option value="Send to me">Send to me</option>
                                                                        <option value="Custom Email">Custom Email</option>
                                                                    </select>
                                                                </div>

                                                                <!-- Custom email input (shown only when Custom Email is selected) -->
                                                                <div class="mb-3" id="custom_email_input"
                                                                    style="display: none;">
                                                                    <label class="form-label">Custom Email Address</label>
                                                                    <input type="email" class="form-control"
                                                                        name="custom_email"
                                                                        placeholder="Enter email address">
                                                                    <button type="button"
                                                                        class="btn btn-sm btn-outline-primary mt-2"
                                                                        id="save_email_btn">
                                                                        <i class="fas fa-save me-1"></i> Save as future
                                                                        option
                                                                    </button>
                                                                </div>

                                                                <!-- Display Order of Agents -->
                                                                <div class="card-header card-head1 pb-0 mt-4">
                                                                    <h4>Display Order of Agents on Listing:</h4>
                                                                </div>

                                                                <div class="mb-3">
                                                                    <label class="form-label">1st Agent</label>
                                                                    <select class="form-select digits" id="first_agent"
                                                                        name="first_agent">
                                                                        <option value="">Please Select</option>
                                                                        <option value="Rob Sheahan" selected>Rob Sheahan
                                                                        </option>
                                                                        <option value="Ben Williams">Ben Williams</option>
                                                                        <option value="Ian Van Eijk">Ian Van Eijk</option>
                                                                        <option value="Michelle Yan">Michelle Yan</option>
                                                                        <option value="Oscar Huang">Oscar Huang</option>
                                                                        <option value="Shaun Purumal">Shaun Purumal
                                                                        </option>
                                                                        <option value="Jee Chin">Jee Chin</option>
                                                                        <option value="N/A">N/A</option>
                                                                        <option value="Other">Other</option>
                                                                    </select>
                                                                </div>

                                                                <!-- Hidden input field for 'Other' -->
                                                                <div class="mb-3" id="other-agent-input"
                                                                    style="display: none;">
                                                                    <label class="form-label">1st Agent - Other:</label>
                                                                    <input type="text" class="form-control"
                                                                        name="first_agent_other" placeholder="">
                                                                </div>

                                                                <div class="mb-3">
                                                                    <label class="form-label">2nd Agent</label>
                                                                    <select class="form-select digits" id="second_agent"
                                                                        name="second_agent">
                                                                        <option value="">Please Select</option>
                                                                        <option value="Rob Sheahan">Rob Sheahan</option>
                                                                        <option value="Ben Williams">Ben Williams</option>
                                                                        <option value="Ian Van Eijk">Ian Van Eijk</option>
                                                                        <option value="Michelle Yan">Michelle Yan</option>
                                                                        <option value="Oscar Huang">Oscar Huang</option>
                                                                        <option value="Shaun Purumal">Shaun Purumal
                                                                        </option>
                                                                        <option value="Jee Chin">Jee Chin</option>
                                                                        <option value="N/A">N/A</option>
                                                                        <option value="Other">Other</option>
                                                                    </select>
                                                                </div>

                                                                <!-- Hidden input field for 'Other' -->
                                                                <div class="mb-3" id="other-second-agent-input"
                                                                    style="display: none;">
                                                                    <label class="form-label">2nd Agent - Other:</label>
                                                                    <input type="text" class="form-control"
                                                                        name="second_agent_other" placeholder="">
                                                                </div>

                                                                <!-- 3rd Agent (Requirement 55) -->
                                                                <div class="mb-3">
                                                                    <label class="form-label">3rd Agent</label>
                                                                    <select class="form-select digits" id="third_agent"
                                                                        name="third_agent">
                                                                        <option value="">Please Select</option>
                                                                        <option value="N/A" selected>N/A</option>
                                                                        <option value="Rob Sheahan">Rob Sheahan</option>
                                                                        <option value="Ben Williams">Ben Williams</option>
                                                                        <option value="Ian Van Eijk">Ian Van Eijk</option>
                                                                        <option value="Michelle Yan">Michelle Yan</option>
                                                                        <option value="Oscar Huang">Oscar Huang</option>
                                                                        <option value="Shaun Purumal">Shaun Purumal
                                                                        </option>
                                                                        <option value="Jee Chin">Jee Chin</option>
                                                                        <option value="Other">Other</option>
                                                                    </select>
                                                                </div>

                                                                <!-- Input field shown only when "Other" is selected -->
                                                                <div class="mb-3" id="third-agent-other-input"
                                                                    style="display: none;">
                                                                    <label class="form-label">3rd Agent - Other:</label>
                                                                    <input type="text" class="form-control"
                                                                        name="third_agent_other" placeholder="">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <!-- Book Photos, Floorplan & Copywriting Section -->
                                                    <div class="accordion-item">
                                                        <h2 class="accordion-header" id="flush-headingOne">
                                                            <button class="accordion-button collapsed" type="button"
                                                                data-bs-toggle="collapse"
                                                                data-bs-target="#flush-collapseOne" aria-expanded="false"
                                                                aria-controls="flush-collapseOne">
                                                                Book Photos, Floorplan & Copywriting.
                                                            </button>
                                                        </h2>
                                                        <div id="flush-collapseOne" class="accordion-collapse collapse"
                                                            aria-labelledby="flush-headingOne"
                                                            data-bs-parent="#accordionFlushExample">
                                                            <div class="accordion-body">
                                                                <!-- Marketing Package Selection (Requirement 47) -->
                                                                <div class="mb-3">
                                                                    <label class="form-label">Select Marketing
                                                                        Package</label>
                                                                    <select class="form-select digits"
                                                                        id="marketing_package" name="marketing_package">
                                                                        <option value="">Please Select</option>
                                                                        <option value="package1">Premium Package - $999
                                                                        </option>
                                                                        <option value="package2">Standard Package - $699
                                                                        </option>
                                                                        <option value="package3">Basic Package - $399
                                                                        </option>
                                                                        <option value="custom">Book Services Individually
                                                                        </option>
                                                                    </select>
                                                                </div>

                                                                <!-- Package Services (initially hidden) -->
                                                                <div id="package-services" style="display: none;">
                                                                    <div class="mb-3">
                                                                        <label class="form-label">Package Includes:</label>
                                                                        <div id="package-details"></div>
                                                                    </div>
                                                                </div>

                                                                <!-- Individual Services (shown when custom selected) -->
                                                                <div id="individual-services" style="display: none;">
                                                                    <div class="mb-3">
                                                                        <label class="form-label">Photography
                                                                            Services</label>

                                                                        <div class="form-check checkbox mb-0">
                                                                            <input
                                                                                class="form-check-input service-checkbox"
                                                                                id="checkbox1" type="checkbox"
                                                                                name="photography_services[]"
                                                                                value="Premium Dust Photos 12">
                                                                            <label class="form-check-label"
                                                                                for="checkbox1">Premium Dust Photos
                                                                                12</label>
                                                                        </div>
                                                                        <div class="form-check checkbox mb-0">
                                                                            <input
                                                                                class="form-check-input service-checkbox"
                                                                                id="checkbox2" type="checkbox"
                                                                                name="photography_services[]"
                                                                                value="Premium Dust Photos 15">
                                                                            <label class="form-check-label"
                                                                                for="checkbox2">Premium Dust Photos
                                                                                15</label>
                                                                        </div>
                                                                        <div class="form-check checkbox mb-0">
                                                                            <input
                                                                                class="form-check-input service-checkbox"
                                                                                id="checkbox3" type="checkbox"
                                                                                name="photography_services[]"
                                                                                value="Premium Day Photos 12">
                                                                            <label class="form-check-label"
                                                                                for="checkbox3">Premium Day Photos
                                                                                12</label>
                                                                        </div>
                                                                        <div class="form-check checkbox mb-0">
                                                                            <input
                                                                                class="form-check-input service-checkbox"
                                                                                id="checkbox4" type="checkbox"
                                                                                name="photography_services[]"
                                                                                value="Premium Day 6">
                                                                            <label class="form-check-label"
                                                                                for="checkbox4">Premium Day 6</label>
                                                                        </div>
                                                                        <div class="form-check checkbox mb-0">
                                                                            <input
                                                                                class="form-check-input service-checkbox"
                                                                                id="checkbox5" type="checkbox"
                                                                                name="photography_services[]"
                                                                                value="Drone (Bomb Shot + Perspective)">
                                                                            <label class="form-check-label"
                                                                                for="checkbox5">Drone (Bomb Shot +
                                                                                Perspective)</label>
                                                                        </div>
                                                                        <div class="form-check checkbox mb-0">
                                                                            <input
                                                                                class="form-check-input service-checkbox"
                                                                                id="checkbox6" type="checkbox"
                                                                                name="photography_services[]"
                                                                                value="Video Property Profile Standards">
                                                                            <label class="form-check-label"
                                                                                for="checkbox6">Video Property Profile
                                                                                Standards</label>
                                                                        </div>
                                                                        <div class="form-check checkbox mb-0">
                                                                            <input
                                                                                class="form-check-input service-checkbox"
                                                                                id="checkbox7" type="checkbox"
                                                                                name="photography_services[]"
                                                                                value="Floorplan & Siteplan">
                                                                            <label class="form-check-label"
                                                                                for="checkbox7">Floorplan &
                                                                                Siteplan</label>
                                                                        </div>
                                                                        <div class="form-check checkbox mb-0">
                                                                            <input
                                                                                class="form-check-input service-checkbox"
                                                                                id="checkbox8" type="checkbox"
                                                                                name="photography_services[]"
                                                                                value="Floorplan Redraw Only">
                                                                            <label class="form-check-label"
                                                                                for="checkbox8">Floorplan Redraw
                                                                                Only</label>
                                                                        </div>
                                                                        <div class="form-check checkbox mb-0">
                                                                            <input
                                                                                class="form-check-input service-checkbox"
                                                                                id="checkbox9" type="checkbox"
                                                                                name="photography_services[]"
                                                                                value="Other">
                                                                            <label class="form-check-label"
                                                                                for="checkbox9">Other</label>
                                                                        </div>
                                                                    </div>

                                                                    <!-- Input field for "Other" -->
                                                                    <div class="mb-3" id="other-input-field"
                                                                        style="display: none;">
                                                                        <label class="form-label">Other Photography
                                                                            Requirements:</label>
                                                                        <textarea class="form-control" name="other_photography_requirements" rows="3"></textarea>
                                                                    </div>

                                                                    <!-- Dropdown for non-Other options -->
                                                                    <div class="mb-3" id="service-select-field"
                                                                        style="display: none;">
                                                                        <label class="form-label">Preferred Photography
                                                                            Supplier</label>
                                                                        <select class="form-select"
                                                                            name="photography_supplier">
                                                                            <option value="">Please Select</option>
                                                                            <option value="X2A Media">X2A Media</option>
                                                                        </select>
                                                                    </div>

                                                                    <!-- Copywriting Services -->
                                                                    <div class="mb-3">
                                                                        <label class="form-label">Copywriting Services
                                                                            Selected</label>

                                                                        <div class="form-check checkbox mb-0">
                                                                            <input
                                                                                class="form-check-input copywriting-checkbox"
                                                                                id="checkbox10" type="checkbox"
                                                                                name="copywriting_services[]"
                                                                                value="Professional">
                                                                            <label class="form-check-label"
                                                                                for="checkbox10">Copywriting -
                                                                                Professional</label>
                                                                        </div>

                                                                        <div class="form-check checkbox mb-0">
                                                                            <input
                                                                                class="form-check-input copywriting-checkbox"
                                                                                id="checkbox11" type="checkbox"
                                                                                name="copywriting_services[]"
                                                                                value="In-house">
                                                                            <label class="form-check-label"
                                                                                for="checkbox11">Copywriting -
                                                                                In-house</label>
                                                                        </div>
                                                                    </div>

                                                                    <!-- Dropdown shown only when "Professional" is selected -->
                                                                    <div class="mb-3" id="copywriting-dropdown"
                                                                        style="display: none;">
                                                                        <label class="form-label">Preferred Photography
                                                                            Supplier</label>
                                                                        <select class="form-select"
                                                                            name="copywriting_supplier">
                                                                            <option value="">Please Select</option>
                                                                            <option value="X2A Media">X2A Media</option>
                                                                        </select>
                                                                    </div>

                                                                    <!-- Floorplan Services -->
                                                                    <div class="mb-3 m-t-15">
                                                                        <label class="form-label">Floorplan Services
                                                                            Selected</label>

                                                                        <div class="form-check checkbox mb-0">
                                                                            <input
                                                                                class="form-check-input floorplan-checkbox"
                                                                                id="checkbox12" type="checkbox"
                                                                                name="floorplan_services[]"
                                                                                value="Floorplan/Siteplan">
                                                                            <label class="form-check-label"
                                                                                for="checkbox12">Floorplan/Siteplan</label>
                                                                        </div>
                                                                        <div class="form-check checkbox mb-0">
                                                                            <input
                                                                                class="form-check-input floorplan-checkbox"
                                                                                id="checkbox13" type="checkbox"
                                                                                name="floorplan_services[]"
                                                                                value="Redraw Only">
                                                                            <label class="form-check-label"
                                                                                for="checkbox13">Redraw Only</label>
                                                                        </div>
                                                                        <div class="form-check checkbox mb-0">
                                                                            <input
                                                                                class="form-check-input floorplan-checkbox"
                                                                                id="checkbox14" type="checkbox"
                                                                                name="floorplan_services[]"
                                                                                value="Virtual Walk Thru Tour">
                                                                            <label class="form-check-label"
                                                                                for="checkbox14">Virtual Walk Thru
                                                                                Tour</label>
                                                                        </div>
                                                                    </div>

                                                                    <!-- Floorplan Supplier -->
                                                                    <div id="floorplan-input" class="mb-3"
                                                                        style="display: none;">
                                                                        <label class="form-label">Preferred Photography
                                                                            Supplier</label>
                                                                        <select class="form-select"
                                                                            name="floorplan_supplier">
                                                                            <option value="">Please Select</option>
                                                                            <option value="X2A Media">X2A Media</option>
                                                                        </select>
                                                                    </div>
                                                                </div>

                                                                <!-- Supplier Preferences (Requirement 49) -->
                                                                <div class="mb-3">
                                                                    <label class="form-label">Supplier Preferences</label>
                                                                    <div class="form-check radio radio-primary">
                                                                        <input class="form-check-input"
                                                                            id="supplier_pref_default" type="radio"
                                                                            name="supplier_preferences" value="default"
                                                                            checked>
                                                                        <label class="form-check-label"
                                                                            for="supplier_pref_default">Use my preferred
                                                                            default suppliers</label>
                                                                    </div>
                                                                    <div class="form-check radio radio-primary">
                                                                        <input class="form-check-input"
                                                                            id="supplier_pref_review" type="radio"
                                                                            name="supplier_preferences" value="review">
                                                                        <label class="form-check-label"
                                                                            for="supplier_pref_review">Review and change
                                                                            suppliers before booking</label>
                                                                    </div>
                                                                </div>

                                                                <!-- Property Access for Suppliers (Requirements 58-61) -->
                                                                <div class="mb-3">
                                                                    <label class="form-label">How will the supplier access
                                                                        the property?</label>
                                                                    <select class="form-select digits"
                                                                        id="supplier_access_method"
                                                                        name="supplier_access_method">
                                                                        <option value="">Please Select</option>
                                                                        <option value="Meet Agent on Site">Meet Agent on
                                                                            Site</option>
                                                                        <option value="Meet Vendor on Site">Meet Vendor on
                                                                            Site</option>
                                                                        <option value="Vacant">Vacant</option>
                                                                        <option value="Meet Renter on Site">Meet Renter on
                                                                            Site</option>
                                                                    </select>
                                                                </div>

                                                                <!-- Vacant Property Access Options -->
                                                                <div id="vacant-access-options" style="display: none;">
                                                                    <div class="mb-3">
                                                                        <label class="form-label">Vacant Property
                                                                            Access</label>
                                                                        <select class="form-select digits"
                                                                            id="vacant_access_type"
                                                                            name="vacant_access_type">
                                                                            <option value="">Please Select</option>
                                                                            <option value="Access via code">Access via code
                                                                            </option>
                                                                            <option value="Access via keysafe">Access via
                                                                                keysafe</option>
                                                                            <option
                                                                                value="Confirm with agent before attending">
                                                                                Confirm with agent before attending</option>
                                                                            <option value="Pick up key from office">Pick up
                                                                                key from office</option>
                                                                        </select>
                                                                    </div>

                                                                    <!-- Code input -->
                                                                    <div id="access-code-input" class="mb-3"
                                                                        style="display: none;">
                                                                        <label class="form-label">Keysafe Code</label>
                                                                        <input type="text" class="form-control"
                                                                            name="keysafe_code" placeholder="Enter code">
                                                                    </div>

                                                                    <!-- Keysafe location -->
                                                                    <div id="keysafe-location-input" class="mb-3"
                                                                        style="display: none;">
                                                                        <label class="form-label">Key safe location</label>
                                                                        <select class="form-select digits"
                                                                            id="keysafe_location" name="keysafe_location">
                                                                            <option value="">Please Select</option>
                                                                            <option value="Front security door">Front
                                                                                security door</option>
                                                                            <option value="Veranda Railing">Veranda Railing
                                                                            </option>
                                                                            <option value="Gas metre">Gas metre</option>
                                                                            <option value="Garden Tap">Garden Tap</option>
                                                                            <option value="Front Patio">Front Patio
                                                                            </option>
                                                                            <option value="N/A">N/A</option>
                                                                            <option value="Metre Box">Metre Box</option>
                                                                            <option value="Near Back Entrance">Near Back
                                                                                Entrance</option>
                                                                            <option value="Other">Other</option>
                                                                        </select>
                                                                    </div>

                                                                    <!-- Other keysafe location -->
                                                                    <div id="other-keysafe-location" class="mb-3"
                                                                        style="display: none;">
                                                                        <label class="form-label">Other keysafe
                                                                            location</label>
                                                                        <input type="text" class="form-control"
                                                                            name="other_keysafe_location"
                                                                            placeholder="Specify location">
                                                                    </div>
                                                                </div>

                                                                <!-- Optional message for suppliers (Requirement 62) -->
                                                                <div class="mb-3">
                                                                    <label class="form-label">Optional Message for
                                                                        Suppliers</label>
                                                                    <textarea class="form-control" name="supplier_message" rows="3"
                                                                        placeholder="Any special instructions for suppliers..."></textarea>
                                                                </div>

                                                                <!-- Other Marketing Services (Requirement 48) -->
                                                                <div class="mb-3 m-t-15 custom-radio-ml">
                                                                    <label class="form-label">Other Marketing Services
                                                                        Required?</label>

                                                                    <div class="form-check radio radio-primary">
                                                                        <input class="form-check-input" id="radio5"
                                                                            type="radio" name="other_marketing_required"
                                                                            value="1">
                                                                        <label class="form-check-label"
                                                                            for="radio5">Yes</label>
                                                                    </div>
                                                                    <div class="form-check radio radio-primary">
                                                                        <input class="form-check-input" id="radio6"
                                                                            type="radio" name="other_marketing_required"
                                                                            value="0" checked>
                                                                        <label class="form-check-label"
                                                                            for="radio6">No</label>
                                                                    </div>
                                                                </div>

                                                                <!-- Other Marketing Details -->
                                                                <div id="marketing-input" class="mb-3"
                                                                    style="display: none;">
                                                                    <label class="form-label">Specify Other Marketing
                                                                        Services Required:</label>
                                                                    <textarea class="form-control" name="other_marketing_details" rows="3"></textarea>
                                                                </div>

                                                                <!-- Other Suppliers (Requirement 48) -->
                                                                <div class="mb-3 m-t-15 custom-radio-ml">
                                                                    <label class="form-label">Do you need to refer any
                                                                        other
                                                                        supplier not listed above?</label>
                                                                    <div class="form-check radio radio-primary">
                                                                        <input class="form-check-input" id="radio7"
                                                                            type="radio" name="other_supplier_required"
                                                                            value="1">
                                                                        <label class="form-check-label"
                                                                            for="radio7">Yes</label>
                                                                    </div>
                                                                    <div class="form-check radio radio-primary">
                                                                        <input class="form-check-input" id="radio8"
                                                                            type="radio" name="other_supplier_required"
                                                                            value="0" checked>
                                                                        <label class="form-check-label"
                                                                            for="radio8">No</label>
                                                                    </div>
                                                                </div>

                                                                <!-- Add Supplier Button (Requirement 48) -->
                                                                <div id="supplier-add-btn" style="display: none;"
                                                                    class="mb-3">
                                                                    <button type="button" class="btn btn-outline-primary"
                                                                        id="add-supplier-btn">
                                                                        <i class="fas fa-plus me-1"></i> Add Supplier
                                                                    </button>
                                                                </div>

                                                                <!-- Other Supplier Details (initially hidden) -->
                                                                <div id="supplier-input" style="display: none;">
                                                                    <div class="mb-3">
                                                                        <label class="form-label">Supplier Name:</label>
                                                                        <input type="text" class="form-control"
                                                                            name="supplier_name" placeholder="">
                                                                    </div>
                                                                    <div class="mb-3">
                                                                        <label class="form-label">Category:</label>
                                                                        <input type="text" class="form-control"
                                                                            name="supplier_category" placeholder="">
                                                                    </div>
                                                                    <div class="mb-3">
                                                                        <label class="form-label">Specify What is
                                                                            Required?</label>
                                                                        <input type="text" class="form-control"
                                                                            name="supplier_requirements" placeholder="">
                                                                    </div>
                                                                    <div class="mb-3">
                                                                        <label class="form-label">Mobile</label>
                                                                        <input type="text" class="form-control"
                                                                            name="supplier_mobile" placeholder="">
                                                                    </div>
                                                                    <div class="mb-3">
                                                                        <label class="form-label">Email</label>
                                                                        <input type="text" class="form-control"
                                                                            name="supplier_email" placeholder="">
                                                                    </div>

                                                                    <div class="mb-3 m-t-15 custom-radio-ml">
                                                                        <label class="form-label">Preferred Contact
                                                                            Method:</label>
                                                                        <div class="form-check radio radio-primary">
                                                                            <input class="form-check-input" id="radio9"
                                                                                type="radio"
                                                                                name="supplier_contact_method"
                                                                                value="SMS">
                                                                            <label class="form-check-label"
                                                                                for="radio9">SMS</label>
                                                                        </div>
                                                                        <div class="form-check radio radio-primary">
                                                                            <input class="form-check-input" id="radio10"
                                                                                type="radio"
                                                                                name="supplier_contact_method"
                                                                                value="Email">
                                                                            <label class="form-check-label"
                                                                                for="radio10">Email</label>
                                                                        </div>
                                                                        <div class="form-check radio radio-primary">
                                                                            <input class="form-check-input" id="radio11"
                                                                                type="radio"
                                                                                name="supplier_contact_method"
                                                                                value="Both">
                                                                            <label class="form-check-label"
                                                                                for="radio11">Both</label>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <!-- Appointment Dates (Requirements 50, 57) -->
                                                                <div class="card-header card-head1 pb-0">
                                                                    <h4>Appointment Dates</h4>
                                                                </div>

                                                                <div class="mb-3 m-t-15">
                                                                    <label class="form-label">How would you like to
                                                                        schedule
                                                                        the appointments?</label>

                                                                    <div class="form-check checkbox mb-0">
                                                                        <input class="form-check-input schedule-checkbox"
                                                                            id="checkbox15" type="checkbox"
                                                                            name="appointment_schedule_options[]"
                                                                            value="Schedule all appointments on the same day"
                                                                            data-target="#input15">
                                                                        <label class="form-check-label"
                                                                            for="checkbox15">Schedule all appointments on
                                                                            the same day</label>
                                                                    </div>
                                                                    <div class="form-check checkbox mb-0">
                                                                        <input class="form-check-input schedule-checkbox"
                                                                            id="checkbox16" type="checkbox"
                                                                            name="appointment_schedule_options[]"
                                                                            value="Start with floorplan and copy – book photos later"
                                                                            data-target="#input16">
                                                                        <label class="form-check-label"
                                                                            for="checkbox16">Start with floorplan and copy
                                                                            –
                                                                            book photos later</label>
                                                                    </div>
                                                                    <div class="form-check checkbox mb-0">
                                                                        <input class="form-check-input schedule-checkbox"
                                                                            id="checkbox17" type="checkbox"
                                                                            name="appointment_schedule_options[]"
                                                                            value="Book video">
                                                                        <label class="form-check-label"
                                                                            for="checkbox17">Book video</label>
                                                                    </div>
                                                                    <div class="form-check checkbox mb-0">
                                                                        <input class="form-check-input schedule-checkbox"
                                                                            id="checkbox19" type="checkbox"
                                                                            name="appointment_schedule_options[]"
                                                                            value="Other - see below"
                                                                            data-target="#input19">
                                                                        <label class="form-check-label"
                                                                            for="checkbox19">Other - see below</label>
                                                                    </div>
                                                                </div>

                                                                <!-- Input fields for checkboxes with data-target -->
                                                                <div id="input15" class="mb-3"
                                                                    style="display: none;">
                                                                    <label class="form-label">Requested Date for All
                                                                        Appointments:</label>
                                                                    <input class="form-control digits" type="date"
                                                                        name="all_appointments_date"
                                                                        value="{{ date('Y-m-d') }}">
                                                                </div>
                                                                <div id="input16" class="mb-3"
                                                                    style="display: none;">
                                                                    <div class="mb-3">
                                                                        <label class="form-label">Requested Date for
                                                                            Floorplan & Copywriting</label>
                                                                        <input class="form-control digits" type="date"
                                                                            name="floorplan_copywriting_date"
                                                                            value="{{ date('Y-m-d') }}">
                                                                    </div>
                                                                    <div class="mb-3">
                                                                        <label class="form-label">Requested Date for
                                                                            Photography</label>
                                                                        <input class="form-control digits" type="date"
                                                                            name="photography_date"
                                                                            value="{{ date('Y-m-d') }}">
                                                                    </div>
                                                                </div>
                                                                <div id="input19" class="mb-3"
                                                                    style="display: none;">
                                                                    <label class="form-label">Other - Custom Booking
                                                                        Instructions:</label>
                                                                    <input type="text" class="form-control"
                                                                        name="custom_booking_instructions" placeholder="">
                                                                </div>

                                                                <!-- Who should handle supplier bookings (Requirement 51) -->
                                                                <div class="mb-3">
                                                                    <label class="form-label">Who should handle the
                                                                        supplier bookings?</label>
                                                                    <select class="form-select" id="booking_handler"
                                                                        name="booking_handler">
                                                                        <option value="">Please Select</option>
                                                                        <option
                                                                            value="Vendor to receive calls from Suppliers">
                                                                            Vendor to receive calls from Suppliers</option>
                                                                        <option value="Agent - I'll coordinate directly">
                                                                            Agent - I'll coordinate directly</option>
                                                                        <option
                                                                            value="Admin / PA will confirm all appointments">
                                                                            Admin / PA will confirm all appointments
                                                                        </option>
                                                                    </select>
                                                                </div>

                                                                <!-- Save as default option -->
                                                                <div class="mb-3">
                                                                    <div class="form-check checkbox mb-0">
                                                                        <input class="form-check-input"
                                                                            id="save_as_default" type="checkbox"
                                                                            name="save_as_default" value="1">
                                                                        <label class="form-check-label"
                                                                            for="save_as_default">Save this as default for
                                                                            all listings</label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <!-- Property Access Details Section -->
                                                    <div class="accordion-item">
                                                        <h2 class="accordion-header" id="flush-headingTwo">
                                                            <button class="accordion-button collapsed" type="button"
                                                                data-bs-toggle="collapse"
                                                                data-bs-target="#flush-collapseTwo" aria-expanded="false"
                                                                aria-controls="flush-collapseTwo">
                                                                Property Access Details
                                                            </button>
                                                        </h2>
                                                        <div id="flush-collapseTwo" class="accordion-collapse collapse"
                                                            aria-labelledby="flush-headingTwo"
                                                            data-bs-parent="#accordionFlushExample">
                                                            <div class="accordion-body">
                                                                <div class="mb-3">
                                                                    <label class="form-label">Occupancy Status:</label>
                                                                    <select class="form-select" id="occupancyStatus"
                                                                        name="occupancy_status">
                                                                        <option value="">Please Select</option>
                                                                        <option value="Owner Occupied">Owner Occupied
                                                                        </option>
                                                                        <option value="Vacant">Vacant</option>
                                                                        <option value="Rented">Rented</option>
                                                                        <option
                                                                            value="Currently Occupied, Vacant in sale.">
                                                                            Currently Occupied, Vacant in sale.</option>
                                                                    </select>
                                                                </div>

                                                                <!-- Input field to show when "Rented" is selected -->
                                                                <div id="rented-input" style="display: none;">
                                                                    <div class="mb-3">
                                                                        <label class="form-label">If Rented, renters
                                                                            name:</label>
                                                                        <input type="text" class="form-control"
                                                                            name="renters_name"
                                                                            placeholder="Enter details...">
                                                                    </div>
                                                                    <div class="mb-3">
                                                                        <label class="form-label">Renters phone:</label>
                                                                        <input type="text" class="form-control"
                                                                            name="renters_phone"
                                                                            placeholder="Enter details...">
                                                                    </div>
                                                                </div>

                                                                <div class="mb-3">
                                                                    <label class="form-label">Access to Property:</label>
                                                                    <select class="form-select" id="accessToProperty"
                                                                        name="property_access">
                                                                        <option value="">Please Select</option>
                                                                        <option value="Owner to meet">Owner to meet
                                                                        </option>
                                                                        <option value="Via Keysafe">Via Keysafe</option>
                                                                        <option value="Agent to meet">Agent to meet
                                                                        </option>
                                                                        <option value="Renter to meet">Renter to meet
                                                                        </option>
                                                                        <option value="Other">Other</option>
                                                                    </select>
                                                                </div>

                                                                <!-- Hidden input field for "Other" -->
                                                                <div id="access-other-input" class="mb-3"
                                                                    style="display: none;">
                                                                    <label class="form-label">Specify Other Access
                                                                        Arrangements:</label>
                                                                    <textarea class="form-control" name="other_access_arrangements" rows="3"></textarea>
                                                                </div>

                                                                <div class="mb-3">
                                                                    <label class="form-label">Keysafe Details:</label>
                                                                    <select class="form-select" id="keysafeSelect"
                                                                        name="keysafe_type">
                                                                        <option value="">Please Select</option>
                                                                        <option value="Key safe (key inside)">Key safe (key
                                                                            inside)</option>
                                                                        <option value="Lockbox (4-Digit Code)">Lockbox
                                                                            (4-Digit Code)</option>
                                                                        <option value="Lockbox (3-Digit Code)">Lockbox
                                                                            (3-Digit Code)</option>
                                                                        <option value="Keypad Door Lock">Keypad Door Lock
                                                                        </option>
                                                                        <option value="Wall Mounted Lockbox">Wall Mounted
                                                                            Lockbox</option>
                                                                        <option value="Other">Other</option>
                                                                    </select>
                                                                </div>

                                                                <!-- Input Field A: For specific lock types -->
                                                                <div id="lockbox-code-input" class="mb-3"
                                                                    style="display: none;">
                                                                    <label class="form-label">Keysafe Code:</label>
                                                                    <input type="text" class="form-control"
                                                                        name="keysafe_code" placeholder="">
                                                                </div>

                                                                <!-- Input Field B: For "Other" option -->
                                                                <div id="other-lockbox-input" class="mb-3"
                                                                    style="display: none;">
                                                                    <div class="mb-3 m-t-15 custom-radio-ml">
                                                                        <label class="form-label">Type location of key, or
                                                                            take photo?</label>
                                                                        <div class="form-check radio radio-primary">
                                                                            <input class="form-check-input" id="radio12"
                                                                                type="radio" name="key_option"
                                                                                value="Type">
                                                                            <label class="form-check-label"
                                                                                for="radio12">Type</label>
                                                                        </div>
                                                                        <div class="form-check radio radio-primary">
                                                                            <input class="form-check-input" id="radio13"
                                                                                type="radio" name="key_option"
                                                                                value="Photo">
                                                                            <label class="form-check-label"
                                                                                for="radio13">Take Photo</label>
                                                                        </div>
                                                                    </div>

                                                                    <!-- Input for 'Type' option -->
                                                                    <div id="typeInput" class="mb-3"
                                                                        style="display: none;">
                                                                        <label class="form-label">Type here to enter key
                                                                            location</label>
                                                                        <input type="text" class="form-control"
                                                                            name="key_location_text"
                                                                            placeholder="Type location here...">
                                                                    </div>

                                                                    <!-- Input for 'Photo' option -->
                                                                    <div id="photoInput" class="mb-3"
                                                                        style="display: none;">
                                                                        <label class="form-label">Take Photo</label>
                                                                        <input type="file" class="form-control"
                                                                            name="key_location_photo">
                                                                    </div>
                                                                </div>

                                                                <div class="mb-3">
                                                                    <label class="form-label">Key safe location:</label>
                                                                    <select class="form-select" id="keySafeSelect"
                                                                        name="keysafe_location">
                                                                        <option value="">Please Select</option>
                                                                        <option value="Front security door">Front security
                                                                            door</option>
                                                                        <option value="Veranda Railing">Veranda Railing
                                                                        </option>
                                                                        <option value="Gas metre">Gas metre</option>
                                                                        <option value="Garden Tap">Garden Tap</option>
                                                                        <option value="Front Patio">Front Patio</option>
                                                                        <option value="N/A">N/A</option>
                                                                        <option value="Metre Box">Metre Box</option>
                                                                        <option value="Near Back Entrance">Near Back
                                                                            Entrance</option>
                                                                        <option value="Other">Other</option>
                                                                    </select>
                                                                </div>

                                                                <!-- Hidden input field for 'Other' option -->
                                                                <div class="mb-3" id="otherInputDiv"
                                                                    style="display: none;">
                                                                    <label class="form-label">Other - type keysafe
                                                                        location:</label>
                                                                    <input type="text" class="form-control"
                                                                        name="other_keysafe_location" placeholder="">
                                                                </div>

                                                                <div class="mb-3">
                                                                    <label class="form-label">Alarm system?</label>
                                                                    <select class="form-select" id="alarmSelect"
                                                                        name="alarm_system">
                                                                        <option value="">Please Select</option>
                                                                        <option value="Yes">Yes</option>
                                                                        <option value="No" selected>No</option>
                                                                        <option
                                                                            value="Yes - but won't be switched on during inspections">
                                                                            Yes - but won't be switched on during
                                                                            inspections</option>
                                                                    </select>
                                                                </div>

                                                                <!-- Hidden input field -->
                                                                <div class="mb-3" id="alarmInputDiv"
                                                                    style="display: none;">
                                                                    <label class="form-label">If Alarm: Enter disarm
                                                                        instructions below</label>
                                                                    <input type="text" class="form-control"
                                                                        name="alarm_instructions"
                                                                        placeholder="Enter details">
                                                                </div>

                                                                <div class="mb-3 m-t-15 custom-radio-ml">
                                                                    <label class="form-label">Additional Notes</label>
                                                                    <textarea class="form-control" name="additional_notes" rows="3"></textarea>
                                                                    <small>Eg Please call after 4PM, pets onsite,
                                                                        etc.</small>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <!-- Contacts to Maximise Your Price Section (Requirement 52) -->
                                                    <div class="accordion-item">
                                                        <h2 class="accordion-header" id="flush-headingThree">
                                                            <button class="accordion-button collapsed" type="button"
                                                                data-bs-toggle="collapse"
                                                                data-bs-target="#flush-collapseThree"
                                                                aria-expanded="false"
                                                                aria-controls="flush-collapseThree">
                                                                Contacts to Maximise Your Price
                                                            </button>
                                                        </h2>
                                                        <div id="flush-collapseThree"
                                                            class="accordion-collapse collapse"
                                                            aria-labelledby="flush-headingThree"
                                                            data-bs-parent="#accordionFlushExample">
                                                            <div class="accordion-body">
                                                                <div class="mb-3">
                                                                    <label class="form-label">Trades Contacts</label>

                                                                    <div class="form-check checkbox mb-0">
                                                                        <input class="form-check-input schedule-checkbox"
                                                                            id="checkbox20" type="checkbox"
                                                                            name="trades_contacts[]"
                                                                            value="Conveyancer - Billy">
                                                                        <label class="form-check-label"
                                                                            for="checkbox20">Conveyancer - Billy</label>
                                                                    </div>

                                                                    <div class="form-check checkbox mb-0">
                                                                        <input class="form-check-input schedule-checkbox"
                                                                            id="checkbox21" type="checkbox"
                                                                            name="trades_contacts[]"
                                                                            value="Conveyancer - Luke McGowan">
                                                                        <label class="form-check-label"
                                                                            for="checkbox21">Conveyancer - Luke
                                                                            McGowan</label>
                                                                    </div>

                                                                    <div class="form-check checkbox mb-0">
                                                                        <input class="form-check-input schedule-checkbox"
                                                                            id="checkbox22" type="checkbox"
                                                                            name="trades_contacts[]"
                                                                            value="Conveyancer - Anthony Mahon">
                                                                        <label class="form-check-label"
                                                                            for="checkbox22">Conveyancer - Anthony
                                                                            Mahon</label>
                                                                    </div>

                                                                    <div class="form-check checkbox mb-0">
                                                                        <input class="form-check-input schedule-checkbox"
                                                                            id="checkbox23" type="checkbox"
                                                                            name="trades_contacts[]"
                                                                            value="Removalist - MovingHouse.com.au">
                                                                        <label class="form-check-label"
                                                                            for="checkbox23">Removalist -
                                                                            MovingHouse.com.au</label>
                                                                    </div>

                                                                    <div class="form-check checkbox mb-0">
                                                                        <input class="form-check-input schedule-checkbox"
                                                                            id="checkbox24" type="checkbox"
                                                                            name="trades_contacts[]"
                                                                            value="Mortgage Broker - Marshall">
                                                                        <label class="form-check-label"
                                                                            for="checkbox24">Mortgage Broker -
                                                                            Marshall</label>
                                                                    </div>

                                                                    <div class="form-check checkbox mb-0">
                                                                        <input class="form-check-input schedule-checkbox"
                                                                            id="checkbox25" type="checkbox"
                                                                            name="trades_contacts[]"
                                                                            value="Mortgage Broker - Jacob">
                                                                        <label class="form-check-label"
                                                                            for="checkbox25">Mortgage Broker -
                                                                            Jacob</label>
                                                                    </div>

                                                                    <div class="form-check checkbox mb-0">
                                                                        <input class="form-check-input schedule-checkbox"
                                                                            id="checkboxOther" type="checkbox"
                                                                            name="trades_contacts[]" value="Other">
                                                                        <label class="form-check-label"
                                                                            for="checkboxOther">Other</label>
                                                                    </div>
                                                                </div>

                                                                <!-- Other input field -->
                                                                <div class="mb-3" id="otherInputDiv2"
                                                                    style="display: none;">
                                                                    <label class="form-label">Other: Specify here</label>
                                                                    <input type="text" class="form-control"
                                                                        name="other_trades_contact" placeholder="">
                                                                </div>

                                                                <!-- Radio section -->
                                                                <div class="mb-3" id="radioSection"
                                                                    style="display: none;">
                                                                    <label class="form-label">Who Should Contact
                                                                        Who?</label>
                                                                    <div class="form-check radio radio-primary">
                                                                        <input class="form-check-input" id="radio16"
                                                                            type="radio" name="trades_contact_method"
                                                                            value="Tradesperson to contact Agent">
                                                                        <label class="form-check-label"
                                                                            for="radio16">Tradesperson to contact
                                                                            Agent</label>
                                                                    </div>
                                                                    <div class="form-check radio radio-primary">
                                                                        <input class="form-check-input" id="radio17"
                                                                            type="radio" name="trades_contact_method"
                                                                            value="Tradesperson to contact Vendor">
                                                                        <label class="form-check-label"
                                                                            for="radio17">Tradesperson to contact
                                                                            Vendor</label>
                                                                    </div>
                                                                    <div class="form-check radio radio-primary">
                                                                        <input class="form-check-input" id="radio18"
                                                                            type="radio" name="trades_contact_method"
                                                                            value="Vendor to contact Tradesperson">
                                                                        <label class="form-check-label"
                                                                            for="radio18">Vendor
                                                                            to contact Tradesperson</label>
                                                                    </div>
                                                                </div>

                                                                <!-- Privacy consent for option 2 -->
                                                                <div id="privacy-consent-div" class="mb-3"
                                                                    style="display: none;">
                                                                    <div class="form-check checkbox mb-0">
                                                                        <input class="form-check-input"
                                                                            id="privacy_consent_trades" type="checkbox"
                                                                            name="privacy_consent_trades"
                                                                            value="1">
                                                                        <label class="form-check-label"
                                                                            for="privacy_consent_trades">
                                                                            I consent to my contact details being shared
                                                                            with approved suppliers to assist in marketing
                                                                            and preparing my property for sale.
                                                                        </label>
                                                                    </div>
                                                                </div>

                                                                <!-- Trades Requiring Property Access -->
                                                                <div class="mb-3">
                                                                    <label class="form-label">Trades Requiring Property
                                                                        Access</label>

                                                                    <div class="form-check checkbox mb-0">
                                                                        <input
                                                                            class="form-check-input form-check-property1"
                                                                            id="checkbox27" type="checkbox"
                                                                            name="trades_require_access[]"
                                                                            value="Styling Consultation (Kylie)">
                                                                        <label class="form-check-label"
                                                                            for="checkbox27">Styling Consultation
                                                                            (Kylie)</label>
                                                                    </div>

                                                                    <div class="form-check checkbox mb-0">
                                                                        <input
                                                                            class="form-check-input form-check-property1"
                                                                            id="checkbox28" type="checkbox"
                                                                            name="trades_require_access[]"
                                                                            value="Furniture Hire Quote (Jess)">
                                                                        <label class="form-check-label"
                                                                            for="checkbox28">Furniture Hire Quote
                                                                            (Jess)</label>
                                                                    </div>

                                                                    <div class="form-check checkbox mb-0">
                                                                        <input
                                                                            class="form-check-input form-check-property1"
                                                                            id="checkbox29" type="checkbox"
                                                                            name="trades_require_access[]"
                                                                            value="Painter (Stefan)">
                                                                        <label class="form-check-label"
                                                                            for="checkbox29">Painter (Stefan)</label>
                                                                    </div>

                                                                    <div class="form-check checkbox mb-0">
                                                                        <input
                                                                            class="form-check-input form-check-property1"
                                                                            id="checkbox30" type="checkbox"
                                                                            name="trades_require_access[]"
                                                                            value="Gardener (Garry)">
                                                                        <label class="form-check-label"
                                                                            for="checkbox30">Gardener (Garry)</label>
                                                                    </div>

                                                                    <div class="form-check checkbox mb-0">
                                                                        <input
                                                                            class="form-check-input form-check-property1"
                                                                            id="checkbox31" type="checkbox"
                                                                            name="trades_require_access[]"
                                                                            value="Gardener - Tim Clark">
                                                                        <label class="form-check-label"
                                                                            for="checkbox31">Gardener - Tim Clark</label>
                                                                    </div>

                                                                    <div class="form-check checkbox mb-0">
                                                                        <input
                                                                            class="form-check-input form-check-property1"
                                                                            id="checkbox32" type="checkbox"
                                                                            name="trades_require_access[]"
                                                                            value="Cleaner - Pam">
                                                                        <label class="form-check-label"
                                                                            for="checkbox32">Cleaner - Pam</label>
                                                                    </div>

                                                                    <div class="form-check checkbox mb-0">
                                                                        <input
                                                                            class="form-check-input form-check-property1"
                                                                            id="checkbox33" type="checkbox"
                                                                            name="trades_require_access[]"
                                                                            value="Cleaner - Mandy Clark">
                                                                        <label class="form-check-label"
                                                                            for="checkbox33">Cleaner - Mandy Clark</label>
                                                                    </div>
                                                                    <div class="form-check checkbox mb-0">
                                                                        <input
                                                                            class="form-check-input form-check-property1"
                                                                            id="checkbox34" type="checkbox"
                                                                            name="trades_require_access[]"
                                                                            value="Window Cleaner - Scott">
                                                                        <label class="form-check-label"
                                                                            for="checkbox34">Window Cleaner -
                                                                            Scott</label>
                                                                    </div>
                                                                    <div class="form-check checkbox mb-0">
                                                                        <input
                                                                            class="form-check-input form-check-property1"
                                                                            id="checkbox35" type="checkbox"
                                                                            name="trades_require_access[]"
                                                                            value="Fencing - Tyler Peers">
                                                                        <label class="form-check-label"
                                                                            for="checkbox35">Fencing - Tyler Peers</label>
                                                                    </div>
                                                                    <div class="form-check checkbox mb-0">
                                                                        <input
                                                                            class="form-check-input form-check-property1"
                                                                            id="checkbox36" type="checkbox"
                                                                            name="trades_require_access[]"
                                                                            value="Flooring - Cam Desmier">
                                                                        <label class="form-check-label"
                                                                            for="checkbox36">Flooring - Cam
                                                                            Desmier</label>
                                                                    </div>
                                                                    <div class="form-check checkbox mb-0">
                                                                        <input
                                                                            class="form-check-input form-check-property1"
                                                                            id="checkbox37" type="checkbox"
                                                                            name="trades_require_access[]"
                                                                            value="Handyman - Christian Jackson">
                                                                        <label class="form-check-label"
                                                                            for="checkbox37">Handyman - Christian
                                                                            Jackson</label>
                                                                    </div>
                                                                    <div class="form-check checkbox mb-0">
                                                                        <input
                                                                            class="form-check-input form-check-property1"
                                                                            id="checkbox38" type="checkbox"
                                                                            name="trades_require_access[]"
                                                                            value="Handyman - Shane">
                                                                        <label class="form-check-label"
                                                                            for="checkbox38">Handyman - Shane</label>
                                                                    </div>
                                                                    <div class="form-check checkbox mb-0">
                                                                        <input
                                                                            class="form-check-input form-check-property1"
                                                                            id="checkbox39" type="checkbox"
                                                                            name="trades_require_access[]"
                                                                            value="Home Moving Planners - Lisa Eddy">
                                                                        <label class="form-check-label"
                                                                            for="checkbox39">Home Moving Planners - Lisa
                                                                            Eddy</label>
                                                                    </div>
                                                                    <div class="form-check checkbox mb-0">
                                                                        <input
                                                                            class="form-check-input form-check-property1"
                                                                            id="checkbox40" type="checkbox"
                                                                            name="trades_require_access[]"
                                                                            value="Bonds Locksmiths">
                                                                        <label class="form-check-label"
                                                                            for="checkbox40">Bonds Locksmiths</label>
                                                                    </div>
                                                                    <div class="form-check checkbox mb-0">
                                                                        <input
                                                                            class="form-check-input form-check-property1"
                                                                            id="checkbox41" type="checkbox"
                                                                            name="trades_require_access[]"
                                                                            value="Painting - Dava Zennaro">
                                                                        <label class="form-check-label"
                                                                            for="checkbox41">Painting - Dava
                                                                            Zennaro</label>
                                                                    </div>
                                                                    <div class="form-check checkbox mb-0">
                                                                        <input
                                                                            class="form-check-input form-check-property1"
                                                                            id="checkbox42" type="checkbox"
                                                                            name="trades_require_access[]"
                                                                            value="Plasterer - Josh">
                                                                        <label class="form-check-label"
                                                                            for="checkbox42">Plasterer - Josh</label>
                                                                    </div>
                                                                    <div class="form-check checkbox mb-0">
                                                                        <input
                                                                            class="form-check-input form-check-property1"
                                                                            id="checkbox43" type="checkbox"
                                                                            name="trades_require_access[]"
                                                                            value="Pressure Cleaning - Peter">
                                                                        <label class="form-check-label"
                                                                            for="checkbox43">Pressure Cleaning -
                                                                            Peter</label>
                                                                    </div>
                                                                    <div class="form-check checkbox mb-0">
                                                                        <input
                                                                            class="form-check-input form-check-property1"
                                                                            id="checkbox44" type="checkbox"
                                                                            name="trades_require_access[]"
                                                                            value="Carpet Steam Cleaning - John">
                                                                        <label class="form-check-label"
                                                                            for="checkbox44">Carpet Steam Cleaning -
                                                                            John</label>
                                                                    </div>
                                                                    <div class="form-check checkbox mb-0">
                                                                        <input
                                                                            class="form-check-input form-check-property1"
                                                                            id="checkbox45" type="checkbox"
                                                                            name="trades_require_access[]"
                                                                            value="Carpet Replacement - Hoskins">
                                                                        <label class="form-check-label"
                                                                            for="checkbox45">Carpet Replacement -
                                                                            Hoskins</label>
                                                                    </div>
                                                                    <div class="form-check checkbox mb-0">
                                                                        <input
                                                                            class="form-check-input form-check-property1"
                                                                            id="checkbox46" type="checkbox"
                                                                            name="trades_require_access[]"
                                                                            value="Rendering - John">
                                                                        <label class="form-check-label"
                                                                            for="checkbox46">Rendering - John</label>
                                                                    </div>
                                                                    <div class="form-check checkbox mb-0">
                                                                        <input
                                                                            class="form-check-input form-check-property1"
                                                                            id="checkbox47" type="checkbox"
                                                                            name="trades_require_access[]"
                                                                            value="Rubbish Removal - Murray">
                                                                        <label class="form-check-label"
                                                                            for="checkbox47">Rubbish Removal -
                                                                            Murray</label>
                                                                    </div>
                                                                    <div class="form-check checkbox mb-0">
                                                                        <input
                                                                            class="form-check-input form-check-property1"
                                                                            id="checkbox48" type="checkbox"
                                                                            name="trades_require_access[]"
                                                                            value="Swimming Pool">
                                                                        <label class="form-check-label"
                                                                            for="checkbox48">Swimming Pool</label>
                                                                    </div>
                                                                    <div class="form-check checkbox mb-0">
                                                                        <input
                                                                            class="form-check-input form-check-property1"
                                                                            id="checkbox49" type="checkbox"
                                                                            name="trades_require_access[]"
                                                                            value="Mortgage Broker - Marshall">
                                                                        <label class="form-check-label"
                                                                            for="checkbox49">Mortgage Broker -
                                                                            Marshall</label>
                                                                    </div>
                                                                    <div class="form-check checkbox mb-0">
                                                                        <input
                                                                            class="form-check-input form-check-property1"
                                                                            id="checkbox50" type="checkbox"
                                                                            name="trades_require_access[]"
                                                                            value="Mortgage Broker - Jacob">
                                                                        <label class="form-check-label"
                                                                            for="checkbox50">Mortgage Broker -
                                                                            Jacob</label>
                                                                    </div>
                                                                    <div class="form-check checkbox mb-0">
                                                                        <input
                                                                            class="form-check-input form-check-property1"
                                                                            id="checkbox51" type="checkbox"
                                                                            name="trades_require_access[]"
                                                                            value="Owner Builder Reports - Urban Property Inspections">
                                                                        <label class="form-check-label"
                                                                            for="checkbox51">Owner Builder Reports - Urban
                                                                            Property Inspections</label>
                                                                    </div>
                                                                    <div class="form-check checkbox mb-0">
                                                                        <input
                                                                            class="form-check-input form-check-property1"
                                                                            id="checkbox52" type="checkbox"
                                                                            name="trades_require_access[]"
                                                                            value="Removalist - MovingHouse.com.au">
                                                                        <label class="form-check-label"
                                                                            for="checkbox52">Removalist -
                                                                            MovingHouse.com.au</label>
                                                                    </div>
                                                                    <div class="form-check checkbox mb-0">
                                                                        <input
                                                                            class="form-check-input form-check-property1"
                                                                            id="checkbox53" type="checkbox"
                                                                            name="trades_require_access[]"
                                                                            value="Other Trades Needed">
                                                                        <label class="form-check-label"
                                                                            for="checkbox53">Other Trades Needed?</label>
                                                                    </div>
                                                                </div>

                                                                <!-- Fields to display below -->
                                                                <div class="mb-3" id="generalInput3"
                                                                    style="display: none;">
                                                                    <label class="form-label">How Should Trades Access the
                                                                        Property?</label>

                                                                    <div class="form-check radio radio-primary">
                                                                        <input class="form-check-input" id="radio19"
                                                                            type="radio" name="trades_access_method"
                                                                            value="contactVendor">
                                                                        <label class="form-check-label"
                                                                            for="radio19">Tradesperson to contact
                                                                            Vendor</label>
                                                                    </div>

                                                                    <div class="form-check radio radio-primary">
                                                                        <input class="form-check-input" id="radio20"
                                                                            type="radio" name="trades_access_method"
                                                                            value="vendorContact">
                                                                        <label class="form-check-label"
                                                                            for="radio20">Vendor
                                                                            to contact Tradesperson</label>
                                                                    </div>

                                                                    <div class="form-check radio radio-primary">
                                                                        <input class="form-check-input" id="radio21"
                                                                            type="radio" name="trades_access_method"
                                                                            value="vacant">
                                                                        <label class="form-check-label"
                                                                            for="radio21">Vacant</label>
                                                                    </div>

                                                                    <!-- Input field to show only when 'Vacant' is selected -->
                                                                    <div id="vacantInput3" style="margin-top: 10px;">
                                                                        <label class="form-label">Vacant Access
                                                                            Instructions:</label>
                                                                        <div class="form-check radio radio-primary">
                                                                            <input class="form-check-input"
                                                                                id="radio22" type="radio"
                                                                                name="vacant_access_instructions"
                                                                                value="KeySafe">
                                                                            <label class="form-check-label"
                                                                                for="radio22">Access via KeySafe</label>
                                                                        </div>

                                                                        <div class="form-check radio radio-primary">
                                                                            <input class="form-check-input"
                                                                                id="radio23" type="radio"
                                                                                name="vacant_access_instructions"
                                                                                value="Code">
                                                                            <label class="form-check-label"
                                                                                for="radio23">Access via Code</label>
                                                                        </div>

                                                                        <div class="form-check radio radio-primary">
                                                                            <input class="form-check-input"
                                                                                id="radio24" type="radio"
                                                                                name="vacant_access_instructions"
                                                                                value="Pending">
                                                                            <label class="form-check-label"
                                                                                for="radio24">Pending Key Safe - Confirm
                                                                                with Agent Before Attending</label>
                                                                        </div>

                                                                        <div class="form-check radio radio-primary">
                                                                            <input class="form-check-input"
                                                                                id="radio25" type="radio"
                                                                                name="vacant_access_instructions"
                                                                                value="MeetAgent">
                                                                            <label class="form-check-label"
                                                                                for="radio25">Arrange Time to Meet Agent
                                                                                On-Site</label>
                                                                        </div>

                                                                        <!-- This input shows only if "Access via Code" is selected -->
                                                                        <div id="codeInputField"
                                                                            style="display: none; margin-top: 10px;">
                                                                            <label class="form-label">Code for Key
                                                                                safe</label>
                                                                            <input type="text" class="form-control"
                                                                                name="vacant_access_code"
                                                                                placeholder="">
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="mb-3" id="otherTradesTextarea"
                                                                    style="display: none;">
                                                                    <label class="form-label">Specify Other Trades
                                                                        Needed:</label>
                                                                    <textarea class="form-control" name="other_trades_needed" rows="3" placeholder=""></textarea>
                                                                </div>

                                                                <div class="mb-3" id="painterTextarea"
                                                                    style="display: none;">
                                                                    <label class="form-label">Painting notes (if
                                                                        applicable)</label>
                                                                    <textarea class="form-control" name="painting_notes" rows="3" placeholder=""></textarea>
                                                                    <small>If any specific painting works are needed, please
                                                                        enter brief notes here.</small>
                                                                </div>

                                                                <div class="mb-3" id="gardenerTextarea"
                                                                    style="display: none;">
                                                                    <label class="form-label">Gardening notes (if
                                                                        applicable)</label>
                                                                    <textarea class="form-control" name="gardening_notes" rows="3" placeholder=""></textarea>
                                                                    <small>If any specific gardening works are needed,
                                                                        please enter brief notes here.</small>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                            </div>

                            <!-- Form Submission Buttons -->
                            <div class="card-footer text-end">
                                <button type="button" class="btn btn-secondary" id="resetFormBtn">Reset</button>
                                <button type="submit" class="btn btn-primary" id="submitFormBtn">Submit</button>
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

        .form-control,
        .form-select {
            border: 2px solid #e9ecef;
            border-radius: 8px;
            padding: 12px 15px;
            font-size: 14px;
            transition: all 0.3s ease;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: #007bff;
            box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
        }

        .form-control.is-invalid,
        .form-select.is-invalid {
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
    <link
        href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- JavaScript for Form Handling -->
    <script>
        $(document).ready(function() {
            // Pre-fill property address if available
            $('#property_address').val('{{ $appraisalData['vendor1_address'] ?? '' }}');
        });
    </script>
    <script>
        $(document).ready(function() {
            $('#toggleSupplierMessage').change(function(){
            if($(this).is(':checked')){
                $('#supplierMessageContainer').slideDown();
            } else {
                $('#supplierMessageContainer').slideUp();
            }
        });
            $('#appraisalTable').on('change', '.select-checkbox', function() {
                var table = $('#appraisalTable').DataTable();
 table.$('.select-checkbox').not(this).prop('checked', false);
               if ($(this).is(':checked')) {
        let row = $(this).closest('tr');
        let appraisal = row.data('appraisal'); // already parsed JSON object

        $.each(appraisal, function(key, value) {
            let input = $('[name="' + key + '"]');

            if (input.length) {
                if (input.attr('type') === 'radio') {
                    let radioValue = (value === true || value === "1") ? "1" : "0";
                    input.filter('[value="' + radioValue + '"]')
                         .prop('checked', true)
                         .trigger('change'); // trigger change for slideDown/Up
                } else {
                    input.val(value);
                }
            }
        });

    } else {
        $('#justListedForm').find('input, textarea, select').val('');
        $('#justListedForm').find('input[type="radio"]').prop('checked', false);
    }
            });


            let table = $('#appraisalTable').DataTable({
                paging: true,
                searching: true,
                ordering: true,
                pageLength: 5, // default to 5 rows per page
                lengthMenu: [
                    [5, 10, 15],
                    [5, 10, 15]
                ], // values and labels
                columnDefs: [{
                        orderable: false,
                        targets: 0
                    } // disable ordering on select column
                ]
            });
            // Package details mapping
            const packageDetails = {
                'package1': '<ul><li>Premium Dust Photos 12</li><li>Drone (Bomb Shot + Perspective)</li><li>Video Property Profile Standards</li><li>Floorplan & Siteplan</li><li>Professional Copywriting</li></ul>',
                'package2': '<ul><li>Premium Day Photos 12</li><li>Floorplan & Siteplan</li><li>In-house Copywriting</li></ul>',
                'package3': '<ul><li>Premium Day 6</li><li>Floorplan Redraw Only</li></ul>'
            };

            // Toggle Vendor 2 fields
            $("input[name='has_additional_vendor']").on("change", function() {
                if ($(this).val() === "1") {
                    $("#vendor2Fields").slideDown();
                } else {
                    $("#vendor2Fields").slideUp();
                    $("#vendor2Fields input").val(""); // clear values when hidden
                }
            });

            // Toggle Main Contact fields
            $('#main_contact').change(function() {
                if ($(this).val() === 'Someone else') {
                    $('#otherContactInput').show();
                } else {
                    $('#otherContactInput').hide();
                }
            });

            // Toggle Method of Sale fields
            $('#method_of_sale').change(function() {
                $('.sale-option').hide();
                const selected = $(this).val();

                switch (selected) {
                    case 'Auction':
                        $('#input-auction').show();
                        break;
                    case "Expression's Of Interest":
                        $('#input-expression').show();
                        break;
                    case 'Private Sale':
                        $('#input-private').show();
                        break;
                    case 'Off Market To Start. Auction if needed.':
                        $('#input-offmarketauction').show();
                        break;
                    case 'Forthcoming Auction':
                        $('#input-forthcoming').show();
                        break;
                    case 'Other':
                        $('#input-other').show();
                        break;
                }
            });

            // Toggle Campaign recipient fields
            $('#campaign_recipient').change(function() {
                if ($(this).val() === 'Custom Email') {
                    $('#custom_email_input').show();
                } else {
                    $('#custom_email_input').hide();
                }
            });

            // Save email as future option
            $('#save_email_btn').click(function() {
                const email = $('input[name="custom_email"]').val();
                if (email && isValidEmail(email)) {
                    // Here you would typically save to database or local storage
                    alert('Email saved as future option: ' + email);
                } else {
                    alert('Please enter a valid email address');
                }
            });

            function isValidEmail(email) {
                const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                return re.test(email);
            }

            // Toggle Agent Other fields
            $('#first_agent, #second_agent, #third_agent').change(function() {
                const agentId = $(this).attr('id');
                if ($(this).val() === 'Other') {
                    $(`#${agentId}-other-input`).show();
                } else {
                    $(`#${agentId}-other-input`).hide();
                }
            });

            // Marketing package selection
            $('#marketing_package').change(function() {
                const selected = $(this).val();

                if (selected === 'custom') {
                    $('#individual-services').show();
                    $('#package-services').hide();
                } else if (selected && selected !== '') {
                    $('#package-services').show();
                    $('#package-details').html(packageDetails[selected] || 'No details available');
                    $('#individual-services').hide();
                } else {
                    $('#package-services').hide();
                    $('#individual-services').hide();
                }
            });

            // Toggle Photography Services fields
            $('.service-checkbox').change(function() {
                const otherChecked = $('#checkbox9').is(':checked');
                const anyOtherChecked = $('.service-checkbox').not('#checkbox9').is(':checked');

                $('#other-input-field').toggle(otherChecked);
                $('#service-select-field').toggle(anyOtherChecked);
            });

            // Toggle Copywriting fields
            $('#checkbox10').change(function() {
                $('#copywriting-dropdown').toggle($(this).is(':checked'));
            });

            // Toggle Floorplan fields
            $('.floorplan-checkbox').change(function() {
                $('#floorplan-input').toggle($('.floorplan-checkbox').is(':checked'));
            });

            // Toggle Other Marketing fields
            $('input[name="other_marketing_required"]').change(function() {
                $('#marketing-input').toggle($(this).val() === '1');
            });

            // Toggle Other Supplier fields
            $('input[name="other_supplier_required"]').change(function() {
                const show = $(this).val() === '1';
                $('#supplier-add-btn').toggle(show);
                $('#supplier-input').hide(); // Hide details initially, show when Add button clicked
            });

            // Add supplier button
            $('#add-supplier-btn').click(function() {
                $('#supplier-input').toggle();
            });

            // Toggle Schedule Options
            $('.schedule-checkbox').change(function() {
                const targetId = $(this).data('target');
                if (targetId) {
                    $(targetId).toggle($(this).is(':checked'));
                }
            });

            // Toggle Supplier Access Method
            $('#supplier_access_method').change(function() {
                const isVacant = $(this).val() === 'Vacant';
                $('#vacant-access-options').toggle(isVacant);
            });

            // Toggle Vacant Access Type
            $('#vacant_access_type').change(function() {
                const value = $(this).val();
                $('#access-code-input').toggle(value === 'Access via code');
                $('#keysafe-location-input').toggle(value === 'Access via keysafe');

                // Hide other options when not applicable
                if (value !== 'Access via keysafe') {
                    $('#other-keysafe-location').hide();
                }
            });

            // Toggle Keysafe Location
            $('#keysafe_location').change(function() {
                $('#other-keysafe-location').toggle($(this).val() === 'Other');
            });

            // Toggle Occupancy Status fields
            $('#occupancyStatus').change(function() {
                $('#rented-input').toggle($(this).val() === 'Rented');
            });

            // Toggle Access to Property fields
            $('#accessToProperty').change(function() {
                $('#access-other-input').toggle($(this).val() === 'Other');
            });

            // Toggle Keysafe fields
            $('#keysafeSelect').change(function() {
                const codeOptions = [
                    'Lockbox (4-Digit Code)',
                    'Lockbox (3-Digit Code)',
                    'Keypad Door Lock',
                    'Wall Mounted Lockbox'
                ];

                const value = $(this).val();

                if (codeOptions.includes(value)) {
                    $('#lockbox-code-input').show();
                    $('#other-lockbox-input').hide();
                } else if (value === 'Other') {
                    $('#lockbox-code-input').hide();
                    $('#other-lockbox-input').show();
                } else {
                    $('#lockbox-code-input').hide();
                    $('#other-lockbox-input').hide();
                }
            });

            // Toggle Key Option fields
            $('input[name="key_option"]').change(function() {
                $('#typeInput').toggle($(this).val() === 'Type');
                $('#photoInput').toggle($(this).val() === 'Photo');
            });

            // Toggle Key Safe Location fields
            $('#keySafeSelect').change(function() {
                $('#otherInputDiv').toggle($(this).val() === 'Other');
            });

            // Toggle Alarm fields
            $('#alarmSelect').change(function() {
                const val = $(this).val();
                $('#alarmInputDiv').toggle(val === 'Yes' || val ===
                    'Yes - but won\'t be switched on during inspections');
            });

            // Toggle Trades Contacts
            $('.schedule-checkbox').change(function() {
                const anyChecked = $('.schedule-checkbox').is(':checked');
                const otherChecked = $('#checkboxOther').is(':checked');

                $('#radioSection').toggle(anyChecked);
                $('#otherInputDiv2').toggle(otherChecked);
            });

            // Toggle Trades Contact Method
            $('input[name="trades_contact_method"]').change(function() {
                $('#privacy-consent-div').toggle($(this).val() === 'Tradesperson to contact Vendor');
            });

            // Toggle Trades Require Access fields
            $('.form-check-property1').change(function() {
                const anyChecked = $('.form-check-property1').is(':checked');
                const painterChecked = $('#checkbox29').is(':checked');
                const gardenerChecked = $('#checkbox30').is(':checked') || $('#checkbox31').is(':checked');
                const otherChecked = $('#checkbox53').is(':checked');

                $('#generalInput3').toggle(anyChecked);
                $('#painterTextarea').toggle(painterChecked);
                $('#gardenerTextarea').toggle(gardenerChecked);
                $('#otherTradesTextarea').toggle(otherChecked);
            });

            // Toggle Vacant Access fields
            $('input[name="trades_access_method"]').change(function() {
                $('#vacantInput3').toggle($(this).val() === 'vacant');
            });

            // Toggle Code Input field
            $('input[name="vacant_access_instructions"]').change(function() {
                $('#codeInputField').toggle($(this).val() === 'Code');
            });

            // Form Reset
            $('#resetFormBtn').click(function() {
                if (confirm('Are you sure you want to reset the form? All entered data will be lost.')) {
                    $('#justListedForm')[0].reset();
                    $('.sale-option').hide();
                    $('#vendor2Fields').hide();
                    $('#otherContactInput').hide();
                    $('#other-agent-input').hide();
                    $('#other-second-agent-input').hide();
                    $('#third-agent-other-input').hide();
                    $('#other-input-field').hide();
                    $('#service-select-field').hide();
                    $('#copywriting-dropdown').hide();
                    $('#floorplan-input').hide();
                    $('#marketing-input').hide();
                    $('#supplier-add-btn').hide();
                    $('#supplier-input').hide();
                    $('#input15, #input16, #input19').hide();
                    $('#rented-input').hide();
                    $('#access-other-input').hide();
                    $('#lockbox-code-input').hide();
                    $('#other-lockbox-input').hide();
                    $('#typeInput').hide();
                    $('#photoInput').hide();
                    $('#otherInputDiv').hide();
                    $('#alarmInputDiv').hide();
                    $('#radioSection').hide();
                    $('#otherInputDiv2').hide();
                    $('#generalInput3').hide();
                    $('#painterTextarea').hide();
                    $('#gardenerTextarea').hide();
                    $('#otherTradesTextarea').hide();
                    $('#vacantInput3').hide();
                    $('#codeInputField').hide();
                    $('#package-services').hide();
                    $('#individual-services').hide();
                    $('#vacant-access-options').hide();
                    $('#access-code-input').hide();
                    $('#keysafe-location-input').hide();
                    $('#other-keysafe-location').hide();
                    $('#custom_email_input').hide();
                    $('#privacy-consent-div').hide();
                }
            });

            // Form Submission
            $('#justListedForm').submit(function(e) {
                e.preventDefault();

                // Validate required fields
                if (!$('#property_address').val() || !$('#vendor1_first_name').val() || !$(
                        '#vendor1_last_name').val() ||
                    !$('#vendor1_mobile').val() || !$('#vendor1_email').val() || !$('#main_contact').val()
                ) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Please fill in all required fields marked with *',
                    });
                    return;
                }

                // if (!$('#privacy_consent').is(':checked')) {
                //     Swal.fire({
                //         icon: 'error',
                //         title: 'Error',
                //         text: 'You must consent to privacy policy to proceed',
                //     });
                //     return;
                // }

                // Validate trades contact privacy consent if needed
                if ($('input[name="trades_contact_method"]:checked').val() ===
                    'Tradesperson to contact Vendor' &&
                    !$('#privacy_consent_trades').is(':checked')) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'You must consent to privacy policy for trades contacts',
                    });
                    return;
                }

                // Show loading indicator
                const submitBtn = $('#submitFormBtn');
                submitBtn.prop('disabled', true);
                submitBtn.html(
                    '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Submitting...'
                );

                // Prepare form data
                const formData = new FormData(this);

                // Submit form via AJAX
                $.ajax({
                    url: '{{ route('agent.just-listed.store') }}',
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        if (response.success) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Success',
                                text: response.message,
                                confirmButtonText: 'OK'
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    window.location.href =
                                        "{{ route('agent.just-listed.index') }}";
                                }
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: response.message ||
                                    'An error occurred while submitting the form',
                            });
                        }
                    },
                    error: function(xhr) {
                        let errorMessage = 'An error occurred while submitting the form';
                        if (xhr.responseJSON && xhr.responseJSON.message) {
                            errorMessage = xhr.responseJSON.message;
                        } else if (xhr.responseJSON && xhr.responseJSON.errors) {
                            errorMessage = '';
                            $.each(xhr.responseJSON.errors, function(key, value) {
                                errorMessage += value + '<br>';
                            });
                        }

                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            html: errorMessage,
                        });
                    },
                    complete: function() {
                        submitBtn.prop('disabled', false);
                        submitBtn.html('Submit');
                    }
                });
            });
        });
    </script>
@endsection
