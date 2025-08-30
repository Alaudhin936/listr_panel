@extends('layout.master')

@section('main_content')
    <div class="container-fluid">
        <div class="card-header pb-0 p-3 d-flex justify-content-between align-items-center mb-4">
            <div>
                <h3 class="fw-bold text-dark mb-1">
                    <i class="mdi mdi-file-document-multiple me-3 text-primary"></i>Package Management
                </h3>
            </div>
            <div class="d-flex gap-3 p-3">
                <!-- Add Package Button -->
                <button type="button" class="btn btn-success btn-md px-4 shadow-sm" data-bs-toggle="modal"
                    data-bs-target="#addPackageModal">
                    <i class="mdi mdi-plus me-2"></i>Add Package
                </button>

                <!-- Update Services Button -->
                <button type="button" class="btn btn-primary btn-md px-4 shadow-sm" data-bs-toggle="modal"
                    data-bs-target="#updateServicesModal">
                    <i class="mdi mdi-wrench me-2"></i>Update Services
                </button>
            </div>
        </div>

        <div id="alert-container"></div>
    </div>
    <div class="container mt-4">
        
        {{-- <h3 class="mb-4">My Packages</h3> --}}
        <div class="container">
            <div class="row">
                @forelse($packages as $package)
                    <div class="col-md-4 mb-4 package-card" id="package-{{ $package->id }}">
                        <div class="card shadow-sm border-0 text-center p-3 position-relative">

                            {{-- Delete icon (hidden by default, shows on hover) --}}
                            <span class="delete-package position-absolute top-0 end-0 m-2 text-danger"
                                style="cursor:pointer; display:none;" data-id="{{ $package->id }}">
                                <i class="fas fa-trash"></i>
                            </span>

                            <button class="btn package-btn w-100 text-white fw-semibold"
                                style="background-color: {{ $package->color_code }}; border-radius: 12px;"
                                data-package="{{ $package->name }}">
                                {{ $package->name }}
                            </button>
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <div class="alert alert-info text-center">
                            No packages found. Please add a package.
                        </div>
                    </div>
                @endforelse
            </div>
        </div>

        <div class="container mt-4" id="package-services-container">
            @forelse($packages as $package)
                <div class="package-table mb-4" id="package-table-{{ $package->id }}" style="display: none;">
                    <div class="card shadow-sm border-0">
                        <div class="card-header d-flex align-items-center justify-content-between"
                            style="background-color: {{ $package->color_code }}; color: #fff; border-radius: 0.5rem 0.5rem 0 0;">
                            <h5 class="mb-0">{{ strtoupper($package->name) }} PACKAGE</h5>
                        </div>

                        <div class="card-body">
                            @if (isset($services[$package->id]))
                                <div class="table-responsive">
                                    <table class="table align-middle mb-0">
                                        <thead class="bg-light">
                                            <tr>
                                                <th>Service</th>
                                                <th>Supplier</th>
                                                <th>Services Included</th>
                                                <th>Booking Date</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($services[$package->id] as $service)
                                                @php
                                                    $supplier = $suppliers->firstWhere('id', $service->supplier_id);
                                                @endphp
                                                <tr>
                                                    <!-- Service Category -->
                                                    <td class="fw-bold text-uppercase">{{ $service->service_catagory }}</td>

                                                    <!-- Supplier -->
                                                    <td>
                                                        <div class="form-control form-control-sm">
                                                            {{ $supplier->name ?? 'N/A' }}
                                                        </div>
                                                    </td>

                                                    <!-- Services Included -->
                                                    <td>
                                                        @foreach (json_decode($service->services) as $s)
                                                            <span class="badge bg-light text-dark border me-1 mb-1">
                                                                {{ $s }}
                                                                <button type="button" class="btn-close btn-close-sm ms-1"
                                                                    aria-label="Remove"></button>
                                                            </span>
                                                        @endforeach
                                                        <a href="#" class="text-primary small d-block mt-1">+ Add
                                                            Services</a>
                                                    </td>

                                                    <!-- Booking Date -->
                                                    <td>
                                                        <div class="input-group input-group-sm">
                                                            <span class="input-group-text"><i
                                                                    class="bi bi-calendar-event"></i></span>
                                                            <input type="date" class="form-control"
                                                                value="{{ $service->booking_date }}">
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @else
                                <div class="alert alert-info m-3">No services added for this package.</div>
                            @endif
                        </div>
                    </div>
                </div>
            @empty
                <div class="alert alert-warning text-center">No packages found. Please add a package.</div>
            @endforelse
        </div>

        <!-- Add Package Modal -->
        <div class="modal fade custom-modal" id="addPackageModal" tabindex="-1" aria-labelledby="addPackageModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-md modal-dialog-centered">
                <div class="modal-content border-0 shadow-lg rounded-4">
                    <form id="addPackageForm">
                        @csrf
                        <div class="modal-header border-0 bg-light rounded-top-4">
                            <h5 class="modal-title fw-bold text-success" id="addPackageModalLabel">
                                <i class="mdi mdi-package-variant-plus me-2"></i>Add New Package
                            </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body p-4">
                            <div class="mb-3">
                                <label for="package_name" class="form-label fw-semibold">
                                    <i class="mdi mdi-tag me-1 text-success"></i>Package Name
                                    <span class="text-danger">*</span>
                                </label>
                                <input type="text" class="form-control form-control-lg rounded-3" id="package_name"
                                    name="name" placeholder="Enter Package Name" required>
                                <div class="invalid-feedback" id="name-error"></div>
                            </div>
                            <div class="mb-3">
                                <label for="description" class="form-label fw-semibold">
                                    <i class="mdi mdi-tag me-1 text-success"></i>Description (optional)
                                    {{-- <span class="text-danger">*</span> --}}
                                </label>
                                <input type="text" class="form-control form-control-lg rounded-3" id="package_name"
                                    name="description" placeholder="Enter Package Name">
                                <div class="invalid-feedback" id="name-error"></div>
                            </div>
                            <div class="mb-3">
                                <label for="package_color" class="form-label fw-semibold">
                                    <i class="mdi mdi-palette me-1 text-primary"></i>Choose Package Color
                                    <span class="text-danger">*</span>
                                </label>
                                <input type="color" class="form-control form-control-color rounded-3" id="color_code"
                                    name="color_code" value="#4CAF50" required>
                                <div class="invalid-feedback" id="color-error"></div>
                            </div>
                        </div>
                        <div class="modal-footer border-0 bg-light rounded-bottom-4 p-3">
                            <button type="button" class="btn btn-outline-secondary px-4"
                                data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-success px-4 rounded-pill shadow-sm">
                                <i class="mdi mdi-check-circle-outline me-1"></i>Save Package
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>


        <!-- Update Services Modal -->
        <div class="modal fade custom-modal" id="updateServicesModal" tabindex="-1"
            aria-labelledby="updateServicesModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content border-0 shadow-lg rounded-4">
                    <form id="updateServicesForm">
                        @csrf
                        <div class="modal-header border-0 bg-light rounded-top-4">
                            <h5 class="modal-title fw-bold text-primary" id="updateServicesModalLabel">
                                <i class="mdi mdi-wrench me-2"></i>Update Services
                            </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>

                        <div class="modal-body p-4">
                            <div class="mb-3">
                                <label for="package_select" class="form-label fw-bold">
                                    <i class="mdi mdi-package-variant me-1 text-primary"></i>Select Package
                                </label>
                                <select id="package_select" name="package_id" class="form-select form-select-lg"
                                    required>
                                    <option value="">-- Select Package --</option>
                                    @foreach ($packages as $pkg)
                                        <option value="{{ $pkg->id }}">{{ $pkg->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="package_select" class="form-label fw-bold">
                                    <i class="mdi mdi-package-variant me-1 text-primary"></i>Select Supplier
                                </label>
                                <select id="package_select" name="supplier_id" class="form-select form-select-lg"
                                    required>
                                    <option value="">-- Select Supplier --</option>
                                    @foreach ($suppliers as $pkg)
                                        <option value="{{ $pkg->id }}">{{ $pkg->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <!-- Categories & Services -->
                            <div id="categories-container">
                                <div class="category-block bg-light border rounded-3 p-3 mb-3 shadow-sm">
                                    <div class="d-flex justify-content-between align-items-center mb-2">
                                        <h6 class="fw-bold text-primary mb-0"><i
                                                class="mdi mdi-folder-outline me-1"></i>Category</h6>
                                        <button type="button"
                                            class="btn btn-sm btn-outline-danger remove-category d-none">
                                            <i class="mdi mdi-delete"></i>
                                        </button>
                                    </div>

                                    <div class="mb-3">
                                        <input type="text" name="categories[0][name]"
                                            class="form-control form-control-lg rounded-3"
                                            placeholder="Enter Category Name" required>
                                    </div>

                                    <label class="fw-semibold">Services</label>
                                    <div class="services-container">
                                        <div class="d-flex mb-2 service-block">
                                            <input type="text" name="categories[0][services][]"
                                                class="form-control form-control-lg me-2 rounded-3"
                                                placeholder="Enter Service" required>
                                            <button type="button"
                                                class="btn btn-outline-danger remove-service rounded-circle">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <button type="button"
                                        class="btn btn-outline-primary btn-sm add-service mt-2 rounded-pill">
                                        <i class="mdi mdi-plus"></i> Add Service
                                    </button>
                                </div>
                            </div>

                            <!-- Add More Categories -->
                            <button type="button" class="btn btn-outline-success btn-sm mt-3 rounded-pill shadow-sm"
                                id="add-category">
                                <i class="mdi mdi-plus"></i> Add Category
                            </button>
                        </div>

                        <div class="modal-footer border-0 bg-light rounded-bottom-4 p-3">
                            <button type="button" class="btn btn-outline-secondary px-4 rounded-pill"
                                data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary px-4 rounded-pill shadow-sm">
                                <i class="mdi mdi-check me-1"></i>Update Services
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>


        <!-- Custom Styles for Pretty Modal -->
        <style>
            .custom-modal .modal-content {
                background: #fff !important;
                border-radius: 1rem !important;
                box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1) !important;
            }

            .custom-modal .modal-header {
                padding: 1rem 1.5rem;
                border-bottom: none;
            }

            .custom-modal .modal-footer {
                border-top: none;
            }

            .custom-modal .form-control:focus {
                border-color: #4e73df;
                box-shadow: 0 0 0 0.2rem rgba(78, 115, 223, 0.25);
            }

            .modal-backdrop.show {
                background-color: rgba(0, 0, 0, 0.05);
                /* lighter backdrop */
            }


            @keyframes fadeIn {
                from {
                    opacity: 0;
                    transform: translateY(20px);
                }

                to {
                    opacity: 1;
                    transform: translateY(0);
                }
            }


            .btn-proceed {
                background: linear-gradient(135deg, #28a745, #20c997);
                border: none;
                padding: 12px 30px;
                border-radius: 25px;
                color: white;
                font-weight: 600;
                transition: all 0.3s ease;
            }

            .btn-proceed:hover {
                transform: translateY(-2px);
                box-shadow: 0 6px 15px rgba(40, 167, 69, 0.3);
                color: white;
            }
        </style>


        <script>
            $(document).ready(function() {
                let categoryIndex = 0;
                let firstPackageId = $(".package-card").first().attr("id").split("-")[1];
                $("#package-table-" + firstPackageId).show();

                $(".package-btn").click(function() {
                    let packageName = $(this).data("package"); // optional
                    let packageCard = $(this).closest(".package-card");
                    let packageId = packageCard.attr("id").split("-")[1];

                    // Hide all tables
                    $(".package-table").hide();

                    // Toggle the selected table
                    $("#package-table-" + packageId).fadeIn(200);
                });
                // Add category
                $("#add-category").click(function() {
                    categoryIndex++;
                    let categoryHtml = `
            <div class="category-block border rounded p-3 mb-3">
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <h6 class="fw-bold text-primary">Category</h6>
                    <button type="button" class="btn btn-danger btn-sm remove-category">
                        <i class="fas fa-trash"></i>
                    </button>
                </div>
                <div class="mb-3">
                    <input type="text" name="categories[${categoryIndex}][name]" class="form-control form-control-lg category-name" placeholder="Enter Category Name" required>
                </div>
                <label class="fw-bold">Services</label>
                <div class="services-container">
                    <div class="d-flex mb-2 service-block">
                        <input type="text" name="categories[${categoryIndex}][services][]" class="form-control form-control-lg me-2" placeholder="Enter Service" required>
                        <button type="button" class="btn btn-outline-danger remove-service">
                          <i class="fas fa-trash"></i>
                        </button>
                    </div>
                </div>
                <button type="button" class="btn btn-outline-primary btn-sm add-service">
                    <i class="mdi mdi-plus"></i> Add Service
                </button>
            </div>`;
                    $("#categories-container").append(categoryHtml);
                });

                // Remove category
                $(document).on("click", ".remove-category", function() {
                    $(this).closest(".category-block").remove();
                });

                // Add service
                $(document).on("click", ".add-service", function() {
                    let servicesContainer = $(this).siblings(".services-container");
                    let nameAttr = servicesContainer.find('input').first().attr('name');
                    let serviceHtml = `
            <div class="d-flex mb-2 service-block">
                <input type="text" name="${nameAttr}" class="form-control form-control-lg me-2" placeholder="Enter Service" required>
                <button type="button" class="btn btn-outline-danger remove-service">
                 <i class="fas fa-trash"></i>
                </button>
            </div>`;
                    servicesContainer.append(serviceHtml);
                });

                // Remove service
                $(document).on("click", ".remove-service", function() {
                    $(this).closest(".service-block").remove();
                });
                $(".package-card").hover(
                    function() {
                        $(this).find(".delete-package").fadeIn(200);
                    },
                    function() {
                        $(this).find(".delete-package").fadeOut(200);
                    }
                );

                $(document).on("click", ".delete-package", function() {
                    let packageId = $(this).data("id");
                    let url = "{{ route('agent.package.destroy', ['package' => ':id']) }}";
                    url = url.replace(':id', packageId);
                    let card = $("#package-" + packageId);
                    if (confirm("Are you sure you want to delete this package?")) {
                        $.ajax({
                            url: url,
                            type: "POST",
                            data: {
                                _token: "{{ csrf_token() }}"
                            },
                            success: function(response) {
                                if (response.success) {
                                    card.fadeOut(300, function() {
                                        $(this).remove();
                                    });
                                } else {
                                    alert("Failed to delete package. Try again.");
                                }
                            },
                            error: function() {
                                alert("Something went wrong. Please try again.");
                            }
                        });
                    }
                });

                $("#updateServicesForm").submit(function(e) {
                    e.preventDefault();

                    let form = $(this);
                    let formData = form.serializeArray();
                    let structuredData = {
                        package_id: $("#package_select").val(),
                        supplier_id: $("select[name='supplier_id']").val(),
                        categories: []
                    };

                    $("#categories-container .category-block").each(function(index, catBlock) {
                        let categoryName = $(catBlock).find('input[name^="categories"]').first().val();
                        let servicesArr = [];
                        $(catBlock).find('input[name^="categories"][name$="services][]"]').each(
                            function() {
                                servicesArr.push($(this).val());
                            });
                        structuredData.categories.push({
                            name: categoryName,
                            services: servicesArr
                        });
                    });

                    $.ajax({
                        url: "{{ route('agent.package.service.store') }}",
                        type: "POST",
                        data: {
                            _token: "{{ csrf_token() }}",
                            package_id: structuredData.package_id,
                            supplier_id: structuredData.supplier_id,
                            categories: structuredData.categories
                        },
                        success: function(res) {
                            if (res.success) {
                                window.location.reload();
                                form[0].reset();
                                $("#categories-container").html('');
                            } else {
                                alert('Something went wrong!');
                            }
                        },
                        error: function(err) {
                            console.log(err);
                            alert('Error submitting the form. Check console for details.');
                        }
                    });
                });
                $("#addPackageForm").on("submit", function(e) {
                    e.preventDefault();

                    $.ajax({
                        url: "{{ route('agent.package.store') }}", // <-- your backend route
                        type: "POST",
                        data: $(this).serialize(), // serialize form fields
                        success: function(response) {
                            window.location.reload();
                        },
                        error: function(xhr, status, error) {
                            $("#responseMsg").html("<p style='color:red'>Error: " + error + "</p>");
                        }
                    });

                });
            })
        </script>
    @endsection
