@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="bg-light rounded h-100 p-4">

                <form action="/manajemen/profile/{{ $user->id }}" method="post" enctype="multipart/form-data"
                    class="row">
                    @method('patch')
                    @csrf
                    <div class="col-md-4">
                        <h4 class="mb-4">Update Profile</h4>
                        <div class="d-flex flex-column align-items-center gap-4">
                            @if ($user->foto_profil)
                                <img src="{{ asset('storage/' . $user->foto_profil) }}" id="preview-foto"
                                    style="width: 200px; height: 250px;" class="img-fluid rounded-1" alt="404">
                            @else
                                <img src="https://ui-avatars.com/api/?name={{ auth()->user()->name }}&background=3498db&color=ecf0f1"
                                    style="width: 200px; height: 250px;" id="preview-foto" class="img-fluid rounded-1"
                                    alt="404">
                            @endif
                            {{-- foto lama --}}
                            <input type="hidden" name="oldProfil" value="{{ $user->foto_profil }}">

                            {{-- foto baru --}}
                            <input id="input-foto" type="file" name="foto_profil" class="form-control d-none" />
                            <label for="input-foto" class="btn btn-outline-dark">
                                Ubah Foto
                            </label>
                            @error('foto_profil')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-8 row mb-3">
                        <h4 class="pb-2 mb-3 border-bottom text-secondary">Biodata Diri</h4>
                        <div class="col-md-12 row">
                            <div class="col-md-6">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control @error('name') is-invalid @enderror"
                                        name="name" placeholder="Name" value="{{ old('name', $user->name) }}">
                                    <label for="floatingInput">Nama</label>
                                    @error('name')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>

                                @cannot('admin')
                                    <div class="form-floating mb-3">
                                        <input type="number" class="form-control @error('nim_or_nidn') is-invalid @enderror"
                                            name="nim_or_nidn" placeholder="NIM"
                                            value="{{ old('nim_or_nidn', $user->nim_or_nidn) }}" disabled>
                                        <label for="floatingInput">NIM</label>
                                        @error('nim_or_nidn')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                @endcannot

                                @can('admin')
                                    <div class="form-floating mb-3">
                                        <input type="number" class="form-control @error('nim_or_nidn') is-invalid @enderror"
                                            name="nim_or_nidn" placeholder="NIM"
                                            value="{{ old('nim_or_nidn', $user->nim_or_nidn) }}">
                                        <label for="floatingInput">{{ auth()->user()->role_id !== 4 ? 'NIDN' : 'NIM' }}</label>
                                        @error('nim_or_nidn')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                @endcan

                                <div class="mb-4">
                                    <p class="my-0">Jenis Kelamin</p>
                                    @if ($user->jenis_kelamin === 'laki-laki')
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="jenis_kelamin"
                                                value="laki-laki" checked>
                                            <label class="form-check-label" for="laki-laki">
                                                Laki Laki
                                            </label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="jenis_kelamin"
                                                value="perempuan">
                                            <label class="form-check-label" for="perempuan">
                                                Perempuan
                                            </label>
                                        </div>
                                    @elseif ($user->jenis_kelamin === 'perempuan')
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="jenis_kelamin"
                                                value="laki-laki">
                                            <label class="form-check-label" for="laki-laki">
                                                Laki Laki
                                            </label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="jenis_kelamin"
                                                value="perempuan" checked>
                                            <label class="form-check-label" for="perempuan">
                                                Perempuan
                                            </label>
                                        </div>
                                    @else
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="jenis_kelamin"
                                                value="laki-laki">
                                            <label class="form-check-label" for="laki-laki">
                                                Laki Laki
                                            </label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="jenis_kelamin"
                                                value="perempuan">
                                            <label class="form-check-label" for="perempuan">
                                                Perempuan
                                            </label>
                                        </div>
                                    @endif

                                </div>

                                <div class="form-floating mb-3">
                                    <input type="email" class="form-control @error('email') is-invalid @enderror"
                                        name="email" placeholder="email"
                                        value="{{ old('email', $user->email ?? ' ') }}">
                                    <label for="floatingInput">email</label>
                                    @error('email')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="form-floating">
                                    <input type="text" class="form-control @error('no_hp') is-invalid @enderror"
                                        name="no_hp" placeholder="no_hp"
                                        value="{{ old('no_hp', $user->no_hp ?? ' ') }}">
                                    <label for="floatingInput">Nomor Hp (+62)</label>
                                    @error('no_hp')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>

                            </div>

                            <div class="col-md-6">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control @error('tempat_lahir') is-invalid @enderror"
                                        name="tempat_lahir" placeholder="tempat_lahir"
                                        value="{{ old('tempat_lahir', $user->tempat_lahir ?? ' ') }}">
                                    <label for="floatingInput">Tempat Lahir</label>
                                    @error('tempat_lahir')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="form-floating mb-3">
                                    <input type="date"
                                        class="form-control @error('tanggal_lahir') is-invalid @enderror"
                                        name="tanggal_lahir" placeholder="tanggal_lahir"
                                        value="{{ old('tanggal_lahir', $user->tanggal_lahir ?? ' ') }}">
                                    <label for="floatingInput">Tanggal Lahir</label>
                                    @error('tanggal_lahir')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control @error('alamat') is-invalid @enderror"
                                        name="alamat" placeholder="alamat"
                                        value="{{ old('alamat', $user->alamat ?? ' ') }}">
                                    <label for="floatingInput">Alamat Sesuai KTP</label>
                                    @error('alamat')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>

                                @can('mahasiswa')
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control @error('tahun_ajaran') is-invalid @enderror"
                                            name="tahun_ajaran" placeholder="tahun_ajaran"
                                            value="{{ old('tahun_ajaran', $user->tahun_ajaran ?? \Carbon\Carbon::now()->format('Y') - 1 . '/' . \Carbon\Carbon::now()->format('Y')) }}">
                                        <label for="floatingInput">Tahun Ajaran</label>
                                        @error('tahun_ajaran')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                @endcan

                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control @error('status') is-invalid @enderror"
                                        name="status" placeholder="status" value="{{ old('status', $user->status) }}"
                                        disabled>
                                    <label for="floatingInput">Status</label>
                                    @error('status')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>

                            </div>
                        </div>
                        <h4 class="pb-2 my-3 border-bottom text-secondary">Ubah Password</h4>
                        <div class="col-md-12 row">
                            <div class="col">

                                <div class="form-floating">
                                    <input type="password" class="form-control @error('password') is-invalid @enderror"
                                        placeholder="Password" name="password">
                                    <label for="floatingPassword">New Password</label>
                                    @error('password')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>

                            </div>

                        </div>

                    </div>

                    <div class="d-flex justify-content-end gap-2">
                        <a href="/manajemen/profile/{{ $user->id }}" class="btn btn-sm btn-danger">Cancel</a>
                        <button type="submit" class="btn btn-sm btn-primary">
                            Simpan</button>
                    </div>
                </form>

            </div>
        </div>
        {{-- end form --}}

    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            $('#input-foto').change(function() {
                previewImage(this);
            });

            function previewImage(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();

                    reader.onload = function(e) {
                        $('#preview-foto')
                            .attr('src', e.target.result)
                            .show();
                    };

                    reader.readAsDataURL(input.files[0]);
                }
            }
        });
    </script>
@endsection
