<li class="nav-header">
    @include('layouts.kostOwner.sidebar.nav-header')
</li>
<li @if(Route::currentRouteName()=="home.index") class="active" @endif>
    <a href="{{ route('home.index') }}"><i class="fa fa-th-large"></i> <span class="nav-label">Dashboard</span></a>
</li>
<li @if(Route::currentRouteName()=="owner.kost.index") class="active" @endif>
    <a href="{{ route('owner.kost.index') }}"><i class="fa fa-th-large"></i> <span class="nav-label">Manage Kost</span></a>
</li>

