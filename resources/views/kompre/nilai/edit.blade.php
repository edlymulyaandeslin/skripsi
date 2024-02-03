@extends('layouts.app')

@section('content')
    <div class="row">
        {{-- form --}}
        <div class="col-md-6">
            <div class="bg-light rounded h-100 p-4">
                <h4 class="mb-4">Input Nilai Seminar Komprehensif</h4>
                <form
                    action="{{ $kompre->nilaikompre !== null ? route('nilai.kompre.update', $kompre->nilaikompre->id) : route('nilai.kompre.store') }} "
                    method="post">
                    @if ($kompre->nilaikompre !== null)
                        @method('patch')
                    @endif
                    @csrf
                    <div class="form-floating mb-3">
                        <input type="hidden" name="kompre_id" value="{{ $kompre->id }}">
                        <select class="form-select @error('judul_id') is-invalid @enderror" id="floatingSelect"
                            name="judul_id" disabled>
                            <option value="{{ $kompre->judul->id }}" selected>{{ $kompre->judul->judul }}</option>
                        </select>
                        <label for="floatingSelect">Judul</label>
                        @error('judul_id')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="form-floating mb-3">
                        <input type="number" name="nilai1" class="form-control"
                            value="{{ old('nilai1', $kompre->nilaikompre->nilai1 ?? null) }}">
                        <label for="floatingSelect">Nilai 1</label>
                        <small class="fw-bold ms-2">0 - 25</small>
                        @error('nilai1')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-floating mb-3">
                        <input type="number" name="nilai2" class="form-control"
                            value="{{ old('nilai2', $kompre->nilaikompre->nilai2 ?? null) }}">
                        <label for="floatingSelect">Nilai 2</label>
                        <small class="fw-bold ms-2">0 - 15</small>
                        @error('nilai2')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-floating mb-3">
                        <input type="number" name="nilai3" class="form-control"
                            value="{{ old('nilai3', $kompre->nilaikompre->nilai3 ?? null) }}">
                        <label for="floatingSelect">Nilai 3</label>
                        <small class="fw-bold ms-2">0 - 10</small>
                        @error('nilai3')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-floating mb-3">
                        <input type="number" name="nilai4" class="form-control"
                            value="{{ old('nilai4', $kompre->nilaikompre->nilai4 ?? null) }}">
                        <label for="floatingSelect">Nilai 4</label>
                        <small class="fw-bold ms-2">0 - 25</small>
                        @error('nilai4')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-floating mb-3">
                        <input type="number" name="nilai5" class="form-control"
                            value="{{ old('nilai5', $kompre->nilaikompre->nilai5 ?? null) }}">
                        <label for="floatingSelect">Nilai 5</label>
                        <small class="fw-bold ms-2">0 - 25</small>
                        @error('nilai5')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary">Input</button>
                </form>
            </div>
        </div>
        {{-- end form --}}

        {{-- feature --}}
        <div class="col-md-6 d-flex justify-content-center align-items-center">
            Isi Deskripsi Seminar Komprehensif
        </div>
        {{-- end feature --}}
    </div>
@endsection
