@extends('layouts.app')

@section('content')
    <div class="row">
        {{-- form --}}
        <div class="col-md-6">
            <div class="bg-light rounded h-100 p-4">
                <h4 class="mb-4">Isi Detail Team Penguji</h4>
                <form action="/manajemen/teampenguji" method="post">
                    @csrf
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="floatingInput"
                            placeholder="name" name="name" value="{{ old('name') }}">
                        <label for="name">Nama Team</label>
                        @error('name')
                            <p class="text-danger pt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="form-floating mb-3">
                        <select class="form-select @error('penguji1') is-invalid @enderror" id="floatingSelect"
                            name="penguji1">
                            <option selected disabled>Pilih</option>
                            @foreach ($listpenguji as $penguji)
                                @if (old('penguji1') == $penguji->name)
                                    <option value="{{ $penguji->name }}" class="d-flex" selected>{{ $penguji->name }}
                                    </option>
                                @else
                                    <option value="{{ $penguji->name }}" class="d-flex">{{ $penguji->name }}
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
                            <option selected disabled>Pilih</option>
                            @foreach ($listpenguji as $penguji)
                                @if (old('penguji2') == $penguji->name)
                                    <option value="{{ $penguji->name }}" class="d-flex" selected>{{ $penguji->name }}
                                    </option>
                                @else
                                    <option value="{{ $penguji->name }}" class="d-flex">{{ $penguji->name }}
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
                            <option selected disabled>Pilih</option>
                            @foreach ($listpenguji as $penguji)
                                @if (old('penguji3') == $penguji->name)
                                    <option value="{{ $penguji->name }}" class="d-flex" selected>{{ $penguji->name }}
                                    </option>
                                @else
                                    <option value="{{ $penguji->name }}" class="d-flex">{{ $penguji->name }}
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
            Deskripsi pengajuan judul
        </div>
        {{-- end feature --}}
    </div>
@endsection
