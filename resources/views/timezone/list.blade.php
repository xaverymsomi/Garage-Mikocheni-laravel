@extends('layouts.app')
@section('content')
<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="nav_menu">
                <nav>
                    <div class="nav toggle">
                        <a id="menu_toggle"><i class="fa fa-bars sidemenu_toggle"></i></a><a href="{{ URL::previous() }}" id=""><i class=""><img src="{{ URL::asset('public/supplier/Back Arrow.png') }}"></i><span class="titleup">
                                {{ trans('message.Settings') }}</span></a>
                    </div>
                    @include('dashboard.profile')
                </nav>
            </div>
        </div>
        @include('success_message.message')
        <div class="x_content table-responsive">
            <ul class="nav nav-tabs">
                @can('generalsetting_view')
                <li class="nav-item">
                    <a href="{!! url('setting/general_setting/list') !!}" class="nav-link nav-link-not-active"><span class="visible-xs"></span> <i class="">&nbsp;</i><b>{{ trans('message.GENERAL SETTINGS') }}</b></a>
                </li>
                @endcan
                @can('timezone_view')
                <li class="nav-item">
                    <a href="{!! url('setting/timezone/list') !!}" class="nav-link active"><span class="visible-xs"></span><i class="">&nbsp;</i><b>{{ trans('message.OTHER SETTINGS') }}</b></a>
                </li>
                @endcan
                @can('accessrights_view')
                <li class="nav-item">
                    <a href="{!! url('setting/accessrights/show') !!}" class="nav-link nav-link-not-active"><span class="visible-xs"></span><i class="">&nbsp;</i><b>{{ trans('message.ACCESS RIGHTS') }}</b></a>
                </li>
                @endcan
                @can('businesshours_view')
                <li class="nav-item">
                    <a href="{!! url('setting/hours/list') !!}" class="nav-link nav-link-not-active"><span class="visible-xs"></span><i class="">&nbsp;</i><b>{{ trans('message.BUSINESS HOURS') }}</b></a>
                </li>
                @endcan
                @can('stripesetting_view')
                <li class="nav-item">
                    <a href="{!! url('setting/stripe/list') !!}" class="nav-link nav-link-not-active"><span class="visible-xs"></span><i class="">&nbsp;</i><b>{{ trans('message.STRIPE SETTINGS') }}</b></a>
                </li>
                @endcan
                @can('branchsetting_view')
                <li class="nav-item">
                    <a href="{!! url('branch_setting/list') !!}" class="nav-link nav-link-not-active"><span class="visible-xs"></span><i class="">&nbsp;</i><b>{{ trans('message.BRANCH SETTING') }}</b></a>
                </li>
                @endcan
                <li class="nav-item">
                    @can('email_view')
                    <a href="{!! url('setting/email_setting/list') !!}" class="nav-link nav-link-not-active"><span class="visible-xs"></span><i class="">&nbsp;</i><b>{{ trans('message.EMAIL SETTING') }}</b></a>
                    @endcan
                </li>
            </ul>
        </div>
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12 col-lg-12 col-xl-12 col-xxl-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_content">
                        <form id="other_setting_edit_form" method="post" action="{{ url('setting/currancy/store') }}" enctype="multipart/form-data" class="form-horizontal upperform">
                            @can('timezone_view')
                            <div class="col-md-12 col-lg-12 col-xl-12 col-xxl-12 col-sm-12 col-xs-12 space">
                                <h4><b>{{ trans('message.TIMEZONE') }}</b></h4>
                                <p class="col-md-12 col-lg-12 col-xl-12 col-xxl-12 col-sm-12 col-xs-12 ln_solid"></p>
                            </div>

                            <div class="row has-feedback">
                                <label class="control-label col-md-2 col-lg-2 col-xl-2 col-xxl-2 col-sm-2 col-xs-2 checkpointtext text-end" for="Country">{{ trans('message.Select Timezone') }} <label class="color-danger">*</label>
                                </label>
                                <div class="col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4">
                                    <select class="form-control timezone form-select" name="timezone" required>

                                        <option value="">Please select timezone</option>
                                        @if (!empty($currancy))
                                        @foreach ($currancy as $currancys)
                                        <option value="{{ $currancys->timezone }}" <?php if ($user->timezone == $currancys->timezone) {
                                                                                        echo 'selected';
                                                                                    } ?>>
                                            {{ $currancys->timezone }}
                                        </option>
                                        @endforeach
                                        @endif

                                    </select>
                                </div>
                                <div class="col-md-3 col-lg-3 col-xl-3 col-xxl-3 col-sm-3"></div>
                            </div>
                            @endcan

                            @can('language_view')
                            <div class="col-md-12 col-lg-12 col-xl-12 col-xxl-12 col-sm-12 col-xs-12 space mt-4">
                                <h4><b>{{ trans('message.LANGUAGE') }}</b></h4>
                                <p class="col-md-12 col-lg-12 col-xl-12 col-xxl-12 col-sm-12 col-xs-12 ln_solid"></p>
                            </div>

                            <div class="row has-feedback">
                                <label class="control-label col-md-2 col-lg-2 col-xl-2 col-xxl-2 col-sm-2 col-xs-2 checkpointtext text-end" for="Country">{{ trans('message.Select Language') }} <label class="color-danger">*</label></label>
                                <div class="col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4">
                                    <select class="form-control language form-select" name="language">
                                        <option value="en" <?php if ($user->language == 'en') {
                                                                echo 'selected';
                                                            } ?>>English/en</option>
                                        <option value="bg" <?php if ($user->language == 'bg') {
                                                                echo 'selected';
                                                            } ?>>Bulgarian/bg</option>
                                        <option value="glg" <?php if ($user->language == 'glg') {
                                                                echo 'selected';
                                                            } ?>>Galician/glg</option>
                                        <option value="ka" <?php if ($user->language == 'ka') {
                                                                echo 'selected';
                                                            } ?>>Georgian/ka</option>
                                        <option value="nb" <?php if ($user->language == 'nb') {
                                                                echo 'selected';
                                                            } ?>>Bokmål(Norwegian)/nb</option>
                                        <option value="es" <?php if ($user->language == 'es') {
                                                                echo 'selected';
                                                            } ?>>Spanish/es</option>
                                        <option value="el" <?php if ($user->language == 'el') {
                                                                echo 'selected';
                                                            } ?>>Greek/el</option>
                                        <option value="ar" <?php if ($user->language == 'ar') {
                                                                echo 'selected';
                                                            } ?>>Arabic/ar</option>
                                        <option value="de" <?php if ($user->language == 'de') {
                                                                echo 'selected';
                                                            } ?>>German/de</option>
                                        <option value="por" <?php if ($user->language == 'por') {
                                                                echo 'selected';
                                                            } ?>>Portuguese/por</option>
                                        <option value="fr" <?php if ($user->language == 'fr') {
                                                                echo 'selected';
                                                            } ?>>French/fr</option>
                                        <option value="it" <?php if ($user->language == 'it') {
                                                                echo 'selected';
                                                            } ?>>Italian/it</option>
                                        <option value="swe" <?php if ($user->language == 'swe') {
                                                                echo 'selected';
                                                            } ?>>Swedish/swe</option>
                                        <option value="dut" <?php if ($user->language == 'dut') {
                                                                echo 'selected';
                                                            } ?>>Dutch/dut</option>
                                        <option value="hi" <?php if ($user->language == 'hi') {
                                                                echo 'selected';
                                                            } ?>>Hindi/hi</option>
                                        <option value="zh" <?php if ($user->language == 'zh') {
                                                                echo 'selected';
                                                            } ?>>Chinese (Simplified)/zh
                                        </option>
                                        <option value="id" <?php if ($user->language == 'id') {
                                                                echo 'selected';
                                                            } ?>>Indonesian/id</option>
                                        <option value="ja" <?php if ($user->language == 'ja') {
                                                                echo 'selected';
                                                            } ?>>Japanees/ja</option>
                                        <option value="cs" <?php if ($user->language == 'cs') {
                                                                echo 'selected';
                                                            } ?>>Czech/cs</option>
                                        <option value="pol" <?php if ($user->language == 'pol') {
                                                                echo 'selected';
                                                            } ?>>Polish/pol</option>
                                        <option value="per" <?php if ($user->language == 'per') {
                                                                echo 'selected';
                                                            } ?>>Persian/per</option>
                                        <option value="rus" <?php if ($user->language == 'rus') {
                                                                echo 'selected';
                                                            } ?>>Russian/rus</option>
                                        <option value="tha" <?php if ($user->language == 'tha') {
                                                                echo 'selected';
                                                            } ?>>Thai/tha</option>
                                        <option value="tur" <?php if ($user->language == 'tur') {
                                                                echo 'selected';
                                                            } ?>>Turkish/tur</option>
                                        <option value="cat" <?php if ($user->language == 'cat') {
                                                                echo 'selected';
                                                            } ?>>Catalan/cat</option>
                                        <option value="dan" <?php if ($user->language == 'dan') {
                                                                echo 'selected';
                                                            } ?>>Danish/dan</option>
                                        <option value="rum" <?php if ($user->language == 'rum') {
                                                                echo 'selected';
                                                            } ?>>Romanian/rum</option>
                                        <option value="vie" <?php if ($user->language == 'vie') {
                                                                echo 'selected';
                                                            } ?>>Vietnamese/vie</option>
                                        <option value="et" <?php if ($user->language == 'et') {
                                                                echo 'selected';
                                                            } ?>>Estonian/et</option>
                                        <option value="fin" <?php if ($user->language == 'fin') {
                                                                echo 'selected';
                                                            } ?>>Finnish/fin</option>
                                        <option value="heb" <?php if ($user->language == 'heb') {
                                                                echo 'selected';
                                                            } ?>>Hebrew (Israel)/heb</option>
                                        <option value="hr" <?php if ($user->language == 'hr') {
                                                                echo 'selected';
                                                            } ?>>Croatian/hr</option>
                                        <option value="hu" <?php if ($user->language == 'hu') {
                                                                echo 'selected';
                                                            } ?>>Hungarian/hu</option>
                                        <option value="lit" <?php if ($user->language == 'lit') {
                                                                echo 'selected';
                                                            } ?>>Lithuanian/lit</option>
                                        <option value="nno" <?php if ($user->language == 'nno') {
                                                                echo 'selected';
                                                            } ?>>Norwegian/nno</option>
                                        <option value="guj" <?php if ($user->language == 'guj') {
                                                                echo 'selected';
                                                            } ?>>Gujarati/guj</option>
                                        <option value="mar" <?php if ($user->language == 'mar') {
                                                                echo 'selected';
                                                            } ?>>Marathi/mar</option>
                                        <option value="ta" <?php if ($user->language == 'ta') {
                                                                echo 'selected';
                                                            } ?>>Tamil/Ta</option>
                                        <option value="te" <?php if ($user->language == 'te') {
                                                                echo 'selected';
                                                            } ?>>Telugu/Te</option>
                                        <option value="ben" <?php if ($user->language == 'ben') {
                                                                echo 'selected';
                                                            } ?>>Bangali/ben</option>
                                        <option value="urd" <?php if ($user->language == 'urd') {
                                                                echo 'selected';
                                                            } ?>>urdu/urd</option>
                                        <option value="ori" <?php if ($user->language == 'ori') {
                                                                echo 'selected';
                                                            } ?>>Odia/ori</option>
                                        <option value="pus" <?php if ($user->language == 'pus') {
                                                                echo 'selected';
                                                            } ?>>Pushto/pus</option>
                                        <option value="hye" <?php if ($user->language == 'hye') {
                                                                echo 'selected';
                                                            } ?>>Armenian/hye</option>
                                        <option value="slv" <?php if ($user->language == 'slv') {
                                                                echo 'selected';
                                                            } ?>>Slovenia/slv</option>
                                        <option value="aze" <?php if ($user->language == 'aze') {
                                                                echo 'selected';
                                                            } ?>>Azerbaijani/aze</option>
                                        <option value="hat" <?php if ($user->language == 'hat') {
                                                                echo 'selected';
                                                            } ?>>Haitian creole/hat</option>
                                        <option value="bel" <?php if ($user->language == 'bel') {
                                                                echo 'selected';
                                                            } ?>>Belarusian/bel</option>
                                        <option value="ben" <?php if ($user->language == 'ben') {
                                                                echo 'selected';
                                                            } ?>>Bangali/ben</option>
                                        <option value="bos" <?php if ($user->language == 'bos') {
                                                                echo 'selected';
                                                            } ?>>Bosnian/bos</option>
                                        <option value="khm" <?php if ($user->language == 'khm') {
                                                                echo 'selected';
                                                            } ?>>Khmer/khm</option>
                                        <option value="kan" <?php if ($user->language == 'kan') {
                                                                echo 'selected';
                                                            } ?>>Kannada/kan</option>
                                        <option value="ml" <?php if ($user->language == 'ml') {
                                                                echo 'selected';
                                                            } ?>>Malyalam/ml</option>
                                        <option value="nep" <?php if ($user->language == 'nep') {
                                                                echo 'selected';
                                                            } ?>>Nepali/nep</option>
                                        <option value="que" <?php if ($user->language == 'que') {
                                                                echo 'selected';
                                                            } ?>>Quechua/que</option>
                                        <option value="alb" <?php if ($user->language == 'alb') {
                                                                echo 'selected';
                                                            } ?>>Albanian/alb</option>
                                        <option value="srp" <?php if ($user->language == 'srp') {
                                                                echo 'selected';
                                                            } ?>>Serbian/srp</option>
                                        <option value="swa" <?php if ($user->language == 'swa') {
                                                                echo 'selected';
                                                            } ?>>Swahili/swa</option>
                                        <option value="yor" <?php if ($user->language == 'yor') {
                                                                echo 'selected';
                                                            } ?>>Yoruba/yor</option>
                                        <option value="ltz" <?php if ($user->language == 'ltz') {
                                                                echo 'selected';
                                                            } ?>>Luxermbourgish/ltz</option>
                                        <option value="ga" <?php if ($user->language == 'ga') {
                                                                echo 'selected';
                                                            } ?>>Irish/ga</option>
                                        <option value="is" <?php if ($user->language == 'is') {
                                                                echo 'selected';
                                                            } ?>>Icelandic/is</option>
                                        <option value="fy" <?php if ($user->language == 'fy') {
                                                                echo 'selected';
                                                            } ?>>Frisian/fy</option>
                                        <option value="smo" <?php if ($user->language == 'smo') {
                                                                echo 'selected';
                                                            } ?>>Samoan/smo</option>
                                        <option value="cy" <?php if ($user->language == 'cy') {
                                                                echo 'selected';
                                                            } ?>>Welsh/cy</option>
                                        <option value="gla" <?php if ($user->language == 'gla') {
                                                                echo 'selected';
                                                            } ?>>Scots Gaelic/gla</option>
                                        <option value="mlt" <?php if ($user->language == 'mlt') {
                                                                echo 'selected';
                                                            } ?>>Maltese/mlt</option>
                                        <option value="spa" <?php if ($user->language == 'spa') {
                                                                echo 'selected';
                                                            } ?>>Castilian/spa</option>
                                        <option value="gl" <?php if ($user->language == 'gl') {
                                                                echo 'selected';
                                                            } ?>>Galician/glg</option>
                                        <option value="ukr" <?php if ($user->language == 'ukr') {
                                                                echo 'selected';
                                                            } ?>>ukrainian/ukr</option>
                                        <option value="slo" <?php if ($user->language == 'slo') {
                                                                echo 'selected';
                                                            } ?>>Slovak/slo</option>
                                        <option value="lav" <?php if ($user->language == 'lav') {
                                                                echo 'selected';
                                                            } ?>>Latvian/lav</option>
                                        <option value="som" <?php if ($user->language == 'som') {
                                                                echo 'selected';
                                                            } ?>>Somali/som</option>
                                        <option value="pan" <?php if ($user->language == 'pan') {
                                                                echo 'selected';
                                                            } ?>>Punjabi/pan</option>
                                        <option value="snd" <?php if ($user->language == 'snd') {
                                                                echo 'selected';
                                                            } ?>>Sindhi/snd</option>
                                        <option value="kur" <?php if ($user->language == 'kur') {
                                                                echo 'selected';
                                                            } ?>>Kurdish/kur</option>
                                        <option value="kk" <?php if ($user->language == 'kk') {
                                                                echo 'selected';
                                                            } ?>>Kazak/kk</option>
                                        <option value="ko" <?php if ($user->language == 'ko') {
                                                                echo 'selected';
                                                            } ?>>Korean/ko</option>
                                        <option value="kir" <?php if ($user->language == 'kir') {
                                                                echo 'selected';
                                                            } ?>>Kyrgyz/kir</option>
                                        <option value="sot" <?php if ($user->language == 'sot') {
                                                                echo 'selected';
                                                            } ?>>Sesotho/sot</option>
                                        <option value="mac" <?php if ($user->language == 'mac') {
                                                                echo 'selected';
                                                            } ?>>Macedonian/mac</option>
                                        <option value="mlg" <?php if ($user->language == 'mlg') {
                                                                echo 'selected';
                                                            } ?>>Malagasy/mlg</option>
                                        <option value="ny" <?php if ($user->language == 'ny') {
                                                                echo 'selected';
                                                            } ?>>Chichewa/ny</option>
                                        <option value="may" <?php if ($user->language == 'may') {
                                                                echo 'selected';
                                                            } ?>>Malay/may</option>
                                        <option value="mon" <?php if ($user->language == 'mon') {
                                                                echo 'selected';
                                                            } ?>>Mongolian/mon</option>
                                        <option value="afr" <?php if ($user->language == 'afr') {
                                                                echo 'selected';
                                                            } ?>>Afrikaans/afr</option>
                                        <option value="kin" <?php if ($user->language == 'kin') {
                                                                echo 'selected';
                                                            } ?>>Kinyarwanda/kin</option>
                                        <option value="fil" <?php if ($user->language == 'fil') {
                                                                echo 'selected';
                                                            } ?>>Filipino/fil</option>
                                        <option value="xho" <?php if ($user->language == 'xho') {
                                                                echo 'selected';
                                                            } ?>>Xhosa/xho</option>
                                        <option value="srn" <?php if ($user->language == 'srn') {
                                                                echo 'selected';
                                                            } ?>>Suriname/srn</option>
                                        <option value="cmn" <?php if ($user->language == 'cmn') {
                                                                echo 'selected';
                                                            } ?>>Chinese (Mandarin)/cmn</option>
                                        <option value="tgk" <?php if ($user->language == 'tgk') {
                                                                echo 'selected';
                                                            } ?>>Tajik/tgk</option>
                                        <option value="tuk" <?php if ($user->language == 'tuk') {
                                                                echo 'selected';
                                                            } ?>>Turkmen/tuk</option>
                                        <option value="zul" <?php if ($user->language == 'zul') {
                                                                echo 'selected';
                                                            } ?>>Zulu/zul</option>
                                    </select>
                                </div>
                                <div class="col-md-3 col-lg-3 col-xl-3 col-xxl-3 col-sm-3"></div>
                            </div>
                            @endcan

                            <!-- Date and Currency Start -->
                            @can('dateformat_view')
                            <div class="col-md-12 col-lg-12 col-xl-12 col-xxl-12 col-sm-12 col-xs-12 space mt-4">
                                <h4><b>{{ trans('message.DATE FORMAT') }}</b></h4>
                                <p class="col-md-12 col-lg-12 col-xl-12 col-xxl-12 col-sm-12 col-xs-12 ln_solid"></p>
                            </div>

                            <div class="row has-feedback">
                                <label class="control-label col-md-2 col-lg-2 col-xl-2 col-xxl-2 col-sm-2 col-xs-2 checkpointtext text-end">{{ trans('message.Select Date Format') }}
                                    <label class="color-danger">*</label>
                                </label>
                                <div class="col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4">
                                    <select class="form-control dateformat form-select" name="dateformat" required>
                                        <option value="">{{ trans('message.Select Date Format') }}</option>
                                        <option value="Y-m-d" <?php if ($tbl_settings->date_format == 'Y-m-d') {
                                                                    echo 'selected';
                                                                } ?>><?php echo 'yyyy-mm-dd'; ?></option>
                                        <option value="m-d-Y" <?php if ($tbl_settings->date_format == 'm-d-Y') {
                                                                    echo 'selected';
                                                                } ?>><?php echo 'mm-dd-yyyy'; ?></option>
                                        <option value="d-m-Y" <?php if ($tbl_settings->date_format == 'd-m-Y') {
                                                                    echo 'selected';
                                                                } ?>><?php echo 'dd-mm-yyyy'; ?></option>
                                        <!-- <option value="M-d-Y" <?php if ($tbl_settings->date_format == 'M-d-Y') {
                                                                        echo 'selected';
                                                                    } ?>><?php echo 'MM-dd-yyyy'; ?></option> -->
                                    </select>
                                </div>
                                <div class="col-md-3 col-lg-3 col-xl-3 col-xxl-3 col-sm-3"></div>
                            </div>
                            @endcan

                            @can('currency_view')
                            <div class="col-md-12 col-lg-12 col-xl-12 col-xxl-12 col-sm-12 col-xs-12 space mt-4">
                                <h4><b>{{ trans('message.CURRENCY') }}</b></h4>
                                <p class="col-md-12 col-lg-12 col-xl-12 col-xxl-12 col-sm-12 col-xs-12 ln_solid"></p>
                            </div>
                            <div class="row has-feedback">
                                <label class="control-label col-md-2 col-lg-2 col-xl-2 col-xxl-2 col-sm-2 col-xs-2 checkpointtext text-end">{{ trans('message.Select Currency') }}
                                    <label class="color-danger">*</label>
                                </label>
                                <div class="col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-sm-4 col-xs-4">
                                    <select class="form-control Currency form-select" name="Currency" required>
                                        <option value="">{{ trans('message.Select Currency') }}</option>
                                        @if (!empty($currencies))
                                        @foreach ($currencies as $currancyss)
                                        <option value="{{ $currancyss->id }}" <?php if ($currancyss->id == $tbl_settings->currancy) {
                                                                                    echo 'selected';
                                                                                } ?>>
                                            {{ $currancyss->country }} - {{ $currancyss->currency }} -
                                            {{ $currancyss->code }} - {{ $currancyss->symbol }}
                                        </option>
                                        @endforeach
                                        @endif
                                    </select>
                                </div>
                                <div class="col-md-3 col-lg-3 col-xl-3 col-xxl-3 col-sm-3"></div>
                            </div>
                            @endcan
                            <!-- Date and Currency End -->
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">

                            @canany(['timezone_edit', 'language_edit', 'dateformat_edit', 'currency_edit'])

                            <div class="row space">
                                <!-- <div class="row col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6 form-group ">
                                    <a class="btn timezonecancel" href="{{ URL::previous() }}">{{ trans('message.CANCEL') }}</a>
                                </div> -->
                                <div class="row col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-sm-6 col-xs-6 my-1 form-group ">
                                    <button type="submit" class="btn timezonesubmit">{{ trans('message.UPDATE') }}</button>
                                </div>
                            </div>
                            @endcanany

                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
<!-- page content end -->

<script type="text/javascript" src="https://code.jquery.com/jquery-2.1.4.min.js"></script>


<!-- Form field validation -->
{!! JsValidator::formRequest('App\Http\Requests\StoreOtherSettingEditFormRequest', '#other_setting_edit_form') !!}
<script type="text/javascript" src="{{ asset('public/vendor/jsvalidation/js/jsvalidation.js') }}"></script>


@endsection