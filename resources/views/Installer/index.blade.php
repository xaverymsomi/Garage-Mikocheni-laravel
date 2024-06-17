<?php
$version = phpversion() >= 8.1 ? "Pass" : "Fail";
$bcmath = extension_loaded('bcmath') == 1 ? "Pass" : "Fail";
$ctype = extension_loaded('ctype') == 1 ? "Pass" : "Fail";
$fileinfo = extension_loaded('fileinfo') == 1 ? "Pass" : "Fail";
$json = extension_loaded('json') == 1 ? "Pass" : "Fail";
$mbstring = extension_loaded('mbstring') == 0 ? "Fail" : "Pass";
$openssl = extension_loaded('openssl') == 1 ? "Pass" : "Fail";
$pdo = extension_loaded('pdo') == 1 ? "Pass" : "Fail";
$pdo_mysql = extension_loaded('pdo_mysql') == 1 ? "Pass" : "Fail";
$tokenizer = extension_loaded('tokenizer') == 1 ? "Pass" : "Fail";
$xml = extension_loaded('xml') == 0 ? "Fail" : "Pass";
$mail = function_exists('mail') == 0 ? "Fail" : "Pass";

$total = 12;
// Count Pass and Fail
$passCount = 0;
$failCount = 0;

// Check version
$version == "Pass" ? $passCount++ : $failCount++;

// Check extensions
$mbstring == "Pass" ? $passCount++ : $failCount++;
$xml == "Pass" ? $passCount++ : $failCount++;
$fileinfo == "Pass" ? $passCount++ : $failCount++;
$json == "Pass" ? $passCount++ : $failCount++;
$openssl == "Pass" ? $passCount++ : $failCount++;
$pdo == "Pass" ? $passCount++ : $failCount++;
$pdo_mysql == "Pass" ? $passCount++ : $failCount++;
$tokenizer == "Pass" ? $passCount++ : $failCount++;
$bcmath == "Pass" ? $passCount++ : $failCount++;
$ctype == "Pass" ? $passCount++ : $failCount++;
$mail == "Pass" ? $passCount++ : $failCount++;
?>
<!-- Bootstrap -->

<link href="{{ URL::asset('build/css/jq-steps/normalize.css') }} " rel="stylesheet">
<link href="{{ URL::asset('build/css/jq-steps/main.css') }} " rel="stylesheet">
<link href="{{ URL::asset('build/css/jq-steps/jquery.steps.css') }} " rel="stylesheet">
<link href="{{ URL::asset('build/css/bootstrapss.min.css') }} " rel="stylesheet">

<link href="{{ URL::asset('build/css/jq-steps/custom_style.css') }} " rel="stylesheet">
<!-- Custom Theme Style -->
<link href="{{ URL::asset('build/css/custom.min.css') }} " rel="stylesheet">


<style>
  body {
    color: #73879C;
    background: #fff;
  }

  .error-message {
    background-color: #ffe6e6;
    padding: 13px 0px;
    font-size: 15px;
    border-left: #a94442 5px solid;
  }

  .error-message-line {
    padding-left: 10px;
  }

  .bg-success {
    background-color: #5cb85c !important;
  }

  .result {
    font-weight: bold;
    margin-top: 5px;
    white-space: nowrap;
  }

  .pass {
    color: green;
  }

  .fail {
    color: red;
  }

  .d-inline {
    display: inline;
    font-size: smaller;
    color: inherit;
  }
</style>



<div class="pg-header">
  <h4 class="install_title">Garage Management System Wizard</h4>
</div>

<!-- Error Message Display Code -->
@if (session('message'))
<div class="step-content">
  <div class="error-message">
    @if (session('message') == '1')
    <label class="text-danger error-message-line"> {{ trans('message.Please enter correct purchase key') }} </label>
    @elseif(session('message') == '2')
    <label class="text-danger error-message-line">
      {{ trans('message.This purchase key is already registered. If you have any issue please contact us at sales@mojoomla.com') }}
    </label>
    @elseif(session('message') == '3')
    <label class="text-danger error-message-line">
      {{ trans('message.Please enter correct domain name.') }}
    </label>
    @elseif(session('message') == '4')
    <label class="text-danger error-message-line">
    {{ trans('message.There seems to be some problem please try after sometime or contact us on sales@mojoomla.com') }}
    </label>
    @elseif(session('message') == '5')
    <label class="text-danger error-message-line">
      {{ trans('message.Connection Problem occurs because server is down.') }} </label>
    @endif
  </div>
</div>
<br>
@endif
<!-- Error Message Display Code End-->

<div class="step-content">
  <form id="install-form" method="post" action="{!! url('/installation') !!}" enctype="multipart/form-data" class="form-horizontal">

    <div>
    <h3>Requirements</h3>
      <section>
        <h4>
          Server Requirements
          <p class="d-inline">(Pass: <span class="pass"><?php echo $passCount; ?></span> | Fail: <span class="fail"><?php echo $failCount; ?></span>)</p>
        </h4>

        <div class="config">
          <table class="table table-strip">
            <thead>
              <tr>
                <th width="30%">Name</th>
                <th width="20%">Result</th>
                <th>Current configuration</th>
                <th>Required configuration</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>PHP Version</td>
                <td><?php if ($version == "Pass") { ?>
                    <button class="suc btn btn-success bg-success" disabled><?php echo $version; ?></button>
                    <input type="text" name="version" class="form-control required msg" value="pass" readonly id="version">
                  <?php } else { ?>
                    <button class="des btn btn-danger" disabled><?php echo $version; ?></button>
                    <input type="text" name="version" class="form-control required msg" readonly>
                  <?php } ?>
                </td>
                <td>PHP <?php echo phpversion(); ?></td>
                <td>PHP 8.1.0 or greater</td>
              </tr>
              <tr>
                <td>BCMath PHP Extension</td>
                <td>
                  <?php if ($bcmath == "Pass") { ?>
                    <button class="suc btn btn-success bg-success" disabled><?php echo $bcmath; ?></button>
                    <input type="text" name="bcmath" class="form-control required msg" value="pass" readonly>
                  <?php } else { ?>
                    <button class="des btn btn-danger" disabled><?php echo $bcmath; ?></button>
                    <input type="text" name="bcmath" class="form-control required msg" readonly>
                  <?php } ?>
                </td>
                <td><?php echo extension_loaded('bcmath') == 1 ? "✅" : "❌"; ?></td>
                <td>✅</td>
              </tr>
              <tr>
                <td>Ctype PHP Extension</td>
                <td>
                  <?php if ($ctype == "Pass") { ?>
                    <button class="suc btn btn-success bg-success" disabled><?php echo $ctype; ?></button>
                    <input type="text" name="ctype" class="form-control required msg" value="pass" readonly>
                  <?php } else { ?>
                    <button class="des btn btn-danger" disabled><?php echo $ctype; ?></button>
                    <input type="text" name="ctype" class="form-control required msg" readonly>
                  <?php } ?>
                </td>
                <td><?php echo extension_loaded('ctype') == 1 ? "✅" : "❌"; ?></td>
                <td>✅</td>
              </tr>
              <tr>
                <td>Fileinfo PHP Extension</td>
                <td>
                  <?php if ($fileinfo == "Pass") { ?>
                    <button class="suc btn btn-success bg-success" disabled><?php echo $fileinfo; ?></button>
                    <input type="text" name="fileinfo" class="form-control required msg" value="pass" readonly>
                  <?php } else { ?>
                    <button class="des btn btn-danger" disabled><?php echo $fileinfo; ?></button>
                    <input type="text" name="fileinfo" class="form-control required msg" readonly>
                  <?php } ?>
                </td>
                <td><?php echo extension_loaded('fileinfo') == 1 ? "✅" : "❌"; ?></td>
                <td>✅</td>
              </tr>
              <tr>
                <td>JSON PHP Extension</td>
                <td>
                  <?php if ($json == "Pass") { ?>
                    <button class="suc btn btn-success bg-success" disabled><?php echo $json; ?></button>
                    <input type="text" name="json" class="form-control required msg" value="pass" readonly>
                  <?php } else { ?>
                    <button class="des btn btn-danger" disabled><?php echo $json; ?></button>
                    <input type="text" name="json" class="form-control required msg" readonly>
                  <?php } ?>
                </td>
                <td><?php echo extension_loaded('json') == 1 ? "✅" : "❌"; ?></td>
                <td>✅</td>
              </tr>
              <tr>
                <td>Mbstring PHP Extension</td>
                <td>
                  <?php if ($mbstring == "Pass") { ?>
                    <button class="suc btn btn-success bg-success" disabled><?php echo $mbstring; ?></button>
                    <input type="text" name="mbstring" class="form-control required msg" value="pass" readonly>
                  <?php } else { ?>
                    <button class="des btn btn-danger" disabled><?php echo $mbstring; ?></button>
                    <input type="text" name="mbstring" class="form-control required msg" readonly>
                  <?php } ?>
                </td>
                <td><?php echo extension_loaded('mbstring') == 1 ? "✅" : "❌"; ?></td>
                <td>✅</td>
              </tr>
              <tr>
                <td>OpenSSL PHP Extension</td>
                <td>
                  <?php if ($openssl == "Pass") { ?>
                    <button class="suc btn btn-success bg-success" disabled><?php echo $openssl; ?></button>
                    <input type="text" name="openssl" class="form-control required msg" value="pass" readonly>
                  <?php } else { ?>
                    <button class="des btn btn-danger" disabled><?php echo $openssl; ?></button>
                    <input type="text" name="openssl" class="form-control required msg" readonly>
                  <?php } ?>
                </td>
                <td><?php echo extension_loaded('openssl') == 1 ? "✅" : "❌"; ?></td>
                <td>✅</td>
              </tr>
              <tr>
                <td>PDO PHP Extension</td>
                <td>
                  <?php if ($pdo == "Pass") { ?>
                    <button class="suc btn btn-success bg-success" disabled><?php echo $pdo; ?></button>
                    <input type="text" name="pdo" class="form-control required msg" value="pass" readonly>
                  <?php } else { ?>
                    <button class="des btn btn-danger" disabled><?php echo $pdo; ?></button>
                    <input type="text" name="pdo" class="form-control required msg" readonly>
                  <?php } ?>
                </td>
                <td><?php echo extension_loaded('pdo') == 1 ? "✅" : "❌"; ?></td>
                <td>✅</td>
              </tr>
              <tr>
                <td>pdo_mysql Driver</td>
                <td>
                  <?php if ($pdo_mysql == "Pass") { ?>
                    <button class="suc btn btn-success bg-success" disabled><?php echo $pdo_mysql; ?></button>
                    <input type="text" name="pdo_mysql" class="form-control required msg" value="pass" readonly>
                  <?php } else { ?>
                    <button class="des btn btn-danger" disabled><?php echo $pdo_mysql; ?></button>
                    <input type="text" name="pdo_mysql" class="form-control required msg" readonly>
                  <?php } ?>
                </td>
                <td><?php echo extension_loaded('pdo_mysql') == 1 ? "✅" : "❌"; ?></td>
                <td>✅</td>
              </tr>
              <tr>
                <td>Tokenizer PHP Extension</td>
                <td>
                  <?php if ($tokenizer == "Pass") { ?>
                    <button class="suc btn btn-success bg-success" disabled><?php echo $tokenizer; ?></button>
                    <input type="text" name="tokenizer" class="form-control required msg" value="pass" readonly>
                  <?php } else { ?>
                    <button class="des btn btn-danger" disabled><?php echo $tokenizer; ?></button>
                    <input type="text" name="tokenizer" class="form-control required msg" readonly>
                  <?php } ?>
                </td>
                <td><?php echo extension_loaded('tokenizer') == 1 ? "✅" : "❌"; ?></td>
                <td>✅</td>
              </tr>
              <tr>
                <td>XML PHP Extension</td>
                <td>
                  <?php if ($xml == "Pass") { ?>
                    <button class="suc btn btn-success bg-success" disabled><?php echo $xml; ?></button>
                    <input type="text" name="xml" class="form-control required msg" value="pass" readonly>
                  <?php } else { ?>
                    <button class="des btn btn-danger" disabled><?php echo $xml; ?></button>
                    <input type="text" name="xml" class="form-control required msg" readonly>
                  <?php } ?>
                </td>
                <td><?php echo extension_loaded('xml') == 1 ? "✅" : "❌"; ?></td>
                <td>✅</td>
              </tr>
              <tr>
                <td>PHP mail()</td>
                <td>
                  <?php if ($mail == "Pass") { ?>
                    <button class="suc btn btn-success bg-success" disabled><?php echo $mail; ?></button>
                    <input type="text" name="mail" class="form-control required msg" value="pass" readonly>
                  <?php } else { ?>
                    <button class="des btn btn-danger" disabled><?php echo $mail; ?></button>
                    <input type="text" name="mail" class="form-control required msg" readonly>
                  <?php } ?>
                </td>
                <td><?php echo function_exists('mail') == 1 ? "✅" : "❌"; ?></td>
                <td>✅</td>
              </tr>
            </tbody>
          </table>
        </div>
      </section>
      <h3>Purchase Information</h3>
      <section>
        <h4>Purchase Information</h4>
        <hr />
        <div class="form-group">
          <label class="control-label col-md-3">Servername<span class="text-danger"> *</span></label>
          <div class="col-md-5">
            <div class="input text">
              <input type="text" name="server_name" value="{{ $_SERVER['SERVER_NAME'] }}" class="form-control required" readonly="">
            </div>
          </div>
        </div>
        <div class="form-group">
          <label class="control-label col-md-3">Purchase Key<span class="text-danger"> *</span></label>
          <div class="col-md-5">
            <div class="input text">
              <input type="text" name="purchase_key" value="{{ old('purchase_key') }}" class="form-control required" placeholder="Enter your purchase key">
              @if ($errors->has('purchase_key'))
              <span class="help-block">
                <strong class="text-danger">{{ $errors->first('purchase_key') }}</strong>
              </span>
              @endif
            </div>
          </div>
        </div>
        <div class="form-group">
          <label class="control-label col-md-3">E-Mail<span class="text-danger"> *</span></label>
          <div class="col-md-5">
            <div class="input text">
              <input type="email" name="purchase_email" value="{{ old('purchase_email') }}" class="form-control required" placeholder="Enter your purchase key time email">
              @if ($errors->has('purchase_email'))
              <span class="help-block ">
                <strong class="text-danger">{{ $errors->first('purchase_email') }}</strong>
              </span>
              @endif
            </div>
          </div>
        </div>
        <div class="col-md-offset-3">
          <p>(*) Fields are required.</p>
        </div>
      </section>
      <h3>Database Setup</h3>
      <section>
        <h4>Database Setup</h4>
        <hr />
        <div class="form-group">
          <label class="control-label col-md-3">Database Name<span class="text-danger"> *</span></label>
          <div class="col-md-5">
            <div class="input text">
              <input type="text" name="db_name" value="{{ old('db_name') }}" class="form-control required">
              (Database Name Must Be Unique.)
            </div>
          </div>
        </div>
        <div class="form-group">
          <label class="control-label col-md-3">Database User Name<span class="text-danger"> *</span></label>
          <div class="col-md-5">
            <div class="input text">
              <input type="text" name="db_username" value="{{ old('db_username') }}" class="form-control required">
            </div>
          </div>
        </div>
        <div class="form-group">
          <label class="control-label col-md-3">Database Password</label>
          <div class="col-md-5">
            <div class="input text">
              <input type="password" name="db_pass" class="form-control">
            </div>
          </div>
        </div>
        <div class="form-group">
          <label class="control-label col-md-3">Host<span class="text-danger"> *</span></label>
          <div class="col-md-5">
            <div class="input text">
              <input type="text" name="db_host" value="{{ old('db_host') }}" class="form-control required">
            </div>
          </div>
        </div>
        <div class="col-md-offset-3">
          <p> (*) Fields are required.</p>
        </div>
      </section>
      <h3>System Setting</h3>
      <section>
        <h4>System Setting</h4>
        <hr />
        <div class="form-group">
          <label class="control-label col-md-3">System Name<span class="text-danger"> *</span></label>
          <div class="col-md-8">
            <div class="input text">
              <input type="text" name="name" value="{{ old('name') }}" class="form-control required">
            </div>
          </div>
        </div>
        <div class="form-group">
          <label class="control-label col-md-3">Email</label>
          <div class="col-md-8">
            <div class="input text">
              <input type="text" name="email" value="{{ old('email') }}" class="form-control" value="">
            </div>
          </div>
        </div>
        <div class="form-group">
          <label class="control-label col-md-3">Address </label>
          <div class="col-md-8">
            <div class="input text">
              <input type="text" name="address" value="{{ old('address') }}" class="form-control" value="">
            </div>
          </div>
        </div>
        <div class="form-group">
          <label class="control-label col-md-3">First Name<span class="text-danger">*</span></label>
          <div class="col-md-8">
            <div class="input text">
              <input type="text" name="firstname" value="{{ old('firstname') }}" class="form-control required " value="">
            </div>
          </div>
        </div>

        <div class="col-md-offset-3">
          <p> (*) Fields are required</p>
        </div>
      </section>
      <h3>Login Details</h3>
      <section>
        <h4>Login Details</h4>
        <hr />
        <div class="form-group">
          <label class="control-label col-md-3">Email<span class="text-danger"> *</span></label>
          <div class="col-md-5">
            <div class="input text">
              <input type="email" name="loginemail" value="{{ old('loginemail') }}" class="form-control required">
            </div>
          </div>
        </div>
        <div class="form-group {{ $errors->has('password') ? ' has-error' : '' }}">
          <label class="control-label col-md-3">Password<span class="text-danger"> *</span></label>
          <div class="col-md-5">
            <div class="input text">
              <input type="password" id="password" name="password" class="form-control required password">
              @if ($errors->has('password'))
              <span class="help-block">
                <strong>{{ $errors->first('password') }}</strong>
              </span>
              @endif
            </div>
          </div>
        </div>

        <div class="form-group {{ $errors->has('confirm') ? ' has-error' : '' }}">
          <label class="control-label col-md-3">Confirm Password<span class="text-danger"> *</span></label>
          <div class="col-md-5">
            <div class="input text">
              <input type="password" name="confirm" id="confirm" class="form-control required">
              @if ($errors->has('confirm'))
              <span class="help-block">
                <strong>{{ $errors->first('confirm') }}</strong>
              </span>
              @endif
            </div>
          </div>
        </div>
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
      </section>
      <h3>Finish</h3>
      <section id="final">
        <h4>Please Note :</h4>
        <hr />
        <p>
          1. It may take couple of minutes to set-up database.
        </p>
        <p>
          2. Do not refresh this page once you click on install button..
        </p>
        <p>
          3. Installation wizard will acknowledge you once the installation is successful.
        </p>
        <p>
          4. Click on install to complete the installation.
        </p>
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <div id="loader" style="display:none;">
          <p>
            <hr />
          <h4>Please Wait, installation in progress...</h4>
          </p>
          <span>

          </span>
        </div>
      </section>
    </div>
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
  </form>
</div>

<script src="{{ URL::asset('build/js/jq-steps/modernizr-2.6.2.min.js') }}"></script>
<script src="{{ URL::asset('build/js/jq-steps/jquery-1.11.1.min.js') }}"></script>
<script src="{{ URL::asset('build/js/jq-steps/jquery.cookie-1.3.1.js') }}"></script>
<script src="{{ URL::asset('build/js/jq-steps/jquery.steps.js') }}"></script>
<script src="{{ URL::asset('build/js/jq-steps/jquery.validate.min.js') }}"></script>
<script src="{{ URL::asset('build/js/bootstrap.min.js') }}"></script>
<script src="{{ URL::asset('vendors/sweetalert/sweetalert.min.js') }}"></script>
<!-- Bootstrap -->


<!-- sweetalert -->
<link href="{{ URL::asset('vendors/sweetalert/sweetalert.css') }}" rel="stylesheet" type="text/css">

<link rel="stylesheet prefetch" href="http://fonts.googleapis.com/css?family=Roboto:400,100,300,500,700,900">

<script>
  $(function() {

    var form = $("#install-form");

    form.children("div").steps({
      labels: {
        cancel: "Cancel",
        current: "current step:",
        pagination: "Pagination",
        finish: "Install Now",
        next: "Next Step",
        previous: "Previous Step",
        loading: "Loading ..."
      },
      headerTag: "h3",
      bodyTag: "section",
      transitionEffect: "slideLeft",
      onStepChanging: function(event, currentIndex, newIndex) {
        form.validate().settings.ignore = ":disabled,:hidden";
        return form.valid();
      },
      onFinishing: function(event, currentIndex) {
        $("#loader").css("display", "block");
        form.validate().settings.ignore = ":disabled";
        return form.valid();
      },
      onFinished: function(event, currentIndex) {

        form.submit();
      }
    });
  });
</script>

@if (!empty(session('databasecreated')))
<script>
  $(document).ready(function() {

    var msg1 = "{{ trans('message.Garage System is already installed on Same Database') }}";

    swal({
      title: msg1,

    }, function() {

      window.location.reload()
    });
  });
</script>
<?php Session::flush(); ?>
@endif