@extends('layout.master')

@section('main_content')
<div class="container-fluid">
    <div class="page-title">
      <div class="row">
        <div class="col-sm-6">
          <h3>Avatars</h3>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i data-feather="home"></i></a></li>
            <li class="breadcrumb-item">Ui Kits</li>
            <li class="breadcrumb-item active">Avatars</li>
          </ol>
        </div>
      </div>
    </div>
  </div>
  <!-- Container-fluid starts-->
  <div class="container-fluid">
    <div class="user-profile">
      <div class="row">
        <div class="col-sm-12 col-xl-6 box-col-6">
          <div class="card">
            <div class="card-header pb-0">
              <h4>Basic & Sizing Avatar</h4><span>Use <code>.bg-light-*</code>for different color avatar.</span>
            </div>
            <div class="card-body">
              <div class="avatar-showcase">
                <div class="avatars">
                  <div class="avatar bg-light-primary p-2 rounded-pill"><img class="img-100 rounded-circle" src="../assets/images/user/1.jpg" alt="#"></div>
                  <div class="avatar bg-light-secondary p-2 rounded-pill"><img class="img-90 rounded-circle" src="../assets/images/user/1.jpg" alt="#"></div>
                  <div class="avatar bg-light-success p-2 rounded-pill"><img class="img-80 rounded-circle" src="../assets/images/user/1.jpg" alt="#"></div>
                  <div class="avatar bg-light-danger p-2 rounded-pill"><img class="img-70 rounded-circle" src="../assets/images/user/1.jpg" alt="#"></div>
                  <div class="avatar bg-light-info p-2 rounded-pill"><img class="img-60 rounded-circle" src="../assets/images/user/1.jpg" alt="#"></div>
                  <div class="avatar bg-light-warning p-2 rounded-pill"><img class="img-50 rounded-circle" src="../assets/images/user/1.jpg" alt="#"></div>
                  <div class="avatar bg-light-dark p-2 rounded-pill"><img class="img-40 rounded-circle" src="../assets/images/user/1.jpg" alt="#"></div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-sm-12 col-xl-6 box-col-6">
          <div class="card">
            <div class="card-header pb-0">
              <h4>Status Indicator</h4><span>Use <code>.bg-*</code>for different color status Indicator.</span>
            </div>
            <div class="card-body"> 
              <div class="avatar-showcase">
                <div class="avatars">
                  <div class="avatar"><img class="img-100 rounded-circle" src="../assets/images/user/3.jpg" alt="#">
                    <div class="status bg-primary"></div>
                  </div>
                  <div class="avatar"><img class="img-90 rounded-circle" src="../assets/images/user/3.jpg" alt="#">
                    <div class="status bg-secondary"></div>
                  </div>
                  <div class="avatar"><img class="img-80 rounded-circle" src="../assets/images/user/3.jpg" alt="#">
                    <div class="status bg-success"></div>
                  </div>
                  <div class="avatar"><img class="img-70 rounded-circle" src="../assets/images/user/3.jpg" alt="#">
                    <div class="status bg-info"></div>
                  </div>
                  <div class="avatar"><img class="img-60 rounded-circle" src="../assets/images/user/3.jpg" alt="#">
                    <div class="status bg-danger"></div>
                  </div>
                  <div class="avatar"><img class="img-50 rounded-circle" src="../assets/images/user/3.jpg" alt="#">
                    <div class="status bg-dark"></div>
                  </div>
                  <div class="avatar"><img class="img-40 rounded-circle" src="../assets/images/user/3.jpg" alt="#">
                    <div class="status bg-warning"></div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-sm-12 col-xl-6 box-col-6">
          <div class="card">
            <div class="card-header pb-0">
              <h4>Initials</h4>
            </div>
            <div class="card-body"> 
              <div class="avatar-showcase">
                <div class="avatars">
                  <div class="avatar"><img class="img-100 rounded-circle" src="../assets/images/user/11.png" alt="#"></div>
                  <div class="avatar"><img class="img-90 rounded-circle" src="../assets/images/user/12.png" alt="#"></div>
                  <div class="avatar"><img class="img-80 rounded-circle" src="../assets/images/user/14.png" alt="#"></div>
                  <div class="avatar"><img class="img-70 rounded-circle" src="../assets/images/user/2.png" alt="#"></div>
                  <div class="avatar"><img class="img-60 rounded-circle" src="../assets/images/user/3.png" alt="#"></div>
                  <div class="avatar"><img class="img-50 rounded-circle" src="../assets/images/user/12.png" alt="#"></div>
                  <div class="avatar"><img class="img-40 rounded-circle" src="../assets/images/user/10.jpg" alt="#"></div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-sm-12 col-xl-6 box-col-6">
          <div class="card">
            <div class="card-header">
              <h4>Groups</h4>
            </div>
            <div class="card-body"> 
              <div class="avatar-showcase">
                <div class="customers d-inline-block avatar-group">
                  <ul>
                    <li class="d-inline-block"><img class="img-70 rounded-circle" src="../assets/images/user/11.png" alt=""></li>
                    <li class="d-inline-block"><img class="img-70 rounded-circle" src="../assets/images/user/12.png" alt=""></li>
                    <li class="d-inline-block"><img class="img-70 rounded-circle" src="../assets/images/user/14.png" alt=""></li>
                  </ul>
                </div>
                <div class="customers d-inline-block avatar-group">
                  <ul>
                    <li class="d-inline-block"><img class="img-50 rounded-circle" src="../assets/images/dashboard/default/05.png" alt=""></li>
                    <li class="d-inline-block"><img class="img-50 rounded-circle" src="../assets/images/dashboard/default/02.png" alt=""></li>
                    <li class="d-inline-block"><img class="img-50 rounded-circle" src="../assets/images/dashboard/default/03.png" alt=""></li>
                  </ul>
                </div>
                <div class="customers d-inline-block avatar-group">
                  <ul>
                    <li class="d-inline-block"><img class="img-40 rounded-circle" src="../assets/images/user/3.jpg" alt=""></li>
                    <li class="d-inline-block"><img class="img-40 rounded-circle" src="../assets/images/user/5.jpg" alt=""></li>
                    <li class="d-inline-block"><img class="img-40 rounded-circle" src="../assets/images/user/1.jpg" alt=""></li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-sm-12 col-xl-6 box-col-6">
          <div class="card">
            <div class="card-header pb-0">
              <h4>Shape</h4>
            </div>
            <div class="card-body"> 
              <div class="avatar-showcase">
                <div class="avatars">
                  <div class="avatar"><img class="img-100 b-r-8" src="../assets/images/user/6.jpg" alt="#"></div>
                  <div class="avatar"><img class="img-90 b-r-30" src="../assets/images/user/6.jpg" alt="#"></div>
                  <div class="avatar"><img class="img-80 b-r-35" src="../assets/images/user/6.jpg" alt="#"></div>
                  <div class="avatar"><img class="img-70 rounded-circle" src="../assets/images/user/6.jpg" alt="#"></div>
                  <div class="avatar"><img class="img-60 b-r-25" src="../assets/images/user/6.jpg" alt="#"></div>
                  <div class="avatar"><img class="img-50 b-r-15" src="../assets/images/user/6.jpg" alt="#"></div>
                  <div class="avatar"><img class="img-40 b-r-10" src="../assets/images/user/6.jpg" alt="#"></div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-sm-12 col-xl-6 box-col-6">
          <div class="card">
            <div class="card-header pb-0">
              <h4>Ratio</h4>
            </div>
            <div class="card-body"> 
              <div class="avatar-showcase">
                <div class="avatars">
                  <div class="avatar ratio"><img class="b-r-8 img-100" src="../assets/images/user/7.jpg" alt="#"></div>
                  <div class="avatar ratio"><img class="b-r-8 img-90" src="../assets/images/user/7.jpg" alt="#"></div>
                  <div class="avatar ratio"><img class="b-r-8 img-80" src="../assets/images/user/7.jpg" alt="#"></div>
                  <div class="avatar ratio"><img class="b-r-8 img-70" src="../assets/images/user/7.jpg" alt="#"></div>
                  <div class="avatar ratio"><img class="b-r-8 img-60" src="../assets/images/user/7.jpg" alt="#"></div>
                  <div class="avatar ratio"><img class="b-r-8 img-50" src="../assets/images/user/7.jpg" alt="#"></div>
                  <div class="avatar ratio"><img class="b-r-8 img-40" src="../assets/images/user/7.jpg" alt="#"></div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection