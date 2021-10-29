<ul class="nav">
    <li class="nav-profile">
        <a href="javascript:;" data-toggle="nav-profile">
            <div class="cover with-shadow"></div>
            <div class="image">
                <img src="../assets/img/user/user-13.jpg" alt="" />
            </div>
            <div class="info">
                {{ Auth::user()->name }}
            </div>
        </a>
    </li>
</ul>