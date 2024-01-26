@extends('layouts.app')

@section('content')
    <div class="row">
        {{-- form --}}
        <div class="col-md-6">
            <div class="bg-light rounded h-100 p-4">
                <h4 class="mb-4">Detail Logbook</h4>
                <form action="/logbook" method="post">
                    @csrf
                    <div class="form-floating mb-3">
                        <select class="form-select @error('judul_id') is-invalid @enderror" id="floatingSelect"
                            name="judul_id">
                            <option selected value="{{ null }}">Pilih</option>
                            @foreach ($juduls as $judul)
                                @if (old('judul_id') == $judul->id)
                                    <option value="{{ $judul->id }}" selected>{{ $judul->judul }}</option>
                                @else
                                    <option value="{{ $judul->id }}">{{ $judul->judul }}</option>
                                @endif
                            @endforeach
                        </select>
                        <label for="floatingSelect">Judul</label>
                        @error('judul_id')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="form-floating mb-3">
                        <textarea class="form-control @error('deskripsi') is-invalid @enderror" placeholder="Latar Belakang"
                            id="floatingTextarea" style="height: 150px;" name="deskripsi">{{ old('deskripsi') }}</textarea>
                        <label for="deskripsi">Deskripsi</label>
                        @error('deskripsi')
                            <p class="text-danger pt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary">Simpan</button>
                </form>
            </div>
        </div>
        {{-- end form --}}

        {{-- feature --}}
        <div class="col-md-6 d-flex justify-content-center align-items-center">
            Isi Deskripsi logbook dengan benar
        </div>
        {{-- end feature --}}
    </div>
@endsection
