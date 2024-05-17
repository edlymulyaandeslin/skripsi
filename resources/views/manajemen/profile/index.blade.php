@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="bg-light rounded h-100 p-4">
                <h4 class="mb-4">Profile Saya</h4>
                <form action="/manajemen/profile/{{ $user->id }}" method="post" enctype="multipart/form-data"
                    class="row">
                    @method('patch')
                    @csrf
                    <div class="col-md-4 d-flex justify-content-center">

                        @if ($user->foto_profil)
                            <img src="{{ asset('storage/' . $user->foto_profil) }}" id="preview-foto"
                                style="width: 200px; height: 250px;" class="img-fluid rounded-1" alt="404">
                        @else
                            <img src="https://ui-avatars.com/api/?name={{ auth()->user()->name }}&background=3498db&color=ecf0f1"
                                style="width: 200px; height: 250px;" id="preview-foto" class="img-fluid rounded-1"
                                alt="404">
                        @endif

                    </div>
                    <div class="col">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control @error('name') is-invalid @enderror"
                                id="floatingInput" name="name" placeholder="Name" value="{{ old('name', $user->name) }}"
                                disabled>
                            <label for="floatingInput">Nama</label>
                            @error('name')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-floating mb-3">
                            <input type="number" class="form-control @error('nim_or_nidn') is-invalid @enderror"
                                id="floatingInput" name="nim_or_nidn" placeholder="NIM"
                                value="{{ old('nim_or_nidn', $user->nim_or_nidn) }}" disabled>
                            <label for="floatingInput">{{ auth()->user()->role_id !== 4 ? 'NIDN' : 'NIM' }}</label>
                            @error('nim_or_nidn')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <p class="my-0">Jenis Kelamin</p>
                            @if ($user->jenis_kelamin === 'laki-laki')
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="jenis_kelamin" value="laki-laki"
                                        checked disabled>
                                    <label class="form-check-label" for="laki-laki">
                                        Laki Laki
                                    </label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="jenis_kelamin" value="perempuan"
                                        disabled>
                                    <label class="form-check-label" for="perempuan">
                                        Perempuan
                                    </label>
                                </div>
                            @elseif ($user->jenis_kelamin === 'perempuan')
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="jenis_kelamin" value="laki-laki"
                                        disabled>
                                    <label class="form-check-label" for="laki-laki">
                                        Laki Laki
                                    </label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="jenis_kelamin" value="perempuan"
                                        checked disabled>
                                    <label class="form-check-label" for="perempuan">
                                        Perempuan
                                    </label>
                                </div>
                            @else
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="jenis_kelamin" value="laki-laki"
                                        disabled>
                                    <label class="form-check-label" for="laki-laki">
                                        Laki Laki
                                    </label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="jenis_kelamin" value="perempuan"
                                        disabled>
                                    <label class="form-check-label" for="perempuan">
                                        Perempuan
                                    </label>
                                </div>
                            @endif

                        </div>

                        <div class="form-floating mb-3">
                            <input type="text" class="form-control @error('email') is-invalid @enderror"
                                id="floatingInput" name="email" placeholder="email"
                                value="{{ old('email', $user->email ?? '-') }}" disabled>
                            <label for="floatingInput">email</label>
                            @error('email')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="form-floating mb-3">
                            <input type="text" class="form-control @error('no_hp') is-invalid @enderror"
                                id="floatingInput" name="no_hp" placeholder="no_hp"
                                value="{{ old('no_hp', $user->no_hp ?? '-   ') }}" disabled>
                            <label for="floatingInput">Nomor Hp</label>
                            @error('no_hp')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>

                    </div>

                    <div class="col">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control @error('tempat_lahir') is-invalid @enderror"
                                id="floatingInput" name="tempat_lahir" placeholder="tempat_lahir"
                                value="{{ old('tempat_lahir', $user->tempat_lahir ?? '-') }}" disabled>
                            <label for="floatingInput">Tempat Lahir</label>
                            @error('tempat_lahir')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="form-floating mb-3">
                            <input type="date" class="form-control @error('tanggal_lahir') is-invalid @enderror"
                                id="floatingInput" name="tanggal_lahir" placeholder="tanggal_lahir"
                                value="{{ old('tanggal_lahir', $user->tanggal_lahir ?? '-') }}" disabled>
                            <label for="floatingInput">Tanggal Lahir</label>
                            @error('tanggal_lahir')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="form-floating mb-3">
                            <input type="text" class="form-control @error('alamat') is-invalid @enderror"
                                id="floatingInput" name="alamat" placeholder="alamat"
                                value="{{ old('alamat', $user->alamat ?? '-') }}" disabled>
                            <label for="floatingInput">Alamat Sesuai KTP</label>
                            @error('alamat')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>

                        @can('mahasiswa')
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control @error('tahun_ajaran') is-invalid @enderror"
                                    id="floatingInput" name="tahun_ajaran" placeholder="tahun_ajaran"
                                    value="{{ old('tahun_ajaran', $user->tahun_ajaran ?? '-') }}" disabled>
                                <label for="floatingInput">Tahun Ajaran</label>
                                @error('tahun_ajaran')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        @endcan

                        <div class="form-floating mb-3">
                            <input type="text" class="form-control @error('status') is-invalid @enderror"
                                id="floatingInput" name="status" placeholder="status"
                                value="{{ old('status', $user->status) }}" disabled>
                            <label for="floatingInput">Status</label>
                            @error('status')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>

                    </div>

                    <div class="d-flex justify-content-end">
                        <a href="/manajemen/profile/{{ $user->id }}/edit" class="btn btn-sm btn-warning"><i
                                class="bi bi-pencil-square"></i> Edit
                            Profile</a>
                    </div>
                </form>

            </div>
        </div>
        {{-- end form --}}

    </div>
@endsection
