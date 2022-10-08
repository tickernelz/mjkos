<!-- ======= Header ======= -->
<header id="header" class="{{Request::path() != '/' ? 'nav':''}} fixed-top d-flex align-items-center">
    <div class="container d-flex align-items-center justify-content-between">
        <h1 class="logo fw-bold"><a href="/">MJK<i class="bi bi-house-heart-fill"></i>S</a></h1>
        <!-- Uncomment below if you prefer to use an image logo -->
        <nav id="navbar" class="navbar">
            <ul>
                <li><a class="nav-link scrollto {{Request::path() == '/' ? 'active':''}}" href="/">Home</a></li>
                <li><a class="nav-link scrollto {{Request::path() == 'daftar' ? 'active':''}}" href="/daftar">Daftar
                        Kos</a></li>
                @if (!Auth::check())
                    <li><a class="nav-link scrollto" href="{{route('login')}}">Login</a></li>
                @elseif (Auth::user()->hasRole('pengunjung'))
                    <li><a class="nav-link scrollto {{Request::path() == 'favorit' ? 'active':''}}"
                           href="/favorit">Favorit</a></li>
                    <li class="dropdown" style="width: 30px"><a href="#"><img class="my-2" style="border-radius: 50%"
                                                                              width="30px"
                                                                              src="{{ asset(auth()->user()->foto ? 'images/profil/'. auth()->user()->foto : 'backend/assets/img/avatar/avatar-1.png') }}"></a>
                        <ul>
                            <li><a href="{{route('profile.detail')}}">Profile</a></li>
                            <li><a href="{{route('transaksi.saya')}}">Transaksi Saya</a></li>
                            <li><a class="nav-link scrollto" href="{{ route('logout') }}"
                                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                            </li>
                        </ul>
                    </li>
                @elseif (Auth::user()->hasRole('pemilik'))
                    <li><a class="nav-link scrollto"
                           href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="dropdown" style="width: 30px"><a href="#"><img class="my-2" style="border-radius: 50%"
                                                                              width="30px"
                                                                              src="{{ asset(auth()->user()->foto ? 'images/profil/'. auth()->user()->foto : 'backend/assets/img/avatar/avatar-1.png') }}"></a>
                        <ul>
                            <li><a class="nav-link scrollto" href="{{ route('logout') }}"
                                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                            </li>
                        </ul>
                    </li>
                @endif
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    {{ csrf_field() }}
                </form>
            </ul>
            <i class="bi bi-list mobile-nav-toggle"></i>
        </nav><!-- .navbar -->

    </div>
</header><!-- End Header -->
