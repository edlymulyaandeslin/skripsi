@extends('layouts.app')

@section('content')
    <div class="row">
        {{-- form --}}
        <div class="col-md-6">
            <div class="bg-light rounded h-100 p-4">
                <h4 class="mb-4">Update Detail Logbook</h4>
                <form action="/logbook/{{ $logbook->id }}" method="post">
                    @method('patch')
                    @csrf
                    <div class="form-floating mb-3">
                        <select class="form-select @error('judul_id') is-invalid @enderror" id="floatingSelect"
                            name="judul_id">
                            <option selected value="{{ null }}">Pilih</option>
                            @foreach ($juduls as $judul)
                                @if (old('judul_id', $logbook->judul_id) == $judul->id)
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
                            id="floatingTextarea" style="height: 150px;" name="deskripsi">{{ old('deskripsi', $logbook->deskripsi) }}</textarea>
                        <label for="deskripsi">Deskripsi</label>
                        @error('deskripsi')
                            <p class="text-danger pt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="form-floating mb-3">
                        <select class="form-select @error('status') is-invalid @enderror" id="floatingSelect"
                            name="status">
                            <option selected disabled>Pilih</option>
                            @if ($logbook->status == 'diajukan')
                                <option value="diajukan" selected>Diajukan</option>
                                <option value="diterima">Diterima</option>
                                <option value="ditolak">Ditolak</option>
                            @elseif($logbook->status == 'diterima')
                                <option value="diajukan">Diajukan</option>
                                <option value="diterima" selected>Diterima</option>
                                <option value="ditolak">Ditolak</option>
                            @elseif($logbook->status == 'ditolak')
                                <option value="diajukan">Diajukan</option>
                                <option value="diterima">Diterima</option>
                                <option value="ditolak" selected>Ditolak</option>
                            @else
                                <option value="diajukan">Diajukan</option>
                                <option value="diterima">Diterima</option>
                                <option value="ditolak">Ditolak</option>
                            @endif
                        </select>
                        <label for="status">Status</label>
                        @error('status')
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
            Isi Deskripsi logbook dengan benar
        </div>
        {{-- end feature --}}
    </div>
@endsection
