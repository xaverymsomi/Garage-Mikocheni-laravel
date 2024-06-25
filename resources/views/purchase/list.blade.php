@extends('layouts.app')
@section('content')
<style>
  @media screen and (max-width:540px) {
    /* div#purchase_info {
      margin-top: -177px;
    } */

    span.titleup {
      margin-left: -10px;
    }
  }
</style>
<!-- page content -->
<div class="right_col" role="main">
  <div id="purchaseview" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title"> {{ getNameSystem() }} </h4>
          <!-- <h4 id="myLargeModalLabel" class="modal-title">{{ trans('message.Purchase') }}</h4> -->
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
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
            <a id="menu_toggle"><i class="fa fa-bars sidemenu_toggle"></i></a><span class="titleup">&nbsp;{{ trans('message.Purchase') }}
              @can('purchase_add')
              <a href="{!! url('/purchase/add') !!}" id="">
                <img src="{{ URL::asset('public/img/icons/plus Button.png') }}" class="">
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
  <div class="row">
    @if(!empty($purchase) && count($purchase) > 0)
    <div class="col-md-12 col-sm-12 col-xs-12" style="float: none;">
      <div class="x_panel bgr">
        <table id="supplier" class="example table responsive-utilities jambo_table" style="width:100%">
          <thead>
            <tr>
              @can('purchase_delete')
              <th> </th>
              @endcan
              <th>{{ trans('message.Purchase Code') }}</th>
              <th>{{ trans('message.Supplier Name') }}</th>
              <th>{{ trans('message.Email') }}</th>
              <th>{{ trans('message.Mobile') }}</th>
              <th>{{ trans('message.Date') }}</th>
              <th>{{ trans('message.Products') }}</th>
              <th>{{ trans('message.Action') }}</th>
            </tr>
          </thead>
          <tbody>
            <?php $i = 1; ?>
            @foreach ($purchase as $purchases)
            <tr data-user-id="{{ $purchases->id }}">
              <!-- <td>{{ $i }}</td> -->
              @can('purchase_delete')
              <td>
                <label class="container checkbox">
                  <input type="checkbox" name="chk">
                  <span class="checkmark"></span>
                </label>
              </td>
              @endcan
              <td><a data-bs-toggle="modal" data-bs-target="#purchaseview" purchaseid="{{ $purchases->id }}" url="{!! url('/purchase/list/modalview') !!}" class="purchasesave">{{ $purchases->purchase_no }}</a>&nbsp;
                <!-- <a data-toggle="tooltip" data-placement="bottom" title="Purchase Code" class="text-primary">
                  <i class="fa fa-info-circle" style="color:#D9D9D9"></i>
                </a> -->
              </td>
              <td><a data-bs-toggle="modal" data-bs-target="#purchaseview" purchaseid="{{ $purchases->id }}" url="{!! url('/purchase/list/modalview') !!}" class="purchasesave">{{ getCompanyNames($purchases->supplier_id) }}</a>&nbsp;
                <!-- <a data-toggle="tooltip" data-placement="bottom" title="Supplier Name" class="text-primary">
                  <i class="fa fa-info-circle" style="color:#D9D9D9"></i>
                </a> -->
              </td>
              <td>{{ $purchases->email }}&nbsp;
                <!-- <a data-toggle="tooltip" data-placement="bottom" title="Email" class="text-primary">
                  <i class="fa fa-info-circle" style="color:#D9D9D9"></i>
                </a> -->
              </td>
              <td>{{ $purchases->mobile }}&nbsp;
                <!-- <a data-toggle="tooltip" data-placement="bottom" title="Mobile" class="text-primary">
                  <i class="fa fa-info-circle" style="color:#D9D9D9"></i>
                </a> -->
              </td>
              <td>{{ date(getDateFormat(), strtotime($purchases->date)) }}&nbsp;
                <!-- <a data-toggle="tooltip" data-placement="bottom" title="Date" class="text-primary">
                  <i class="fa fa-info-circle" style="color:#D9D9D9"></i>
                </a> -->
              </td>
              <td>{{ getPurchaseProducts($purchases->id) }}&nbsp;
                <!-- <a data-toggle="tooltip" data-placement="bottom" title="Products" class="text-primary">
                  <i class="fa fa-info-circle" style="color:#D9D9D9"></i>
                </a> -->
              </td>
              <td>
                <div class="dropdown_toggle">
                  <img src="{{ URL::asset('public/img/list/dots.png') }}" class="btn dropdown-toggle border-0" type="button" id="dropdownMenuButtonAction" data-bs-toggle="dropdown" aria-expanded="false">

                  <ul class="dropdown-menu heder-dropdown-menu action_dropdown shadow py-2" aria-labelledby="dropdownMenuButtonAction">
                    <!-- <li><a class="dropdown-item" href="{!! url('/supplier/list/' .$purchases->id) !!}"><img src="{{ URL::asset('public/img/list/Vector.png') }}" purchaseid="{{ $purchases->id }}"> {{ trans('message.View') }}</a></li> -->
                    @can('purchase_view')
                    <li><a data-bs-toggle="modal" data-bs-target="#purchaseview" purchaseid="{{ $purchases->id }}" url="{!! url('/purchase/list/modalview') !!}" class="purchasesave dropdown-item"><img src="{{ URL::asset('public/img/list/Vector.png') }}" class="me-3">{{ trans('message.View') }}</a></li>
                    @endcan

                    @can('purchase_edit')
                    <li><a class="dropdown-item" href="{!! url('/purchase/list/edit/' . $purchases->id) !!}"><img src="{{ URL::asset('public/img/list/Edit.png') }}" class="me-3"> {{ trans('message.Edit') }}</a></li>
                    @endcan

                    @can('purchase_delete')
                    <div class="dropdown-divider m-0"></div>
                    <li><a class="dropdown-item sa-warning" url="{!! url('/purchase/list/delete/' . $purchases->id) !!}" style="color:#FD726A"><img src="{{ URL::asset('public/img/list/Delete.png') }}" class="me-3">{{ trans('message.Delete') }}</a></li>
                    @endcan
                  </ul>
                </div>
              </td>
            </tr>
            <?php $i++; ?>
            @endforeach
          </tbody>
        </table>
        @can('purchase_delete')
        <button id="select-all-btn" class="btn select_all"><input type="checkbox" name="selectAll"> {{ trans('message.Select All') }}</button>
        <button id="delete-selected-btn" class="btn btn-danger text-white border-0" data-url="{!! url('/purchase/list/delete/') !!}"><i class="fa fa-trash" aria-hidden="true"></i></button>
        @endcan

      </div>
    </div>
    @else
    <p class="d-flex justify-content-center mt-5 pt-5"><img src="{{ URL::asset('public/img/dashboard/No-Data.png') }}" width="300px"></p>
    @endif
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
      "search": {
        "search": "",
      },
      pagingType: 'simple_numbers',
      "language": {
        search: '',
        searchPlaceholder: search,
        lengthMenu: "_MENU_  ",
        info: info,
        zeroRecords: zeroRecords,
        infoEmpty: infoEmpty,
        infoFiltered: '(filtered from _MAX_ total records)',
      },
      aoColumnDefs: [{
        bSortable: false,
        aTargets: [-1]
      }],
      order: [
        [5, 'desc']
      ]
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


    $('body').on('click', '.purchasesave', function() {

      $('.modal-body').html("");
      var purchaseid = $(this).attr("purchaseid");
      var url = $(this).attr('url');

      $.ajax({
        type: 'GET',
        url: url,
        data: {
          purchaseid: purchaseid
        },
        success: function(data) {
          $('.modal-body').html(data.html);
        },
        beforeSend: function() {
          $(".modal-body").html("<center><h2 class=text-muted><b>Loading...</b></h2></center>");
        },
        error: function(e) {}
      });
    });
  });
</script>

@endsection