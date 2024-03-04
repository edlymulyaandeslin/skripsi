@extends('layouts.app')

@section('content')
    <div class="row">
        {{-- form --}}
        <div class="col-md-12">
            <div class="bg-light rounded h-100 p-4">
                <h4 class="mb-4">Update Seminar Proposal</h4>
                <form action="/sempro/{{ $sempro->id }}" method="post">
                    @method('patch')
                    @csrf
                    <div class="form-floating mb-3">
                        <input type="hidden" name="judul_id" value="{{ $sempro->judul->id }}">
                        <select class="form-select @error('judul_id') is-invalid @enderror" name="judul_id" disabled>
                            <option value="{{ $sempro->judul->id }}" selected>{{ $sempro->judul->judul }}</option>

                        </select>
                        <label for="">Judul</label>
                        @error('judul_id')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="form-floating mb-3">
                        <input type="date" name="tanggal_seminar" class="form-control"
                            value="{{ $sempro->tanggal_seminar }}">
                        <label for="#">Tanggal Seminar</label>
                        @error('tanggal_seminar')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="form-floating mb-3">
                        <input type="time" name="jam" class="form-control" value="{{ $sempro->jam }}">
                        <label for="#">Jam</label>
                        @error('jam')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="form-floating mb-3">
                        <input type="text" name="ruang" class="form-control" value="{{ $sempro->ruang }}">
                        <label for="#">Ruang</label>
                        @error('ruang')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="form-floating mb-3">
                        <select class="form-select @error('penguji1_id') is-invalid @enderror" name="penguji1_id">
                            <option selected value="{{ null }}">Pilih</option>
                            @foreach ($dosens as $dosen)
                                @if (old('penguji1_id', $sempro->penguji1_id) == $dosen->id)
                                    @php
                                        $jumlahPengujiSempro = 0;
                                    @endphp
                                    @foreach ($allsempro as $sempro)
                                        @if ($sempro->penguji1_id == $dosen->id || $sempro->penguji2_id == $dosen->id || $sempro->penguji3_id == $dosen->id)
                                            @php
                                                $jumlahPengujiSempro++;
                                            @endphp
                                        @endif
                                    @endforeach
                                    <option value="{{ $dosen->id }}" selected>{{ $dosen->name }}
                                        ({{ $jumlahPengujiSempro }})
                                    </option>
                                @elseif($sempro->judul->pembimbing1_id == $dosen->id)
                                    <option style="background-color: #7f8fa6" class="text-white"
                                        value="{{ $dosen->id }}" disabled>
                                        {{ $dosen->name }} (pembimbing 1)
                                    </option>
                                @elseif($sempro->judul->pembimbing2_id == $dosen->id)
                                    <option style="background-color: #7f8fa6" class="text-white"
                                        value="{{ $dosen->id }}" disabled>
                                        {{ $dosen->name }} (pembimbing 2)
                                    </option>
                                @else
                                    @php
                                        $jumlahPengujiSempro = 0;
                                    @endphp
                                    @foreach ($allsempro as $sempro)
                                        @if ($sempro->penguji1_id == $dosen->id || $sempro->penguji2_id == $dosen->id || $sempro->penguji3_id == $dosen->id)
                                            @php
                                                $jumlahPengujiSempro++;
                                            @endphp
                                        @endif
                                    @endforeach
                                    <option value="{{ $dosen->id }}">{{ $dosen->name }} ({{ $jumlahPengujiSempro }})
                                    </option>
                                @endif
                            @endforeach
                        </select>
                        <label for="">Penguji 1</label>
                        @error('penguji1_id')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="form-floating mb-3">
                        <select class="form-select @error('penguji2_id') is-invalid @enderror" name="penguji2_id">
                            <option selected value="{{ null }}">Pilih</option>
                            @foreach ($dosens as $dosen)
                                @if (old('penguji2_id', $sempro->penguji2_id) == $dosen->id)
                                    @php
                                        $jumlahPengujiSempro = 0;
                                    @endphp
                                    @foreach ($allsempro as $sempro)
                                        @if ($sempro->penguji1_id == $dosen->id || $sempro->penguji2_id == $dosen->id || $sempro->penguji3_id == $dosen->id)
                                            @php
                                                $jumlahPengujiSempro++;
                                            @endphp
                                        @endif
                                    @endforeach
                                    <option value="{{ $dosen->id }}" selected>{{ $dosen->name }}
                                        ({{ $jumlahPengujiSempro }})
                                    </option>
                                @elseif($sempro->judul->pembimbing1_id == $dosen->id)
                                    <option style="background-color: #7f8fa6" class="text-white"
                                        value="{{ $dosen->id }}" disabled>
                                        {{ $dosen->name }} (pembimbing 1)
                                    </option>
                                @elseif($sempro->judul->pembimbing2_id == $dosen->id)
                                    <option style="background-color: #7f8fa6" class="text-white"
                                        value="{{ $dosen->id }}" disabled>
                                        {{ $dosen->name }} (pembimbing 2)
                                    </option>
                                @else
                                    @php
                                        $jumlahPengujiSempro = 0;
                                    @endphp
                                    @foreach ($allsempro as $sempro)
                                        @if ($sempro->penguji1_id == $dosen->id || $sempro->penguji2_id == $dosen->id || $sempro->penguji3_id == $dosen->id)
                                            @php
                                                $jumlahPengujiSempro++;
                                            @endphp
                                        @endif
                                    @endforeach
                                    <option value="{{ $dosen->id }}">{{ $dosen->name }} ({{ $jumlahPengujiSempro }})
                                    </option>
                                @endif
                            @endforeach
                        </select>
                        <label for="">Penguji 2</label>
                        @error('penguji2_id')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="form-floating mb-3">
                        <select class="form-select @error('penguji3_id') is-invalid @enderror" name="penguji3_id">
                            <option selected value="{{ null }}">Pilih</option>
                            @foreach ($dosens as $dosen)
                                @if (old('penguji3_id', $sempro->penguji3_id) == $dosen->id)
                                    @php
                                        $jumlahPengujiSempro = 0;
                                    @endphp
                                    @foreach ($allsempro as $sempro)
                                        @if ($sempro->penguji1_id == $dosen->id || $sempro->penguji2_id == $dosen->id || $sempro->penguji3_id == $dosen->id)
                                            @php
                                                $jumlahPengujiSempro++;
                                            @endphp
                                        @endif
                                    @endforeach
                                    <option value="{{ $dosen->id }}" selected>{{ $dosen->name }}
                                        ({{ $jumlahPengujiSempro }})
                                    </option>
                                @elseif($sempro->judul->pembimbing1_id == $dosen->id)
                                    <option style="background-color: #7f8fa6" class="text-white"
                                        value="{{ $dosen->id }}" disabled>
                                        {{ $dosen->name }} (pembimbing 1)
                                    </option>
                                @elseif($sempro->judul->pembimbing2_id == $dosen->id)
                                    <option style="background-color: #7f8fa6" class="text-white"
                                        value="{{ $dosen->id }}" disabled>
                                        {{ $dosen->name }} (pembimbing 2)
                                    </option>
                                @else
                                    @php
                                        $jumlahPengujiSempro = 0;
                                    @endphp
                                    @foreach ($allsempro as $sempro)
                                        @if ($sempro->penguji1_id == $dosen->id || $sempro->penguji2_id == $dosen->id || $sempro->penguji3_id == $dosen->id)
                                            @php
                                                $jumlahPengujiSempro++;
                                            @endphp
                                        @endif
                                    @endforeach
                                    <option value="{{ $dosen->id }}">{{ $dosen->name }} ({{ $jumlahPengujiSempro }})
                                    </option>
                                @endif
                            @endforeach
                        </select>
                        <label for="">Penguji 3</label>
                        @error('penguji3_id')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="form-floating mb-3">
                        <select class="form-select @error('status') is-invalid @enderror" name="status" id="status">
                            <option selected disabled>Pilih</option>
                            @if ($sempro->status == 'diajukan')
                                <option value="diajukan" selected>Diajukan</option>
                                <option value="diterima">Diterima</option>
                                <option value="lulus">Lulus</option>
                                <option value="tidak lulus">Tidak Lulus</option>
                                <option value="perbaikan">Perbaikan</option>
                            @elseif($sempro->status == 'diterima')
                                <option value="diajukan">Diajukan</option>
                                <option value="diterima" selected>Diterima</option>
                                <option value="lulus">Lulus</option>
                                <option value="tidak lulus">Tidak Lulus</option>
                                <option value="perbaikan">Perbaikan</option>
                            @elseif($sempro->status == 'lulus')
                                <option value="diajukan">Diajukan</option>
                                <option value="diterima">Diterima</option>
                                <option value="lulus" selected>Lulus</option>
                                <option value="tidak lulus">Tidak Lulus</option>
                                <option value="perbaikan">Perbaikan</option>
                            @elseif($sempro->status == 'tidak lulus')
                                <option value="diajukan">Diajukan</option>
                                <option value="diterima">Diterima</option>
                                <option value="lulus">Lulus</option>
                                <option value="tidak lulus" selected>Tidak Lulus</option>
                                <option value="perbaikan">Perbaikan</option>
                            @elseif($sempro->status == 'perbaikan')
                                <option value="diajukan">Diajukan</option>
                                <option value="diterima">Diterima</option>
                                <option value="lulus">Lulus</option>
                                <option value="tidak lulus">Tidak Lulus</option>
                                <option value="perbaikan" selected>Perbaikan</option>
                            @else
                                <option value="diajukan">Diajukan</option>
                                <option value="diterima">Diterima</option>
                                <option value="lulus">Lulus</option>
                                <option value="tidak lulus">Tidak Lulus</option>
                                <option value="perbaikan">Perbaikan</option>
                            @endif
                        </select>
                        <label for="status">Status</label>
                        @error('status')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="form-floating mb-3 d-none" id="notes">
                        <textarea class="form-control @error('notes') is-invalid @enderror" placeholder="Catatan" style="height: 150px;"
                            name="notes">{{ old('notes', $sempro->notes) }}</textarea>
                        <label for="notes">Catatan</label>
                        @error('notes')
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

@section('script')
    <script>
        $(document).ready(function() {
            $('#status').change(function() {
                var selectedStatus = $(this).val();
                if (selectedStatus === 'perbaikan') {
                    $('#notes').removeClass('d-none');
                } else {
                    $('#notes').addClass('d-none');
                }
            });

            // Untuk memastikan status saat halaman dimuat
            var initialStatus = $('#status').val();
            if (initialStatus === 'perbaikan') {
                $('#notes').removeClass('d-none');
            }
        });
    </script>
@endsection
