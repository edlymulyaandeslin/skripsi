<div class="sidebar pe-4 pb-3">
    <nav class="navbar bg-light navbar-light">
        <a href="index.html" class="navbar-brand mx-4 mb-3">
            <h3 class="text-primary"><i class="fa fa-book-open me-2"></i>E - SKRIPSI</h3>
        </a>
        <div class="d-flex align-items-center ms-4 mb-4">
            <div class="position-relative">
                @if (auth()->user()->foto_profil)
                    <img src="{{ asset('storage/' . auth()->user()->foto_profil) }}" style="width: 40px; height: 40px;"
                        class="rounded-circle" alt="404">
                @else
                    <img src="https://ui-avatars.com/api/?name={{ auth()->user()->name }}&background=3498db&color=ecf0f1"
                        style="width: 40px; height: 40px;" class="img-fluid rounded-circle" alt="404">
                @endif
                <div
                    class="bg-success rounded-circle border border-2 border-white position-absolute end-0 bottom-0 p-1">
                </div>
            </div>
            <div class="ms-3">
                <h6 class="mb-0">{{ auth()->user()->name }}</h6>
                <span>{{ auth()->user()->role->name }}</span>
                <br>
                @unless (auth()->user()->can('admin') || auth()->user()->can('koordinator'))
                    <span>{{ auth()->user()->role_id === 4 ? 'NIM. ' : 'NIDN. ' }}{{ auth()->user()->nim_or_nidn }}</span>
                @endunless

            </div>
        </div>

        <div class="navbar-nav w-100">
            <a href="/" class="nav-item nav-link {{ Request::is('/*') ? 'active' : '' }}"><i
                    class="fa fa-tachometer-alt me-2"></i>Dashboard</a>
            {{-- @if (auth()->user()->dokumen != null) --}}
            <a href="{{ route('judul.index') }}"
                class="nav-item nav-link {{ Request::is('judul*') ? 'active' : '' }} "><i
                    class="fa fa-book me-2"></i>Judul</a>

            @cannot('koordinator')
                <a href="/logbook" class="nav-item nav-link {{ Request::is('logbook*') ? 'active' : '' }}"><i
                        class="fa fa-book-open me-2"></i>Bimbingan</a>
            @endcannot

            <div class="nav-item dropdown">
                <a href="#"
                    class="nav-link dropdown-toggle {{ Request::is('sempro*') || Request::is('nilai/sempro*') ? 'active' : '' }}"
                    data-bs-toggle="dropdown"><i class="fa fa-laptop me-2"></i>Sempro</a>
                <div class="dropdown-menu bg-transparent border-0">

                    @can('mahasiswa')
                        <a href="/sempro/create"
                            class="nav-item nav-link {{ Request::is('sempro/create') ? 'active' : '' }}">Pendaftaran
                            Proposal</a>
                    @endcan

                    <a href="/sempro"
                        class="nav-item nav-link {{ Request::is('sempro*') && !Request::is('sempro/create') ? 'active' : '' }}">
                        Seminar Proposal</a>

                    <a href="/nilai/sempro"
                        class="nav-item nav-link {{ Request::is('nilai/sempro*') ? 'active' : '' }}">Penilaian
                        Seminar Proposal</a>

                </div>
            </div>

            <div class="nav-item dropdown">
                <a href="#"
                    class="nav-link dropdown-toggle {{ Request::is('kompre*') || Request::is('nilai/kompre*') ? 'active' : '' }}"
                    data-bs-toggle="dropdown"><i class="fa fa-laptop me-2"></i>Kompre</a>
                <div class="dropdown-menu bg-transparent border-0">

                    @can('mahasiswa')
                        <a href="/kompre/create"
                            class="nav-item nav-link {{ Request::is('kompre/create') ? 'active' : '' }}">Pendaftaran
                            Komprehensif</a>
                    @endcan

                    <a href="/kompre"
                        class="nav-item nav-link {{ Request::is('kompre*') && !Request::is('kompre/create') ? 'active' : '' }}">Seminar
                        Komprehensif</a>

                    <a href="/nilai/kompre"
                        class="nav-item nav-link {{ Request::is('nilai/kompre*') ? 'active' : '' }}">Penilaian Seminar
                        Komprehensif</a>
                </div>
            </div>

            @can('admin')
                <div class="nav-item dropdown">
                    <a href="#"
                        class="nav-link dropdown-toggle {{ Request::is('manajemen*') && !Request::is(['manajemen/profile*', 'manajemen/dokumen*']) ? 'active' : '' }}"
                        data-bs-toggle="dropdown"><i class="fa fa-users me-2"></i>Account</a>
                    <div class="dropdown-menu bg-transparent border-0">
                        <a href="/manajemen/mahasiswa"
                            class="nav-item nav-link {{ Request::is('manajemen/mahasiswa*') ? 'active' : '' }}">Mahasiswa</a>
                        <a href="/manajemen/koordinator"
                            class="nav-item nav-link {{ Request::is('manajemen/koordinator*') ? 'active' : '' }}">Koordinator</a>
                        <a href="/manajemen/dosen"
                            class="nav-item nav-link {{ Request::is('manajemen/dosen*') ? 'active' : '' }}">Dosen</a>
                    </div>
                </div>
            @endcan

            @can('dosen')
                <div class="nav-item dropdown">
                    <a href="#"
                        class="nav-link dropdown-toggle {{ Request::is('mahasiswa-bimbingan*') || Request::is('mahasiswa-uji-sempro*') || Request::is('mahasiswa-uji-kompre*') ? 'active' : '' }}"
                        data-bs-toggle="dropdown"><i class="fa fa-users me-2"></i>Mahasiswa</a>
                    <div class="dropdown-menu bg-transparent border-0">
                        <a href="/mahasiswa-bimbingan"
                            class="nav-item nav-link {{ Request::is('mahasiswa-bimbingan*') ? 'active' : '' }}">Bimbingan</a>
                        <a href="/mahasiswa-uji-sempro"
                            class="nav-item nav-link {{ Request::is('mahasiswa-uji-sempro*') ? 'active' : '' }}">Ujian
                            Proposal</a>
                        <a href="/mahasiswa-uji-kompre"
                            class="nav-item nav-link {{ Request::is('mahasiswa-uji-kompre*') ? 'active' : '' }}">Ujian
                            Komprehensif</a>
                    </div>
                </div>
            @endcan

            @can('koordinator')
                <div class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle {{ Request::is('laporan*') ? 'active' : '' }}"
                        data-bs-toggle="dropdown"><i class="fa fa-book-open me-2"></i>Laporan</a>
                    <div class="dropdown-menu bg-transparent border-0">
                        <a href="/laporan/seminar"
                            class="nav-item nav-link {{ Request::is('laporan/seminar*') ? 'active' : '' }}">Mahasiswa
                            Seminar</a>
                        <a href="/laporan/lulus-sempro"
                            class="nav-item nav-link {{ Request::is('laporan/lulus-sempro*') ? 'active' : '' }}">
                            Lulus
                            Sempro</a>
                        <a href="/laporan/lulus-kompre"
                            class="nav-item nav-link {{ Request::is('laporan/lulus-kompre*') ? 'active' : '' }}">
                            Lulus Kompre</a>
                        <a href="/laporan/yudisium"
                            class="nav-item nav-link {{ Request::is('laporan/yudisium*') ? 'active' : '' }}">Mahasiswa
                            Yudisium</a>
                    </div>
                </div>
            @endcan

        </div>
    </nav>
</div>
