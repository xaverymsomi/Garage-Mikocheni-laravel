@extends('layouts.app')
@section('content')
<style>
  @media screen and (max-width:540px) {
    div#taxrates_info {
      margin-top: -168px;
    }

    span.titleup {
      margin-left: -10px;
    }
  }
  button.btn_dt {
    background: #DC3733;
    border: none;
    height: 35px;
    width: 35px;
    color: #ffffff;
    font-size: 25px;
}
</style>
<!-- page content start-->
<div class="right_col" role="main">
  <div class="">
    <div class="page-title">
      <div class="nav_menu">
        <nav>
          <div class="nav toggle">
          <a id="menu_toggle"><i class="fa fa-bars sidemenu_toggle"></i></a><span class="titleup">{{ trans('message.Tax Rates') }}
              @can('taxrate_add')
              <a href="{!! url('/taxrates/add') !!}" id="">
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
    @if(!empty($account) && count($account) > 0)
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <table id="supplier" class="table  jambo_table" style="width:100%">
            <thead>
              <tr>
                @can('taxrate_delete')
                <th> </th>
                @endcan
                <th>{{ trans('message.Account Tax Name') }}
                <th>{{ trans('message.Tax Rates') }}(%)</th>
                <th>{{ trans('message.Tax Number') }}</th>

                @canany(['taxrate_edit', 'taxrate_delete'])
                <th>{{ trans('message.Action') }}</th>
                @endcanany

              </tr>
            </thead>
            <tbody>
              <?php $i = 1; ?>
              @foreach ($account as $accounts)
              <tr data-user-id="{{ $accounts->id }}">
                @can('taxrate_delete')
                <td>
                  <label class="container checkbox">
                    <input type="checkbox" name="chk">
                    <span class="checkmark"></span>
                  </label>
                </td>
                @endcan
                <td><a href="{!! url('/taxrates/list/edit/' . $accounts->id) !!}">{{ $accounts->taxname }}</a> 
                  <!-- <a data-toggle="tooltip" data-placement="bottom" title="Account Tax Name" class="text-primary"><i class="fa fa-info-circle" style="color:#D9D9D9"></i></a> -->
                </td>
                <td>{{ $accounts->tax }} 
                  <!-- <a data-toggle="tooltip" data-placement="bottom" title="Tax Rates(%)" class="text-primary"><i class="fa fa-info-circle" style="color:#D9D9D9"></i></a> -->
                </td>
                <td>{{ $accounts->tax_number }} 
                  <!-- <a data-toggle="tooltip" data-placement="bottom" title="Tax Number" class="text-primary"><i class="fa fa-info-circle" style="color:#D9D9D9"></i></a> -->
                </td>

                @canany(['taxrate_edit', 'taxrate_delete'])
                <td>
                  <div class="dropdown_toggle">
                    <img src="{{ URL::asset('public/img/list/dots.png') }}" class="btn dropdown-toggle border-0" type="button" id="dropdownMenuButtonaction" data-bs-toggle="dropdown" aria-expanded="false">

                    <ul class="dropdown-menu heder-dropdown-menu action_dropdown shadow py-2" aria-labelledby="dropdownMenuButtonaction">

                      @can('taxrate_edit')
                      <li><a class="dropdown-item" href="{!! url('/taxrates/list/edit/' . $accounts->id) !!}"><img src="{{ URL::asset('public/img/list/Edit.png') }}" class="me-3"> {{ trans('message.Edit') }}</a></li>
                      @endcan

                      @can('taxrate_delete')
                      <div class="dropdown-divider m-0"></div>
                      <li><a class="dropdown-item sa-warning" url="{!! url('/taxrates/list/delete/' . $accounts->id) !!}" style="color:#FD726A"><img src="{{ URL::asset('public/img/list/Delete.png') }}" class="me-3">{{ trans('message.Delete') }}</a></li>
                      @endcan
                    </ul>
                  </div>
                </td>
                @endcanany
              </tr>
              <?php $i++; ?>
              @endforeach
            </tbody>
          </table>
          @can('taxrate_delete')
          <button id="select-all-btn" class="btn select_all"><input type="checkbox" name="selectAll"> {{ trans('message.Select All') }}</button>
          <button id="delete-selected-btn" class="btn btn-danger text-white border-0" data-url="{!! url('/taxrates/list/delete/') !!}"><i class="fa fa-trash" aria-hidden="true"></i></button>
          @endcan
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
<!-- language change in user selected -->
<script>
  $(document).ready(function() {

    var counter = 1;
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


    /*delete taxrates*/
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

  });
</script>
@endsection