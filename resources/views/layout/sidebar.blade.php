<div class="sidebar-wrapper"style="background-color: #1A1A1A">
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
            <li class="sidebar-list"><i class="fa fa-thumb-tack"></i><a class="sidebar-link sidebar-title link-nav" href="{{route('agent.dashboard')}}"><i data-feather="home"></i><span class="lan-3">Dashboard</span></a></li>
            <li class="sidebar-list"><i class="fa fa-thumb-tack"></i><a class="sidebar-link sidebar-title link-nav" href="{{ route('agent.hotleads.index') }}"><i data-feather="activity"></i><span>Hot Leads</span></a></li>
            <li class="sidebar-list"><i class="fa fa-thumb-tack"></i><a class="sidebar-link sidebar-title link-nav" href="{{ route('agent.booking-appraisals.index') }}"><i data-feather="calendar"></i><span>Booking Appraisal</span></a></li>
            <li class="sidebar-list"><i class="fa fa-thumb-tack"></i><a class="sidebar-link sidebar-title link-nav" href="{{route('agent.appraisals.index')}}"><i data-feather="clipboard"></i><span>Conduct Appraisal</span></a></li>
            <li class="sidebar-list"><i class="fa fa-thumb-tack"></i><a class="sidebar-link sidebar-title link-nav" href="{{route('agent.just-listed.index')}}"><i data-feather="tag"></i><span>Just Listed</span></a></li>
<li class="sidebar-list 
    {{ request()->routeIs('agent.templates.*') || request()->routeIs('agent.trade-persons.*') || request()->routeIs('agent.tempforconduct.*') ? 'active' : '' }}">
    
    <a class="sidebar-link sidebar-title link-nav" href="javascript:void(0)">
        <i data-feather="file-text"></i>
        <span>Master List</span>
    </a>

    <ul class="sidebar-submenu"
        style="{{ request()->routeIs('agent.templates.*') || request()->routeIs('agent.trade-persons.*') || request()->routeIs('agent.tempforconduct.*') ? 'display:block;' : '' }}">
        
        <li class="{{ request()->routeIs('agent.templates.*') ? 'active' : '' }}">
            <a href="{{ route('agent.templates.index') }}">Templates (Hotleads)</a>
        </li>
        <li class="{{ request()->routeIs('agent.trade-persons.*') ? 'active' : '' }}">
            <a href="{{ route('agent.trade-persons.index') }}">Trade Persons</a>
        </li>
        <li class="{{ request()->routeIs('agent.tempforconduct.*') ? 'active' : '' }}">
            <a href="{{ route('agent.tempforconduct.index') }}">Temp for Conduct</a>
        </li>
         <li class="{{ request()->routeIs('agent.package.*') ? 'active' : '' }}">
            <a href="{{ route('agent.package.index') }}">Packages</a>
        </li>
    </ul>
</li>

          </ul>
        </div>
        <div class="right-arrow" id="right-arrow"><i data-feather="arrow-right"></i></div>  
      </nav>
    </div>
  </div>