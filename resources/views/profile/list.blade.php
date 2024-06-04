@extends('layouts.app')

@section('content')
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="nav_menu">
                <nav>
                    <div class="nav toggle">
                        &nbsp;<a id="menu_toggle"><i class="fa fa-bars sidemenu_toggle"></i></a><span class="titleup">{{ trans('message.Profile Setting') }}</span>
                        </span>
                    </div>
                    @include('dashboard.profile')
                </nav>
            </div>
        </div>
    </div>
    @include('success_message.message')
    <!-- <div class="x_content">
            <ul class="nav nav-tabs">
                <li class="nav-item">
                    <a href="{!! url('/setting/profile') !!}" class="nav-link active"><span class="visible-xs"></span> <i
                            class="">&nbsp;</i><b>{{ trans('message.PROFILE SETTING') }}</b></a>
                </li>
            </ul>
        </div> -->

    <div class="view_page_header_img">
        <img class="view_page_header_bgimg" src="{{ url('public/general_setting/' . $settings_data->cover_image) }}">
        <!-- <img class="shadow_img_profile" src="{{ URL::asset('public/general_setting/Rectangle 505.png') }}"> -->

        <div class="row">
            <div class="col-xl-10 col-md-9 col-sm-10">
                <div class="user_profile_header_left">
                    
                    <div class="row">
                        <div class="view_top1">
                            <div class="col-xl-12 col-md-12 col-sm-12">
                                <label class="nav_text h5 user-name profile">
                                    {{ $profile->name }}&nbsp;
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="clearfix"></div>
    <div class="row">
        <div class="col-md-12 col-lg-12 col-xl-12 col-xxl-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_content">
                    <form id="profileEditForm" action="profile/update/{{ $profile->id }}" method="post" enctype="multipart/form-data" class="form-horizontal upperform">

                        <div class="row">
                            <div class="col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6 mt-3 has-feedback {{ $errors->has('firstname') ? ' has-error' : '' }}">
                                <label class="control-label col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4 checkpointtext text-end" for="first-name">{{ trans('Full Name') }} <label class="color-danger">*</label></label>
                                <div class="col-md-8 col-lg-8 col-xl-8 col-xxl-8 col-sm-8 col-xs-8">
                                    <input type="text" name="firstname" placeholder="{{ trans('message.Enter First Name') }}" maxlength="50" value="{{ $profile->name }}" class="form-control" required>
                                    @if ($errors->has('firstname'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('firstname') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <div class="col-md-3 col-lg-3 col-xl-3 col-xxl-3 col-sm-3 col-xs-3"></div>
                            </div>

                            
                        </div>
                        <div class="row">
                            <div class="col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6 has-feedback">
                                <label class="control-label col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4 checkpointtext text-end">{{ trans('message.Gender') }} <label class="color-danger">*</label></label>
                                <div class="col-md-8 col-lg-8 col-xl-8 col-xxl-8 col-sm-8 col-xs-8 gender">

                                    <input type="radio" name="gender" value="0" <?php if ($profile->gender == 1) {
                                                                                    echo 'checked';
                                                                                } ?> checked>
                                    {{ trans('message.Male') }}

                                    <input type="radio" name="gender" value="1" <?php if ($profile->gender == 2) {
                                                                                    echo 'checked';
                                                                                } ?>>
                                    {{ trans('message.Female') }}

                                </div>
                            </div>
                            <div class="col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6 {{ $errors->has('dob') ? ' has-error' : '' }}">
                                <label class="control-label col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4 checkpointtext text-end">{{ trans('message.Date of Birth') }}</label>
                                <div class="col-md-8 col-lg-8 col-xl-8 col-xxl-8 col-sm-8 col-xs-8 date">
                                    <?php
                                    if ($profile->birth_date != '0000-00-00') {
                                        $dob = date(getDateFormat(), strtotime($profile->birth_date));
                                    } else {
                                        $dob = '';
                                    }
                                    ?>
                                    <input type="text" id="datepicker" class="form-control datepicker1" placeholder="<?php echo getDatepicker(); ?>" value="{{ $dob; }}" name="dob" onkeypress="return false;">
                                </div>
                                @if ($errors->has('dob'))
                                <span class="help-block">
                                    <strong style="margin-left:27%;">{{ $errors->first('dob') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6 has-feedback {{ $errors->has('email') ? ' has-error' : '' }}">
                                <label class="control-label col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4 checkpointtext text-end" for="Email">{{ trans('message.Email') }} <label class="color-danger">*</label>
                                </label>
                                <div class="col-md-8 col-lg-8 col-xl-8 col-xxl-8 col-sm-8 col-xs-8">
                                    <input type="text" name="email" placeholder="{{ trans('message.Enter Email') }}" value="{{ $profile->email }}" class="form-control " maxlength="50" required>
                                    @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6 has-feedback {{ $errors->has('password') ? ' has-error' : '' }}">
                                <label class="control-label col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4 checkpointtext text-end" for="Password">{{ trans('message.New Password') }} </label>
                                <div class="col-md-8 col-lg-8 col-xl-8 col-xxl-8 col-sm-8 col-xs-8">
                                    <input type="password" name="password" placeholder="{{ trans('message.Enter Password') }}" maxlength="20" class="form-control col-md-7 col-xs-12">
                                    @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6 {{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                                <label class="control-label col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4 checkpointtext text-end" for="Password">
                                    {{ trans('message.Confirm Password') }}</label>
                                <div class="col-md-8 col-lg-8 col-xl-8 col-xxl-8 col-sm-8 col-xs-8">
                                    <input type="password" name="password_confirmation" placeholder="{{ trans('message.Enter Confirm Password') }}" maxlength="20" class="form-control col-md-7 col-xs-12">
                                    @if ($errors->has('password_confirmation'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <div class="col-md-3 col-lg-3 col-xl-3 col-xxl-3 col-sm-3 col-xs-3"></div>
                            </div>

                            <div class="col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6 has-feedback {{ $errors->has('mobile') ? 'has-error' : '' }}">
                                <label class="control-label col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4  checkpointtext text-end" for="mobile">{{ trans('message.Mobile No.') }}</label>
                                <div class="col-md-8 col-lg-8 col-xl-8 col-xxl-8 col-sm-8 col-xs-8">
                                    <input type="text" name="mobile" placeholder="{{ trans('message.Enter Mobile No') }}" value="{{ $profile->mobile_no }}" min="6" max="16" class="form-control">
                                    @if ($errors->has('mobile'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('mobile') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">

                            <div class="row col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6 productSubmitButton my-2 mx-0">
                                <button type="submit" class="btn btn-success productSubmitButton">{{ trans('message.UPDATE') }}</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /page content -->


<!-- Scripts starting -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>


<script>
    $(document).ready(function() {
        $(".datepicker1").datetimepicker({
            format: "<?php echo getDatepicker(); ?>",
            maxDate: new Date(),
            todayBtn: true,
            autoclose: 1,
            minView: 2,
            endDate: new Date(),
            language: "{{ getLangCode() }}",
        });

        /******** For image preview at selected image *******/
        function readUrl(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $('#imagePreview').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }

        $('body').on('change', '.chooseImage', function() {
            var imageName = $(this).val();
            var imageExtension = /(\.jpg|\.jpeg|\.png)$/i;

            if (imageExtension.test(imageName)) {
                $('.imageHideShow').css({
                    "display": ""
                });
            } else {
                $('.imageHideShow').css({
                    "display": "none"
                });
            }
        });


        $("#image").change(function() {
            readUrl(this);
            $("#imagePreview").css("display", "block");
        });

    });
</script>


<!-- Form field validation -->
{!! JsValidator::formRequest('App\Http\Requests\StoreProfileSettingEditFormRequest', '#profileEditForm') !!}
<!-- <script type="text/javascript" src="{{ asset('public/vendor/jsvalidation/js/jsvalidation.js') }}"></script> -->
@endsection