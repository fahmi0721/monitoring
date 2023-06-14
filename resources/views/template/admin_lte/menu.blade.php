<aside class="main-sidebar">
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="{{ asset('admin_lte/img/user2-160x160.jpg') }}" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>
            @if(auth()->check())
              {{ auth()->user()->nama_user }}
            @else
              Guest
            @endif
          </p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      
      <ul class="sidebar-menu">
        <li class="header">MAIN NAVIGATION</li>
        <li><a href="{{ url('/') }}"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>
        <li class="header">KEUANGAN</li>
        <li><a href="{{ url('/grafik-pbl/') }}/{{ date('Y') }}"><i class="fa fa-area-chart"></i> <span>Garfik PBL</span></a></li>
        <li><a href="#"><i class="fa fa-area-chart"></i> <span>Garfik Piutang</span></a></li>
        <li><a href="#"><i class="fa fa-archive"></i> <span>Data PBL</span></a></li>
        <li><a href="#"><i class="fa fa-archive"></i> <span>Data Piutang</span></a></li>
        @if(auth()->check())

        @php $menu = json_decode(Session::get("menu_user"),true); @endphp
          @if($menu['status'] == "sukses")  
          @php $menu_root = $menu['data']['menu_root']; @endphp
            @foreach($menu_root as $key => $dt_menu_root)
              @if($dt_menu_root['jml_item'] > 0)
              <li class="treeview  @if(in_array(Request::segment(1), $dt_menu_root['item_url'])) active @endif">
                <a href="javascript:void(0)">
                  <i class="{{ $dt_menu_root['icon'] }}"></i>
                  <span>{{ $dt_menu_root['nama_menu'] }}</span>
                  <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                @php $menu_item = $dt_menu_root['menu_item']; @endphp
                @foreach($menu_item as $keys => $dt_menu_item)
                  <li class="{{ Request::segment(1) == $dt_menu_item['url'] ? 'active' : '' }}"><a href="{{ url($dt_menu_item['url']) }}"><i class="{{ $dt_menu_item['icon'] }}"></i> <span>{{ $dt_menu_item['nama_menu'] }}</span></a></li>
                @endforeach
                </ul>
              </li>
              @else
              <li class="{{ Request::segment(1) == $dt_menu_root['url'] ? 'active' : '' }}"><a href="{{ url($dt_menu_root['url']) }}"><i class="{{ $dt_menu_root['icon'] }}"></i> <span>{{ $dt_menu_root['nama_menu'] }}</span></a></li>
              @endif
            @endforeach
          @endif

        @if(auth()->user()->level == "admin")
        <li class="header">SUPER ADMIN</li>
        @php $master = array("users","menu","role"); @endphp
        <li class="treeview  @if(in_array(Request::segment(1), $master)) active @endif">
          <a href="#">
            <i class="fa fa-archive"></i>
            <span>Master</span>
            <i class="fa fa-angle-left pull-right"></i>
          </a>
          <ul class="treeview-menu">
            <li class="{{ Request::segment(1) == 'users' ? 'active' : '' }}"><a href="{{ url('users') }}"><i class="fa fa-angle-double-right"></i> <span>Users</span></a></li>
            <li class="{{ Request::segment(1) == 'menu' ? 'active' : '' }}"><a href="{{ url('menu') }}"><i class="fa fa-angle-double-right"></i> <span>Menu</span></a></li>
            <li class="{{ Request::segment(1) == 'role' ? 'active' : '' }}"><a href="{{ url('role') }}"><i class="fa fa-angle-double-right"></i> <span>Role</span></a></li>
          </ul>
        </li>
        <li class="{{ Request::segment(1) == 'role-user' ? 'active' : '' }}"><a href="{{ url('role-user') }}"><i class="fa fa-users"></i> <span>Role User</span></a></li>
        <li class="{{ Request::segment(1) == 'role-menu' ? 'active' : '' }}"><a href="{{ url('role-menu') }}"><i class="fa fa-book"></i> <span>Role Menu</span></a></li>
        @endif

        @endif
      </ul>
    </section>
  </aside>