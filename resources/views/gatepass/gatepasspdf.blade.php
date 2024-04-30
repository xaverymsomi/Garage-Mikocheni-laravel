<html dir="{{ getLangCode() === 'ar' ? 'rtl' : '' }}">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

  <style type="text/css">
    @if (getLangCode()==='hi')body,
    p,
    td,
    div,
    th {
      font-family: Poppins;
    }

    @elseif (getLangCode()==='gu') body,
    p,
    td,
    div,
    th {
      font-family: Poppins;
    }

    @elseif (getLangCode()==='ja') body,
    p,
    td,
    div,
    th {
      font-family: Poppins;
    }

    @elseif (getLangCode()==='zhcn') body,
    p,
    td,
    div,
    th {
      font-family: Poppins; // not working
    }

    @elseif (getLangCode()==='th') body,
    p,
    td,
    div,
    th,
    strong {
      font-family: Poppins;
    }

    @elseif (getLangCode()==='mr') body,
    p,
    td,
    div,
    th {
      font-family: Poppins;
    }

    @elseif (getLangCode()==='ta') body,
    p,
    td,
    div,
    th,
    strong {
      font-family: Poppins;
    }

    @else body,
    p,
    td,
    div,
    th,
    strong {
      font-family: Poppins;
    }

    @endif
    /* * {
      font-family: Poppins;
    }
    body, p, td, div, th { font-family: Poppins; } */

    @font-face {
      font-family: "Poppins" !important;
      font-weight: normal;
      font-style: italic;
    }

    body {
      font-family: "Poppins";
    }
  </style>
  <style>
    .invoice_print {
      font-size: 14px;
    }

    .mail_img {
      width: 9px;
      margin-top: 8px;
    }

    .system_addr {
      line-height: 25px;
    }

    .heading_gatepass {
      align-items: center;
      margin-left: 40%;
    }

    .itemtable {
      font-size: 14px;
      line-height: 25px;
    }
  </style>
</head>

<body>
  <div class="row" id="invoice_print">
    <table width="100%" border="0" style="margin:0px 8px 0px 8px; font-family:Poppins;">
      <tr>
        <td align="left">
          <h3 style="font-size:18px;"><?php echo $logo->system_name; ?></h3>
        </td>
      </tr>
    </table>
    <hr />
    <table width="100%" border="0">
      <tbody>
        <tr>
        <td style="vertical-align:top; float:left; width:15%;" align="left">
            <span style="float:left; width:100%; ">
              <img src="{{ base_path() }}/public/general_setting/<?php echo $logo->logo_image; ?>" width="230px" height="70px">
            </span>
          </td>
          <td style="width: 45%; vertical-align:top;">
            <span style="float:right; font-size: 14px;" class="system_addr">
              <img src="{{ URL::asset('public/img/icons/Vector (14).png') }}" class="mail_img">
              <?php echo $setting->address; ?>
              <br>
              <b>{{ trans('message.Gate Pass No. :') }}</b>
              <?php echo $getpassdata->gatepass_no; ?>
            </span>

          </td>
        </tr>
      </tbody>
    </table>
    <br><br>
    <hr />
    <h3 class="heading_gatepass"><u>{{ trans('message.Gate Pass Details') }}</u></h3>
    <br>
    <table class="table table-bordered itemtable" width="100%" border="1" style="border-collapse:collapse;">
      <tbody class="itemtable">

        <tr>
          <td style="padding:8px;"> {{ trans('message.Name') }}:</td>
          <td style="padding:8px;"> <b> <?php echo $getpassdata->name . ' ' . $getpassdata->lastname; ?> </b></td>
        </tr>
        <tr>
          <td style="padding:8px;"> {{ trans('message.Jobcard Number') }}:</td>
          <td style="padding:8px;"> <b> <?php echo $getpassdata->jobcard_id; ?> </b></td>
        </tr>
        <tr>
          <td style="padding:8px;"> {{ trans('message.Vehicle Name') }}:</td>
          <td style="padding:8px;"> <b> <?php echo $getpassdata->modelname; ?> </b></td>
        </tr>
        <tr>
          <td style="padding:8px;"> {{ trans('message.Vehicle Type') }}:</td>
          <td style="padding:8px;"> <b> {{ getVehicleType($vehicle->vehicletype_id) }} </b></td>
        </tr>
        <tr>
          <td style="padding:8px;"> {{ trans('message.Number Plate') }}:</td>
          <td style="padding:8px;"> <b> <?php echo $getpassdata->number_plate; ?> </b></td>
        </tr>
        <tr>
          <td style="padding:8px;"> {{ trans('message.Chassis No') }}.: </td>
          <td style="padding:8px;"> <b> {{ $getpassdata->chassisno ?? trans('message.Not Added') }} </b></td>
        </tr>

        <tr>
          <td style="padding:8px;">{{ trans('message.KMs.Run') }}:</td>
          <td style="padding:8px;"> <b> {{ $job->kms_run ?? trans('message.Not Added') }} </b></td>
        </tr>
        <tr>
          <td style="padding:8px;"> {{ trans('message.Service Date') }}:</td>
          <td style="padding:8px;"> <b> {{ date(getDateFormat() . ' H:i:s' , strtotime($getpassdata->service_date)) }}</b> </td>
        </tr>
        <tr>
          <td style="padding:8px;"> {{ trans('message.Vehicle Out Date') }}:</td>
          <td style="padding:8px;"> <b> {{ date(getDateFormat() . ' H:i:s' , strtotime($getpassdata->service_out_date)) }} </b></td>
        </tr>
        <tr>
          <td style="padding:8px;"> {{ trans('message.Created On:') }}</td>
          <td style="padding:8px;"> <b> {{ date(getDateFormat() . ' H:i:s' , strtotime($getpassdata->created_at)) }} </b></td>
        </tr>
        <tr>
          <td style="padding:8px;"> {{ trans('message.Created By:') }}</td>
          <td style="padding:8px;"> <b> <?php echo getAssignTo($getpassdata->create_by); ?> </b></td>
        </tr>
      </tbody>
    </table>
  </div>
</body>

</html>