@extends('layout.master')

@section('css')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/dropzone.css') }}">
@endsection

@section('main_content')
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-sm-6">
                    <h3>Add Product</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i data-feather="home"></i></a></li>
                        <li class="breadcrumb-item">Ecommerce</li>
                        <li class="breadcrumb-item active">Add Product</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- Container-fluid starts-->
    <div class="container-fluid add-product">
        <div class="row">
            <div class="col-xl-6">
                <div class="card">
                    <div class="card-body">
                        <div class="product-info">
                            <h5>Description</h5>
                            <form>
                                <div class="product-group">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="mb-3">
                                                <label class="form-label">Product Name</label>
                                                <input class="form-control" placeholder="Enter Product Name"
                                                    type="text"><span class="text-danger"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="mb-3">
                                                <label class="form-label">Product Description</label>
                                                <input class="form-control" placeholder="Enter Product Description"
                                                    type="text"><span class="text-danger"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <h5 class="mt-4">Categories</h5>
                            <form>
                                <div class="product-group">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="mb-3">
                                                <label class="form-label">Product Category</label>
                                                <select class="form-select">
                                                    <option>Select..</option>
                                                    <option>Man's Shirt</option>
                                                    <option>Man's Jeans</option>
                                                    <option>Women T-shirt</option>
                                                    <option>Women Skirt</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="mb-3">
                                                <label class="form-label">Brand Icons</label>
                                                <select class="form-select">
                                                    <option>Select..</option>
                                                    <option>Levi's</option>
                                                    <option>Hudson</option>
                                                    <option>Denizen</option>
                                                    <option>Spykar</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="mb-3">
                                                <label class="form-label">Color</label>
                                                <select class="form-select">
                                                    <option>Select..</option>
                                                    <option>Black</option>
                                                    <option>Red</option>
                                                    <option>Blue</option>
                                                    <option>White</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="mb-3">
                                                <label class="form-label">Quality</label>
                                                <select class="form-select">
                                                    <option>Brand New</option>
                                                    <option>Second Hand</option>
                                                    <option>Both Quality</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-6">
                <div class="card">
                    <div class="card-body">
                        <div class="product-info">
                            <h5>Product Image</h5>
                            <form class="dropzone" id="singleFileUpload" action="/upload.php">
                                <div class="dz-message needsclick"><i class="icon-cloud-up"></i>
                                    <h6>Drop files here or click to upload.</h6><span class="note needsclick"></span>(This
                                    is just a demo dropzone. Selected files are <strong>not</strong> actually uploaded.)
                                </div>
                            </form>
                            <h5 class="mt-4">Select Size</h5>
                            <form>
                                <div class="product-group">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="mb-3">
                                                <label class="form-label">Size</label>
                                                <select class="form-select">
                                                    <option>S </option>
                                                    <option>M </option>
                                                    <option>L </option>
                                                    <option>XL </option>
                                                    <option>XXL</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="mb-3">
                                                <label class="form-label">Date</label>
                                                <input class="form-control" type="date">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="mb-3">
                                                <label class="form-label">Price</label>
                                                <input class="form-control" type="number">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="mt-4">
                            <div class="row">
                                <div class="col-sm-12 text-end"><a class="btn btn-primary me-3" href="product.html">ADD
                                    </a><a class="btn btn-secondary">Cancel</a></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Container-fluid Ends-->
@endsection

@section('scripts')
<script src="{{ asset('assets/js/dropzone/dropzone.js') }}"></script>
<script src="{{ asset('assets/js/dropzone/dropzone-script.js') }}"></script>
<script src="{{ asset('assets/js/tooltip-init.js') }}"></script>
@endsection
