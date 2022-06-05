<li class="nav-header">
    @include('layouts.kostOwner.sidebar.nav-header')
</li>
<li @if(Route::currentRouteName()=="home.index") class="active" @endif>
    <a href="{{ route('home.index') }}"><i class="fa fa-th-large"></i> <span class="nav-label">Dashboard</span></a>
</li>
<li @if(Route::currentRouteName()=="owner.kost.index") class="active" @endif>
    <a href="{{ route('owner.kost.index') }}"><i class="fa fa-sitemap"></i> <span class="nav-label">Kos</span></a>
</li>
<li @if(Route::currentRouteName()=="owner.rent.index") class="active" @endif>
    <a href="{{ route('owner.rent.index') }}"><i class="fa fa-files-o"></i> <span class="nav-label">Penyewaan Kamar</span></a>
</li>
<li @if(Route::currentRouteName()=="owner.tenant.index") class="active" @endif>
    <a href="{{ route('owner.tenant.index') }}"><i class="fa fa-user"></i> <span class="nav-label">Penyewa</span></a>
</li>
<li @if(Route::currentRouteName()=="owner.booking.index") class="active" @endif>
    <a href="{{ route('owner.booking.index') }}"><i class="fa fa-shopping-cart"></i> <span class="nav-label">Booking</span></a>
</li>
<li @if(Route::currentRouteName()=="owner.chat.index") class="active" @endif>
    <a href="{{ route('owner.chat.index') }}"><i class="fa fa-comments"></i> <span class="nav-label">Chat</span></a>
</li>

