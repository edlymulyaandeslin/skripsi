@extends('layouts.app')

@section('content')
    <div class="row">
        {{-- form --}}
        <div class="col-md-12">
            <div class="bg-light rounded h-100 p-4">
                <h4 class="mb-4">Atur Bobot Nilai Komprehensif</h4>
                <form action="{{ route('bobot.update', $bobot->id) }}" method="post">
                    @method('patch')
                    @csrf
                    <div class="w-50">
                        <div class="form-floating mb-3">
                            <input type="number" class="form-control @error('bobot1') is-invalid @enderror"
                                placeholder="bobot1" name="bobot1" value="{{ old('bobot1', $bobot->bobot1) }}" required>
                            <label for="bobot1">Penguasaan Penelitian</label>
                            @error('bobot1')
                                <p class="text-danger pt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="form-floating mb-3">
                            <input type="number" class="form-control @error('bobot2') is-invalid @enderror"
                                placeholder="bobot2" name="bobot2" value="{{ old('bobot2', $bobot->bobot2) }}" required>
                            <label for="bobot2">Segi Ilmiah Tulisan</label>
                            @error('bobot2')
                                <p class="text-danger pt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="form-floating mb-3">
                            <input type="number" class="form-control @error('bobot3') is-invalid @enderror"
                                placeholder="bobot3" name="bobot3" value="{{ old('bobot3', $bobot->bobot3) }}" required>
                            <label for="bobot3">Kemampuan Penyajian</label>
                            @error('bobot3')
                                <p class="text-danger pt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-floating mb-3">
                            <input type="number" class="form-control @error('bobot4') is-invalid @enderror"
                                placeholder="bobot4" name="bobot4" value="{{ old('bobot4', $bobot->bobot4) }}" required>
                            <label for="bobot4">Kemampuan Berdiskusi</label>
                            @error('bobot4')
                                <p class="text-danger pt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary">Simpan</button>
                </form>
            </div>
        </div>
        {{-- end form --}}

    </div>
@endsection
