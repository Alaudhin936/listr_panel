@extends('layout.master')

@section('main_content')
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-sm-6">
                    <h3>Invoice</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"> <i data-feather="home"></i></a></li>
                        <li class="breadcrumb-item">ECommerce</li>
                        <li class="breadcrumb-item active">Invoice </li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- Container-fluid starts-->
    <div class="container invoice">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <div>
                            <div>
                                <div class="row invo-header">
                                    <div class="col-sm-6">
                                        <div class="d-flex">
                                            <div class="flex-shrink-0"><a href="{{ route('dashboard') }}"><img
                                                        class="d-flex-object img-60"
                                                        src="{{ asset('assets/images/favicon/favicon.png') }}"
                                                        alt=""></a></div>
                                            <div class="flex-grow-1 m-l-20">
                                                <h4 class="d-flex-heading f-w-600">Tivo</h4>
                                                <p class="mb-0">hello@Tivo.in<br><span class="digits">289-335-6503</span>
                                                </p>
                                            </div>
                                        </div>
                                        <!-- End Info-->
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="text-md-end text-xs-center">
                                            <h3>Invoice #<span class="digits counter">1069</span></h3>
                                            <p class="mb-0">Issued: May<span class="digits"> 27, 2023</span><br>Payment
                                                Due: June <span class="digits">27, 2023</span></p>
                                        </div>
                                        <!-- End Title -->
                                    </div>
                                </div>
                            </div>
                            <!-- End InvoiceTop-->
                            <div class="row invo-profile">
                                <div class="col-xl-4">
                                    <div class="invo-profile-left">
                                        <div class="d-flex">
                                            <div class="flex-shrink-0"><img class="d-flex-object rounded-circle img-60"
                                                    src="{{ asset('assets/images/user/1.jpg') }}" alt=""></div>
                                            <div class="flex-grow-1">
                                                <h4 class="d-flex-heading f-w-600">Johan Deo</h4>
                                                <p class="mb-0">JohanDeo@gmail.com <span
                                                        class="digits">852-963-7532</span></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-8">
                                    <div class="invo-profile-right">
                                        <div id="project">
                                            <h6>Project Description</h6>
                                            <p class="mb-0">You're Only As Good As Your Last Collection, Which Is An Enormous Pressure. Jeans Represent Democracy In Fashion.Fashion Is About Dressing According To What's Fashionable.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- End Invoice Mid-->
                            <div>
                                <div class="table-responsive theme-scrollbar invoice-table" id="table">
                                    <table class="table table-bordered table-striped">
                                        <tbody>
                                            <tr>
                                                <td class="item">
                                                    <h6 class="py-2 mb-0">Item Description</h6>
                                                </td>
                                                <td class="Hours">
                                                    <h6 class="py-2 mb-0">Hours</h6>
                                                </td>
                                                <td class="Rate">
                                                    <h6 class="py-2 mb-0">Rate</h6>
                                                </td>
                                                <td class="subtotal">
                                                    <h6 class="py-2 mb-0">Sub-total</h6>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <label>Brown Dress</label>
                                                    <p class="m-0">Aask - Brown Polyester Blend Women's Fit & Flare Dress.</p>
                                                </td>
                                                <td>
                                                    <p class="itemtext digits mb-0">5</p>
                                                </td>
                                                <td>
                                                    <p class="itemtext digits mb-0">$75</p>
                                                </td>
                                                <td>
                                                    <p class="itemtext digits mb-0">$375.00</p>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <label>Red Shirt</label>
                                                    <p class="m-0">Wild West - Red Cotton Blend Regular Fit Men's Formal Shirt.</p>
                                                </td>
                                                <td>
                                                    <p class="itemtext digits mb-0">3</p>
                                                </td>
                                                <td>
                                                    <p class="itemtext digits mb-0">$75</p>
                                                </td>
                                                <td>
                                                    <p class="itemtext digits mb-0">$225.00</p>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <label>Flower Dress</label>
                                                    <p class="m-0">Skyblue Flower Printed Sleevless Strappy Dress.</p>
                                                </td>
                                                <td>
                                                    <p class="itemtext digits mb-0">10</p>
                                                </td>
                                                <td>
                                                    <p class="itemtext digits mb-0">$75</p>
                                                </td>
                                                <td>
                                                    <p class="itemtext digits mb-0">$750.00</p>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <label>Red Skirt</label>
                                                    <p class="m-0">R L F - Red Cotton Blend Women's A-Line Skirt.</p>
                                                </td>
                                                <td>
                                                    <p class="itemtext digits mb-0">10</p>
                                                </td>
                                                <td>
                                                    <p class="itemtext digits mb-0">$75</p>
                                                </td>
                                                <td>
                                                    <p class="itemtext digits mb-0">$750.00</p>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <p class="itemtext"></p>
                                                </td>
                                                <td>
                                                    <p class="m-0">HST</p>
                                                </td>
                                                <td>
                                                    <p class="m-0 digits">13%</p>
                                                </td>
                                                <td>
                                                    <p class="m-0 digits">$419.25</p>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td></td>
                                                <td></td>
                                                <td class="Rate">
                                                    <h6 class="mb-0 py-2">Total</h6>
                                                </td>
                                                <td class="payment digits">
                                                    <h6 class="mb-0 py-2">$3,644.25</h6>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <!-- End Table-->
                                <div class="row mt-3">
                                    <div class="col-md-8">
                                        <div>
                                            <p class="legal mb-0"><strong>Thank you for your business!</strong>Payment is
                                                expected within 31 days; please process this invoice within that time. There
                                                will be a 5% interest charge per month on late invoices.</p>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <form class="text-end invo-pal">
                                            <input type="image" src="{{ asset('assets/images/other-images/paypal.png') }}"
                                                name="submit" alt="PayPal - The safer, easier way to pay online!">
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <!-- End InvoiceBot-->
                        </div>
                        <div class="col-sm-12 text-center mt-3">
                            <button class="btn btn btn-primary me-2" type="button" onclick="myFunction()">Print</button>
                            <button class="btn btn-secondary" type="button">Cancel</button>
                        </div>
                        <!-- End Invoice-->
                        <!-- End Invoice Holder-->
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('assets/js/counter/jquery.waypoints.min.js') }}"></script>
    <script src="{{ asset('assets/js/counter/jquery.counterup.min.js') }}"></script>
    <script src="{{ asset('assets/js/counter/counter-custom.js') }}"></script>
    <script src="{{ asset('assets/js/print.js') }}"></script>
@endsection
