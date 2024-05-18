@extends('layouts.app')

@section('content')
    <div class="row">
        {{-- form --}}
        <div class="col-md-12">
            <div class="bg-light rounded h-100 p-4">
                <h4 class="mb-4">Update Seminar Komprehensif</h4>
                <form action="/kompre/{{ $kompre->id }}" method="post">
                    @method('patch')
                    @csrf
                    <div class="form-floating mb-3">
                        <input type="hidden" name="judul_id" value="{{ $kompre->judul->id }}">
                        <select class="form-select @error('judul_id') is-invalid @enderror" name="judul_id" disabled>
                            <option value="{{ $kompre->judul->id }}" selected>{{ $kompre->judul->judul }}</option>

                        </select>
                        <label for="">Judul</label>
                        @error('judul_id')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="form-floating mb-3">
                        <input type="date" name="tanggal_seminar" class="form-control"
                            value="{{ $kompre->tanggal_seminar }}">
                        <label for="#">Tanggal Seminar</label>
                        @error('tanggal_seminar')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="form-floating mb-3">
                        <input type="time" name="jam" class="form-control" value="{{ $kompre->jam }}">
                        <label for="#">Jam</label>
                        @error('jam')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="form-floating mb-3">
                        <input type="text" name="ruang" class="form-control" value="{{ $kompre->ruang }}">
                        <label for="#">Ruang</label>
                        @error('ruang')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="form-floating mb-3">
                        <select class="form-select @error('penguji1_id') is-invalid @enderror" name="penguji1_id">
                            <option selected value="{{ null }}">Pilih</option>
                            @foreach ($dosens as $dosen)
                                @if (old('penguji1_id', $kompre->penguji1_id) == $dosen->id)
                                    @php
                                        $jumlahPengujiKompre = 0;
                                    @endphp
                                    @foreach ($allkompre as $kompree)
                                        @if ($kompree->penguji1_id == $dosen->id || $kompree->penguji2_id == $dosen->id || $kompree->penguji3_id == $dosen->id)
                                            @php
                                                $jumlahPengujiKompre++;
                                            @endphp
                                        @endif
                                    @endforeach
                                    <option value="{{ $dosen->id }}" selected>{{ $dosen->name }}
                                        ({{ $jumlahPengujiKompre }})
                                    </option>
                                @elseif($kompre->judul->pembimbing1_id == $dosen->id)
                                    <option style="background-color: #7f8fa6" class="text-white"
                                        value="{{ $dosen->id }}" disabled>
                                        {{ $dosen->name }} (pembimbing 1)
                                    </option>
                                @elseif($kompre->judul->pembimbing2_id == $dosen->id)
                                    <option style="background-color: #7f8fa6" class="text-white"
                                        value="{{ $dosen->id }}" disabled>
                                        {{ $dosen->name }} (pembimbing 2)
                                    </option>
                                @else
                                    @php
                                        $jumlahPengujiKompre = 0;
                                    @endphp
                                    @foreach ($allkompre as $kompree)
                                        @if ($kompree->penguji1_id == $dosen->id || $kompree->penguji2_id == $dosen->id || $kompree->penguji3_id == $dosen->id)
                                            @php
                                                $jumlahPengujiKompre++;
                                            @endphp
                                        @endif
                                    @endforeach
                                    <option value="{{ $dosen->id }}">{{ $dosen->name }} ({{ $jumlahPengujiKompre }})
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
                                @if (old('penguji2_id', $kompre->penguji2_id) == $dosen->id)
                                    @php
                                        $jumlahPengujiKompre = 0;
                                    @endphp
                                    @foreach ($allkompre as $kompree)
                                        @if ($kompree->penguji1_id == $dosen->id || $kompree->penguji2_id == $dosen->id || $kompree->penguji3_id == $dosen->id)
                                            @php
                                                $jumlahPengujiKompre++;
                                            @endphp
                                        @endif
                                    @endforeach
                                    <option value="{{ $dosen->id }}" selected>{{ $dosen->name }}
                                        ({{ $jumlahPengujiKompre }})
                                    </option>
                                @elseif($kompre->judul->pembimbing1_id == $dosen->id)
                                    <option style="background-color: #7f8fa6" class="text-white"
                                        value="{{ $dosen->id }}" disabled>
                                        {{ $dosen->name }} (pembimbing 1)
                                    </option>
                                @elseif($kompre->judul->pembimbing2_id == $dosen->id)
                                    <option style="background-color: #7f8fa6" class="text-white"
                                        value="{{ $dosen->id }}" disabled>
                                        {{ $dosen->name }} (pembimbing 2)
                                    </option>
                                @else
                                    @php
                                        $jumlahPengujiKompre = 0;
                                    @endphp
                                    @foreach ($allkompre as $kompree)
                                        @if ($kompree->penguji1_id == $dosen->id || $kompree->penguji2_id == $dosen->id || $kompree->penguji3_id == $dosen->id)
                                            @php
                                                $jumlahPengujiKompre++;
                                            @endphp
                                        @endif
                                    @endforeach
                                    <option value="{{ $dosen->id }}">{{ $dosen->name }} ({{ $jumlahPengujiKompre }})
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
                                @if (old('penguji3_id', $kompre->penguji3_id) == $dosen->id)
                                    @php
                                        $jumlahPengujiKompre = 0;
                                    @endphp
                                    @foreach ($allkompre as $kompree)
                                        @if ($kompree->penguji1_id == $dosen->id || $kompree->penguji2_id == $dosen->id || $kompree->penguji3_id == $dosen->id)
                                            @php
                                                $jumlahPengujiKompre++;
                                            @endphp
                                        @endif
                                    @endforeach
                                    <option value="{{ $dosen->id }}" selected>{{ $dosen->name }}
                                        ({{ $jumlahPengujiKompre }})
                                    </option>
                                @elseif($kompre->judul->pembimbing1_id == $dosen->id)
                                    <option style="background-color: #7f8fa6" class="text-white"
                                        value="{{ $dosen->id }}" disabled>
                                        {{ $dosen->name }} (pembimbing 1)
                                    </option>
                                @elseif($kompre->judul->pembimbing2_id == $dosen->id)
                                    <option style="background-color: #7f8fa6" class="text-white"
                                        value="{{ $dosen->id }}" disabled>
                                        {{ $dosen->name }} (pembimbing 2)
                                    </option>
                                @else
                                    @php
                                        $jumlahPengujiKompre = 0;
                                    @endphp
                                    @foreach ($allkompre as $kompree)
                                        @if ($kompree->penguji1_id == $dosen->id || $kompree->penguji2_id == $dosen->id || $kompree->penguji3_id == $dosen->id)
                                            @php
                                                $jumlahPengujiKompre++;
                                            @endphp
                                        @endif
                                    @endforeach
                                    <option value="{{ $dosen->id }}">{{ $dosen->name }} ({{ $jumlahPengujiKompre }})
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
                            @if ($kompre->status == 'diajukan')
                                <option value="diajukan" selected>Diajukan</option>
                                <option value="diterima">Diterima</option>
                                <option value="lulus">Lulus</option>
                                <option value="tidak lulus">Tidak Lulus</option>
                                <option value="perbaikan">Perbaikan</option>
                            @elseif($kompre->status == 'diterima')
                                <option value="diajukan">Diajukan</option>
                                <option value="diterima" selected>Diterima</option>
                                <option value="lulus">Lulus</option>
                                <option value="tidak lulus">Tidak Lulus</option>
                                <option value="perbaikan">Perbaikan</option>
                            @elseif($kompre->status == 'lulus')
                                <option value="diajukan">Diajukan</option>
                                <option value="diterima">Diterima</option>
                                <option value="lulus" selected>Lulus</option>
                                <option value="tidak lulus">Tidak Lulus</option>
                                <option value="perbaikan">Perbaikan</option>
                            @elseif($kompre->status == 'tidak lulus')
                                <option value="diajukan">Diajukan</option>
                                <option value="diterima">Diterima</option>
                                <option value="lulus">Lulus</option>
                                <option value="tidak lulus" selected>Tidak Lulus</option>
                                <option value="perbaikan">Perbaikan</option>
                            @elseif($kompre->status == 'perbaikan')
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
                            name="notes">{{ old('notes', $kompre->notes) }}</textarea>
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
