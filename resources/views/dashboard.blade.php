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
                                <li>Lakukan pengajuan judul projek.</li>
                                <li>Setelah judul diterima, ajukan logbook setelah melakukan bimbingan dengan pembimbing.
                                </li>
                                <li>Untuk mengajukan seminar proposal, pastikan telah memiliki riwayat logbook yang diaccept
                                    minimal 1 kali.</li>
                                <li>Akses jadwal Seminar Proposal melalui fitur "show" pada kolom action dalam submenu
                                    sempro pada aplikasi.</li>
                                <li>Seminar proposal akan diapprove oleh koordinator atau mentor.</li>
                                <li>Setelah Seminar Proposal, ajukan logbook komprehensif setelah melakukan bimbingan dengan
                                    pembimbing.</li>
                                <li>Untuk mengajukan seminar komprehensif, pastikan telah memiliki riwayat logbook yang
                                    diaccept minimal 1 kali dan lulus seminar proposal.</li>
                                <li>Akses jadwal Seminar Komprehensif melalui fitur "show" pada kolom action dalam submenu
                                    kompre pada
                                    aplikasi.</li>
                                <li>Seminar komprehensif akan diapprove oleh koordinator atau mentor.</li>

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
                                <li>Lakukan approve atau reject untuk logbook yang diajukan mahasiswa pada kolom action di
                                    menu logbook.</li>
                                <li>Lakukan approve atau reject untuk presentasi yang diajukan mahasiswa pada kolom action
                                    di menu presentasi.</li>
                            </ol>
                            <ol>
                                <span class="fw-bold">Penguji</span>
                                <li>Lihat daftar semua judul dan mahasiswa yang akan diuji pada sub-menu uji.</li>

                                <li>Lakukan penilaian untuk presentasi yang telah dilakukan mahasiswa pada kolom action
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
                                <li>Tambahkan dosen baru ke dalam sistem.</li>
                                <li>Setelah mahasiswa mengajukan judul, lakukan approve atau reject pada kolom action di
                                    menu pengajuan judul.</li>
                                <li>Setelah mahasiswa mengajukan presentasi, lakukan approve atau reject pada kolom action
                                    di menu presentasi.</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
