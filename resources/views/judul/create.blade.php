@extends('layouts.app')

@section('content')
    <div class="row">
        {{-- form --}}
        <div class="col-md-12">
            <div class="bg-light rounded h-100 p-4">
                <h4 class="mb-4">Isi Detail Judul</h4>
                <form action="/judul" method="post">
                    @csrf
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control @error('judul') is-invalid @enderror" id="floatingInput"
                            placeholder="judul" name="judul" value="{{ old('judul') }}">
                        <label for="judul">Judul</label>
                        @error('judul')
                            <p class="text-danger pt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="form-floating mb-3">
                        <textarea class="form-control @error('latar_belakang') is-invalid @enderror" placeholder="Latar Belakang"
                            id="floatingTextarea" style="height: 150px;" name="latar_belakang">{{ old('latar_belakang') }}</textarea>
                        <label for="latar_belakang">Latar Belakang</label>
                        @error('latar_belakang')
                            <p class="text-danger pt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary">Simpan</button>
                </form>
            </div>
        </div>
        {{-- end form --}}

    </div>
@endsection
