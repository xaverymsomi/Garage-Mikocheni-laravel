@extends('layouts.app')
@section('content')
<!-- page content -->
<style>
  div#supplier_wrapper {
    width: 97%;
  }
</style>
<div class="right_col" role="main">
  <div class="">
    <div class="page-title">
      <div class="nav_menu">
        <nav>
          <div class="nav toggle">
            <a id="menu_toggle"><i class="fa fa-bars sidemenu_toggle"></i></a><a href="{{ URL::previous() }}" id=""><i class=""><img src="{{ URL::asset('public/supplier/Back Arrow.png') }}"></i><span class="titleup">
                {{ trans('message.Access Rights') }}</span></a>
          </div>
          @include('dashboard.profile')
        </nav>
      </div>
    </div>
    @include('success_message.message')
    <div class="x_content table-responsive">
      <ul class="nav nav-tabs">
        @can('generalsetting_view')
        <li class="nav-item">
          <a href="{!! url('setting/general_setting/list') !!}" class="nav-link nav-link-not-active"><span class="visible-xs"></span> <i class="">&nbsp;</i><b>{{ trans('message.GENERAL SETTINGS') }}</b></a>
        </li>
        @endcan
        @can('timezone_view')
        <li class="nav-item">
          <a href="{!! url('setting/timezone/list') !!}" class="nav-link nav-link-not-active"><span class="visible-xs"></span><i class="">&nbsp;</i><b>{{ trans('message.OTHER SETTINGS') }}</b></a>
        </li>
        @endcan
        @can('accessrights_view')
        <li class="nav-item">
          <a href="{!! url('setting/accessrights/show') !!}" class="nav-link active"><span class="visible-xs"></span><i class="">&nbsp;</i><b>{{ trans('message.ACCESS RIGHTS') }}</b></a>
        </li>
        @endcan
        @can('businesshours_view')
        <li class="nav-item">
          <a href="{!! url('setting/hours/list') !!}" class="nav-link nav-link-not-active"><span class="visible-xs"></span><i class="">&nbsp;</i><b>{{ trans('message.BUSINESS HOURS') }}</b></a>
        </li>
        @endcan
        @can('stripesetting_view')
        <li class="nav-item">
          <a href="{!! url('setting/stripe/list') !!}" class="nav-link nav-link-not-active"><span class="visible-xs"></span><i class="">&nbsp;</i><b>{{ trans('message.STRIPE SETTINGS') }}</b></a>
        </li>
        @endcan
        @can('branchsetting_view')
        <li class="nav-item">
          <a href="{!! url('branch_setting/list') !!}" class="nav-link nav-link-not-active"><span class="visible-xs"></span><i class="">&nbsp;</i><b>{{ trans('message.BRANCH SETTING') }}</b></a>
        </li>
        @endcan
        <li class="nav-item">
          @can('email_view')
          <a href="{!! url('setting/email_setting/list') !!}" class="nav-link nav-link-not-active"><span class="visible-xs"></span><i class="">&nbsp;</i><b>{{ trans('message.EMAIL SETTING') }}</b></a>
          @endcan
        </li>
      </ul>
    </div>


    <div class="clearfix"></div>
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">

          <div class="col-12 panel-group">
            <div class="accordion" id="accordionExample">
              <!-- SUPER ADMIN Accordion Starting (New)-->
              @php
              $i = 0;
              @endphp
              @foreach ($get_rights as $q => $get_right)
              @php
              $regex = json_decode($get_right->permissions);
              @endphp


              <div class="accordion-item mb-3">
                <h4 class="accordion-header" id="#collapse{{ $get_right->id }}">
                  <a class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{ $get_right->id }}" aria-expanded="false" aria-controls="collapse{{ $get_right->id }}">
                    @if ($get_right->role_name == 'Customer')
                    {{ trans('message.Customer') }}
                    @elseif($get_right->role_name == 'Employee')
                    {{ trans('message.Employees') }}
                    @elseif($get_right->role_name == 'Support Staff')
                    {{ trans('message.Support Staffs') }}
                    @elseif($get_right->role_name == 'Accountant')
                    {{ trans('message.Accountants') }}
                    @elseif($get_right->role_name == 'Branch Admin')
                    {{ trans('message.Branch Admin') }}
                    @endif
                  </a>
                </h4>

                <div id="collapse{{ $get_right->id }}" class="accordion-collapse collapse" aria-labelledby="collapse{{ $get_right->id }}" data-bs-parent="#accordionExample">
                  <div class="accordion-body">
                    <form name="" id="" method="post" action="{{ url('setting/accessrights/access_store', $get_right->id) }}" enctype="multipart/form-data">
                      <input type="hidden" name="_token" value="{{ csrf_token() }}">
                      <div class="table-responsive">
                        <table id="supplier" class="table jambo_table table-responsive">
                          <thead>
                            <tr>
                              <th class="fw-bold">{{ trans('message.Module Name') }}</th>
                              <th class="fw-bold">{{ trans('message.View') }}</th>
                              <th class="fw-bold">{{ trans('message.Add') }}</th>
                              <th class="fw-bold">{{ trans('message.Update') }}</th>
                              <th class="fw-bold">{{ trans('message.Delete') }}</th>
                              <th class="fw-bold">{{ trans('message.Own Data') }}</th>
                            </tr>
                          </thead>
                          <tbody>

                            <!-- Dashboard Access Rights Start -->
                            <tr>
                              <td>{{ trans('message.Dashboard') }}</td>
                              <td class="">
                                <input type="checkbox" data-row="{{ $i }}" class="main_access" data-for="dashboard" name="dashboard[]" value="dashboard_view" @if (!empty($regex->dashboard_view)) @if ($regex->dashboard_view == true) {{ 'checked' }} @endif
                                @endif
                                >
                              </td>
                              <td>
                                <input type="checkbox" class="dashboard_{{ $i }}" name="dashboard[]" value="dashboard_owndata" @if (!empty($regex->dashboard_owndata)) @if ($regex->dashboard_owndata == true) {{ 'checked' }} @endif
                                @endif
                                >
                              </td>
                              <td>-</td>
                              <td>-</td>
                              <td>-</td>
                            </tr>
                            <!-- Dashboard Access Rights End -->

                            <!-- Suppliers Access Rights Start -->
                            <tr>
                              <td>{{ trans('message.Supplier') }}</td>
                              <td class="">
                                <input type="checkbox" data-row="{{ $i }}" class="main_access" data-for="supplier" name="supplier[]" value="supplier_view" @if (!empty($regex->supplier_view)) @if ($regex->supplier_view == true) {{ 'checked' }} @endif
                                @endif
                                >
                              </td>
                              <td>
                                <input type="checkbox" class="supplier_{{ $i }}" name="supplier[]" value="supplier_add" @if (!empty($regex->supplier_add)) @if ($regex->supplier_add == true) {{ 'checked' }} @endif
                                @endif
                                >
                              </td>
                              <td>
                                <input type="checkbox" class="supplier_{{ $i }}" name="supplier[]" value="supplier_edit" @if (!empty($regex->supplier_edit)) @if ($regex->supplier_edit == true) {{ 'checked' }} @endif
                                @endif
                                >
                              </td>
                              <td>
                                <input type="checkbox" class="supplier_{{ $i }}" name="supplier[]" value="supplier_delete" @if (!empty($regex->supplier_delete)) @if ($regex->supplier_delete == true) {{ 'checked' }} @endif
                                @endif
                                >
                              </td>
                              @if ($get_right->role_name == 'Support Staff' || $get_right->role_name == 'Accountant')
                              <td>

                                <input type="checkbox" class="supplier_{{ $i }}" name="supplier[]" value="supplier_owndata" @if (!empty($regex->supplier_owndata)) @if ($regex->supplier_owndata == true) {{ 'checked' }} @endif
                                @endif
                                >
                              </td>
                              @else
                              <td>-</td>
                              @endif
                            </tr>
                            <!-- Suppliers Access Rights End -->

                            <!-- Product Access Rights Start -->
                            <tr>
                              <td>{{ trans('message.Product') }}</td>
                              <td class="">
                                <input type="checkbox" data-row="{{ $i }}" class="main_access" data-for="product" name="product[]" value="product_view" @if (!empty($regex->product_view)) @if ($regex->product_view == true) {{ 'checked' }} @endif
                                @endif
                                >
                              </td>
                              <td>
                                <input type="checkbox" class="product_{{ $i }}" name="product[]" value="product_add" @if (!empty($regex->product_add)) @if ($regex->product_add == true) {{ 'checked' }} @endif
                                @endif
                                >
                              </td>
                              <td>
                                <input type="checkbox" class="product_{{ $i }}" name="product[]" value="product_edit" @if (!empty($regex->product_edit)) @if ($regex->product_edit == true) {{ 'checked' }} @endif
                                @endif
                                >
                              </td>
                              <td>
                                <input type="checkbox" class="product_{{ $i }}" name="product[]" value="product_delete" @if (!empty($regex->product_delete)) @if ($regex->product_delete == true) {{ 'checked' }} @endif
                                @endif
                                >
                              </td>
                              @if ($get_right->role_name == 'Accountant')
                              <td>
                                <input type="checkbox" class="product_{{ $i }}" name="product[]" value="product_owndata" @if (!empty($regex->product_owndata)) @if ($regex->product_owndata == true) {{ 'checked' }} @endif
                                @endif
                                >
                              </td>
                              @else
                              <td>-</td>
                              @endif
                            </tr>
                            <!-- Product Access Rights End -->

                            <!-- Purchase Access Rights Start -->
                            <tr>
                              <td>{{ trans('message.Purchase') }}</td>
                              <td class="">
                                <input type="checkbox" data-row="{{ $i }}" class="main_access" data-for="purchase" name="purchase[]" value="purchase_view" @if (!empty($regex->purchase_view)) @if ($regex->purchase_view == true) {{ 'checked' }} @endif
                                @endif
                                >
                              </td>
                              <td>
                                <input type="checkbox" class="purchase_{{ $i }}" name="purchase[]" value="purchase_add" @if (!empty($regex->purchase_add)) @if ($regex->purchase_add == true) {{ 'checked' }} @endif
                                @endif
                                >
                              </td>
                              <td>
                                <input type="checkbox" class="purchase_{{ $i }}" name="purchase[]" value="purchase_edit" @if (!empty($regex->purchase_edit)) @if ($regex->purchase_edit == true) {{ 'checked' }} @endif
                                @endif
                                >
                              </td>
                              <td>
                                <input type="checkbox" class="purchase_{{ $i }}" name="purchase[]" value="purchase_delete" @if (!empty($regex->purchase_delete)) @if ($regex->purchase_delete == true) {{ 'checked' }} @endif
                                @endif
                                >
                              </td>
                              @if ($get_right->role_name == 'Accountant')
                              <td>
                                <input type="checkbox" class="purchase_{{ $i }}" name="purchase[]" value="purchase_owndata" @if (!empty($regex->purchase_owndata)) @if ($regex->purchase_owndata == true) {{ 'checked' }} @endif
                                @endif
                                >
                              </td>
                              @else
                              <td>-</td>
                              @endif
                            </tr>
                            <!-- Purchase Access Rights End -->

                            <!-- Stock Access Rights Start -->
                            <tr>
                              <td>{{ trans('message.Stock') }}</td>
                              <td class="">
                                <input type="checkbox" data-row="{{ $i }}" class="main_access" data-for="stock" name="stock[]" value="stock_view" @if (!empty($regex->stock_view)) @if ($regex->stock_view == true) {{ 'checked' }} @endif
                                @endif
                                >
                              </td>
                              <td>-</td>
                              <td>
                                <input type="checkbox" class="stock_{{ $i }}" name="stock[]" value="stock_edit" @if (!empty($regex->stock_edit)) @if ($regex->stock_edit == true) {{ 'checked' }} @endif
                                @endif
                                >
                              </td>
                              <td>-</td>
                              @if ($get_right->role_name == 'Accountant')
                              <td>
                                <input type="checkbox" class="stock_{{ $i }}" name="stock[]" value="stock_owndata" @if (!empty($regex->stock_owndata)) @if ($regex->stock_owndata == true) {{ 'checked' }} @endif
                                @endif
                                >
                                @else
                              <td>-</td>
                              </td>
                              @endif

                            </tr>
                            <!-- Stock Access Rights End -->

                            <!-- Customer Access Rights Start -->
                            <tr>
                              <td>{{ trans('message.Customers') }}</td>
                              <td class="">
                                <input type="checkbox" data-row="{{ $i }}" class="main_access" data-for="customer" name="customer[]" value="customer_view" @if (!empty($regex->customer_view)) @if ($regex->customer_view == true) {{ 'checked' }} @endif
                                @endif
                                >
                              </td>
                              <td>
                                <input type="checkbox" class="customer_{{ $i }}" name="customer[]" value="customer_add" @if (!empty($regex->customer_add)) @if ($regex->customer_add == true) {{ 'checked' }} @endif
                                @endif
                                >
                              </td>
                              <td>
                                <input type="checkbox" class="customer_{{ $i }}" name="customer[]" value="customer_edit" @if (!empty($regex->customer_edit)) @if ($regex->customer_edit == true) {{ 'checked' }} @endif
                                @endif
                                >
                              </td>
                              <td>
                                <input type="checkbox" class="customer_{{ $i }}" name="customer[]" value="customer_delete" @if (!empty($regex->customer_delete)) @if ($regex->customer_delete == true) {{ 'checked' }} @endif
                                @endif
                                >
                              </td>
                              @if ($get_right->role_name == 'Customer' || $get_right->role_name == 'Employee' || $get_right->role_name == 'Support Staff' || $get_right->role_name == 'Accountant')
                              <td>
                                <input type="checkbox" class="customer_{{ $i }}" name="customer[]" value="customer_owndata" @if (!empty($regex->customer_owndata)) @if ($regex->customer_owndata == true) {{ 'checked' }} @endif
                                @endif
                                >
                              </td>
                              @else
                              <td>-</td>
                              @endif
                            </tr>
                            <!-- Customer Access Rights End -->

                            <!-- Employee Access Rights Start -->
                            <tr>
                              <td>{{ trans('message.Employees') }}</td>
                              <td class="">
                                <input type="checkbox" data-row="{{ $i }}" class="main_access" data-for="employee" name="employee[]" value="employee_view" @if (!empty($regex->employee_view)) @if ($regex->employee_view == true) {{ 'checked' }} @endif
                                @endif
                                >
                              </td>
                              <td>
                                <input type="checkbox" class="employee_{{ $i }}" name="employee[]" value="employee_add" @if (!empty($regex->employee_add)) @if ($regex->employee_add == true) {{ 'checked' }} @endif
                                @endif
                                >
                              </td>
                              <td>
                                <input type="checkbox" class="employee_{{ $i }}" name="employee[]" value="employee_edit" @if (!empty($regex->employee_edit)) @if ($regex->employee_edit == true) {{ 'checked' }} @endif
                                @endif
                                >
                              </td>
                              <td>
                                <input type="checkbox" class="employee_{{ $i }}" name="employee[]" value="employee_delete" @if (!empty($regex->employee_delete)) @if ($regex->employee_delete == true) {{ 'checked' }} @endif
                                @endif
                                >
                              </td>
                              @if ($get_right->role_name == 'Employee' || $get_right->role_name == 'Customer' || $get_right->role_name == 'Support Staff' || $get_right->role_name == 'Accountant')
                              <td>
                                <input type="checkbox" class="employee_{{ $i }}" name="employee[]" value="employee_owndata" @if (!empty($regex->employee_owndata)) @if ($regex->employee_owndata == true) {{ 'checked' }} @endif
                                @endif
                                >
                              </td>
                              @else
                              <td>-</td>
                              @endif
                            </tr>
                            <!-- Employee Access Rights End -->

                            <!-- Support Staff Access Rights Start -->
                            <tr>
                              <td>{{ trans('message.Support Staff') }}</td>
                              <td class="">
                                <input type="checkbox" data-row="{{ $i }}" class="main_access" data-for="supportstaff" name="supportstaff[]" value="supportstaff_view" @if (!empty($regex->supportstaff_view)) @if ($regex->supportstaff_view == true) {{ 'checked' }} @endif
                                @endif
                                >
                              </td>
                              <td>
                                <input type="checkbox" class="supportstaff_{{ $i }}" name="supportstaff[]" value="supportstaff_add" @if (!empty($regex->supportstaff_add)) @if ($regex->supportstaff_add == true) {{ 'checked' }} @endif
                                @endif
                                >
                              </td>
                              <td>
                                <input type="checkbox" class="supportstaff_{{ $i }}" name="supportstaff[]" value="supportstaff_edit" @if (!empty($regex->supportstaff_edit)) @if ($regex->supportstaff_edit == true) {{ 'checked' }} @endif
                                @endif
                                >
                              </td>
                              <td>
                                <input type="checkbox" class="supportstaff_{{ $i }}" name="supportstaff[]" value="supportstaff_delete" @if (!empty($regex->supportstaff_delete)) @if ($regex->supportstaff_delete == true) {{ 'checked' }} @endif
                                @endif
                                >
                              </td>
                              @if ($get_right->role_name == 'Support Staff' || $get_right->role_name == 'Accountant')
                              <td>
                                <input type="checkbox" class="supportstaff_{{ $i }}" name="supportstaff[]" value="supportstaff_owndata" @if (!empty($regex->supportstaff_owndata)) @if ($regex->supportstaff_owndata == true) {{ 'checked' }} @endif
                                @endif
                                >
                              </td>
                              @else
                              <td>-</td>
                              @endif
                            </tr>
                            <!-- Support Staff Access Rights End -->

                            <!-- Accountant Access Rights Start -->
                            <tr>
                              <td>{{ trans('message.Accountant') }}</td>
                              <td class="">
                                <input type="checkbox" data-row="{{ $i }}" class="main_access" data-for="accountant" name="accountant[]" value="accountant_view" @if (!empty($regex->accountant_view)) @if ($regex->accountant_view == true) {{ 'checked' }} @endif
                                @endif
                                >
                              </td>
                              <td>
                                <input type="checkbox" class="accountant_{{ $i }}" name="accountant[]" value="accountant_add" @if (!empty($regex->accountant_add)) @if ($regex->accountant_add == true) {{ 'checked' }} @endif
                                @endif
                                >
                              </td>
                              <td>
                                <input type="checkbox" class="accountant_{{ $i }}" name="accountant[]" value="accountant_edit" @if (!empty($regex->accountant_edit)) @if ($regex->accountant_edit == true) {{ 'checked' }} @endif
                                @endif
                                >
                              </td>
                              <td>
                                <input type="checkbox" class="accountant_{{ $i }}" name="accountant[]" value="accountant_delete" @if (!empty($regex->accountant_delete)) @if ($regex->accountant_delete == true) {{ 'checked' }} @endif
                                @endif
                                >
                              </td>

                              @if ($get_right->role_name == 'Accountant')
                              <td>
                                <input type="checkbox" class="accountant_{{ $i }}" name="accountant[]" value="accountant_owndata" @if (!empty($regex->accountant_owndata)) @if ($regex->accountant_owndata == true) {{ 'checked' }} @endif
                                @endif
                                >
                              </td>
                              @else
                              <td>-</td>
                              @endif

                            </tr>
                            <!-- Accountant Access Rights End -->

                            <!-- Branch Admin Access Rights Start -->
                            <tr>
                              <td>{{ trans('message.Branch Admin') }}</td>
                              <td class="">
                                <input type="checkbox" data-row="{{ $i }}" class="main_access" data-for="branchAdmin" name="branchAdmin[]" value="branchAdmin_view" @if (!empty($regex->branchAdmin_view)) @if ($regex->branchAdmin_view == true) {{ 'checked' }} @endif
                                @endif
                                >
                              </td>
                              <td>
                                <input type="checkbox" class="branchAdmin_{{ $i }}" name="branchAdmin[]" value="branchAdmin_add" @if (!empty($regex->branchAdmin_add)) @if ($regex->branchAdmin_add == true) {{ 'checked' }} @endif
                                @endif
                                >
                              </td>
                              <td>
                                <input type="checkbox" class="branchAdmin_{{ $i }}" name="branchAdmin[]" value="branchAdmin_edit" @if (!empty($regex->branchAdmin_edit)) @if ($regex->branchAdmin_edit == true) {{ 'checked' }} @endif
                                @endif
                                >
                              </td>
                              <td>
                                <input type="checkbox" class="branchAdmin_{{ $i }}" name="branchAdmin[]" value="branchAdmin_delete" @if (!empty($regex->branchAdmin_delete)) @if ($regex->branchAdmin_delete == true) {{ 'checked' }} @endif
                                @endif
                                >
                              </td>
                              @if ($get_right->role_name == 'Branch Admin')
                              <td>
                                <input type="checkbox" class="branchAdmin_{{ $i }}" name="branchAdmin[]" value="branchAdmin_owndata" @if (!empty($regex->branchAdmin_owndata)) @if ($regex->branchAdmin_owndata == true) {{ 'checked' }} @endif
                                @endif
                                >
                              </td>
                              @else
                              <td>-</td>
                              @endif
                            </tr>
                            <!-- Branch Admin Access Rights End -->

                            <!-- Vehicle Access Rights Start -->
                            <tr>
                              <td>{{ trans('message.Vehicles') }}</td>
                              <td class="">
                                <input type="checkbox" data-row="{{ $i }}" class="main_access" data-for="vehicle" name="vehicle[]" value="vehicle_view" @if (!empty($regex->vehicle_view)) @if ($regex->vehicle_view == true) {{ 'checked' }} @endif
                                @endif
                                >
                              </td>
                              <td>
                                <input type="checkbox" class="vehicle_{{ $i }}" name="vehicle[]" value="vehicle_add" @if (!empty($regex->vehicle_add)) @if ($regex->vehicle_add == true) {{ 'checked' }} @endif
                                @endif
                                >
                              </td>
                              <td>
                                <input type="checkbox" class="vehicle_{{ $i }}" name="vehicle[]" value="vehicle_edit" @if (!empty($regex->vehicle_edit)) @if ($regex->vehicle_edit == true) {{ 'checked' }} @endif
                                @endif
                                >
                              </td>
                              <td>
                                <input type="checkbox" class="vehicle_{{ $i }}" name="vehicle[]" value="vehicle_delete" @if (!empty($regex->vehicle_delete)) @if ($regex->vehicle_delete == true) {{ 'checked' }} @endif
                                @endif
                                >
                              </td>
                              <td>-</td>
                            </tr>
                            <!-- Vehicle Access Rights End -->

                            <!-- Vehicle Type Access Rights Start -->
                            <tr>
                              <td>{{ trans('message.Vehicle Type') }}</td>
                              <td class="">
                                <input type="checkbox" data-row="{{ $i }}" class="main_access" data-for="vehicletype" name="vehicletype[]" value="vehicletype_view" @if (!empty($regex->vehicletype_view)) @if ($regex->vehicletype_view == true) {{ 'checked' }} @endif
                                @endif
                                >
                              </td>
                              <td>
                                <input type="checkbox" class="vehicletype_{{ $i }}" name="vehicletype[]" value="vehicletype_add" @if (!empty($regex->vehicletype_add)) @if ($regex->vehicletype_add == true) {{ 'checked' }} @endif
                                @endif
                                >
                              </td>
                              <td>
                                <input type="checkbox" class="vehicletype_{{ $i }}" name="vehicletype[]" value="vehicletype_edit" @if (!empty($regex->vehicletype_edit)) @if ($regex->vehicletype_edit == true) {{ 'checked' }} @endif
                                @endif
                                >
                              </td>
                              <td>
                                <input type="checkbox" class="vehicletype_{{ $i }}" name="vehicletype[]" value="vehicletype_delete" @if (!empty($regex->vehicletype_delete)) @if ($regex->vehicletype_delete == true) {{ 'checked' }} @endif
                                @endif
                                >
                              </td>
                              <td>-</td>
                            </tr>
                            <!-- Vehicle Type Access Rights End -->

                            <!-- Vehicle Brand Access Rights Start -->
                            <tr>
                              <td>{{ trans('message.Vehicle Brand') }}</td>
                              <td class="">
                                <input type="checkbox" data-row="{{ $i }}" class="main_access" data-for="vehiclebrand" name="vehiclebrand[]" value="vehiclebrand_view" @if (!empty($regex->vehiclebrand_view)) @if ($regex->vehiclebrand_view == true) {{ 'checked' }} @endif
                                @endif
                                >
                              </td>
                              <td>
                                <input type="checkbox" class="vehiclebrand_{{ $i }}" name="vehiclebrand[]" value="vehiclebrand_add" @if (!empty($regex->vehiclebrand_add)) @if ($regex->vehiclebrand_add == true) {{ 'checked' }} @endif
                                @endif
                                >
                              </td>
                              <td>
                                <input type="checkbox" class="vehiclebrand_{{ $i }}" name="vehiclebrand[]" value="vehiclebrand_edit" @if (!empty($regex->vehiclebrand_edit)) @if ($regex->vehiclebrand_edit == true) {{ 'checked' }} @endif
                                @endif
                                >
                              </td>
                              <td>
                                <input type="checkbox" class="vehiclebrand_{{ $i }}" name="vehiclebrand[]" value="vehiclebrand_delete" @if (!empty($regex->vehiclebrand_delete)) @if ($regex->vehiclebrand_delete == true) {{ 'checked' }} @endif
                                @endif
                                >
                              </td>
                              <td>-</td>
                            </tr>
                            <!-- Vehicle Type Access Rights End -->

                            <!-- Color Access Rights Start -->
                            <tr>
                              <td>{{ trans('message.Colors') }}</td>
                              <td class="">
                                <input type="checkbox" data-row="{{ $i }}" class="main_access" data-for="colors" name="colors[]" value="colors_view" @if (!empty($regex->colors_view)) @if ($regex->colors_view == true) {{ 'checked' }} @endif
                                @endif
                                >
                              </td>
                              <td>
                                <input type="checkbox" class="colors_{{ $i }}" name="colors[]" value="colors_add" @if (!empty($regex->colors_add)) @if ($regex->colors_add == true) {{ 'checked' }} @endif
                                @endif
                                >
                              </td>
                              <td>
                                <input type="checkbox" class="colors_{{ $i }}" name="colors[]" value="colors_edit" @if (!empty($regex->colors_edit)) @if ($regex->colors_edit == true) {{ 'checked' }} @endif
                                @endif
                                >
                              </td>
                              <td>
                                <input type="checkbox" class="colors_{{ $i }}" name="colors[]" value="colors_delete" @if (!empty($regex->colors_delete)) @if ($regex->colors_delete == true) {{ 'checked' }} @endif
                                @endif
                                >
                              </td>
                              <td>-</td>
                            </tr>
                            <!-- Colors Access Rights End -->

                            <!-- Service Access Rights Start -->
                            <tr>
                              <td>{{ trans('message.Services') }}</td>
                              <td class="">
                                <input type="checkbox" data-row="{{ $i }}" class="main_access" data-for="service" name="service[]" value="service_view" @if (!empty($regex->service_view)) @if ($regex->service_view == true) {{ 'checked' }} @endif
                                @endif
                                >
                              </td>
                              <td>
                                <input type="checkbox" class="service_{{ $i }}" name="service[]" value="service_add" @if (!empty($regex->service_add)) @if ($regex->service_add == true) {{ 'checked' }} @endif
                                @endif
                                >
                              </td>
                              <td>
                                <input type="checkbox" class="service_{{ $i }}" name="service[]" value="service_edit" @if (!empty($regex->service_edit)) @if ($regex->service_edit == true) {{ 'checked' }} @endif
                                @endif
                                >
                              </td>
                              <td>
                                <input type="checkbox" class="service_{{ $i }}" name="service[]" value="service_delete" @if (!empty($regex->service_delete)) @if ($regex->service_delete == true) {{ 'checked' }} @endif
                                @endif
                                >
                              </td>
                              @if ($get_right->role_name == 'Employee' || $get_right->role_name == 'Support Staff' || $get_right->role_name == 'Accountant')
                              <td>
                                <input type="checkbox" class="service_{{ $i }}" name="service[]" value="service_owndata" @if (!empty($regex->service_owndata)) @if ($regex->service_owndata == true) {{ 'checked' }} @endif
                                @endif
                                >
                              </td>
                              @else
                              <td>-</td>
                              @endif

                            </tr>
                            <!-- Service Access Rights End -->

                            <!-- Quotation Module Access Rights Start -->
                            <tr>
                              <td>{{ trans('message.Quotation') }}</td>
                              <td class="">
                                <input type="checkbox" data-row="{{ $i }}" class="main_access" data-for="quotation" name="quotation[]" value="quotation_view" @if (!empty($regex->quotation_view)) @if ($regex->quotation_view == true) {{ 'checked' }} @endif
                                @endif
                                >
                              </td>
                              <td>
                                <input type="checkbox" class="quotation_{{ $i }}" name="quotation[]" value="quotation_add" @if (!empty($regex->quotation_add)) @if ($regex->quotation_add == true) {{ 'checked' }} @endif
                                @endif
                                >
                              </td>
                              <td>
                                <input type="checkbox" class="quotation_{{ $i }}" name="quotation[]" value="quotation_edit" @if (!empty($regex->quotation_edit)) @if ($regex->quotation_edit == true) {{ 'checked' }} @endif
                                @endif
                                >
                              </td>
                              <td>
                                <input type="checkbox" class="quotation_{{ $i }}" name="quotation[]" value="quotation_delete" @if (!empty($regex->quotation_delete)) @if ($regex->quotation_delete == true) {{ 'checked' }} @endif
                                @endif
                                >
                              </td>
                              @if ($get_right->role_name == 'Employee' || $get_right->role_name == 'Customer' || $get_right->role_name == 'Accountant')
                              <td>
                                <input type="checkbox" class="quotation_{{ $i }}" name="quotation[]" value="quotation_owndata" @if (!empty($regex->quotation_owndata)) @if ($regex->quotation_owndata == true) {{ 'checked' }} @endif
                                @endif
                                >
                              </td>
                              @else
                              <td>-</td>
                              @endif

                            </tr>
                            <!-- Quotation Module Access Rights End -->

                            <!-- Invoice Access Rights Start -->
                            <tr>
                              <td>{{ trans('message.Invoices') }}</td>
                              <td class="">
                                <input type="checkbox" data-row="{{ $i }}" class="main_access" data-for="invoice" name="invoice[]" value="invoice_view" @if (!empty($regex->invoice_view)) @if ($regex->invoice_view == true) {{ 'checked' }} @endif
                                @endif
                                >
                              </td>
                              <td>
                                <input type="checkbox" class="invoice_{{ $i }}" name="invoice[]" value="invoice_add" @if (!empty($regex->invoice_add)) @if ($regex->invoice_add == true) {{ 'checked' }} @endif
                                @endif
                                >
                              </td>
                              <td>
                                <input type="checkbox" class="invoice_{{ $i }}" name="invoice[]" value="invoice_edit" @if (!empty($regex->invoice_edit)) @if ($regex->invoice_edit == true) {{ 'checked' }} @endif
                                @endif
                                >
                              </td>
                              <td>
                                <input type="checkbox" class="invoice_{{ $i }}" name="invoice[]" value="invoice_delete" @if (!empty($regex->invoice_delete)) @if ($regex->invoice_delete == true) {{ 'checked' }} @endif
                                @endif
                                >
                              </td>
                              @if ($get_right->role_name == 'Customer' || $get_right->role_name == 'Accountant')
                              <td>
                                <input type="checkbox" class="invoice_{{ $i }}" name="invoice[]" value="invoice_owndata" @if (!empty($regex->invoice_owndata)) @if ($regex->invoice_owndata == true) {{ 'checked' }} @endif
                                @endif
                                >
                              </td>
                              @else
                              <td>-</td>
                              @endif

                            </tr>
                            <!-- Invoice Access Rights End -->

                            <!-- Jobcard Access Rights Start -->
                            <tr>
                              <td>{{ trans('message.Job Card') }}</td>
                              <td class="">
                                <input type="checkbox" data-row="{{ $i }}" class="main_access" data-for="jobcard" name="jobcard[]" value="jobcard_view" @if (!empty($regex->jobcard_view)) @if ($regex->jobcard_view == true) {{ 'checked' }} @endif
                                @endif
                                >
                              </td>
                              <td>
                                <input type="checkbox" class="jobcard_{{ $i }}" name="jobcard[]" value="jobcard_add" @if (!empty($regex->jobcard_add)) @if ($regex->jobcard_add == true) {{ 'checked' }} @endif
                                @endif
                                >
                              </td>
                              <td>
                                <input type="checkbox" class="jobcard_{{ $i }}" name="jobcard[]" value="jobcard_edit" @if (!empty($regex->jobcard_edit)) @if ($regex->jobcard_edit == true) {{ 'checked' }} @endif
                                @endif
                                >
                              </td>
                              <td>-</td>
                              @if ($get_right->role_name == 'Employee')
                              <td>
                                <input type="checkbox" class="jobcard_{{ $i }}" name="jobcard[]" value="jobcard_owndata" @if (!empty($regex->jobcard_owndata)) @if ($regex->jobcard_owndata == true) {{ 'checked' }} @endif
                                @endif
                                >
                              </td>
                              @else
                              <td>-</td>
                              @endif
                            </tr>
                            <!-- Jobcard Access Rights End -->

                            <!-- Gatepass Access Rights Start -->
                            <tr>
                              <td>{{ trans('message.Gatepass') }}</td>
                              <td class="">
                                <input type="checkbox" data-row="{{ $i }}" class="main_access" data-for="gatepass" name="gatepass[]" value="gatepass_view" @if (!empty($regex->gatepass_view)) @if ($regex->gatepass_view == true) {{ 'checked' }} @endif
                                @endif
                                >
                              </td>
                              <td>
                                <input type="checkbox" class="gatepass_{{ $i }}" name="gatepass[]" value="gatepass_add" @if (!empty($regex->gatepass_add)) @if ($regex->gatepass_add == true) {{ 'checked' }} @endif
                                @endif
                                >
                              </td>
                              <td>
                                <input type="checkbox" class="gatepass_{{ $i }}" name="gatepass[]" value="gatepass_edit" @if (!empty($regex->gatepass_edit)) @if ($regex->gatepass_edit == true) {{ 'checked' }} @endif
                                @endif
                                >
                              </td>
                              <td>
                                <input type="checkbox" class="gatepass_{{ $i }}" name="gatepass[]" value="gatepass_delete" @if (!empty($regex->gatepass_delete)) @if ($regex->gatepass_delete == true) {{ 'checked' }} @endif
                                @endif
                                >
                              </td>
                              <td>-</td>
                            </tr>
                            <!-- Gatepass Access Rights End -->

                            <!-- Taxrate Access Rights Start -->
                            <tr>
                              <td>{{ trans('message.Tax Rates') }}</td>
                              <td class="">
                                <input type="checkbox" data-row="{{ $i }}" class="main_access" data-for="taxrate" name="taxrate[]" value="taxrate_view" @if (!empty($regex->taxrate_view)) @if ($regex->taxrate_view == true) {{ 'checked' }} @endif
                                @endif
                                >
                              </td>
                              <td>
                                <input type="checkbox" class="taxrate_{{ $i }}" name="taxrate[]" value="taxrate_add" @if (!empty($regex->taxrate_add)) @if ($regex->taxrate_add == true) {{ 'checked' }} @endif
                                @endif
                                >
                              </td>
                              <td>
                                <input type="checkbox" class="taxrate_{{ $i }}" name="taxrate[]" value="taxrate_edit" @if (!empty($regex->taxrate_edit)) @if ($regex->taxrate_edit == true) {{ 'checked' }} @endif
                                @endif
                                >
                              </td>
                              <td>
                                <input type="checkbox" class="taxrate_{{ $i }}" name="taxrate[]" value="taxrate_delete" @if (!empty($regex->taxrate_delete)) @if ($regex->taxrate_delete == true) {{ 'checked' }} @endif
                                @endif
                                >
                              </td>
                              <td>-</td>
                            </tr>
                            <!-- Taxrate Access Rights End -->

                            <!-- Payment Method Access Rights Start -->
                            <tr>
                              <td>{{ trans('message.Payment Method') }}</td>
                              <td class="">
                                <input type="checkbox" data-row="{{ $i }}" class="main_access" data-for="paymentmethod" name="paymentmethod[]" value="paymentmethod_view" @if (!empty($regex->paymentmethod_view)) @if ($regex->paymentmethod_view == true) {{ 'checked' }} @endif
                                @endif
                                >
                              </td>
                              <td>
                                <input type="checkbox" class="paymentmethod_{{ $i }}" name="paymentmethod[]" value="paymentmethod_add" @if (!empty($regex->paymentmethod_add)) @if ($regex->paymentmethod_add == true) {{ 'checked' }} @endif
                                @endif
                                >
                              </td>
                              <td>
                                <input type="checkbox" class="paymentmethod_{{ $i }}" name="paymentmethod[]" value="paymentmethod_edit" @if (!empty($regex->paymentmethod_edit)) @if ($regex->paymentmethod_edit == true) {{ 'checked' }} @endif
                                @endif
                                >
                              </td>
                              <td>
                                <input type="checkbox" class="paymentmethod_{{ $i }}" name="paymentmethod[]" value="paymentmethod_delete" @if (!empty($regex->paymentmethod_delete)) @if ($regex->paymentmethod_delete == true) {{ 'checked' }} @endif
                                @endif
                                >
                              </td>
                              <td>-</td>
                            </tr>
                            <!-- Payment Method Access Rights End -->

                            <!-- Income Access Rights Start -->
                            <tr>
                              <td>{{ trans('message.Income') }}</td>
                              <td class="">
                                <input type="checkbox" data-row="{{ $i }}" class="main_access" data-for="income" name="income[]" value="income_view" @if (!empty($regex->income_view)) @if ($regex->income_view == true) {{ 'checked' }} @endif
                                @endif
                                >
                              </td>
                              <td>
                                <input type="checkbox" class="income_{{ $i }}" name="income[]" value="income_add" @if (!empty($regex->income_add)) @if ($regex->income_add == true) {{ 'checked' }} @endif
                                @endif
                                >
                              </td>
                              <td>
                                <input type="checkbox" class="income_{{ $i }}" name="income[]" value="income_edit" @if (!empty($regex->income_edit)) @if ($regex->income_edit == true) {{ 'checked' }} @endif
                                @endif
                                >
                              </td>
                              <td>
                                <input type="checkbox" class="income_{{ $i }}" name="income[]" value="income_delete" @if (!empty($regex->income_delete)) @if ($regex->income_delete == true) {{ 'checked' }} @endif
                                @endif
                                >
                              </td>
                              <td>-</td>
                            </tr>
                            <!-- Income Access Rights End -->

                            <!-- Expense Access Rights Start -->
                            <tr>
                              <td>{{ trans('message.Expenses') }}</td>
                              <td class="">
                                <input type="checkbox" data-row="{{ $i }}" class="main_access" data-for="expense" name="expense[]" value="expense_view" @if (!empty($regex->expense_view)) @if ($regex->expense_view == true) {{ 'checked' }} @endif
                                @endif
                                >
                              </td>
                              <td>
                                <input type="checkbox" class="expense_{{ $i }}" name="expense[]" value="expense_add" @if (!empty($regex->expense_add)) @if ($regex->expense_add == true) {{ 'checked' }} @endif
                                @endif
                                >
                              </td>
                              <td>
                                <input type="checkbox" class="expense_{{ $i }}" name="expense[]" value="expense_edit" @if (!empty($regex->expense_edit)) @if ($regex->expense_edit == true) {{ 'checked' }} @endif
                                @endif
                                >
                              </td>
                              <td>
                                <input type="checkbox" class="expense_{{ $i }}" name="expense[]" value="expense_delete" @if (!empty($regex->expense_delete)) @if ($regex->expense_delete == true) {{ 'checked' }} @endif
                                @endif
                                >
                              </td>
                              <td>-</td>
                            </tr>
                            <!-- Expense Access Rights End -->

                            <!-- Sales Access Rights Start -->
                            <!-- <tr>
                              <td>{{ trans('message.Vehicle Sells') }}</td>
                              <td class="">
                                <input type="checkbox" data-row="{{ $i }}" class="main_access" data-for="sales" name="sales[]" value="sales_view" @if (!empty($regex->sales_view)) @if ($regex->sales_view == true) {{ 'checked' }} @endif
                                @endif
                                >
                              </td>
                              <td>
                                <input type="checkbox" class="sales_{{ $i }}" name="sales[]" value="sales_add" @if (!empty($regex->sales_add)) @if ($regex->sales_add == true) {{ 'checked' }} @endif
                                @endif
                                >
                              </td>
                              <td>
                                <input type="checkbox" class="sales_{{ $i }}" name="sales[]" value="sales_edit" @if (!empty($regex->sales_edit)) @if ($regex->sales_edit == true) {{ 'checked' }} @endif
                                @endif
                                >
                              </td>
                              <td>
                                <input type="checkbox" class="sales_{{ $i }}" name="sales[]" value="sales_delete" @if (!empty($regex->sales_delete)) @if ($regex->sales_delete == true) {{ 'checked' }} @endif
                                @endif
                                >
                              </td>
                              <td>-</td>
                            </tr> -->
                            <!-- Sales Access Rights End -->

                            <!-- Sales Part Module Access Rights Start -->
                            <tr>
                              <td>{{ trans('message.Part Sells') }}</td>
                              <td class="">
                                <input type="checkbox" data-row="{{ $i }}" class="main_access" data-for="salespart" name="salespart[]" value="salespart_view" @if (!empty($regex->salespart_view)) @if ($regex->salespart_view == true) {{ 'checked' }} @endif
                                @endif
                                >
                              </td>
                              <td>
                                <input type="checkbox" class="salespart_{{ $i }}" name="salespart[]" value="salespart_add" @if (!empty($regex->salespart_add)) @if ($regex->salespart_add == true) {{ 'checked' }} @endif
                                @endif
                                >
                              </td>
                              <td>
                                <input type="checkbox" class="salespart_{{ $i }}" name="salespart[]" value="salespart_edit" @if (!empty($regex->salespart_edit)) @if ($regex->salespart_edit == true) {{ 'checked' }} @endif
                                @endif
                                >
                              </td>
                              <!-- <td>
                                <input type="checkbox" class="salespart_{{ $i }}" name="salespart[]" value="salespart_delete" @if (!empty($regex->salespart_delete)) @if ($regex->salespart_delete == true) {{ 'checked' }} @endif
                                @endif
                                >
                              </td> -->
                              <td>-</td>
                              <td>-</td>
                            </tr>
                            <!-- Sales Part Module Access Rights End -->

                            <!-- Compliances (RTO) Module Access Rights Start -->
                            <tr>
                              <td>{{ trans('message.Compliances') }}</td>
                              <td class="">
                                <input type="checkbox" data-row="{{ $i }}" class="main_access" data-for="rto" name="rto[]" value="rto_view" @if (!empty($regex->rto_view)) @if ($regex->rto_view == true) {{ 'checked' }} @endif
                                @endif
                                >
                              </td>
                              <td>
                                <input type="checkbox" class="rto_{{ $i }}" name="rto[]" value="rto_add" @if (!empty($regex->rto_add)) @if ($regex->rto_add == true) {{ 'checked' }} @endif
                                @endif
                                >
                              </td>
                              <td>
                                <input type="checkbox" class="rto_{{ $i }}" name="rto[]" value="rto_edit" @if (!empty($regex->rto_edit)) @if ($regex->rto_edit == true) {{ 'checked' }} @endif
                                @endif
                                >
                              </td>
                              <td>
                                <input type="checkbox" class="rto_{{ $i }}" name="rto[]" value="rto_delete" @if (!empty($regex->rto_delete)) @if ($regex->rto_delete == true) {{ 'checked' }} @endif
                                @endif
                                >
                              </td>
                              <td>-</td>
                            </tr>
                            <!-- Compliances(RTO) Module Access Rights End -->

                            <!-- Reports Module Access Rights Start -->
                            <tr>
                              <td>{{ trans('message.Reports') }}</td>
                              <td class="">
                                <input type="checkbox" data-row="{{ $i }}" class="main_access" data-for="report" name="report[]" value="report_view" @if (!empty($regex->report_view)) @if ($regex->report_view == true) {{ 'checked' }} @endif
                                @endif
                                >
                              </td>
                              <td>-</td>
                              <td>-</td>
                              <td>-</td>
                              <td>-</td>
                            </tr>
                            <!-- Reports Module Access Rights End -->

                            <!-- Email Templates Module Access Rights Start -->
                            <tr>
                              <td>{{ trans('message.Email Templates') }}</td>
                              <td class="">
                                <input type="checkbox" data-row="{{ $i }}" class="main_access" data-for="emailtemplate" name="emailtemplate[]" value="emailtemplate_view" @if (!empty($regex->emailtemplate_view)) @if ($regex->emailtemplate_view == true) {{ 'checked' }} @endif
                                @endif
                                >
                              </td>
                              <td>-</td>
                              <td>
                                <input type="checkbox" class="emailtemplate_{{ $i }}" name="emailtemplate[]" value="emailtemplate_edit" @if (!empty($regex->emailtemplate_edit)) @if ($regex->emailtemplate_edit == true) {{ 'checked' }} @endif
                                @endif
                                >
                              </td>
                              <td>-</td>
                              <td>-</td>
                            </tr>
                            <!-- Email Templates Module Access Rights End -->

                            <!-- Custom Field Module Access Rights Start -->
                            <tr>
                              <td>{{ trans('message.Custom Fields') }}</td>
                              <td class="">
                                <input type="checkbox" data-row="{{ $i }}" class="main_access" data-for="customfield" name="customfield[]" value="customfield_view" @if (!empty($regex->customfield_view)) @if ($regex->customfield_view == true) {{ 'checked' }} @endif
                                @endif
                                >
                              </td>
                              <td>
                                <input type="checkbox" class="customfield_{{ $i }}" name="customfield[]" value="customfield_add" @if (!empty($regex->customfield_add)) @if ($regex->customfield_add == true) {{ 'checked' }} @endif
                                @endif
                                >
                              </td>
                              <td>
                                <input type="checkbox" class="customfield_{{ $i }}" name="customfield[]" value="customfield_edit" @if (!empty($regex->customfield_edit)) @if ($regex->customfield_edit == true) {{ 'checked' }} @endif
                                @endif
                                >
                              </td>
                              <td>
                                <input type="checkbox" class="customfield_{{ $i }}" name="customfield[]" value="customfield_delete" @if (!empty($regex->customfield_delete)) @if ($regex->customfield_delete == true) {{ 'checked' }} @endif
                                @endif
                                >
                              </td>
                              <td>-</td>
                            </tr>
                            <!-- Custom Field Module Access Rights End -->

                            <!-- Observation Library Module Access Rights Start -->
                            <tr>
                              <td>{{ trans('message.Observation Library') }}</td>
                              <td class="">
                                <input type="checkbox" data-row="{{ $i }}" class="main_access" data-for="observationlibrary" name="observationlibrary[]" value="observationlibrary_view" @if (!empty($regex->observationlibrary_view)) @if ($regex->observationlibrary_view == true) {{ 'checked' }} @endif
                                @endif
                                >
                              </td>
                              <td>
                                <input type="checkbox" class="observationlibrary_{{ $i }}" name="observationlibrary[]" value="observationlibrary_add" @if (!empty($regex->observationlibrary_add)) @if ($regex->observationlibrary_add == true) {{ 'checked' }} @endif
                                @endif
                                >
                              </td>
                              <td>
                                <input type="checkbox" class="observationlibrary_{{ $i }}" name="observationlibrary[]" value="observationlibrary_edit" @if (!empty($regex->observationlibrary_edit)) @if ($regex->observationlibrary_edit == true) {{ 'checked' }} @endif
                                @endif
                                >
                              </td>
                              <td>
                                <input type="checkbox" class="observationlibrary_{{ $i }}" name="observationlibrary[]" value="observationlibrary_delete" @if (!empty($regex->observationlibrary_delete)) @if ($regex->observationlibrary_delete == true) {{ 'checked' }} @endif
                                @endif
                                >
                              </td>
                              <td>-</td>
                            </tr>
                            <!-- Observation Library Module Access Rights End -->

                            <!-- Branch Module Access Rights Start -->
                            <tr>
                              <td>{{ trans('message.Branch') }}</td>
                              <td class="">
                                <input type="checkbox" data-row="{{ $i }}" class="main_access" data-for="branch" name="branch[]" value="branch_view" @if (!empty($regex->branch_view)) @if ($regex->branch_view == true) {{ 'checked' }} @endif
                                @endif
                                >
                              </td>
                              <td>
                                <input type="checkbox" class="branch_{{ $i }}" name="branch[]" value="branch_add" @if (!empty($regex->branch_add)) @if ($regex->branch_add == true) {{ 'checked' }} @endif
                                @endif
                                >
                              </td>
                              <td>
                                <input type="checkbox" class="branch_{{ $i }}" name="branch[]" value="branch_edit" @if (!empty($regex->branch_edit)) @if ($regex->branch_edit == true) {{ 'checked' }} @endif
                                @endif
                                >
                              </td>
                              <td>
                                <input type="checkbox" class="branch_{{ $i }}" name="branch[]" value="branch_delete" @if (!empty($regex->branch_delete)) @if ($regex->branch_delete == true) {{ 'checked' }} @endif
                                @endif
                                >
                              </td>
                              <td>-</td>
                            </tr>
                            <!-- Branch Module Access Rights End -->

                            <!-- General Setting Module Access Rights Start -->
                            <tr>
                              <td>{{ trans('message.General Settings') }}</td>
                              <td class="">
                                <input type="checkbox" data-row="{{ $i }}" class="main_access" data-for="generalsetting" name="generalsetting[]" value="generalsetting_view" @if (!empty($regex->generalsetting_view)) @if ($regex->generalsetting_view == true) {{ 'checked' }} @endif
                                @endif
                                >
                              </td>
                              <td>-</td>
                              <td>
                                <input type="checkbox" class="generalsetting_{{ $i }}" name="generalsetting[]" value="generalsetting_edit" @if (!empty($regex->generalsetting_edit)) @if ($regex->generalsetting_edit == true) {{ 'checked' }} @endif
                                @endif
                                >
                              </td>
                              <td>-</td>
                              <td>-</td>
                            </tr>
                            <!-- General Setting Module Access Rights End -->

                            <!-- Timezone Module Access Rights Start -->
                            <tr>
                              <td>{{ trans('message.Other Setting [Timezone]') }}</td>
                              <td class="">
                                <input type="checkbox" data-row="{{ $i }}" class="main_access" data-for="timezone" name="timezone[]" value="timezone_view" @if (!empty($regex->timezone_view)) @if ($regex->timezone_view == true) {{ 'checked' }} @endif
                                @endif
                                >
                              </td>
                              <td>-</td>
                              <td>
                                <input type="checkbox" class="timezone_{{ $i }}" name="timezone[]" value="timezone_edit" @if (!empty($regex->timezone_edit)) @if ($regex->timezone_edit == true) {{ 'checked' }} @endif
                                @endif
                                >
                              </td>
                              <td>-</td>
                              <td>-</td>
                            </tr>
                            <!-- Timezone Module Access Rights End -->

                            <!-- Language Module Access Rights Start -->
                            <tr>
                              <td>{{ trans('message.Other Setting [Language]') }}</td>
                              <td class="">
                                <input type="checkbox" data-row="{{ $i }}" class="main_access" data-for="language" name="language[]" value="language_view" @if (!empty($regex->language_view)) @if ($regex->language_view == true) {{ 'checked' }} @endif
                                @endif
                                >
                              </td>
                              <td>-</td>
                              <td>
                                <input type="checkbox" class="language_{{ $i }}" name="language[]" value="language_edit" @if (!empty($regex->language_edit)) @if ($regex->language_edit == true) {{ 'checked' }} @endif
                                @endif
                                >
                              </td>
                              <td>-</td>
                              <td>-</td>
                            </tr>
                            <!-- Language Module Access Rights End -->

                            <!-- Date Format Module Access Rights Start -->
                            <tr>
                              <td>{{ trans('message.Other Setting [Date Format]') }}</td>
                              <td class="">
                                <input type="checkbox" data-row="{{ $i }}" class="main_access" data-for="dateformat" name="dateformat[]" value="dateformat_view" @if (!empty($regex->dateformat_view)) @if ($regex->dateformat_view == true) {{ 'checked' }} @endif
                                @endif
                                >
                              </td>
                              <td>-</td>
                              <td>
                                <input type="checkbox" class="dateformat_{{ $i }}" name="dateformat[]" value="dateformat_edit" @if (!empty($regex->dateformat_edit)) @if ($regex->dateformat_edit == true) {{ 'checked' }} @endif
                                @endif
                                >
                              </td>
                              <td>-</td>
                              <td>-</td>
                            </tr>
                            <!-- Date Format Module Access Rights End -->

                            <!-- Currency Module Access Rights Start -->
                            <tr>
                              <td>{{ trans('message.Other Setting [Currency]') }}</td>
                              <td class="">
                                <input type="checkbox" data-row="{{ $i }}" class="main_access" data-for="currency" name="currency[]" value="currency_view" @if (!empty($regex->currency_view)) @if ($regex->currency_view == true) {{ 'checked' }} @endif
                                @endif
                                >
                              </td>
                              <td>-</td>
                              <td>
                                <input type="checkbox" class="currency_{{ $i }}" name="currency[]" value="currency_edit" @if (!empty($regex->currency_edit)) @if ($regex->currency_edit == true) {{ 'checked' }} @endif
                                @endif
                                >
                              </td>
                              <td>-</td>
                              <td>-</td>
                            </tr>
                            <!-- Currency Module Access Rights End -->

                            <!-- Access Rights Module Access Rights Start -->
                            <tr>
                              <td>{{ trans('message.Access Rights') }}</td>
                              <td class="">
                                <input type="checkbox" data-row="{{ $i }}" class="main_access" data-for="accessrights" name="accessrights[]" value="accessrights_view" @if (!empty($regex->accessrights_view)) @if ($regex->accessrights_view == true) {{ 'checked' }} @endif
                                @endif
                                >
                              </td>
                              <td>-</td>
                              <td>
                                <input type="checkbox" class="accessrights_{{ $i }}" name="accessrights[]" value="accessrights_edit" @if (!empty($regex->accessrights_edit)) @if ($regex->accessrights_edit == true) {{ 'checked' }} @endif
                                @endif
                                >
                              </td>
                              <td>-</td>
                              <td>-</td>
                            </tr>
                            <!-- Currency Module Access Rights End -->

                            <!-- Business Hours Module Access Rights Start -->
                            <tr>
                              <td>{{ trans('message.Business Hours') }}</td>
                              <td class="">
                                <input type="checkbox" data-row="{{ $i }}" class="main_access" data-for="businesshours" name="businesshours[]" value="businesshours_view" @if (!empty($regex->businesshours_view)) @if ($regex->businesshours_view == true) {{ 'checked' }} @endif
                                @endif
                                >
                              </td>
                              <td>
                                <input type="checkbox" class="businesshours_{{ $i }}" name="businesshours[]" value="businesshours_add" @if (!empty($regex->businesshours_add)) @if ($regex->businesshours_add == true) {{ 'checked' }} @endif
                                @endif
                                >
                              </td>
                              <td>
                                <input type="checkbox" class="businesshours_{{ $i }}" name="businesshours[]" value="businesshours_delete" @if (!empty($regex->businesshours_delete)) @if ($regex->businesshours_delete == true) {{ 'checked' }} @endif
                                @endif
                                >
                              </td>
                              <td>-</td>
                              <td>-</td>
                            </tr>
                            <!-- Business Hours Module Access Rights End -->

                            <!-- Stripe Setting Module Access Rights Start -->
                            <tr>
                              <td>{{ trans('message.Stripe Settings') }}</td>
                              <td class="">
                                <input type="checkbox" data-row="{{ $i }}" class="main_access" data-for="stripesetting" name="stripesetting[]" value="stripesetting_view" @if (!empty($regex->stripesetting_view)) @if ($regex->stripesetting_view == true) {{ 'checked' }} @endif
                                @endif
                                >
                              </td>
                              <td>-</td>
                              <td>
                                <input type="checkbox" class="stripesetting_{{ $i }}" name="stripesetting[]" value="stripesetting_edit" @if (!empty($regex->stripesetting_edit)) @if ($regex->stripesetting_edit == true) {{ 'checked' }} @endif
                                @endif
                                >
                              </td>
                              <td>-</td>
                              <td>-</td>
                            </tr>
                            <!-- Stripe Setting Module Access Rights End -->

                            <!-- Branch Setting Module Access Rights Start -->
                            <tr>
                              <td>{{ trans('message.Branch Setting') }}</td>
                              <td class="">
                                <input type="checkbox" data-row="{{ $i }}" class="main_access" data-for="branchsetting" name="branchsetting[]" value="branchsetting_view" @if (!empty($regex->branchsetting_view)) @if ($regex->branchsetting_view == true) {{ 'checked' }} @endif
                                @endif
                                >
                              </td>
                              <td>
                                <input type="checkbox" class="branchsetting_{{ $i }}" name="branchsetting[]" value="branchsetting_edit" @if (!empty($regex->branchsetting_edit)) @if ($regex->branchsetting_edit == true) {{ 'checked' }} @endif
                                @endif
                                >
                              </td>
                              <td>-</td>
                              <td>-</td>
                              <td>-</td>
                            </tr>
                            <!-- Branch Setting Module Access Rights End -->

                          </tbody>
                        </table>
                      </div>

                      @can('accessrights_edit')
                      <div class="col-md-12 col-sm-12 col-xs-12 text-center submitButtonDiv">
                        <button type="submit" class="btn btn-success">{{ trans('message.Submit') }}</button>
                      </div>
                      @endcan


                    </form>
                  </div>
                </div>
              </div>
              @endforeach
            </div>
          </div>
          <!-- SUPER ADMIN Accordion Ending -->
        </div>
      </div>
    </div>
  </div>
</div>
<!-- page content end -->

<script src="{{ URL::asset('vendors/jquery/dist/jquery.min.js') }}"></script>
<!-- Adding by me(New) -->
<script src="{{ URL::asset('public/js/custom/accessrights/accessRightsJsFile.js') }}"></script>

<!-- language change in user selected  (For Jumbo_Table Inside of SUPER ADMIN (New))-->
<script>
  $(document).ready(function() {
    var url = "{{ URL::to('/public/datatable_localization/' . getLanguageChange() . '.json') }}";
    $('#supplier').DataTable({
      responsive: true,
      "paging": false,
      "ordering": false,
      "searching": false,
      "info": false,
      "language": {

        "url": url
      },
      aoColumnDefs: [{
        bSortable: false,
        aTargets: [-1]
      }]
    });
  });

  $(function() {

    function toggleIcon(e) {
      $(e.target)
        .prev('.panel-heading')
        .find(".plus-minus")
        .toggleClass('glyphicon-plus glyphicon-minus');
    }

    $('.panel-group').on('hidden.bs.collapse', toggleIcon);
    $('.panel-group').on('shown.bs.collapse', toggleIcon);
  });
</script>
@endsection