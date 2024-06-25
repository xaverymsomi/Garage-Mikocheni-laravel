@extends('layouts.app')
@section('content')

<!-- page content -->
<div class="right_col" role="main">
  <div class="">
    <div class="page-title">
      <div class="nav_menu">
        <nav>
          <div class="nav toggle">
            <a id="menu_toggle"><i class="fa fa-bars sidemenu_toggle"></i></a>
            <span class="titleup">{{ trans('message.New System Update') }}(v3.0.5)
            </span>
          </div>

          @include('dashboard.profile')
        </nav>
      </div>
    </div>
  </div>
  @if (session('message'))
  <div class="row massage">
    <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="checkbox checkbox-success checkbox-circle mb-2 alert alert-success alert-dismissible fade show">
        <input id="checkbox-10" type="checkbox" checked="">
        <label for="checkbox-10 colo_success" style="margin-left: 20px;font-weight: 600;"> {{ session('message') }} </label>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close" style="padding: 1rem 0.75rem;"></button>
      </div>
    </div>
  </div>
  @endif 
  <div class="p-5" style="height: 80vh;">
    <section id="" class="">
      <h6>{!! trans('message.Please update the system to the latest version to continue. Please click on the <strong>Install Update</strong> button to start the update process.') !!}</h6>
      <i class="fa fa-exclamation-triangle" aria-hidden="true"></i>{!! trans(('message.<strong> We recommend</strong> that you take the <strong>database & file</strong> backup first before updating to the new version.')) !!}<br><br>
      <center><a class="btn btn-success updateDB" url="{!! url('/Update_version') !!}">{{ trans('message.Install Update') }}</a></center>
    </section>
  </div>
</div>

<!-- Scripts starting -->
<script src="{{ URL::asset('vendors/jquery/dist/jquery.min.js') }}"></script>
<!-- language change in user selected -->
<script>
  $(document).ready(function() {

    $('body').on('click', '.updateDB', function() {

      var url = $(this).attr('url');

      var msg1 = "{{ trans('message.Are You Sure?') }}";
      var msg2 = "{{ trans('message.This action will update your database to the latest version.') }}";
      var msg3 = "{{ trans('message.Cancel') }}";
      var msg4 = "{{ trans('message.Yes, update!') }}";
      var msg5 = "{{ trans('message.Done!') }}";
      var msg6 = "{{ trans('message.Database Updated Successfully') }}";
      var msg7 = "{{ trans('message.OK') }}";
      var msg8 = "✅{{ trans('message.I have taken a backup of the database and files.') }}";


      swal({
        title: msg1,
        text: msg2 +'\n\n' + msg8,
        icon: 'warning',
        cancelButtonColor: '#C1C1C1',
        buttons: [msg3, msg4],
        dangerMode: true,
      }).then((isConfirm) => {
        if (isConfirm) {
          $.ajax({
            type: 'GET',
            url: url,
            success: function() {
              swal({
                title: msg5,
                text: msg6,
                icon: 'success',
                cancelButtonColor: '#C1C1C1',
                buttons: {
                  cancel: msg7,
                },
                dangerMode: true,
              }).then(() => {
                window.location.href = '{{ url('/') }}';
              });
            }
          });
        }
      });
    });

  });
</script>
@endsection