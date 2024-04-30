@extends('layouts.app')

@section('content')
  <!-- page content -->
  <div class="right_col"
    role="main">
    <div class="">
      <div class="page-title">

        <div class="nav_menu">
          <nav>
            <div class="nav toggle">
              <a id="menu_toggle"><i class="fa fa-bars"></i><span class="titleup">&nbsp;
                  {{ trans('message.Observation Type') }}</span></a>
            </div>
            @include('dashboard.profile')
          </nav>
        </div>
      </div>
      @if (session('message'))
        <div class="row massage">
          <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="checkbox checkbox-success checkbox-circle mb-2 alert alert-success alert-dismissible fade show">

              <label for="checkbox-10 colo_success" style="margin-left: 20px;font-weight: 600;"> {{ session('message') }} </label>
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close" style="padding: 1rem 0.75rem;"></button>
            </div>
          </div>
        </div>
      @endif

      <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">


          <div class="x_content">
            <ul class="nav nav-tabs bar_tabs"
              role="tablist">
              <li role="presentation"
                class="active"><a href="{!! url('/observation_type/list') !!}"><span class="visible-xs"></span> <i
                    class="fa fa-list fa-lg">&nbsp;</i><b>{{ trans('message.List Of Observation Type') }}</b></span></a></li>

              <li role="presentation"
                class=""><a href="{!! url('/observation_type/add') !!}"><span class="visible-xs"></span> <i
                    class="fa fa-plus-circle fa-lg">&nbsp;</i>{{ trans('message.Add Observation Type') }}</span></a></li>


            </ul>
          </div>
          <div class="x_panel table_up_div">
            <table id="datatable-buttons"
              class="table table-striped jambo_table"
              style="margin-top:20px;">
              <thead>
                <tr>
                  <th>{{ trans('message.#') }}</th>
                  <th>{{ trans('message.Observation Type') }}</th>
                  <th>{{ trans('message.Action') }}</th>

                </tr>
              </thead>


              <tbody>

                <?php $i = 1; ?>
                @foreach ($o_type_point as $o_type_points)
                  <tr>
                    <td>{{ $i }}</td>

                    <td>{{ $o_type_points->type }}</td>

                    <td>

                      <a href="{!! url('/observation_type/list/edit/' . $o_type_points->id) !!}"><button type="button"
                          class="btn btn-round btn-success">{{ trans('message.Edit') }}</button></a>
                      <a url="{!! url('/observation_type/list/delete/' . $o_type_points->id) !!}"
                        class="sa-warning"><button type="button"
                          class="btn btn-round btn-danger">{{ trans('message.Delete') }}</button></a>
                    </td>
                  </tr>
                  <?php $i++; ?>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>





      </div>
    </div>
  </div>
  <script src="{{ URL::asset('vendors/jquery/dist/jquery.min.js') }}"></script>
  <!-- /page content -->
  <script>
    $('body').on('click', '.sa-warning', function() {

      var url = $(this).attr('url');

      var msg1 = "{{ trans('message.Are You Sure?') }}";
      var msg2 = "{{ trans('message.You will not be able to recover this data afterwards!') }}";
      var msg3 = "{{ trans('message.Cancel') }}";
      var msg4 = "{{ trans('message.Yes, delete!') }}";

      swal({
        title: msg1,
        text: msg2,
        type: "warning",
        showCancelButton: true,
        cancelButtonText: msg3,
        cancelButtonColor: "#C1C1C1",
        confirmButtonColor: "#297FCA",
        confirmButtonText: msg4,
        closeOnConfirm: false
      }, function() {
        window.location.href = url;
      });
    });
  </script>
@endsection
