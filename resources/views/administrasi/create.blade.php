@extends('layouts.app')

@section('content')
    <div class="row">
        {{-- form --}}
        <div class="col-md-12">
            <div class="bg-light rounded h-100 p-4">
                <h4 class="mb-4">Bayar</h4>
                <form action="/adm-seminar/{{ $dosen->id }}/{{ $totalbayar }}" method="post">
                    @csrf
                    <div class="w-50">
                        <div class="form-floating mb-3">
                            <input type="number" class="form-control @error('bayar') is-invalid @enderror"
                                placeholder="bayar" name="bayar" required>
                            <label for="bayar">Masukkan Nominal</label>
                            @error('bayar')
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
