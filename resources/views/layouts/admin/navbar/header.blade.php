<div class="navbar-header">
    <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i> </a>
</div>
<ul class="nav navbar-top-links navbar-right">
    <li>
        <a onclick="logout()">
            <i class="fa fa-sign-out" ></i> Log out
        </a>
    </li>
    <form id="logout-form" action="{{route('logout')}}" method="POST">@csrf</form>
    <li>
        <a class="right-sidebar-toggle">
        </a>
    </li>
</ul>

<div id="right-sidebar">
    @include('layouts.admin.navbar.right-sidebar')
</div>