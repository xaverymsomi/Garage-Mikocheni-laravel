@extends('layouts.app')
@section('content')
<script src="{{ URL::asset('vendors/jquery/dist/jquery.min.js') }}"></script>
<!-- page content -->
<style>
    .panel-title {
        background-color: #f5f5f5;
        padding: 10px 15px;
    }
    .float-right {
        float: right;
    }
</style>
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="nav_menu">
                <nav>
                    <div class="nav toggle">
                    <a id="menu_toggle"><i class="fa fa-bars sidemenu_toggle"></i></a><span class="titleup">{{ trans('message.Observation Library') }}
                            @can('observationlibrary_add')
                            <a href="{!! url('/observation/add') !!}" id="">
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

        <div class="row massage" style="display: none">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="checkbox checkbox-success checkbox-circle mb-2 alert alert-success alert-dismissible fade show">
                    <label for="checkbox-10 colo_success" style="margin-left: 20px;font-weight: 600;">
                        {{ trans('message.Checkpoint Updated Successfully') }} </label>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close" style="padding: 1rem 0.75rem;"></button>
                </div>
            </div>
        </div>
        <div class="row delete_message" style="display: none">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="checkbox checkbox-success checkbox-circle mb-2 alert alert-success alert-dismissible fade show">
                    <label for="checkbox-10 colo_success" style="margin-left: 20px;font-weight: 600;">
                        {{ trans('message.Checkpoint Deleted Successfully') }} </label>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close" style="padding: 1rem 0.75rem;"></button>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_content">
                </div>
                <div class="x_panel table_up_div">
                    <div class="panel-heading addpoint">
                        @if (count($check_data) !== 0)
                        @foreach ($check_data as $check_datas)
                        <div class="panel-group " id="accordion1">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a data-bs-toggle="collapse" data-bs-parent="#accordion1" href="#collapseTwo-<?php echo $check_datas->vehicle_id; ?>" class="emailacordin d-inline plsmins<?php echo $check_datas->vehicle_id; ?>">
                                            <i class="plus-minus fa fa-plus plsmins"> </i>
                                            @if ($check_datas->vehicle_id == '0')
                                            {{ 'General' }}
                                            @else
                                            {{ getModel($check_datas->vehicle_id) }}
                                        </a>
                                        @endif
                                       <!-- <a class="float-right check_delete">
                                            <i class="fa fa-trash" aria-hidden="true"></i>
                                        </a> -->
                                    </h4>
                                </div>
                                <div id="collapseTwo-<?php echo $check_datas->vehicle_id; ?>" class="panel-collapse collapse inplus">
                                    <div class="panel-body">
                                        <!-- Here we insert another nested accordion -->
                                        <div class="panel-group" id="accordion2">
                                            <div class="panel panel-default">
                                                <?php
                                                $vehiclepopints = Getvehiclecheckpoint($check_datas->vehicle_id);

                                                foreach ($vehiclepopints as $vehiclepopintss) {
                                                ?>
                                                    <div class="panel-heading">
                                                        <h4 class="panel-title">
                                                            <a data-bs-toggle="collapse" data-parent="#accordion2" href="#collapseInnerTwo-<?php echo $vehiclepopintss->id; ?>" class="emailacordin d-inline plsmins<?php echo $vehiclepopintss->id; ?>"><i class="plus-minus fa fa-plus">
                                                                </i>
                                                                <p class="d-inline">{{ $vehiclepopintss->checkout_point }}</p>
                                                            </a>
                                                            <a class="float-right sub_check_delete" cid="{{ $vehiclepopintss->id }}" c_url="{!! url('/sub_check_delete') !!}">
                                                                <i class="fa fa-trash" aria-hidden="true"></i>
                                                            </a>
                                                        </h4>
                                                    </div>
                                                    <div id="collapseInnerTwo-<?php echo $vehiclepopintss->id; ?>" class="panel-collapse collapse inplus">
                                                        <div class="panel-body">
                                                            <div class="form-group table-responsive">
                                                                @php
                                                                $i = 1;
                                                                $subcategory = getCheckPointSubCategory($vehiclepopintss->checkout_point, $check_datas->vehicle_id);
                                                                @endphp
                                                                @if ($subcategory !== null)
                                                                <table class="table">
                                                                    <thead>
                                                                        <tr>
                                                                            <td><b></b></td>
                                                                            <td><b>{{ trans('message.Checkpoints') }}</b></td>
                                                                            @canany(['observationlibrary_edit',
                                                                            'observationlibrary_delete'])
                                                                            <td><b>{{ trans('message.Action') }}</b></td>
                                                                            @endcanany
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        <?php

                                                                        if ($subcategory !== null) {
                                                                            foreach ($subcategory as $subcategorys) {
                                                                        ?>
                                                                                <tr class="id{{ $subcategorys->checkout_point }}">
                                                                                    <td><?php echo $i++; ?></td>
                                                                                    <td class="row{{ $subcategorys->checkout_point }}">
                                                                                        <?php echo $subcategorys->checkout_point . '<br>'; ?>
                                                                                    </td>
                                                                                    @canany(['observationlibrary_edit',
                                                                                    'observationlibrary_delete'])
                                                                                    <td>
                                                                                        <div class="dropdown_toggle">
                                                                                            <img src="{{ URL::asset('public/img/list/dots.png') }}" class="dropdown-toggle border-0 ms-3" type="button" id="dropdownMenuButtonAction" data-bs-toggle="dropdown" aria-expanded="false">
                                                                                     
                                                                                            <ul class="dropdown-menu heder-dropdown-menu action_dropdown shadow py-2" aria-labelledby="dropdownMenuButtonAction">                                                                                      
                                                                                                @can('observationlibrary_edit')
                                                                                                <li><button type="button" class="dropdown-item btn_edit_observation" data-bs-toggle="modal" data-bs-target="#updateform" edit_id="{{ $subcategorys->id }}">
                                                                                                    <img src="{{ URL::asset('public/img/list/Edit.png') }}" class="me-3"> {{ trans('message.Edit') }}</button></a></li>
                                                                                                @endcan
                                                                                                @can('observationlibrary_delete')
                                                                                                <div class="dropdown-divider m-0"></div>
                                                                                                <li><a url="{{ url('deleteuser/') }}" class="btn_del dropdown-item px-3 pt-2" data-id="{{ $subcategorys->id }}" data-id="{{ $subcategorys->id }}" style="color:#FD726A">
                                                                                                    <img src="{{ URL::asset('public/img/list/Delete.png') }}" class="me-3">{{ trans('message.Delete') }}</a></li>
                                                                                                @endcan
                                                                                            </ul>
                                                                                        </div>
                                                                                    </td>
                                                                                    @endcanany
                                                                                </tr>
                                                                        <?php
                                                                            }
                                                                        }
                                                                        ?>
                                                                    </tbody>
                                                                </table>
                                                                @else
                                                                <p class="d-flex justify-content-center mt-5 pt-5"><img src="{{ URL::asset('public/img/dashboard/No-Data.png') }}" width="300px"></p>
                                                                @endif

                                                            </div>
                                                        </div>
                                                    </div>

                                                    <script>
                                                        $(document).ready(function() {
                                                            var i = 0;
                                                            $('.plsmins{{ $vehiclepopintss->id }}').click(function() {
                                                                i = i + 1;
                                                                if (i % 2 != 0) {
                                                                    $(this).parent().find(".fa-plus:first").removeClass("fa-plus").addClass(
                                                                        "fa-minus");
                                                                } else {
                                                                    $(this).parent().find(".fa-minus:first").removeClass("fa-minus").addClass(
                                                                        "fa-plus");
                                                                }
                                                            });
                                                        });
                                                    </script>

                                                <?php
                                                }
                                                ?>
                                            </div>
                                        </div>
                                        <!-- Inner accordion ends here -->
                                    </div>
                                </div>
                            </div>
                        </div>
                        <script>
                            $(document).ready(function() {
                                var i = 0;
                                $('.plsmins{{ $check_datas->vehicle_id }}').click(function() {
                                    i = i + 1;
                                    if (i % 2 != 0) {
                                        $(this).parent().find(".fa-plus:first").removeClass("fa-plus").addClass("fa-minus");
                                    } else {
                                        $(this).parent().find(".fa-minus:first").removeClass("fa-minus").addClass("fa-plus");
                                    }
                                });
                            });
                        </script>
                        @endforeach
                        @else
                        <p class="d-flex justify-content-center mt-5 pt-5"><img src="{{ URL::asset('public/img/dashboard/No-Data.png') }}" width="300px"></p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



<!-- Modal for edit category -->
<div id="updateform" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">{{ trans('message.Edit Chekpoint') }}</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">

            </div>

           
        </div>
    </div>
</div>


<script src="{{ URL::asset('vendors/jquery/dist/jquery.min.js') }}"></script>

    <script>
        $(document).ready(function() {
            $('.btn_del').click(function() {
                var url = $(this).attr('url');
                var id = $(this).attr('data-id');
                var deleteMsg = $('.msgDelete').val();

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

                        $.ajax({
                            type: 'get',
                            url: url,
                            data: {
                                id: id
                            },

                            success: function(data) {
                                window.location.href = url;
                                window.location.href = '{{ url('observation/list') }}';
                                $(".delete_message").css("display", "");
                            },
                        });
                    }
                });

            });





            $('.btn_edit_observation').click(function() {

                var url = "<?php echo url('/editcheckpoin'); ?>"
                var id = $(this).attr('edit_id');

                var msg5 = "{{ trans('message.Somthing went wrong') }}";

                $.ajax({
                    type: 'GET',
                    url: url,
                    data: {
                        id: id
                    },

                    success: function(response) {
                        $('.modal-body').html(response.html);
                    },
                    error: function() {
                        alert(msg5);
                    }
                });
            });



            $('body').on('click', '.submit_edit', function() {

                var url = "<?php echo url('/submitnewname'); ?>"
                var id = $('.check_point_id').val();
                var subpoints = $("input[name='checkpoint[]']")
                    .map(function() {
                        return $(this).val();
                    }).get();

                var updateMsg = $('.msgUpdate').val();
                var checkpointValue = $('#sub_ch').val();
                var regexs =
                    /^[a-zA-Z0-9\u0621-\u064A\u00C0-\u017F\u0600-\u06FF\u0750-\u077F\uFB50-\uFDFF\uFE70-\uFEFF\u2E80-\u2FD5\u3190-\u319f\u3400-\u4DBF\u4E00-\u9FCC\uF900-\uFAAD\u0900-\u097F\s]*$/;

                if (checkpointValue == null || checkpointValue == "") {
                    $('.chekpoint_sub').val("");
                    $('#checkpoints_edit_error1').css({
                        "display": ""
                    });
                    $('.form_group_error').addClass('has-error');
                    $('#checkpoints_edit_error').css({
                        "display": "none"
                    });
                // } else if (!regexs.test(checkpointValue)) {
                //     //$('.chekpoint_sub').val("");
                //     $('#checkpoints_edit_error').css({
                //         "display": ""
                //     });
                //     $('.form_group_error').addClass('has-error');
                //     $('#checkpoints_edit_error1').css({
                //         "display": "none"
                //     });
                } else {

                    $('#checkpoints_edit_error').css({
                        "display": "none"
                    });
                    $('.form_group_error').removeClass('has-error');
                    $('#checkpoints_edit_error1').css({
                        "display": "none"
                    });

                    $('.modal').modal('hide');

                    $.ajax({
                        type: 'GET',
                        url: url,
                        data: {
                            id: id,
                            subpoints: subpoints
                        },
                        success: function(response) {
                            window.location.href = '{{ url('observation/list') }}';
                            $(".massage").css("display", "");
                        },
                    });
                }
            })

            var max_fields = 20; //maximum input boxes allowed
            var wrapper = $(".items"); //Fields wrapper
            var add_button = $(".add_field_button"); //Add button ID      
            var x = 1; //initlal text box count
            $('body').on('click', '.add_field_button', function(e) {


                e.preventDefault();
                if (x < max_fields) { //max input box allowed
                    x++;
                    $(wrapper).append(
                        '<div class="form-group"><label class="control-label model_input col-md-4 col-sm-3 col-xs-12">{{ trans('message.Check Point') }}<label class="">&nbsp;&nbsp;*</label></label>' +
                        '<input class="form-control model_submit col-md-7 col-xs-12" idid="chek_pt" type="text" placeholder="{{ trans('message.Enter Checkpoint Name') }}" name="checkpoint[]" required="true"/>' +
                        '&nbsp;&nbsp;' +
                        '<a href="#" class="remove_field"><i class="fa fa-times mt-1"></a></div>'
                    );
                }
            });

            $(wrapper).on("click", ".remove_field", function(e) {
                e.preventDefault();
                $(this).parent('div').remove();
                x--;
            });


            $(function() {

                function toggleIcon(e) {
                    $(e.target)
                        .prev('.panel-heading')
                        .find(".plus-minus")
                        .toggleClass('glyphicon-plus glyphicon-minus');
                }
                $('.panel-group').on('hidden.bs.collapse', toggleIcon);
                $('.panel-group').on('shown.bs.collapse', toggleIcon);
            });

            $('body').on('keyup', '#sub_ch', function() {

                var editValue = $(this).val();
                var regexs =
                    /^[a-zA-Z0-9\u0621-\u064A\u00C0-\u017F\u0600-\u06FF\u0750-\u077F\uFB50-\uFDFF\uFE70-\uFEFF\u2E80-\u2FD5\u3190-\u319f\u3400-\u4DBF\u4E00-\u9FCC\uF900-\uFAAD\u0900-\u097F\s]*$/;

                if (!editValue.replace(/\s/g, '').length) {
                    $(this).val("");
                    $('#checkpoints_edit_error1').css({
                        "display": ""
                    });
                    $('.form_group_error').addClass('has-error');
                    $('#checkpoints_edit_error').css({
                        "display": "none"
                    });
                } else if (!regexs.test(editValue)) {
                    $('#checkpoints_edit_error').css({
                        "display": ""
                    });
                    $('.form_group_error').addClass('has-error');
                    $('#checkpoints_edit_error1').css({
                        "display": "none"
                    });
                } else if (regexs.test(editValue)) {
                    $('#checkpoints_edit_error').css({
                        "display": "none"
                    });
                    $('.form_group_error').removeClass('has-error');
                    $('#checkpoints_edit_error1').css({
                        "display": "none"
                    });
                }

            });

        });
    </script>
    <script>
    $(document).ready(function() {
        $('body').on('click', '.check_delete', function() {
            // Your existing script here
            alert('check_delete');
        });

        $('body').on('click', '.sub_check_delete', function() {
            var cid = $(this).attr('cid');
            var c_url = $(this).attr('c_url');

            swal({
                title: "{{ trans('message.Are You Sure?') }}",
                text: "{{ trans('message.You will not be able to recover this data afterwards!') }}",
                icon: "warning",
                buttons: {
                    cancel: "{{ trans('message.Cancel') }}",
                    confirm: {
                        text: "{{ trans('message.Yes, delete!') }}",
                        value: true,
                        visible: true,
                        className: "btn-danger",
                        closeModal: false
                    }
                },
                dangerMode: true,
                cancelButtonColor: "#C1C1C1",
            }).then((isConfirm) => {
                if (isConfirm) {
                    // User confirmed, proceed with the delete
                    $.ajax({
                        type: 'GET',
                        url: c_url,
                        data: {
                            cid: cid
                        },
                        success: function(data) {
                            swal({
                                title: "{{ trans('message.Done!') }}",
                                text: "{{ trans('message.Checkpoint Deleted Successfully') }}",
                                icon: 'success',
                                cancelButtonColor: '#C1C1C1',
                                buttons: {
                                    cancel: "{{ trans('message.Cancel') }}",
                                },
                                dangerMode: true,
                            });
                            window.location.reload();
                        },
                        error: function(error) {
                            console.log('Error:', error);
                        }
                    });
                } else {
                    // User canceled
                    swal({
                        title: "{{ trans('message.Cancelled') }}",
                        text: "{{ trans('message.Your data is safe') }}",
                        icon: 'error',
                        cancelButtonColor: '#C1C1C1',
                        buttons: {
                            cancel: "{{ trans('message.Cancel') }}",
                        },
                        dangerMode: true,
                    });
                }
            });
        });

    });
</script>
@endsection
