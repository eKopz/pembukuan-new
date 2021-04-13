<div class="nk-nav-scroll">
    <ul class="metismenu" id="menu">
        <li class="nav-label" style="color: #3d8b40">Menu</li>
        @if (Session::get('akses') == 1)
            <li class="mega-menu mega-menu-lg">
                <a class="has-arrow" href="javascript:void()" aria-expanded="false">
                    <i class="fa fa-dashboard"></i><span class="nav-text">Dashboard</span>
                </a>
                <ul aria-expanded="false">
                    <li><a href="/">Dashboard</a></li>
                </ul>
            </li>
            <li class="mega-menu mega-menu-lg">
                <a class="has-arrow" href="javascript:void()" aria-expanded="false">
                    <i class="fa fa-users"></i><span class="nav-text">Pengurus</span>
                </a>
                <ul aria-expanded="false">
                    <li><a href="/pengurus">Pengurus Koperasi</a></li>
                </ul>
            </li>
            <li class="mega-menu mega-menu-lg">
                <a class="has-arrow" href="javascript:void()" aria-expanded="false">
                    <i class="fa fa-user"></i><span class="nav-text">Anggota</span>
                </a>
                <ul aria-expanded="false">
                    <li><a href="/anggota">Anggota Koperasi</a></li>
                </ul>
            </li>
            <li class="mega-menu mega-menu-lg">
                <a class="has-arrow" href="javascript:void()" aria-expanded="false">
                    <i class="fa fa-book"></i><span class="nav-text">Kas</span>
                </a>
                <ul aria-expanded="false">
                    <li><a href="/kas">Kelola Kas</a></li>
                    <li><a href="/kas/masuk/">Rekap Kas Masuk</a></li>
                    <li><a href="/kas/keluar/">Rekap Kas Keluar</a></li>
                </ul>
            </li>
            <li class="mega-menu mega-menu-lg">
                <a class="has-arrow" href="javascript:void()" aria-expanded="false">
                    <i class="fa fa-money"></i><span class="nav-text">Simpanan</span>
                </a>
                <ul aria-expanded="false">
                    <li><a href="/simpanan/transaksi">Transaksi</a></li>
                    <li><a href="/simpanan/penarikan">Penarikan Simpanan</a></li>
                    <li><a href="/simpanan">Rekap Simpanan</a></li>
                </ul>
            </li>
            <li class="mega-menu mega-menu-lg">
                <a class="has-arrow" href="javascript:void()" aria-expanded="false">
                    <i class="fa fa-money"></i><span class="nav-text">Pinjaman</span>
                </a>
                <ul aria-expanded="false">
                    <li><a href="/pinjaman/transaksi">Transaksi</a></li>
                    <li><a href="/pinjaman/pengajuan">Pengajuan Pinjaman</a></li>
                    <li><a href="/pinjaman">Rekap Pinjaman</a></li>
                </ul>
            </li>
            <li class="mega-menu mega-menu-lg">
                <a class="has-arrow" href="javascript:void()" aria-expanded="false">
                    <i class="fa fa-bar-chart"></i><span class="nav-text">Laporan</span>
                </a>
                <ul aria-expanded="false">
                    {{-- <li><a href="/keuangan/penghasilan/">Penghasilan saya</a></li>
                    <li><a href="/keuangan/rekening/">Rekening Bank</a></li> --}}
                    <li><a href="#">Coming Soon</a></li>
                </ul>
            </li>
            <li class="mega-menu mega-menu-lg">
                <a class="has-arrow" href="javascript:void()" aria-expanded="false">
                    <i class="fa fa-shopping-cart"></i><span class="nav-text">Kopmart</span>
                </a>
                <ul aria-expanded="false">
                    <li><a href="/kopmart">Data Toko</a></li>
                </ul>
            </li>
            <li class="mega-menu mega-menu-lg">
                <a class="has-arrow" href="javascript:void()" aria-expanded="false">
                    <i class="fa fa-cog"></i><span class="nav-text">Pengaturan</span>
                </a>
                <ul aria-expanded="false">
                    {{-- <li><a href="/keuangan/penghasilan/">Penghasilan saya</a></li>
                    <li><a href="/keuangan/rekening/">Rekening Bank</a></li> --}}

                    <li><a href="/karyawan">Kelola Karyawan</a></li>
                </ul>
            </li> 
        @else
            <li class="mega-menu mega-menu-lg">
                <a class="has-arrow" href="javascript:void()" aria-expanded="false">
                    <i class="fa fa-dashboard"></i><span class="nav-text">Dashboard</span>
                </a>
                <ul aria-expanded="false">
                    <li><a href="/">Dashboard</a></li>
                </ul>
            </li>
            <li class="mega-menu mega-menu-lg">
                <a class="has-arrow" href="javascript:void()" aria-expanded="false">
                    <i class="fa fa-bar-chart"></i><span class="nav-text">Laporan</span>
                </a>
                <ul aria-expanded="false">
                    {{-- <li><a href="/keuangan/penghasilan/">Penghasilan saya</a></li>
                    <li><a href="/keuangan/rekening/">Rekening Bank</a></li> --}}
                    <li><a href="#">Coming Soon</a></li>
                </ul>
            </li>
        @endif
    </ul>
</div>