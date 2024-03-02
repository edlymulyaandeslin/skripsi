@extends('layouts.app')

@section('content')
    <div class="row">
        <h4>Halo {{ auth()->user()->name }}</h4>
        <h3>Selamat Datang di Aplikasi E Skripsi</h3>
        <p class="text-break">
            Aplikasi E-Skripsi adalah platform inovatif yang memberikan dukungan terintegrasi bagi mahasiswa, dosen
            pembimbing, dan koordinator akademik dalam proses penyusunan skripsi. Mahasiswa dapat mengakses sumber daya,
            mengunggah dokumen, dan berkomunikasi dengan dosen pembimbing, sementara dosen pembimbing dapat melacak progres,
            memberikan bimbingan, dan mengevaluasi dokumen skripsi. Koordinator akademik dapat mengelola data mahasiswa,
            mengawasi proses penyusunan skripsi, dan memfasilitasi koordinasi. Dengan aplikasi ini, diharapkan proses
            akademik menjadi lebih efisien, transparan, dan dapat menghasilkan karya ilmiah berkualitas.</p>

        <h5 class="my-3">Petunjuk Penggunaan Aplikasi</h5>
        <div class="col-md-10 offset-1 mt-3">
            <div class="accordion" id="accordionExample">
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                            Sebagai Mahasiswa
                        </button>
                    </h2>
                    <div id="collapseOne" class="accordion-collapse collapse show" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <ol>
                                <li>Lakukan pengajuan 3 judul skripsi pada sub-menu Judul. <small>(apabila diterima kamu
                                        dapat
                                        melihat pembimbing 1 dan
                                        2 melalui fitur "lihat" pada kolom aksi)</small></li>
                                <li>Setelah judul diterima, lakukan bimbingan proposal pada sub-menu Bimbingan.
                                </li>
                                <li>Untuk seminar proposal, pastikan telah memiliki riwayat bimbingan yang memiliki status
                                    "acc proposal"
                                    sebanyak 2 kali.</li>
                                <li>Untuk daftar seminar proposal dapat di melalui sub-menu pendaftaran proposal, kamu
                                    perlu menginputkan beberapa persyaratan yang telah ditentukan.</li>
                                <li>Akses jadwal Seminar Proposal melalui fitur "lihat" di kolom aksi pada sub-menu
                                    seminar proposal. <small>(jika sudah diterima)</small></li>
                                <li>Pelaksanaan Seminar Proposal.</li>
                                <li>Apabila telah melaksanakan seminar, kamu dapat melihat nilai pada sub-menu penilaian
                                    seminar proposal. <small>(selesai)</small></li>
                                <li>Setelah lulus seminar proposal, lakukan bimbingan komprehensif pada sub-menu Bimbingan.
                                </li>
                                <li>Untuk seminar komprehensif, pastikan telah memiliki riwayat bimbingan yang memiliki
                                    status
                                    "acc komprehensif"
                                    sebanyak 2 kali.</li>
                                <li>Untuk daftar seminar komprehensif dapat di melalui sub-menu pendaftaran komprehensif,
                                    kamu
                                    perlu menginputkan beberapa persyaratan yang telah ditentukan.</li>
                                <li>Akses jadwal seminar komprehensif melalui fitur "lihat" di kolom aksi pada sub-menu
                                    seminar komprehensif. <small>(jika sudah diterima)</small></li>
                                <li>Pelaksanaan Seminar Komprehensif.</li>
                                <li>Apabila telah melaksanakan seminar, kamu dapat melihat nilai pada sub-menu penilaian
                                    seminar komprehensif. <small>(selesai)</small></li>

                            </ol>
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                            Sebagai Dosen
                        </button>
                    </h2>
                    <div id="collapseTwo" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <ol>
                                <span class="fw-bold">Pembimbing</span>
                                <li>Lihat daftar semua mahasiswa yang sedang dalam bimbingan pada sub-menu mahasiswa.</li>
                                <li>Periksa judul-judul yang diajukan oleh mahasiswa pada menu pengajuan judul.
                                </li>
                                <li>Lakukan approve atau reject untuk bimbingan yang diajukan mahasiswa pada kolom aksi di
                                    sub-menu bimbingan.</li>
                                <li>Lakukan input nilai untuk mahasiswa sempro dan kompre pada sub-menu penilaian seminar
                                    proposal atau penilaian seminar komprehensif.</li>
                            </ol>
                            <ol>
                                <span class="fw-bold">Penguji</span>
                                <li>Lihat daftar semua judul dan mahasiswa yang akan diuji pada sub-menu ujian proposal atau
                                    ujian komprehensif.</li>

                                <li>Lakukan penilaian untuk presentasi yang telah dilakukan mahasiswa pada kolom aksi
                                    di menu penilaian.</li>
                            </ol>
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                            Sebagai Koordinator
                        </button>
                    </h2>
                    <div id="collapseThree" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <ol>
                                <li>Verifikasi judul yang diajukan mahasiswa pada sub-menu Judul.</li>
                                <li>Verifikasi pengajuan seminar proposal mahasiswa pada sub-menu seminar proposal.</li>
                                <li>Verifikasi pengajuan seminar komprehensif mahasiswa pada sub-menu seminar komprehensif.
                                </li>
                                <li>Cetak Laporan</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
