<li class="nav-header">
    @include('layouts.admin.sidebar.nav-header')
</li>
<li @if(Route::currentRouteName()=="home.index") class="active" @endif>
    <a href="{{ route('home.index') }}"><i class="fa fa-th-large"></i> <span class="nav-label">Dashboard</span></a>
</li>
<li @if(Route::currentRouteName()=="admin.admin.index" || Route::currentRouteName()=="admin.kost-owner.index" || Route::currentRouteName()=="admin.kost-seeker.index") class="active" @endif>
    <a href="index.html"><i class="fa fa-th-large"></i> <span class="nav-label">Pengguna</span> <span class="fa arrow"></span></a>
    <ul class="nav nav-second-level collapse">
        <li><a href="{{ route('admin.admin.index') }}">Admin</a></li>
        <li><a href="{{ route('admin.kost-owner.index') }}">Pemilik Kost</a></li>
        <li><a href="{{ route('admin.kost-seeker.index') }}">Penyewa Kost</a></li>
    </ul>
</li>
<li @if(Route::currentRouteName()=="admin.kost.admin-index") class="active" @endif>
    <a href="{{ route('admin.kost.admin-index') }}"><i class="fa fa-th-large"></i> <span class="nav-label">Kos</span></a>
</li>
