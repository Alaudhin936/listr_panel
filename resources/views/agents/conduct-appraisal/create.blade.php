@extends('layout.master')
@section('main_content')
  <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
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
          <h4 class="hot-head1"><i class="fas fa-home mr-2"></i>Conduct Appraisal</h4>
          <a href="{{url()->previous()}}" class="btn btn-outline-secondary">
            <i class="fas fa-arrow-left mr-1"></i> Back
          </a>
          </div>

          <form id="conductAppraisalForm" class="form theme-form" enctype="multipart/form-data">
          @csrf
          <div class="card-body">
            <div class="row">
            @if(isset($bookingData))
        <input type="hidden" name="booking_appraisal_id" value="{{ $bookingAppraisal->id }}">
        @endif
            <!-- Vendors Section -->
            <div class="col-md-12">
              <div class="card-header card-head1 pb-0">
              <h4>Vendor 1:</h4>
              </div>
            </div>

            <div class="col-md-6">
              <div class="mb-3">
              <label class="form-label" for="vendor1_first_name">First Name *</label>
              <input class="form-control" id="vendor1_first_name" name="vendor1_first_name" type="text"
                value="{{ $bookingData['vendor1_first_name'] ?? old('vendor1_first_name') }}"
                placeholder="First Name" required>
              </div>
            </div>
            <div class="col-md-6">
              <div class="mb-3">
              <label class="form-label" for="vendor1_last_name">Last Name *</label>
              <input class="form-control" id="vendor1_last_name" name="vendor1_last_name" type="text"
                value="{{ $bookingData['vendor1_last_name'] ?? old('vendor1_last_name') }}"
                placeholder="Last Name" required>
              </div>
            </div>

            <div class="col-md-6">
              <div class="mb-3">
              <label class="form-label" for="vendor1_mobile">Mobile *</label>
              <input class="form-control" id="vendor1_mobile" name="vendor1_mobile" type="text"
                value="{{ $bookingData['vendor1_mobile'] ?? old('vendor1_mobile') }}" placeholder="" required>
              </div>
            </div>

            <div class="col-md-6">
              <div class="mb-3">
              <label class="form-label" for="vendor1_email">Email *</label>
              <input class="form-control" id="vendor1_email" name="vendor1_email" type="email"
                value="{{ $bookingData['vendor1_email'] ?? old('vendor1_email') }}" placeholder="" required>
              </div>
            </div>

            <div class="col-md-12">
              <div class="mb-3">
              <label class="form-label" for="vendor1_address">Address *</label>
              <textarea class="form-control" id="vendor1_address" name="vendor1_address" rows="3"
                required>{{ $bookingData['address'] ?? old('vendor1_address') }}</textarea>
              </div>
            </div>

            <!-- Is there anyone else on title? -->
            <div class="col-md-12">
              <label class="form-label">Add Vendor?</label>
              <div class="mb-3 m-t-15 custom-radio-ml">
              <div class="form-check radio radio-primary">
                <input class="form-check-input" id="has_additional_vendor_yes" type="radio"
                name="has_additional_vendor" value="1">
                <label class="form-check-label" for="has_additional_vendor_yes">Yes</label>
              </div>
              <div class="form-check radio radio-primary">
                <input class="form-check-input" id="has_additional_vendor_no" type="radio"
                name="has_additional_vendor" value="0">
                <label class="form-check-label" for="has_additional_vendor_no">No</label>
              </div>
              </div>

              <!-- Vendor 2 Fields (Hidden by default) -->
              <div id="vendor2Fields" style="display: none;">
              <div class="row">
                <div class="col-md-6">
                <div class="mb-3">
                  <label class="form-label" for="vendor2_first_name">First Name</label>
                  <input class="form-control" id="vendor2_first_name" name="vendor2_first_name" type="text"
                  placeholder="First Name">
                </div>
                </div>
                <div class="col-md-6">
                <div class="mb-3">
                  <label class="form-label" for="vendor2_last_name">Last Name</label>
                  <input class="form-control" id="vendor2_last_name" name="vendor2_last_name" type="text"
                  placeholder="Last Name">
                </div>
                </div>

                <div class="col-md-6">
                <div class="mb-3">
                  <label class="form-label" for="vendor2_mobile">Mobile</label>
                  <input class="form-control" id="vendor2_mobile" name="vendor2_mobile" type="text"
                  placeholder="">
                </div>
                </div>

                <div class="col-md-6">
                <div class="mb-3">
                  <label class="form-label" for="vendor2_email">Email</label>
                  <input class="form-control" id="vendor2_email" name="vendor2_email" type="email"
                  placeholder="">
                </div>
                </div>
              </div>
              </div>
              <!-- After the "Add vendor" section, add: -->
              <div class="col-md-12">
              <div class="mb-3">
                <label class="form-label">Main point of contact</label>
                <div class="form-check radio radio-primary">
                <input class="form-check-input" id="main_contact_vendor1" type="radio" name="main_contact"
                  value="Vendor 1">
                <label class="form-check-label" for="main_contact_vendor1">Vendor 1</label>
                </div>
                <div class="form-check radio radio-primary">
                <input class="form-check-input" id="main_contact_vendor2" type="radio" name="main_contact"
                  value="Vendor 2">
                <label class="form-check-label" for="main_contact_vendor2">Vendor 2</label>
                </div>
                <div class="form-check radio radio-primary">
                <input class="form-check-input" id="main_contact_someone_else" type="radio"
                  name="main_contact" value="Someone Else">
                <label class="form-check-label" for="main_contact_someone_else">Someone Else</label>
                </div>
              </div>
              </div>

              <!-- Someone Else fields (hidden by default) -->
              <div id="someone-else-fields" style="display: none;">
              <div class="col-md-6">
                <div class="mb-3">
                <label class="form-label" for="main_contact_first_name">Main contact's first name</label>
                <input class="form-control" id="main_contact_first_name" name="main_contact_first_name"
                  type="text">
                </div>
              </div>
              <div class="col-md-6">
                <div class="mb-3">
                <label class="form-label" for="main_contact_last_name">Last name</label>
                <input class="form-control" id="main_contact_last_name" name="main_contact_last_name"
                  type="text">
                </div>
              </div>
              <div class="col-md-6">
                <div class="mb-3">
                <label class="form-label" for="main_contact_mobile">Mobile</label>
                <input class="form-control" id="main_contact_mobile" name="main_contact_mobile" type="text">
                </div>
              </div>
              <div class="col-md-6">
                <div class="mb-3">
                <label class="form-label" for="main_contact_email">Email</label>
                <input class="form-control" id="main_contact_email" name="main_contact_email" type="email">
                </div>
              </div>
              </div>
            </div>

            <!-- Accordion Sections -->
            <div class="col-sm-12 col-lg-12">
              <div class="accordion accordion-flush" id="accordionFlushExample">



              <!-- start Appraisal Section -->
              <div class="accordion-item">
                <h2 class="accordion-header" id="flush-headingTwo">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                  data-bs-target="#flush-collapseTwo" aria-expanded="false"
                  aria-controls="flush-collapseTwo">
                  <i class="fas fa-stopwatch mr-2"></i> Start Appraisal
                </button>
                </h2>
                <div id="flush-collapseTwo" class="accordion-collapse collapse"
                aria-labelledby="flush-headingTwo" data-bs-parent="#accordionFlushExample">
                <div class="accordion-body">

                  <!-- Property Type Quick -->
                  <div class="mb-3">
                  <label class="form-label">Property Type *</label>
                  <div class="form-check radio radio-primary">
                    <input class="form-check-input" id="property_type_house" type="radio"
                    name="property_type_quick" value="House">
                    <label class="form-check-label" for="property_type_house">House</label>
                  </div>
                  <div class="form-check radio radio-primary">
                    <input class="form-check-input" id="property_type_unit" type="radio"
                    name="property_type_quick" value="Unit">
                    <label class="form-check-label" for="property_type_unit">Unit</label>
                  </div>
                  <div class="form-check radio radio-primary">
                    <input class="form-check-input" id="property_type_townhouse" type="radio"
                    name="property_type_quick" value="Townhouse">
                    <label class="form-check-label" for="property_type_townhouse">Townhouse</label>
                  </div>
                  <div class="form-check radio radio-primary">
                    <input class="form-check-input" id="property_type_apartment" type="radio"
                    name="property_type_quick" value="Apartment">
                    <label class="form-check-label" for="property_type_apartment">Apartment</label>
                  </div>
                  <div class="form-check radio radio-primary">
                    <input class="form-check-input" id="property_type_viewmore" type="radio"
                    name="property_type_quick" value="Viewmore">
                    <label class="form-check-label" for="property_type_viewmore">View more</label>
                  </div>
                  </div>

                  <!-- Hidden section for Viewmore -->
                  <div class="mb-3" id="viewmore-section" style="display: none;">
                  <label class="form-label">Property Type (cont):</label>
                  <div class="form-check radio radio-primary">
                    <input class="form-check-input" id="property_type_duplex" type="radio"
                    name="more_property_type" value="Duplex">
                    <label class="form-check-label" for="property_type_duplex">Duplex</label>
                  </div>
                  <div class="form-check radio radio-primary">
                    <input class="form-check-input" id="property_type_land" type="radio"
                    name="more_property_type" value="Land">
                    <label class="form-check-label" for="property_type_land">Land</label>
                  </div>
                  <div class="form-check radio radio-primary">
                    <input class="form-check-input" id="property_type_acreage" type="radio"
                    name="more_property_type" value="Acreage">
                    <label class="form-check-label" for="property_type_acreage">Acreage</label>
                  </div>
                  <div class="form-check radio radio-primary">
                    <input class="form-check-input" id="property_type_rural" type="radio"
                    name="more_property_type" value="Rural">
                    <label class="form-check-label" for="property_type_rural">Rural</label>
                  </div>
                  <div class="form-check radio radio-primary">
                    <input class="form-check-input" id="property_type_block" type="radio"
                    name="more_property_type" value="Block of Units">
                    <label class="form-check-label" for="property_type_block">Block of Units</label>
                  </div>
                  <div class="form-check radio radio-primary">
                    <input class="form-check-input" id="property_type_other" type="radio"
                    name="more_property_type" value="Other">
                    <label class="form-check-label" for="property_type_other">Other</label>
                  </div>
                  </div>

                  <!-- Other Property Type Input -->
                  <div id="other-property-type-input" style="display: none; margin-top: 10px;margin-bottom:15px">
                  <label class="form-label">Specify Other Property Type Here:</label>
                  <input type="text" class="form-control" id="other_property_type"
                    name="other_property_type" placeholder="" />
                  </div>
<div class="mb-3">
    <label class="form-label">Bedrooms:</label>
    <div class="bubble-container">
        <div class="bubble-btn" data-value="1" data-field="bedrooms">1</div>
        <div class="bubble-btn" data-value="2" data-field="bedrooms">2</div>
        <div class="bubble-btn" data-value="3" data-field="bedrooms">3</div>
        <div class="bubble-btn" data-value="4" data-field="bedrooms">4</div>
        <div class="bubble-btn plus-btn" data-value="more" data-field="bedrooms">5+</div>
    </div>
    <input type="hidden" name="bedrooms" id="bedrooms">
</div>

<!-- More Bedrooms Input -->
<div id="more-bedrooms-input" style="display: none; margin-top: 10px;margin-bottom:15px">
    <label class="form-label">Total Number Of Bedrooms:</label>
    <input type="number" class="form-control" name="more_bedrooms" placeholder="Enter number of bedrooms" />
</div>

<!-- Bathrooms - change data-field from "bathrooms_quick" to "bathrooms" -->
<div class="mb-3">
    <label class="form-label">Bathrooms:</label>
    <div class="bubble-container">
        <div class="bubble-btn" data-value="1" data-field="bathrooms">1</div>
        <div class="bubble-btn" data-value="2" data-field="bathrooms">2</div>
        <div class="bubble-btn" data-value="3" data-field="bathrooms">3</div>
        <div class="bubble-btn" data-value="4" data-field="bathrooms">4</div>
        <div class="bubble-btn plus-btn" data-value="more" data-field="bathrooms">5+</div>
    </div>
    <input type="hidden" name="bathrooms" id="bathrooms">
</div>

<!-- More Bathrooms Input -->
<div id="more-bathrooms-input" style="display: none; margin-top: 10px;margin-bottom:15px">
    <label class="form-label">Note actual number of Bathrooms:</label>
    <input type="number" class="form-control" name="more_bathrooms" placeholder="Enter number of bathrooms" />
</div>

<!-- Living Areas - change data-field from "living_areas_quick" to "living_areas" -->
<div class="mb-3">
    <label class="form-label">Living Areas:</label>
    <div class="bubble-container">
        <div class="bubble-btn" data-value="1" data-field="living_areas">1</div>
        <div class="bubble-btn" data-value="2" data-field="living_areas">2</div>
        <div class="bubble-btn" data-value="3" data-field="living_areas">3</div>
        <div class="bubble-btn" data-value="4" data-field="living_areas">4</div>
        <div class="bubble-btn plus-btn" data-value="more" data-field="living_areas">5+</div>
    </div>
    <input type="hidden" name="living_areas" id="living_areas">
</div>

<!-- More Living Areas Input -->
<div id="more-living-input" style="display: none; margin-top: 10px;margin-bottom:15px">
    <label class="form-label">Enter Total Number of Living Areas:</label>
    <input type="number" class="form-control" name="more_living_areas" placeholder="Enter number of living areas" />
</div>

                  <!-- Add after "Living Areas" in the Start Appraisal section -->
                  <div class="mb-3">
                  <label class="form-label">Study / Home Office</label>
                  <div class="form-check radio radio-primary">
                    <input class="form-check-input" id="study_full" type="radio" name="study_type"
                    value="Full Study">
                    <label class="form-check-label" for="study_full">Full Study</label>
                  </div>
                  <div class="form-check radio radio-primary">
                    <input class="form-check-input" id="study_home_office" type="radio" name="study_type"
                    value="Home Office">
                    <label class="form-check-label" for="study_home_office">Home Office</label>
                  </div>
                  <div class="form-check radio radio-primary">
                    <input class="form-check-input" id="study_nook" type="radio" name="study_type"
                    value="Study Nook">
                    <label class="form-check-label" for="study_nook">Study Nook</label>
                  </div>
                  <div class="form-check radio radio-primary">
                    <input class="form-check-input" id="study_na" type="radio" name="study_type"
                    value="N/A">
                    <label class="form-check-label" for="study_na">N/A</label>
                  </div>
                  </div>
                  <!-- Kitchen Quick -->
                  <div class="mb-3">
                  <label class="form-label">Kitchen:</label>
                  <div class="form-check radio radio-primary">
                    <input class="form-check-input" id="kitchen_modern" type="radio"
                    name="kitchen_condition_quick" value="Modern">
                    <label class="form-check-label" for="kitchen_modern">Modern</label>
                  </div>
                  <div class="form-check radio radio-primary">
                    <input class="form-check-input" id="kitchen_updated" type="radio"
                    name="kitchen_condition_quick" value="Updated">
                    <label class="form-check-label" for="kitchen_updated">Updated</label>
                  </div>
                  <div class="form-check radio radio-primary">
                    <input class="form-check-input" id="kitchen_neat" type="radio"
                    name="kitchen_condition_quick" value="Neat & Tidy">
                    <label class="form-check-label" for="kitchen_neat">Neat & Tidy</label>
                  </div>
                  <div class="form-check radio radio-primary">
                    <input class="form-check-input" id="kitchen_original" type="radio"
                    name="kitchen_condition_quick" value="Original">
                    <label class="form-check-label" for="kitchen_original">Original</label>
                  </div>
                  </div>

                  <div class="card-header card-head1 pb-0">
                  <h4 style="font-size: 1.5rem;">Exterior & Outdoors</h4>
                  <!-- Land Size -->
                  <div class="col-md-12 ">
                    <div class="mb-3 pt-3">
                    <label class="form-label" for="land_size_quick">Landsize (sqm)</label>
                    <input class="form-control" id="land_size_quick" name="land_size_quick"
                      type="number" placeholder="e.g., 23">
                    </div>
                  </div>
                  </div> <!-- Exterior -->
                 <!-- Replace the current exterior materials section with this code -->
<div class="mb-3">
  <label class="form-label">Exterior Material</label>
  <select class="form-control" id="exterior_material" name="exterior_material" onchange="toggleExteriorMaterialOther()">
    <option value="">Please Select</option>
    <option value="Brick">Brick</option>
    <option value="Render">Render</option>
    <option value="Weatherboard">Weatherboard</option>
    <option value="Cladding">Cladding</option>
    <option value="Mixed Materials">Mixed Materials</option>
    <option value="Other">Other</option>
  </select>
</div>

<!-- Other exterior material input (hidden by default) -->
<div id="other-exterior-material" style="display: none; margin-top: 10px; margin-bottom:15px;">
  <input type="text" class="form-control" name="other_exterior_material" placeholder="Specify exterior material">
</div>

<script>
function toggleExteriorMaterialOther() {
  const exteriorMaterialSelect = document.getElementById('exterior_material');
  const otherExteriorMaterial = document.getElementById('other-exterior-material');
  
  if (exteriorMaterialSelect.value === 'Other') {
    otherExteriorMaterial.style.display = 'block';
  } else {
    otherExteriorMaterial.style.display = 'none';
  }
}
</script>

                  <!-- Single/Double Storey -->
                  <div class="mb-3">
                  <label class="form-label">Single/Double Storey?</label>
                  <select class="form-control" name="storeys">
                    <option value="">Please Select</option>
                    <option value="Single Level">Single Level</option>
                    <option value="Double Story">Double Story</option>
                    <option value="Triple Story">Triple Story</option>
                  </select>
                  </div>

                  <!-- Year Built -->
                  <div class="mb-3">
                  <label class="form-label" for="year_built">Approximate Year Built:</label>
               <select class="form-control" id="year_built" name="year_built" onchange="toggleYearBuiltOther()">

                    <option value="">Please Select</option>
                    <option value="2020–Present">2020–Present</option>
                    <option value="2010s">2010s</option>
                    <option value="2000s">2000s</option>
                    <option value="1990s">1990s</option>
                    <option value="1980s">1980s</option>
                    <option value="1970s">1970s</option>
                    <option value="1960s">1960s</option>
                    <option value="1950s">1950s</option>
                    <option value="Pre-1950">Pre-1950</option>
                    <option value="Unknown">Unknown</option>
                    <option value="Other">Other</option>
                  </select>
                  </div>


                  <!-- Other year built input (hidden by default) -->
                  <div id="other-year-built" style="display: none; margin-top: 10px;">
                  <input type="text" class="form-control" name="other_year_built"
                    placeholder="Specify year built">
                  </div>
                  <!-- Outdoor Features -->
                  <div class="mb-3">
                  <label class="form-label">Outdoor Features:</label>
                  <div class="form-check checkbox mb-2">
                    <input class="form-check-input" id="outdoor_deck" name="outdoor_features[]"
                    type="checkbox" value="Deck">
                    <label class="form-check-label" for="outdoor_deck">Deck</label>
                  </div>
                  <div class="form-check checkbox mb-2">
                    <input class="form-check-input" id="outdoor_covered" name="outdoor_features[]"
                    type="checkbox" value="Covered Outdoor Area">
                    <label class="form-check-label" for="outdoor_covered">Covered Outdoor Area</label>
                  </div>
                  <div class="form-check checkbox mb-2">
                    <input class="form-check-input" id="outdoor_small_yard" name="outdoor_features[]"
                    type="checkbox" value="Small Yard">
                    <label class="form-check-label" for="outdoor_small_yard">Small Yard</label>
                  </div>
                  <div class="form-check checkbox mb-2">
                    <input class="form-check-input" id="outdoor_medium_yard" name="outdoor_features[]"
                    type="checkbox" value="Medium Yard">
                    <label class="form-check-label" for="outdoor_medium_yard">Medium Yard</label>
                  </div>
                  <div class="form-check checkbox mb-2">
                    <input class="form-check-input" id="outdoor_large_yard" name="outdoor_features[]"
                    type="checkbox" value="Large Yard">
                    <label class="form-check-label" for="outdoor_large_yard">Large Yard</label>
                  </div>
                  <div class="form-check checkbox mb-2">
                    <input class="form-check-input" id="outdoor_courtyard" name="outdoor_features[]"
                    type="checkbox" value="Courtyard">
                    <label class="form-check-label" for="outdoor_courtyard">Courtyard</label>
                  </div>
                  <div class="form-check checkbox mb-2">
                    <input class="form-check-input" id="outdoor_garden" name="outdoor_features[]"
                    type="checkbox" value="Well-Established Garden">
                    <label class="form-check-label" for="outdoor_garden">Well-Established Garden</label>
                  </div>
                  <div class="form-check checkbox mb-2">
                    <input class="form-check-input" id="outdoor_shed" name="outdoor_features[]"
                    type="checkbox" value="Shed or Workshop">
                    <label class="form-check-label" for="outdoor_shed">Shed or Workshop</label>
                  </div>
                  <div class="form-check checkbox mb-2">
                    <input class="form-check-input" id="outdoor_water_tank" name="outdoor_features[]"
                    type="checkbox" value="Water Tank">
                    <label class="form-check-label" for="outdoor_water_tank">Water Tank</label>
                  </div>
                  <div class="form-check checkbox mb-2">
                    <input class="form-check-input" id="outdoor_pool" name="outdoor_features[]"
                    type="checkbox" value="Pool">
                    <label class="form-check-label" for="outdoor_pool">Pool</label>
                  </div>
                  <div class="form-check checkbox mb-2">
                    <input class="form-check-input" id="outdoor_spa" name="outdoor_features[]"
                    type="checkbox" value="Spa">
                    <label class="form-check-label" for="outdoor_spa">Spa</label>
                  </div>
                  <div class="form-check checkbox mb-2">
                    <input class="form-check-input" id="outdoor_other" name="outdoor_features[]"
                    type="checkbox" value="Other">
                    <label class="form-check-label" for="outdoor_other">Other</label>
                  </div>

                  <!-- Other Outdoor Features Input -->
                  <div id="outdoor-other-input" class="mt-2" style="display: none;">
                    <input type="text" class="form-control" name="outdoor_features_other"
                    placeholder="Please type another option here">
                  </div>
                  </div>
<!-- Car Spaces Quick -->
<div class="mb-3">
    <label class="form-label">
        <i class="fas fa-car"></i>
        Covered Car Spaces:
    </label>
    <div class="bubble-container">
        <div class="bubble-btn" data-value="1" data-field="car_spaces">1</div>
        <div class="bubble-btn" data-value="2" data-field="car_spaces">2</div>
        <div class="bubble-btn" data-value="3" data-field="car_spaces">3</div>
        <div class="bubble-btn" data-value="4" data-field="car_spaces">4</div>
        <div class="bubble-btn plus-btn" data-value="more" data-field="car_spaces">5+</div>
    </div>
    <input type="hidden" name="car_spaces" id="car_spaces">
</div>

<div id="car-accommodation-type" style="display: none; margin-top: 10px;margin-bottom:15px">
    <label class="form-label">Type of car accommodation:</label>
    <div class="form-check radio radio-primary">
        <input class="form-check-input" id="car_garage" type="radio" name="car_accommodation_type" value="Garage">
        <label class="form-check-label" for="car_garage">Garage</label>
    </div>
    <div class="form-check radio radio-primary">
        <input class="form-check-input" id="car_carport" type="radio" name="car_accommodation_type" value="Carport">
        <label class="form-check-label" for="car_carport">Carport</label>
    </div>
    <div class="form-check radio radio-primary">
        <input class="form-check-input" id="car_both" type="radio" name="car_accommodation_type" value="Garage + Carport">
        <label class="form-check-label" for="car_both">Garage + Carport</label>
    </div>
    <div class="form-check radio radio-primary">
        <input class="form-check-input" id="car_other" type="radio" name="car_accommodation_type" value="Other">
        <label class="form-check-label" for="car_other">Other</label>
    </div>
</div>

<!-- More Car Spaces Input (shows only for 5+) -->
<div id="more-car-spaces-input" style="display: none; margin-top: 10px;margin-bottom:15px">
    <label class="form-label">Total Number of Car Spaces:</label>
    <input type="number" class="form-control" name="more_car_spaces" placeholder="Enter total number of car spaces" />
</div>

<div id="car-accommodation-spec" style="display: none; margin-top: 10px;margin-bottom:15px">
    <div class="mb-3">
        <label class="form-label" for="car_accommodation_spec">Specify Car Accommodation Here</label>
        <input class="form-control" id="car_accommodation_spec" name="car_accommodation_spec" type="text" placeholder="">
    </div>
</div>
                  <!-- Add Extra Info -->
                  <div class="mb-3">
                  <label class="form-label">Add Extra Info (Optional):</label>
                  <div class="form-check checkbox mb-2">
                    <input class="form-check-input" id="add_notes" type="checkbox" value="1">
                    <label class="form-check-label" for="add_notes">Add Notes</label>
                  </div>
                  <div class="form-check checkbox mb-2">
                    <input class="form-check-input" id="take_photos" type="checkbox" value="1">
                    <label class="form-check-label" for="take_photos">Take Property Photos</label>
                  </div>

                  <!-- Agent Notes -->
                  <div id="agent-notes-input" class="mb-3 mt-2" style="display: none;">
                    <label class="form-label">Agent Notes</label>
                    <textarea class="form-control" name="agent_notes" rows="3"></textarea>
                  </div>

                  <!-- Property Photos -->
                  <div id="property-photos-input" style="display: none;">
                    <div class="mb-3 mt-2">
                    <label class="form-label">Take Photo 1</label>
                    <input type="file" name="property_photos[]" class="form-control" accept="image/*">
                    </div>
                    <div class="mb-3 mt-2">
                    <label class="form-label">Take Photo 2</label>
                    <input type="file" name="property_photos[]" class="form-control" accept="image/*">
                    </div>
                    <div class="mb-3 mt-2">
                    <label class="form-label">Take Photo 3</label>
                    <input type="file" name="property_photos[]" class="form-control" accept="image/*">
                    </div>
                    <div class="mb-3 mt-2">
                    <label class="form-label">Take Photo 4</label>
                    <input type="file" name="property_photos[]" class="form-control" accept="image/*">
                    </div>

                    <!-- More Photos Option -->
                    <div class="mb-3">
                    <label class="form-label">Add more photos?</label>
                    <div class="form-check radio radio-primary">
                      <input class="form-check-input" id="more_photos_yes" type="radio"
                      name="add_more_photos" value="yes">
                      <label class="form-check-label" for="more_photos_yes">Yes</label>
                    </div>
                    <div class="form-check radio radio-primary">
                      <input class="form-check-input" id="more_photos_no" type="radio"
                      name="add_more_photos" value="no">
                      <label class="form-check-label" for="more_photos_no">No</label>
                    </div>

                    <!-- Additional Photos -->
                    <div id="additional-photos" class="mb-3 mt-2" style="display: none;">
                      <div class="mb-3 mt-2">
                      <label class="form-label">Take Photo 5</label>
                      <input type="file" name="property_photos[]" class="form-control"
                        accept="image/*">
                      </div>
                      <div class="mb-3 mt-2">
                      <label class="form-label">Take Photo 6</label>
                      <input type="file" name="property_photos[]" class="form-control"
                        accept="image/*">
                      </div>
                      <div class="mb-3 mt-2">
                      <label class="form-label">Take Photo 7</label>
                      <input type="file" name="property_photos[]" class="form-control"
                        accept="image/*">
                      </div>
                      <div class="mb-3 mt-2">
                      <label class="form-label">Take Photo 8</label>
                      <input type="file" name="property_photos[]" class="form-control"
                        accept="image/*">
                      </div>
                    </div>
                    </div>
                  </div>
                  </div>

                  <div class="mb-3">
                  <label class="form-label">Overall Property Condition:</label>
                  <div class="form-check radio radio-primary">
                    <input class="form-check-input" id="condition_excellent" type="radio"
                    name="property_condition_quick" value="Excellent (New or Fully Renovated)">
                    <label class="form-check-label" for="condition_excellent">Excellent (New or Fully
                    Renovated)</label>
                  </div>
                  <div class="form-check radio radio-primary">
                    <input class="form-check-input" id="condition_good" type="radio"
                    name="property_condition_quick" value="Good (Updated or Well Maintained)">
                    <label class="form-check-label" for="condition_good">Good (Updated or Well
                    Maintained)</label>
                  </div>
                  <div class="form-check radio radio-primary">
                    <input class="form-check-input" id="condition_partial" type="radio"
                    name="property_condition_quick"
                    value="Partially Updated (Some work done, not fully Updated)">
                    <label class="form-check-label" for="condition_partial">Partially Updated (Some work
                    done, not fully Updated)</label>
                  </div>
                  <div class="form-check radio radio-primary">
                    <input class="form-check-input" id="condition_neat" type="radio"
                    name="property_condition_quick" value="Neat & Tidy (Original but well presented)">
                    <label class="form-check-label" for="condition_neat">Neat & Tidy (Original but well
                    presented)</label>
                  </div>
                  <div class="form-check radio radio-primary">
                    <input class="form-check-input" id="condition_tired" type="radio"
                    name="property_condition_quick" value="Tired Condition">
                    <label class="form-check-label" for="condition_tired">Tired Condition</label>
                  </div>
                  <div class="form-check radio radio-primary">
                    <input class="form-check-input" id="condition_land" type="radio"
                    name="property_condition_quick" value="Land Value">
                    <label class="form-check-label" for="condition_land">Land Value</label>
                  </div>
                  </div>

                  <!-- Vendor Motivation -->
                  <div class="mb-3">
                  <label class="form-label">Vendor Motivation</label>
                  <div class="form-check radio radio-primary">
                    <input class="form-check-input" id="motivation_hot" type="radio"
                    name="vendor_motivation" value="Hot">
                    <label class="form-check-label" for="motivation_hot">Hot</label>
                  </div>
                  <div class="form-check radio radio-primary">
                    <input class="form-check-input" id="motivation_warm" type="radio"
                    name="vendor_motivation" value="Warm">
                    <label class="form-check-label" for="motivation_warm">Warm</label>
                  </div>
                  <div class="form-check radio radio-primary">
                    <input class="form-check-input" id="motivation_cold" type="radio"
                    name="vendor_motivation" value="Cold">
                    <label class="form-check-label" for="motivation_cold">Cold</label>
                  </div>
                  </div>
                </div>
                </div>

              </div>


              {{--
              <!-- Exterior Material -->
              <div class="mb-3">
                <label class="form-label">Exterior Material:</label>
                <div class="form-check radio radio-primary">
                <input class="form-check-input" id="exterior_weatherboard" type="radio"
                  name="exterior_material_quick" value="Weatherboard">
                <label class="form-check-label" for="exterior_weatherboard">Weatherboard</label>
                </div>
                <div class="form-check radio radio-primary">
                <input class="form-check-input" id="exterior_brick" type="radio"
                  name="exterior_material_quick" value="Brick">
                <label class="form-check-label" for="exterior_brick">Brick</label>
                </div>
                <div class="form-check radio radio-primary">
                <input class="form-check-input" id="exterior_etc" type="radio"
                  name="exterior_material_quick" value="Etc">
                <label class="form-check-label" for="exterior_etc">Etc</label>
                </div>
              </div> --}}


              <!-- Contacts To Maximise Price Section -->
              <div class="accordion-item">
                <h2 class="accordion-header" id="flush-headingSix">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                  data-bs-target="#flush-collapseSix" aria-expanded="false"
                  aria-controls="flush-collapseSix">
                  <i class="fas fa-address-book mr-2"></i> Contacts To Maximise Price
                </button>
                </h2>
                <div id="flush-collapseSix" class="accordion-collapse collapse"
                aria-labelledby="flush-headingSix" data-bs-parent="#accordionFlushExample">
                <div class="accordion-body">

                <div class="mb-2">
    <h5 class="mb-3">{{auth()->guard('agent')->user()->name}} ,Recommended Trades </h5>
    @if($tradePersons->count() > 0)
        <div class="trade-persons-list mb-3">
            @foreach($tradePersons as $tradePerson)
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="trade_persons[]" 
                           value="{{ $tradePerson->id }}" id="trade_person_{{ $tradePerson->id }}">
                    <label class="form-check-label" for="trade_person_{{ $tradePerson->id }}">
                        {{ $tradePerson->name }} ({{ $tradePerson->profession }})
                    </label>
                </div>
            @endforeach
        </div>
    @else
        <div class="alert alert-info">
            No trade persons found. 
            <a href="{{ route('agent.trade-persons.index') }}" class="btn btn-sm btn-outline-primary">
                Add Trade Person
            </a>
        </div>
    @endif
</div>
                  <div id="contact-who-section">
                  <div class="mb-3">
                    <label class="form-label">Who should contact who?</label>
                    <div class="form-check radio radio-primary">
                    <input class="form-check-input" id="contact_agent" type="radio" name="contact_who"
                      value="Tradesperson to contact Agent">
                    <label class="form-check-label" for="contact_agent">Tradesperson to contact
                      Agent</label>
                    </div>
                    <div class="form-check radio radio-primary">
                    <input class="form-check-input" id="contact_vendor" type="radio" name="contact_who"
                      value="Tradesperson to contact Vendor">
                    <label class="form-check-label" for="contact_vendor">Tradesperson to contact
                      Vendor</label>
                    </div>
                    <div class="form-check radio radio-primary">
                    <input class="form-check-input" id="vendor_contact" type="radio" name="contact_who"
                      value="Vendor to contact Tradesperson">
                    <label class="form-check-label" for="vendor_contact">Vendor to contact
                      Tradesperson</label>
                    </div>
                  </div>
                  </div>
<div id="privacy-consent-section" style="display: none;">
    <div class="form-check checkbox mb-2">
        <input class="form-check-input" id="privacy_consent_checkbox" name="privacy_consent"
               type="checkbox" value="1">
        <label class="form-check-label" for="privacy_consent_checkbox">I consent to my contact details
               being shared with approved suppliers to assist in marketing and preparing my
               property for sale.</label>
    </div>
</div>
                </div>
                </div>
              </div>



              <!-- Smart Send Section -->
              <div class="accordion-item">
                <h2 class="accordion-header" id="flush-headingSeven">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                  data-bs-target="#flush-collapseSeven" aria-expanded="false"
                  aria-controls="flush-collapseSeven">
                  <i class="fas fa-paper-plane mr-2"></i> Smart Send
                </button>
                </h2>
                <div id="flush-collapseSeven" class="accordion-collapse collapse"
                aria-labelledby="flush-headingSeven" data-bs-parent="#accordionFlushExample">
                <div class="accordion-body">

     @if($emailTemplates->count() > 0)
    <select class="form-select" name="email_template" id="email_template">
        <option value="">Select Email Template</option>
        @foreach($emailTemplates as $template)
            <option value="{{ $template->id }}" 
                    data-content="{{ $template->content }}"
                    data-subject="{{ $template->subject ?? '' }}">
                {{ $template->name }}
            </option>
        @endforeach
    </select>
    <button type="button" class="btn btn-sm btn-outline-primary mt-2" id="previewEmail">
        Preview Email
    </button>
    
    <!-- Add this hidden input for follow_up_email -->
    <input type="hidden" name="follow_up_email" id="follow_up_email">
    <input type="hidden" name="follow_up_sms" id="follow_up_sms">
    <input type="hidden" name="sms_message" id="sms_message">

    <!-- Email Preview Textarea -->
    <div id="email-preview-section" style="display: none; margin-top: 15px;">
        <label class="form-label">Email Preview:</label>
        <div class="mb-2">
            <label class="form-label"><strong>Subject:</strong></label>
            <input type="text" class="form-control" id="email-subject-preview">
        </div>
        <label class="form-label"><strong>Content:</strong></label>
        <textarea class="form-control" id="email-content-preview" rows="12" style="font-family: monospace; font-size: 13px;"></textarea>
    </div>
@else
    <div class="alert alert-info">
        No email templates found. 
        <a href="{{ route('agent.tempforconduct.index') }}" class="btn btn-sm btn-outline-primary">
            Add Email Template
        </a>
    </div>
@endif
<div class="mb-3">
    <h6>SMS Template</h6>
    
    @if($smsTemplates->count() > 0)
        <select class="form-select" name="sms_template" id="sms_template">
            <option value="">Select SMS Template</option>
            @foreach($smsTemplates as $template)
                <option value="{{ $template->id }}" data-content="{{ $template->content }}">
                    {{ $template->name }}
                </option>
            @endforeach
        </select>
        <button type="button" class="btn btn-sm btn-outline-primary mt-2" id="previewSms">
            Preview SMS
        </button>
        
      <!-- SMS Preview Textarea -->
<div id="sms-preview-section" style="display: none; margin-top: 15px;">
    <label class="form-label">SMS Preview:</label>
    <textarea class="form-control" id="sms-content-preview" rows="6"  style="font-family: monospace; font-size: 13px;"></textarea>
</div>
    @else
        <div class="alert alert-info">
            No SMS templates found. 
            <a href="{{ route('agent.tempforconduct.index') }}" class="btn btn-sm btn-outline-primary">
                Add SMS Template
            </a>
        </div>
    @endif
</div>

                  <!-- Send Proposal -->
                  <div class="mb-3">
                  <label class="form-label">Send Proposal:</label><br>
                  <select class="form-control" id="send_proposal_select" name="send_proposal">
                    <option value="">Please Select</option>
                    <option value="1">Yes</option>
                    <option value="0">No</option>
                  </select>
                  </div>

                  <!-- Proposal Details -->
                  <div id="proposal-details" style="display: none;">
                  <!-- Include Price -->
                  <div class="mb-3">
                    <label class="form-label">Include Price:</label>
                    <select class="form-control" id="include_price_select" name="include_price">
                    <option value="">Please Select</option>
                    <option value="1">Yes</option>
                    <option value="0">No</option>
                    </select>
                  </div>

                  <!-- Price Information -->
                  <div id="price-information" style="display: none;">
                    <div class="mb-3">
                    <label class="form-label">Price Information to include:</label>
                    <input type="text" class="form-control" name="price_information" placeholder="">
                    </div>
                  </div>

                  <!-- Method -->
                  <div class="mb-3">
                    <label class="form-label">Method:</label>
                    <select class="form-control" id="proposal_method_select" name="proposal_method">
                    <option value="">Please Select</option>
                    <option value="Auction">Auction</option>
                    <option value="EOI">EOI</option>
                    <option value="Private Sale">Private Sale</option>
                    <option value="Off-Market">Off-Market</option>
                    <option value="Off-Market to Start - Auction if Needed">Off-Market to Start -
                      Auction if Needed</option>
                    </select>
                  </div>

                  <!-- Auction/EOI Date -->
                  <div class="mb-3">
                    <label class="form-label">Auction/EOI Date:</label>
                    <input class="form-control" name="auction_eoi_date" type="date">
                  </div>

                  <!-- Key Dates for Proposal -->
                  <div id="proposal-key-dates" style="display: none;">
                    <div class="mb-3">
                    <label class="form-label">Include Other Key Dates Discussed?</label>
                    <div class="form-check radio radio-primary">
                      <input class="form-check-input" id="include_key_dates_yes" type="radio"
                      name="include_other_key_dates" value="1">
                      <label class="form-check-label" for="include_key_dates_yes">Yes</label>
                    </div>
                    <div class="form-check radio radio-primary">
                      <input class="form-check-input" id="include_key_dates_no" type="radio"
                      name="include_other_key_dates" value="0">
                      <label class="form-check-label" for="include_key_dates_no">No</label>
                    </div>
                    </div>

                    <!-- Key Dates Details -->
                    <div id="key-dates-details" style="display: none;">
                    <div class="mb-3">
                      <label class="form-label">Photography Date:</label>
                      <input class="form-control" name="photography_date" type="date">
                    </div>
                    <div class="mb-3">
                      <label class="form-label">Internet Launch Date:</label>
                      <input class="form-control" name="internet_launch_date" type="date">
                    </div>
                    <div class="mb-3">
                      <label class="form-label">First Open for Inspection Date:</label>
                      <input class="form-control" name="first_open_inspection_date" type="date">
                    </div>
                    </div>
                  </div>

                  <!-- Marketing -->
                  <div class="mb-3">
                    <label class="form-label">Marketing:</label>
                    <select class="form-control" name="marketing_package">
                    <option value="">Please Select</option>
                    <option value="Quote one">Quote one</option>
                    <option value="Quote two">Quote two</option>
                    <option value="Quote three">Quote three</option>
                    <option value="Quote 1 & 2">Quote 1 & 2</option>
                    <option value="Quote 2 & 3">Quote 2 & 3</option>
                    <option value="Q1 + Q2 + Q3">Q1 + Q2 + Q3</option>
                    <option value="Other Schedule">Other Schedule</option>
                    </select>
                  </div>

                  <!-- Commission -->
                  <div class="mb-3">
                    <label class="form-label">Commission</label>
                    <input class="form-control" name="commission_proposal" type="text" placeholder="">
                  </div>

                  <!-- Second Agent -->
                  <div class="mb-3">
                    <label class="form-label">Second Agent:</label>
                    <select class="form-control" name="second_agent">
                    <option value="">Please Select</option>
                    <option value="Oscar">Oscar</option>
                    <option value="Ian">Ian</option>
                    <option value="Ben">Ben</option>
                    <option value="Jee">Jee</option>
                    <option value="Michelle">Michelle</option>
                    <option value="Sean">Sean</option>
                    <option value="Spring">Spring</option>
                    <option value="Other Agent">Other Agent</option>
                    </select>
                  </div>

                  <!-- Comparable Sales -->
                  <div class="mb-3">
                    <label class="form-label">Comparable Sales:</label>
                    <select class="form-control" id="comparable_sales_select" name="comparable_sales">
                    <option value="">Please Select</option>
                    <option value="Include Comparable Sales">Include Comparable Sales</option>
                    <option value="No">No</option>
                    </select>
                  </div>

                  <!-- Comparable Sales Details -->
                  <div id="comparable-sales-details" style="display: none;">
                    <div class="mb-3">
                    <label class="form-label">Insert Comparable Sales:</label>
                    <textarea class="form-control" name="comparable_sales_details" rows="3"></textarea>
                    </div>

                    <div class="mb-3">
                    <label class="form-label">Would you prefer to take photos of comparables?</label>
                    <div class="form-check radio radio-primary">
                      <input class="form-check-input" id="comparable_photos_yes" type="radio"
                      name="take_comparable_photos" value="1">
                      <label class="form-check-label" for="comparable_photos_yes">Yes</label>
                    </div>
                    <div class="form-check radio radio-primary">
                      <input class="form-check-input" id="comparable_photos_no" type="radio"
                      name="take_comparable_photos" value="0">
                      <label class="form-check-label" for="comparable_photos_no">No</label>
                    </div>
                    </div>

                    <!-- Comparable Photos -->
                    <div id="comparable-photos-section" style="display: none;">
                    <div class="take-photo-section">
                      <div class="mb-3">
                      <label class="form-label">Take a Photo 1:</label><br>
                      <input type="file" name="comparable_photos[]" accept="image/*"
                        class="form-control">
                      </div>
                      <div class="mb-3">
                      <label class="form-label">Take a Photo 2:</label><br>
                      <input type="file" name="comparable_photos[]" accept="image/*"
                        class="form-control">
                      </div>
                      <div class="mb-3">
                      <label class="form-label">Take a Photo 3:</label><br>
                      <input type="file" name="comparable_photos[]" accept="image/*"
                        class="form-control">
                      </div>
                      <div class="mb-3">
                      <label class="form-label">Take a Photo 4:</label><br>
                      <input type="file" name="comparable_photos[]" accept="image/*"
                        class="form-control">
                      </div>
                      <div class="mb-3">
                      <label class="form-label">Take a Photo 5:</label><br>
                      <input type="file" name="comparable_photos[]" accept="image/*"
                        class="form-control">
                      </div>
                    </div>

                    <div class="mb-3">
                      <label class="form-label">Take more photos?</label>
                      <div class="form-check radio radio-primary">
                      <input class="form-check-input" id="more_comparable_photos_yes" type="radio"
                        name="take_more_comparable_photos" value="yes">
                      <label class="form-check-label" for="more_comparable_photos_yes">Yes</label>
                      </div>
                      <div class="form-check radio radio-primary">
                      <input class="form-check-input" id="more_comparable_photos_no" type="radio"
                        name="take_more_comparable_photos" value="no">
                      <label class="form-check-label" for="more_comparable_photos_no">No</label>
                      </div>
                    </div>

                    <!-- Extra Comparable Photos -->
                    <div class="take-photo-section" id="extra-comparable-photos" style="display: none;">
                      <div class="mb-3">
                      <label class="form-label">Take a Photo 6:</label><br>
                      <input type="file" name="comparable_photos[]" accept="image/*"
                        class="form-control">
                      </div>
                      <div class="mb-3">
                      <label class="form-label">Take a Photo 7:</label><br>
                      <input type="file" name="comparable_photos[]" accept="image/*"
                        class="form-control">
                      </div>
                      <div class="mb-3">
                      <label class="form-label">Take a Photo 8:</label><br>
                      <input type="file" name="comparable_photos[]" accept="image/*"
                        class="form-control">
                      </div>
                      <div class="mb-3">
                      <label class="form-label">Take a Photo 9:</label><br>
                      <input type="file" name="comparable_photos[]" accept="image/*"
                        class="form-control">
                      </div>
                      <div class="mb-3">
                      <label class="form-label">Take a Photo 10:</label><br>
                      <input type="file" name="comparable_photos[]" accept="image/*"
                        class="form-control">
                      </div>
                    </div>
                    </div>
                  </div>

                  <!-- Personalized Message -->
                  <div class="mb-3">
                    <label class="form-label">Add Personalised Message?</label>
                    <select class="form-control" id="personalized_message_select"
                    name="add_personalized_message">
                    <option value="">Please Select</option>
                    <option value="Add Note">Add Note</option>
                    <option value="No">No</option>
                    </select>
                  </div>

                  <!-- Personalized Message Text -->
                  <div id="personalized-message-text" style="display: none;">
                    <div class="mb-3">
                    <label class="form-label">Insert Personalised Message here</label>
                    <textarea class="form-control" name="personalized_message" rows="3"></textarea>
                    </div>
                  </div>
                  </div>

                </div>
                </div>
              </div>
              <!-- Meeting Summary Section -->
              <div class="accordion-item">
                <h2 class="accordion-header" id="flush-headingFive">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                  data-bs-target="#flush-collapseFive" aria-expanded="false"
                  aria-controls="flush-collapseFive">
                  <i class="fas fa-clipboard-list mr-2"></i> Meeting Review
                </button>
                </h2>
                <div id="flush-collapseFive" class="accordion-collapse collapse"
                aria-labelledby="flush-headingFive" data-bs-parent="#accordionFlushExample">
                <div class="accordion-body">

                  <!-- Commission Discussion -->
                  <div class="mb-3">
                  <label class="form-label">Commission Discussed:</label>
                  <div class="form-check radio radio-primary">
                    <input class="form-check-input" id="commission_yes" type="radio"
                    name="commission_discussed" value="1">
                    <label class="form-check-label" for="commission_yes">Yes</label>
                  </div>
                  <div class="form-check radio radio-primary">
                    <input class="form-check-input" id="commission_no" type="radio"
                    name="commission_discussed" value="0">
                    <label class="form-check-label" for="commission_no">No</label>
                  </div>
                  </div>
                  <!-- Marketing Discussed -->
                  <div class="mb-3">
                  <label class="form-label">Was Marketing Discussed:</label>
                  <div class="form-check checkbox mb-2">
                    <input class="form-check-input" id="marketing_package1" name="marketing_discussed_checkboxes[]"
                    type="checkbox" value="Package 1">
                    <label class="form-check-label" for="marketing_package1">Package 1</label>
                  </div>
                  <div class="form-check checkbox mb-2">
                    <input class="form-check-input" id="marketing_package2" name="marketing_discussed_checkboxes[]"
                    type="checkbox" value="Package 2">
                    <label class="form-check-label" for="marketing_package2">Package 2</label>
                  </div>
                  <div class="form-check checkbox mb-2">
                    <input class="form-check-input" id="marketing_package3" name="marketing_discussed_checkboxes[]"
                    type="checkbox" value="Package 3">
                    <label class="form-check-label" for="marketing_package3">Package 3</label>
                  </div>
                  <div class="form-check checkbox mb-2">
                    <input class="form-check-input" id="marketing_exclusions" name="marketing_discussed_checkboxes[]"
                    type="checkbox" value="Requested Exclusions">
                    <label class="form-check-label" for="marketing_exclusions">Requested
                    Exclusions</label>
                  </div>
                  <div class="form-check checkbox mb-2">
                    <input class="form-check-input" id="marketing_additions" name="marketing_discussed_checkboxes[]"
                    type="checkbox" value="Requested Additions">
                    <label class="form-check-label" for="marketing_additions">Requested Additions</label>
                  </div>
                  <div class="form-check checkbox mb-2">
                    <input class="form-check-input" id="marketing_customized" name="marketing_discussed_checkboxes[]"
                    type="checkbox" value="Customized Plan">
                    <label class="form-check-label" for="marketing_customized">Customized Plan</label>
                  </div>
                  <div class="form-check checkbox mb-2">
                    <input class="form-check-input" id="marketing_not_discussed"
                    name="marketing_discussed_checkboxes[]" type="checkbox" value="Marketing Not Discussed">
                    <label class="form-check-label" for="marketing_not_discussed">Marketing Not
                    Discussed</label>
                  </div>
                  <div class="form-check checkbox mb-2">
                    <input class="form-check-input" id="marketing_other" name="marketing_discussed_checkboxes[]"
                    type="checkbox" value="Other">
                    <label class="form-check-label" for="marketing_other">Other</label>
                  </div>
                  </div>

                  <!-- Commission Details -->
                  <div id="commission-section" style="display: none;">
                  <div class="mb-3">
                    <label class="form-label">What Dollar amount was discussed?</label>
                    <input class="form-control" name="commission_details" type="text" placeholder="">
                  </div>
                  </div>


                  <h4 style="font-size: 1.5rem;">Method of Sale & Key Dates
                  </h4>
                  <!-- Method of Sale -->
                  <div class="mb-3">
                  <label class="form-label">Method of Sale Discussed:</label><br>
                  <select class="form-control" name="sale_method">
                    <option value="">Please Select</option>
                    <option value="Auction">Auction</option>
                    <option value="Expression's Of Interest">Expression's Of Interest</option>
                    <option value="Private Sale">Private Sale</option>
                    <option value="Off Market">Off Market</option>
                    <option value="Off Market To Start - Auction if needed">Off Market To Start - Auction
                    if needed</option>
                    <option value="Forthcoming Auction">Forthcoming Auction</option>
                    <option value="Other">Other</option>
                  </select>
                  </div>

                  <!-- Key Dates Discussion -->
                  <div class="mb-3">
                  <label class="form-label">Were any key dates discussed?</label>
                  <div class="form-check radio radio-primary">
                    <input class="form-check-input" id="key_dates_yes" type="radio"
                    name="key_dates_discussed" value="1">
                    <label class="form-check-label" for="key_dates_yes">Yes</label>
                  </div>
                  <div class="form-check radio radio-primary">
                    <input class="form-check-input" id="key_dates_no" type="radio"
                    name="key_dates_discussed" value="0">
                    <label class="form-check-label" for="key_dates_no">No</label>
                  </div>
                  </div>

                  <!-- Key Dates Section -->
                  <div id="key-dates-section" style="display: none;">
                  <div class="mb-3">
                    <label class="form-label">Auction date:</label>
                    <input class="form-control" name="auction_date" type="date">
                  </div>
                  <div class="mb-3">
                    <label class="form-label">Preferred Launch Week:</label>
                    <input class="form-control" name="preferred_launch" type="date">
                  </div>
                  <div class="mb-3">
                    <label class="form-label">First Open for Inspection:</label>
                    <input class="form-control" name="first_open" type="date">
                  </div>
                  </div>




                  <!-- Other Notes -->
                  <div class="mb-3">
                  <label class="form-label">Other Notes / Reminders:</label>
                  <textarea class="form-control" name="other_notes" rows="3"></textarea>
                  </div>
                </div>
                </div>
              </div>




              <!-- Finalise & Follow Up Section -->
              <div class="accordion-item">
                <h2 class="accordion-header" id="flush-headingEight">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                  data-bs-target="#flush-collapseEight" aria-expanded="false"
                  aria-controls="flush-collapseEight">
                  <i class="fas fa-check-circle mr-2"></i> Submit
                </button>
                </h2>
                <div id="flush-collapseEight" class="accordion-collapse collapse"
                aria-labelledby="flush-headingEight" data-bs-parent="#accordionFlushExample">
                <div class="accordion-body">
                  <h4>Submit Your Appraisal</h4>
                  <p>Finalise the appraisal, connect with your vendor, and send any post-appointment
                  messages or trade requests</p>
                  <div class="card-footer text-end">
                  <button class="btn btn-primary" type="submit" id="submitAppraisal">
                    <i class="fas fa-save mr-1"></i> Save & Close
                  </button>
                  </div>
                </div>
                </div>
              </div>
              </div>
            </div>
            </div>
          </div>
          </form>
        </div>
        </div>
      </div>
      </div>
    </div>
    </div>
  </div>

  <!-- Hidden Templates -->
  <div id="bedroom-template" style="display: none;">
    <div class="bedroom-field mb-3">
    <label>Bedroom __NUM__ Details:</label>
    <select class="js-example-placeholder-multiple form-control" name="bedroom_details[__NUM__][]" multiple
      style="width: 100%;">
      <option value="Walk in robe">Walk in robe</option>
      <option value="No robes">No robes</option>
      <option value="Ensuite">Ensuite</option>
      <option value="Small">Small</option>
      <option value="Medium">Medium</option>
      <option value="Large">Large</option>
      <option value="Split system">Split system</option>
      <option value="Ceiling fan">Ceiling fan</option>
      <option value="Downstairs">Downstairs</option>
      <option value="Upstairs">Upstairs</option>
    </select>
    </div>
  </div>

  <div id="bathroom-template" style="display: none;">
    <div class="bathroom-field mb-3">
    <label>Bathroom __NUM__ Details:</label>
    <select class="js-example-placeholder-multiple form-control" name="bathroom_details[__NUM__][]" multiple
      style="width: 100%;">
      <option value="Ensuite">Ensuite</option>
      <option value="Vanity">Vanity</option>
      <option value="Double Vanity">Double Vanity</option>
      <option value="Shower">Shower</option>
      <option value="Walk-in Shower">Walk-in Shower</option>
      <option value="Double Shower">Double Shower</option>
      <option value="Bath">Bath</option>
      <option value="Toilet">Toilet</option>
      <option value="Stone benchtop">Stone benchtop</option>
      <option value="Laminate benchtop">Laminate benchtop</option>
      <option value="Timber benchtop">Timber benchtop</option>
      <option value="Shower Over Bath">Shower Over Bath</option>
      <option value="Dual Access Bathroom">Dual Access Bathroom</option>
      <option value="Under floor heating">Under floor heating</option>
      <option value="Skylight">Skylight</option>
      <option value="Located Downstairs">Located Downstairs</option>
      <option value="Located Upstairs">Located Upstairs</option>
    </select>
    </div>
  </div>

  <div id="living-template" style="display: none;">
    <div class="living-field mb-3">
    <label>Living Area __NUM__ Details:</label>
    <select class="js-example-placeholder-multiple form-control" name="living_area_details[__NUM__][]" multiple
      style="width: 100%;">
      <option value="L Shaped Lounge / Dining">L Shaped Lounge / Dining</option>
      <option value="Separate Lounge & Dining">Separate Lounge & Dining</option>
      <option value="Separate Lounge">Separate Lounge</option>
      <option value="Open Plan Living / Dining">Open Plan Living / Dining</option>
      <option value="Formal Living Room">Formal Living Room</option>
      <option value="Combined Kitchen/Meals">Combined Kitchen/Meals</option>
      <option value="No Separate Living Area">No Separate Living Area</option>
    </select>
    </div>
  </div>

  <style>
    .bubble-container {
    display: flex;
    gap: 15px;
    flex-wrap: wrap;
    margin: 15px 0;
    padding-bottom: 10px;
}

.bubble-btn {
    width: 60px;
    height: 60px;
    border: 2px solid #e9ecef;
    border-radius: 50%;
    background: white;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 18px;
    font-weight: 600;
    color: #495057;
    cursor: pointer;
    transition: all 0.3s ease;
    position: relative;
}

.bubble-btn:hover {
    border-color: #0a0a0a;
    transform: translateY(-2px);
    box-shadow: 0 4px 8px rgba(0, 123, 255, 0.2);
}

.bubble-btn.active {
    background: #090909;
    border-color: #070707;
    color: white;
}

.bubble-btn.plus-btn {
    font-size: 14px;
    font-weight: 700;
}
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

    .accordion-button {
    font-weight: 500;
    }

    .accordion-button:not(.collapsed) {
    background-color: #f8f9fa;
    color: #007bff;
    }

    .accordion-body {
    padding: 20px;
    }

    .form-check-input[type="radio"] {
    margin-top: 0.2em;
    }

    .form-check-input[type="checkbox"] {
    margin-top: 0.2em;
    }

    .select2-container--default .select2-selection--multiple {
    border: 2px solid #e9ecef;
    border-radius: 8px;
    min-height: 38px;
    }

    .select2-container--default .select2-selection--multiple .select2-selection__choice {
    background-color: #007bff;
    border-color: #007bff;
    color: white;
    }

    .select2-container--default .select2-selection--multiple .select2-selection__choice__remove {
    color: white;
    }
  </style>
<script>
document.getElementById('sms_template').addEventListener('change', function() {
    var content = this.options[this.selectedIndex].getAttribute('data-content') || '';
    document.getElementById('follow_up_sms').value = 'yes'; 
    document.getElementById('sms_message').value = content;
});

$('input[name="contact_who"]').change(function() {
    if ($('#contact_vendor').is(':checked')) {
        $('#privacy-consent-section').slideDown();
        $('#privacy_consent_checkbox').prop('required', true);
    } else {
        $('#privacy-consent-section').slideUp();
        $('#privacy_consent_checkbox').prop('required', false);
    }
});

// Toggle Someone Else fields
$('input[name="main_contact"]').change(function() {
    if ($('#main_contact_someone_else').is(':checked')) {
        $('#someone-else-fields').slideDown();
    } else {
        $('#someone-else-fields').slideUp();
    }
});

function toggleYearBuiltOther() {
    const yearBuiltSelect = document.getElementById('year_built');
    const otherYearBuilt = document.getElementById('other-year-built');
    
    if (yearBuiltSelect.value === 'Other') {
        otherYearBuilt.style.display = 'block';
    } else {
        otherYearBuilt.style.display = 'none';
    }
}

// Toggle Other year built input
$('#year_built').change(function() {
    if ($(this).val() === 'Other') {
        $('#other-year-built').slideDown();
    } else {
        $('#other-year-built').slideUp();
    }
});

function replaceTemplateVariables(content) {
    // Get form data
    const vendor1FirstName = document.getElementById('vendor1_first_name').value || '';
    const vendor1LastName = document.getElementById('vendor1_last_name').value || '';
    const vendor1Mobile = document.getElementById('vendor1_mobile').value || '';
    const vendor1Email = document.getElementById('vendor1_email').value || '';
    const propertyAddress = document.getElementById('vendor1_address').value || '';
    const agentName = '{{ auth()->guard("agent")->user()->name ?? "" }}';
    const agentMobile = '{{ auth()->guard("agent")->user()->phone ?? "" }}';
    
    const selectedTrades = document.querySelectorAll('input[name="trade_persons[]"]:checked');
    let tradeNames = [];
    let tradeTypes = [];
    let tradeList = '';
    
    selectedTrades.forEach(trade => {
        const label = document.querySelector(`label[for="${trade.id}"]`);
        if (label) {
            const text = label.textContent.trim();
            const matches = text.match(/(.*?) \((.*?)\)/);
            if (matches) {
                tradeNames.push(matches[1]);
                tradeTypes.push(matches[2]);
                tradeList += `• ${matches[2]} – ${matches[1]} – [Phone needed]\n`;
            }
        }
    });
    @verbatim

    // Create replacement object
    const replacements = {
        'PropertyAddress': propertyAddress,
        'TradeName': tradeNames.join(', '),
        'TradeType': tradeTypes.join(', '),
        'VendorName': `${vendor1FirstName} ${vendor1LastName}`.trim(),
        'VendorPhone': vendor1Mobile,
        'VendorEmail': vendor1Email,
        'VendorFirstName': vendor1FirstName,
        'AgentName': agentName,
        'AgentMobile': agentMobile,
        'SuggestedTime': ''
    };
    
    let processedContent = content;
    
    // Replace simple variables
    Object.keys(replacements).forEach(key => {
        const regex = new RegExp(`{{${key}}}`, 'g');
        processedContent = processedContent.replace(regex, replacements[key]);
    });
    
    // Handle special case for TradeList loop
    if (processedContent.includes('{{#each TradeList}}')) {
        const tradeListRegex = /{{#each TradeList}}(.*?){{\/each}}/s;
        processedContent = processedContent.replace(tradeListRegex, tradeList);
    }
    
    // Clean up empty lines
    processedContent = processedContent.replace(/{{SuggestedTime}}\s*\n?/g, '');
    
    return processedContent;
}
@endverbatim
// FIXED BUBBLE BUTTON FUNCTIONALITY
$(document).on('click', '.bubble-btn', function() {
    const field = $(this).data('field');
    const value = $(this).data('value');
    // Remove active class from all buttons in this group
    $(this).closest('.bubble-container').find('.bubble-btn').removeClass('active');
    
    // Add active class to clicked button
    $(this).addClass('active');
    
    // Set the hidden input value
    $(`#${field}`).val(value);
    
    // Handle "more" inputs
    if (value === 'more') {
        if (field === 'bedrooms') {
            $('#more-bedrooms-input').slideDown();
        } else if (field === 'bathrooms') {
            $('#more-bathrooms-input').slideDown();
        } else if (field === 'living_areas') {
            $('#more-living-input').slideDown();
        } else if (field === 'car_spaces') {
            $('#more-car-spaces-input').slideDown();
            $('#car-accommodation-type').slideDown();
        }
    } else {
        if (field === 'bedrooms') {
            $('#more-bedrooms-input').slideUp();
        } else if (field === 'bathrooms') { 
            $('#more-bathrooms-input').slideUp();
        } else if (field === 'living_areas') {
            $('#more-living-input').slideUp();
        } else if (field === 'car_spaces') {
            $('#more-car-spaces-input').slideUp();
            $('#car-accommodation-type').slideDown();
        }
    }
});

// FIXED: Car accommodation functionality - REMOVE THIS DUPLICATE CODE
// DELETE this entire section if it exists elsewhere:
// $(document).on('click', '.bubble-btn[data-field="car_spaces_quick"]', function() {

// Kitchen Add Row functionality
document.addEventListener("DOMContentLoaded", function () {
    const container = document.getElementById("kitchen-section-container");
    const addButton = document.getElementById("add-kitchen-row");

    if (addButton && container) {
        addButton.addEventListener("click", function () {
            const firstSection = container.querySelector(".kitchen-sec1");
            if (!firstSection) return;
            
            const newSection = firstSection.cloneNode(true);

            // Clear all selected values in the new section
            newSection.querySelectorAll("select").forEach(select => {
                select.selectedIndex = 0;
            });

            // Update field names with new index
            const rowIndex = container.querySelectorAll(".kitchen-sec1").length;
            newSection.querySelectorAll('[name^="kitchen_"]').forEach(input => {
                const name = input.getAttribute('name');
                const fieldName = name.replace('kitchen_', '');
                input.setAttribute('name', `kitchen_details[${rowIndex}][${fieldName}]`);
            });

            // Add a remove button to the new section
            const removeBtn = document.createElement("button");
            removeBtn.type = "button";
            removeBtn.className = "btn btn-danger btn-sm remove-kitchen-row mt-2";
            removeBtn.innerHTML = '<i class="fas fa-trash mr-1"></i> Remove';

            const buttonContainer = document.createElement("div");
            buttonContainer.className = "text-end";
            buttonContainer.appendChild(removeBtn);

            newSection.appendChild(buttonContainer);
            container.appendChild(newSection);
        });

        container.addEventListener("click", function (e) {
            if (e.target.classList.contains("remove-kitchen-row") ||
                e.target.closest(".remove-kitchen-row")) {
                const section = e.target.closest(".kitchen-sec1");
                if (section && container.querySelectorAll(".kitchen-sec1").length > 1) {
                    section.remove();

                    container.querySelectorAll(".kitchen-sec1").forEach((section, index) => {
                        section.querySelectorAll('[name^="kitchen_details"]').forEach(input => {
                            const name = input.getAttribute('name');
                            const matches = name.match(/kitchen_details\[\d+\]\[(\w+)\]/);
                            if (matches && matches[1]) {
                                input.setAttribute('name', `kitchen_details[${index}][${matches[1]}]`);
                            }
                        });
                    });
                }
            }
        });
    }
});

function increaseValue(id) {
    const input = document.getElementById(id);
    let value = parseInt(input.value) || 0;
    input.value = value + 1;
}

function decreaseValue(id) {
    const input = document.getElementById(id);
    let value = parseInt(input.value) || 0;
    if (value > 0) {
        input.value = value - 1;
    }
}

// Detailed number increment/decrement with template rendering
function increaseValueDetailed(inputId, containerId, templateId) {
    const input = document.getElementById(inputId);
    let count = parseInt(input.value) || 0;
    input.value = count + 1;
    updateFields(count + 1, containerId, templateId);
}

function decreaseValueDetailed(inputId, containerId, templateId) {
    const input = document.getElementById(inputId);
    let count = parseInt(input.value) || 0;
    if (count > 0) {
        input.value = count - 1;
        updateFields(count - 1, containerId, templateId);
    }
}

function updateFields(count, containerId, templateId) {
    const container = document.getElementById(containerId);
    if (!container) return;

    // Destroy existing Select2
    $(`#${containerId} .js-example-placeholder-multiple`).each(function () {
        if ($(this).hasClass('select2-hidden-accessible')) {
            $(this).select2('destroy');
        }
    });

    // Clear container
    container.innerHTML = "";

    // Render new fields
    const template = document.getElementById(templateId).innerHTML;
    for (let i = 1; i <= count; i++) {
        container.insertAdjacentHTML("beforeend", template.replace(/__NUM__/g, i));
    }

    setTimeout(() => {
        $(`#${containerId} .js-example-placeholder-multiple`).select2({
            placeholder: "Select features",
            width: "100%",
            minimumResultsForSearch: Infinity
        });
    }, 0);
}

$(document).ready(function () {
  // When email template is selected
$('#email_template').on('change', function() {
    const selectedOption = $(this).find(':selected');
    const content = selectedOption.data('content');
    const subject = selectedOption.data('subject');
    
    if (content) {
        $('#email-content-preview').val(content);
        $('#email-subject-preview').val(subject);
        $('#follow_up_email').val(content); // ✅ This populates the hidden field
        $('#email-preview-section').show();
    } else {
        $('#email-preview-section').hide();
        $('#follow_up_email').val(''); // Clear the hidden field
    }
});

// When preview button is clicked
$('#previewEmail').on('click', function() {
    const content = $('#email-content-preview').val();
    $('#follow_up_email').val(content); // Update hidden field with current content
    $('#email-preview-section').show();
});

// Update hidden field when content is manually edited
$('#email-content-preview').on('input', function() {
    $('#follow_up_email').val($(this).val());
});
    $('#previewEmail').click(function() {
        const selectedOption = $('#email_template option:selected');
        const content = selectedOption.data('content') || '';
        const subject = selectedOption.data('subject') || '';
        
        if (!content) {
            Swal.fire({
                icon: 'warning',
                title: 'No Template Selected',
                text: 'Please select an email template first.',
            });
            return;
        }
        
        // Process the template content with variables
        const processedContent = replaceTemplateVariables(content);
        const processedSubject = replaceTemplateVariables(subject);
        
        // Show preview section and populate content
        $('#email-preview-section').slideDown();
        $('#email-subject-preview').val(processedSubject);
        $('#email-content-preview').val(processedContent);
    });

    // SMS Template Preview
    $('#previewSms').click(function() {
        const selectedOption = $('#sms_template option:selected');
        const content = selectedOption.data('content') || '';
        
        if (!content) {
            Swal.fire({
                icon: 'warning',
                title: 'No Template Selected',
                text: 'Please select an SMS template first.',
            });
            return;
        }
        
        // Process the template content with variables
        const processedContent = replaceTemplateVariables(content);
        
        // Show preview section and populate content
        $('#sms-preview-section').slideDown();
        $('#sms-content-preview').val(processedContent);
    });

    // Hide preview sections when template selection changes
    $('#email_template').change(function() {
        $('#email-preview-section').slideUp();
    });

    $('#sms_template').change(function() {
        $('#sms-preview-section').slideUp();
    });
    
    // Initialize Select2
    $('.js-example-placeholder-multiple').select2({
        placeholder: "Select features",
        width: "100%",
        minimumResultsForSearch: Infinity
    });

    // Toggle Vendor 2 fields
    $('input[name="has_additional_vendor"]').change(function () {
        if ($('#has_additional_vendor_yes').is(':checked')) {
            $('#vendor2Fields').slideDown();
        } else {
            $('#vendor2Fields').slideUp();
        }
    });

    // Toggle Viewmore section for property type
    $('input[name="property_type_quick"]').change(function () {
        if ($('#property_type_viewmore').is(':checked')) {
            $('#viewmore-section').slideDown();
        } else {
            $('#viewmore-section').slideUp();
        }
    });

    // Toggle Other property type input
    $('input[name="more_property_type"]').change(function () {
        if ($('#property_type_other').is(':checked')) {
            $('#other-property-type-input').slideDown();
        } else {
            $('#other-property-type-input').slideUp();
        }
    });

    // Toggle Outdoor Other input
    $('#outdoor_other').change(function () {
        if ($(this).is(':checked')) {
            $('#outdoor-other-input').slideDown();
        } else {
            $('#outdoor-other-input').slideUp();
        }
    });

    // Toggle Add Notes input
    $('#add_notes').change(function () {
        if ($(this).is(':checked')) {
            $('#agent-notes-input').slideDown();
        } else {
            $('#agent-notes-input').slideUp();
        }
    });

    // Toggle Take Photos input
    $('#take_photos').change(function () {
        if ($(this).is(':checked')) {
            $('#property-photos-input').slideDown();
        } else {
            $('#property-photos-input').slideUp();
        }
    });

    // Toggle More Photos input
    $('input[name="add_more_photos"]').change(function () {
        if ($('#more_photos_yes').is(':checked')) {
            $('#additional-photos').slideDown();
        } else {
            $('#additional-photos').slideUp();
        }
    });

    // Toggle Key Dates section
    $('input[name="key_dates_discussed"]').change(function () {
        if ($('#key_dates_yes').is(':checked')) {
            $('#key-dates-section').slideDown();
        } else {
            $('#key-dates-section').slideUp();
        }
    });

    // Toggle Commission section
    $('input[name="commission_discussed"]').change(function () {
        if ($('#commission_yes').is(':checked')) {
            $('#commission-section').slideDown();
        } else {
            $('#commission-section').slideUp();
        }
    });

    // Toggle Proposal Details
    $('#send_proposal_select').change(function () {
        if ($(this).val() === '1') {
            $('#proposal-details').slideDown();
        } else {
            $('#proposal-details').slideUp();
        }
    });

    // Toggle Price Information
    $('#include_price_select').change(function () {
        if ($(this).val() === '1') {
            $('#price-information').slideDown();
        } else {
            $('#price-information').slideUp();
        }
    });

    // Toggle Proposal Key Dates
    $('#proposal_method_select').change(function () {
        if ($(this).val() !== '') {
            $('#proposal-key-dates').slideDown();
        } else {
            $('#proposal-key-dates').slideUp();
        }
    });

    // Toggle Key Dates Details
    $('input[name="include_other_key_dates"]').change(function () {
        if ($('#include_key_dates_yes').is(':checked')) {
            $('#key-dates-details').slideDown();
        } else {
            $('#key-dates-details').slideUp();
        }
    });

    // Toggle Comparable Sales Details
    $('#comparable_sales_select').change(function () {
        if ($(this).val() === 'Include Comparable Sales') {
            $('#comparable-sales-details').slideDown();
        } else {
            $('#comparable-sales-details').slideUp();
        }
    });

    // Toggle Comparable Photos
    $('input[name="take_comparable_photos"]').change(function () {
        if ($('#comparable_photos_yes').is(':checked')) {
            $('#comparable-photos-section').slideDown();
        } else {
            $('#comparable-photos-section').slideUp();
        }
    });

    // Toggle More Comparable Photos
    $('input[name="take_more_comparable_photos"]').change(function () {
        if ($('#more_comparable_photos_yes').is(':checked')) {
            $('#extra-comparable-photos').slideDown();
        } else {
            $('#extra-comparable-photos').slideUp();
        }
    });

    // Toggle Personalized Message
    $('#personalized_message_select').change(function () {
        if ($(this).val() === 'Add Note') {
            $('#personalized-message-text').slideDown();
        } else {
            $('#personalized-message-text').slideUp();
        }
    });

    // Toggle Take More Photos
    $('input[name="take_more_photos"]').change(function () {
        if ($('#take_more_photos_yes').is(':checked')) {
            $('#extra-photo-section').slideDown();
        } else {
            $('#extra-photo-section').slideUp();
        }
    });

    // Toggle Split System Count
    $('#heating_select').change(function () {
        if ($(this).val() && $(this).val().includes('Split System')) {
            $('#split-system-count').slideDown();
        } else {
            $('#split-system-count').slideUp();
        }
    });
    
    $('#conductAppraisalForm').submit(function (e) {
        if ($('#contact_vendor').is(':checked')) {
            $('#privacy_consent_checkbox').prop('required', true);
        } else {
            $('#privacy_consent_checkbox').prop('required', false);
        }
        
        $('input[required], input[type="checkbox"][required], select[required], textarea[required]').each(function () {
            if ($(this).is(':hidden')) {
                $(this).removeAttr('required');
            }
        });
        
        e.preventDefault();

        const formData = new FormData(this);
        const submitBtn = $('#submitAppraisal');
        const originalBtnText = submitBtn.html();

        submitBtn.prop('disabled', true);
        submitBtn.html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Processing...');

        $.ajax({
            url: "{{ route('agent.appraisals.store') }}",
            type: "POST",
            data: formData,
            processData: false,
            contentType: false,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (response) {
                // Show success message
                Swal.fire({
                    icon: 'success',
                    title: 'Success!',
                    text: 'Appraisal submitted successfully!',
                    showConfirmButton: false,
                    timer: 1500,
                    background: '#fff',
                    customClass: {
                        popup: 'animated fadeInUp'
                    }
                }).then(function () {
                    window.location.href = "{{route('agent.appraisals.index')}}";
                });
            },
            error: function (xhr) {
                // Reset button state
                submitBtn.prop('disabled', false);
                submitBtn.html(originalBtnText);

                let errorMessage = 'An error occurred. Please try again.';
                if (xhr.responseJSON && xhr.responseJSON.message) {
                    errorMessage = xhr.responseJSON.message;
                }

                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: errorMessage,
                    customClass: {
                        popup: 'animated fadeInUp'
                    }
                });
            }
        });
    });
});
</script>
@endsection