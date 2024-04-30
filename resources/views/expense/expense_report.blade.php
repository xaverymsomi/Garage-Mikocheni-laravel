@extends('layouts.app')
@section('content')

<!-- page content -->
<div class="right_col" role="main">
  <div class="">
    <div class="page-title">
      <div class="nav_menu">
        <nav>
          <div class="nav toggle">
          <a id="menu_toggle"><i class="fa fa-bars sidemenu_toggle"></i></a><a href="{!! url('/expense/list') !!}" id=""><i class=""><img src="{{ URL::asset('public/supplier/Back Arrow.png') }}"></i><span class="titleup">
                {{ trans('message.Expenses') }}</span></a>
          </div>
          @include('dashboard.profile')
        </nav>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-md-12 col-lg-12 col-xl-12 col-xxl-12 col-sm-12 col-xs-12">
      <div class="x_panel">
        <div class="x_content">
          <form method="post" action="{{ url('/expense/expense_report') }}" enctype="multipart/form-data" class="form-horizontal upperform">
            <div class="col-md-12 col-xs-12 col-sm-12">
              <h4><b>{{ trans('message.Expenses Details') }}</b></h4>
              <hr style="margin-top:0px;">
              <p class="col-md-12 col-xs-12 col-sm-12"></p>
            </div>

            <div class="row">
              <div class="col-md-4">
                <b>{{ trans('message.Start Date') }} :</b> {{ date(getDateFormat(), strtotime($start_date)) }}
              </div>
              <div class="col-md-4">
                <b>{{ trans('message.End Date') }} :</b> {{ date(getDateFormat(), strtotime($end_date)) }}
              </div>
            </div>

            @if(!empty($month_expense) && count($month_expense) > 0)
            <div class="x_panel table_up_div">
              <table id="supplier" class="table jambo_table" style="margin-top:20px;">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>{{ trans('message.Main Label') }}</th>
                    <th>{{ trans('message.Expense Label') }}</th>
                    <th>{{ trans('message.Expense Amount') }} ( <?php echo getCurrencySymbols(); ?> )</th>
                    <th>{{ trans('message.Status') }}</th>
                    <th>{{ trans('message.Date') }}</th>

                  </tr>
                </thead>

                <tbody>
                  <?php $i = 1; ?>
                  @if (!empty($month_expense))
                  @foreach ($month_expense as $month_expenses)
                  <tr>
                    <td>{{ $i }}</td>
                    <td>{{ $month_expenses->main_label }} <a data-toggle="tooltip" data-placement="bottom" title="Main Label" class="text-primary"><i class="fa fa-info-circle" style="color:#D9D9D9"></i></a></td>
                    <td>{{ $month_expenses->label_expense }} <a data-toggle="tooltip" data-placement="bottom" title="Expense Label" class="text-primary"><i class="fa fa-info-circle" style="color:#D9D9D9"></i></a></td>
                    <td>{{ $month_expenses->expense_amount }} <a data-toggle="tooltip" data-placement="bottom" title="Expense Amount( <?php echo getCurrencySymbols(); ?> )" class="text-primary"><i class="fa fa-info-circle" style="color:#D9D9D9"></i></a></td>
                    @if ($month_expenses->status == 1)
                    <td style="color: rgb(0, 128, 0);">{{ trans('message.Full Paid') }} <a data-toggle="tooltip" data-placement="bottom" title="Status" class="text-primary"><i class="fa fa-info-circle" style="color:#D9D9D9"></i></a></td>
                    @elseif($month_expenses->status == 2)
                    <td style="color: rgb(255, 0, 0);">{{ trans('message.Unpaid') }} <a data-toggle="tooltip" data-placement="bottom" title="Status" class="text-primary"><i class="fa fa-info-circle" style="color:#D9D9D9"></i></a></td>
                    @else($month_expenses->status==0)
                    <td style="color: rgb(255, 165, 0);">{{ trans('message.Partially paid') }} <a data-toggle="tooltip" data-placement="bottom" title="Status" class="text-primary"><i class="fa fa-info-circle" style="color:#D9D9D9"></i></a></td>
                    @endif
                    <td>{{ date(getDateFormat(), strtotime($month_expenses->date)) }} <a data-toggle="tooltip" data-placement="bottom" title="Date" class="text-primary"><i class="fa fa-info-circle" style="color:#D9D9D9"></i></a></td>

                  </tr>
                  <?php $i++; ?>
                  @endforeach
                  @endif

                </tbody>
              </table>
            </div>
            @else
            <p class="d-flex justify-content-center mt-5 pt-5"><img src="{{ URL::asset('public/img/dashboard/No-Data.png') }}" width="300px"></p>
            @endif
            <input type="hidden" name="_token" value="{{ csrf_token() }}">

          </form>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- /page content -->

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<script>
  $(document).ready(function() {

    var search = "{{ trans('message.Search...') }}";
    var info = "{{ trans('message.Showing page _PAGE_ - _PAGES_') }}";
    var zeroRecords = "{{ trans('message.Nothing found - sorry') }}";
    var infoEmpty = "{{ trans('message.No records available') }}";

    /*language change in user selected*/
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



    $('.datepicker').datetimepicker({
      format: "<?php echo getDatepicker(); ?>",
    });
  });
</script>

@endsection