@extends('layouts.app')
@section('content')


<style>
  button.btn.btn-default.buttons-print {
    border: 1px solid black;
    margin-right: 10px;
  }

  button.btn.btn-default.buttons-excel {
    border: 1px solid black;
  }

  @media screen and (max-width:540px) {
    div#productreport_info {
      margin-top: -150px;
    }

    span.titleup {
      margin-left: -10px;
    }
  }
</style>

<div class="right_col servi" role="main">
  <div class="page-title">
    <div class="nav_menu">
      <nav>
        <div class="nav toggle">
        <a id="menu_toggle"><i class="fa fa-bars sidemenu_toggle"></i></a><a id=""><i class=""></i><span class="titleup">
              {{ trans('message.Reports') }}</span></a>
        </div>
        @include('dashboard.profile')
      </nav>
    </div>
  </div>

  <div class="x_content table-responsive">
    <ul class="nav nav-tabs">
      <!-- <li class="nav-item">
        @can('report_view')
        <a href="{!! url('/report/salesreport') !!}" class="nav-link nav-link-not-active"><span class="visible-xs"></span> <i class="">&nbsp;</i><b>{{ trans('message.VEHICLE SALES') }}</b></a>
        @endcan
      </li> -->
      <li class="nav-item">
        @can('report_view')
        <a href="{!! url('/report/servicereport') !!}" class="nav-link nav-link-not-active"><span class="visible-xs"></span><i class="">&nbsp;</i><b>{{ trans('message.SERVICES') }}</b></a>
        @endcan
      </li>
      <li class="nav-item">
        @can('report_view')
        <a href="{!! url('/report/productreport') !!}" class="nav-link active"><span class="visible-xs"></span><i class="">&nbsp;</i><b>{{ trans('message.PRODUCT STOCK') }}</b></a>
        @endcan
      </li>
      <li class="nav-item">
        @can('report_view')
        <a href="{!! url('/report/productuses') !!}" class="nav-link nav-link-not-active"><span class="visible-xs"></span><i class="">&nbsp;</i><b>{{ trans('message.PRODUCT USAGE') }}</b></a>
        @endcan
      </li>
      <li class="nav-item">
        @can('report_view')
        <a href="{!! url('/report/servicebyemployee') !!}" class="nav-link nav-link-not-active"><span class="visible-xs"></span><i class="">&nbsp;</i><b>{{ trans('message.EMP. SERVICES') }}</b></a>
        @endcan
      </li>
    </ul>
  </div>

  <div class="row row-mb-0">
    <div class="col-md-12 col-lg-12 col-xl-12 col-xxl-12 col-sm-12 col-xs-12">
      <div class="x_panel row-mb-0">
        <div class="x_content">
          <form method="post" action="{!! url('/report/record_product') !!}" enctype="multipart/form-data" class="form-horizontal upperform">
            <div class="row mt-3 row-mb-0">
              <div class="row col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6 has-feedback">
                <label class="control-label col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4" for="option">{{ trans('message.Manufacturer Name') }} <label class="color-danger">*</label> </label>
                <div class="col-md-8 col-lg-8 col-xl-8 col-xxl-8 col-sm-8 col-xs-8">
                  <select class="form-control select_producttype form-select" name="s_product" m_url="{!! url('/report/producttype/name') !!}" required>
                    <option value="all" <?php if ($all_product == 'all') {
                                          echo 'selected';
                                        } ?>>{{ trans('message.All') }}</option>
                    @if (!empty($Select_product))
                    @foreach ($Select_product as $Select_products)
                    <option value="{{ $Select_products->id }}" <?php if ($Select_products->id == $all_product) {
                                                                  echo 'selected';
                                                                } ?>>{{ $Select_products->type }}</option>
                    @endforeach
                    @endif
                  </select>

                </div>
              </div>

              <div class="row col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6 has-feedback">
                <label class="control-label col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4" for="option">{{ trans('message.Product Name') }} <label class="color-danger">*</label> </label>
                <div class="col-md-8 col-lg-8 col-xl-8 col-xxl-8 col-sm-8 col-xs-8">
                  <select class="form-control select_productname form-select" name="product_name" required>
                    <option value="item" <?php if ($all_item == 'item') {
                                            echo 'selected';
                                          } ?>>{{ trans('message.Items') }}</option>
                    @if (!empty($productname))
                    @foreach ($productname as $productreports)
                    <option value="{{ $productreports->id }}" <?php if ($productreports->id == $all_item) {
                                                                echo 'selected';
                                                              } ?>>{{ $productreports->name }}</option>
                    @endforeach
                    @endif
                  </select>

                </div>
              </div>
            </div>
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="row mt-3">
              <div class="col-md-12 col-lg-12 col-xl-12 col-xxl-12 col-sm-12 col-xs-12 text-lg-end">
                <button type="submit" class="btn btn-success">{{ trans('message.Go') }}</button>
              </div>
            </div>

          </form>
        </div>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">

      <div class="x_panel table_up_div">
      @if(!empty($productreport) && count($productreport) > 0)
        <table id="supplier" class="table jambo_table" style="width:100%">
          <thead>
            <tr>
              <th> </th>
              <th>{{ trans('message.Purchase Number') }}</th>
              <th>{{ trans('message.Product Number') }}</th>
              <th>{{ trans('message.Manufacturer Name') }}</th>
              <th>{{ trans('message.Product Name') }}</th>
              <th>{{ trans('message.Purchase Date') }}</th>
              <th>{{ trans('message.Supplier Name') }}</th>
              <th>{{ trans('message.Price') }} (<?php echo getCurrencySymbols(); ?>)</th>
              <th>{{ trans('message.Stock') }} </th>
            </tr>
          </thead>


          <tbody>
            <?php $i = 1; ?>
            
            @if (!empty($productreport))       
            @foreach ($productreport as $productreports)
            <tr>
              <!-- <td>
              <label class="container">
                  <input type="checkbox" name="chk">
                  <span class="checkmark"></span>
                </label>
              </td> -->
              <td>{{ $i }}</td>
              <td>
                <a href="{!! url('/purchase/list/pview/' . $productreports->purchase_id) !!}">
                  {{ getLatestPurchaseCode($productreports->product_id) }} 
                  <!-- <a data-toggle="tooltip" data-placement="bottom" title="Purchase Number" class="text-primary"><i class="fa fa-info-circle" style="color:#D9D9D9"></i></a> -->
                </a>
              </td>

              <td>
                <a href="{!! url('/product/list/' . $productreports->id) !!}">
                  {{ $productreports->product_no }} 
                  <!-- <a data-toggle="tooltip" data-placement="bottom" title="Product Number" class="text-primary"><i class="fa fa-info-circle" style="color:#D9D9D9"></i></a> -->
                </a>
              </td>
              <td>{{ getProductName($productreports->product_type_id) }} 
                <!-- <a data-toggle="tooltip" data-placement="bottom" title="Manufacturer Name" class="text-primary"><i class="fa fa-info-circle" style="color:#D9D9D9"></i></a> -->
              </td>
              <td>{{ $productreports->name }} 
                <!-- <a data-toggle="tooltip" data-placement="bottom" title="Product Name" class="text-primary"><i class="fa fa-info-circle" style="color:#D9D9D9"></i></a> -->
              </td>
              <!-- <td>{{ date(getDateFormat(), strtotime(getPurchaseDate($productreports->purchase_id))) }}</td> -->
              <td>{{ date(getDateFormat(), strtotime(getLatestPurchaseDate($productreports->product_id))) }} 
                <!-- <a data-toggle="tooltip" data-placement="bottom" title="Purchase Date" class="text-primary"><i class="fa fa-info-circle" style="color:#D9D9D9"></i></a> -->
              </td>
              <td>{{ getSupplierName(getPurchaseSupplier($productreports->purchase_id)) }} 
                <!-- <a data-toggle="tooltip" data-placement="bottom" title="Supplier Name" class="text-primary"><i class="fa fa-info-circle" style="color:#D9D9D9"></i></a> -->
              </td>
              <td>{{ $productreports->price }} 
                <!-- <a data-toggle="tooltip" data-placement="bottom" title="Price( <?php echo getCurrencySymbols(); ?> )" class="text-primary"><i class="fa fa-info-circle" style="color:#D9D9D9"></i></a> -->
              </td>
              <td>{{ getTotalStock($productreports->id) }} 
                <!-- <a data-toggle="tooltip" data-placement="bottom" title="Stock" class="text-primary"><i class="fa fa-info-circle" style="color:#D9D9D9"></i></a> -->
              </td>
            </tr>
            <?php $i++; ?>
            @endforeach
            @endif
          </tbody>
        </table>
      @else
        <p class="d-flex justify-content-center"><img src="{{ URL::asset('public/img/dashboard/No-Data.png') }}" width="300px"></p>
      @endif
      </div>

    </div>

  </div>
</div>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!-- language change in user selected -->

<script>
  $(document).ready(function() {

    var pdf = "{{ trans('message.PDF') }}";
    var print = "{{ trans('message.print') }}";
    var excel = "{{ trans('message.excel') }}";

    var search =  "{{ trans('message.Search...') }}";
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
      dom: 'Bfrtip',

      buttons: [{
          extend: 'pdf',
          text: pdf
        },
        {
          extend: 'print',
          text: print
        },
        {
          extend: 'excel',
          text: excel
        }
      ],
     
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
      }]
    });
  });


  $('.select_producttype').change(function() {
    var m_id = $(this).val();

    var url = $(this).attr('m_url');

    $.ajax({
      type: 'GET',
      url: url,
      data: {
        m_id: m_id
      },
      success: function(response) {
        $('.select_productname').html(response);
      }
    });
  });
</script>


@endsection