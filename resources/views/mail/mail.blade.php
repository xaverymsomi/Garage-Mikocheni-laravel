@extends('layouts.app')
@section('content')
<style>
  .panel-title {
    background-color: #FFEFE6;
  }
</style>
<!-- mail editor -->
<!-- <script src="https://cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script> -->
<script src="{!! URL::asset('public/vendor/ckeditor/ckeditor.js') !!}"></script>
<!-- mail editor -->
<!-- <script src="https://cdn.tiny.cloud/1/ /tinymce/5/tinymce.min.js" referrerpolicy=" "></script> -->


<!-- page content -->
<div class="right_col" role="main">
  <div class="col-md-12 col-lg-12 col-xl-12 col-xxl-12 col-sm-12 col-xs-12">
    <div class="page-title">
      <div class="nav_menu">
        <nav>
          <div class="nav toggle">
            <a id="menu_toggle"><i class="fa fa-bars sidemenu_toggle"></i></a><span class="titleup">
              {{ trans('message.Email Templates') }}</span></a>
          </div>
          @include('dashboard.profile')
        </nav>
      </div>
    </div>
    @include('success_message.message')
    <div class="row">
      <div class="col-md-12 col-lg-12 col-xl-12 col-xxl-12 col-sm-12 col-xs-12">
      </div>
      <div class="col-12 panel-group bg-white p-0">
        <div class="accordion" id="accordionExample">
          <!-- SUPER ADMIN Accordion Starting (New)-->
          @php
          $i = 0;
          @endphp
          @foreach ($mailformat as $mailformats)


          <div class="accordion-item mb-3 mt-3">
            <h4 class="accordion-header" id="#collapse{{ $mailformats->id }}">
              <a class="accordion-button collapsed panel-title" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{ $mailformats->id }}" aria-expanded="false" aria-controls="collapse{{ $mailformats->id }}">
                {{ trans('message.' . $mailformats->notification_label)}}
              </a>
            </h4>

            <div id="collapse{{ $mailformats->id }}" class="accordion-collapse collapse" aria-labelledby="collapse{{ $mailformats->id }}" data-bs-parent="#accordionExample">
              <div class="accordion-body">
                <form class="form-horizontal" method="post" action="mail/emailformat/{{ $mailformats->id }}" name="parent_form">

                  <input type="hidden" name="_token" value="{{ csrf_token() }}">

                  <div class="row ">
                    <label for="first_name" class="col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4 checkpointtext text-end control-label">{{ trans('message.Email Subject') }} <span class="color-danger">*</span> </label>
                    <div class="col-md-8 col-lg-8 col-xl-8 col-xxl-8 col-sm-8 col-xs-8">
                      <input class="form-control validate[required]" name="subject" id="Member_Registration" placeholder="Enter email subject" value="{{ $mailformats->subject }}" required>
                    </div>
                  </div>
                  <div class="row mt-3">
                    <label for="first_name" class="col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4 checkpointtext text-end control-label">{{ trans('message.Sender email') }} <span class="color-danger">*</span> </label>
                    <div class="col-md-8 col-lg-8 col-xl-8 col-xxl-8 col-sm-8 col-xs-8">
                      <input class="form-control validate[required]" name="send_from" id="Member_Registration" placeholder="Enter Sender Email" value="{{ $mailformats->send_from }}" required>
                    </div>
                  </div>
                  <input class="form-control validate[required]" type="hidden" name="mail_id" id="mail_id" value="">

                  <div class="row mt-3">
                    <label for="first_name" class="col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4 control-label checkpointtext text-end">{{ trans('message.Registration Email Template') }}
                      <span class="color-danger">*</span> </label>
                    <div class="col-md-8 col-lg-8 col-xl-8 col-xxl-8 col-sm-8 col-xs-8">
                      <!-- Generate a unique ID for each CKEditor instance -->
                      @php
                      $editorId = 'editor_' . $mailformats->id;
                      @endphp
                      <textarea name="notification_text" id="{{ $editorId }}" class="form-control validate[required] txt_area" required><?php echo $mailformats->notification_text; ?></textarea>

                      <!-- Initialize CKEditor with the unique ID -->
                      <script>
                        CKEDITOR.replace('{{ $editorId }}', {
                          toolbar: [{
                              name: 'styles',
                              items: ['Bold', 'Italic']
                            },
                            {
                              name: 'basicstyles',
                              items: ['Underline', 'Subscript', 'Superscript', 'RemoveFormat']
                            },
                            {
                              name: 'paragraph',
                              items: ['NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'Blockquote', 'CreateDiv']
                            },
                            {
                              name: 'undo',
                              items: ['Undo', 'Redo']
                            },
                            {
                              name: 'styles',
                              items: ['Format', 'Font', 'FontSize']
                            },
                            {
                              name: 'document',
                              items: ['Source']
                            }
                          ],
                          format_tags: 'p;h1;h2;h3;h4;h5;h6',
                        });
                      </script>

                    </div>
                  </div>

                  <div class="row mt-3">
                    <div class="col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4"> </div>
                    <div class="col-md-8 col-lg-8 col-xl-8 col-xxl-8 col-sm-8 col-xs-8">
                      {{ trans('message.You can use following variables in the email template') }}<br>
                      <label><strong><?php echo $mailformats->description_of_mailformate; ?><br></strong></label>
                    </div>
                  </div>
                  <div class="row mt-3">
                    <div class="col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4"></div>
                    <div class="col-md-8 col-lg-8 col-xl-8 col-xxl-8 col-sm-8 col-xs-8">
                      {{ trans('message.Is Send') }}<br>
                    </div>
                  </div>
                  <div class="row mt-3">
                    <div class="col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4"> </div>
                    <div class="col-md-8 col-lg-8 col-xl-8 col-xxl-8 col-sm-8 col-xs-8 ps-0">
                      <label class="radio-inline">
                        <input type="radio" name="is_send" value="0" @if ($mailformats->is_send == 0) checked @endif>{{ trans('message.Enable') }}
                      </label>
                      <label class="radio-inline">
                        <input type="radio" name="is_send" value="1" @if ($mailformats->is_send == 1) checked @endif>{{ trans('message.Disable') }}
                      </label>
                    </div>
                  </div>
                  @can('emailtemplate_edit')
                  <div class="row mt-3">
                    <div class="col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4"> </div>
                    <div class="col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6">
                      <input type="submit" value="{{trans('message.Save')}}" class="btn btn-success">
                    </div>
                  </div>
                  @endcan
                </form>
              </div>
            </div>
          </div>
          @endforeach

        </div>
      </div>
    </div>
  </div>
</div>
<!-- /page content -->


<!-- Scripts starting -->
<script src="{{ URL::asset('vendors/jquery/dist/jquery.min.js') }}"></script>

<script>
  $(function() {

    function toggleIcon(e) {
      // alert(e.target);
      $(e.target)
        .prev('.panel-heading')
        .find(".plus-minus")
        .toggleClass('fa-plus fa-minus');
    }
    $('.panel-group').on('hidden.bs.collapse', toggleIcon);
    $('.panel-group').on('shown.bs.collapse', toggleIcon);
  });
</script>

<script src="//ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script>
  window.jQuery || document.write('<script src="js/vendor/jquery-3.3.1.min.js"><\/script>')
</script>

<script src="//ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script>
  window.jQuery || document.write('<script src="js/vendor/jquery-3.3.1.min.js"><\/script>')
</script>

<!-- <script src="/trumbowyg-main/dist/trumbowyg.min.js"></script> -->
@endsection