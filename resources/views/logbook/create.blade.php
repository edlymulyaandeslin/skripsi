@extends('layouts.app')

@section('content')
    <div class="row">
        {{-- form --}}
        <div class="col-md-12">
            <div class="bg-light rounded h-100 p-4">
                <h4 class="mb-4">Detail Bimbingan</h4>
                <form action="/logbook" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-floating mb-3">
                        <select class="form-select @error('judul_id') is-invalid @enderror" id="floatingSelect"
                            name="judul_id">
                            <option selected value="{{ null }}">Pilih</option>
                            @foreach ($juduls as $judul)
                                @if (old('judul_id') == $judul->id)
                                    <option value="{{ $judul->id }}" selected>{{ $judul->judul }}</option>
                                @else
                                    <option value="{{ $judul->id }}">{{ $judul->judul }}</option>
                                @endif
                            @endforeach
                        </select>
                        <label for="floatingSelect">Judul<span class="text-danger">*</span></label>
                        @error('judul_id')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="form-floating mb-3">
                        <textarea class="form-control @error('target_bimbingan') is-invalid @enderror" placeholder="Target Bimbingan"
                            id="floatingTextarea" style="height: 150px;" name="target_bimbingan">{{ old('target_bimbingan') }}</textarea>
                        <label for="target_bimbingan">Target Bimbingan<span class="text-danger">*</span></label>
                        <small>Target bimbingan misal : bab 1.</small>
                        @error('target_bimbingan')
                            <p class="text-danger pt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="form-floating mb-3">
                        <input type="file" name="file_proposal"
                            class="form-control @error('file_proposal')
                            is-invalid @enderror">
                        <label for="file_proposal">Proposal<span class="text-danger">*</span></label>
                        <small>Unggah proposal bimbingan misal : proposal-bab-1.pdf</small>
                        @error('file_proposal')
                            <p class="text-danger pt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="form-floating mb-3">
                        <select class="form-select @error('kategori') is-invalid @enderror" id="floatingSelect"
                            name="kategori">
                            <option selected value="{{ null }}">Pilih</option>
                            @if (old('kategori') == 'proposal')
                                <option value="proposal" selected>Proposal</option>
                                <option value="komprehensif">Komprehensif</option>
                            @elseif(old('kategori') == 'komprehensif')
                                <option value="proposal">Proposal</option>
                                <option value="komprehensif" selected>Komprehensif</option>
                            @else
                                <option value="proposal">Proposal</option>
                                <option value="komprehensif">Komprehensif</option>
                            @endif
                        </select>
                        <label for="floatingSelect">Kategori<span class="text-danger">*</span></label>
                        <small>Kategori bimbingan misal : proposal / komprehensif</small>
                        @error('kategori')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="form-floating mb-3">
                        <select class="form-select @error('pembimbing_id') is-invalid @enderror" id="floatingSelect"
                            name="pembimbing_id">
                            <option selected value="{{ null }}">Pilih</option>
                            @foreach ($juduls as $judul)
                                @if (old('pembimbing_id') == $judul->pembimbing1_id)
                                    <option value="{{ $judul->pembimbing1_id }}" selected>{{ $judul->pembimbing1->name }}
                                    </option>
                                    <option value="{{ $judul->pembimbing2_id }}">{{ $judul->pembimbing2->name }}
                                    </option>
                                @elseif (old('pembimbing_id') == $judul->pembimbing2_id)
                                    <option value="{{ $judul->pembimbing1_id }}">{{ $judul->pembimbing1->name }}
                                    </option>
                                    <option value="{{ $judul->pembimbing2_id }}" selected>{{ $judul->pembimbing2->name }}
                                    </option>
                                @else
                                    <option value="{{ $judul->pembimbing1_id }}">{{ $judul->pembimbing1->name }}
                                    </option>
                                    <option value="{{ $judul->pembimbing2_id }}">{{ $judul->pembimbing2->name }}
                                    </option>
                                @endif
                            @endforeach
                        </select>
                        <label for="floatingSelect">Dosen<span class="text-danger">*</span></label>
                        <small>Dosen bimbingan misal : Dosen A</small>
                        @error('pembimbing_id')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary">Simpan</button>
                </form>
            </div>
        </div>
        {{-- end form --}}
    </div>
@endsection
