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

                @unless (auth()->user()->role_id == 1 || auth()->user()->role_id == 2)
                    <span>{{ auth()->user()->role_id === 4 ? 'NIM. ' : 'NIDN. ' }}{{ auth()->user()->nim_or_nidn }}</span>
                @endunless

            </div>
        </div>

        <div class="navbar-nav w-100">
            <a href="/" class="nav-item nav-link {{ Request::is('/') ? 'active' : '' }}"><i
                    class="fa fa-tachometer-alt me-2"></i>Dashboard</a>

            <a href="{{ route('judul.index') }}"
                class="nav-item nav-link {{ Request::is('judul*') ? 'active' : '' }} "><i
                    class="fa fa-book me-2"></i>Judul</a>

            @unless (auth()->user()->role_id == 2)
                <a href="{{ route('logbook.index') }}"
                    class="nav-item nav-link {{ Request::is('logbook*') ? 'active' : '' }}"><i
                        class="fa fa-book-open me-2"></i>Bimbingan</a>
            @endunless

            <div class="nav-item dropdown">
                <a href="#"
                    class="nav-link dropdown-toggle {{ Request::is('sempro*') || Request::is('nilai-sempro*') ? 'active' : '' }}"
                    data-bs-toggle="dropdown"><i class="fa fa-laptop me-2"></i>Sempro</a>
                <div class="dropdown-menu bg-transparent border-0">

                    @if (auth()->user()->role_id == 4)
                        <a href="{{ route('sempro.create') }}"
                            class="nav-item nav-link {{ Request::is('sempro/create') ? 'active' : '' }}">Pendaftaran
                            Proposal</a>
                    @endif

                    <a href="{{ route('sempro.index') }}"
                        class="nav-item nav-link {{ Request::is('sempro*') && !Request::is('sempro/create') ? 'active' : '' }}">
                        Seminar Proposal</a>

                    <a href="{{ route('nilai-sempro.index') }}"
                        class="nav-item nav-link {{ Request::is('nilai-sempro*') ? 'active' : '' }}">Penilaian
                        Seminar Proposal</a>

                </div>
            </div>

            <div class="nav-item dropdown">
                <a href="#"
                    class="nav-link dropdown-toggle {{ Request::is('kompre*') || Request::is('nilai-kompre*') ? 'active' : '' }}"
                    data-bs-toggle="dropdown"><i class="fa fa-laptop me-2"></i>Kompre</a>
                <div class="dropdown-menu bg-transparent border-0">

                    @if (auth()->user()->role_id == 4)
                        <a href="{{ route('kompre.create') }}"
                            class="nav-item nav-link {{ Request::is('kompre/create') ? 'active' : '' }}">Pendaftaran
                            Komprehensif</a>
                    @endif

                    <a href="{{ route('kompre.index') }}"
                        class="nav-item nav-link {{ Request::is('kompre*') && !Request::is('kompre/create') ? 'active' : '' }}">Seminar
                        Komprehensif</a>

                    <a href="{{ route('nilai-kompre.index') }}"
                        class="nav-item nav-link {{ Request::is('nilai-kompre*') ? 'active' : '' }}">Penilaian Seminar
                        Komprehensif</a>
                </div>
            </div>

            @if (auth()->user()->role_id == 1)
                <div class="nav-item dropdown">
                    <a href="#"
                        class="nav-link dropdown-toggle {{ Request::is('manajemen*') && !Request::is(['manajemen/profile*', 'manajemen/dokumen*']) ? 'active' : '' }}"
                        data-bs-toggle="dropdown"><i class="fa fa-users me-2"></i>Account</a>
                    <div class="dropdown-menu bg-transparent border-0">
                        <a href="{{ route('mahasiswa.index') }}"
                            class="nav-item nav-link {{ Request::is('manajemen/mahasiswa*') ? 'active' : '' }}">Mahasiswa</a>
                        <a href="{{ route('koordinator.index') }}"
                            class="nav-item nav-link {{ Request::is('manajemen/koordinator*') ? 'active' : '' }}">Koordinator</a>
                        <a href="{{ route('dosen.index') }}"
                            class="nav-item nav-link {{ Request::is('manajemen/dosen*') ? 'active' : '' }}">Dosen</a>
                    </div>
                </div>
            @endif

            @if (auth()->user()->role_id == 3)
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
            @endif

            @if (auth()->user()->role_id == 2)
                <div class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle {{ Request::is('laporan*') ? 'active' : '' }}"
                        data-bs-toggle="dropdown"><i class="fa fa-book-open me-2"></i>Laporan</a>
                    <div class="dropdown-menu bg-transparent border-0">
                        <a href="/laporan/rekap-judul"
                            class="nav-item nav-link {{ Request::is('laporan/rekap-judul*') ? 'active' : '' }}">Rekap
                            Judul</a>
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
            @endif

            @unless (auth()->user()->role_id == 1 || auth()->user()->role_id == 4)
                <div class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle {{ Request::is('adm-seminar*') ? 'active' : '' }}"
                        data-bs-toggle="dropdown"><i class="fa fa-coins me-2"></i>Administrasi</a>
                    <div class="dropdown-menu bg-transparent border-0">
                        <a href="{{ route('adm') }}"
                            class="nav-item nav-link {{ Request::is('adm-seminar*') ? 'active' : '' }}">Administrasi
                            Seminar</a>
                    </div>
                </div>
            @endunless

        </div>
    </nav>
</div>
