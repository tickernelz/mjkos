<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="index.html">MJKOS</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="index.html">HI..</a>
        </div>
        <ul class="sidebar-menu">
            <li class="menu-header">Admin Panel</li>
            <li class="@if(Request::is('*dashboard*')) active @endif"><a class="nav-link "
                                                                         href="{{route('dashboard')}}"><i
                        class="fas fa-tachometer-alt"></i><span>Dashboard</span></a></li>
            @role('pemilik')
            <li class="@if(Request::is('*kos*')) active @endif"><a class="nav-link " href="{{route('kos.index')}}"><i
                        class="fas fa-home"></i><span>Kos</span></a></li>
            @endrole

            @role('admin')
            <li class="dropdown">
                <a href="#" class="nav-link has-dropdown"><i class="fas fa-fire"></i><span>Pengguna</span></a>
                <ul class="dropdown-menu">
                    <li><a class="nav-link" href="{{route('pengguna.index')}}">Daftar Pengguna</a></li>
                    <li><a class="nav-link" href="{{route('pengguna.create')}}">Tambah Pengguna</a></li>
                </ul>
            </li>
            @endrole
            <li class="dropdown">
                <a href="#" class="nav-link has-dropdown"><i class="fas fa-fire"></i><span>Data Sewa Kos</span></a>
                <ul class="dropdown-menu">
                    <li><a class="nav-link" href="{{route('transaksi.index')}}">Daftar Booking</a></li>
                    @role('pemilik')
                    <li><a class="nav-link" href="{{route('pengguna.kos')}}">Daftar Pengguna Kos</a></li>
                    @endrole
                </ul>
            </li>
        </ul>
    </aside>
</div>
