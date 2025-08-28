@extends('layout.master')

@section('main_content')

<div class="container-fluid">
    <div class="page-title">
      <div class="row">
        <div class="col-sm-6">
          <h3>Dropdown</h3>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i data-feather="home"></i></a></li>
            <li class="breadcrumb-item">Ui Kits</li>
            <li class="breadcrumb-item active">Dropdown</li>
          </ol>
        </div>
      </div>
    </div>
  </div>
  <!-- Container-fluid starts-->
  <div class="container-fluid dropdown-page">
    <div class="row">
      <div class="col-sm-12 col-xl-12">
        <div class="card basic-dropdown">
          <div class="card-header pb-0">
            <h4>Dropdown with link</h4>
          </div>
          <div class="card-body"> 
            <ul class="d-flex flex-wrap">
              <li class="onhover-dropdown"><span class="f-w-600">Dashboard</span><span><i class="middle ms-2" data-feather="chevron-down"></i></span>
                <ul class="onhover-show-div left-dropdown">
                  <li> <a href="{{ route('dashboard') }}" target="_blank">Default</a></li>
                  <li> <a href="dashboard-02.html" target="_blank">Ecommerce</a></li>
                </ul>
              </li>
              <li class="onhover-dropdown"><span class="f-w-600">Job Search</span><span><i class="middle ms-2" data-feather="chevron-down"></i></span>
                <ul class="onhover-show-div left-dropdown">
                  <li> <a href="job-cards-view.html" target="_blank">Card view</a></li>
                  <li> <a href="job-apply.html" target="_blank">Job apply</a></li>
                </ul>
              </li>
              <li class="onhover-dropdown"><span class="f-w-600">Ecommerce</span><span><i class="middle ms-2" data-feather="chevron-down"></i></span>
                <ul class="onhover-show-div left-dropdown">
                  <li> <a href="product.html" target="_blank">Product</a></li>
                  <li> <a href="add-products.html" target="_blank">Add Product</a></li>
                  <li> <a href="invoice-template.html" target="_blank">Invoice</a></li>
                </ul>
              </li>
            </ul>
          </div>
        </div>
      </div>
      <div class="col-sm-12 col-xl-12">
        <div class="card">
          <div class="card-header pb-0">
            <h4>Basic Dropdown with Color</h4>
          </div>
          <div class="card-body"> 
            <div class="dropdown-basic">
              <div class="dropdown">
                <div class="btn-group mb-0">
                  <button class="dropbtn btn-pill btn-primary" type="button">Action <span><i class="icofont icofont-arrow-down"></i></span></button>
                  <div class="dropdown-content"><a href="#">Action</a><a href="#">Another Action</a><a href="#">Something Else Here</a><a href="#">Separated Link </a></div>
                </div>
              </div>
              <div class="dropdown">
                <div class="btn-group mb-0">
                  <button class="dropbtn btn-pill btn-secondary" type="button">Action <span><i class="icofont icofont-arrow-down"></i></span></button>
                  <div class="dropdown-content"><a href="#">Action</a><a href="#">Another Action</a><a href="#">Something Else Here</a><a href="#">Separated Link </a></div>
                </div>
              </div>
              <div class="dropdown">
                <div class="btn-group mb-0">
                  <button class="dropbtn btn-pill btn-success" type="button">Action <span><i class="icofont icofont-arrow-down"></i></span></button>
                  <div class="dropdown-content"><a href="#">Action</a><a href="#">Another Action</a><a href="#">Something Else Here</a><a href="#">Separated Link </a></div>
                </div>
              </div>
              <div class="dropdown">
                <div class="btn-group mb-0">
                  <button class="dropbtn btn-pill btn-info" type="button">Action <span><i class="icofont icofont-arrow-down"></i></span></button>
                  <div class="dropdown-content"><a href="#">Action</a><a href="#">Another Action</a><a href="#">Something Else Here</a><a href="#">Separated Link </a></div>
                </div>
              </div>
              <div class="dropdown">
                <div class="btn-group mb-0">
                  <button class="dropbtn btn-pill btn-warning" type="button">Action <span><i class="icofont icofont-arrow-down"></i></span></button>
                  <div class="dropdown-content"><a href="#">Action</a><a href="#">Another Action</a><a href="#">Something Else Here</a><a href="#">Separated Link </a></div>
                </div>
              </div>
              <div class="dropdown">
                <div class="btn-group mb-0">
                  <button class="dropbtn btn-pill btn-danger" type="button">Action <span><i class="icofont icofont-arrow-down"></i></span></button>
                  <div class="dropdown-content"><a href="#">Action</a><a href="#">Another Action</a><a href="#">Something Else Here</a><a href="#">Separated Link </a></div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-sm-12 col-xl-12">
        <div class="card">
          <div class="card-header pb-0">
            <h4>Dropdown Split Button</h4>
          </div>
          <div class="card-body"> 
            <div class="dropdown-basic">
              <div class="btn-group">
                <button class="btn btn-light" type="button">Primary Button</button>
                <div class="dropdown separated-btn">
                  <button class="btn btn-primary" type="button"><i class="icofont icofont-arrow-down"></i></button>
                  <div class="dropdown-content"><a href="#">Link 1</a><a href="#">Link 2</a><a href="#">Link 3</a></div>
                </div>
              </div>
              <div class="btn-group">
                <button class="btn btn-light" type="button">Secondary Button</button>
                <div class="dropdown separated-btn">
                  <button class="btn btn-secondary" type="button"><i class="icofont icofont-arrow-down"></i></button>
                  <div class="dropdown-content"><a href="#">Link 1</a><a href="#">Link 2</a><a href="#">Link 3</a></div>
                </div>
              </div>
              <div class="btn-group">
                <button class="btn btn-light" type="button">Success Button</button>
                <div class="dropdown separated-btn">
                  <button class="btn btn-success" type="button"><i class="icofont icofont-arrow-down"></i></button>
                  <div class="dropdown-content"><a href="#">Link 1</a><a href="#">Link 2</a><a href="#">Link 3</a></div>
                </div>
              </div>
              <div class="btn-group">
                <button class="btn btn-light" type="button">Info Button</button>
                <div class="dropdown separated-btn">
                  <button class="btn btn-info" type="button"><i class="icofont icofont-arrow-down"></i></button>
                  <div class="dropdown-content"><a href="#">Link 1</a><a href="#">Link 2</a><a href="#">Link 3</a></div>
                </div>
              </div>
              <div class="btn-group">
                <button class="btn btn-light" type="button">Warning Button</button>
                <div class="dropdown separated-btn">
                  <button class="btn btn-warning" type="button"><i class="icofont icofont-arrow-down"></i></button>
                  <div class="dropdown-content"><a href="#">Link 1</a><a href="#">Link 2</a><a href="#">Link 3</a></div>
                </div>
              </div>
              <div class="btn-group">
                <button class="btn btn-light" type="button">Danger Button</button>
                <div class="dropdown separated-btn">
                  <button class="btn btn-danger" type="button"><i class="icofont icofont-arrow-down"></i></button>
                  <div class="dropdown-content"><a href="#">Link 1</a><a href="#">Link 2</a><a href="#">Link 3</a></div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-sm-12 col-xl-12">
        <div class="card">
          <div class="card-header pb-0">
            <h4>Rounded Dropdown</h4>
          </div>
          <div class="card-body"> 
            <div class="dropdown-basic">
              <div class="dropdown">
                <div class="btn-group mb-0">
                  <button class="dropbtn btn-primary btn-round" type="button">Primary Button <span><i class="icofont icofont-arrow-down"></i></span></button>
                  <div class="dropdown-content"><a href="#">Action</a><a href="#">Another Action</a><a href="#">Something Else Here</a><a href="#">Separated Link </a></div>
                </div>
              </div>
              <div class="dropdown">
                <div class="btn-group mb-0">
                  <button class="dropbtn btn-secondary btn-round" type="button">Secondary Button <span><i class="icofont icofont-arrow-down"></i></span></button>
                  <div class="dropdown-content"><a href="#">Action</a><a href="#">Another Action</a><a href="#">Something Else Here</a><a href="#">Separated Link </a></div>
                </div>
              </div>
              <div class="dropdown">
                <div class="btn-group mb-0">
                  <button class="dropbtn btn-success btn-round" type="button">Success Button <span><i class="icofont icofont-arrow-down"></i></span></button>
                  <div class="dropdown-content"><a href="#">Action</a><a href="#">Another Action</a><a href="#">Something Else Here</a><a href="#">Separated Link </a></div>
                </div>
              </div>
              <div class="dropdown">
                <div class="btn-group mb-0">
                  <button class="dropbtn btn-info btn-round" type="button">Info Button <span><i class="icofont icofont-arrow-down"></i></span></button>
                  <div class="dropdown-content"><a href="#">Action</a><a href="#">Another Action</a><a href="#">Something Else Here</a><a href="#">Separated Link </a></div>
                </div>
              </div>
              <div class="dropdown">
                <div class="btn-group mb-0">
                  <button class="dropbtn btn-warning btn-round" type="button">Warning Button <span><i class="icofont icofont-arrow-down"></i></span></button>
                  <div class="dropdown-content"><a href="#">Action</a><a href="#">Another Action</a><a href="#">Something Else Here</a><a href="#">Separated Link </a></div>
                </div>
              </div>
              <div class="dropdown">
                <div class="btn-group mb-0">
                  <button class="dropbtn btn-danger btn-round" type="button">Danger Button <span><i class="icofont icofont-arrow-down"></i></span></button>
                  <div class="dropdown-content"><a href="#">Action</a><a href="#">Another Action</a><a href="#">Something Else Here</a><a href="#">Separated Link </a></div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-sm-12 col-xl-6">
        <div class="card">
          <div class="card-header pb-0">
            <h4>Dropdown With Divider</h4><span>Use a class </span>
          </div>
          <div class="card-body"> 
            <div class="dropdown-basic">
              <div class="dropdown">
                <button class="dropbtn btn-pill btn-primary" type="button">Dropdown Button <span><i class="icofont icofont-arrow-down"></i></span></button>
                <div class="dropdown-content"><a href="#">Link 1</a><a href="#">Link 2</a><a href="#">Link 3</a><a href="#">Another Link</a></div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-sm-12 col-xl-6">
        <div class="card">
          <div class="card-header pb-0">
            <h4>Dropdown With Header</h4><span>Use a class <code>.dropdown-header</code></span>
          </div>
          <div class="card-body"> 
            <div class="dropdown-basic">
              <div class="dropdown">
                <button class="dropbtn btn-pill btn-primary" type="button">Dropdown Button <span><i class="icofont icofont-arrow-down"></i></span></button>
                <div class="dropdown-content">
                  <h5 class="dropdown-header">Dropdown header</h5><a href="#">Link 1</a><a href="#">Link 2</a>
                  <h5 class="dropdown-header">Dropdown header</h5><a href="#">Another Link</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-sm-12 col-xl-4">
        <div class="card">
          <div class="card-header pb-0">
            <h4>Dropdown With Disable</h4><span>Use a class <code>.dropdown-disabled</code></span>
          </div>
          <div class="card-body"> 
            <div class="dropup-basic dropdown-basic">
              <div class="dropup dropdown">
                <button class="dropbtn btn-pill btn-dark" type="button">Dropdown Button <span><i class="icofont icofont-arrow-up"></i></span></button>
                <div class="dropup-content dropdown-content"><a href="#">Normal</a><a class="active" href="#">Active</a><a class="disabled" href="#">Disabled</a></div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-sm-12 col-xl-8">
        <div class="card">
          <div class="card-header pb-0">
            <h4>Dropdown With Direction</h4><span>Use a class <code>.drop-up</code></span>
          </div>
          <div class="card-body"> 
            <div class="dropup-basic dropdown-basic">
              <div class="dropup dropdown me-3">
                <button class="dropbtn btn-pill btn-secondary" type="button">Drop up <span><i class="icofont icofont-arrow-up"></i></span></button>
                <div class="dropup-content dropdown-content"><a href="#">Bookmark</a><a href="#">Contact</a></div>
              </div>
              <div class="dropend dropdown me-3">
                <button class="dropbtn btn-pill btn-danger" type="button" data-bs-toggle="dropdown">Drop End <span><i class="icofont icofont-arrow-right"></i></span></button>
                <div class="dropend-content dropdown-content"><a href="#">Task</a><a href="#">Calendar</a></div>
              </div>
              <div class="dropdown dropdown me-3">
                <button class="dropbtn btn-pill btn-info" type="button">Drop down <span><i class="icofont icofont-arrow-down"></i></span></button>
                <div class="dropdown-content"><a href="#">To-do</a><a href="#">Editor</a></div>
              </div>
              <div class="dropstart dropdown me-3">
                <button class="dropbtn btn-pill btn-success" type="button">Drop Start <span><i class="icofont icofont-arrow-left"></i></span></button>
                <div class="dropstart-content dropdown-content"><a href="#">Map</a><a href="#">Chart</a></div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
@section('scripts')
<script src="{{ asset('assets/js/tooltip-init.js') }}"></script>
@endsection
