@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="bg-light rounded h-100 p-4">
                <h4 class="mb-4">Isi Data Dosen</h4>
                <form action="/manajemen/dosen" method="post" class="row">
                    @csrf
                    <div class="col">
                        <div class="form-floating mb-3">
                            <input type="number" class="form-control @error('nim_or_nidn') is-invalid @enderror"
                                id="floatingInput" name="nim_or_nidn" placeholder="NIDN" value="{{ old('nim_or_nidn') }}">
                            <label for="floatingInput">NIDN</label>
                            @error('nim_or_nidn')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control @error('name') is-invalid @enderror"
                                id="floatingInput" name="name" placeholder="Name" value="{{ old('name') }}">
                            <label for="floatingInput">Nama</label>
                            @error('name')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="col">
                        <div class="form-floating">
                            <input type="password" class="form-control @error('password') is-invalid @enderror"
                                placeholder="Password" name="password">
                            <label for="floatingPassword">Password</label>
                            @error('password')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="d-flex justify-content-end">
                        <button class="btn btn-primary" type="submit">Simpan</button>
                    </div>
                </form>

            </div>
        </div>
        {{-- end form --}}

    </div>
@endsection
