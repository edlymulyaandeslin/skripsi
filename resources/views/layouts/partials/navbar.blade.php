<nav class="navbar navbar-expand bg-light navbar-light sticky-top px-4 py-0">
    <a href="index.html" class="navbar-brand d-flex d-lg-none me-4">
        <h2 class="text-primary mb-0"><i class="fa fa-hashtag"></i></h2>
    </a>
    <a href="#" class="sidebar-toggler flex-shrink-0">
        <i class="fa fa-bars"></i>
    </a>

    <div class="navbar-nav align-items-center ms-auto">
        <div class="nav-item dropdown">
            <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                @if (auth()->user()->foto_profil)
                    <img src="{{ asset('storage/' . auth()->user()->foto_profil) }}" style="width: 40px; height: 40px;"
                        class="rounded-circle" alt="404">
                @else
                    <img src="https://ui-avatars.com/api/?name={{ auth()->user()->name }}&background=3498db&color=ecf0f1"
                        style="width: 40px; height: 40px;" class="img-fluid rounded-circle" alt="404">
                @endif
                <span class="d-none d-lg-inline-flex">{{ auth()->user()->name }}</span>
            </a>
            <div class="dropdown-menu dropdown-menu-end bg-light border-0 rounded-0 rounded-bottom m-0">
                <a href="/manajemen/profile/{{ auth()->user()->id }}" class="dropdown-item"><i class="fa fa-user"></i>
                    Profile</a>
                @can('mahasiswa')
                    <a href="/manajemen/dokumen" class="dropdown-item"><i class="fa fa-file-alt"></i> Lengkapi
                        Dokumen</a>
                @endcan
                <form action="/auth/logout" method="post">
                    @csrf
                    <button type="submit" class="dropdown-item"><i class="fa fa-sign-out-alt"></i> Log Out</button>
                </form>
            </div>
        </div>
    </div>
</nav>
