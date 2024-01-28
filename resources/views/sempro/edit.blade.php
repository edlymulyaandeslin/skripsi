@extends('layouts.app')

@section('content')
    <div class="row">
        {{-- form --}}
        <div class="col-md-6">
            <div class="bg-light rounded h-100 p-4">
                <h4 class="mb-4">Update Seminar Proposal</h4>
                <form action="/sempro/{{ $sempro->id }}" method="post">
                    @method('patch')
                    @csrf
                    <div class="form-floating mb-3">
                        <input type="hidden" name="judul_id" value="{{ $sempro->judul->id }}">
                        <select class="form-select @error('judul_id') is-invalid @enderror" id="floatingSelect"
                            name="judul_id" disabled>
                            <option value="{{ $sempro->judul->id }}" selected>{{ $sempro->judul->judul }}</option>

                        </select>
                        <label for="floatingSelect">Judul</label>
                        @error('judul_id')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="form-floating mb-3">
                        <input type="date" name="tanggal_seminar" class="form-control"
                            value="{{ $sempro->tanggal_seminar }}">
                        <label for="floatingSelect">Tanggal Seminar</label>
                        @error('tanggal_seminar')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="form-floating mb-3">
                        <input type="time" name="jam" class="form-control" value="{{ $sempro->jam }}">
                        <label for="floatingSelect">Jam</label>
                        @error('jam')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="form-floating mb-3">
                        <input type="text" name="ruang" class="form-control" value="{{ $sempro->ruang }}">
                        <label for="floatingSelect">Ruang</label>
                        @error('ruang')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="form-floating mb-3">
                        <select class="form-select @error('team_penguji_id') is-invalid @enderror" id="floatingSelect"
                            name="team_penguji_id">
                            <option value="{{ null }}" selected>Pilih</option>
                            @foreach ($teampenguji as $team)
                                @if (old('team_penguji_id', $sempro->team_penguji_id) === $team->id)
                                    <option value="{{ $team->id }}" selected>{{ $team->name }}</option>
                                @else
                                    <option value="{{ $team->id }}">{{ $team->name }}</option>
                                @endif
                            @endforeach
                        </select>
                        <label for="floatingSelect">Team Penguji</label>
                        @error('team_penguji_id')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="form-floating mb-3">
                        <select class="form-select @error('status') is-invalid @enderror" id="floatingSelect"
                            name="status">
                            <option selected disabled>Pilih</option>
                            @if ($sempro->status == 'diajukan')
                                <option value="diajukan" selected>Diajukan</option>
                                <option value="diterima">Diterima</option>
                                <option value="ditolak">Ditolak</option>
                            @elseif($sempro->status == 'diterima')
                                <option value="diajukan">Diajukan</option>
                                <option value="diterima" selected>Diterima</option>
                                <option value="ditolak">Ditolak</option>
                            @elseif($sempro->status == 'ditolak')
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
            Isi Deskripsi Seminar Proposal
        </div>
        {{-- end feature --}}
    </div>
@endsection
