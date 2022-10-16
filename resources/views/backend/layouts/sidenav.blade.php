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
            <li class="@if(Request::is('*dashboard*')) active @endif">
                <a class="nav-link " href="{{route('dashboard')}}">
                    <i class="fas fa-tachometer-alt"></i><span>Dashboard</span></a></li>
            @role('pemilik')
            <li class="@if(Request::is('*kos*')) active @endif">
                <a class="nav-link " href="{{route('kos.index')}}">
                    <i class="fas fa-home"></i><span>Kelola Kos</span></a>
            </li>
            <li class="@if(Request::is('*metode_pembayaran_pemilik*')) active @endif">
                <a class="nav-link " href="{{route('metode_pembayaran_pemilik.index')}}">
                    <i class="fas fa-money-bill"></i><span>Metode Pembayaran</span></a>
            </li>
            @endrole

            @role('admin')
            <li class="dropdown @if(Request::is('*pengguna*')) active @endif">
                <a href="#" class="nav-link has-dropdown"><i class="fas fa-users"></i><span>Pengguna</span></a>
                <ul class="dropdown-menu">
                    <li class=" @if(Request::is('pengguna*') && !Request::is('*pengguna/create*')) active @endif"><a
                            class="nav-link" href="{{route('pengguna.index')}}">Daftar Pengguna</a></li>
                    <li class=" @if(Request::is('*pengguna/create*')) active @endif">
                        <a class="nav-link" href="{{route('pengguna.create')}}">Tambah Pengguna</a></li>
                </ul>
            </li>
            <li class="@if(Request::is('*metode_pembayaran*')) active @endif">
                <a class="nav-link " href="{{route('metode_pembayaran.index')}}">
                    <i class="fas fa-money-bill"></i><span>Metode Pembayaran</span></a>
            </li>
            @endrole
            <li class="dropdown @if(Request::is('*transaksi*') || Request::is('*daftar*')) active @endif">
                <a href="#" class="nav-link has-dropdown"><i class="fas fa-fire"></i><span>Data Sewa Kos</span></a>
                <ul class="dropdown-menu">
                    <li class="@if(Request::is('*transaksi*')) active @endif">
                        <a class="nav-link" href="{{route('transaksi.index')}}">Daftar Booking</a></li>
                    @role('pemilik')
                    <li class="@if(Request::is('*daftar*')) active @endif">
                        <a class="nav-link" href="{{route('pengguna.kos')}}">Daftar Pengguna Kos</a></li>
                    @endrole
                </ul>
            </li>
        </ul>
    </aside>
</div>
