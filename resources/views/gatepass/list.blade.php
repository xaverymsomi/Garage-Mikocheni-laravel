@extends('layouts.app')
@section('content')
<style>
  @media screen and (max-width:540px) {
    div#gatepass_info {
      margin-top: -177px;
    }

    span.titleup {
      margin-left: -10px;
    }
  }
</style>
<!-- page content start -->
<div class="right_col" role="main">
  <!--gate pass view modal-->
  <div id="myModal-gateview" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg modal-xs">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <h4 id="myLargeModalLabel" class="modal-title">{{ getNameSystem() }}</h4>
          <a href="{!! url('/gatepass/list') !!}" class="prints"><input type="submit" class="btn-close " data-bs-dismiss="modal" value=""></a>
        </div>
        <div class="modal-body">

        </div>
      </div>
    </div>
  </div>
  <div class="">
    <div class="page-title">
      <div class="nav_menu">
        <nav>
          <div class="nav toggle">
          <a id="menu_toggle"><i class="fa fa-bars sidemenu_toggle"></i></a>
            <span class="titleup">{{ trans('message.Gate Pass') }}
              @can('gatepass_add')
              <a href="{!! url('/gatepass/add') !!}" id="">
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
      @if(!empty($gatepass) && count($gatepass) > 0)
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel table_up_div">
          <table id="supplier" class="table jambo_table" style="width:100%">
            <thead>
              <tr>
                @can('gatepass_delete')
                <th> </th>
                @endcan
                <th>{{ trans('message.Gatepass No') }}.</th>
                <th>{{ trans('message.Job No') }}.</th>
                <th>{{ trans('message.Customer Name') }}</th>
                <th>{{ trans('message.Vehicle Name') }}</th>
                <th>{{ trans('message.Action') }}</th>
              </tr>
            </thead>
            <tbody>
              <?php $i = 1; ?>

              @foreach ($gatepass as $gatepasss)
              <tr data-user-id="{{ $gatepasss->id }}">
                @can('gatepass_delete')
                <td>
                  <label class="container checkbox">
                    <input type="checkbox" name="chk">
                    <span class="checkmark"></span>
                  </label>
                </td>
                @endcan
                <td>
                  <a data-bs-toggle="modal" data-bs-target="#myModal-gateview" serviceid="" class="getgetpass" getpassid="{{ $gatepasss->jobcard_id }}">{{ $gatepasss->gatepass_no }} 
                    <!-- <a data-toggle="tooltip" data-placement="bottom" title="Gatepass No." class="text-primary"><i class="fa fa-info-circle" style="color:#D9D9D9"></i></a> -->
                  </a>
                </td>
                <td>
                  <a data-bs-toggle="modal" data-bs-target="#myModal-gateview" serviceid="" class="getgetpass" getpassid="{{ $gatepasss->jobcard_id }}">{{ $gatepasss->jobcard_id }} 
                    <!-- <a data-toggle="tooltip" data-placement="bottom" title="Job No." class="text-primary"><i class="fa fa-info-circle" style="color:#D9D9D9"></i></a> -->
                  </a>
                </td>
                <td>{{ getCustomerName($gatepasss->customer_id) }} 
                  <!-- <a data-toggle="tooltip" data-placement="bottom" title="Customer Name" class="text-primary"><i class="fa fa-info-circle" style="color:#D9D9D9"></i></a> -->
                </td>
                <td>
                  <a data-bs-toggle="modal" data-bs-target="#myModal-gateview" serviceid="" class="getgetpass" getpassid="{{ $gatepasss->jobcard_id }}">{{ getVehicleName($gatepasss->vehicle_id) }} 
                    <!-- <a data-toggle="tooltip" data-placement="bottom" title="Vehicle Name" class="text-primary"><i class="fa fa-info-circle" style="color:#D9D9D9"></i></a> -->
                  </a>
                </td>
                <td>
                  <div class="dropdown_toggle">
                    <img src="{{ URL::asset('public/img/list/dots.png') }}" class="btn dropdown-toggle border-0" type="button" id="dropdownMenuButtonaction" data-bs-toggle="dropdown" aria-expanded="false">

                    <ul class="dropdown-menu heder-dropdown-menu action_dropdown shadow py-2" aria-labelledby="dropdownMenuButtonaction">
                      @can('gatepass_view')
                      <li>
                        <a class="dropdown-item">
                          <button type="button" data-bs-toggle="modal" data-bs-target="#myModal-gateview" serviceid="" class="btn getgetpass border-0 p-0" getpassid="{{ $gatepasss->jobcard_id }}">
                            <img src="{{ URL::asset('public/img/list/Vector.png') }}" class="me-3">
                            {{ trans('message.View') }}
                          </button>
                        </a>
                      </li>
                      @endcan

                      @can('gatepass_edit')
                      <li><a class="dropdown-item" href="{!! url('/gatepass/list/edit/' . $gatepasss->id) !!}"><img src="{{ URL::asset('public/img/list/Edit.png') }}" class="me-3"> {{ trans('message.Edit') }}</a></li>
                      @endcan

                      @can('gatepass_delete')
                      <div class="dropdown-divider m-0"></div>
                      <li><a class="dropdown-item sa-warning" url="{!! url('/gatepass/list/delete/' . $gatepasss->id) !!}" style="color:#FD726A"><img src="{{ URL::asset('public/img/list/Delete.png') }}" class="me-3">{{ trans('message.Delete') }}</a></li>
                      @endcan
                    </ul>
                  </div>

                </td>
              </tr>
              <?php $i++; ?>
              @endforeach
            </tbody>
          </table>
          @can('gatepass_delete')
          <button id="select-all-btn" class="btn select_all"><input type="checkbox" name="selectAll"> {{ trans('message.Select All') }}</button>
          <button id="delete-selected-btn" class="btn btn-danger text-white border-0" data-url="{!! url('/gatepass/list/delete/') !!}"><i class="fa fa-trash" aria-hidden="true"></i></button>
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
      order: [
        [2, 'desc']
      ]
    });


    $('body').on('click', '.getgetpass', function() {
    var getpassid = $(this).attr('getpassid');
    var url = "{{ url('/gatepass/gatepassview') }}";

    $.ajax({
        type: 'GET',
        url: url,
        data: { getpassid: getpassid, page_action: 'view' },
        dataType: 'json',
        success: function(response) {
            if (response.success) {
                $('.modal-body').html(response.html);
            } else {
                $('.modal-body').html('<p>No data found.</p>');
            }
        },
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