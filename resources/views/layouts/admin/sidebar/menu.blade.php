<li class="nav-header">
    @include('layouts.admin.sidebar.nav-header')
</li>
<li class="active">
    <a href="{{ route('home.index') }}"><i class="fa fa-th-large"></i> <span class="nav-label">Dashboard</span></a>
</li>
<li>
    <a href="index.html"><i class="fa fa-th-large"></i> <span class="nav-label">Pengguna</span> <span class="fa arrow"></span></a>
    <ul class="nav nav-second-level collapse">
        <li><a href="{{ route('admin.admin.index') }}">Admin</a></li>
        <li><a href="{{ route('admin.kost-owner.index') }}">Pemilik Kost</a></li>
        <li><a href="{{ route('admin.kost-seeker.index') }}">Penyewa Kost</a></li>
    </ul>
</li>
