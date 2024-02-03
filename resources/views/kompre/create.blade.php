@extends('layouts.app')

@section('content')
    <div class="row">
        {{-- form --}}
        <div class="col-md-6">
            <div class="bg-light rounded h-100 p-4">
                <h4 class="mb-4">Daftar Seminar Komprehensif</h4>
                <form action="/kompre" method="post">
                    @csrf
                    <div class="form-floating mb-3">
                        <select class="form-select @error('judul_id') is-invalid @enderror" id="floatingSelect"
                            name="judul_id">
                            <option selected value="{{ null }}">Pilih</option>
                            @foreach ($juduls as $judul)
                                <option value="{{ $judul->id }}">{{ $judul->judul }}</option>
                            @endforeach
                        </select>
                        <label for="floatingSelect">Judul</label>
                        @error('judul_id')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary">Simpan</button>
                </form>
            </div>
        </div>
        {{-- end form --}}

        {{-- feature --}}
        <div class="col-md-6 d-flex justify-content-center align-items-center">
            Isi Deskripsi Seminar Proposal
        </div>
        {{-- end feature --}}
    </div>
@endsection
