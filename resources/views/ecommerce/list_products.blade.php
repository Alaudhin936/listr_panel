@extends('layout.master')

@section('css')
    <link rel="stylesheet" type="text/css" href="{{ asset ('assets/css/vendors/datatables.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset ('assets/css/vendors/owlcarousel.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset ('assets/css/vendors/rating.css') }}">
@endsection

@section('main_content')
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-sm-6">
                    <h3>Product list</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"> <i data-feather="home"></i></a></li>
                        <li class="breadcrumb-item">ECommerce</li>
                        <li class="breadcrumb-item active">Product list</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- Container-fluid starts-->  
    <div class="container-fluid list-products">
        <div class="row">
            <!-- Individual column searching (text inputs) Starts-->
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header pb-0">
                        <h4>Individual column searching (text inputs) </h4><span>The searching functionality provided by
                            DataTables is useful for quickly search through the information in the table - however the
                            search is global, and you may wish to present controls that search on specific columns.</span>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive theme-scrollbar theme-scrollbar product-table">
                            <table class="display" id="basic-1">
                                <thead>
                                    <tr>
                                        <th>Image</th>
                                        <th>Details</th>
                                        <th>Amount</th>
                                        <th>Stock</th>
                                        <th>Start date</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><a href="{{ route('product_page') }}"><img
                                                    src="{{ asset ('assets/images/ecommerce/product-table-1.png') }}" alt=""></a>
                                        </td>
                                        <td><a href="{{ route('product_page') }}">
                                            <h6>Black Shirt</h6></a><span>Vida Loca - Gray Checks Fit Men's Casual Shirt.</span></td>
                                        </td>
                                        <td>$25</td>
                                        <td class="font-success">In Stock</td>
                                        <td>2023/04/15</td>
                                        <td>
                                            <button class="btn btn-danger btn-xs" type="button"
                                                data-original-title="btn btn-danger btn-xs" title="">Delete</button>
                                            <button class="btn btn-primary btn-xs" type="button"
                                                data-original-title="btn btn-danger btn-xs" title="">Edit</button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><a href="{{ route('product_page') }}"><img
                                                    src="{{ asset ('assets/images/ecommerce/product-table-2.png') }}" alt=""></a>
                                        </td>
                                        <td><a href="{{ route('product_page') }}">
                                            <h6>Yellow T-shirt</h6></a><span>Wild West - Yellow Cotton Blend Regular Fit Men's Formal T-Shirt.</span></td>
                                        </td>
                                        <td>$25</td>
                                        <td class="font-primary">Low Stock</td>
                                        <td>2023/05/10</td>
                                        <td>
                                            <button class="btn btn-danger btn-xs" type="button"
                                                data-original-title="btn btn-danger btn-xs" title="">Delete</button>
                                            <button class="btn btn-primary btn-xs" type="button"
                                                data-original-title="btn btn-danger btn-xs" title="">Edit</button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><a href="{{ route('product_page') }}"><img
                                                    src="{{ asset ('assets/images/ecommerce/product-table-3.png') }}" alt=""></a>
                                        </td>
                                        <td><a href="{{ route('product_page') }}">
                                            <h6>Blackish Top</h6></a><span>aask - Black Polyester Blend Women's Fit & Flare T-shirt.</span></td>
                                        </td>
                                        <td>$20</td>
                                        <td class="font-danger">out of stock</td>
                                        <td>2023/04/23</td>
                                        <td>
                                            <button class="btn btn-danger btn-xs" type="button"
                                                data-original-title="btn btn-danger btn-xs" title="">Delete</button>
                                            <button class="btn btn-primary btn-xs" type="button"
                                                data-original-title="btn btn-danger btn-xs" title="">Edit</button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><a href="{{ route('product_page') }}"><img
                                                    src="{{ asset ('assets/images/ecommerce/product-table-4.png') }}" alt=""></a>
                                        </td>
                                        <td><a href="{{ route('product_page') }}">
                                            <h6> Brown Casual Shirt</h6></a><span>R L F - Brown Cotton Blend Men's A-Line Shirt.</span></td>
                                        </td>
                                        <td>$15</td>
                                        <td class="font-primary">Low Stock</td>
                                        <td>2023/05/08</td>
                                        <td>
                                            <button class="btn btn-danger btn-xs" type="button"
                                                data-original-title="btn btn-danger btn-xs" title="">Delete</button>
                                            <button class="btn btn-primary btn-xs" type="button"
                                                data-original-title="btn btn-danger btn-xs" title="">Edit</button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><a href="{{ route('product_page') }}"><img
                                                    src="{{ asset ('assets/images/ecommerce/product-table-5.png') }}" alt=""></a>
                                        </td>
                                        <td><a href="{{ route('product_page') }}">
                                            <h6> Black & white Dress</h6></a><span>Women's Black & White Collection Dress.</span></td>
                                        </td>
                                        <td>$25</td>
                                        <td class="font-success">In Stock</td>
                                        <td>2023/05/10</td>
                                        <td>
                                            <button class="btn btn-danger btn-xs" type="button"
                                                data-original-title="btn btn-danger btn-xs" title="">Delete</button>
                                            <button class="btn btn-primary btn-xs" type="button"
                                                data-original-title="btn btn-danger btn-xs" title="">Edit</button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><a href="{{ route('product_page') }}"><img
                                                    src="{{ asset ('assets/images/ecommerce/product-table-6.png') }}" alt=""></a>
                                        </td>
                                        <td><a href="{{ route('product_page') }}">
                                            <h6> Red Blazer For Winter</h6></a><span>Womens's Red Winter Season Collection Blazer.</span></td>
                                        </td>
                                        <td>$20</td>
                                        <td class="font-primary">Low Stock</td>
                                        <td>2023/04/23</td>
                                        <td>
                                            <button class="btn btn-danger btn-xs" type="button"
                                                data-original-title="btn btn-danger btn-xs" title="">Delete</button>
                                            <button class="btn btn-primary btn-xs" type="button"
                                                data-original-title="btn btn-danger btn-xs" title="">Edit</button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><a href="{{ route('product_page') }}"><img
                                                    src="{{ asset ('assets/images/ecommerce/product-table-1.png') }}"
                                                    alt=""></a></td>
                                        <td><a href="{{ route('product_page') }}">
                                            <h6>Black Shirt</h6></a><span>Vida Loca - Gray Checks Fit Men's Casual Shirt.</span></td>
                                        </td>
                                        <td>$20</td>
                                        <td class="font-danger">out of stock</td>
                                        <td>2023/05/08</td>
                                        <td>
                                            <button class="btn btn-danger btn-xs" type="button"
                                                data-original-title="btn btn-danger btn-xs" title="">Delete</button>
                                            <button class="btn btn-primary btn-xs" type="button"
                                                data-original-title="btn btn-danger btn-xs" title="">Edit</button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><a href="{{ route('product_page') }}"><img
                                                    src="{{ asset ('assets/images/ecommerce/product-table-2.png') }}"
                                                    alt=""></a></td>
                                        <td><a href="{{ route('product_page') }}">
                                            <h6>Yellow T-shirt</h6></a><span>Wild West - Yellow Cotton Blend Regular Fit Men's Formal T-Shirt.</span></td>
                                        </td>
                                        <td>$15</td>
                                        <td class="font-danger">out of stock</td>
                                        <td>2023/05/10</td>
                                        <td>
                                            <button class="btn btn-danger btn-xs" type="button"
                                                data-original-title="btn btn-danger btn-xs" title="">Delete</button>
                                            <button class="btn btn-primary btn-xs" type="button"
                                                data-original-title="btn btn-danger btn-xs" title="">Edit</button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><a href="{{ route('product_page') }}"><img
                                                    src="{{ asset ('assets/images/ecommerce/product-table-3.png') }}"
                                                    alt=""></a></td>
                                        <td><a href="{{ route('product_page') }}">
                                            <h6>Blackish Top</h6></a><span>aask - Black Polyester Blend Women's Fit & Flare T-shirt.</span></td>
                                        </td>
                                        <td>$15</td>
                                        <td class="font-success">In Stock</td>
                                        <td>2023/04/15</td>
                                        <td>
                                            <button class="btn btn-danger btn-xs" type="button"
                                                data-original-title="btn btn-danger btn-xs" title="">Delete</button>
                                            <button class="btn btn-primary btn-xs" type="button"
                                                data-original-title="btn btn-danger btn-xs" title="">Edit</button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><a href="{{ route('product_page') }}"><img
                                                    src="{{ asset ('assets/images/ecommerce/product-table-4.png') }}"
                                                    alt=""></a></td>
                                        <td><a href="{{ route('product_page') }}">
                                            <h6> Brown Casual Shirt</h6></a><span>R L F - Brown Cotton Blend Men's A-Line Shirt.</span></td>
                                        </td>
                                        <td>$20</td>
                                        <td class="font-danger">out of stock</td>
                                        <td>2023/04/15</td>
                                        <td>
                                            <button class="btn btn-danger btn-xs" type="button"
                                                data-original-title="btn btn-danger btn-xs" title="">Delete</button>
                                            <button class="btn btn-primary btn-xs" type="button"
                                                data-original-title="btn btn-danger btn-xs" title="">Edit</button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Individual column searching (text inputs) Ends-->
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset ('assets/js/datatable/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset ('assets/js/rating/jquery.barrating.js') }}"></script>
    <script src="{{ asset ('assets/js/rating/rating-script.js') }}"></script>
    <script src="{{ asset ('assets/js/owlcarousel/owl.carousel.js') }}"></script>
    <script src="{{ asset ('assets/js/ecommerce.js') }}"></script>
    <script src="{{ asset ('assets/js/product-list-custom.js') }}"></script>
@endsection
