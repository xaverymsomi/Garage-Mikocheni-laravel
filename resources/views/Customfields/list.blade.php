@extends('layouts.app')
@section('content')
<style>
  @media screen and (max-width:540px) {
    div#customfields_info {
      margin-top: -179px;
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
          <a id="menu_toggle"><i class="fa fa-bars sidemenu_toggle"></i></a><span class="titleup">{{ trans('message.Custom Fields') }}
              @can('customfield_add')
              <a href="{!! url('setting/custom/add') !!}" id="">
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
    @if(!empty($tbl_custom_fields) && count($tbl_custom_fields) > 0)
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel table_up_div">
          <table id="supplier" class="table jambo_table" style="width:100%">
            <thead>
              <tr>
                @can('customfield_delete')
                <th></th>
                @endcan
                <th>{{ trans('message.Form Name') }}</th>
                <th>{{ trans('message.Label') }}</th> 
                <th>{{ trans('message.Type') }}</th>
                <th>{{ trans('message.Required') }}</th>

                @canany(['customfield_edit', 'customfield_delete'])
                <th>{{ trans('message.Action') }}</th>
                @endcan
              </tr>
            </thead>
            <tbody>
              <?php $i = 1; ?>
              @foreach ($tbl_custom_fields as $tbl_custom_field)
              <tr data-user-id="{{ $tbl_custom_field->id }}">
                <!-- <td>{{ $i }}</td> -->
                @can('customfield_delete')
                <td>
                  <label class="container checkbox">
                    <input type="checkbox" name="chk">
                    <span class="checkmark"></span>
                  </label>
                </td>
                @endcan

                <td>
                <a href="{!! url('/setting/custom/list/edit/' . $tbl_custom_field->id) !!}">{{ trans('message.' . $tbl_custom_field->form_name) }}</a>
                </td>
                <td>{{ $tbl_custom_field->label }}</td>
                <td>{{ trans('message.' . ucfirst($tbl_custom_field->type)) }}</td>
                <td>{{ trans('message.' . ucfirst($tbl_custom_field->required)) }}</td>

                @canany(['customfield_edit', 'customfield_delete'])
                <td>
                  <div class="dropdown_toggle">
                    <img src="{{ URL::asset('public/img/list/dots.png') }}" class="btn dropdown-toggle border-0" type="button" id="dropdownMenuButtonaction" data-bs-toggle="dropdown" aria-expanded="false">

                    <ul class="dropdown-menu heder-dropdown-menu action_dropdown shadow py-2" aria-labelledby="dropdownMenuButtonaction">
                      @can('customfield_edit')
                      <li><a class="dropdown-item" href="{!! url('/setting/custom/list/edit/' . $tbl_custom_field->id) !!}"><img src="{{ URL::asset('public/img/list/Edit.png') }}" class="me-3"> {{ trans('message.Edit') }}</a></li>
                      @endcan

                      @can('customfield_delete')
                      <div class="dropdown-divider m-0"></div>
                      <li><a class="dropdown-item sa-warning" url="{!! url('/setting/custom/list/delete/' . $tbl_custom_field->id) !!}" style="color:#FD726A"><img src="{{ URL::asset('public/img/list/Delete.png') }}" class="me-3">{{ trans('message.Delete') }}</a></li>
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
          @can('customfield_delete')
          <button id="select-all-btn" class="btn select_all"><input type="checkbox" name="selectAll"> {{ trans('message.Select All') }}</button>
          <button id="delete-selected-btn" class="btn btn-danger text-white border-0" data-url="{!! url('/setting/custom/list/delete/') !!}"><i class="fa fa-trash" aria-hidden="true"></i></button>
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



    /*delete customefield*/
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