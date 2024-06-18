@extends('layouts.app')

@section('content')
    <div class="row">
        {{-- form --}}
        <div class="col-md-12">
            <div class="bg-light rounded h-100 p-4">
                <h4 class="mb-4">Verifikasi Bimbingan</h4>
                <form action="{{ route('logbook.update', $logbook->id) }}" method="post">
                    @method('patch')
                    @csrf
                    <div class="form-floating mb-3">
                        <select class="form-select @error('judul_id') is-invalid @enderror" id="floatingSelect" name="judul_id"
                            disabled>
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
                        <select class="form-select @error('kategori') is-invalid @enderror" id="floatingSelect"
                            name="kategori" disabled>
                            <option selected disabled>Pilih</option>
                            @if (old('kategori', $logbook->kategori) == 'proposal')
                                <option value="proposal" selected>Proposal</option>
                                <option value="komprehensif">Komprehensif</option>
                            @elseif(old('kategori', $logbook->kategori) == 'komprehensif')
                                <option value="proposal">Proposal</option>
                                <option value="komprehensif" selected>Komprehensif</option>
                            @else
                                <option value="proposal">Proposal</option>
                                <option value="komprehensif">Komprehensif</option>
                            @endif
                        </select>
                        <label for="kategori">Kategori</label>
                        @error('kategori')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="form-floating mb-3">
                        <textarea class="form-control @error('target_bimbingan') is-invalid @enderror" placeholder="Latar Belakang"
                            id="floatingTextarea" style="height: 150px;" name="target_bimbingan" readonly>{{ old('target_bimbingan', $logbook->target_bimbingan) }}</textarea>
                        <label for="target_bimbingan">Target Bimbingan</label>
                        @error('target_bimbingan')
                            <p class="text-danger pt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="form-floating mb-3">
                        <textarea class="form-control @error('hasil') is-invalid @enderror" placeholder="hasil" id="floatingTextarea"
                            style="height: 150px;" name="hasil">{{ old('hasil', $logbook->hasil) }}</textarea>
                        <label for="hasil">Hasil Bimbingan</label>
                        @error('hasil')
                            <p class="text-danger pt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="form-floating mb-3">
                        <select class="form-select @error('status') is-invalid @enderror" id="floatingSelect"
                            name="status">
                            <option selected disabled>Pilih</option>
                            @if ($logbook->kategori == 'komprehensif')
                                @if ($logbook->status == 'diajukan')
                                    <option value="diajukan" selected>Diajukan</option>
                                    <option value="acc komprehensif">Acc Komprehensif</option>
                                    <option value="diterima">Diterima</option>
                                    <option value="ditolak">Ditolak</option>
                                @elseif($logbook->status == 'acc komprehensif')
                                    <option value="diajukan">Diajukan</option>
                                    <option value="acc komprehensif" selected>Acc Komprehensif</option>
                                    <option value="diterima">Diterima</option>
                                    <option value="ditolak">Ditolak</option>
                                @elseif($logbook->status == 'diterima')
                                    <option value="diajukan">Diajukan</option>
                                    <option value="acc komprehensif">Acc Komprehensif</option>
                                    <option value="diterima" selected>Diterima</option>
                                    <option value="ditolak">Ditolak</option>
                                @elseif($logbook->status == 'ditolak')
                                    <option value="diajukan">Diajukan</option>
                                    <option value="acc komprehensif">Acc Komprehensif</option>
                                    <option value="diterima">Diterima</option>
                                    <option value="ditolak" selected>Ditolak</option>
                                @else
                                    <option value="diajukan">Diajukan</option>
                                    <option value="acc komprehensif">Acc Komprehensif</option>
                                    <option value="diterima">Diterima</option>
                                    <option value="ditolak">Ditolak</option>
                                @endif
                            @elseif ($logbook->kategori == 'proposal')
                                @if ($logbook->status == 'diajukan')
                                    <option value="diajukan" selected>Diajukan</option>
                                    <option value="acc proposal">Acc Proposal</option>
                                    <option value="diterima">Diterima</option>
                                    <option value="ditolak">Ditolak</option>
                                @elseif($logbook->status == 'acc proposal')
                                    <option value="diajukan">Diajukan</option>
                                    <option value="acc proposal" selected>Acc Proposal</option>
                                    <option value="diterima">Diterima</option>
                                    <option value="ditolak">Ditolak</option>
                                @elseif($logbook->status == 'diterima')
                                    <option value="diajukan">Diajukan</option>
                                    <option value="acc proposal">Acc Proposal</option>
                                    <option value="diterima" selected>Diterima</option>
                                    <option value="ditolak">Ditolak</option>
                                @elseif($logbook->status == 'ditolak')
                                    <option value="diajukan">Diajukan</option>
                                    <option value="acc proposal">Acc Proposal</option>
                                    <option value="diterima">Diterima</option>
                                    <option value="ditolak" selected>Ditolak</option>
                                @else
                                    <option value="diajukan">Diajukan</option>
                                    <option value="acc proposal">Acc Proposal</option>
                                    <option value="diterima">Diterima</option>
                                    <option value="ditolak">Ditolak</option>
                                @endif
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

    </div>
@endsection
