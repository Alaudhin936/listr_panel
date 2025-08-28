<!DOCTYPE html>
<html lang="en" @if (Route::currentRouteName()=='layout_rtl') dir="rtl" @endif>
<meta name="csrf-token" content="{{ csrf_token() }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.0/css/all.min.css" integrity="sha512-DxV+EoADOkOygM4IR9yXP8Sb2qwgidEmeqAEmDKIOfPRQZOWbXCzLC6vjbZyy0vPisbH2SyW27+ddLVCN+OMzQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />


<head>
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    @include('agencylayout.head')
    <!-- comman css-->
    @include('agencylayout.css')
</head>

@switch(Route::currentRouteName())
    @case('dashboard')
        <body onload="startTime()">
        @break

    @case('box_agencylayout')
        <body class="box-layout">
        @break

    @case('agencylayout_rtl')
        <body class="rtl">
        @break

    @case('agencylayout_dark')
        <body class="dark-only">
        @break

    @default
        <body>
@endswitch


    <!-- tap on top starts-->
    <div class="tap-top"><i data-feather="chevrons-up"></i></div>
    <!-- tap on tap ends-->

    <!-- Loader starts-->
    <div class="loader-wrapper">
        <div class="dot"></div>
        <div class="dot"></div>
        <div class="dot"></div>
        <div class="dot"> </div>
        <div class="dot"></div>
    </div>
    <!-- Loader ends-->

    <!-- page-wrapper Start-->
    <div class="page-wrapper compact-wrapper compact-sidebar" id="pageWrapper">

        <!-- Page Header Start-->
        @include('agencylayout.header')
        <!-- Page Header Ends-->

        <!-- Page Body Start-->
        <div class="page-body-wrapper">

            <!-- Page Sidebar Start-->
            @include('agencylayout.sidebar')
            <!-- Page Sidebar Ends-->

            
            <div class="page-body">
                @yield('main_content')
                <!-- Container-fluid Ends-->
            </div>


        </div>
    </div>
    {{-- scripts --}}
    @include('agencylayout.script')
    {{--end scripts --}}

</body>
</html>
