@extends('layouts.app')

@section('content')
<style>
  /* @media screen and (min-width:0px) and (max-width:652px) {
  .x_panel.table_up_div{
    width: fit-content;
  }
 
} */
  @media screen and (max-width:540px) {
    /* div#supplier_info {
      margin-top: -487px;
    } */

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
              <a id="menu_toggle"><i class="fa fa-bars sidemenu_toggle"></i></a><span class="titleup">&nbsp;{{ trans('message.Supplier') }}
              @can('supplier_add')
              <a href="{!! url('/supplier/add') !!}" id="">
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

  <div class="row">
  @if(!empty($user) && count($user) > 0)
    <div class="col-md-12 col-sm-12 col-xs-12 ">
      <div class="x_panel table_up_div">
        <table id="supplier" class=" table jumbo_table " style="width:100%">
          <thead>
            <tr>
              @can('supplier_delete')
              <th> </th>
              @endcan
              <th>{{ trans('Full Name') }}</th>
              <th>{{ trans('message.Email') }}</th>
              <th>{{ trans('message.Product Name') }}</th>
              <th>{{ trans('message.Action') }}</th>
            </tr>
          </thead>
          <tbody>

            <?php $i = 1; ?>
            @foreach ($user as $users)
            <tr data-user-id="{{ $users->id }}">
              @can('supplier_delete')
              <td>
                <label class="container checkbox">
                  <input type="checkbox" name="chk">
                  <span class="checkmark"></span>
                </label>
              </td>
              @endcan

              {{-- <td><a href="{!! url('/supplier/list/' . $users->id) !!}"><img src="{{ URL::asset('public/supplier/' . $users->image) }}" width="52px" height="52px" class="datatable_img"></a></td> --}}
              <td><a href="{!! url('/supplier/list/' . $users->id) !!}">{{ $users->name }}
                <!-- <a data-toggle="tooltip" data-placement="bottom" title="First Name" class="text-primary">
                  <i class="fa fa-info-circle" style="color:#D9D9D9"></i>
                </a> -->
              </a>
              {{-- </td>
              <td>{{ $users-> }}
                <!-- <a data-toggle="tooltip" data-placement="bottom" title="Last Name" class="text-primary"><i class="fa fa-info-circle" style="color:#D9D9D9"></i></a> -->
              </td> --}}
              {{-- <td>{{ $users->company_name }}
                <!-- <a data-toggle="tooltip" data-placement="bottom" title="Company Name" class="text-danger"><i class="fa fa-info-circle" style="color:#D9D9D9"></i></a> -->
              </td> --}}
              <td>{{ $users->email }}
                <!-- <a data-toggle="tooltip" data-placement="bottom" title="Email" class="text-primary"><i class="fa fa-info-circle" style="color:#D9D9D9"></i></a> -->
              </td>
              <td>{{ substr(getProductList($users->id), 0, 100) }} 
                <!-- <a data-toggle="tooltip" data-placement="bottom" title="Product Name" class="text-primary"><i class="fa fa-info-circle" style="color:#D9D9D9"></i></a> -->
                <span class="d-none">{{ getProductList($users->id) }}
                </span>
              </td>

              <td>
                <div class="dropdown_toggle">
                  <img src="{{ URL::asset('public/img/list/dots.png') }}" class="btn dropdown-toggle border-0" type="button" id="dropdownMenuButtonaction" data-bs-toggle="dropdown" aria-expanded="false">

                  <ul class="dropdown-menu heder-dropdown-menu action_dropdown shadow py-2" aria-labelledby="dropdownMenuButtonaction">
                    @can('supplier_view')
                    <li><a class="dropdown-item" href="{!! url('/supplier/list/' . $users->id) !!}"><img src="{{ URL::asset('public/img/list/Vector.png') }}" class="me-3"> {{ trans('message.View') }}</a></li>
                    @endcan

                    @can('supplier_edit')
                    <li><a class="dropdown-item" href="{!! url('/supplier/list/edit/' . $users->id) !!}"><img src="{{ URL::asset('public/img/list/Edit.png') }}" class="me-3"> {{ trans('message.Edit') }}</a></li> 
                    @endcan

                    @can('supplier_delete')
                    <div class="dropdown-divider m-0"></div>
                    <li><a class="dropdown-item sa-warning" url="{!! url('/supplier/list/delete/' . $users->id) !!}" style="color:#FD726A"><img src="{{ URL::asset('public/img/list/Delete.png') }}" class="me-3">{{ trans('message.Delete') }}</a></li>
                    @endcan
                  </ul>
                </div>
              </td>
            </tr>
            <?php $i++; ?>   

            @endforeach

          </tbody>
        </table>
        @can('supplier_delete')
        <button id="select-all-btn" class="btn select_all"><input type="checkbox" name="selectAll" class=""> {{ trans('message.Select All') }} </button>
        <button id="delete-selected-btn" class="btn btn-danger text-white border-0" data-url="{!! url('/supplier/list/delete') !!}"><i class="fa fa-trash" aria-hidden="true"></i></button>
        @endcan
        </nav>
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
        targets: 0,

      }],
      fixedColumns: true,
      paging: true,
      scrollCollapse: true,
      scrollX: true,
      // scrollY: 300,

      // var Search = "{{ trans('message.Search..') }}",

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
        aTargets: [-1],

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

<script>
  $(document).ready(function() {
    $('[data-toggle="tooltip"]').tooltip();
  });
</script>

<script type="text/javascript">
  function selects() {
    var ele = document.getElementsByName('chk');
    checked = document.getElementsByName('chk').checked;
    for (var i = 0; i < ele.length; i++) {

      ele[i].checked = true;
    }
  }

  function deSelect() {
    var ele = document.getElementsByName('chk');
    for (var i = 0; i < ele.length; i++) {
      if (ele[i].type == 'checkbox')
        ele[i].checked = false;

    }
  }
</script>



@endsection