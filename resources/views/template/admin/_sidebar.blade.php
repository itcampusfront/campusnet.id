
    <!-- Sidebar menu-->
    <div class="app-sidebar__overlay" data-toggle="sidebar"></div>
    <aside class="app-sidebar">
      <div class="app-sidebar__user"><img class="app-sidebar__user-avatar mx-auto" height="100" src="{{ asset('assets/images/logo/'.get_logo()) }}" alt="User Image">
      </div>
      <ul class="app-menu">
        <li><a class="app-menu__item {{ Request::path() == 'admin' ? 'active' : '' }}" href="/admin"><i class="app-menu__icon fa fa-dashboard"></i><span class="app-menu__label">Dashboard</span></a></li>
        @if(Auth::user()->role == role_admin() || Auth::user()->role == role_manager())
        <li><a class="app-menu__item {{ strpos(Request::url(), '/admin/user') ? 'active' : '' }}" href="/admin/user"><i class="app-menu__icon fa fa-users"></i><span class="app-menu__label">User</span></a></li>
        @endif
        @if(Auth::user()->role == role_admin() || Auth::user()->role == role_manager())
        <li><a class="app-menu__item {{ strpos(Request::url(), '/admin/kategori') ? 'active' : '' }}" href="/admin/kategori"><i class="app-menu__icon fa fa-tags"></i><span class="app-menu__label">Kategori</span></a></li>
        @endif
        <li><a class="app-menu__item {{ strpos(Request::url(), '/admin/kelas') ? 'active' : '' }}" href="/admin/kelas"><i class="app-menu__icon fa fa-list"></i><span class="app-menu__label">Kelas</span></a></li>
        <li><a class="app-menu__item {{ strpos(Request::url(), '/admin/kuis') ? 'active' : '' }}" href="/admin/kuis"><i class="app-menu__icon fa fa-question-circle"></i><span class="app-menu__label">Kuis</span></a></li>
        <li class="treeview {{ strpos(Request::url(), '/admin/progress') ? 'is-expanded' : '' }}"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-percent"></i><span class="app-menu__label">Progress</span><i class="treeview-indicator fa fa-angle-right"></i></a>
          <ul class="treeview-menu">
            <li><a class="treeview-item {{ Request::path() == 'admin/progress' ? 'active' : '' }}" href="/admin/progress"><i class="icon fa fa-circle-o"></i> Semua</a></li>
            <li><a class="treeview-item {{ strpos(Request::url(), '/admin/progress/teks') ? 'active' : '' }}" href="/admin/progress/teks"><i class="icon fa fa-circle-o"></i> Teks</a></li>
            <li><a class="treeview-item {{ strpos(Request::url(), '/admin/progress/video') ? 'active' : '' }}" href="/admin/progress/video"><i class="icon fa fa-circle-o"></i> Video</a></li>
            <li><a class="treeview-item {{ strpos(Request::url(), '/admin/progress/file') ? 'active' : '' }}" href="/admin/progress/file"><i class="icon fa fa-circle-o"></i> File</a></li>
            <li><a class="treeview-item {{ strpos(Request::url(), '/admin/progress/kuis') ? 'active' : '' }}" href="/admin/progress/kuis"><i class="icon fa fa-circle-o"></i> Kuis</a></li>
            <li><a class="treeview-item {{ strpos(Request::url(), '/admin/progress/tugas') ? 'active' : '' }}" href="/admin/progress/tugas"><i class="icon fa fa-circle-o"></i> Tugas</a></li>
          </ul>
        </li>
        @if(Auth::user()->role == role_admin() || Auth::user()->role == role_manager())
        <li class="treeview {{ strpos(Request::url(), '/admin/pengaturan') ? 'is-expanded' : '' }}"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-cogs"></i><span class="app-menu__label">Pengaturan</span><i class="treeview-indicator fa fa-angle-right"></i></a>
          <ul class="treeview-menu">
            <li><a class="treeview-item {{ strpos(Request::url(), '/admin/pengaturan/umum') ? 'active' : '' }}" href="/admin/pengaturan/umum"><i class="icon fa fa-circle-o"></i> Umum</a></li>
            <li><a class="treeview-item {{ strpos(Request::url(), '/admin/pengaturan/warna') ? 'active' : '' }}" href="/admin/pengaturan/warna"><i class="icon fa fa-circle-o"></i> Warna</a></li>
          </ul>
        </li>
        @endif
      </ul>
    </aside>