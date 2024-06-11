@extends('layouts.app')
@section('content')
<script src="{{ URL::asset('build/js/jquery.min.js') }}"></script>
<style>
    @media (max-width: 576px) {
        .ms-4 {
            margin-top: 5px;
            margin-left: 0px !important;
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
                    <a id="menu_toggle"><i class="fa fa-bars sidemenu_toggle"></i></a><a href="{!! url('/observation/list') !!}" id=""><i class=""><img src="{{ URL::asset('public/supplier/Back Arrow.png') }}"></i><span class="titleup">
                                {{ trans('message.Add Observation') }}</span></a>
                    </div>
                    @include('dashboard.profile')
                </nav>
            </div>
        </div>

        @include('success_message.message')

        <div class="clearfix"></div>

        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_content">
                    <div class="">
                        <div class="clearfix"></div>
                    </div>

                    <div class="x_panel">
                        <br />
                        <form id="form_add" action="{{ url('/observation/store') }}" method="post" enctype="multipart/form-data" data-parsley-validate class="form-horizontal form-label-left observationAddForm">

                            <div class="row {{ $errors->has('veh_name') ? ' has-error' : '' }} row-mb-0">
                                <label class="control-label col-md-3 col-lg-3 col-xl-3 col-xxl-3 col-sm-3 col-xs-3 checkpointtext text-end" for="veh_name">{{ trans('message.Vehicle Model Name') }} <label class="color-danger">*</label></label>
                                <div class="col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4">
                                    <select required name="veh_name[]" class="form-select vehical_name" multiple="multiple" id="">
                                    <option value="0">General</option>    
                                    <!-- @foreach ($vehicle_name as $datas)
                                        <option value="{{ $datas->id }}">{{ getvehicleBrand($datas->id) }}/{{ $datas->modelname }}/{{ $datas->number_plate }}</option>
                                    @endforeach -->
                                    @foreach ($model_name as $datas)
                                        <option value="{{ $datas->id }}">{{ getVehicleBrands($datas->brand_id) }}/{{ $datas->model_name }}</option>
                                    @endforeach
                                    </select>
                                    @if ($errors->has('veh_name'))
                                    <span class="help-block">
                                        {{ $errors->first('veh_name') }}
                                    </span>
                                    @endif


                                </div>
                                <div class="col-md-3 col-lg-3 col-xl-3 col-xxl-3 col-sm-3 col-xs-3"> </div>
                            </div>

                            <div class="row {{ $errors->has('checkpoint_name1') ? ' has-error' : '' }} row-mb-0">
                                <label class="control-label col-md-3 col-lg-3 col-xl-3 col-xxl-3 col-sm-3 col-xs-3 checkpointtext text-end" for="checkpoint_name">{{ trans('message.Checkpoint Category') }} <label class="color-danger">*</label></label>
                                <div class="col-md-3 col-lg-3 col-xl-3 col-xxl-3 col-sm-3 col-xs-3">
                                    <select name="checkpoint_name1" class="form-control form-select col-md-7 col-xs-12 category check_cat" id="chkveg" id="veh_name" required="true" disabled="true">
                                        <option value="">{{ trans('message.Select Category') }}</option>
                                        @foreach ($cat_name as $cat_names)
                                            <option value="{{ $cat_names->checkout_point }}" data-checkpoint-id="{{ $cat_names->id }}">
                                                {{ $cat_names->checkout_point }}
                                            </option>
                                        @endforeach
                                    </select>

                                    @if ($errors->has('checkpoint_name1'))
                                        <span class="help-block">
                                            {{ $errors->first('checkpoint_name1') }}
                                        </span>
                                    @endif

                                    <input type="hidden" value="" name="checkpoint_name" id="val_app" />
                                    <input type="hidden" value="" name="checkpoint_id" id="val_checkpoint_id" />
                                </div>

                                <div class="col-md-3 col-lg-3 col-xl-3 col-xxl-3 col-sm-3 col-xs-3 addremove1">
                                    <button type="button" class="btn btn-outline-secondary_observation" data-bs-toggle="modal" data-bs-target="#add_category">{{ trans('+') }}</button>
                                </div>
                            </div>

                            <input type="hidden" name="_token" value="{{ csrf_token() }}">


                            <div class="row parentClass_1 {{ $errors->has('checkpoint') ? ' has-error' : '' }}">
                                <label class="control-label col-md-3 col-lg-3 col-xl-3 col-xxl-3 col-sm-3 col-xs-3 checkpointtext text-end">{{ trans('message.Check Point') }}<label class="color-danger">&nbsp;&nbsp;*</label></label>
                                <div class="col-md-3 col-lg-3 col-xl-3 col-xxl-3 col-sm-3 col-xs-3">
                                    <input id="author_email" placeholder="{{ trans('message.Enter Checkpoint Name') }}" name="checkpoint[]" maxlength="30" type="text" class="form-control checkpoint checkpointsData" required="true" disabled="true" rowid="1">
                                    <span id="checkpointsData-error_1" class="help-block error-help-block color-danger d-none">{{ trans('message.Start should be alphabets only after supports alphanumeric, space, dot, @, _, and - are allowed.') }}</span>
                                </div>
                                <div class="col-md-3 col-lg-3 col-xl-3 col-xxl-3 col-sm-3 col-xs-3 addremove1">
                                    <button type="button" id="add_new_check" class="btn btn-outline-secondary add_field_button" url="">{{ trans('+') }}</button>
                                </div>
                            </div>
                            <div class="checkpointname"></div>



                            <div class="row mt-3">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <!-- <div class="col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6 form-group">
                                   <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                    <div class="col-md-12 col-sm-12 col-xs-12 text-center"> -->
                                    <!-- <a class="btn observationAddCancelButton" href="{{ URL::previous() }}">{{ trans('message.CANCEL') }}</a> -->
                                    <!-- </div>
                                </div> -->
                                <!-- </div>  -->
                                <div class="row col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6 form-group my-2 mx-0">
                                    <button type="submit" class="btn v_check observationAddSubmitButton">{{ trans('message.SUBMIT') }}</button>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="add_category" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">{{ trans('message.Add New Checkpoint Category') }}</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="row form-group">
                    <div class="col-md-8 col-lg-8 col-xl-8 col-xxl-8 col-sm-8 col-xs-8">
                        <input id="cat" placeholder="{{ trans('message.Enter Checkpoint Category Name') }}" name="category" type="text" class="form-control model_input add_newcat" value="" maxlength="25" required />
                    </div>
                    <div class="col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4 text-center">
                        <button type="button" class="btn btn-success model_submit add_cat btn-sm mx-3">{{ trans('message.Submit') }}</button>
                    </div>
                </div>
                <!-- <table class="table producttype" align="center">
                      <tbody>
                      @foreach ($cat_name as $cat_names)
                        <tr class="data_of_type row mx-1">
                          <td class="text-start col-6">{{ $cat_names->checkout_point }}</td>
                          <td class="text-end col-6">
                            <button type="button" data-id="{{ $cat_names->id }}" deleteproduct="{!! url('deleteuser/') !!}" class="btn btn-danger text-white border-0 deleteproducted"><i class="fa fa-trash" aria-hidden="true"></i></button>
                          </td>
                        </tr>
                       
                        @endforeach
                      </tbody>
                    </table> -->
             
            </div>
            <div class="modal-footer border-top-0">
            </div>
        </div>
    </div>
</div>
<!-- /page content -->


   <!-- Scripts starting -->
   <script>

        var msg1 = "{{ trans('message.Are You Sure?') }}";
    var msg2 = "{{ trans('message.You will not be able to recover this data afterwards!') }}";
    var msg3 = "{{ trans('message.Cancel') }}";
    var msg4 = "{{ trans('message.Yes, delete!') }}";
    var msg5 = "{{ trans('message.Done!') }}";
    var msg6 = "{{ trans('message.Manufacturer Deleted Successfully') }}";
    var msg7 = "{{ trans('message.Cancelled') }}";
    var msg8 = "{{ trans('message.Your data is safe') }}";
    var unitdelete = "{{ trans('message.Unit Of Measurement Deleted Successfully') }}";
    var colordelete = "{{ trans('message.Color Deleted Successfully') }}";

        $(document).ready(function() {

                /*Product Type Delete  model*/
    $('body').on('click', '.deleteproducted', function() {
        // alert('delete');
      var ptypeid = $(this).attr('data-id');
      var url = $(this).attr('deleteproduct');
      swal({
        title: msg1,
        text: msg2,
        icon: 'warning',
        cancelButtonColor: '#C1C1C1',
        buttons: [msg3, msg4],
        dangerMode: true,
      }).then((isConfirm) => {
        if (isConfirm) {
          $.ajax({
            type: 'GET',
            url: url,
            data: {
              ptypeid: ptypeid
            },
            success: function() {
              $('.del-' + ptypeid).remove();
              $(".data_of_type option[value=" + ptypeid + "]")
                .remove();
              swal({
                title: msg5,
                text: msg6,
                icon: "success",
                cancelButtonColor: '#C1C1C1',
                buttons: {
                  cancel: msg35,
                },
                dangerMode: true,
              });

            }
          });
        } else {
          swal({
            title: msg7,
            text: msg8,
            icon: "success",
            cancelButtonColor: '#C1C1C1',
            buttons: {
              cancel: msg35,
            },
            dangerMode: true,
          });

        }
      });


    });
 
            $('.vehical_name').select2();
            var msg7 = "{{ trans('message.OK') }}"

            $('.v_check').click(function() {
                var vehical_name = $('.vehical_name').val();

                var msg1 = "{{ trans('message.Select Vehicles') }}";
                var msg2 = "{{ trans('message.Please Select Vehicles Name') }}";

                if (vehical_name == null) {
                    swal({  
                        title: msg1,  
                        text: msg2,  
                        icon: 'warning',
                        cancelButtonColor: '#C1C1C1',
                        buttons: {
                            cancel: msg7,
                        },
                        dangerMode: true,
                    });
                    
                    //alert("Please select vehicle name");
                }
            });



            $('body').on('change', '.check_cat', function() {
                var check_cat = $('.check_cat option:selected').text();
                var checkpoint_id = $('.check_cat option:selected').data('checkpoint-id');

                $('#val_app').val(check_cat);
                $('#val_checkpoint_id').val(checkpoint_id);
            });

            var max_fields = 20; //maximum input boxes allowed
            var wrapper = $(".checkpointname"); //Fields wrapper
            var add_button = $(".add_field_button"); //Add button ID
            var x = 1; //initlal text box count
            $(add_button).click(function(e) { //on add input button click
                e.preventDefault();
                if (x < max_fields) { //max input box allowed
                    x++;
                    $(wrapper).append('<div class="row mt-3 parentClass_' + x +
                        '"><label class="control-label checkpointtext col-md-3 col-lg-3 col-xl-3 col-xxl-3 col-sm-3 col-xs-3 text-end">{{ trans('message.Check Point') }}<label class="color-danger">&nbsp;&nbsp;*</label></label>' +
                        '<input class="form-control col-md-3 col-lg-3 col-xl-3 col-xxl-3 col-sm-3 col-xs-3 addcheckpoint checkpointsData checkpointsDataddmore" maxlength="30" id="chek_pt" type="text" placeholder="{{ trans('message.Enter Checkpoint Name') }}" required="true" name="checkpoint[]" rowid="' +
                        x + '"/>' + 
                        '<a href="#" class="col-md-3 col-lg-3 col-xl-3 col-xxl-3 col-sm-3 col-xs-3 remove_field ms-4"><i class="fa fa-trash fa-2x" aria-hidden="true"></i></a></div>'
                    );
                }
            });

            $(wrapper).on("click", ".remove_field", function(e) {
                e.preventDefault();
                $(this).parent('div').remove();
                x--;
            })




            $('.add_cat').click(function() {

                var url = "<?php echo url('/newcategory'); ?>";
                var category = $('.add_newcat').val();
                var vehical_name = $('.vehical_name').val();

                var msg1 = "{{ trans('message.Select Vehicles') }}";
                var msg2 = "{{ trans('message.Please Select Vehicles Name') }}";
                var msg3 = "{{ trans('message.Enter Category Name') }}";
                var msg4 = "{{ trans('message.Please enter category name') }}";
                var msg5 = "{{ trans('message.Error Message') }}";
                var msg6 = "{{ trans('message.Somthing went wrong') }}";
                var msg40 = "{{ trans('message.Alert') }}";
                var msg41 =
                    "{{ trans('message.Start should be alphabets only after supports alphanumeric, space, dot, @, _, and - are allowed.') }}";
                var msg42 = "{{ trans('message.Successfully Submitted') }}";

                if (vehical_name == null || category == '') {
                    if (vehical_name == null) {

                        swal({  
                            title: msg1,  
                            text: msg2,  
                            icon: 'warning',
                            cancelButtonColor: '#C1C1C1',
                            buttons: {
                                cancel: msg7,
                            },
                            dangerMode: true,
                        });
                    } else if (category == '') {

                        swal({  
                            title: msg3,  
                            text: msg4,  
                            icon: 'warning',
                            cancelButtonColor: '#C1C1C1',
                            buttons: {
                                cancel: msg7,
                            },
                            dangerMode: true,
                        });
                    }
                // } else if (!category.match(
                //         /^[a-zA-Z0-9\u0621-\u064A\u00C0-\u017F\u0600-\u06FF\u0750-\u077F\uFB50-\uFDFF\uFE70-\uFEFF\u2E80-\u2FD5\u3190-\u319f\u3400-\u4DBF\u4E00-\u9FCC\uF900-\uFAAD\u0900-\u097F\s]*$/
                //     )) {
                //         swal({  
                //             title: msg40,  
                //             text: msg41,  
                //             icon: 'warning',
                //             cancelButtonColor: '#C1C1C1',
                //             buttons: {
                //                 cancel: msg7,
                //             },
                //             dangerMode: true,
                //         });
                    
                } else {
                    $.ajax({
                        type: 'GET',
                        url: url,
                        data: {
                            category: category,
                            vehical_name: vehical_name
                        },
                        success: function(response) {
                            $('.category').append("<option value=" + category + " data-checkpoint-id=" + response + " selected>" +
                                category + "</option>");
                            $('#val_app').val(category);
                            $('#val_checkpoint_id').val(response);
                            $('.add_newcat').val("");
                            $('#add_category').modal('toggle');
                        },
                        error: function() {

                            swal({  
                                title: msg5,  
                                text: msg6,  
                                icon: 'warning',
                                cancelButtonColor: '#C1C1C1',
                                buttons: {
                                    cancel: msg7,
                                },
                                dangerMode: true,
                            });
                        }
                    });
                }

            });

            /*If vehicle name select is empty then checkpoint category and checkpoint both field are disabled, otherwise both field are unables*/
            $('body').on('change', '.vehical_name', function() {

                var vahicleValue = $(this).val();

                if (vahicleValue != null) {
                    $('.check_cat').attr('disabled', false);
                    $('.checkpoint').attr('disabled', false);
                }
            });

            /*Manually using Jquery to make validation for error time make full div danger color alert*/
            $('body').on('keyup', '.checkpointsData', function() {

                var checkpointValue = $(this).val();
                var regexs =
                    /^[a-zA-Z0-9\u0621-\u064A\u00C0-\u017F\u0600-\u06FF\u0750-\u077F\uFB50-\uFDFF\uFE70-\uFEFF\u2E80-\u2FD5\u3190-\u319f\u3400-\u4DBF\u4E00-\u9FCC\uF900-\uFAAD\u0900-\u097F\s]*$/;

                var ids = $(this).attr("rowid");

                if (!checkpointValue.replace(/\s/g, '').length) {
                    $(this).val("");
                // } else if (!regexs.test(checkpointValue)) {
                //     $(this).val("");
                //     $('#checkpointsData-error_' + ids).css({
                //         "display": ""
                //     });
                //     $('.parentClass_' + ids).addClass('has-error');
                } else if (regexs.test(checkpointValue)) {
                    $('#checkpointsData-error_' + ids).css({
                        "display": "none"
                    });
                    $('.parentClass_' + ids).removeClass('has-error');
                }
            });


            /*If any white space then make empty value of these all field*/
            $('body').on('keyup', '.add_newcat', function() {

                var add_newcat = $(this).val();

                if (!add_newcat.replace(/\s/g, '').length) {
                    $(this).val("");
                }
            });

        });
    </script>

@endsection
