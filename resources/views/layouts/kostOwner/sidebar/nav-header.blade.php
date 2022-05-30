<div class="dropdown profile-element">
    @if (Auth::user()->kostOwner->avatar != NULL)
    <img alt="image" class="rounded-circle" style="heigth:60px;width:60px" src="{{ asset('storage/images/avatar/'.Auth::user()->kostOwner->avatar) }}"/>
    @else
    <img alt="image" class="rounded-circle" style="heigth:60px;width:60px" src="{{ asset('templates/img/profile/profil1.jpeg') }}"/>
    @endif
    
    <a data-toggle="dropdown" class="dropdown-toggle" href="#">
        <span class="block m-t-xs font-bold">{{Auth::user()->kostOwner->first_name}} {{Auth::user()->kostOwner->last_name}}</span>
        <span class="text-muted text-xs block">Pemilik kos <b class="caret"></b></span>
    </a>
    <ul class="dropdown-menu animated fadeInRight m-t-xs">
        <li><a class="dropdown-item" href="{{route('profile.index')}}">Profile</a></li>\
        <li class="dropdown-divider"></li>
        <li><a class="dropdown-item" onclick="logout()">Logout</a></li>
        <form id="logout-form" action="{{route('logout')}}" method="POST">@csrf</form>
    </ul>
</div>
<div class="logo-element">
    IN+
</div>