@extends('layout.master')

@section('css')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/datatables.css') }}">
@endsection

@section('main_content')
<div class="container-fluid">
    <div class="page-title">
      <div class="row">
        <div class="col-sm-6">
          <h3>Recent Orders</h3>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i data-feather="home"></i></a></li>
            <li class="breadcrumb-item">Ecommerce</li>
            <li class="breadcrumb-item active"> Recent Orders</li>
          </ol>
        </div>
      </div>
    </div>
  </div>
  <!-- Container-fluid starts-->
  <div class="container-fluid">
    <div class="row">
      <div class="col-sm-12">
        <div class="card">
          <div class="card-header pb-0">
            <h4>Order history</h4>
          </div>
          <div class="card-body">
            <div class="order-history table-responsive theme-scrollbar">
              <table class="table table-bordernone display" id="basic-1">
                <thead>
                  <tr>
                    <th scope="col">Prdouct</th>
                    <th scope="col">Prdouct name</th>
                    <th scope="col">Size</th>
                    <th scope="col">Color</th>
                    <th scope="col">Article number</th>
                    <th scope="col">Units</th>
                    <th scope="col">Price</th>
                    <th scope="col"><i class="fa fa-angle-down"></i></th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td><a href="{{ route('product_page') }}"><img class="img-fluid img-30" src="{{ asset('assets/images/product/1.png') }}" alt="#"></a></td>
                    <td>
                      <div class="product-name"><a href="{{ route('product_page') }}">Long Top</a>
                        <div class="order-process"><span class="order-process-circle"></span>Processing</div>
                      </div>
                    </td>
                    <td>M</td>
                    <td>Lavander</td>
                    <td>4215738</td>
                    <td>1</td>
                    <td>$21</td>
                    <td><i data-feather="more-vertical"></i></td>
                  </tr>
                  <tr>
                    <td><a href="{{ route('product_page') }}"><img class="img-fluid img-30" src="{{ asset('assets/images/product/13.png') }}" alt="#"></a></td>
                    <td>
                      <div class="product-name"><a href="{{ route('product_page') }}">Fancy watch</a>
                        <div class="order-process"><span class="order-process-circle"></span>Processing</div>
                      </div>
                    </td>
                    <td>Free size</td>
                    <td>Blue</td>
                    <td>5476182</td>
                    <td>1</td>
                    <td>$10</td>
                    <td><i data-feather="more-vertical"></i></td>
                  </tr>
                  <tr>
                    <td><img class="img-fluid img-30" src="{{ asset('assets/images/product/4.png') }}" alt="#"></td>
                    <td>
                      <div class="product-name"><a href="{{ route('product_page') }}">Man shoes</a>
                        <div class="order-process"><span class="order-process-circle"></span>Processing</div>
                      </div>
                    </td>
                    <td>8</td>
                    <td>Black & white</td>
                    <td>1756457</td>
                    <td>2</td>
                    <td>$18</td>
                    <td><i data-feather="more-vertical"></i></td>
                  </tr>
                  <tr>
                    <td><a href="{{ route('product_page') }}"><img class="img-fluid img-30" src="{{ asset('assets/images/product/10.png') }}" alt="#"></a></td>
                    <td>
                      <div class="product-name"><a href="{{ route('product_page') }}">Ladies side bag</a>
                        <div class="order-process"><span class="order-process-circle shipped-order"></span>Shipped</div>
                      </div>
                    </td>
                    <td>Medium</td>
                    <td>Brown</td>
                    <td>7451725</td>
                    <td>1</td>
                    <td>$13</td>
                    <td><i data-feather="more-vertical"></i></td>
                  </tr>
                  <tr>
                    <td><a href="{{ route('product_page') }}"><img class="img-fluid img-30" src="{{ asset('assets/images/product/12.png') }}" alt="#"></a></td>
                    <td>
                      <div class="product-name"><a href="{{ route('product_page') }}">Ladies Hills</a>
                        <div class="order-process"><span class="order-process-circle shipped-order"></span>Shipped</div>
                      </div>
                    </td>
                    <td>6</td>
                    <td>Brown & white</td>
                    <td>4127421</td>
                    <td>2</td>
                    <td>$6</td>
                    <td><i data-feather="more-vertical"></i></td>
                  </tr>
                  <tr>
                    <td><a href="{{ route('product_page') }}"><img class="img-fluid img-30" src="{{ asset('assets/images/product/3.png') }}" alt="#"></a></td>
                    <td>
                      <div class="product-name"><a href="{{ route('product_page') }}">Fancy Ladies Jacket</a>
                        <div class="order-process"><span class="order-process-circle shipped-order"></span>Shipped</div>
                      </div>
                    </td>
                    <td>Xl</td>
                    <td>Light gray</td>
                    <td>3581714</td>
                    <td>1</td>
                    <td>$24</td>
                    <td><i data-feather="more-vertical"></i></td>
                  </tr>
                  <tr>
                    <td><a href="{{ route('product_page') }}"><img class="img-fluid img-30" src="{{ asset('assets/images/product/2.png') }}" alt="#"></a></td>
                    <td>
                      <div class="product-name"><a href="{{ route('product_page') }}">Ladies Handbag</a>
                        <div class="order-process"><span class="order-process-circle shipped-order"></span>Shipped</div>
                      </div>
                    </td>
                    <td>Small</td>
                    <td>Black</td>
                    <td>6748142</td>
                    <td>2</td>
                    <td>$14</td>
                    <td><i data-feather="more-vertical"></i></td>
                  </tr>
                  <tr>
                    <td><a href="{{ route('product_page') }}"><img class="img-fluid img-30" src="{{ asset('assets/images/product/15.png') }}" alt="#"></a></td>
                    <td>
                      <div class="product-name"><a href="{{ route('product_page') }}">I phone 13 mobile</a>
                        <div class="order-process"><span class="order-process-circle cancel-order"></span>Cancelled</div>
                      </div>
                    </td>
                    <td>Medium</td>
                    <td>Black</td>
                    <td>5748214</td>
                    <td>1</td>
                    <td>$25</td>
                    <td><i data-feather="more-vertical"></i></td>
                  </tr>
                  <tr>
                    <td><a href="{{ route('product_page') }}"><img class="img-fluid img-30" src="{{ asset('assets/images/product/14.png') }}" alt="#"></a></td>
                    <td>
                      <div class="product-name"><a href="{{ route('product_page') }}">Watch</a>
                        <div class="order-process"><span class="order-process-circle cancel-order"></span>Cancelled</div>
                      </div>
                    </td>
                    <td>Free size</td>
                    <td>Brown</td>
                    <td>2471254</td>
                    <td>1</td>
                    <td>$12</td>
                    <td><i data-feather="more-vertical"></i></td>
                  </tr>
                  <tr>
                    <td><a href="{{ route('product_page') }}"><img class="img-fluid img-30" src="{{ asset('assets/images/product/11.png') }}" alt="#"></a></td>
                    <td>
                      <div class="product-name"><a href="{{ route('product_page') }}">Slipper</a>
                        <div class="order-process"><span class="order-process-circle cancel-order"></span>Cancelled</div>
                      </div>
                    </td>
                    <td>6</td>
                    <td>Blue</td>
                    <td>8475112</td>
                    <td>2</td>
                    <td>$6</td>
                    <td><i data-feather="more-vertical"></i></td>
                  </tr>
                  <tr>
                    <td><a href="{{ route('product_page') }}"><img class="img-fluid img-30" src="{{ asset('assets/images/product/2.png') }}" alt="#"></a></td>
                    <td>
                      <div class="product-name"><a href="{{ route('product_page') }}">Ladies Handbag</a>
                        <div class="order-process"><span class="order-process-circle shipped-order"></span>Shipped</div>
                      </div>
                    </td>
                    <td>Small</td>
                    <td>Black</td>
                    <td>6748142</td>
                    <td>2</td>
                    <td>$14</td>
                    <td><i data-feather="more-vertical"></i></td>
                  </tr>
                  <tr>
                    <td><a href="{{ route('product_page') }}"><img class="img-fluid img-30" src="{{ asset('assets/images/product/15.png') }}" alt="#"></a></td>
                    <td>
                      <div class="product-name"><a href="{{ route('product_page') }}">I phone 13 mobile</a>
                        <div class="order-process"><span class="order-process-circle cancel-order"></span>Cancelled</div>
                      </div>
                    </td>
                    <td>10cm x 15cm</td>
                    <td>Black</td>
                    <td>5748214</td>
                    <td>1</td>
                    <td>$25</td>
                    <td><i data-feather="more-vertical"></i></td>
                  </tr>
                  <tr>
                    <td><a href="{{ route('product_page') }}"><img class="img-fluid img-30" src="{{ asset('assets/images/product/14.png') }}" alt="#"></a></td>
                    <td>
                      <div class="product-name"><a href="{{ route('product_page') }}">Watch</a>
                        <div class="order-process"><span class="order-process-circle cancel-order"></span>Cancelled</div>
                      </div>
                    </td>
                    <td>27mm</td>
                    <td>Brown</td>
                    <td>2471254</td>
                    <td>2</td>
                    <td>$12</td>
                    <td><i data-feather="more-vertical"></i></td>
                  </tr>
                  <tr>
                    <td><a href="{{ route('product_page') }}"><img class="img-fluid img-30" src="{{ asset('assets/images/product/11.png') }}" alt="#"></a></td>
                    <td>
                      <div class="product-name"><a href="{{ route('product_page') }}">Slipper</a>
                        <div class="order-process"><span class="order-process-circle cancel-order"></span>Cancelled</div>
                      </div>
                    </td>
                    <td>6</td>
                    <td>Blue</td>
                    <td>8475112</td>
                    <td>2</td>
                    <td>$6</td>
                    <td><i data-feather="more-vertical"></i></td>
                  </tr>
                  <tr>
                    <td><a href="{{ route('product_page') }}"><img class="img-fluid img-30" src="{{ asset('assets/images/product/1.png') }}" alt="#"></a></td>
                    <td>
                      <div class="product-name"><a href="{{ route('product_page') }}">Long Top</a>
                        <div class="order-process"><span class="order-process-circle"></span>Processing</div>
                      </div>
                    </td>
                    <td>M</td>
                    <td>Lavander</td>
                    <td>4215738</td>
                    <td>1</td>
                    <td>$21</td>
                    <td><i data-feather="more-vertical"></i></td>
                  </tr>
                  <tr>
                    <td><a href="{{ route('product_page') }}"><img class="img-fluid img-30" src="{{ asset('assets/images/product/13.png') }}" alt="#"></a></td>
                    <td>
                      <div class="product-name"><a href="{{ route('product_page') }}">Fancy watch</a>
                        <div class="order-process"><span class="order-process-circle"></span>Processing</div>
                      </div>
                    </td>
                    <td>Free size</td>
                    <td>Blue</td>
                    <td>5476182</td>
                    <td>1</td>
                    <td>$10</td>
                    <td><i data-feather="more-vertical"></i></td>
                  </tr>
                  <tr>
                    <td><img class="img-fluid img-30" src="{{ asset('assets/images/product/4.png') }}" alt="#"></td>
                    <td>
                      <div class="product-name"><a href="{{ route('product_page') }}">Man shoes</a>
                        <div class="order-process"><span class="order-process-circle"></span>Processing</div>
                      </div>
                    </td>
                    <td>8</td>
                    <td>Black & white</td>
                    <td>1756457</td>
                    <td>1</td>
                    <td>$18</td>
                    <td><i data-feather="more-vertical"></i></td>
                  </tr>
                  <tr>
                    <td><a href="{{ route('product_page') }}"><img class="img-fluid img-30" src="{{ asset('assets/images/product/10.png') }}" alt="#"></a></td>
                    <td>
                      <div class="product-name"><a href="{{ route('product_page') }}">Ladies side bag</a>
                        <div class="order-process"><span class="order-process-circle shipped-order"></span>Shipped</div>
                      </div>
                    </td>
                    <td>Medium</td>
                    <td>Brown</td>
                    <td>7451725</td>
                    <td>2</td>
                    <td>$13</td>
                    <td><i data-feather="more-vertical"></i></td>
                  </tr>
                  <tr>
                    <td><a href="{{ route('product_page') }}"><img class="img-fluid img-30" src="{{ asset('assets/images/product/12.png') }}" alt="#"></a></td>
                    <td>
                      <div class="product-name"><a href="{{ route('product_page') }}">Ladies Hills</a>
                        <div class="order-process"><span class="order-process-circle shipped-order"></span>Shipped</div>
                      </div>
                    </td>
                    <td>6</td>
                    <td>Brown & white</td>
                    <td>4127421</td>
                    <td>2</td>
                    <td>$6</td>
                    <td><i data-feather="more-vertical"></i></td>
                  </tr>
                  <tr>
                    <td><a href="{{ route('product_page') }}"><img class="img-fluid img-30" src="{{ asset('assets/images/product/3.png') }}" alt="#"></a></td>
                    <td>
                      <div class="product-name"><a href="{{ route('product_page') }}">Fancy Ladies Jacket</a>
                        <div class="order-process"><span class="order-process-circle shipped-order"></span>Shipped</div>
                      </div>
                    </td>
                    <td>Xl</td>
                    <td>Light gray</td>
                    <td>3581714</td>
                    <td>2</td>
                    <td>$24</td>
                    <td><i data-feather="more-vertical"></i></td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection

@section('scripts')
<script src="{{ asset('assets/js/datatable/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/js/datatable/datatables/datatable.custom.js') }}"></script> 
@endsection