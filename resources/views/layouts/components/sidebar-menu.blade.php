
<div class="main-menu menu-fixed menu-dark menu-accordion menu-shadow" data-scroll-to-active="true">
    <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">

            <li class="nav-item {{isRouteActive('home')}}"><a href="{{route('home')}}">
                    <i class="feather icon-home"></i><span class="menu-title" data-i18n="">Dashboard</span></a>
            </li>
            <li class="nav-item {{isRouteActive('minutes','false','open')}}">
                <a href="#"><i class="icon-list"></i><span class="menu-title" data-i18n="">{{__('Meeting Minutes')}}</span></a>
                <ul class="menu-content">
                    <li class="nav-item {{isRouteActive('minutes.index')}}">
                        <a href="{{route('minutes.index')}}"><i class="icon-list"></i>
                            <span class="menu-title" data-i18n="">{{__('All Minutes')}}</span>
                        </a>
                    </li>
                    <li class="nav-item {{isRouteActive('home')}}"><a href="{{route('home')}}"><i class="ft-search"></i>
                            <span class="menu-title" data-i18n="">Search</span></a>
                    </li>
                    <li class="nav-item {{isRouteActive('minutes.filter')}}">
                        <a href="{{route('minutes.filter')}}"><i class="ft-filter"></i>
                            <span class="menu-title" data-i18n="">Filter</span></a>
                    </li>

                </ul>
            </li>
            <li class="nav-item {{isRouteActive('user-management.users')}}"><a href="{{route('user-management.users')}}">
                    <i class="icon-users"></i><span class="menu-title" data-i18n="">Users</span></a>
            </li>

        </ul>
    </div>
</div>
