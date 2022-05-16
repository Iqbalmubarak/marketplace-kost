<ul class="nav navbar-nav mr-auto">
    <li @if(Route::currentRouteName()=="home.index") class="active" @endif>
        <a aria-expanded="false" role="button" href="{{ route('home.index') }}"> Dashboard</a>
    </li>
    <li @if(Route::currentRouteName()=="customer.booking.indexCustomer") class="active" @endif>
        <a aria-expanded="false" role="button" href="{{ route('customer.booking.indexCustomer') }}"> Riwayat Pemesanan Kamar</a>
    </li>
    <li @if(Route::currentRouteName()=="customer.history.index") class="active" @endif>
        <a aria-expanded="false" role="button" href="{{ route('customer.history.index') }}"> Riwayat Penyewaan Kamar</a>
    </li>
    <li class="dropdown">
        <a aria-expanded="false" role="button" href="#" class="dropdown-toggle" data-toggle="dropdown"> Menu item</a>
        <ul role="menu" class="dropdown-menu">
            <li><a href="">Menu item</a></li>
            <li><a href="">Menu item</a></li>
            <li><a href="">Menu item</a></li>
            <li><a href="">Menu item</a></li>
        </ul>
    </li>
    <li class="dropdown">
        <a aria-expanded="false" role="button" href="#" class="dropdown-toggle" data-toggle="dropdown"> Menu item</a>
        <ul role="menu" class="dropdown-menu">
            <li><a href="">Menu item</a></li>
            <li><a href="">Menu item</a></li>
            <li><a href="">Menu item</a></li>
            <li><a href="">Menu item</a></li>
        </ul>
    </li>
    <li class="dropdown">
        <a aria-expanded="false" role="button" href="#" class="dropdown-toggle" data-toggle="dropdown"> Menu item</a>
        <ul role="menu" class="dropdown-menu">
            <li><a href="">Menu item</a></li>
            <li><a href="">Menu item</a></li>
            <li><a href="">Menu item</a></li>
            <li><a href="">Menu item</a></li>
        </ul>
    </li>
    <li class="dropdown">
        <a aria-expanded="false" role="button" href="#" class="dropdown-toggle" data-toggle="dropdown"> Menu item</a>
        <ul role="menu" class="dropdown-menu">
            <li><a href="">Menu item</a></li>
            <li><a href="">Menu item</a></li>
            <li><a href="">Menu item</a></li>
            <li><a href="">Menu item</a></li>
        </ul>
    </li>

</ul>
<ul class="nav navbar-top-links navbar-right">
    <li>
        <a onclick="logout()">
            <i class="fa fa-sign-out"></i> Log out
        </a>
        <form id="logout-form" action="{{route('logout')}}" method="POST">@csrf</form>
    </li>
</ul>