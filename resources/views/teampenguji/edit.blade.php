@extends('layouts.app')

@section('content')
    <div class="row">
        {{-- form --}}
        <div class="col-md-6">
            <div class="bg-light rounded h-100 p-4">
                <h4 class="mb-4">Update Seminar Proposal</h4>

                <form action="/manajemen/teampenguji/{{ $teampenguji->id }}" method="post">
                    @method('patch')
                    @csrf
                    <div class="form-floating mb-3">
                        <input type="text" name="name" class="form-control" value="{{ $teampenguji->name }}">
                        <label for="floatingSelect">Nama Team</label>
                        @error('name')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="form-floating mb-3">
                        <select class="form-select @error('penguji1') is-invalid @enderror" id="floatingSelect"
                            name="penguji1">
                            <option selected value="{{ null }}">Pilih</option>

                            @foreach ($dosens as $dosen)
                                @if (old('penguji1', $teampenguji->penguji1) == $dosen->name)
                                    <option value="{{ $dosen->name }}" class="d-flex" selected>{{ $dosen->name }}
                                    </option>
                                @else
                                    <option value="{{ $dosen->name }}">{{ $dosen->name }}
                                    </option>
                                @endif
                            @endforeach
                        </select>
                        <label for="floatingSelect">Penguji 1</label>
                        @error('penguji1')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="form-floating mb-3">
                        <select class="form-select @error('penguji2') is-invalid @enderror" id="floatingSelect"
                            name="penguji2">
                            <option selected value="{{ null }}">Pilih</option>

                            @foreach ($dosens as $dosen)
                                @if (old('penguji2', $teampenguji->penguji2) == $dosen->name)
                                    <option value="{{ $dosen->name }}" class="d-flex" selected>{{ $dosen->name }}
                                    </option>
                                @else
                                    <option value="{{ $dosen->name }}">{{ $dosen->name }}
                                    </option>
                                @endif
                            @endforeach
                        </select>
                        <label for="floatingSelect">Penguji 2</label>
                        @error('penguji2')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="form-floating mb-3">
                        <select class="form-select @error('penguji3') is-invalid @enderror" id="floatingSelect"
                            name="penguji3">
                            <option selected value="{{ null }}">Pilih</option>

                            @foreach ($dosens as $dosen)
                                @if (old('penguji3', $teampenguji->penguji3) == $dosen->name)
                                    <option value="{{ $dosen->name }}" class="d-flex" selected>{{ $dosen->name }}
                                    </option>
                                @else
                                    <option value="{{ $dosen->name }}">{{ $dosen->name }}
                                    </option>
                                @endif
                            @endforeach
                        </select>
                        <label for="floatingSelect">Penguji 3</label>
                        @error('penguji3')
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
