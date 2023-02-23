<div class="collapse navbar-collapse" id="sidenav-collapse-main">
    <!-- Navigation -->
    <ul class="navbar-nav">
        @if (auth()->user()->role->role == 'Admin')
            <li class="nav-item {{ Request::segment(1) == 'dashboard' ? 'active' : '' }}">
                <a class="nav-link {{ Request::segment(1) == 'dashboard' ? 'active' : '' }} " href="{{ route('dashboard') }}">
                    <i class="fas fa-home text-primary"></i>Dashboard
                </a>
            </li>
            <li class="nav-item {{ Request::segment(1) == 'kehadiran' ? 'active' : '' }}">
                <a class="nav-link {{ Request::segment(1) == 'kehadiran' ? 'active' : '' }} " href="{{ route('kehadiran.index') }}">
                    <i class="ni ni-check-bold text-purple"></i> Presensi
                </a>
            </li>
            <li class="nav-item {{ Request::segment(1) == 'users' ? 'active' : '' }}">
                <a class="nav-link {{ Request::segment(1) == 'users' ? 'active' : '' }} " href="{{ route('users.index') }}">
                    <i class="ni ni-circle-08 text-orange"></i> Pegawai
                </a>
            </li>
            <li class="nav-item {{ Request::segment(2) == 'maps' ? 'active' : '' }}">
                <a class="nav-link {{ Request::segment(2) == 'maps' ? 'active' : '' }} " href="/s/users/maps">
                    <i class="ni ni-map-big text-info"></i>Lokasi Pegawai
                </a>
            </li>
            <li class="nav-item {{ Request::segment(1) == 'report' ? 'active' : '' }}">
                <a class="nav-link {{ Request::segment(1) == 'report' ? 'active' : '' }} " href="{{ route('report.index') }}">
                    <i class="fas fa-print text-pink"></i>Report
                </a>
            </li>
        @elseif (in_array(auth()->user()->role->role, ['Eselon 4', 'Eselon 3', 'Eselon 2', 'Eselon 1']))
            <li class="nav-item {{ Request::segment(1) == 'atasanPresents' ? 'active' : '' }}">
                <a class="nav-link {{ Request::segment(1) == 'atasanPresents' ? 'active' : '' }} " href="{{ route('atasanPresents.index') }}">
                    <i class="ni ni-check-bold text-primary"></i> Presensi
                </a>
            </li>
            <li class="nav-item {{ Request::segment(1) == 'activities' ? 'active' : '' }}">
                <a class="nav-link {{ Request::segment(1) == 'activities' ? 'active' : '' }} " href="{{ route('activities.index') }}">
                    <i class="ni ni-active-40 text-red"></i> Aktifitas
                </a>
            </li>
            <li class="nav-item {{ Request::segment(1) == 'atasan' ? 'active' : '' }}">
                <a class="nav-link {{ Request::segment(1) == 'atasan' ? 'active' : '' }} " href="{{ route('atasan.index') }}">
                    <i class="ni ni-circle-08 text-orange"></i> Pegawai
                </a>
            </li>
            <li class="nav-item {{ Request::segment(2) == 'maps' ? 'active' : '' }}">
                <a class="nav-link {{ Request::segment(2) == 'maps' ? 'active' : '' }} " href="/s/users/maps">
                    <i class="ni ni-map-big text-info"></i>Lokasi Pegawai
                </a>
            </li>
            <li class="nav-item {{ Request::segment(1) == 'permohonan' ? 'active' : '' }}">
                <a class="nav-link {{ Request::segment(1) == 'permohonan' ? 'active' : '' }} " href="{{ route('permohonan.list') }}">
                    <i class="ni ni-calendar-grid-58 text-green"></i> Permohonan
                </a>
            </li>
        @elseif (in_array(auth()->user()->role->role, ['Pegawai']))
            <li class="nav-item {{ Request::segment(1) == 'daftar-hadir' ? 'active' : '' }}">
                <a class="nav-link {{ Request::segment(1) == 'daftar-hadir' ? 'active' : '' }} " href="{{ route('daftar-hadir') }}">
                    <i class="ni ni-check-bold text-primary"></i> Presensi
                </a>
            </li>
            <li class="nav-item {{ Request::segment(1) == 'activities' ? 'active' : '' }}">
                <a class="nav-link {{ Request::segment(1) == 'activities' ? 'active' : '' }} " href="{{ route('activities.index') }}">
                    <i class="ni ni-active-40 text-red"></i> Aktifitas
                </a>
            </li>
            <li class="nav-item {{ Request::segment(1) == 'permohonan' ? 'active' : '' }}">
                <a class="nav-link {{ Request::segment(1) == 'permohonan' ? 'active' : '' }} " href="{{ route('permohonan.index') }}">
                    <i class="ni ni-calendar-grid-58 text-red"></i> Permohonan
                </a>
            </li>
        @endif
        @if (in_array(auth()->user()->role->role, ['Admin OPD']))
            <li class="nav-item {{ Request::segment(1) == 'dashboard' ? 'active' : '' }}">
                <a class="nav-link {{ Request::segment(1) == 'dashboard' ? 'active' : '' }} " href="{{ route('dashboard') }}">
                    <i class="fas fa-home text-primary"></i>Dashboard
                </a>
            </li>
            <li class="nav-item {{ Request::segment(1) == 'kehadiran' ? 'active' : '' }}">
                <a class="nav-link {{ Request::segment(1) == 'kehadiran' ? 'active' : '' }} " href="{{ route('kehadiran.index') }}">
                    <i class="ni ni-check-bold text-purple"></i> Presensi
                </a>
            </li>
            <li class="nav-item {{ Request::segment(1) == 'users' ? 'active' : '' }}">
                <a class="nav-link {{ Request::segment(1) == 'users' ? 'active' : '' }} " href="{{ route('users.index') }}">
                    <i class="ni ni-circle-08 text-orange"></i> Pegawai
                </a>
            </li>
            <li class="nav-item {{ Request::segment(1) == 'report' ? 'active' : '' }}">
                <a class="nav-link {{ Request::segment(1) == 'report' ? 'active' : '' }} " href="{{ route('report.index') }}">
                    <i class="fas fa-print text-pink"></i>Report
                </a>
            </li>
        @endif
        <li class="nav-item {{ Request::segment(1) == 'profil' ? 'active' : '' }}">
            <a class="nav-link {{ Request::segment(1) == 'profil' ? 'active' : '' }} " href="{{ route('profil') }}">
                <i class="ni ni-single-02 text-yellow"></i> Profil
            </a>
        </li>
    </ul>
    @if (in_array(auth()->user()->role->role, ['Admin', 'Admin OPD']))
        <hr class="my-3">
        <h6 class="navbar-heading text-muted">Konfigurasi</h6>
        <ul class="navbar-nav">
            <li class="nav-item {{ Request::segment(1) == 'satker' ? 'active' : '' }}">
                <a class="nav-link {{ Request::segment(1) == 'satker' ? 'active' : '' }} " href="{{ route('satker.index') }}">
                    <i class="ni ni-building text-green"></i> Unit Kerja
                </a>
            </li>
            <li class="nav-item {{ Request::segment(1) == 'locations' ? 'active' : '' }}">
                <a class="nav-link {{ Request::segment(1) == 'locations' ? 'active' : '' }} " href="{{ route('locations.index') }}">
                    <i class="ni ni-pin-3 text-grey"></i> Lokasi Presensi
                </a>
            </li>
            <li class="nav-item {{ Request::segment(1) == 'jam-kerja' ? 'active' : '' }}">
                <a class="nav-link {{ Request::segment(1) == 'jam-kerja' ? 'active' : '' }} " href="{{ route('jamkerja.index') }}">
                    <i class="ni ni-time-alarm text-red"></i> Jam Kerja
                </a>
            </li>
            <li class="nav-item {{ Request::segment(1) == 'sanksi' ? 'active' : '' }}">
                <a class="nav-link {{ Request::segment(1) == 'sanksi' ? 'active' : '' }} " href="{{ route('tmsanksi.index') }}">
                    <i class="ni ni-books text-blue"></i> Sanksi
                </a>
            </li>
            @if (in_array(auth()->user()->role->role, ['Admin']))
                <li class="nav-item {{ Request::segment(1) == 'hari-libur' ? 'active' : '' }}">
                    <a class="nav-link {{ Request::segment(1) == 'hari-libur' ? 'active' : '' }} " href="{{ route('hari-libur.index') }}">
                        <i class="ni ni-calendar-grid-58 text-green"></i> Hari Libur
                    </a>
                </li>
                <li class="nav-item {{ Request::segment(2) == 'pengumuman' ? 'active' : '' }}">
                    <a class="nav-link {{ Request::segment(2) == 'pengumuman' ? 'active' : '' }} " href="{{ route('config.pengumuman') }}">
                        <i class="ni ni-books text-blue"></i>Pengumuman
                    </a>
                </li>
                <li class="nav-item {{ Request::segment(1) == 'config' ? 'active' : '' }}">
                    <a class="nav-link {{ Request::segment(1) == 'config' ? 'active' : '' }} " href="{{ route('config.index') }}">
                        <i class="ni ni-settings-gear-65 text-black"></i>Konfigurasi App
                    </a>
                </li>
            @endif
        </ul>
    @endif
    <hr class="my-3">
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i class="ni ni-user-run text-info"></i> Logout
            </a>
        </li>
    </ul>
</div>
