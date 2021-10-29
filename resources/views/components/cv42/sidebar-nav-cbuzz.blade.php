<ul class="nav">
    <li class="nav-header">Navigation</li>

    <li class="@if($title == 'Dashboard') active @endif">
        <a href="{{ route('Dashboard.index') }}">
            <i class="ion-ios-analytics bg-blue-transparent-9"></i> 
            <span>Dashboard</span> 
        </a>
    </li>
    
    <li class="@if($title == 'Countries') active @endif">
        <a href="{{ route('Countries.index') }}">
            <i class="ion-ios-business bg-purple-transparent-9"></i> 
            <span>Countries</span> 
        </a>
    </li>
    
    <li class="@if($title == 'Clubs') active @endif">
        <a href="{{ route('Clubs.index') }}">
            <i class="ion-ios-business bg-purple-transparent-9"></i> 
            <span>Clubs</span> 
        </a>
    </li>
    
    <li class="@if($title == 'Cornerkick') active @endif">
        <a href="{{ route('Cornerkick.index') }}">
            <i class="ion-ios-business bg-purple-transparent-9"></i> 
            <span>Corner Kick</span> 
        </a>
    </li>
    
    <li class="@if($title == 'Mybet') active @endif">
        <a href="{{ route('Mybet.index') }}">
            <i class="ion-ios-business bg-purple-transparent-9"></i> 
            <span>My Bet</span> 
        </a>
    </li>
    

    <!-- begin sidebar minify button -->
    <li><a href="javascript:;" class="sidebar-minify-btn" data-click="sidebar-minify"><i class="ion-ios-arrow-back"></i> <span>Collapse</span></a></li>
    <!-- end sidebar minify button -->
</ul>