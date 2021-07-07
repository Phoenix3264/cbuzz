<div id="sidebar" class="sidebar">
    <!-- begin sidebar scrollbar -->
    <div data-scrollbar="true" data-height="100%">
        <!-- begin sidebar user -->
        <ul class="nav">
            <li class="nav-profile">
                <a href="javascript:;" data-toggle="nav-profile">
                    <div class="cover with-shadow"></div>
                    <div class="image">
                        <img src="{{ asset('/color_admin_v42') }}/assets/img/user/user-13.jpg" alt="" />
                    </div>
                    <div class="info">
                        <b class="caret"></b>
                        Sean Ngu
                        <small>Front end developer</small>
                    </div>
                </a>
            </li>
            <li>
                <ul class="nav nav-profile">
                    <li><a href="javascript:;"><i class="ion-ios-cog"></i> Settings</a></li>
                    <li><a href="javascript:;"><i class="ion-ios-share-alt"></i> Send Feedback</a></li>
                    <li><a href="javascript:;"><i class="ion-ios-help"></i> Helps</a></li>
                </ul>
            </li>
        </ul>
        <!-- end sidebar user -->
        <!-- begin sidebar nav -->
        <ul class="nav">
            <li class="nav-header">Navigation</li>
            
            <li class="@if($content == 'Dashboard') active @endif">
                <a href="{{ route('Dashboard.index') }}">
                    <i class="ion ion-ios-analytics fa-2x bg-gradient-aqua"></i> 
                    <span>
                        Dashboard
                    </span>
                </a>
            </li>
            <li class="@if($content == 'Countries') active @endif">
                <a href="{{ route('Countries.index') }}">
                    <i class="ion ion-ios-cart fa-2x bg-gradient-green"></i>  
                    <span>
                        Countries
                    </span>
                </a>
            </li>



            <li class="@if($content == 'England') active @endif">
                <a href="{{ route('Countries.show', 2) }}">
                    <i class="ion ion-ios-cart fa-2x "></i>  
                    <span>
                        England
                    </span>
                </a>
            </li>

            <li class="@if($content == 'Brazil') active @endif">
                <a href="{{ route('Countries.show', 2) }}">
                    <i class="ion ion-ios-cart fa-2x "></i>  
                    <span>
                        Brazil
                    </span>
                </a>
            </li>

            <li class="@if($content == 'Norway') active @endif">
                <a href="{{ route('Countries.show', 3) }}">
                    <i class="ion ion-ios-cart fa-2x "></i>  
                    <span>
                        Norway
                    </span>
                </a>
            </li>


            <li class="@if($content == 'Teams') active @endif">
                <a href="{{ route('Teams.index') }}">
                    <i class="ion ion-ios-cart fa-2x bg-gradient-green"></i>  
                    <span>
                        Teams
                    </span>
                </a>
            </li>
 
 
            <!-- begin sidebar minify button -->
            <li><a href="javascript:;" class="sidebar-minify-btn" data-click="sidebar-minify"><i class="ion-ios-arrow-back"></i> <span>Collapse</span></a></li>
            <!-- end sidebar minify button -->
        </ul>
        <!-- end sidebar nav -->
    </div>
    <!-- end sidebar scrollbar -->
</div>
<div class="sidebar-bg"></div>