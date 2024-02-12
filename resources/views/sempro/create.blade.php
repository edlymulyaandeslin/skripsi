@extends('layouts.app')

@section('content')
    <div class="row">
        {{-- form --}}
        <div class="col-md-12">
            @if ($dokumen == null)
                <div style="background-color: #f9ca24" class="text-white py-3 rounded-1 px-3 fst-italic">Data kamu belum
                    lengkap, silakan lengkapi terlebih dahulu <a href="/manajemen/dokumen">klik disini</a></div>
            @elseif ($sempro->count() != 0)
                <div class="bg-light rounded h-100 p-4">

                    <h4 class="mb-4">Daftar Seminar Proposal</h4>
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

                        <div class="mb-3">
                            <input type="hidden" name="oldPembayaran" value="{{ $sempro[0]->pembayaran }}"
                                class="form-control">
                            <input type="file" id="pembayaran" name="pembayaran" class="form-control">
                            <small>Jika ingin mengganti bukti pembayaran, silakan upload ulang</small>
                            @error('pembayaran')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary d-none" id="updatePembayaran">Simpan</button>
                    </form>

                    <div style="background-color: #27ae60" class="rounded-1 mt-3 p-4 text-white fst-italic">"Pengajuan
                        seminar proposal Anda sebelumnya telah kami terima. Saat ini, pengajuan Anda sedang kami proses."
                    </div>

                    <div class="mt-3">
                        <a href="/cetak/form-seminar" class="btn btn-sm btn-danger"><i class="fa fa-file-download"></i>
                            Cetak Formulir
                            Pendaftaran</a>
                    </div>
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
            $('#updatePembayaran').hide();

            // Saat nilai input berubah, periksa apakah harus menampilkan tombol atau tidak
            $('#pembayaran').on('change', function() {
                if ($(this).val() !== '') {
                    $('#updatePembayaran').removeClass('d-none')
                        .show(); // Hapus kelas d-none dan tampilkan tombol
                } else {
                    $('#updatePembayaran').addClass('d-none')
                        .hide(); // Tambahkan kelas d-none dan sembunyikan tombol
                }
            });
        })
    </script>
@endsection
