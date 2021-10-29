<li class="dropdown navbar-user">
    <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown">
        <span class="d-none d-md-inline">
            {{ Auth::user()->name }}
        </span> <b class="caret"></b>
    </a>
    <div class="dropdown-menu dropdown-menu-right">
        <a href="javascript:;" class="dropdown-item">Edit Profile</a>
        <div class="dropdown-divider"></div>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <a href="{{ route('logout') }}" 
                class="dropdown-item" 
                onclick="event.preventDefault(); this.closest('form').submit();">
                {{ __('Log Out') }}
            </a>
        </form>


    </div>
</li>