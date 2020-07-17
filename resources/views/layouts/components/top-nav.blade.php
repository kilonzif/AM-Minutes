<!-- fixed-top-->
<nav class="header-navbar navbar-expand-md navbar navbar-with-menu fixed-top navbar-semi-light bg-gradient-x-grey-blue">
    <div class="navbar-wrapper">
        <div class="navbar-header">
            <ul class="nav navbar-nav flex-row">
                <li class="nav-item mobile-menu d-md-none mr-auto"><a class="nav-link nav-menu-main menu-toggle hidden-xs" href="#"><i class="ft-menu font-large-1"></i></a></li>
                <li class="nav-item">
                    <a class="navbar-brand" href="{{ route('home') }}">
                        <img class="brand-logo" alt="AMlogo" src="{{ asset('images/pied-piper48.png') }}" style="width: 30px">
                        <h2 class="brand-text">AM</h2>
                    </a>
                </li>
                <li class="nav-item d-md-none">
                    <a class="nav-link open-navbar-container" data-toggle="collapse" data-target="#navbar-mobile"><i class="fa fa-ellipsis-v"></i></a>
                </li>
            </ul>
        </div>
        <div class="navbar-container content">
            <div class="collapse navbar-collapse" id="navbar-mobile">
                <ul class="nav navbar-nav mr-auto float-left">
                    <li class="nav-item d-none d-md-block"><a class="nav-link nav-menu-main menu-toggle hidden-xs" href="#"><i class="ft-menu"></i></a></li>
                    @yield('prison_selection')
                </ul>
                <ul class="nav navbar-nav float-right">
                    <li class="dropdown dropdown-user nav-item">
                        <a class="dropdown-toggle nav-link dropdown-user-link" href="#" data-toggle="dropdown">
                                    <span class="avatar avatar-online">
                                        @isset( Auth::user()->profile_picture )
                                            <img src="{{ asset('/ProfilePictures/'. Auth::user()->profile_picture) }}" alt="profile picture" id="user_mini_profile"><i></i></span>
                                        @else
                                        <img src="{{ asset('images/pied-piper48.png') }}" alt="profile picture" id="user_mini_profile"><i></i></span>
                                        @endisset
                            <span class="user-name">{{ Auth::user()->name }}</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <a class="dropdown-item" href="{{route('user-management.user_profile',[\Illuminate\Support\Facades\Crypt::encrypt(Auth::user()->id)])}}">Profile</a>
                            <a class="dropdown-item" href="#">Change password</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <i class="ft-power"></i>
                                {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>