<li class="nav-header">
    @include('layouts.kostOwner.sidebar.nav-header')
</li>
<li @if(Route::currentRouteName()=="home.index") class="active" @endif>
    <a href="{{ route('home.index') }}"><i class="fa fa-th-large"></i> <span class="nav-label">Dashboard</span></a>
</li>
<li @if(Route::currentRouteName()=="owner.kost.index") class="active" @endif>
    <a href="{{ route('owner.kost.index') }}"><i class="fa fa-th-large"></i> <span class="nav-label">Kelola Kos</span></a>
</li>
<li @if(Route::currentRouteName()=="owner.rent.index") class="active" @endif>
    <a href="{{ route('owner.rent.index') }}"><i class="fa fa-th-large"></i> <span class="nav-label">Kelola Penyewaan Kamar</span></a>
</li>
<li @if(Route::currentRouteName()=="owner.tenant.index") class="active" @endif>
    <a href="{{ route('owner.tenant.index') }}"><i class="fa fa-th-large"></i> <span class="nav-label">Kelola Penyewa</span></a>
</li>
<li @if(Route::currentRouteName()=="owner.booking.index") class="active" @endif>
    <a href="{{ route('owner.booking.index') }}"><i class="fa fa-th-large"></i> <span class="nav-label">Kelola Booking</span></a>
</li>

