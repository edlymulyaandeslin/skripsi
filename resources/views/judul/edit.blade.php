@extends('layouts.app')

@section('content')
    <div class="row">
        {{-- form --}}
        <div class="col-md-12">
            <div class="bg-light rounded h-100 p-4">
                <h4 class="mb-4">Verifikasi Judul</h6>
                    <form action="/judul/{{ $judul->id }}" method="POST">
                        @method('patch')
                        @csrf
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control @error('judul') is-invalid @enderror" id="floatingInput"
                                placeholder="judul" name="judul" value="{{ old('judul', $judul->judul) }}">
                            <label for="judul">Judul</label>
                            @error('judul')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="form-floating mb-3">
                            <textarea class="form-control @error('latar_belakang') is-invalid @enderror" placeholder="Latar Belakang"
                                id="floatingTextarea" style="height: 150px;" name="latar_belakang" readonly>{{ old('latar_belakang', $judul->latar_belakang) }}</textarea>
                            <label for="latar_belakang">Latar Belakang</label>
                            @error('latar_belakang')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="form-floating mb-3">
                            <select class="form-select @error('pembimbing1_id') is-invalid @enderror" name="pembimbing1_id">
                                <option selected value="{{ null }}">Pilih</option>

                                @foreach ($dosens as $dosen)
                                    @if (old('pembimbing1_id', $judul->pembimbing1_id) == $dosen->id && $judul->pembimbing1_id != null)
                                        @php
                                            $jumlahJudulDosen = 0;
                                        @endphp
                                        @foreach ($alljuduls as $judull)
                                            @if ($judull->pembimbing1_id == $dosen->id || $judull->pembimbing2_id == $dosen->id)
                                                @php
                                                    $jumlahJudulDosen++;
                                                @endphp
                                            @endif
                                        @endforeach
                                        <option value="{{ $dosen->id }}" selected>
                                            {{ $dosen->name }} ({{ $jumlahJudulDosen }})
                                        </option>
                                    @else
                                        @php
                                            $jumlahJudulDosen = 0;
                                        @endphp
                                        @foreach ($alljuduls as $judull)
                                            @if ($judull->pembimbing1_id == $dosen->id || $judull->pembimbing2_id == $dosen->id)
                                                @php
                                                    $jumlahJudulDosen++;
                                                @endphp
                                            @endif
                                        @endforeach
                                        <option value="{{ $dosen->id }}">{{ $dosen->name }} ({{ $jumlahJudulDosen }})
                                        </option>
                                    @endif
                                @endforeach

                            </select>
                            <label for="floatingSelect">Pembimbing 1</label>
                            @error('pembimbing1_id')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="form-floating mb-3">
                            <select class="form-select @error('pembimbing2_id') is-invalid @enderror" name="pembimbing2_id">
                                <option selected value="{{ null }}">Pilih</option>

                                @foreach ($dosens as $dosen)
                                    @if (old('pembimbing2_id', $judul->pembimbing2_id) == $dosen->id && $judul->pembimbing2_id != null)
                                        @php
                                            $jumlahJudulDosen = 0;
                                        @endphp
                                        @foreach ($alljuduls as $judull)
                                            @if ($judull->pembimbing1_id == $dosen->id || $judull->pembimbing2_id == $dosen->id)
                                                @php
                                                    $jumlahJudulDosen++;
                                                @endphp
                                            @endif
                                        @endforeach
                                        <option value="{{ $dosen->id }}" class="d-flex" selected>{{ $dosen->name }}
                                            ({{ $jumlahJudulDosen }})
                                        </option>
                                    @else
                                        @php
                                            $jumlahJudulDosen = 0;
                                        @endphp
                                        @foreach ($alljuduls as $judull)
                                            @if ($judull->pembimbing1_id == $dosen->id || $judull->pembimbing2_id == $dosen->id)
                                                @php
                                                    $jumlahJudulDosen++;
                                                @endphp
                                            @endif
                                        @endforeach
                                        <option value="{{ $dosen->id }}">{{ $dosen->name }} ({{ $jumlahJudulDosen }})
                                        </option>
                                    @endif
                                @endforeach

                            </select>
                            <label for="floatingSelect">Pembimbing 2</label>
                            @error('pembimbing2_id')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="form-floating mb-3">
                            <select class="form-select @error('status') is-invalid @enderror" name="status">
                                <option selected disabled>Pilih</option>
                                @if ($judul->status == 'diajukan')
                                    <option value="diajukan" selected>Diajukan</option>
                                    <option value="diterima">Diterima</option>
                                    <option value="ditolak">Ditolak</option>
                                @elseif($judul->status == 'diterima')
                                    <option value="diajukan">Diajukan</option>
                                    <option value="diterima" selected>Diterima</option>
                                    <option value="ditolak">Ditolak</option>
                                @elseif($judul->status == 'ditolak')
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

                        <button type="submit" class="btn btn-warning">Update</button>
                    </form>

            </div>
        </div>
        {{-- end form --}}

    </div>
@endsection
