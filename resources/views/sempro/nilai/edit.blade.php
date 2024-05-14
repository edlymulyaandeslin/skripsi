@extends('layouts.app')

@section('content')
    <div class="row g-4">
        @if (auth()->user()->id === $sempro->penguji1_id)
            {{-- form nilai penguji 1 --}}
            <div class="col-md-12">
                <div class="bg-light rounded h-100 p-4">
                    <h4 class="mb-4">Nilai Seminar Proposal</h4>
                    <h6>Penguji 1 : {{ $sempro->penguji1->name ?? '' }}</h6>
                    <form
                        action="{{ $sempro->nilaisempro !== null ? route('nilai.sempro.update', $sempro->nilaisempro->id) : route('nilai.sempro.store') }} "
                        method="post">
                        @if ($sempro->nilaisempro !== null)
                            @method('patch')
                        @endif
                        @csrf
                        <div class="form-floating mb-3">
                            <input type="hidden" name="sempro_id" value="{{ $sempro->id }}">
                            <select class="form-select @error('judul_id') is-invalid @enderror" name="judul_id" disabled>
                                <option value="{{ $sempro->judul->id }}" selected>{{ $sempro->judul->judul }}</option>
                            </select>
                            <label>Judul</label>
                            @error('judul_id')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="form-floating mb-3">
                            <input type="number" name="nilai1_peng1" class="form-control"
                                value="{{ old('nilai1_peng1', $sempro->nilaisempro->nilai1_peng1 ?? null) }}">
                            <label>Menjawab Latar Belakang Masalah</label>
                            <small class="fw-bold ms-2">0 - 25</small>
                            @error('nilai1_peng1')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-floating mb-3">
                            <input type="number" name="nilai2_peng1" class="form-control"
                                value="{{ old('nilai2_peng1', $sempro->nilaisempro->nilai2_peng1 ?? null) }}">
                            <label>Menguasai Teori Pendukung TA</label>
                            <small class="fw-bold ms-2">0 - 15</small>
                            @error('nilai2_peng1')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-floating mb-3">
                            <input type="number" name="nilai3_peng1" class="form-control"
                                value="{{ old('nilai3_peng1', $sempro->nilaisempro->nilai3_peng1 ?? null) }}">
                            <label>Menguasai Materi Terkait Tools Pemodelan</label>
                            <small class="fw-bold ms-2">0 - 10</small>
                            @error('nilai3_peng1')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-floating mb-3">
                            <input type="number" name="nilai4_peng1" class="form-control"
                                value="{{ old('nilai4_peng1', $sempro->nilaisempro->nilai4_peng1 ?? null) }}">
                            <label>Pemaparan Cara Menjawab</label>
                            <small class="fw-bold ms-2">0 - 25</small>
                            @error('nilai4_peng1')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-floating mb-3">
                            <input type="number" name="nilai5_peng1" class="form-control"
                                value="{{ old('nilai5_peng1', $sempro->nilaisempro->nilai5_peng1 ?? null) }}">
                            <label>Komunikasi Interpersonal</label>
                            <small class="fw-bold ms-2">0 - 25</small>
                            @error('nilai5_peng1')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label>Apakah tema ini <span class="fw-bold">layak/tidak?</span> Berikan alasan
                                anda</label>
                            <textarea name="notes1" class="form-control" rows="4" placeholder="Write..">{{ old('notes1', $sempro->nilaisempro->notes1 ?? '') }}</textarea>
                            @error('notes1')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary">Input</button>
                    </form>
                </div>
            </div>
            {{-- end form nilai penguji 1 --}}
        @elseif (auth()->user()->id === $sempro->penguji2_id)
            {{-- form nilai penguji 2 --}}
            <div class="col-md-12">
                <div class="bg-light rounded h-100 p-4">
                    <h4 class="mb-4">Nilai Seminar Proposal</h4>
                    <h6>Penguji 2 : {{ $sempro->penguji2->name ?? '' }}</h6>
                    <form
                        action="{{ $sempro->nilaisempro !== null ? route('nilai.sempro.update', $sempro->nilaisempro->id) : route('nilai.sempro.store') }} "
                        method="post">
                        @if ($sempro->nilaisempro !== null)
                            @method('patch')
                        @endif
                        @csrf
                        <div class="form-floating mb-3">
                            <input type="hidden" name="sempro_id" value="{{ $sempro->id }}">
                            <select class="form-select @error('judul_id') is-invalid @enderror" name="judul_id" disabled>
                                <option value="{{ $sempro->judul->id }}" selected>{{ $sempro->judul->judul }}</option>
                            </select>
                            <label>Judul</label>
                            @error('judul_id')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="form-floating mb-3">
                            <input type="number" name="nilai1_peng2" class="form-control"
                                value="{{ old('nilai1_peng2', $sempro->nilaisempro->nilai1_peng2 ?? null) }}">
                            <label>Menjawab Latar Belakang Masalah</label>
                            <small class="fw-bold ms-2">0 - 25</small>
                            @error('nilai1_peng2')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-floating mb-3">
                            <input type="number" name="nilai2_peng2" class="form-control"
                                value="{{ old('nilai2_peng2', $sempro->nilaisempro->nilai2_peng2 ?? null) }}">
                            <label>Menguasai Teori Pendukung TA</label>
                            <small class="fw-bold ms-2">0 - 15</small>
                            @error('nilai2_peng2')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-floating mb-3">
                            <input type="number" name="nilai3_peng2" class="form-control"
                                value="{{ old('nilai3_peng2', $sempro->nilaisempro->nilai3_peng2 ?? null) }}">
                            <label>Menguasai Materi Terkait Tools Pemodelan</label>
                            <small class="fw-bold ms-2">0 - 10</small>
                            @error('nilai3_peng2')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-floating mb-3">
                            <input type="number" name="nilai4_peng2" class="form-control"
                                value="{{ old('nilai4_peng2', $sempro->nilaisempro->nilai4_peng2 ?? null) }}">
                            <label>Pemaparan Cara Menjawab</label>
                            <small class="fw-bold ms-2">0 - 25</small>
                            @error('nilai4_peng2')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-floating mb-3">
                            <input type="number" name="nilai5_peng2" class="form-control"
                                value="{{ old('nilai5_peng2', $sempro->nilaisempro->nilai5_peng2 ?? null) }}">
                            <label>Komunikasi Interpersonal</label>
                            <small class="fw-bold ms-2">0 - 25</small>
                            @error('nilai5_peng2')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label>Apakah tema ini <span class="fw-bold">layak/tidak?</span> Berikan alasan
                                anda</label>
                            <textarea name="notes2" class="form-control" rows="4" placeholder="Write..">{{ old('notes2', $sempro->nilaisempro->notes2 ?? '') }}</textarea>
                            @error('notes2')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary">Input</button>
                    </form>
                </div>
            </div>
            {{-- end form nilai penguji 2 --}}
        @elseif (auth()->user()->id === $sempro->penguji3_id)
            {{-- form nilai penguji 3 --}}
            <div class="col-md-12">
                <div class="bg-light rounded h-100 p-4">
                    <h4 class="mb-4">Nilai Seminar Proposal</h4>
                    <h6>Penguji 3 : {{ $sempro->penguji3->name ?? '' }}</h6>
                    <form
                        action="{{ $sempro->nilaisempro !== null ? route('nilai.sempro.update', $sempro->nilaisempro->id) : route('nilai.sempro.store') }} "
                        method="post">
                        @if ($sempro->nilaisempro !== null)
                            @method('patch')
                        @endif
                        @csrf
                        <div class="form-floating mb-3">
                            <input type="hidden" name="sempro_id" value="{{ $sempro->id }}">
                            <select class="form-select @error('judul_id') is-invalid @enderror" name="judul_id" disabled>
                                <option value="{{ $sempro->judul->id }}" selected>{{ $sempro->judul->judul }}</option>
                            </select>
                            <label>Judul</label>
                            @error('judul_id')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="form-floating mb-3">
                            <input type="number" name="nilai1_peng3" class="form-control"
                                value="{{ old('nilai1_peng3', $sempro->nilaisempro->nilai1_peng3 ?? null) }}">
                            <label>Menjawab Latar Belakang Masalah</label>
                            <small class="fw-bold ms-2">0 - 25</small>
                            @error('nilai1_peng3')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-floating mb-3">
                            <input type="number" name="nilai2_peng3" class="form-control"
                                value="{{ old('nilai2_peng3', $sempro->nilaisempro->nilai2_peng3 ?? null) }}">
                            <label>Menguasai Teori Pendukung TA</label>
                            <small class="fw-bold ms-2">0 - 15</small>
                            @error('nilai2_peng3')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-floating mb-3">
                            <input type="number" name="nilai3_peng3" class="form-control"
                                value="{{ old('nilai3_peng3', $sempro->nilaisempro->nilai3_peng3 ?? null) }}">
                            <label>Menguasai Materi Terkait Tools</label>
                            <small class="fw-bold ms-2">0 - 10</small>
                            @error('nilai3_peng3')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-floating mb-3">
                            <input type="number" name="nilai4_peng3" class="form-control"
                                value="{{ old('nilai4_peng3', $sempro->nilaisempro->nilai4_peng3 ?? null) }}">
                            <label>Pemaparan Cara Menjawab</label>
                            <small class="fw-bold ms-2">0 - 25</small>
                            @error('nilai4_peng3')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-floating mb-3">
                            <input type="number" name="nilai5_peng3" class="form-control"
                                value="{{ old('nilai5_peng3', $sempro->nilaisempro->nilai5_peng3 ?? null) }}">
                            <label>Komunikasi Interpersonal</label>
                            <small class="fw-bold ms-2">0 - 25</small>
                            @error('nilai5_peng3')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label>Apakah tema ini <span class="fw-bold">layak/tidak?</span> Berikan alasan
                                anda</label>
                            <textarea name="notes3" class="form-control" rows="4" placeholder="Write..">{{ old('notes3', $sempro->nilaisempro->notes3 ?? '') }}</textarea>
                            @error('notes3')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary">Input</button>
                    </form>
                </div>
            </div>
            {{-- end form nilai penguji 3 --}}
        @elseif (auth()->user()->id === $sempro->judul->pembimbing1_id)
            {{-- form nilai pembimbing1  --}}
            <div class="col-md-12">
                <div class="bg-light rounded h-100 p-4">
                    <h4 class="mb-4">Nilai Seminar Proposal</h4>
                    <h6>Pembimbing 1 : {{ $sempro->judul->pembimbing1->name ?? '' }}</h6>
                    <form
                        action="{{ $sempro->nilaisempro !== null ? route('nilai.sempro.update', $sempro->nilaisempro->id) : route('nilai.sempro.store') }} "
                        method="post">
                        @if ($sempro->nilaisempro !== null)
                            @method('patch')
                        @endif
                        @csrf
                        <div class="form-floating mb-3">
                            <input type="hidden" name="sempro_id" value="{{ $sempro->id }}">
                            <select class="form-select @error('judul_id') is-invalid @enderror" name="judul_id" disabled>
                                <option value="{{ $sempro->judul->id }}" selected>{{ $sempro->judul->judul }}</option>
                            </select>
                            <label>Judul</label>
                            @error('judul_id')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="form-floating mb-3">
                            <input type="number" name="nilai1_pem1" class="form-control"
                                value="{{ old('nilai1_pem1', $sempro->nilaisempro->nilai1_pem1 ?? null) }}">
                            <label>Kemampuan Memilih Tema</label>
                            <small class="fw-bold ms-2">0 - 15</small>
                            @error('nilai1_pem1')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-floating mb-3">
                            <input type="number" name="nilai2_pem1" class="form-control"
                                value="{{ old('nilai2_pem1', $sempro->nilaisempro->nilai2_pem1 ?? null) }}">
                            <label>Cara menyajikan pertanyaan penelitian/problem statement</label>
                            <small class="fw-bold ms-2">0 - 15</small>
                            @error('nilai2_pem1')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-floating mb-3">
                            <input type="number" name="nilai3_pem1" class="form-control"
                                value="{{ old('nilai3_pem1', $sempro->nilaisempro->nilai3_pem1 ?? null) }}">
                            <label>Problem Solving</label>
                            <small class="fw-bold ms-2">0 - 10</small>
                            @error('nilai3_pem1')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-floating mb-3">
                            <input type="number" name="nilai4_pem1" class="form-control"
                                value="{{ old('nilai4_pem1', $sempro->nilaisempro->nilai4_pem1 ?? null) }}">
                            <label>Pemilihan model atau metode</label>
                            <small class="fw-bold ms-2">0 - 10</small>
                            @error('nilai4_pem1')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-floating mb-3">
                            <input type="number" name="nilai5_pem1" class="form-control"
                                value="{{ old('nilai5_pem1', $sempro->nilaisempro->nilai5_pem1 ?? null) }}">
                            <label>Rencana implementasi simulasi/komputasi</label>
                            <small class="fw-bold ms-2">0 - 10</small>
                            @error('nilai5_pem1')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-floating mb-3">
                            <input type="number" name="nilai6_pem1" class="form-control"
                                value="{{ old('nilai6_pem1', $sempro->nilaisempro->nilai6_pem1 ?? null) }}">
                            <label>Kemandirian dalam penyusunan proposal</label>
                            <small class="fw-bold ms-2">0 - 20</small>
                            @error('nilai6_pem1')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-floating mb-3">
                            <input type="number" name="nilai7_pem1" class="form-control"
                                value="{{ old('nilai7_pem1', $sempro->nilaisempro->nilai7_pem1 ?? null) }}">
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
        @elseif (auth()->user()->id === $sempro->judul->pembimbing2_id)
            {{-- form nilai pembimbing2  --}}
            <div class="col-md-12">
                <div class="bg-light rounded h-100 p-4">
                    <h4 class="mb-4">Nilai Seminar Proposal</h4>
                    <h6>Pembimbing 2 : {{ $sempro->judul->pembimbing2->name ?? '' }}</h6>
                    <form
                        action="{{ $sempro->nilaisempro !== null ? route('nilai.sempro.update', $sempro->nilaisempro->id) : route('nilai.sempro.store') }} "
                        method="post">
                        @if ($sempro->nilaisempro !== null)
                            @method('patch')
                        @endif
                        @csrf
                        <div class="form-floating mb-3">
                            <input type="hidden" name="sempro_id" value="{{ $sempro->id }}">
                            <select class="form-select @error('judul_id') is-invalid @enderror" name="judul_id" disabled>
                                <option value="{{ $sempro->judul->id }}" selected>{{ $sempro->judul->judul }}</option>
                            </select>
                            <label>Judul</label>
                            @error('judul_id')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="form-floating mb-3">
                            <input type="number" name="nilai1_pem2" class="form-control"
                                value="{{ old('nilai1_pem2', $sempro->nilaisempro->nilai1_pem2 ?? null) }}">
                            <label>Kemampuan Memilih Tema</label>
                            <small class="fw-bold ms-2">0 - 15</small>
                            @error('nilai1_pem2')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-floating mb-3">
                            <input type="number" name="nilai2_pem2" class="form-control"
                                value="{{ old('nilai2_pem2', $sempro->nilaisempro->nilai2_pem2 ?? null) }}">
                            <label>Cara menyajikan pertanyaan penelitian/problem statement</label>
                            <small class="fw-bold ms-2">0 - 15</small>
                            @error('nilai2_pem2')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-floating mb-3">
                            <input type="number" name="nilai3_pem2" class="form-control"
                                value="{{ old('nilai3_pem2', $sempro->nilaisempro->nilai3_pem2 ?? null) }}">
                            <label>Problem Solving</label>
                            <small class="fw-bold ms-2">0 - 10</small>
                            @error('nilai3_pem2')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-floating mb-3">
                            <input type="number" name="nilai4_pem2" class="form-control"
                                value="{{ old('nilai4_pem2', $sempro->nilaisempro->nilai4_pem2 ?? null) }}">
                            <label>Pemilihan model atau metode</label>
                            <small class="fw-bold ms-2">0 - 10</small>
                            @error('nilai4_pem2')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-floating mb-3">
                            <input type="number" name="nilai5_pem2" class="form-control"
                                value="{{ old('nilai5_pem2', $sempro->nilaisempro->nilai5_pem2 ?? null) }}">
                            <label>Rencana implementasi simulasi/komputasi</label>
                            <small class="fw-bold ms-2">0 - 10</small>
                            @error('nilai5_pem2')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-floating mb-3">
                            <input type="number" name="nilai6_pem2" class="form-control"
                                value="{{ old('nilai6_pem2', $sempro->nilaisempro->nilai6_pem2 ?? null) }}">
                            <label>Kemandirian dalam penyusunan proposal</label>
                            <small class="fw-bold ms-2">0 - 20</small>
                            @error('nilai6_pem2')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-floating mb-3">
                            <input type="number" name="nilai7_pem2" class="form-control"
                                value="{{ old('nilai7_pem2', $sempro->nilaisempro->nilai7_pem2 ?? null) }}">
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
        @else
            <div class="col-md-12">
                <div class="bg-light rounded h-100 p-4 fst-italic fw-bolder">
                    Anda hanya dapat memberikan nilai kepada mahasiswa yang dibimbing atau diuji
                </div>
            </div>
        @endif

    </div>
@endsection
