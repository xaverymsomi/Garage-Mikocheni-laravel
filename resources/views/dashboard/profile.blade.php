  <!-- <div class="ulprofile list-unstyled p-0">
     
      <a href="{!! url('setting/profile') !!}" class="pt-2 pb-2 ms-1" aria-expanded="false">
      @if (!empty(Auth::user()->id))
      @if (Auth::user()->role == 'admin')
      <img src="{{ URL::asset('public/admin/' . Auth::user()->image) }}" alt="admin" width="40px" height="40px" class="rounded  display-right">
      @endif
      @if (Auth::user()->role == 'Customer')
      <img src="{{ URL::asset('public/customer/' . Auth::user()->image) }}" alt="customer" width="40px" height="40px" class="rounded  display-right">
      @endif

      @if (Auth::user()->role == 'Supplier')
      <img src="{{ URL::asset('public/supplier/' . Auth::user()->image) }}" alt="supplier" width="40px" height="40px" class="rounded  display-right">
      @endif

      @if (Auth::user()->role == 'employee')
      <img src="{{ URL::asset('public/employee/' . Auth::user()->image) }}" alt="employee" width="40px" height="40px" class="rounded  display-right">
      @endif

      @if (Auth::user()->role == 'accountant')
      <img src="{{ URL::asset('public/accountant/' . Auth::user()->image) }}" alt="accountant" width="40px" height="40px" class="rounded  display-right">
      @endif

      @if (Auth::user()->role == 'supportstaff')
      <img src="{{ URL::asset('public/supportstaff/' . Auth::user()->image) }}" alt="supportstaff" width="40px" height="40px" class="rounded  display-right">
      @endif

      @if (Auth::user()->role == 'branch_admin')
      <img src="{{ URL::asset('public/branch_admin/' . Auth::user()->image) }}" alt="branch_admin" width="40px" height="40px" class="rounded  display-right">
      @endif

      @if (Auth::user()->role == '')
      <img src="{{ URL::asset('public/customer/' . Auth::user()->image) }}" alt="customer" width="40px" height="40px" class="rounded  display-right">
      @endif
      @endif
    </a>
  </div>  -->

  <div class="dropdown_profile ulprofile">
    <?php $userid = Auth::User()->id; ?>
    @if (getAccessStatusUser('Settings', $userid) == 'yes')
    @if (getActiveAdmin($userid) == 'yes')
    <a href="{!! url('setting/general_setting/list') !!}"><img src="{{ URL::asset('public/img/dashboard/Settings.png') }}" alt="admin" width="40px" height="40px" class="border-0 m-1  display-left"></a>
    @else
    <a href="{!! url('setting/timezone/list') !!}"><img src="{{ URL::asset('public/img/dashboard/Settings.png') }}" alt="admin" width="40px" height="40px" class="border-0 m-1  display-left"></a>
    @endif
    @endif
    <div class="vr display-none"></div>
    <a href="javascript:;" class=" dropdown_profile pt-2 pb-2 authpic" data-bs-toggle="dropdown" aria-expanded="false">
      @if (!empty(Auth::user()->id))
      {{-- @if (Auth::user()->role == 'admin')
      <img src="{{ URL::asset('public/admin/' . Auth::user()->image) }}" alt="admin" width="40px" height="40px" class="rounded  display-right">
      @endif

      @if (Auth::user()->role == 'Customer')
      <img src="{{ URL::asset('public/customer/' . Auth::user()->image) }}" alt="customer" width="40px" height="40px" class="rounded  display-right">
      @endif

      @if (Auth::user()->role == 'Supplier')
      <img src="{{ URL::asset('public/supplier/' . Auth::user()->image) }}" alt="supplier" width="40px" height="40px" class="rounded  display-right">
      @endif

      @if (Auth::user()->role == 'employee')
      <img src="{{ URL::asset('public/employee/' . Auth::user()->image) }}" alt="employee" width="40px" height="40px" class="rounded  display-right">
      @endif

      @if (Auth::user()->role == 'supportstaff')
      <img src="{{ URL::asset('public/supportstaff/' . Auth::user()->image) }}" alt="supportstaff" width="40px" height="40px" class="rounded  display-right">
      @endif

      @if (Auth::user()->role == 'accountant')
      <img src="{{ URL::asset('public/accountant/' . Auth::user()->image) }}" alt="accountant" width="40px" height="40px" class="rounded  display-right">
      @endif

      @if (Auth::user()->role == 'branch_admin')
      <img src="{{ URL::asset('public/branch_admin/' . Auth::user()->image) }}" alt="accountant" width="40px" height="40px" class="rounded  display-right">
      @endif

      @if (Auth::user()->role == '')
      <img src="{{ URL::asset('public/customer/' . Auth::user()->image) }}" alt="customer" width="40px" height="40px" class="rounded  display-right">
      @endif --}}
      {{ Auth::user()->name }}
      @endif


      <!-- @if (!empty(Auth::user()->id))
        {{ Auth::user()->name }}
      @endif -->
      {{-- <span class=" fa fa-angle-down"></span> --}}
    </a>
    <ul class="dropdown-menu dropdown-usermenu float-end" style="width: 1px;">
      <li><a class="dropdown-item" href="{!! url('setting/profile') !!}"><i class="fa fa-user me-2" aria-hidden="true"></i>{{ trans('message.Profile') }}</a></li>
      <li>
        <a class="logoutConfirm"><i class="fa fa-power-off" aria-hidden="true"></i> {{ trans('message.Logout') }}</a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
          @csrf
        </form>
        <!-- <a title="{{trans('message.Logout')}}" href="#" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
          <i class="fa fa-power-off" aria-hidden="true"></i> {{trans('message.Logout')}}
          <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
          </form>
        </a> -->
      </li>
    </ul>

  </div>