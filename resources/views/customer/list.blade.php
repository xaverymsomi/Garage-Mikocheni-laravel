@extends('layouts.app')
@section('content')
<?php if (
  getLangCode() == 'de' ||
  getLangCode() == 'gr' ||
  getLangCode() == 'ger' ||
  getLangCode() == 'pt' ||
  getLangCode() == 'fr' ||
  getLangCode() == 'cs'
) {
?>
  <style>
    @media (max-width: 320px) {
      ul.bar_tabs>li {
        margin-top: 1px !important;
        margin-left: 0px !important;
      }

      .x_panel {
        margin-top: 40px !important;
      }
    }

    @media (max-width: 360px) {
      ul.bar_tabs>li {
        margin-top: 1px !important;
        margin-left: 0px !important;
      }

      .x_panel {
        margin-top: 40px !important;
      }
    }
  </style>
<?php
} ?>
<?php if (
  getLangCode() == 'id' ||
  getLangCode() == 'ru' ||
  getLangCode() == 'vi' ||
  getlangCode() == 'ta'
) {
?>
  <style>
    @supports (-webkit-touch-callout: none) {
      ul.bar_tabs>li {
        margin-top: 1px !important;
        margin-left: 0px !important;
      }

      .x_panel {
        margin-top: 40px !important;
      }
    }

    @media (max-width: 320px) {
      ul.bar_tabs>li {
        margin-top: 1px !important;
        margin-left: 0px !important;
      }

      .x_panel {
        margin-top: 40px !important;
      }
    }

    @media (max-width: 360px) {
      ul.bar_tabs>li {
        margin-top: 1px !important;
        margin-left: 0px !important;
      }

      .x_panel {
        margin-top: 40px !important;
      }
    }
  </style>
<?php
}
?>
<style>
  .col-sm-12 {
    float: none;
  }

  @media screen and (max-width:540px) {
    div#customer_info {
      margin-top: -277px;
    }

    span.titleup {
      margin-left: -10px;
    }
  }
</style>

<!-- page content -->
<div class="right_col" role="main">
  <div class="">
    <div class="page-title">
      <div class="nav_menu">
        <nav>
          <div class="nav toggle">
              &nbsp;<a id="menu_toggle"><i class="fa fa-bars sidemenu_toggle"></i></a><span class="titleup"> Clients  Creation</span>
              @can('customer_add')
              <a href="{!! url('/customer/add') !!}" id="">
                <img src="{{ URL::asset('public/img/icons/plus Button.png') }}">
              </a>
              @endcan
            </span>
          </div>
          @include('dashboard.profile')
        </nav>
      </div>
    </div>
  </div>
  @include('success_message.message')
  {{-- @if (session('message'))
      <div class="row massage">
        <div class="col-md-12 col-sm-12 col-xs-12">
          <div class="checkbox checkbox-success checkbox-circle mb-2">
            @if (session('message') == 'Successfully Submitted')
              <label for="checkbox-10 colo_success"> {{ trans('message.Successfully Submitted') }} </label>
  @elseif(session('message') == 'Successfully Updated')
  <label for="checkbox-10 colo_success"> {{ trans('message.Successfully Updated') }} </label>
  @elseif(session('message') == 'Successfully Deleted')
  <label for="checkbox-10 colo_success"> {{ trans('message.Successfully Deleted') }} </label>
  @endif
</div>
</div>
</div>
@endif --}}
<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
    {{-- <div class="x_content">
          <ul class="nav nav-tabs bar_tabs"
            role="tablist">
            @can('customer_view')
              <li role="presentation"
                class="active"><a href="{!! url('/customer/list') !!}"><span class="visible-xs"></span><i
                    class="fa fa-list fa-lg">&nbsp;</i><b>{{ trans('message.Customer List') }}</b></a></li>
    @endcan

    @can('customer_add')
    <li role="presentation" class=""><a href="{!! url('/customer/add') !!}"><span class="visible-xs"></span><i class="fa fa-plus-circle fa-lg">&nbsp;</i> {{ trans('message.Add Customer') }}</a></li>
    @endcan

    </ul>
  </div> --}}
  @if(!empty($customer) && count($customer) > 0)
  <div class="x_panel bgr">
    <table id="supplier" class="table responsive jumbo_table" style="width:100%">
      <thead>
        <tr>
          @can('customer_delete')
          <th> </th>
          @endcan
          <th>{{ trans('message.First Name') }}</th>
          <th>{{ trans('message.Email') }}</th>
          <th>{{ trans('message.Mobile Number') }}</th>
          <th>{{ trans('message.Vehicle List') }}</th>
          <th>{{ trans('message.Action') }}</th>
        </tr>
      </thead>
      <tbody>
        <?php $i = 1; ?>
        @if (!empty($customer))
        @foreach ($customer as $customers)
        <tr data-user-id="{{ $customers->id }}">
          <!-- <td>{{ $i }}</td> -->
          @can('customer_delete')
          <td>
            <label class="container checkbox">
              <input type="checkbox" name="chk">
              <span class="checkmark"></span>
            </label>
          </td>
          @endcan
          
          <td><a href="{!! url('/customer/list/' . $customers->id) !!}">{{ $customers->name }} </a>
          <!-- <a data-toggle="tooltip" data-placement="bottom" title="First Name" class="text-primary"><i class="fa fa-info-circle" style="color:#D9D9D9"></i></a> -->
        </td>
          
          <td>{{ $customers->email }} 
            <!-- <a data-toggle="tooltip" data-placement="bottom" title="Email" class="text-primary"><i class="fa fa-info-circle" style="color:#D9D9D9"></i></a> -->
          </td>
          <td>{{ $customers->mobile_no }} 
            <!-- <a data-toggle="tooltip" data-placement="bottom" title="Mobile Number" class="text-primary"><i class="fa fa-info-circle" style="color:#D9D9D9"></i></a> -->
          </td>
          <td>{{ getVehicles($customers->id) }}
            <!-- <pre> 
              <a data-toggle="tooltip" data-placement="bottom" title="Vehicle List" class="text-primary"><i class="fa fa-info-circle" style="color:#D9D9D9"></i></a>
            </pre> -->
          </td>
          <td>
            <div class="dropdown_toggle">
              <img src="{{ URL::asset('public/img/list/dots.png') }}" class="btn dropdown-toggle border-0" type="button" id="dropdownMenuButtonAction" data-bs-toggle="dropdown" aria-expanded="false">

              <ul class="dropdown-menu heder-dropdown-menu action_dropdown shadow py-2" aria-labelledby="dropdownMenuButtonAction">
                @can('customer_view')
                <li><a class="dropdown-item" href="{!! url('/customer/list/' . $customers->id) !!}"><img src="{{ URL::asset('public/img/list/Vector.png') }}" class="me-3">{{ trans('message.View') }}</a></li>
                @endcan

                @can('customer_edit')
                <li><a class="dropdown-item" href="{!! url('/customer/list/edit/' . $customers->id) !!}"><img src="{{ URL::asset('public/img/list/Edit.png') }}" class="me-3"> {{ trans('message.Edit') }}</a></li>
                @endcan

                @can('customer_delete')
                <div class="dropdown-divider m-0"></div>
                <li><a class="dropdown-item deletecustomers" url="{!! url('/customer/list/delete/' . $customers->id) !!}" style="color:#FD726A"><img src="{{ URL::asset('public/img/list/Delete.png') }}" class="me-3">{{ trans('message.Delete') }}</a></li>
                @endcan
              </ul>
            </div>
          </td>
        </tr>
        <?php $i++; ?>
        @endforeach
        @endif

      </tbody>
    </table>
    @can('customer_delete')
    <button id="select-all-btn" class="btn select_all"><input type="checkbox" name="selectAll"> {{ trans('message.Select All') }}</button>
    <button id="delete-selected-btn" class="btn btn-danger text-white border-0" data-url="{!! url('/customer/list/delete/') !!}"><i class="fa fa-trash" aria-hidden="true"></i></button>
    @endcan
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

    $('#supplier').DataTable({

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

    });


    $('body').on('click', '.deletecustomers', function() {
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

  });
</script>
@endsection