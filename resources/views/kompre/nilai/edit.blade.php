@extends('layouts.app')

@section('content')
    <div class="row">
        {{-- form --}}
        <div class="col-md-4">
            <div class="bg-light rounded h-100 p-4">
                <h4 class="mb-4">Nilai Seminar Komprehensif</h4>
                <h6>Penguji 1 : {{ $kompre->penguji1->name }}</h6>
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
                        <input type="number" name="nilai1" class="form-control"
                            value="{{ old('nilai1', $kompre->nilaikompre->nilai1 ?? null) }}">
                        <label>Nilai 1</label>
                        <small class="fw-bold ms-2">0 - 25</small>
                        @error('nilai1')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-floating mb-3">
                        <input type="number" name="nilai2" class="form-control"
                            value="{{ old('nilai2', $kompre->nilaikompre->nilai2 ?? null) }}">
                        <label>Nilai 2</label>
                        <small class="fw-bold ms-2">0 - 15</small>
                        @error('nilai2')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-floating mb-3">
                        <input type="number" name="nilai3" class="form-control"
                            value="{{ old('nilai3', $kompre->nilaikompre->nilai3 ?? null) }}">
                        <label>Nilai 3</label>
                        <small class="fw-bold ms-2">0 - 10</small>
                        @error('nilai3')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-floating mb-3">
                        <input type="number" name="nilai4" class="form-control"
                            value="{{ old('nilai4', $kompre->nilaikompre->nilai4 ?? null) }}">
                        <label>Nilai 4</label>
                        <small class="fw-bold ms-2">0 - 25</small>
                        @error('nilai4')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-floating mb-3">
                        <input type="number" name="nilai5" class="form-control"
                            value="{{ old('nilai5', $kompre->nilaikompre->nilai5 ?? null) }}">
                        <label>Nilai 5</label>
                        <small class="fw-bold ms-2">0 - 25</small>
                        @error('nilai5')
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
        {{-- end form --}}

        {{-- form --}}
        <div class="col-md-4">
            <div class="bg-light rounded h-100 p-4">
                <h4 class="mb-4">Nilai Seminar Komprehensif</h4>
                <h6>Penguji 2 : {{ $kompre->penguji2->name }}</h6>
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
                        <input type="number" name="nilai6" class="form-control"
                            value="{{ old('nilai6', $kompre->nilaikompre->nilai6 ?? null) }}">
                        <label>Nilai 6</label>
                        <small class="fw-bold ms-2">0 - 25</small>
                        @error('nilai6')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-floating mb-3">
                        <input type="number" name="nilai7" class="form-control"
                            value="{{ old('nilai7', $kompre->nilaikompre->nilai7 ?? null) }}">
                        <label>Nilai 7</label>
                        <small class="fw-bold ms-2">0 - 15</small>
                        @error('nilai7')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-floating mb-3">
                        <input type="number" name="nilai8" class="form-control"
                            value="{{ old('nilai8', $kompre->nilaikompre->nilai8 ?? null) }}">
                        <label>Nilai 8</label>
                        <small class="fw-bold ms-2">0 - 10</small>
                        @error('nilai8')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-floating mb-3">
                        <input type="number" name="nilai9" class="form-control"
                            value="{{ old('nilai9', $kompre->nilaikompre->nilai9 ?? null) }}">
                        <label>Nilai 9</label>
                        <small class="fw-bold ms-2">0 - 25</small>
                        @error('nilai9')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-floating mb-3">
                        <input type="number" name="nilai10" class="form-control"
                            value="{{ old('nilai10', $kompre->nilaikompre->nilai10 ?? null) }}">
                        <label>Nilai 10</label>
                        <small class="fw-bold ms-2">0 - 25</small>
                        @error('nilai10')
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
        {{-- end form --}}

        <div class="col-md-4">
            <div class="bg-light rounded h-100 p-4">
                <h4 class="mb-4">Nilai Seminar Komprehensif</h4>
                <h6>Penguji 3 : {{ $kompre->penguji3->name }}</h6>
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
                        <input type="number" name="nilai11" class="form-control"
                            value="{{ old('nilai11', $kompre->nilaikompre->nilai11 ?? null) }}">
                        <label>Nilai 11</label>
                        <small class="fw-bold ms-2">0 - 25</small>
                        @error('nilai11')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-floating mb-3">
                        <input type="number" name="nilai12" class="form-control"
                            value="{{ old('nilai12', $kompre->nilaikompre->nilai12 ?? null) }}">
                        <label>Nilai 12</label>
                        <small class="fw-bold ms-2">0 - 15</small>
                        @error('nilai12')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-floating mb-3">
                        <input type="number" name="nilai13" class="form-control"
                            value="{{ old('nilai13', $kompre->nilaikompre->nilai13 ?? null) }}">
                        <label>Nilai 13</label>
                        <small class="fw-bold ms-2">0 - 10</small>
                        @error('nilai13')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-floating mb-3">
                        <input type="number" name="nilai14" class="form-control"
                            value="{{ old('nilai14', $kompre->nilaikompre->nilai14 ?? null) }}">
                        <label>Nilai 14</label>
                        <small class="fw-bold ms-2">0 - 25</small>
                        @error('nilai14')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-floating mb-3">
                        <input type="number" name="nilai15" class="form-control"
                            value="{{ old('nilai15', $kompre->nilaikompre->nilai15 ?? null) }}">
                        <label>Nilai 15</label>
                        <small class="fw-bold ms-2">0 - 25</small>
                        @error('nilai15')
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

    </div>
@endsection
