@extends('layouts.app')

@section('content')
    <div class="row g-4">

        {{-- form nilai penguji 1 --}}
        <div class="col-md-12">
            <div class="bg-light rounded h-100 p-4">
                <h4 class="mb-4">Nilai Seminar Komprehensif</h4>
                <h6>Penguji 1 : {{ $kompre->penguji1->name ?? '' }}</h6>
                <form
                    action="{{ $kompre->nilaikompre !== null ? route('nilai.kompre.update', $kompre->nilaikompre->id) : route('nilai.kompre.store') }} "
                    method="post">
                    @if ($kompre->nilaikompre !== null)
                        @method('patch')
                    @endif
                    @csrf
                    <div class="form-floating mb-3">
                        <input type="hidden" name="kompre_id" value="{{ $kompre->id }}">
                        <select class="form-select @error('judul_id') is-invalid @enderror" name="judul_id" disabled>
                            <option value="{{ $kompre->judul->id }}" selected>{{ $kompre->judul->judul }}</option>
                        </select>
                        <label>Judul</label>
                        @error('judul_id')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="form-floating mb-3">
                        <input type="number" name="nilai1_peng1" class="form-control"
                            value="{{ old('nilai1_peng1', $kompre->nilaikompre->nilai1_peng1 ?? null) }}">
                        <label>Menjawab Latar Belakang Masalah</label>
                        <small class="fw-bold ms-2">0 - 25</small>
                        @error('nilai1_peng1')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-floating mb-3">
                        <input type="number" name="nilai2_peng1" class="form-control"
                            value="{{ old('nilai2_peng1', $kompre->nilaikompre->nilai2_peng1 ?? null) }}">
                        <label>Menguasai Teori Pendukung TA</label>
                        <small class="fw-bold ms-2">0 - 15</small>
                        @error('nilai2_peng1')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-floating mb-3">
                        <input type="number" name="nilai3_peng1" class="form-control"
                            value="{{ old('nilai3_peng1', $kompre->nilaikompre->nilai3_peng1 ?? null) }}">
                        <label>Menguasai Materi Terkait Tools Pemodelan</label>
                        <small class="fw-bold ms-2">0 - 10</small>
                        @error('nilai3_peng1')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-floating mb-3">
                        <input type="number" name="nilai4_peng1" class="form-control"
                            value="{{ old('nilai4_peng1', $kompre->nilaikompre->nilai4_peng1 ?? null) }}">
                        <label>Pemaparan Cara Menjawab</label>
                        <small class="fw-bold ms-2">0 - 25</small>
                        @error('nilai4_peng1')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-floating mb-3">
                        <input type="number" name="nilai5_peng1" class="form-control"
                            value="{{ old('nilai5_peng1', $kompre->nilaikompre->nilai5_peng1 ?? null) }}">
                        <label>Komunikasi Interpersonal</label>
                        <small class="fw-bold ms-2">0 - 25</small>
                        @error('nilai5_peng1')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label>Catatan</label>
                        <textarea name="notes1" class="form-control" rows="4" placeholder="Write..">{{ old('notes1', $kompre->nilaikompre->notes1 ?? '') }}</textarea>
                        @error('notes1')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary">Input</button>
                </form>
            </div>
        </div>
        {{-- end form nilai penguji 1 --}}

        {{-- form nilai penguji 2 --}}
        <div class="col-md-12">
            <div class="bg-light rounded h-100 p-4">
                <h4 class="mb-4">Nilai Seminar Komprehensif</h4>
                <h6>Penguji 2 : {{ $kompre->penguji2->name ?? '' }}</h6>
                <form
                    action="{{ $kompre->nilaikompre !== null ? route('nilai.kompre.update', $kompre->nilaikompre->id) : route('nilai.kompre.store') }} "
                    method="post">
                    @if ($kompre->nilaikompre !== null)
                        @method('patch')
                    @endif
                    @csrf
                    <div class="form-floating mb-3">
                        <input type="hidden" name="kompre_id" value="{{ $kompre->id }}">
                        <select class="form-select @error('judul_id') is-invalid @enderror" name="judul_id" disabled>
                            <option value="{{ $kompre->judul->id }}" selected>{{ $kompre->judul->judul }}</option>
                        </select>
                        <label>Judul</label>
                        @error('judul_id')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="form-floating mb-3">
                        <input type="number" name="nilai1_peng2" class="form-control"
                            value="{{ old('nilai1_peng2', $kompre->nilaikompre->nilai1_peng2 ?? null) }}">
                        <label>Menjawab Latar Belakang Masalah</label>
                        <small class="fw-bold ms-2">0 - 25</small>
                        @error('nilai1_peng2')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-floating mb-3">
                        <input type="number" name="nilai2_peng2" class="form-control"
                            value="{{ old('nilai2_peng2', $kompre->nilaikompre->nilai2_peng2 ?? null) }}">
                        <label>Menguasai Teori Pendukung TA</label>
                        <small class="fw-bold ms-2">0 - 15</small>
                        @error('nilai2_peng2')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-floating mb-3">
                        <input type="number" name="nilai3_peng2" class="form-control"
                            value="{{ old('nilai3_peng2', $kompre->nilaikompre->nilai3_peng2 ?? null) }}">
                        <label>Menguasai Materi Terkait Tools Pemodelan</label>
                        <small class="fw-bold ms-2">0 - 10</small>
                        @error('nilai3_peng2')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-floating mb-3">
                        <input type="number" name="nilai4_peng2" class="form-control"
                            value="{{ old('nilai4_peng2', $kompre->nilaikompre->nilai4_peng2 ?? null) }}">
                        <label>Pemaparan Cara Menjawab</label>
                        <small class="fw-bold ms-2">0 - 25</small>
                        @error('nilai4_peng2')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-floating mb-3">
                        <input type="number" name="nilai5_peng2" class="form-control"
                            value="{{ old('nilai5_peng2', $kompre->nilaikompre->nilai5_peng2 ?? null) }}">
                        <label>Komunikasi Interpersonal</label>
                        <small class="fw-bold ms-2">0 - 25</small>
                        @error('nilai5_peng2')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label>Catatan</label>
                        <textarea name="notes2" class="form-control" rows="4" placeholder="Write..">{{ old('notes2', $kompre->nilaikompre->notes2 ?? '') }}</textarea>
                        @error('notes2')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary">Input</button>
                </form>
            </div>
        </div>
        {{-- end form nilai penguji 2 --}}

        {{-- form nilai penguji 3 --}}
        <div class="col-md-12">
            <div class="bg-light rounded h-100 p-4">
                <h4 class="mb-4">Nilai Seminar Komprehensif</h4>
                <h6>Penguji 3 : {{ $kompre->penguji3->name ?? '' }}</h6>
                <form
                    action="{{ $kompre->nilaikompre !== null ? route('nilai.kompre.update', $kompre->nilaikompre->id) : route('nilai.kompre.store') }} "
                    method="post">
                    @if ($kompre->nilaikompre !== null)
                        @method('patch')
                    @endif
                    @csrf
                    <div class="form-floating mb-3">
                        <input type="hidden" name="kompre_id" value="{{ $kompre->id }}">
                        <select class="form-select @error('judul_id') is-invalid @enderror" name="judul_id" disabled>
                            <option value="{{ $kompre->judul->id }}" selected>{{ $kompre->judul->judul }}</option>
                        </select>
                        <label>Judul</label>
                        @error('judul_id')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="form-floating mb-3">
                        <input type="number" name="nilai1_peng3" class="form-control"
                            value="{{ old('nilai1_peng3', $kompre->nilaikompre->nilai1_peng3 ?? null) }}">
                        <label>Menjawab Latar Belakang Masalah</label>
                        <small class="fw-bold ms-2">0 - 25</small>
                        @error('nilai1_peng3')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-floating mb-3">
                        <input type="number" name="nilai2_peng3" class="form-control"
                            value="{{ old('nilai2_peng3', $kompre->nilaikompre->nilai2_peng3 ?? null) }}">
                        <label>Menguasai Teori Pendukung TA</label>
                        <small class="fw-bold ms-2">0 - 15</small>
                        @error('nilai2_peng3')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-floating mb-3">
                        <input type="number" name="nilai3_peng3" class="form-control"
                            value="{{ old('nilai3_peng3', $kompre->nilaikompre->nilai3_peng3 ?? null) }}">
                        <label>Menguasai Materi Terkait Tools</label>
                        <small class="fw-bold ms-2">0 - 10</small>
                        @error('nilai3_peng3')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-floating mb-3">
                        <input type="number" name="nilai4_peng3" class="form-control"
                            value="{{ old('nilai4_peng3', $kompre->nilaikompre->nilai4_peng3 ?? null) }}">
                        <label>Pemaparan Cara Menjawab</label>
                        <small class="fw-bold ms-2">0 - 25</small>
                        @error('nilai4_peng3')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-floating mb-3">
                        <input type="number" name="nilai5_peng3" class="form-control"
                            value="{{ old('nilai5_peng3', $kompre->nilaikompre->nilai5_peng3 ?? null) }}">
                        <label>Komunikasi Interpersonal</label>
                        <small class="fw-bold ms-2">0 - 25</small>
                        @error('nilai5_peng3')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label>Catatan</label>
                        <textarea name="notes3" class="form-control" rows="4" placeholder="Write..">{{ old('notes3', $kompre->nilaikompre->notes3 ?? '') }}</textarea>
                        @error('notes3')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary">Input</button>
                </form>
            </div>
        </div>
        {{-- end form nilai penguji 3 --}}

        {{-- form nilai pembimbing1  --}}
        <div class="col-md-12">
            <div class="bg-light rounded h-100 p-4">
                <h4 class="mb-4">Nilai Seminar Komprehensif</h4>
                <h6>Pembimbing 1 : {{ $kompre->judul->pembimbing1->name ?? '' }}</h6>
                <form
                    action="{{ $kompre->nilaikompre !== null ? route('nilai.kompre.update', $kompre->nilaikompre->id) : route('nilai.kompre.store') }} "
                    method="post">
                    @if ($kompre->nilaikompre !== null)
                        @method('patch')
                    @endif
                    @csrf
                    <div class="form-floating mb-3">
                        <input type="hidden" name="kompre_id" value="{{ $kompre->id }}">
                        <select class="form-select @error('judul_id') is-invalid @enderror" name="judul_id" disabled>
                            <option value="{{ $kompre->judul->id }}" selected>{{ $kompre->judul->judul }}</option>
                        </select>
                        <label>Judul</label>
                        @error('judul_id')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="form-floating mb-3">
                        <input type="number" name="nilai1_pem1" class="form-control"
                            value="{{ old('nilai1_pem1', $kompre->nilaikompre->nilai1_pem1 ?? null) }}">
                        <label>Kemampuan Memilih Tema</label>
                        <small class="fw-bold ms-2">0 - 15</small>
                        @error('nilai1_pem1')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-floating mb-3">
                        <input type="number" name="nilai2_pem1" class="form-control"
                            value="{{ old('nilai2_pem1', $kompre->nilaikompre->nilai2_pem1 ?? null) }}">
                        <label>Cara menyajikan pertanyaan penelitian/problem statement</label>
                        <small class="fw-bold ms-2">0 - 15</small>
                        @error('nilai2_pem1')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-floating mb-3">
                        <input type="number" name="nilai3_pem1" class="form-control"
                            value="{{ old('nilai3_pem1', $kompre->nilaikompre->nilai3_pem1 ?? null) }}">
                        <label>Problem Solving</label>
                        <small class="fw-bold ms-2">0 - 10</small>
                        @error('nilai3_pem1')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-floating mb-3">
                        <input type="number" name="nilai4_pem1" class="form-control"
                            value="{{ old('nilai4_pem1', $kompre->nilaikompre->nilai4_pem1 ?? null) }}">
                        <label>Pemilihan model atau metode</label>
                        <small class="fw-bold ms-2">0 - 10</small>
                        @error('nilai4_pem1')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-floating mb-3">
                        <input type="number" name="nilai5_pem1" class="form-control"
                            value="{{ old('nilai5_pem1', $kompre->nilaikompre->nilai5_pem1 ?? null) }}">
                        <label>Rencana implementasi simulasi/komputasi</label>
                        <small class="fw-bold ms-2">0 - 10</small>
                        @error('nilai5_pem1')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-floating mb-3">
                        <input type="number" name="nilai6_pem1" class="form-control"
                            value="{{ old('nilai6_pem1', $kompre->nilaikompre->nilai6_pem1 ?? null) }}">
                        <label>Kemandirian dalam penyusunal Komprehensif</label>
                        <small class="fw-bold ms-2">0 - 20</small>
                        @error('nilai6_pem1')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-floating mb-3">
                        <input type="number" name="nilai7_pem1" class="form-control"
                            value="{{ old('nilai7_pem1', $kompre->nilaikompre->nilai7_pem1 ?? null) }}">
                        <label>Proses bimbingan</label>
                        <small class="fw-bold ms-2">0 - 20</small>
                        @error('nilai7_pem1')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary">Input</button>
                </form>
            </div>
        </div>
        {{-- end form nilai  pembimbing1  --}}

        {{-- form nilai pembimbing2  --}}
        <div class="col-md-12">
            <div class="bg-light rounded h-100 p-4">
                <h4 class="mb-4">Nilai Seminar Komprehensif</h4>
                <h6>Pembimbing 2 : {{ $kompre->judul->pembimbing2->name ?? '' }}</h6>
                <form
                    action="{{ $kompre->nilaikompre !== null ? route('nilai.kompre.update', $kompre->nilaikompre->id) : route('nilai.kompre.store') }} "
                    method="post">
                    @if ($kompre->nilaikompre !== null)
                        @method('patch')
                    @endif
                    @csrf
                    <div class="form-floating mb-3">
                        <input type="hidden" name="kompre_id" value="{{ $kompre->id }}">
                        <select class="form-select @error('judul_id') is-invalid @enderror" name="judul_id" disabled>
                            <option value="{{ $kompre->judul->id }}" selected>{{ $kompre->judul->judul }}</option>
                        </select>
                        <label>Judul</label>
                        @error('judul_id')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="form-floating mb-3">
                        <input type="number" name="nilai1_pem2" class="form-control"
                            value="{{ old('nilai1_pem2', $kompre->nilaikompre->nilai1_pem2 ?? null) }}">
                        <label>Kemampuan Memilih Tema</label>
                        <small class="fw-bold ms-2">0 - 15</small>
                        @error('nilai1_pem2')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-floating mb-3">
                        <input type="number" name="nilai2_pem2" class="form-control"
                            value="{{ old('nilai2_pem2', $kompre->nilaikompre->nilai2_pem2 ?? null) }}">
                        <label>Cara menyajikan pertanyaan penelitian/problem statement</label>
                        <small class="fw-bold ms-2">0 - 15</small>
                        @error('nilai2_pem2')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-floating mb-3">
                        <input type="number" name="nilai3_pem2" class="form-control"
                            value="{{ old('nilai3_pem2', $kompre->nilaikompre->nilai3_pem2 ?? null) }}">
                        <label>Problem Solving</label>
                        <small class="fw-bold ms-2">0 - 10</small>
                        @error('nilai3_pem2')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-floating mb-3">
                        <input type="number" name="nilai4_pem2" class="form-control"
                            value="{{ old('nilai4_pem2', $kompre->nilaikompre->nilai4_pem2 ?? null) }}">
                        <label>Pemilihan model atau metode</label>
                        <small class="fw-bold ms-2">0 - 10</small>
                        @error('nilai4_pem2')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-floating mb-3">
                        <input type="number" name="nilai5_pem2" class="form-control"
                            value="{{ old('nilai5_pem2', $kompre->nilaikompre->nilai5_pem2 ?? null) }}">
                        <label>Rencana implementasi simulasi/komputasi</label>
                        <small class="fw-bold ms-2">0 - 10</small>
                        @error('nilai5_pem2')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-floating mb-3">
                        <input type="number" name="nilai6_pem2" class="form-control"
                            value="{{ old('nilai6_pem2', $kompre->nilaikompre->nilai6_pem2 ?? null) }}">
                        <label>Kemandirian dalam penyusunal Komprehensif</label>
                        <small class="fw-bold ms-2">0 - 20</small>
                        @error('nilai6_pem2')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-floating mb-3">
                        <input type="number" name="nilai7_pem2" class="form-control"
                            value="{{ old('nilai7_pem2', $kompre->nilaikompre->nilai7_pem2 ?? null) }}">
                        <label>Proses bimbingan</label>
                        <small class="fw-bold ms-2">0 - 20</small>
                        @error('nilai7_pem2')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary">Input</button>
                </form>
            </div>
        </div>
        {{-- end form nilai  pembimbing2  --}}

    </div>
@endsection
