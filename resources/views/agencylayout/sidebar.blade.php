<div class="sidebar-wrapper" style="background-color: #1A1A1A">
    <div>
      <div class="logo-wrapper"><a href="{{ route('dashboard') }}"><img class=" for-light" src="{{ asset('assets/images/listrlogo.png') }}" style="width:100px;margin-bottom:70px;display:flex;align-items:center;margin-left:20px;" alt=""></a>
        <div class="back-btn"><i data-feather="grid"></i></div>
        <div class="toggle-sidebar icon-box-sidebar" style="margin-top:10px;"><i class="status_toggle middle sidebar-toggle" data-feather="grid"> </i></div>
      </div>
      <div class="logo-icon-wrapper"><a href="{{ route('dashboard') }}">
          <div class="icon-box-sidebar"><i data-feather="grid"></i></div></a></div>
      <nav class="sidebar-main">
        <div class="left-arrow" id="left-arrow"><i data-feather="arrow-left"></i></div>
        <div id="sidebar-menu">
          <ul class="sidebar-links" id="simple-bar">
            <li class="back-btn">
              <div class="mobile-back text-end"><span>Back</span><i class="fa fa-angle-right ps-2" aria-hidden="true"></i></div>
            </li>
            <li class="pin-title sidebar-list">
              <h6>Pinned</h6>
            </li>
            <hr>
            <li class="sidebar-list"><i class="fa fa-thumb-tack"></i><a class="sidebar-link sidebar-title link-nav" href="{{route('agency.dashboard')}}"><i data-feather="home"></i><span class="lan-3">Dashboard</span></a></li>
                <li class="sidebar-list"><i class="fa fa-thumb-tack"></i><a class="sidebar-link sidebar-title link-nav {{ request()->routeIs('agency.agents.*') ? 'active' : '' }}" href="{{route('agency.agents.index')}}"><i data-feather="users"></i><span>Manage Agents</span></a></li>
            <li class="sidebar-list"><i class="fa fa-thumb-tack"></i><a class="sidebar-link sidebar-title link-nav" href="{{route('agency.hotleads.index')}}"><i data-feather="trending-up"></i><span>Hot Leads</span></a></li>
            <li class="sidebar-list"><i class="fa fa-thumb-tack"></i><a class="sidebar-link sidebar-title link-nav" href="{{route('agency.booking-appraisals.index')}}"><i data-feather="calendar"></i><span>Booking Appraisal</span></a></li>
            <li class="sidebar-list"><i class="fa fa-thumb-tack"></i><a class="sidebar-link sidebar-title link-nav" href="{{route('agency.conduct-appraisals.index')}}"><i data-feather="clipboard"></i><span>Conduct Appraisal</span></a></li>
            <li class="sidebar-list"><i class="fa fa-thumb-tack"></i><a class="sidebar-link sidebar-title link-nav" href="{{route('agency.just-listed.index')}}"><i data-feather="list"></i><span>Just Listed</span></a></li>
          </ul>
        </div>
        <div class="right-arrow" id="right-arrow"><i data-feather="arrow-right"></i></div>
      </nav>
    </div>
  </div>
<style>
.sidebar-link.active {
    background-color: #2a2a2a;
    border-left: 3px solid #4CAF50;
    color: #fff !important;
}
</style>