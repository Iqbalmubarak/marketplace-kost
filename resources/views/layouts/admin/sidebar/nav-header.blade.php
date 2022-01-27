<div class="dropdown profile-element">
    <img alt="image" class="rounded-circle" src="{{ asset('templates/img/profile_small.jpg') }}"/>
    <a data-toggle="dropdown" class="dropdown-toggle" href="#">
        <span class="block m-t-xs font-bold">David Williams</span>
        <span class="text-muted text-xs block">Art Director <b class="caret"></b></span>
    </a>
    <ul class="dropdown-menu animated fadeInRight m-t-xs">
        <li><a class="dropdown-item" href="profile.html">Profile</a></li>
        <li><a class="dropdown-item" href="contacts.html">Contacts</a></li>
        <li><a class="dropdown-item" href="mailbox.html">Mailbox</a></li>
        <li class="dropdown-divider"></li>
        <li><a class="dropdown-item" onclick="logout()">Logout</a></li>
        <form id="logout-form" action="{{route('logout')}}" method="POST">@csrf</form>
    </ul>
</div>
<div class="logo-element">
    IN+
</div>