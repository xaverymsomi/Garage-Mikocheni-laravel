@extends('layouts.app')
@section('content')
<style>
  @media screen and (max-width:540px) {
    div#jobcard_info {
      margin-top: -177px;
    }

    span.titleup {
      margin-left: -10px;
    }
  }
</style>
<!-- page content -->
<div class="right_col" role="main">
  <div id="myModal-job" class="modal fade setTableSizeForSmallDevices" role="dialog">
    <div class="modal-dialog modal-lg">
      <!-- Modal content-->
      <div class="modal-content modal-body-data">
      </div>
    </div>
  </div>
  <!--gate pass-->

  <div id="myModal-gate" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg modal-xs">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <h4 id="myLargeModalLabel" class="modal-title">{{ getNameSystem() }}</h4>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">

        </div>
      </div>
    </div>
  </div>

  <script type="text/javascript">
    function PrintElem(elem) {
      Popup($(elem).html());
    }

    function Popup(data) {
      var mywindow = window.open('', 'Print Expense Invoice', 'height=600,width=1000');

      mywindow.document.write(data);


      mywindow.document.close();
      mywindow.focus();

      mywindow.print();
      mywindow.close();

      return true;
    }
  </script>
  <!--end of gate pass-->

  <!--create invoice-->
  <div class="modal fade" id="myModal1" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content modal-body-data">
        <div class="modal-header">
          <h4 class="modal-title" id="exampleModalLabel1">{{ trans('message.Create Invoice') }}</h4>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">{{ trans('message.Close') }}</button>
        </div>
      </div>
    </div>
  </div>
  <!--end of create invoice-->

  <div class="">
    <div class="page-title">
      <div class="nav_menu">
        <nav>
          <div class="nav toggle">
            <a id="menu_toggle"><i class="fa fa-bars sidemenu_toggle"></i></a>
            <span class="titleup">{{ trans('message.JobCard') }}
              @can('jobcard_add')
              <a href="{!! url('/service/add') !!}" id="">
                <img src="{{ URL::asset('public/img/icons/plus Button.png') }}" class="mb-2">
              </a>
              @endcan
            </span>
          </div>

          @include('dashboard.profile')
        </nav>
      </div>
    </div>
    @include('success_message.message')
    <div class="row">
    @if(!empty($services) && count($services) > 0)
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel table_up_div">
          <table id="supplier" class="table jambo_table" style="width: 100px;">
            <thead>
              <tr>
                <!-- <th> </th> -->
                <th>{{ trans('message.Job Card No') }}.</th>
                <th>{{ trans('message.Customer Name') }}</th>
                <th>{{ trans('message.Service Date') }}</th>
                <th>{{ trans('message.Status') }}</th>
                @canany(['invoice_add', 'invoice_view', 'jobcard_edit','jobcard_delete', 'gatepass_add', 'gatepass_view'])
                <th>{{ trans('message.Action') }}</th>
                @endcanany
              </tr>
            </thead>
            <tbody>
              @if (!empty($services))
              <?php $i = 1; ?>
              @foreach ($services as $servicess)
              <tr>
                <!-- <td>
                  <label class="container">
                    <input type="checkbox" name="chk">
                    <span class="checkmark"></span>
                  </label>
                </td> -->
                <td>{{ $servicess->job_no }} 
                  <!-- <a data-toggle="tooltip" data-placement="bottom" title="Job Card No." class="text-primary"><i class="fa fa-info-circle" style="color:#D9D9D9"></i></a> -->
                </td>
                <td>{{ getCustomerName($servicess->customer_id) }} 
                  <!-- <a data-toggle="tooltip" data-placement="bottom" title="Customer Name" class="text-primary"><i class="fa fa-info-circle" style="color:#D9D9D9"></i></a> -->
                </td>
                <?php $dateservice = date('Y-m-d', strtotime($servicess->service_date)); ?>
                @if (strpos($available, $dateservice) !== false)
                <td>
                  <span class="label  label-danger" style="font-size:13px;">{{ date(getDateFormat(), strtotime($dateservice)) }} 
                    <!-- <a data-toggle="tooltip" data-placement="bottom" title="Service Date" class="text-primary"><i class="fa fa-info-circle" style="color:#D9D9D9"></i></a> -->
                  </span>
                </td>
                @else
                <td>{{ date(getDateFormat(), strtotime($dateservice)) }} 
                  <!-- <a data-toggle="tooltip" data-placement="bottom" title="Service Date" class="text-primary"><i class="fa fa-info-circle" style="color:#D9D9D9"></i></a> -->
                </td>
                @endif
                <td>
                  <?php if ($servicess->done_status == 0) {
                    echo '<span style="color: rgb(255, 0, 0);">' . trans('message.Open') . '</span>';
                  } elseif ($servicess->done_status == 1) {
                    echo '<span style="color: rgb(0, 128, 0);">' . trans('message.Completed') . '</span>';
                  } elseif ($servicess->done_status == 2) {
                    echo '<span style="color: rgb(255, 165, 0);">' . trans('message.Progress') . '</span>';
                  } ?>
                  <!-- <a data-toggle="tooltip" data-placement="bottom" title="Status" class="text-primary"><i class="fa fa-info-circle" style="color:#D9D9D9"></i></a> -->
                </td>
                
                @canany(['invoice_add', 'invoice_view', 'jobcard_edit', 'jobcard_delete', 'gatepass_add', 'gatepass_view'])
                <td>
                  <div class="dropdown_toggle">
                    <img src="{{ URL::asset('public/img/list/dots.png') }}" class="btn dropdown-toggle border-0" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                    <ul class="dropdown-menu heder-dropdown-menu action_dropdown shadow py-2" aria-labelledby="dropdownMenuButton1">
                      @if (getUserRoleFromUserTable(Auth::User()->id) == 'admin' || getUserRoleFromUserTable(Auth::User()->id) == 'supportstaff' || getUserRoleFromUserTable(Auth::User()->id) == 'accountant' || getUserRoleFromUserTable(Auth::User()->id) == 'employee' || getUserRoleFromUserTable(Auth::User()->id) == 'branch_admin')
                        @if (Gate::allows('jobcard_view') && Gate::allows('jobcard_edit') && Gate::allows('jobcard_add'))
                        @can('jobcard_view')
                          <?php
                            $view_data = getInvoiceStatus($servicess->job_no);
                            if ($view_data == "No") {
                              if ($servicess->done_status == '1') { ?>
                                <!-- <li><a href="{{ url('invoice/add/' . $servicess->id) }}" class="dropdown-item"><img src="{{ URL::asset('public/img/list/create.png') }}" class="me-3"> {{ trans('message.Create Invoice') }}</a></li> -->
                                @can('invoice_add')
                                  <button type="button" data-bs-toggle="modal" data-bs-target="#myModal1" class="dropdown-item invoice" serviceid="{{ $servicess->id }}" job_no="{{ $servicess->job_no }}" url="{!! url('/jobcard/invoice') !!}"><img src="{{ URL::asset('public/img/list/create.png') }}" class="me-3"> {{ trans('message.Create Invoice') }} </button>
                                @endcan
                                <?php  } elseif ($servicess->done_status != '1') { ?>
                                  <!-- <li><a class="dropdown-item"><img src="{{ URL::asset('public/img/list/create.png') }}" class="me-3"> {{ trans('message.Create Invoice') }} </a></li> -->
                                  <?php } } else { ?>
                        
                                @can('invoice_view')

                                {{-- <li>
                                  <button type="button" data-bs-toggle="modal" data-bs-target="#myModal-job" serviceid="{{ $servicess->id }}" job_no="{{ $servicess->job_no }}" url="{!! url('/jobcard/modalview') !!}" class="dropdown-item save"><img src="{{ URL::asset('public/img/list/Vector.png') }}" class="me-3"> {{ trans('message.View Invoice') }} </button>
                                </li> --}}

                                @endcan <?php } ?>
                      @endcan
 
                      <?php $jobcard = getJobcardStatus($servicess->job_no);
                      $view_data = getInvoiceStatus($servicess->job_no);
                      ?>

                      @can('jobcard_edit')
                      @if ($jobcard == 1)
                      <li><a href="{{ url('jobcard/complete/' . $servicess->id) }}" class="dropdown-item"><img src="{{ URL::asset('public/img/list/jobprocess.png') }}" class="me-3">{{ trans('message.Job Completed') }}</a></li>
                      @elseif($view_data == 'Yes')
                      <li><a href="{{ url('jobcard/complete/' . $servicess->id) }}" class="dropdown-item"><img src="{{ URL::asset('public/img/list/jobprocess.png') }}" class="me-3">{{ trans('message.Job Completed') }}</a></li>
                      @else
                      <li><a href="{{ url('jobcard/list/' . $servicess->id) }}" class="dropdown-item"><img src="{{ URL::asset('public/img/list/jobprocess.png') }}" class="me-3">{{ trans('message.Process Job') }}</a></li>
                      <li>
                        <form action="{{ route('jobcard.destroy', $servicess->id) }}" method="POST" onsubmit="return confirm('{{ trans('Are you sure you want to delete this Job Card?') }}');">
                          @csrf
                          @method('DELETE')
                          <button type="submit" class="dropdown-item"><img src="{{ URL::asset('public/img/list/delete.png') }}" class="me-3">{{ trans('Delete Job Card') }}</button>
                        </form>
                      </li>
                      @endif
                      @if (getAlreadypasss($servicess->job_no) == 0 && $view_data == 'Yes')
                      @can('gatepass_add')
                      <li><a href="{!! url('/jobcard/gatepass/' . $servicess->id) !!}" class="dropdown-item"><img src="{{ URL::asset('public/img/list/gatepass.png') }}" class="me-3">{{ trans('message.Gate Pass') }}</a></li>
                      <li>
                        <form action="{{ route('jobcard.destroy', $servicess->id) }}" method="POST" onsubmit="return confirm('{{ trans('Are you sure you want to delete this Job Card?') }}');">
                          @csrf
                          @method('DELETE')
                          <button type="submit" class="dropdown-item"><img src="{{ URL::asset('public/img/list/delete.png') }}" class="me-3">{{ trans('Delete Job Card') }}</button>
                        </form>
                      </li>
                      @endcan
                      @elseif($view_data == 'No')
                      <!-- <a class="dropdown-item"><img src="{{ URL::asset('public/img/list/gatepass.png') }}" class="me-3"> {{ trans('message.Gate Pass') }}</a> -->
                      @elseif(getAlreadypasss($servicess->job_no) == 1)
                      @can('gatepass_view')
                      <li><button type="button" data-bs-toggle="modal" data-bs-target="#myModal-gate" serviceid="" class="dropdown-item getgetpass" getid="{{ $servicess->job_no }}"><img src="{{ URL::asset('public/img/list/receipt.png') }}" class="me-3">{{ trans('message.Gate Receipt') }}</li>
                        <li>
                          <form action="{{ route('jobcard.destroy', $servicess->id) }}" method="POST" onsubmit="return confirm('{{ trans('Are you sure you want to delete this Job Card?') }}');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="dropdown-item"><img src="{{ URL::asset('public/img/list/delete.png') }}" class="me-3">{{ trans('Delete Job Card') }}</button>
                          </form>
                        </li>
                      @endcan
                      @endif
                      @endcan
                      @elseif(getUserRoleFromUserTable(Auth::User()->id) == 'supportstaff' || getUserRoleFromUserTable(Auth::User()->id) == 'accountant' || getUserRoleFromUserTable(Auth::User()->id) == 'employee')
                      @can('jobcard_view')
                      <?php
                      $view_data = getInvoiceStatus($servicess->job_no);

                      if ($view_data == "Yes") {
                      ?>
                      @can('invoice_view')

                        {{-- <li><button type="button" data-bs-toggle="modal" data-bs-target="#myModal-job" serviceid="{{ $servicess->id }}" job_no="{{ $servicess->job_no }}" url="{!! url('/jobcard/modalview') !!}" class="dropdown-item save"><img src="{{ URL::asset('public/img/list/Vector.png') }}" class="me-3"> {{ trans('message.View Invoice') }} </button></li> --}}

                      @endcan
                      <?php
                      } else {
                      ?>
                      @can('invoice_view')

                        {{-- <li><button type="button" data-bs-toggle="modal" data-bs-target="#myModal-job" serviceid="{{ $servicess->id }}" job_no="{{ $servicess->job_no }}" url="{!! url('/jobcard/modalview') !!}" class="dropdown-item save" disabled><img src="{{ URL::asset('public/img/list/Vector.png') }}" class="me-3"> {{ trans('message.View Invoice') }} </button></li> --}}

                      @endcan
                      <?php
                      }
                      ?>
                      @endcan

                      <?php
                      $jobcard = getJobcardStatus($servicess->job_no);
                      $view_data = getInvoiceStatus($servicess->job_no);
                      ?>

                      @can('jobcard_edit')
                      @if ($jobcard == 1)
                      <li><a href="{{ url('jobcard/list/' . $servicess->id) }}" class="dropdown-item"><img src="{{ URL::asset('public/img/list/jobprocess.png') }}" class="me-3">{{ trans('message.Process Job') }}</a></li>
                      @elseif($view_data == 'Yes')
                      <li><a href="{{ url('jobcard/list/' . $servicess->id) }}" class="dropdown-item"><img src="{{ URL::asset('public/img/list/jobprocess.png') }}" class="me-3">{{ trans('message.Process Job') }}</a></li>
                      
                      @else
                      <li><a href="{{ url('jobcard/list/' . $servicess->id) }}" class="dropdown-item"><img src="{{ URL::asset('public/img/list/jobprocess.png') }}" class="me-3">{{ trans('message.Process Job') }}</a></li>
                      
                      <li>
                        <form action="{{ route('jobcard.destroy', $servicess->id) }}" method="POST" onsubmit="return confirm('{{ trans('Are you sure you want to delete this Job Card?') }}');">
                          @csrf
                          @method('DELETE')
                          <button type="submit" class="dropdown-item"><img src="{{ URL::asset('public/img/list/delete.png') }}" class="me-3">{{ trans('Delete Job Card') }}</button>
                        </form>
                      </li>
                      @endif
                      

                      @if (getAlreadypasss($servicess->job_no) == 0 && $view_data == 'Yes')
                      @can('gatepass_add')
                      <li><a href="{!! url('/jobcard/gatepass/' . $servicess->id) !!}" class="dropdown-item"><img src="{{ URL::asset('public/img/list/gatepass.png') }}" class="me-3">{{ trans('message.Gate Pass') }}</a></li>
                      <li>
                        <form action="{{ route('jobcard.destroy', $servicess->id) }}" method="POST" onsubmit="return confirm('{{ trans('Are you sure you want to delete this Job Card?') }}');">
                          @csrf
                          @method('DELETE')
                          <button type="submit" class="dropdown-item"><img src="{{ URL::asset('public/img/list/delete.png') }}" class="me-3">{{ trans('Delete Job Card') }}</button>
                        </form>
                      </li>
                      @endcan
                      @elseif($view_data == 'No')
                      @can('gatepass_add')
                      <li><a href="{!! url('/jobcard/gatepass/' . $servicess->id) !!}" class="dropdown-item"><img src="{{ URL::asset('public/img/list/gatepass.png') }}" class="me-3">{{ trans('message.Gate Pass') }}</a></li>
                      <li>
                        <form action="{{ route('jobcard.destroy', $servicess->id) }}" method="POST" onsubmit="return confirm('{{ trans('Are you sure you want to delete this Job Card?') }}');">
                          @csrf
                          @method('DELETE')
                          <button type="submit" class="dropdown-item"><img src="{{ URL::asset('public/img/list/delete.png') }}" class="me-3">{{ trans('Delete Job Card') }}</button>
                        </form>
                      </li>
                      @endcan
                      @elseif(getAlreadypasss($servicess->job_no) == 1)
                      @can('gatepass_view')
                      <li><button type="button" data-bs-toggle="modal" data-bs-target="#myModal-gate" serviceid="" class="dropdown-item getgetpass" getid="{{ $servicess->job_no }}"><img src="{{ URL::asset('public/img/list/receipt.png') }}" class="me-3">{{ trans('message.Gate Receipt') }}</button></li>

                      <li>
                        <form action="{{ route('jobcard.destroy', $servicess->id) }}" method="POST" onsubmit="return confirm('{{ trans('Are you sure you want to delete this Job Card?') }}');">
                          @csrf
                          @method('DELETE')
                          <button type="submit" class="dropdown-item"><img src="{{ URL::asset('public/img/list/delete.png') }}" class="me-3">{{ trans('Delete Job Card') }}</button>
                        </form>
                      </li>
                      @endcan
                      @endif
                      @endcan
                      @endif
                      @elseif(getUserRoleFromUserTable(Auth::User()->id) == 'Customer')
                      @if (Gate::allows('jobcard_view') && Gate::allows('jobcard_add') && Gate::allows('jobcard_edit'))
                      @can('jobcard_view')
                      <?php
                      $view_data = getInvoiceStatus($servicess->job_no);

                      if ($view_data == "No") {
                        if ($servicess->done_status == '1') {
                      ?>
                        @can('invoice_add')
                          <button type="button" data-bs-toggle="modal" data-bs-target="#myModal1" class="dropdown-item invoice" serviceid="{{ $servicess->id }}" job_no="{{ $servicess->job_no }}" url="{!! url('/jobcard/invoice') !!}"><img src="{{ URL::asset('public/img/list/create.png') }}" class="me-3"> {{ trans('message.Create Invoice') }} </button>
                          <li>
                            <form action="{{ route('jobcard.destroy', $servicess->id) }}" method="POST" onsubmit="return confirm('{{ trans('Are you sure you want to delete this Job Card?') }}');">
                              @csrf
                              @method('DELETE')
                              <button type="submit" class="dropdown-item"><img src="{{ URL::asset('public/img/list/delete.png') }}" class="me-3">{{ trans('Delete Job Card') }}</button>
                            </form>
                          </li>
                        @endcan
                        <?php
                        } elseif ($servicess->done_status != '1') {
                        ?>
                        @can('invoice_add')
                          <button type="button" data-bs-toggle="modal" data-bs-target="#myModal1" class="dropdown-item invoice" serviceid="{{ $servicess->id }}" job_no="{{ $servicess->job_no }}" url="{!! url('/jobcard/invoice') !!}"><img src="{{ URL::asset('public/img/list/create.png') }}" class="me-3"> {{ trans('message.Create Invoice') }} </button>
                          <li>
                            <form action="{{ route('jobcard.destroy', $servicess->id) }}" method="POST" onsubmit="return confirm('{{ trans('Are you sure you want to delete this Job Card?') }}');">
                              @csrf
                              @method('DELETE')
                              <button type="submit" class="dropdown-item"><img src="{{ URL::asset('public/img/list/delete.png') }}" class="me-3">{{ trans('Delete Job Card') }}</button>
                            </form>
                          </li>
                        @endcan
                        <?php
                        }
                      } else {
                        ?>
                        @can('invoice_view')
                        <li><button type="button" data-bs-toggle="modal" data-bs-target="#myModal-job" serviceid="{{ $servicess->id }}" job_no="{{ $servicess->job_no }}" url="{!! url('/jobcard/modalview') !!}" class="dropdown-item save"><img src="{{ URL::asset('public/img/list/Vector.png') }}" class="me-3"> {{ trans('message.View Invoice') }} </button></li>
                        <li>
                          <form action="{{ route('jobcard.destroy', $servicess->id) }}" method="POST" onsubmit="return confirm('{{ trans('Are you sure you want to delete this Job Card?') }}');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="dropdown-item"><img src="{{ URL::asset('public/img/list/delete.png') }}" class="me-3">{{ trans('Delete Job Card') }}</button>
                          </form>
                        </li>
                        @endcan
                      <?php
                      }
                      ?>
                      @endcan

                      <?php $jobcard = getJobcardStatus($servicess->job_no);
                      $view_data = getInvoiceStatus($servicess->job_no);
                      ?>

                      @can('jobcard_edit')
                      @if ($jobcard == 1)
                      <li><a href="{{ url('jobcard/list/' . $servicess->id) }}" class="dropdown-item"><img src="{{ URL::asset('public/img/list/jobprocess.png') }}" class="me-3">{{ trans('message.Process Job') }}</a></li>
                      @elseif($view_data == 'Yes')
                      <li><a href="{{ url('jobcard/list/' . $servicess->id) }}" class="dropdown-item"><img src="{{ URL::asset('public/img/list/jobprocess.png') }}" class="me-3">{{ trans('message.Process Job') }}</a></li>
                      @else
                      <li><a href="{{ url('jobcard/list/' . $servicess->id) }}" class="dropdown-item"><img src="{{ URL::asset('public/img/list/jobprocess.png') }}" class="me-3">{{ trans('message.Process Job') }}</a></li>

                      @endif

                      @if (getAlreadypasss($servicess->job_no) == 0 && $view_data == 'Yes')
                      @can('gatepass_add')
                      <li><a href="{!! url('/jobcard/gatepass/' . $servicess->id) !!}" class="dropdown-item"><img src="{{ URL::asset('public/img/list/gatepass.png') }}" class="me-3">{{ trans('message.Gate Pass') }}</a></li>
                      <li>
                        <form action="{{ route('jobcard.destroy', $servicess->id) }}" method="POST" onsubmit="return confirm('{{ trans('Are you sure you want to delete this Job Card?') }}');">
                          @csrf
                          @method('DELETE')
                          <button type="submit" class="dropdown-item"><img src="{{ URL::asset('public/img/list/delete.png') }}" class="me-3">{{ trans('Delete Job Card') }}</button>
                        </form>
                      </li>
                      @endcan
                      @elseif($view_data == 'No')
                      @can('gatepass_add')
                      <li><a href="{!! url('/jobcard/gatepass/' . $servicess->id) !!}" class="dropdown-item"><img src="{{ URL::asset('public/img/list/gatepass.png') }}" class="me-3">{{ trans('message.Gate Pass') }}</a></li>
                      <li>
                        <form action="{{ route('jobcard.destroy', $servicess->id) }}" method="POST" onsubmit="return confirm('{{ trans('Are you sure you want to delete this Job Card?') }}');">
                          @csrf
                          @method('DELETE')
                          <button type="submit" class="dropdown-item"><img src="{{ URL::asset('public/img/list/delete.png') }}" class="me-3">{{ trans('Delete Job Card') }}</button>
                        </form>
                      </li>
                      @endcan
                      @elseif(getAlreadypasss($servicess->job_no) == 1)
                      @can('gatepass_view')
                      <li><button type="button" data-bs-toggle="modal" data-bs-target="#myModal-gate" serviceid="" class="dropdown-item getgetpass" getid="{{ $servicess->job_no }}"><img src="{{ URL::asset('public/img/list/receipt.png') }}" class="me-3">{{ trans('message.Gate Receipt') }}</button></li>

                      <li>
                        <form action="{{ route('jobcard.destroy', $servicess->id) }}" method="POST" onsubmit="return confirm('{{ trans('Are you sure you want to delete this Job Card?') }}');">
                          @csrf
                          @method('DELETE')
                          <button type="submit" class="dropdown-item"><img src="{{ URL::asset('public/img/list/delete.png') }}" class="me-3">{{ trans('Delete Job Card') }}</button>
                        </form>
                      </li>
                      @endcan
                      @endif
                      @endcan
                      @else
                      @can('jobcard_view')
                      <?php

                      $view_data = getInvoiceStatus($servicess->job_no);

                      if ($view_data == "Yes") {
                      ?>
                      @can('invoice_view')
                        <li><button type="button" data-bs-toggle="modal" data-bs-target="#myModal-job" serviceid="{{ $servicess->id }}" job_no="{{ $servicess->job_no }}" url="{!! url('/jobcard/modalview') !!}" class="dropdown-item save"><img src="{{ URL::asset('public/img/list/Vector.png') }}" class="me-3"> {{ trans('message.View Invoice') }} </button></li>
                        <li>
                          <form action="{{ route('jobcard.destroy', $servicess->id) }}" method="POST" onsubmit="return confirm('{{ trans('Are you sure you want to delete this Job Card?') }}');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="dropdown-item"><img src="{{ URL::asset('public/img/list/delete.png') }}" class="me-3">{{ trans('Delete Job Card') }}</button>
                          </form>
                        </li>
                      @endcan
                      <?php
                      } else {
                      ?>
                      @can('invoice_view')
                        <li><button type="button" data-bs-toggle="modal" data-bs-target="#myModal-job" serviceid="{{ $servicess->id }}" job_no="{{ $servicess->job_no }}" url="{!! url('/jobcard/modalview') !!}" class="dropdown-item save" disabled><img src="{{ URL::asset('public/img/list/Vector.png') }}" class="me-3"> {{ trans('message.View Invoice') }} </button></li>
                        <li>
                        <form action="{{ route('jobcard.destroy', $servicess->id) }}" method="POST" onsubmit="return confirm('{{ trans('Are you sure you want to delete this Job Card?') }}');">
                          @csrf
                          @method('DELETE')
                          <button type="submit" class="dropdown-item"><img src="{{ URL::asset('public/img/list/delete.png') }}" class="me-3">{{ trans('Delete Job Card') }}</button>
                        </form>
                      </li>
                      @endcan
                      
                      <?php
                      }
                      ?>
                      @endcan

                      <?php $jobcard = getJobcardStatus($servicess->job_no);
                      $view_data = getInvoiceStatus($servicess->job_no);
                      ?>

                      @can('jobcard_edit')
                      @if ($jobcard == 1)
                      <li><a href="{{ url('jobcard/list/' . $servicess->id) }}" class="dropdown-item"><img src="{{ URL::asset('public/img/list/jobprocess.png') }}" class="me-3">{{ trans('message.Process Job') }}</a></li>
                      @elseif($view_data == 'Yes')
                      <li><a href="{{ url('jobcard/list/' . $servicess->id) }}" class="dropdown-item"><img src="{{ URL::asset('public/img/list/jobprocess.png') }}" class="me-3">{{ trans('message.Process Job') }}</a></li>
                      @else
                      <li>
                        <form action="{{ route('jobcard.destroy', $servicess->id) }}" method="POST" onsubmit="return confirm('{{ trans('Are you sure you want to delete this Job Card?') }}');">
                          @csrf
                          @method('DELETE')
                          <button type="submit" class="dropdown-item"><img src="{{ URL::asset('public/img/list/delete.png') }}" class="me-3">{{ trans('Delete Job Card') }}</button>
                        </form>
                      </li>
                      <li><a href="{{ url('jobcard/list/' . $servicess->id) }}" class="dropdown-item"><img src="{{ URL::asset('public/img/list/jobprocess.png') }}" class="me-3">{{ trans('message.Process Job') }}</a></li>
                      @endif

                      @if (getAlreadypasss($servicess->job_no) == 0 && $view_data == 'Yes')
                      @can('gatepass_add')
                      <li><a href="{!! url('/jobcard/gatepass/' . $servicess->id) !!}" class="dropdown-item"><img src="{{ URL::asset('public/img/list/gatepass.png') }}" class="me-3">{{ trans('message.Gate Pass') }}</a></li>
                      <li>
                        <form action="{{ route('jobcard.destroy', $servicess->id) }}" method="POST" onsubmit="return confirm('{{ trans('Are you sure you want to delete this Job Card?') }}');">
                          @csrf
                          @method('DELETE')
                          <button type="submit" class="dropdown-item"><img src="{{ URL::asset('public/img/list/delete.png') }}" class="me-3">{{ trans('Delete Job Card') }}</button>
                        </form>
                      </li>
                      @endcan
                      @elseif($view_data == 'No')
                      @can('gatepass_add')
                      <li><a href="{!! url('/jobcard/gatepass/' . $servicess->id) !!}" class="dropdown-item"><img src="{{ URL::asset('public/img/list/gatepass.png') }}" class="me-3">{{ trans('message.Gate Pass') }}</a></li>
                      <li>
                        <form action="{{ route('jobcard.destroy', $servicess->id) }}" method="POST" onsubmit="return confirm('{{ trans('Are you sure you want to delete this Job Card?') }}');">
                          @csrf
                          @method('DELETE')
                          <button type="submit" class="dropdown-item"><img src="{{ URL::asset('public/img/list/delete.png') }}" class="me-3">{{ trans('Delete Job Card') }}</button>
                        </form>
                      </li>
                      @endcan
                      @elseif(getAlreadypasss($servicess->job_no) == 1)
                      @can('gatepass_view')
                      <li><button type="button" data-bs-toggle="modal" data-bs-target="#myModal-gate" serviceid="" class="dropdown-item getgetpass" getid="{{ $servicess->job_no }}"><img src="{{ URL::asset('public/img/list/receipt.png') }}" class="me-3">{{ trans('message.Gate Receipt') }}</button></li>
                      <li>
                        <form action="{{ route('jobcard.destroy', $servicess->id) }}" method="POST" onsubmit="return confirm('{{ trans('Are you sure you want to delete this Job Card?') }}');">
                          @csrf
                          @method('DELETE')
                          <button type="submit" class="dropdown-item"><img src="{{ URL::asset('public/img/list/delete.png') }}" class="me-3">{{ trans('Delete Job Card') }}</button>
                        </form>
                      </li>
                      @endcan
                      @endif
                      @endcan
                      @endif
                      @endif
                     

                    </ul>
                  </div>
                </td>
                @endcanany
              </tr>
              <?php $i++; ?>
              @endforeach
              @endif
            </tbody>
          </table>
          <!-- <button id="select-all-btn" class="btn select_all"><input type="checkbox" name="chk"> {{ trans('message.Select All') }} </button>
          <button id="delete-selected-btn" class="btn btn-danger text-white border-0" data-url="{!! url('/supplier/list/delete') !!}"><i class="fa fa-trash" aria-hidden="true"></i></button> -->
        </div>
      </div>
    @else
      <p class="d-flex justify-content-center mt-5 pt-5"><img src="{{ URL::asset('public/img/dashboard/No-Data.png') }}" width="300px"></p>
    @endif
    </div>
  </div>
</div>
<!-- /page content -->


<!-- Scripts starting -->
<script src="{{ URL::asset('vendors/jquery/dist/jquery.min.js') }}"></script>

<script>
  $(document).ready(function() {

    var search = "{{ trans('message.Search...') }}";
    var info = "{{ trans('message.Showing page _PAGE_ - _PAGES_') }}";
    var zeroRecords = "{{ trans('message.No Data Found') }}";
    var infoEmpty = "{{ trans('message.No records available') }}";
    /*language change in user selected*/
    $('#supplier').DataTable({
      "order": [
        [1, "desc"]
      ],
      columnDefs: [{
        width: 2,
        targets: 0
      }],
      fixedColumns: true,
      paging: true,
      scrollCollapse: true,
      scrollX: true,
      // scrollY: 300,

      responsive: true,
      "language": {
        lengthMenu: "_MENU_ ",
        info: info,
        zeroRecords: zeroRecords,
        infoEmpty: infoEmpty,
        infoFiltered: '(filtered from _MAX_ total records)',
        searchPlaceholder: search,
        search: '',
      },
      aoColumnDefs: [{
        bSortable: false,
        aTargets: [-1]
      }],
      order: [
        [0, 'desc']
      ]
    });


    $('body').on('click', '.getgetpass', function() {
      var getpassid = $(this).attr('getid');
      var url = "<?php echo url('/gatepass/gatepassview'); ?>";
      var currentPageAction = getParameterByName('page_action');

      // Construct the URL for AJAX request with page_action parameter
      if (currentPageAction) {
        url += '?page_action=' + currentPageAction;
      }

      $.ajax({
        type: 'GET',
        url: url,
        data: {
          getpassid: getpassid
        },
        // dataType:'json',
        success: function(response) {
          $('.modal-body').html(response.html);
        },
      });
    });



    $('body').on('click', '.sa-warning', function() {

      var url = $(this).attr('url');
      var msg1 = "{{ trans('message.Are You Sure?') }}";
      var msg2 = "{{ trans('message.You will not be able to recover this data afterwards!') }}";
      var msg3 = "{{ trans('message.Cancel') }}";
      var msg4 = "{{ trans('message.Yes, delete!') }}";
      swal({
        title: msg1,
        text: msg2,
        icon: 'warning',
        cancelButtonColor: '#C1C1C1',
        buttons: [msg3, msg4],
        dangerMode: true,
      }).then((willDelete) => {
        if (willDelete) {
          window.location.href = url;
        }
      });
    });


    /*Gate Pass Script*/
    function PrintElem(elem) {
      Popup($(elem).html());
    }

    function Popup(data) {
      var mywindow = window.open('', 'Print Expense Invoice', 'height=600,width=1000');

      mywindow.document.write(data);
      mywindow.document.close();
      mywindow.focus();
      mywindow.print();
      mywindow.close();

      return true;
    }


    /*End Of Gate Pass Script*/
    $('body').on('click', '.save', function() {

      $('.modal-body-data').html("");
      var serviceid = $(this).attr("serviceid");
      var job_no = $(this).attr("job_no");
      var url = $(this).attr('url');

      var currentPageAction = getParameterByName('page_action');

      // Construct the URL for AJAX request with page_action parameter
        if (currentPageAction) {
          url += '?page_action=' + currentPageAction;
        }

      $.ajax({
        type: 'GET',
        url: url,
        data: {
          serviceid: serviceid,
          job_no: job_no,
        },
        success: function(data) {
          // console.log(data.html);
          $('.modal-body-data').html(data.html);
        },
        beforeSend: function() {
          $(".modal-body-data").html("<center><h2 class=text-muted><b>Loading...</b></h2></center>");
        },
        error: function(e) {
          alert("An error occurred: " + e.responseText);
          console.log(e);
        }
      });
    });

    // For get getParameterByName
    function getParameterByName(name, url = window.location.href) {
      name = name.replace(/[\[\]]/g, '\\$&');
      var regex = new RegExp('[?&]' + name + '(=([^&#]*)|&|#|$)'),
      results = regex.exec(url);
      if (!results) return null;
      if (!results[2]) return '';
      return decodeURIComponent(results[2].replace(/\+/g, ' '));
    }

    //create invoice
    $('body').on('click', '.invoice', function() {

      $('.modal-body-data').html("");
      var serviceid = $(this).attr("serviceid");
      var job_no = $(this).attr("job_no");
      var url = $(this).attr('url');

      // console.log(serviceid);
      // console.log(url);
      $.ajax({
        type: 'GET',
        url: url,
        data: {
          serviceid: serviceid,
          job_no: job_no,
        },
        success: function(data) {
          // console.log(data.html);
          $('.modal-body-data').html(data.html);
        },
        beforeSend: function() {
          $(".modal-body-data").html("<center><h2 class=text-muted><b>Loading...</b></h2></center>");
        },
        error: function(e) {
          alert("An error occurred: " + e.responseText);
          console.log(e);
        }
      });
    });
  });
</script>

@endsection