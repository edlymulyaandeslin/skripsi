<div class="sidebar pe-4 pb-3">
    <nav class="navbar bg-light navbar-light">
        <a href="index.html" class="navbar-brand mx-4 mb-3">
            <h3 class="text-primary"><i class="fa fa-hashtag me-2"></i>E - SKRIPSI</h3>
        </a>
        <div class="d-flex align-items-center ms-4 mb-4">
            <div class="position-relative">
                <img class="rounded-circle" src="{{ asset('img') }}/user.jpg" alt=""
                    style="width: 40px; height: 40px;">
                <div
                    class="bg-success rounded-circle border border-2 border-white position-absolute end-0 bottom-0 p-1">
                </div>
            </div>
            <div class="ms-3">
                <h6 class="mb-0">Jhon Doe</h6>
                <span>Admin</span>
            </div>
        </div>

        <div class="navbar-nav w-100">
            <a href="/" class="nav-item nav-link {{ Request::is('/*') ? 'active' : '' }}"><i
                    class="fa fa-tachometer-alt me-2"></i>Dashboard</a>

            <a href="{{ route('judul.index') }}"
                class="nav-item nav-link {{ Request::is('judul*') ? 'active' : '' }} "><i
                    class="fa fa-book me-2"></i>Judul</a>

            <a href="/logbook" class="nav-item nav-link {{ Request::is('logbook*') ? 'active' : '' }}"><i
                    class="fa fa-book-open me-2"></i>Logbook</a>

            <div class="nav-item dropdown">
                <a href="#"
                    class="nav-link dropdown-toggle {{ Request::is('sempro*') || Request::is('nilai/sempro*') ? 'active' : '' }}"
                    data-bs-toggle="dropdown"><i class="fa fa-laptop me-2"></i>Sempro</a>
                <div class="dropdown-menu bg-transparent border-0">
                    <a href="/sempro/create"
                        class="nav-item nav-link {{ Request::is('sempro/create') ? 'active' : '' }}">Daftar
                        Sempro</a>
                    <a href="/sempro"
                        class="nav-item nav-link {{ Request::is('sempro*') && !Request::is('sempro/create') ? 'active' : '' }}">Mahasiswa
                        Sempro</a>
                    <a href="/nilai/sempro"
                        class="nav-item nav-link {{ Request::is('nilai/sempro*') ? 'active' : '' }}">Penilaian
                        Sempro</a>
                </div>
            </div>

            <div class="nav-item dropdown">
                <a href="#" class="nav-link dropdown-toggle {{ Request::is('kompre*') ? 'active' : '' }}"
                    data-bs-toggle="dropdown"><i class="fa fa-laptop me-2"></i>Kompre</a>
                <div class="dropdown-menu bg-transparent border-0">
                    <a href="/kompre/create"
                        class="nav-item nav-link {{ Request::is('kompre/create*') ? 'active' : '' }}">Daftar
                        Kompre</a>
                    <a href="/kompre" class="nav-item nav-link {{ Request::is('kompre*') ? 'active' : '' }}">Mahasiswa
                        Kompre</a>
                    <a href="/kompre" class="nav-item nav-link {{ Request::is('kompre*') ? 'active' : '' }}">Penilaian
                        Kompre</a>
                </div>
            </div>

            <div class="nav-item dropdown">
                <a href="#" class="nav-link dropdown-toggle {{ Request::is('manajemen*') ? 'active' : '' }}"
                    data-bs-toggle="dropdown"><i class="fa fa-users me-2"></i>Manajemen</a>
                <div class="dropdown-menu bg-transparent border-0">
                    <a href="manajemen/mahasiswa"
                        class="nav-item nav-link {{ Request::is('manajemen/mahasiswa*') ? 'active' : '' }}">Mahasiswa</a>
                    <a href="manajemen/koordinator"
                        class="nav-item nav-link {{ Request::is('manajemen/koordinator*') ? 'active' : '' }}">Koordinator</a>
                    <a href="manajemen/dosen"
                        class="nav-item nav-link {{ Request::is('manajemen/dosen*') ? 'active' : '' }}">Dosen</a>
                    <a href="manajemen/teampenguji"
                        class="nav-item nav-link {{ Request::is('manajemen/teampenguji*') ? 'active' : '' }}">Team
                        Penguji</a>
                </div>
            </div>

            <div class="nav-item dropdown">
                <a href="#" class="nav-link dropdown-toggle {{ Request::is('report*') ? 'active' : '' }}"
                    data-bs-toggle="dropdown"><i class="fa fa-book-dead me-2"></i>Report</a>
                <div class="dropdown-menu bg-transparent border-0">
                    <a href="/mahasiswa"
                        class="nav-item nav-link {{ Request::is('report/sempro*') ? 'active' : '' }}">Mahasiswa
                        Sempro</a>
                    <a href="/mahasiswa"
                        class="nav-item nav-link {{ Request::is('report/kompre*') ? 'active' : '' }}">Mahasiswa
                        Kompre</a>
                </div>
            </div>
        </div>
    </nav>
</div>
