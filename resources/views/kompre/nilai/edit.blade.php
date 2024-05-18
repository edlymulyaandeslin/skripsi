@extends('layouts.app')

@section('content')
    <div class="row g-4">
        @if (auth()->user()->id === $kompre->penguji1_id)
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
                                value="{{ old('nilai1_peng1', $kompre->nilaikompre->nilai1_peng1 ?? null) }}" required>
                            <label>Penguasaan Penelitian</label>
                            <small class="fw-bold ms-2">10 - 100 (x{{ $bobots->bobot1 }})</small>
                            @error('nilai1_peng1')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-floating mb-3">
                            <input type="number" name="nilai2_peng1" class="form-control"
                                value="{{ old('nilai2_peng1', $kompre->nilaikompre->nilai2_peng1 ?? null) }}" required>
                            <label>Segi Ilmiah Tulisan</label>
                            <small class="fw-bold ms-2">10 - 100 (x{{ $bobots->bobot2 }})</small>
                            @error('nilai2_peng1')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-floating mb-3">
                            <input type="number" name="nilai3_peng1" class="form-control"
                                value="{{ old('nilai3_peng1', $kompre->nilaikompre->nilai3_peng1 ?? null) }}" required>
                            <label>Kemampuan Penyajian</label>
                            <small class="fw-bold ms-2">10 - 100 (x{{ $bobots->bobot3 }})</small>
                            @error('nilai3_peng1')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-floating mb-3">
                            <input type="number" name="nilai4_peng1" class="form-control"
                                value="{{ old('nilai4_peng1', $kompre->nilaikompre->nilai4_peng1 ?? null) }}" required>
                            <label>Kemampuan Berdiskusi</label>
                            <small class="fw-bold ms-2">10 - 100 (x{{ $bobots->bobot4 }})</small>
                            @error('nilai4_peng1')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary">Input</button>
                    </form>
                </div>
            </div>
            {{-- end form nilai penguji 1 --}}
        @elseif (auth()->user()->id === $kompre->penguji2_id)
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
                                value="{{ old('nilai1_peng2', $kompre->nilaikompre->nilai1_peng2 ?? null) }}" required>
                            <label>Penguasaan Penelitian</label>
                            <small class="fw-bold ms-2">10 - 100 (x{{ $bobots->bobot1 }})</small>
                            @error('nilai1_peng2')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-floating mb-3">
                            <input type="number" name="nilai2_peng2" class="form-control"
                                value="{{ old('nilai2_peng2', $kompre->nilaikompre->nilai2_peng2 ?? null) }}" required>
                            <label>Segi Ilmiah Tulisan</label>
                            <small class="fw-bold ms-2">10 - 100 (x{{ $bobots->bobot2 }})</small>
                            @error('nilai2_peng2')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-floating mb-3">
                            <input type="number" name="nilai3_peng2" class="form-control"
                                value="{{ old('nilai3_peng2', $kompre->nilaikompre->nilai3_peng2 ?? null) }}" required>
                            <label>Kemampuan Penyajian</label>
                            <small class="fw-bold ms-2">10 - 100 (x{{ $bobots->bobot3 }})</small>
                            @error('nilai3_peng2')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-floating mb-3">
                            <input type="number" name="nilai4_peng2" class="form-control"
                                value="{{ old('nilai4_peng2', $kompre->nilaikompre->nilai4_peng2 ?? null) }}" required>
                            <label>Kemampuan Berdiskusi</label>
                            <small class="fw-bold ms-2">10 - 100 (x{{ $bobots->bobot4 }})</small>
                            @error('nilai4_peng2')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary">Input</button>
                    </form>
                </div>
            </div>
            {{-- end form nilai penguji 2 --}}
        @elseif (auth()->user()->id === $kompre->penguji3_id)
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
                                value="{{ old('nilai1_peng3', $kompre->nilaikompre->nilai1_peng3 ?? null) }}" required>
                            <label>Penguasaan Penelitian</label>
                            <small class="fw-bold ms-2">10 - 100 (x{{ $bobots->bobot1 }})</small>
                            @error('nilai1_peng3')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-floating mb-3">
                            <input type="number" name="nilai2_peng3" class="form-control"
                                value="{{ old('nilai2_peng3', $kompre->nilaikompre->nilai2_peng3 ?? null) }}" required>
                            <label>Segi Ilmiah Tulisan</label>
                            <small class="fw-bold ms-2">10 - 100 (x{{ $bobots->bobot2 }})</small>
                            @error('nilai2_peng3')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-floating mb-3">
                            <input type="number" name="nilai3_peng3" class="form-control"
                                value="{{ old('nilai3_peng3', $kompre->nilaikompre->nilai3_peng3 ?? null) }}" required>
                            <label>Kemampuan Penyajian</label>
                            <small class="fw-bold ms-2">10 - 100 (x{{ $bobots->bobot3 }})</small>
                            @error('nilai3_peng3')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-floating mb-3">
                            <input type="number" name="nilai4_peng3" class="form-control"
                                value="{{ old('nilai4_peng3', $kompre->nilaikompre->nilai4_peng3 ?? null) }}" required>
                            <label>Kemampuan Berdiskusi</label>
                            <small class="fw-bold ms-2">10 - 100 (x{{ $bobots->bobot4 }})</small>
                            @error('nilai4_peng3')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary">Input</button>
                    </form>
                </div>
            </div>
            {{-- end form nilai penguji 3 --}}
        @elseif (auth()->user()->id === $kompre->judul->pembimbing1_id)
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
                                value="{{ old('nilai1_pem1', $kompre->nilaikompre->nilai1_pem1 ?? null) }}" required>
                            <label>Penguasaan Penelitian</label>
                            <small class="fw-bold ms-2">10 - 100 (x{{ $bobots->bobot1 }})</small>
                            @error('nilai1_pem1')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="form-floating mb-3">
                            <input type="number" name="nilai2_pem1" class="form-control"
                                value="{{ old('nilai2_pem1', $kompre->nilaikompre->nilai2_pem1 ?? null) }}" required>
                            <label>Segi Ilmiah Tulisan</label>
                            <small class="fw-bold ms-2">10 - 100 (x{{ $bobots->bobot2 }})</small>
                            @error('nilai2_pem1')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="form-floating mb-3">
                            <input type="number" name="nilai3_pem1" class="form-control"
                                value="{{ old('nilai3_pem1', $kompre->nilaikompre->nilai3_pem1 ?? null) }}" required>
                            <label>Kemampuan Penyajian</label>
                            <small class="fw-bold ms-2">10 - 100 (x{{ $bobots->bobot3 }})</small>
                            @error('nilai3_pem1')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="form-floating mb-3">
                            <input type="number" name="nilai4_pem1" class="form-control"
                                value="{{ old('nilai4_pem1', $kompre->nilaikompre->nilai4_pem1 ?? null) }}" required>
                            <label>Kemampuan Berdiskusi</label>
                            <small class="fw-bold ms-2">10 - 100 (x{{ $bobots->bobot4 }})</small>
                            @error('nilai4_pem1')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary">Input</button>
                    </form>
                </div>
            </div>
            {{-- end form nilai  pembimbing1  --}}
        @elseif (auth()->user()->id === $kompre->judul->pembimbing2_id)
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
                                value="{{ old('nilai1_pem2', $kompre->nilaikompre->nilai1_pem2 ?? null) }}" required>
                            <label>Penguasaan Penelitian</label>
                            <small class="fw-bold ms-2">10 - 100 (x{{ $bobots->bobot1 }})</small>
                            @error('nilai1_pem2')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="form-floating mb-3">
                            <input type="number" name="nilai2_pem2" class="form-control"
                                value="{{ old('nilai2_pem2', $kompre->nilaikompre->nilai2_pem2 ?? null) }}" required>
                            <label>Segi Ilmiah Tulisan</label>
                            <small class="fw-bold ms-2">10 - 100 (x{{ $bobots->bobot2 }})</small>
                            @error('nilai2_pem2')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="form-floating mb-3">
                            <input type="number" name="nilai3_pem2" class="form-control"
                                value="{{ old('nilai3_pem2', $kompre->nilaikompre->nilai3_pem2 ?? null) }}" required>
                            <label>Kemampuan Penyajian</label>
                            <small class="fw-bold ms-2">10 - 100 (x{{ $bobots->bobot3 }})</small>
                            @error('nilai3_pem2')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="form-floating mb-3">
                            <input type="number" name="nilai4_pem2" class="form-control"
                                value="{{ old('nilai4_pem2', $kompre->nilaikompre->nilai4_pem2 ?? null) }}" required>
                            <label>Kemampuan Berdiskusi</label>
                            <small class="fw-bold ms-2">10 - 100 (x{{ $bobots->bobot4 }})</small>
                            @error('nilai4_pem2')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary">Input</button>
                    </form>
                </div>
            </div>
            {{-- end form nilai pembimbing2 --}}
        @else
            <div class="col-md-12">
                <div class="alert alert-warning" role="alert">
                    <h4 class="alert-heading">Warning!</h4>
                    <p>Kamu SIAPA?
                    </p>
                    <hr>
                </div>
            </div>
        @endif
    </div>
@endsection
