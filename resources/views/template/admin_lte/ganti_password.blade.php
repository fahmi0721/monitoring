<!-- User Account: style can be found in dropdown.less -->
@if(auth()->check())
<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
     @csrf
</form>
@endif
<li class="dropdown user user-menu">
    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
        <img src="{{ asset('admin_lte/img/user2-160x160.jpg') }}" class="user-image" alt="User Image">
        <span class="hidden-xs">
            @if(auth()->check())
                {{ auth()->user()->nama_user }}
            @else
                Guest
            @endif
        </span>
    </a>
    <ul class="dropdown-menu">
    <!-- User image -->
        <li class="user-header">
            <img src="{{ asset('admin_lte/img/user2-160x160.jpg') }}" class="img-circle" alt="User Image">
            <p>
            @if(auth()->check())
                {{ auth()->user()->nama_user }} - {{ Session::get('role')->nama_role }}
            @else
                Guest
            @endif
                    <small> {{ date("D, d M Y") }}</small>
            
            </p>
        </li>
        <!-- Menu Footer-->
        <li class="user-footer">
        @if(auth()->check())
            <div class="pull-left">
                <a href="#" class="btn btn-default btn-flat">Ganti Password</a>
            </div>
            <div class="pull-right">
                <a href="#" 
                    onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();" class="btn btn-default btn-flat">Sign out</a>
            </div>
        @else
        <div class="pull-left">
                <a href="#" class="btn btn-default btn-flat">Login</a>
            </div>
        @endif
        </li>

  </ul>
</li>