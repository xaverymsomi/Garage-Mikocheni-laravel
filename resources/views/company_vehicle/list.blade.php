@extends('layouts.app')
@section('content')
<style>
  @media screen and (max-width:540px) {
    div#product_info {
      margin-top: -177px;
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
              <a id="menu_toggle"><i class="fa fa-bars sidemenu_toggle"></i></a><span class="titleup">&nbsp;{{ trans('VEHICLES') }}
              @can('product_add')
              <a href="{!! url('/company_vehicle/add') !!}" id="">
                <img src="{{ URL::asset('public/img/icons/plus Button.png') }}">
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
    @if(!empty($product) && count($product) > 0)
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel table_up_div">
          <table id="supplier" class="table jambo_table" style="width:100%">
            <thead>
              <tr>
                @can('companyvehicle_delete')
                <th> </th>
                @endcan
                <th>{{ trans('message.Image') }}</th>
                <th>{{ trans('message.Manufacturer Name') }}</th>
                <th>{{ trans('Vehicle Name') }}</th>
                <th>{{ trans('Retail Price') }} (<?php echo getCurrencySymbols(); ?>)</th>
                <th>{{ trans('Dealer Price') }} (<?php echo getCurrencySymbols(); ?>)</th>
                <th>{{ trans('Model Year') }}</th>
                <th>{{ trans('Quantity') }}</th>

                <!-- Custom Field Data Label Name-->
                @if (!empty($tbl_custom_fields))
                @foreach ($tbl_custom_fields as $tbl_custom_field)
                <th>{{ $tbl_custom_field->label }}</th>
                @endforeach
                @endif
                <!-- Custom Field Data End -->
                
                @canany(['companyvehicle_edit', 'companyvehicle_delete'])
                <th>{{ trans('message.Action') }}</th>
                @endcanany

              </tr>
            </thead>
            <tbody>
              <?php $i = 1; ?>
              @foreach ($product as $products)
              <tr data-user-id="{{ $products->id }}"> 
                <!-- <td>{{ $i }}</td> -->
                @can('companyvehicle_delete')
                <td>
                  <label class="container checkbox">
                    <input type="checkbox" name="chk">
                    <span class="checkmark"></span>
                  </label>
                </td>
                @endcan
                <td><a href="{!! url('/product/list/edit/' . $products->id) !!}"><img src="{{ URL::asset('public/companyvehicle/' . $products->image) }}" width="52px" height="52px" class="datatable_img"></a></td>

                <td>{{ getVehicleType($products->manufacturer) }} 
                  <!-- <a data-toggle="tooltip" data-placement="bottom" title="Type" class="text-primary"><i class="fa fa-info-circle" style="color:#D9D9D9"></i></a> -->
                </td>
                <td>{{ $products->name }}&nbsp;
                  <!-- <a data-toggle="tooltip" data-placement="bottom" title="Product Name" class="text-primary">
                    <i class="fa fa-info-circle" style="color:#D9D9D9"></i>
                  </a> -->
                </td>
                <td>{{ $products->Price }}&nbsp;
                  <!-- <a data-toggle="tooltip" data-placement="bottom" title="Price ( <?php echo getCurrencySymbols(); ?> )" class="text-primary">
                    <i class="fa fa-info-circle" style="color:#D9D9D9"></i>
                  </a> -->
                </td>
                <td>{{ $products->dealer_price }}&nbsp;
                  <!-- <a data-toggle="tooltip" data-placement="bottom" title="Price ( <?php echo getCurrencySymbols(); ?> )" class="text-primary">
                    <i class="fa fa-info-circle" style="color:#D9D9D9"></i>
                  </a> -->
                </td>
                <td>{{ $products->year }}&nbsp;
                  <!-- <a data-toggle="tooltip" data-placement="bottom" title="Supplier Name" class="text-primary">
                    <i class="fa fa-info-circle" style="color:#D9D9D9"></i>
                  </a> -->
                </td>
                <td>{{ $products->quantity }}&nbsp;
                  <!-- <a data-toggle="tooltip" data-placement="bottom" title="Supplier Name" class="text-primary">
                    <i class="fa fa-info-circle" style="color:#D9D9D9"></i>
                  </a> -->
                </td>
                

                <!-- Custom Field Data Value-->
                @if (!empty($tbl_custom_fields))
                @foreach ($tbl_custom_fields as $tbl_custom_field)
                <?php
                $tbl_custom = $tbl_custom_field->id;
                $userid = $products->id;

                $datavalue = getCustomDataProduct($tbl_custom, $userid);
                ?>

                @if ($tbl_custom_field->type == 'radio')
                @if ($datavalue != '')
                <?php
                $radio_selected_value = getRadioSelectedValue($tbl_custom_field->id, $datavalue);
                ?>
                <td>{{ $radio_selected_value }}</td>
                @else
                <td>{{ trans('message.Data not available') }}</td>
                @endif
                @else
                @if ($datavalue != null)
                <td>{{ $datavalue }}</td>
                @else
                <td>{{ trans('message.Data not available') }}</td>
                @endif
                @endif
                @endforeach
                @endif
                <!-- Custom Field Data End -->
                @canany(['companyvehicle_edit', 'companyvehicle_sell','companyvehicle_delete'])
                <td>
                  <div class="dropdown_toggle">
                    <img src="{{ URL::asset('public/img/list/dots.png') }}" class="btn dropdown-toggle border-0" type="button" id="dropdownMenuButtonAction" data-bs-toggle="dropdown" aria-expanded="false">

                    <ul class="dropdown-menu heder-dropdown-menu action_dropdown shadow py-2" aria-labelledby="dropdownMenuButtonAction">
                      @can('companyvehicle_sell')
                          <li><a class="dropdown-item" href="{!! url('/company_vehicle/sell/' . $products->id) !!}"><img src="{{ URL::asset('public/img/list/pay.png') }}" class="me-3"> {{ trans('Sell') }}</a></li>
                          @endcan

                          @can('companyvehicle_edit')
                          <li><a class="dropdown-item" href="{!! url('/company_vehicle/edit/' . $products->id) !!}"><img src="{{ URL::asset('public/img/list/Edit.png') }}" class="me-3"> {{ trans('message.Edit') }}</a></li>
                          @endcan

                          @can('companyvehicle_delete')
                          <div class="dropdown-divider"></div>
                          <li><a class="dropdown-item sa-warning" url="{!! url('/company_vehicle/delete/' . $products->id) !!}" style="color:#FD726A"><img src="{{ URL::asset('public/img/list/Delete.png') }}" class="me-3">{{ trans('message.Delete') }}</a></li>
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
          @can('companyvehicle_delete')
          <button id="select-all-btn" class="btn select_all"><input type="checkbox" name="selectAll"> {{ trans('message.Select All') }} </button>
          <button id="delete-selected-btn" class="btn btn-danger text-white border-0" data-url="{!! url('/product/list/delete/') !!}"><i class="fa fa-trash" aria-hidden="true"></i></button>
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
<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>

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
</script>
@endsection