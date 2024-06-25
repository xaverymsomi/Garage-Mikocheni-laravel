@extends('layouts.app')
@section('content')

<style>
  .right_side .table_row,
  .member_right .table_row {
    border-bottom: 1px solid #dedede;
    float: left;
    width: 100%;
    padding: 1px 0px 4px 2px;
  }

  .table_row .table_td {
    padding: 8px 8px !important;
  }

  .report_title {
    float: left;
    font-size: 20px;
    width: 100%;
  }
</style>
<!-- page content -->
<div class="right_col" role="main">
  <div class="">
    <div class="page-title">
      <div class="nav_menu">
        <nav>
          <div class="nav toggle">
            <a id="menu_toggle"><i class="fa fa-bars sidemenu_toggle"></i></a><span class="titleup me-0"><a href="{!! url('/supplier/list') !!}"><i class=""><img src="{{ URL::asset('public/supplier/Back Arrow.png') }}" class="mb-0"></i></a><span class="titleup"> {{ $user->name }}</span>
          </div>
          @include('dashboard.profile')
        </nav>
      </div>
    </div>
  </div>
  <div class="view_page_header_bg">
    <div class="row">
      <div class="col-xl-10 col-md-9 col-sm-10">
        <div class="user_profile_header_left">
          <img class="user_view_profile_image" src="{{ URL::asset('public/supplier/' . $user->image) }}">
          <div class="row">
            <div class="view_top1">
              <div class="col-xl-12 col-md-12 col-sm-12">
                <label class="nav_text h5 user-name">
                  {{ $user->name }}&nbsp;
                </label>
                @can('supplier_edit')
                <div class="view_user_edit_btn d-inline">
                  <a href="{!! url('/supplier/list/edit/' . $user->id) !!}">
                    <img src="{{ URL::asset('public/img/dashboard/Edit.png') }}">
                  </a>
                </div>
                @endcan
              </div>
              <div class="col-xl-12 col-md-12 col-sm-12 nav_text mt-2">
                <div class="d-lg-inline">
                  <i class=" fa fa-phone"></i> {{ $user->mobile_no }}
                </div>
                <div class="d-lg-inline">
                  <i class=" fa fa-envelope"></i> {{ $user->email }}
                </div>
              </div>
              <div class="col-xl-12 col-md-12 col-sm-12 heading_view mt-3" style="width: 90%;">
                <i class="fa-solid fa-location-dot"></i>
                <lable class="">
                  {{ $user->address }}
                  <!-- , <?php echo getCityName($user->city_id) != null ? getCityName($user->city_id) . ',' : ''; ?>{{ getStateName($user->state_id) }}, {{ getCountryName($user->country_id) }}. -->
                </lable>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-xl-2 col-lg-3 col-md-3 col-sm-2">
        <div class="group_thumbs">
          <img src="{{ URL::asset('public/img/dashboard/Design.png') }}" height="93px" width="134px">
        </div>
      </div>
    </div>
  </div>

  <section id="" class="">

    <div class="panel-body padding_0 pb-0">
      <div class="row mt-4">
        <div class="col-xl-12 col-md-12 col-sm-12 table-responsive">
          <ul class="nav nav-tabs" role="tablist">
            <li class="active">
              <a class="tab active fw-bold">
                {{ trans('message.general') }}</a>
            </li>
          </ul>

        </div>
      </div>
      <div class="row margin_top_15px mx-1">
        <div class="col-xl-3 col-md-3 col-sm-6">
          <label class=""> {{ trans('message.Email') }} </label><br>
          <label class=""><b>{{ $user->email }}</b><br></label>
        </div>
        <div class="col-xl-3 col-md-3 col-sm-6">
          <label class=""> {{ trans('message.Gender') }} </label><br>
          <span class="txt_color"><b>
              @if ($user->gender == '0')
              <?php echo trans('message.Male'); ?>
              @else
              <?php echo trans('message.Female'); ?>
              @endif
            </b></span>
        </div>
        <div class="col-xl-3 col-md-3 col-sm-6">
          <label class=""> {{ trans('message.Company Name') }}</label><br>
          <label class=""><b>
              {{ $user->company_name }}</b><br>
          </label>
        </div>
      </div>
      <div class="row mt-3">
        <div class="col-xl-6 col-md-6 col-sm-6">
          <div class="guardian_div">

            <p class="fw-bold overflow-visible h5"> {{ trans('message.More Info') }}. </p>
            <div class="row">

              <div class="col-xl-12 col-md-12 col-sm-12 mt-1">
                <label class=""> {{ trans('message.Product Name') }}: </label>
                <label class="fw-bold">
                  {{ getProductList($user->id) ?? trans('message.Not Added') }}
                </label>
              </div>

              <div class="col-xl-12 col-md-12 col-sm-12 mt-1">
                <label class=""> {{ trans('message.Landline No.') }} : </label>
                <label class="fw-bold">
                  {{ $user->landline_no ?? trans('message.Not Added')}}
                </label>
              </div>


              @if (!empty( $tbl_custom_fields->count() )!== 0)
              @foreach ($tbl_custom_fields as $tbl_custom_field)
              <?php
              $tbl_custom = $tbl_custom_field->id;
              $userid = $user->id;

              $datavalue = getCustomData($tbl_custom, $userid);
              ?>
              @if ($tbl_custom_field->type == 'radio')
              @if ($datavalue != '')
              <?php
              $radio_selected_value = getRadioSelectedValue($tbl_custom_field->id, $datavalue);
              ?>
              <div class="col-xl-12 col-md-12 col-sm-12 mt-1">
                <label class="">{{ $tbl_custom_field->label }} : </label>
                <label class="fw-bold">
                  {{ $radio_selected_value }}<br>
                </label>
              </div>

              @endif
              @else
              @if ($datavalue != '')
              <div class="col-xl-12 col-md-12 col-sm-12 mt-1">
                <label class="">{{ $tbl_custom_field->label }} : </label>
                <label class="fw-bold">
                  {{ $datavalue }}<br>
                </label>
              </div>

              @endif
              @endif
              @endforeach
              @else
              <p style="text-align: center;">{{ trans('message.Data not available') }}</p>
              @endif
            </div>
          </div>
        </div>
        <div class="col-xl-6 col-md-6 col-sm-6">
          <div class="guardian_div">
            <p class="fw-bold overflow-visible h5"> {{ trans('message.Address Details') }} </p>
            <div class="row">
              <div class="col-xl-6 col-md-6 col-sm-12 mt-1">
                <label class=""> {{ trans('message.Country') }}: </label>
                <label class="fw-bold">
                  {{ getCountryName($user->country_id) ?? trans('message.Not Added')}}
                </label>
              </div>
              <div class="col-xl-6 col-md-6 col-sm-12 mt-1">
                <label class=""> {{ trans('message.State') }}: </label>
                <label class="fw-bold">
                  {{ getStateName($user->state_id) ?? trans('message.Not Added') }}
                </label>
              </div>
              <div class="col-xl-12 col-md-12 col-sm-12 mt-1">
                <label class=""> {{ trans('message.Town/City') }}: </label>
                <label class="fw-bold">
                  {{ getCityName($user->city_id) ?? trans('message.Not Added') }}
                </label>
              </div>
              <!-- <div class="col-xl-6 col-md-6 col-sm-12 mt-1">
                <label class=""> {{ trans('message.Address') }}: </label>
                <label class="text-dark fw-bold">{{ $user->address ?? trans('message.Not Added') }}</label>
              </div> -->
            </div>

          </div>

        </div>
      </div>
    </div>
    <!-- END PANEL BODY DIV-->

  </section>
</div>

<!-- /page content -->

@endsection