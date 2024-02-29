@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-12">
            @if ($user->email == null || $user->no_hp == null)
                <div class="alert alert-warning" role="alert">
                    <h4 class="alert-heading">Halo, {{ auth()->user()->name }}!</h4>
                    <p>Sepertinya Biodata kamu belum lengkap mohon lengkapi terlebih dahulu <a
                            href="/manajemen/profile/{{ auth()->user()->id }}/edit">Klik
                            disini</a></p>
                    <hr>
                    <p class="mb-0">Apabila sudah melengkapi biodata kamu dapat kembali ke halaman ini dengan cara klik
                        ikon profile dan pilih
                        submenu lengkapi dokumen.</p>
                </div>
            @else
                <div class="bg-light rounded h-100 p-4">
                    <h4 class="mb-4">Lengkapi Dokumen</h4>

                    <form
                        action="{{ $user->dokumen !== null ? route('dokumen.update', $user->dokumen->id) : route('dokumen.store') }}"
                        method="post" enctype="multipart/form-data" class="row">

                        @if ($user->dokumen)
                            @method('patch')
                        @endif

                        @csrf
                        <input type="hidden" value="{{ $user->id }}" name="mahasiswa_id">

                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-3 row">
                                    <div class="col-md-8">
                                        <label for="krs" class="form-label">KRS<span
                                                class="text-danger">*</span></label>
                                        <input type="file" class="form-control @error('krs') is-invalid @enderror"
                                            name="krs" value="{{ old('krs') }}">
                                        <small>Unggah krs dengan format .Pdf</small>
                                        <br>
                                        <small>Notes: Jika ada kesalahan. Anda dapat mengunggahnya
                                            kembali.</small>
                                    </div>
                                    <div class="col">
                                        @if ($user->dokumen)
                                            <div class="d-flex justify-content-center align-items-center h-100">
                                                <input type="hidden" value="{{ $user->dokumen->krs }}" name="oldKrs">
                                                <p>{{ str_replace('doc/', '', $user->dokumen->krs) }}</p>
                                            </div>
                                        @else
                                            <div class="d-flex justify-content-center align-items-center h-100">
                                                <p>No Dokumen.</p>
                                            </div>
                                        @endif
                                    </div>
                                    @error('krs')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="mb-3 row">
                                    <div class="col-md-8">
                                        <label for="transkip_nilai" class="form-label">Transkip Nilai<span
                                                class="text-danger">*</span></label>
                                        <input type="file"
                                            class="form-control @error('transkip_nilai') is-invalid @enderror"
                                            name="transkip_nilai" value="{{ old('transkip_nilai') }}">
                                        <small>Unggah transkrip nilai dengan format .Pdf</small>
                                        <br>
                                        <small>Notes: Jika ada kesalahan. Anda dapat mengunggahnya
                                            kembali.</small>
                                    </div>
                                    <div class="col">
                                        @if ($user->dokumen)
                                            <div class="d-flex justify-content-center align-items-center h-100">
                                                <input type="hidden" value="{{ $user->dokumen->transkip_nilai }}"
                                                    name="oldTranskip">
                                                <p>{{ str_replace('doc/', '', $user->dokumen->transkip_nilai) }}</p>
                                            </div>
                                        @else
                                            <div class="d-flex justify-content-center align-items-center h-100">
                                                <p>No Dokumen.</p>
                                            </div>
                                        @endif
                                    </div>
                                    @error('transkip_nilai')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="mb-3 row">
                                    <div class="col-md-8">
                                        <label for="hadir_seminar" class="form-label">Hadir Seminar<span
                                                class="text-danger">*</span></label>
                                        <input type="file"
                                            class="form-control @error('hadir_seminar') is-invalid @enderror"
                                            name="hadir_seminar" value="{{ old('hadir_seminar') }}">
                                        <small>Unggah bukti hadir seminar/sidang dengan format .Pdf</small>
                                        <br>
                                        <small>Notes: Jika ada kesalahan. Anda dapat mengunggahnya
                                            kembali.</small>
                                    </div>
                                    <div class="col">
                                        @if ($user->dokumen)
                                            <div class="d-flex justify-content-center align-items-center h-100">
                                                <input type="hidden" value="{{ $user->dokumen->hadir_seminar }}"
                                                    name="oldHadirSeminar">
                                                <p>{{ str_replace('doc/', '', $user->dokumen->hadir_seminar) }}</p>
                                            </div>
                                        @else
                                            <div class="d-flex justify-content-center align-items-center h-100">
                                                <p>No Dokumen.</p>
                                            </div>
                                        @endif
                                    </div>
                                    @error('hadir_seminar')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-end gap-2">
                            @if ($user->dokumen)
                                {{-- <a href="{{ route('dokumen.reset', $user->dokumen->id) }}" data-confirm-delete="true"
                                class="btn btn-danger">Reset</a> --}}
                                <button type="submit" class="btn btn-primary">Update</button>
                            @else
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            @endif
                        </div>
                    </form>

                </div>
            @endif

        </div>
        {{-- end form --}}

    </div>
@endsection
