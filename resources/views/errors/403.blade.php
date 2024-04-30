@extends('layouts.app')
@section('content')

<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="nav_menu">
                <nav>
                    <div class="nav toggle">
                        <a id="menu_toggle"><i class="fa fa-bars sidemenu_toggle"></i></a><span class="titleup"> {{ Auth::user()->name }} {{ Auth::user()->lastname }}</span>
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
    <div class="d-flex justify-content-center align-items-center" style="height: 80vh;">
        <section id="" class="">
            <h4>{{ trans("Oops! You don't have the access for this page contact to administrator.") }}</h4>
            <center><a class="btn btn-success" href="{{ URL::previous() }}">{{ trans('GO Back') }}</a></center>
        </section>
    </div>
</div> 
@endsection