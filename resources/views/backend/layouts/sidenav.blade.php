<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="index.html">MJKOST</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="index.html">HI..</a>
        </div>
        <ul class="sidebar-menu">
            <li class="menu-header">Admin Panel</li>
            <li class="active"><a class="nav-link " href="{{route('dashboard')}}"><i class="fas fa-tachometer-alt"></i><span>Dashboard</span></a></li>
            @role('pemilik')
            <li class="dropdown">
                <a href="#" class="nav-link has-dropdown"><i class="fas fa-fire"></i><span>Masters</span></a>
                <ul class="dropdown-menu">
                    <li><a class="nav-link" href="{{route('fasilitas.index')}}">Fasilitas Kos</a></li>
                    <li><a class="nav-link" href="{{route('peraturan.index')}}">Peraturan Kos</a></li>
                    <li><a class="nav-link" href="{{route('pintu.index')}}">Nomer Kamar</a></li>
                    <li><a class="nav-link" href="{{route('kos.index')}}">Informasi Rumah Kos</a></li>
                </ul>
            </li>
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
                <a href="#" class="nav-link has-dropdown"><i class="fas fa-fire"></i><span>Data Kamar</span></a>
                <ul class="dropdown-menu">
                    <li><a class="nav-link" href="{{route('kamar.index')}}">Daftar Kamar</a></li>
                    @role('pemilik')
                    <li><a class="nav-link" href="{{route('kamar.create')}}">Tambah Kamar</a></li>
                    @endrole
                </ul>
            </li>
            <li class="dropdown">
                <a href="#" class="nav-link has-dropdown"><i class="fas fa-fire"></i><span>Data Sewa Kos</span></a>
                <ul class="dropdown-menu">
                    <li><a class="nav-link" href="{{route('transaksi.index')}}">Daftar Booking</a></li>
                    @role('pemilik')
                    <li><a class="nav-link" href="{{route('pengguna.kamar')}}">Daftar Pengguna Kamar</a></li>
                    @endrole
                </ul>
            </li>
        </ul>
    </aside>
</div>
