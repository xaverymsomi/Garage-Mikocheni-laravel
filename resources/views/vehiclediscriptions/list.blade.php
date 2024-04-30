@extends('layouts.app')

@section('content')
  <div class="right_col"
    role="main">
    <div class="">
      <div class="page-title">
        <div class="title_left">
          <h3>{{ trans('message.VehicalDiscriptions List') }}</h3>
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
            <ul class="nav nav-tabs"
              role="tablist">
              <li role="presentation"
                class="active"><a href="{!! url('/vehicaldiscriptions/list') !!}"><span class="visible-xs"><i
                      class="ti-info-alt"></i></span> {{ trans('message.VehicalDiscriptions List') }}</a></li>




              <li role="presentation"
                class=""><a href="{!! url('/vehicaldiscriptions/add') !!}"><span class="visible-xs"><i
                      class="ti-info-alt"></i></span> {{ trans('message.Add VehicalDiscriptions') }}</a></li>

            </ul>
          </div>
          <div class="x_panel">
            <table id="datatable"
              class="table table-striped "
              style="margin-top:20px;">
              <thead>
                <tr>
                  <th>#</th>
                  <th>{{ trans('message.Vehical Name') }}</th>
                  <th>{{ trans('message.Vehical Discriptions') }}</th>
                  <th>{{ trans('message.Action') }}</th>

                </tr>
              </thead>
              <tbody>
                <?php $i = 1; ?>
                @foreach ($vdescription as $vdescriptions)
                  <tr>

                    <th>{{ $i }}</th>

                    <th>{{ getVehicalDescription($vdescriptions->vehicle_id) }}
                    <th>{{ $vdescriptions->vehicle_description }}</th>

                    <th>


                      <a href="{!! url('/vehicaldiscriptions/list/edit/' . $vdescriptions->id) !!}"> <button type="button"
                          class="btn btn-round btn-success">{{ trans('message.Edit') }}</button></a>

                      <a url="{!! url('/vehicaldiscriptions/list/delete/' . $vdescriptions->id) !!}"
                        class="sa-warning"> <button type="button"
                          class="btn btn-round btn-danger">{{ trans('message.Delete') }}</button></a>
                    </th>

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
