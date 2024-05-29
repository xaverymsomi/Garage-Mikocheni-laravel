<!DOCTYPE html>
@php
use Illuminate\Support\Str;
@endphp
<html dir="" lang="en">
<style>
  /* CSS */
  .select2-container--invalid .select2-selection {
    border-color: red;
  }

  /* active dropdown */

  .dropdown {
    position: relative;
    display: inline-block;
    color: white;
    /* padding: 15px; */
    font-size: 14px;
    border: none;
    padding-top: 12px;
    padding-bottom: 12px;
    padding-left: 14px;
    /* padding-right: 16px; */

  }

  .li {
    background-color: #DC3733;
    color: white;
    /* padding: 15px; */
    font-size: 14px;
    border: none;
    padding-top: 12px;
    padding-bottom: 12px;
    padding-left: 14px;
    padding-right: 16px;
    cursor: pointer;
  }

  .dropdown-content {
    display: none;
    position: absolute;
    background-color: #FFEFE6;
    min-width: 160px;
    box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
    z-index: 1;
    inset: 0px 240px auto;
    height: auto;
    width: 222px;
    padding-left: 8px;

  }

  .dropdown-content a {
    color: #5B5D6E;
    padding: 12px 16px;
    text-decoration: none;
    display: block;
    margin-top: 3px;
  }

  .dropdown-content a:hover {
    background-color: #FFEFE6;
    color: #DC3733;
  }

  .dropdown:hover .dropdown-content {
    display: block;
  }

  .nav.side-menu>li.active,
  .nav.side-menu>li.current-page {
    /* border-right: 5px solid #1abb9c; */
    background-color: #FFFFFF;
  }

  .dropdown a {
    color: #454545;
  }

  .dropdown>a:hover {
    color: #454545;
  }

  .dropdown {
    color: #454545;
  }

  .nav.side-menu>li.active>.dropdown>a {
    -webkit-text-fill-color: #454545;
  }

  li.active:hover {
    color: #454545;
  }

  .nav.side-menu>li.active,
  .nav.side-menu>li.current-page>a {
    color: #454545;
    --bs-nav-link-hover-color: #454545;
  }

  span.titleup:hover {
    color: #333333;
  }

  .nav.toggle:hover {
    color: #595F69;
  }

  li>.dropdown>a {
    color: #FFFFFF;
  }

  li>.dropdown {
    color: #595F69;
  }

  .dropdown:hover {
    background-color: #FFFFFF;
    color: #454545;
    width: 240px;
  }

  .dropdown:hover>a {
    color: #454545;
  }

  /* --------- side dropdown menu in mobile screen ------------ */
  /* i.fa-solid.fa-sliders {
    margin-right: 15px;
  }

  i.fa-regular.fa-user {
    margin-right: 9px;
  }

  i.fa-solid.fa-car-side {
    margin-right: 10px;
  }

  i.fa-solid.fa-wrench {
    margin-right: 13px;
  }

  i.fa-solid.fa-receipt {
    margin-right: 17px;
  }

  i.fa-solid.fa-credit-card {
    margin-right: 12px;
  }

  i.fa-solid.fa-calculator {
    margin-right: 16px;
  }

  i.fa-solid.fa-tag {
    margin-right: 10px;
  }

  i.fa-solid.fa-clipboard-check {
    margin-right: 12px;
  }

  i.fa-solid.fa-envelope-open-text {
    margin-right: 12px;
  }

  i.fa-solid.fa-puzzle-piece {
    margin-right: 12px;
  }

  i.fa-solid.fa-code-branch {
    margin-right: 13px;
  }

  i.fa-solid.fa-file-lines {
    margin-right: 13px;
  }

  i.fa-solid.fa-gear {
    margin-right: 11px;
  } */

  .margin-right-10px {
    margin-right: 10px;
  } 

  img.logout_img {
    margin-right: 5px;
  }

  @media (min-width: 280px) and (max-width: 540px) {

    .nav-sm .nav.child_menu li.active,
    .nav-sm .nav.side-menu li.active-sm {
      border-right: transparent;
    }

    /* .nav-sm .nav.side-menu li a i {
    font-size: 25px !important;
    text-align: center;
    width: 100% !important;
    margin-bottom: 5px;
} */
    .dropdown:hover {
      background-color: #FFFFFF;
      color: #454545;
      width: 72px;
    }

    i.fa-solid.fa-sliders {
      margin-left: -13px;
    }

    .dropdown-content {
      display: none;
      position: absolute;
      background-color: #FFEFE6;
      min-width: 160px;
      box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
      z-index: 1;
      inset: 0px 324px auto;
      height: auto;
      width: 160px;
      padding-left: 1px;
      margin-left: -254px;
    }

    .nav-sm .nav.side-menu li a {
      text-align: left !important;
      font-weight: 400;
      font-size: 10px;
      padding: 10px 5px;
    }

    i.fa-regular.fa-user {
      margin-left: -14px;
    }

    i.fa-solid.fa-car-side {
      margin-left: -11px;
    }

    i.fa-solid.fa-credit-card {
      margin-left: -10px;
    }

    i.fa-solid.fa-calculator {
      margin-left: -12px;
    }

    i.fa-solid.fa-clipboard-check {
      margin-left: -4px;
    }
  }

  @media (min-width: 768px) and (max-width: 912px) {
    i.fa-solid.fa-sliders {
      margin-left: -12px;
    }

    .dropdown:hover {
      background-color: #FFFFFF;
      color: #454545;
      width: 70px;
    }

    .dropdown-content {
      display: none;
      position: absolute;
      background-color: #FFEFE6;
      min-width: 160px;
      box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
      z-index: 1;
      inset: 0px 70px auto;
      height: auto;
      width: 160px;
    }

    .nav-sm .nav.side-menu li a {
      text-align: left !important;
      /* font-weight: 400;
    font-size: 10px;
    padding: 10px 5px; */
    }

    i.fa-regular.fa-user {
      margin-left: -12px;
    }

    i.fa-solid.fa-car-side {
      margin-left: -12px;
    }

    i.fa-solid.fa-credit-card {
      margin-left: -12px;
    }

    i.fa-solid.fa-calculator {
      margin-left: -12px;
    }
  }

  @media (min-width: 1024px) and (max-width: 1280px) {
    i.fa-solid.fa-sliders {
      margin-left: 0px;
    }

    .dropdown:hover {
      background-color: #FFFFFF;
      color: #454545;
      width: 72px;
    }

    .dropdown-content {
      display: none;
      position: absolute;
      background-color: #FFEFE6;
      min-width: 160px;
      box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
      z-index: 1;
      inset: 0px 240px auto;
      height: auto;
      width: 222px;
      padding-left: 8px;
    }
  }
</style>

<head>
  <meta content="text/html; charset=UTF-8">
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <link rel="icon" href="{{ URL::asset('fevicol.png') }}" type="image/gif" sizes="16x16">
  <title>{{ getNameSystem() }}</title>

  <!-- Bootstrap -->
  <link href="{{ URL::asset('vendors/bootstrap/dist/css/bootstrap.min.css') }}" rel="stylesheet">
  <!-- Font Awesome  V6.1.1-->
  <link href="{{ URL::asset('vendors/font-awesome/css/fontawesome.min.css') }}" rel="stylesheet">
  <link href="{{ URL::asset('vendors/font-awesome/css/all.min.css') }}" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <!-- NProgress -->
  <link href="{{ URL::asset('vendors/nprogress/nprogress.css') }}" rel="stylesheet">

  <link href="{{ URL::asset('vendors/select2/css/select2.min.css') }}" rel="stylesheet">


  <!-- FullCalendar V5.11.0 -->
  <link href="{{ URL::asset('vendors/fullcalendar/lib/main.min.css') }}" rel="stylesheet">

  <!-- bootstrap-daterangepicker -->
  {{-- <link href="{{ URL::asset('vendors/bootstrap-daterangepicker/daterangepicker.css') }} "
  rel="stylesheet"> --}}
  {{-- <link href="{{ URL::asset('vendors/bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.css') }}"
  rel="stylesheet"> --}}
  <link href="{{ URL::asset('vendors/bootstrap-date-time-picker/bootstrap5/css/bootstrap-datetimepicker.css') }}" rel="stylesheet">
  {{-- E:\xampp\htdocs\garagemaster_web\vendors\bootstrap-date-time-picker\bootstrap5\css\bootstrap-datetimepicker.css --}}
  <!-- dropify CSS -->
  <link rel="stylesheet" href="{{ URL::asset('vendors/dropify/css/dropify.min.css') }}">

  <!-- Custom Theme Style -->
  <link href="{{ URL::asset('build/css/custom.min.css') }} " rel="stylesheet">

  <!-- Own Theme Style -->
  <link href="{{ URL::asset('build/css/own.css') }} " rel="stylesheet">


  <!-- Our Custom stylesheet -->
  <link rel="stylesheet" type="text/css" href="{{ URL::asset('public/css/responsive_styles.css') }}">

  <!-- MoT Custom stylesheet -->
  <link rel="stylesheet" type="text/css" href=" {{ URL::asset('public/css/custom_mot_styles.css') }} ">
  <!-- Datatables -->
  <!-- <link href="{{ URL::asset('https://code.jquery.com/jquery-3.5.1.js') }}" rel="stylesheet">
  <link href="{{ URL::asset('https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js') }}" rel="stylesheet">
  <link href="{{ URL::asset('https://cdn.datatables.net/1.13.5/js/dataTables.bootstrap5.min.js') }}" rel="stylesheet"> -->

  <link href="{{ URL::asset('vendors/datatable/jquery-3.5.1.js') }}" rel="stylesheet">
  <link href="{{ URL::asset('vendors/datatable/jquery.dataTables.min.js') }}" rel="stylesheet">
  <link href="{{ URL::asset('vendors/datatable/dataTables.bootstrap5.min.js') }}" rel="stylesheet">
  <!-- Datatables -->

  <!-- AutoComplete CSS -->
  <link href="{{ URL::asset('build/css/themessmoothness.css') }}" rel="stylesheet">
  <!-- Multiselect CSS -->
  <link href="{{ URL::asset('build/css/multiselect.css') }}" rel="stylesheet">

  <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>

  <link rel="stylesheet" type="text/css" href="{{ URL::asset('public/css/google_api_font.css') }}">
  @if (getValue() == 'rtl')
  <link href="{!! URL::asset('build/css/bootstrap-rtl.min.css') !!}" rel="stylesheet" id="rtl" />
  @else
  @endif

  <style>
    @media print {
      .noprint {
        display: none
      }
    }
  </style>
  <!-- colorpicker links -->
  <!-- <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet"> -->
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-colorpicker/2.3.3/css/bootstrap-colorpicker.min.css" rel="stylesheet">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-colorpicker/2.3.3/js/bootstrap-colorpicker.min.js"></script>

</head>
<?php
$langcode = getLangCode();

$baseUrl = url('/');
$currentUrl = $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
$currentRoute = str_replace($baseUrl, "", $currentUrl);
?>

<body id="app-layout" class="nav-md">
  <div class="container body">
    <div class="main_container">
      <div class="col-md-3 left_col">
        <div class="left_col scroll-view">
          <div class="navbar nav_title d-none d-sm-block LogoMenuIcon py-0" style="border: 0;">
            <a href="{!! url('/') !!}" class="site_title mb-0">
              <img src="{{ URL::asset('public/general_setting/' . getLogoSystem()) }}" class="profilepic">
            </a>
          </div>

          <div class="clearfix"></div>

          <!-- sidebar menu -->
          <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
            <div class="menu_section">
              <ul class="nav side-menu">
                @php
                $inventoryRoutes = ['/'];
                @endphp

                <!-- <img src="{{ URL::asset('public/img/icons/dashboard.png') }}" > -->
                <li class={{in_array($currentRoute,$inventoryRoutes) ? 'active' : ''}}><a href="{!! url('/') !!}"><i class="fa-solid fa-house margin-right-10px"></i>{{ trans('message.Dashboard') }}
                  </a></li>

                  @php
                $inventoryRoutes = ['/customer/add'];
                @endphp
                @can('customer_view')
                <li class="{{ in_array($currentRoute, $inventoryRoutes) || Str::startsWith($currentRoute, '/customer/list/') ? 'active' : '' }}">
                  <a href="{!! url('/customer/add') !!}"><i class="fa-regular fa-user margin-right-10px"></i> Client
                  </a>
                </li>
                @endcan
              

                @canany(['jobcard_view', 'gatepass_view'])
                @php
                $inventoryRoutes = ['/jobcard/list','/gatepass/list','/gatepass/add'];
                @endphp
                <li class="{{ in_array($currentRoute, $inventoryRoutes) || Str::startsWith($currentRoute, '/jobcard/') || Str::startsWith($currentRoute, '/gatepass/') ? 'active' : '' }}">
                  <div class="dropdown w-100">
                    <a href="#"><i class="fa-solid fa-credit-card margin-right-10px"></i>{{ trans('message.Job Card') }}<span class="fa fa-chevron-right dropdown-right-icon icon"></span></a>
                    <div class="dropdown-content dropdown-content-jobcard">
                      @can('jobcard_view')
                      <a href="{!! url('/jobcard/list') !!}">{{ trans('message.Job Card') }}</a>
                      @endcan
                      @can('gatepass_view')
                      <a href="{!! url('/gatepass/list') !!}">{{ trans('message.Gate Pass') }}</a>
                      @endcan
                    </div>
                  </div>
                </li>
                @endcanany


                @php
                    $inventoryRoutes = ['/quotation/list', '/quotation/add'];
                    $companyVehicleRoutes = ['/company_vehicle/list', '/company_vehicle/add'];
                @endphp

                @can('quotation_view')
                    <li class="{{ in_array($currentRoute, $inventoryRoutes) || Str::startsWith($currentRoute, '/quotation/list/') ? 'active' : '' }}">
                        <a href="{!! url('/quotation/list') !!}">
                            <i class="fa-solid fa-file-invoice-dollar margin-right-10px"></i> {{ trans('message.Quotation') }}
                        </a>
                    </li>
                @endcan
                
                @php
                $inventoryRoutes = ['/labor_hour/add','/labor_hour/list'];
                @endphp
                @can('labor_hours')
                <li class="{{ in_array($currentRoute, $inventoryRoutes) || Str::startsWith($currentRoute, '/labor_hour/list/') ? 'active' : '' }}">
                  <a href="{!! url('/labor_hour/list') !!}"><i class="fa-regular fa-user margin-right-10px"></i> Labor Hours
                  </a>
                </li>
                @endcan


                               

                @canany(['employee_view', 'supportstaff_view', 'accountant_view', 'branchAdmin_view'])
                @php
                $inventoryRoutes = ['/employee/list','/supportstaff/list','/accountant/list','/branchadmin/list','/employee/add','/supportstaff/add','/accountant/add','/branchadmin/add'];
                @endphp
                <li class="{{ in_array($currentRoute, $inventoryRoutes) || Str::startsWith($currentRoute, '/employee/view/') || Str::startsWith($currentRoute, '/employee/edit/') || Str::startsWith($currentRoute, '/supportstaff/list/') || Str::startsWith($currentRoute, '/accountant/list/') || Str::startsWith($currentRoute, '/branchadmin/list/') ? 'active' : '' }}">

                  <div class="dropdown w-100">
                    <a href="#"><i class="fa-regular fa-user margin-right-10px"></i> Team <span class="fa fa-chevron-right dropdown-right-icon icon"> </span></a>
                    <div class="dropdown-content dropdown-content-user">
                     

                      @can('employee_view')
                      <a href="{!! url('/employee/list') !!}">{{ trans('message.Employees') }}</a>
                      @endcan

                      @can('supportstaff_view')
                      <a href="{!! url('/supportstaff/list') !!}">{{ trans('message.Support Staff') }}</a>
                      @endcan

                      @can('accountant_view')
                      <a href="{!! url('/accountant/list') !!}">{{ trans('message.Accountant') }}</a>
                      @endcan

                      @can('branchAdmin_view')
                      <a href="{!! url('/branchadmin/list') !!}">{{ trans('message.Branch Admin') }}</a>
                      @endcan

                    </div>
                  </div>
                </li>
                @endcanany

                @canany(['supplier_view', 'product_view', 'purchase_view', 'stock_view'])
                @php
                $inventoryRoutes = ['/supplier/list','/product/list','/purchase/list','/stoke/list','/supplier/add','/product/add','/purchase/add','/stoke/add','/supplier/list/edit/'];
                @endphp
                <li class="{{ in_array($currentRoute, $inventoryRoutes) || Str::startsWith($currentRoute, '/supplier/list/') || Str::startsWith($currentRoute, '/product/list/edit/') || Str::startsWith($currentRoute, '/purchase/list/edit/') ? 'active' : '' }}">

                  <div class="dropdown w-100">
                    <a href="#"><i class="fa-solid fa-sliders margin-right-10px"></i> {{ trans('message.Inventory') }}<span class="fa fa-chevron-right dropdown-right-icon icon"> </span></a>
                    <div class="dropdown-content">
                      @can('supplier_view')
                      <a href="{!! url('/supplier/list') !!}">{{ trans('message.Supplier') }}</a>
                      @endcan

                      @can('product_view')
                      <a href="{!! url('/product/list') !!}">{{ trans('message.Product') }}</a>
                      @endcan

                      @can('purchase_view')
                      <a href="{!! url('/purchase/list') !!}">{{ trans('message.Purchase') }}</a>
                      @endcan

                      @can('stock_view')
                      <a href="{!! url('/stoke/list') !!}">{{ trans('message.Stock') }}</a>
                      @endcan
                    </div>
                  </div>
                </li>
                @endcanany

                

                @canany(['vehicle_view', 'vehicletype_view', 'vehiclebrand_view', 'colors_view'])
                @php
                $inventoryRoutes = ['/vehicle/list','/vehicletype/list','/vehiclebrand/list','/color/list','/vehicle/add','/vehicletype/vehicletypeadd','/vehiclebrand/add','/color/add'];
                @endphp
                <li class="{{ in_array($currentRoute, $inventoryRoutes) || Str::startsWith($currentRoute, '/vehicle/list') || Str::startsWith($currentRoute, '/vehicletype/list/') || Str::startsWith($currentRoute, '/vehiclebrand/list/') || Str::startsWith($currentRoute, '/color/list/edit/') ? 'active' : '' }}">

                  <div class="dropdown w-100">
                    <a href="#"><i class="fa-solid fa-car-side margin-right-10px"></i>{{ trans('message.Vehicles') }}<span class="fa fa-chevron-right dropdown-right-icon icon"> </span></a>
                    <div class="dropdown-content dropdown-content-vehicle ">
                      @can('vehicle_view')
                      <a href="{!! url('/vehicle/list')!!}">{{ trans('message.List Vehicle') }}</a>
                      @endcan

                      @can('vehicletype_view')
                      <a href="{!! url('/vehicletype/list') !!}">{{ trans('message.List Vehicle Type') }}</a>
                      @endcan

                      @can('vehiclebrand_view')
                      <a href="{!! url('/vehiclebrand/list') !!}">{{ trans('message.List Vehicle Brand') }}</a>
                      @endcan

                      @can('colors_view')
                      <a href="{!! url('/color/list') !!}">{{ trans('message.Colors') }}</a>
                      @endcan
                    </div>
                  </div>
                </li>
                @endcanany

                @php
                $inventoryRoutes = ['/service/list','/service/add'];
                @endphp
                @can('service_view')
                <li class="{{ in_array($currentRoute, $inventoryRoutes) || Str::startsWith($currentRoute, '/service/list/') ? 'active' : '' }}"><a href="{!! url('/service/list') !!}"><i class="fa-solid fa-wrench margin-right-10px"></i>{{ trans('message.Services') }}</a></li>
                @endcan

                

                @php
                $inventoryRoutes = ['/invoice/list','/invoice/add','/invoice/sale_part'];
                @endphp
                @can('invoice_view')
                <li class="{{ in_array($currentRoute, $inventoryRoutes) || Str::startsWith($currentRoute, '/invoice/') ? 'active' : '' }}"><a href="{!! url('/invoice/list') !!}"><i class="fa-solid fa-receipt margin-right-10px"></i> {{ trans('message.Invoices') }}</a></li>
                @endcan

                
                @canany(['taxrate_view', 'paymentmethod_view', 'income_view', 'expense_view'])
                @php
                $inventoryRoutes = ['/taxrates/list','/payment/list','/income/list','/expense/list','/taxrates/add','/payment/add','/income/add','/income/month_income','/expense/add','/expense/month_expense'];
                @endphp
                <li class="{{ in_array($currentRoute, $inventoryRoutes) || Str::startsWith($currentRoute, '/taxrates/') || Str::startsWith($currentRoute, '/payment/') || Str::startsWith($currentRoute, '/income/') || Str::startsWith($currentRoute, '/expense/') ? 'active' : '' }}">
                  <div class="dropdown w-100">
                    <a href="#"><i class="fa-solid fa-calculator margin-right-10px"></i> {{trans('message.Accounts')}}<span class="fa fa-chevron-right dropdown-right-icon icon"></span></a>
                    <div class="dropdown-content">
                      @can('taxrate_view')
                      <a href="{!! url('/taxrates/list') !!}">{{ trans('message.List Tax Rates') }}</a>
                      @endcan

                      @can('paymentmethod_view')
                      <a href="{!! url('/payment/list') !!}">{{ trans('message.List Payment Method') }}</a>
                      @endcan

                      @can('income_view')
                      <a href="{!! url('/income/list') !!}">{{ trans('message.Income') }}</a>
                      @endcan

                      @can('expense_view')
                      <a href="{!! url('/expense/list') !!}">{{ trans('message.Expenses') }}</a>
                      @endcan
                    </div>
                  </div>
                </li>
                @endcanany

                <!-- @php
                $inventoryRoutes = ['/sales/list','/sales/add'];
                @endphp
                @can('sales_view')
                <li class="{{in_array($currentRoute,$inventoryRoutes) || Str::startsWith($currentRoute, '/sales/') ? 'active' : ''}}"><a href="{!! url('/sales/list') !!}"><i class="fa-solid fa-tag"></i>
                    @if (Auth::user()->role == 'Customer')
                    {{ trans('message.Vehicle Purchased') }}
                    @else
                    {{ trans('message.Vehicle Sells') }}
                    @endif
                  </a> </li>
                @endcan -->


                @php
                    $companyVehicleRoutes = ['/company_vehicle/list', '/company_vehicle/add'];
                @endphp
                @can('companyvehicle_view')
                  <li class="{{ in_array($currentRoute, $companyVehicleRoutes) || Str::startsWith($currentRoute, '/company_vehicle/list/') ? 'active' : '' }}">
                      <a href="{!! url('/company_vehicle/list') !!}">
                          <i class="fa-solid fa-car margin-right-10px"></i> {{ trans('Company Vehicle') }}
                      </a>
                  </li>
           `    @endcan
                
           @php
                    $companyVehicleRoutes = ['/Companyvehicle/list', '/Sell_vehicle/add'];
                @endphp
                @can('companyvehicle')
                  <li class="{{ in_array($currentRoute, $companyVehicleRoutes) || Str::startsWith($currentRoute, '/companyvehicle/list/') ? 'active' : '' }}">
                      <a href="{!! url('/companyvehicle/list') !!}">
                          <i class="fa-solid fa-car margin-right-10px"></i>{{ trans('Vehicle Sells') }}
                      </a>
                  </li>
           `    @endcan

                @php
                $inventoryRoutes = ['/sales_part/list','/sales_part/add'];
                @endphp
                @can('salespart_view')
                <!-- @if (getActiveCustomer(Auth::user()->id) == 'yes' || getActiveEmployee(Auth::user()->id) == 'yes') -->
                <li class="{{in_array($currentRoute,$inventoryRoutes) || Str::startsWith($currentRoute, '/sales_part/') ? 'active' : ''}}"><a href="{!! url('/sales_part/list') !!}"><i class="fa-solid fa-tag margin-right-10px"></i> {{ trans('message.Part Sells') }} </a> </li>
                <!-- @else -->
                <li class="{{in_array($currentRoute,$inventoryRoutes) || Str::startsWith($currentRoute, '/sales_part/') ? 'active' : ''}}"><a href="{!! url('/sales_part/list') !!}"><i class="fa-solid fa-tag margin-right-10px"></i> {{ trans('message.Purchase') }} </a> </li>
                <!-- @endif -->
                @endcan

                @php
                $inventoryRoutes = ['/rto/list','/rto/add'];
                @endphp
                @can('rto_view')
                <li class="{{in_array($currentRoute,$inventoryRoutes) || Str::startsWith($currentRoute, '/rto/') ?  'active' : ''}}"><a href="{!! url('/rto/list') !!}"><i class="fa-solid fa-clipboard-check margin-right-10px"></i> {{ trans('message.Compliance') }}</a>
                </li>
                @endcan

                @php
                $inventoryRoutes = ['/report/salesreport','/report/servicereport','/report/productreport','/report/productuses','/report/servicebyemployee'];
                @endphp
                @can('report_view')
                <li class="{{in_array($currentRoute,$inventoryRoutes)  || Str::startsWith($currentRoute, '/report/')? 'active' : ''}}"><a href="{!! url('/report/servicereport') !!}"><i class="fa-solid fa-chart-line margin-right-10px"></i>{{ trans('message.Reports') }}
                  </a></li>
                @endcan

                @can('emailtemplate_view')
                <li class="w-100"><a href="{!! url('/mail/mail') !!}"><i class="fa-solid fa-envelope-open-text margin-right-10px"></i>{{ trans('message.Email Templates') }}</a></li>
                @endcan

                @php
                $inventoryRoutes = ['/setting/custom/list','/setting/custom/add'];
                @endphp
                @can('customfield_view')
                <li class="{{in_array($currentRoute,$inventoryRoutes) || Str::startsWith($currentRoute, '/setting/custom/') ? 'active' : ''}}"><a href="{!! url('/setting/custom/list') !!}"><i class="fa-solid fa-puzzle-piece margin-right-10px"></i>{{ trans('message.Custom Fields') }}</a> </li>
                @endcan

                @php
                $inventoryRoutes = ['/observation/list','/observation/add'];
                @endphp
                @can('observationlibrary_view')
                <li class="{{in_array($currentRoute,$inventoryRoutes) ? 'active' : ''}}"><a href="{!! url('/observation/list') !!}"><i class="fa-solid fa-file-lines margin-right-10px"></i> {{ trans('message.Observation library') }}</a></li>
                @endcan

                @php
                $inventoryRoutes = ['/branch/list','/branch/add'];
                @endphp
                @can('branch_view')
                <li class="{{in_array($currentRoute,$inventoryRoutes) || Str::startsWith($currentRoute, '/branch/') ? 'active' : ''}}"><a href="{!! url('/branch/list') !!}"><i class="fa-solid fa-code-branch margin-right-10px"></i> {{ trans('message.Branch') }}
                  </a>
                </li>
                @endcan

                @php
                $inventoryRoutes = ['/setting/general_setting/list','/setting/timezone/list','/setting/accessrights/show','/setting/hours/list','/setting/stripe/list','/branch_setting/list'];
                @endphp
                @if (getActiveAdmin(Auth::User()->id) == 'yes')
                <li class="{{in_array($currentRoute,$inventoryRoutes) ? 'active' : ''}}"><a data-toggle="" data-placement="top" href="{!! url('/setting/general_setting/list') !!}" title="{{trans('message.Settings')}}"> <i class="fa-solid fa-gear margin-right-10px"></i>{{trans('message.Settings')}}</a></li>
                @else
                @if (Gate::allows('generalsetting_view'))
                @can('generalsetting_view')
                <li class="{{in_array($currentRoute,$inventoryRoutes) ? 'active' : ''}}"><a data-toggle="" data-placement="top" href="{!! url('/setting/general_setting/list') !!}" title="{{trans('message.Settings')}}"> <i class="fa-solid fa-gear margin-right-10px"></i>{{trans('message.Settings')}}</a></li>
                @endcan
                @else
                @can('timezone_view')
                <li class="{{in_array($currentRoute,$inventoryRoutes) ? 'active' : ''}}"><a data-toggle="" data-placement="top" href="{!! url('/setting/timezone/list') !!}" title="{{trans('message.Settings')}}"> <i class="fa-solid fa-gear"></i>{{trans('message.Settings')}}</a></li>
                @endcan
                @endif
                @endif
                <li>
                  <a class="logoutConfirm"><i class="fa fa-power-off" aria-hidden="true"></i>{{ trans('message.Logout') }}</a>
                  <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                  </form>
                  <!-- <a title="{{trans('message.Logout')}}" href="#" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                  <i class="fa fa-power-off" aria-hidden="true"></i>{{trans('message.Logout')}}
                  <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                  </form>
                </a> -->
                </li>
              </ul>
              <nav aria-label="Page navigation example">

            </div>
          </div>

          <!-- /sidebar menu -->

        </div>
      </div>

      <!-- top navigation -->
      <div class="top_nav position-relative">

        <!-- /top navigation -->
        @yield('content')
        <footer class="footerforallpage bottom-0 bg-white text-center" id="footerforid">
          <span class="footerbottom me-3">{{ trans('© Copyright 2024 | Garage Master  | All Rights Reserved') }}</span>
        </footer>
      </div>
    </div>
  </div>

  <!-- jQuery -->
  <script src="{{ URL::asset('vendors/jquery/dist/jquery.min.js') }}"></script>

  <!-- <script src="{{ URL::asset('build/js/jquery-ui.js') }}" defer="defer"></script> -->


  <!-- Bootstrap -->
  <script src="{{ URL::asset('build/js/popper.min.js') }}" defer="defer"></script>

  {{-- <script src="{{ URL::asset('vendors/bootstrap/dist/js/bootstrap.min.js') }}"
  defer="defer"></script> --}}

  <script src="{{ URL::asset('vendors/bootstrap/dist/js/bootstrap.bundle.js') }}" defer="defer"></script>


  <!-- NProgress -->
  <script src="{{ URL::asset('vendors/nprogress/nprogress.js') }}" defer="defer"></script>

  <!-- DateJS for theme default js-->
  <script src="{{ URL::asset('vendors/DateJS/build/date.js') }}" defer="defer"></script>

  <!-- Custom Theme Scripts -->
  <script src="{{ URL::asset('build/js/custom.min.js') }}" defer="defer"></script>
  <script src="{{ URL::asset('vendors/sweetalert/dist/sweetalert.min.js') }}" defer="defer"></script>

  <!-- <script src="https://cdn.datatables.net/v/bs5/jqc-1.12.4/dt-1.13.4/datatables.min.js"></script> -->
  <script type="text/javascript" src="{{ URL::asset('vendors/datatable/datatables.min.js') }}"></script>


  <!-- dropify scripts-->
  <script src="{{ URL::asset('vendors/dropify/js/dropify.min.js') }}" defer="defer"></script>

  <!-- bootstrap-daterangepicker -->
  <script src="{{ URL::asset('vendors/moment/moment.min.js') }}" defer="defer"></script>
  {{-- <script src="{{ URL::asset('vendors/bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js') }}"
  defer="defer"></script> --}}
  <script src="{{ URL::asset('vendors/bootstrap-date-time-picker/bootstrap5/js/bootstrap-datetimepicker.min.js') }}" defer="defer"></script>
  <script src="{{ URL::asset('/vendors/bootstrap-date-time-picker/bootstrap5/js/locales/bootstrap-datetimepicker.' . getLangCode() . '.js') }}" defer="defer"></script>

  {{-- <script src="{{ URL::asset('vendors/bootstrap-daterangepicker/daterangepicker.js') }}"
  defer="defer"></script> --}}

  <!-- Filter  -->
  <script src="{{ URL::asset('vendors/jszip/dist/jszip.min.js') }}" defer="defer"></script>

  <!-- Autocomplete Js  -->
  <script src="{{ URL::asset('build/js/jquery.circliful.min.js') }}" defer="defer"></script>

  <!-- Multiselect Js  -->
  <script src="{{ URL::asset('build/js/bootstrap-multiselect.js') }}" defer="defer"></script>
  <script src="{{ URL::asset('vendors/select2/js/select2.min.js') }}" type='text/javascript' defer="defer"></script>

  <!-- For form field validate Using Proengsoft -->
  <script type="text/javascript" src="{{ URL::asset('build/jquery-validate/1.19.2/jquery.validate.min.js') }}"></script>


  <script type="text/javascript">
    $(document).ready(function() {
      $('form').bind("keypress", function(e) {
        if (e.keyCode == 13) {
          e.preventDefault();
          return false;
        }
      });

      $('body').on('click', '.logoutConfirm', function() {
        var msg1 = "{{ trans('message.Are You Sure?') }}";
        var msg2 = "{{ trans('message.You will be logged out!') }}";
        var msg3 = "{{ trans('message.Cancel') }}";
        var msg4 = "{{ trans('message.Yes') }}";

        swal({
          title: msg1,
          text: msg2,
          icon: 'warning',
          cancelButtonColor: '#C1C1C1',
          buttons: [msg3, msg4],
          dangerMode: true,
        }).then((willDelete) => {
          if (willDelete) {
            event.preventDefault();
            document.getElementById('logout-form').submit();
          }
        });
      });
    });

    var csrf_token = document.querySelector("meta[name='csrf-token']").getAttribute("content");

    function csrfSafeMethod(method) {
      // these HTTP methods do not require CSRF protection
      return (/^(GET|HEAD|OPTIONS)$/.test(method));
    }
    var o = XMLHttpRequest.prototype.open;
    XMLHttpRequest.prototype.open = function() {
      var res = o.apply(this, arguments);
      var err = new Error();
      if (!csrfSafeMethod(arguments[0])) {
        this.setRequestHeader('anti-csrf-token', csrf_token);
      }
      return res;
    };
  </script>

  <!-- Delete multiple rows -->
  <script src="{{ URL::asset('public/js/custom/accessrights/deletemultiple.js') }}"></script>

  <!-- For scroll active tab -->
  <script>
    var activeElement = document.querySelector('.nav-tabs .nav-link.active');

    if (activeElement) {
      activeElement.scrollIntoView({
        behavior: 'smooth',
        block: 'end'
    });
    }
  </script>

</body>

</html>