@extends('layouts.app')

@section('content')
    <div class="row">
        {{-- form --}}
        <div class="col-md-12">
            @if ($dokumen == null)
                <div class="alert alert-warning" role="alert">
                    <h4 class="alert-heading">Pemberitahuan!</h4>
                    <p>Untuk pendaftaran seminar proposal kamu harus mengupload beberapa dokumen tambahan, detailnya <a
                            href="/manajemen/dokumen">Klik disini</a></p>
                    <hr>
                    <p class="mb-0">#Keepspiritkids!</p>
                </div>
            @elseif ($sempro->count() != 0)
                <div class="bg-light rounded h-100 p-4">
                    <h4>Daftar Seminar Proposal</h4>

                    @if ($sempro[0]->status == 'diterima')
                        <div class="alert alert-success" role="alert">
                            <h4 class="alert-heading">ACCEPTED!</h4>
                            <p>Selamat pengajuan seminar proposal kamu diterima, untuk melihat jadwal <a href="/sempro">klik
                                    disini</a>.
                            </p>
                            <hr>
                            <p class="mb-0">#niceee!</p>
                        </div>
                    @else
                        <div class="alert alert-warning" role="alert">
                            <h4 class="alert-heading">PENDING!</h4>
                            <p>Pengajuan kamu sedang kami check dan proses, mohon ditunggu info selanjutnya ya!
                            </p>
                            <hr>
                            <p class="mb-0">Tetap semangat!</p>
                        </div>
                    @endif

                    <form action="/sempro/{{ $sempro[0]->id }}" method="post" enctype="multipart/form-data">
                        @method('patch')
                        @csrf
                        <div class="form-floating mb-3">
                            <select class="form-select @error('judul_id') is-invalid @enderror" id="form-file"
                                name="judul_id" disabled>
                                <option selected value="{{ null }}">Pilih</option>
                                @foreach ($juduls as $judul)
                                    @if (old('judul_id', $sempro[0]->judul_id) == $judul->id)
                                        <option value="{{ $judul->id }}" selected>{{ $judul->judul }}</option>
                                    @else
                                        <option value="{{ $judul->id }}">{{ $judul->judul }}</option>
                                    @endif
                                @endforeach
                            </select>
                            <label for="form-file">Judul<span class="text-danger">*</span></label>
                            @error('judul_id')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="form-floating mb-3">
                            <input type="text" class="form-control"
                                value="{{ str_replace('post-pembayaran/', '', $sempro[0]->pembayaran) }}" disabled>
                            <label for="buktipembayaran">Bukti Pembayaran<span class="text-danger">*</span></label>
                            @error('pembayaran')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="form-floating mb-3">
                            <input type="text" class="form-control"
                                value="{{ str_replace('doc-bimbingan/', '', $sempro[0]->lembar_bimbingan) }}" disabled>
                            <label for="lembarbimbingan">Lembar Bimbingan Proposal<span class="text-danger">*</span></label>
                            @error('lembar_bimbingan')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>

                        <hr>
                        <label for="wrong" class="form-label fst-italic text-danger bg-light">*Terjadi
                            Kesalahan Upload?</label>

                        <div class="mb-3">
                            <input type="hidden" name="oldPembayaran" value="{{ $sempro[0]->pembayaran }}"
                                class="form-control">
                            <input type="file" id="pembayaran" name="pembayaran" class="form-control">
                            <small>Jika ingin mengganti bukti pembayaran, silakan upload ulang disini</small>
                            @error('pembayaran')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <input type="hidden" name="oldLembarBimbingan" value="{{ $sempro[0]->lembar_bimbingan }}"
                                class="form-control">
                            <input type="file" id="lembar_bimbingan" name="lembar_bimbingan" class="form-control">
                            <small>Jika ingin mengganti lembar bimbingan, silakan upload ulang disini</small>
                            @error('lembar_bimbingan')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary d-none" id="btnUpdate">Simpan</button>
                    </form>

                </div>
            @else
                <div class="bg-light rounded h-100 p-4">

                    <h4 class="mb-4">Daftar Seminar Proposal</h4>
                    <form action="/sempro" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-floating mb-3">
                            <select class="form-select @error('judul_id') is-invalid @enderror" id="form-file"
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
                            <label for="form-file">Judul<span class="text-danger">*</span></label>
                            @error('judul_id')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="form-floating mb-3">
                            <input type="file" name="pembayaran" class="form-control" value="{{ old('pembayaran') }}"
                                id="form-file">
                            <label for="form-file">Bukti Pembayaran<span class="text-danger">*</span></label>
                            <small>Upload bukti pembayaran dengan format .pdf</small>
                            @error('pembayaran')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="form-floating mb-3">
                            <input type="file" name="lembar_bimbingan" class="form-control"
                                value="{{ old('lembar_bimbingan') }}" id="form-file">
                            <label for="form-file">Lembar Bimbingan Proposal<span class="text-danger">*</span></label>
                            <small>Upload bukti lembar bimbingan proposal dengan format .pdf</small>
                            @error('lembar_bimbingan')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </form>
                </div>
            @endif

        </div>
        {{-- end form --}}

    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            // Fungsi untuk memeriksa apakah tombol harus ditampilkan atau tidak
            function checkButtonVisibility() {
                if ($('#pembayaran').val() !== '' || $('#lembar_bimbingan').val() !== '') {
                    $('#btnUpdate').removeClass('d-none').show(); // Hapus kelas d-none dan tampilkan tombol
                } else {
                    $('#btnUpdate').addClass('d-none').hide(); // Tambahkan kelas d-none dan sembunyikan tombol
                }
            }

            // Saat nilai input pembayaran berubah, periksa apakah harus menampilkan tombol atau tidak
            $('#pembayaran').on('change', function() {
                checkButtonVisibility();
            });

            // Saat nilai input lembar_bimbingan berubah, periksa apakah harus menampilkan tombol atau tidak
            $('#lembar_bimbingan').on('change', function() {
                checkButtonVisibility();
            });
        })
    </script>
@endsection
