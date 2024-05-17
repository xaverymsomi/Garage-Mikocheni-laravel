<script language="javascript">
    function PrintElem(el) {
        if ("{{ $page_action }}" === "mobile_app") {
            window.location.href = "{{ url('gatepass/gatepasspdf/' . $getpassdata->jobcard_id) }}?page_action={{ $page_action }}";
        } else {
            var restorepage = $('body').html();
            var printcontent = $('#' + el).clone();
            $('body').empty().html(printcontent);
            window.print();
            $('body').html(restorepage);
            window.location.reload();
        }
    }
</script>
</head>

<body>
    <div id="getpassprint">

        <div class="row mx-4">
            <div class="col-md-6 col-sm-6 col-xs-6 col-xl-6 col-xxl-6 col-lg-6 mt-2">
                <img src="..//public/general_setting/<?php echo $setting->logo_image; ?>" class="system_logo_img">
            </div>
            <div class="col-md-6 col-sm-6 col-xs-6 col-xl-6 col-xxl-6 col-lg-6 mt-1 gate_pass">
                <div class="col-12 d-flex align-items-start m-1 mx-0">
                    <img src="{{ URL::asset('public/img/icons/Vector (14).png') }}">
                    <div class="col mx-2">
                        <?php echo $setting->address; ?>
                    </div>
                </div>
                <div class="mb-1">{{ trans('message.Gate Pass No. :') }}
                    <span class="txt_color fw-bold"><?php echo $getpassdata->gatepass_no; ?></span>
                </div>
            </div>
            <hr />
            <tr>
                <h3 align="center"><u>{{ trans('message.Gate Pass Details') }}</u></h3><br>
            </tr>

            <div class="modal-body">
                <div class="row">
                    <table class="table table-bordered table-responsive gate_pass" width="100%" border="1" style="border-collapse:collapse;">

                        <tbody>

                            <tr>
                                <td class="">{{ trans('message.Name') }}:</td>
                                <td class="txt_color fw-bold"> <?php echo $getpassdata->name ?></td>
                            </tr>

                            <tr>
                                <td class="">{{ trans('message.Jobcard Number') }}:</td>
                                <td class="txt_color fw-bold"> <?php echo $getpassdata->jobcard_id; ?></td>
                            </tr>

                            <tr>
                                <td class="">{{ trans('message.Vehicle Name') }}:</td>
                                <td class="txt_color fw-bold"> <?php echo $getpassdata->modelname; ?></td>
                            </tr>

                            <tr>
                                <td class="">{{ trans('message.Vehicle Type') }}:</td>
                                <td class="txt_color fw-bold"> {{ getVehicleType($vehicle->vehicletype_id) }}</td>
                            </tr>

                            <tr>
                                <td class="">{{ trans('message.Number Plate') }}:</td>
                                <td class="txt_color fw-bold"><?php echo $getpassdata->number_plate; ?></td>
                            </tr>

                            <tr>
                                <td class="">{{ trans('message.Chassis No') }}.:</td>
                                <td class="txt_color fw-bold">{{ $getpassdata->chassisno ?? trans('message.Not Added') }}</td>
                            </tr>

                            
                            <tr>
                                <td class="">{{ trans('message.Service Date') }}:</td>
                                <td class="txt_color fw-bold"> {{ date(getDateFormat() . ' H:i:s', strtotime($getpassdata->service_date)) }}</td>
                            </tr>

                            <tr>
                                <td class="">{{ trans('message.Vehicle Out Date') }}:</td>
                                <td class="txt_color fw-bold">{{ date(getDateFormat() . ' H:i:s', strtotime($getpassdata->service_out_date)) }}</td>
                            </tr>

                            <tr>
                                <td class=""> {{ trans('message.Created On:') }}</td>
                                <td class="txt_color fw-bold">{{ date(getDateFormat() . ' H:i:s', strtotime($getpassdata->created_at)) }}</td>
                            </tr>

                            <tr>
                                <td class="">{{ trans('message.Created By:') }}</td>
                                <td class="txt_color fw-bold"><?php echo getAssignTo($getpassdata->create_by); ?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 col-lg-12 col-xl-12 col-xxl-12 col-sm-12 col-xs-12 modal-footer mx-2 gatepass-footer-button">
            <button type="button" class="btn btn-outline-secondary printbtn btn-sm mx-2 pdfbutton" id="" onclick="PrintElem('getpassprint')"><img src="{{ URL('public/img/icons/Print (1).png') }}" class="pdfButton"></button>
            <a href="{{ url('gatepass/gatepasspdf/' . $getpassdata->jobcard_id) }}?page_action={{ $page_action }}" class="prints tagAforPdfBtn"><button type="button" class="btn btn-outline-secondary pdfButton btn-sm mx-0"><img src="{{ URL('public/img/icons/PDF.png') }}" class="pdfButton"></button></a>
            <a href="" class="prints tagAforCloseBtn"><button type="button" data-bs-dismiss="modal" class="btn btn-outline-secondary closeButton btn-sm m-0">{{ trans('message.Close') }}</button></a>
        </div>
    </div>
</body>