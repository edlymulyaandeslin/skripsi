<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>{{ $title }}</title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">

        <style>
            #garis-tebal {
                border-bottom: 4px solid black;
                margin-bottom: 10px;
            }

            #table,
            #thead tr th,
            #tbody tr,
            #tbody tr th,
            #tbody tr td {
                border: 1px solid black;
            }

            .garis-putus-putus {
                border: 1px dashed black;
            }

            /* Gaya untuk pencetakan */
            @page {
                margin: 1cm;
                /* Atur margin sesuai kebutuhan */
            }

            .col-md-6 {
                float: left;
                width: 50%;
                box-sizing: border-box;
            }

            #header {
                page-break-after: always;
            }
        </style>
    </head>

    <body>
        <div class="container-fluid">
            <div class="row">

                <div class="col-md-12">
                    <div class="col-md-12">
                        {{-- <img src="" alt=""> --}}
                        <header class="text-center">
                            <h2>UNIVERSITAS PASIR PENGARAIAN</h2>
                            <h2>FAKULTAS ILMU KOMPUTER</h2>
                            <h2>PROGRAM STUDI SISTEM INFORMASI</h2>
                            <span>Jalan Tuanku Tambusai, Kumu Rambah Hilir, Telp. 085265853585 Kode Pos : 28557</span>
                        </header>
                    </div>
                    <div id="garis-tebal"></div>

                    <div class="col-md-12 text-center">
                        <h4>FORMULIR PENGAJUAN SEMINAR PROPOSAL TUGAS AKHIR I</h4>
                    </div>

                    <div class="col-md-12 d-flex justify-content-center">
                        <table id="table" class="table caption-top" style="border: 1px solid black;">
                            <caption class="fw-bold">Data Mahasiswa</caption>
                            <tbody id="tbody">
                                <tr>
                                    <td>Nama</td>
                                    <td>{{ $sempro->judul->mahasiswa->name }}</td>

                                    <td>No.HP</td>
                                    <td>{{ $sempro->judul->mahasiswa->no_hp }}</td>
                                </tr>
                                <tr>
                                    <td>NIM</td>
                                    <td>{{ $sempro->judul->mahasiswa->nim_or_nidn }}</td>

                                    <td>Email</td>
                                    <td>{{ $sempro->judul->mahasiswa->email }}</td>
                                </tr>
                                <tr>
                                    <td colspan="4" style="height: 80px"></td>

                                </tr>

                                <tr>
                                    <td colspan="2">Data Pembimbing 1</td>
                                    <td colspan="2">Data Pembimbing 2</td>
                                </tr>
                                <tr>
                                    <td>Nama</td>
                                    <td>{{ $sempro->judul->pembimbing1->name }}</td>

                                    <td>Nama</td>
                                    <td>{{ $sempro->judul->pembimbing2->name }}</td>
                                </tr>
                                <tr>
                                    <td>NIDN</td>
                                    <td>{{ $sempro->judul->pembimbing1->nim_or_nidn }}</td>

                                    <td>NIDN</td>
                                    <td>{{ $sempro->judul->pembimbing2->nim_or_nidn }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <p>
                        Dengan ini saya mengajukan permohonan SEMINAR PROPOSAL. Saya Menyatakan saya telah memenuhi
                        ketentuan yang dipersyaratkan oleh Program Studi.
                    </p>
                    <p>
                        Tanda Tangan Mahasiswa ..........................................
                        Tanggal {{ $sempro->created_at->translatedFormat('d F Y') }}
                    </p>
                    <div class="garis-putus-putus"></div>
                    <div class="col-md-12 d-flex justify-content-center">
                        <table id="table" class="table caption-top">
                            <caption class="fw-bold">Ka. Program Studi Sistem Informasi telah memeriksa persyaratan
                                seminar
                                Proposal Tugas
                                Akhir</caption>
                            <thead id="thead">
                                <tr class="text-center">
                                    <th scope="col">No</th>
                                    <th scope="col">Persyaratan</th>
                                    <th scope="col">Dokumen</th>
                                    <th scope="col">Ket.</th>
                                </tr>
                            </thead>
                            <tbody id="tbody">
                                <tr>
                                    <td rowspan="2">1</td>
                                    <td rowspan="2">Telah memprogram mata kuliah TA I pada KRS</td>
                                    <td>Fc. KRS</td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>Fc. Transkip Nilai Sementara</td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td>Telah lunas biaya ujian proposal TA</td>
                                    <td>Fc. Slip Pembayaran</td>
                                    <td></td>
                                </tr>

                                <tr>
                                    <td rowspan="2">3</td>
                                    <td rowspan="2">5 Rangkap Proposal TA yang sudah disetujui pembimbing 1 dan 2 dan
                                        6
                                        MAP</td>
                                    <td>5 Rangkap Naskah Proposal</td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>6 Map</td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>4</td>
                                    <td>Menghadiri minimal 5 kali sidang proposal atau TA</td>
                                    <td>Bukti Hadir Seminar/sidang</td>
                                    <td></td>
                                </tr>

                                <tr>
                                    <td>5</td>
                                    <td>Lembar Kontrol Bimbingan Proposal TA</td>
                                    <td>Asli dan Fotocopy</td>
                                    <td></td>
                                </tr>

                            </tbody>
                        </table>
                    </div>

                    <p>Setelah diperiksa mahasiswa tersebut diatas telah memenuhi persyaratan sehingga berhak mengajukan
                        permohonan SEMINAR PROPOSAL.</p>
                    <p>
                        Ka. Program Studi Sistem Informasi Tanggal ...............................
                        Tanda Tangan.............................
                    </p>

                    <div class="garis-putus-putus"></div>

                    <p class="text-end mt-2">No :
                        ............./SI-FILKOM/............./............./{{ date('Y') }}
                    </p>

                    <p>Ketua Program Studi Sistem Informasi dengan ini mengusulkan kepada Dekan Fakultas Ilmu Komputer
                        agar
                        nama-nama dibawah ini dibuatkan Surat Keputusan untuk menjadi tim Tim Penguji Proposal Tugas
                        Akhir
                        bagi mahasiswa tersebut diatas.</p>

                    <div class="col-md-12 d-flex justify-content-center mt-5 pt-5">
                        <table id="table" class="table">
                            <thead id="thead">
                                <tr class="text-center">
                                    <th scope="col">Penguji</th>
                                    <th scope="col">Nama</th>
                                    <th scope="col">NIDN</th>
                                </tr>
                            </thead>
                            <tbody id="tbody">
                                <tr>
                                    <td>Penguji 1</td>
                                    <td>{{ $sempro->penguji1->name ?? '-' }}</td>
                                    <td>{{ $sempro->penguji1->nim_or_nidn ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <td>Penguji 2</td>
                                    <td>{{ $sempro->penguji2->name ?? '-' }}</td>
                                    <td>{{ $sempro->penguji2->nim_or_nidn ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <td>Penguji 3</td>
                                    <td>{{ $sempro->penguji3->name ?? '-' }}</td>
                                    <td>{{ $sempro->penguji3->nim_or_nidn ?? '-' }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="col-md-12 mt-5">
                        <div class="col-md-6">
                            <p>Yang akan dilaksanakan pada:</p>
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <td>Hari/Tanggal</td>
                                        <td>:</td>
                                        <td>{{ $sempro->tanggal_seminar ? \Carbon\Carbon::parse($sempro->tanggal_seminar)->translatedFormat('l, d F Y') : '-' }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Tempat</td>
                                        <td>:</td>
                                        <td>{{ $sempro->ruang ?? '-' }}</td>
                                    </tr>
                                    <tr>
                                        <td>Waktu</td>
                                        <td>:</td>
                                        <td>{{ $sempro->jam ? \Carbon\Carbon::parse($sempro->jam)->format('H:i') : '-' }}
                                            WIB
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="col-md-6">
                            <p class="m-0">Pasir Pengaraian, ......................... {{ date('Y') }}</p>
                            <p class="mb-5">Ka. Program Studi Sistem Informasi</p>
                            <span>{{ $admin[0]->name ?? '-' }}</span>
                            <p>NIDN. {{ $admin[0]->nim_or_nidn ?? '-' }}</p>
                        </div>
                    </div>
                </div>
                <div id="header"></div>

                <div class="col-md-12">
                    <div class="col-md-12">
                        {{-- <img src="" alt=""> --}}
                        <header class="text-center">
                            <h2>UNIVERSITAS PASIR PENGARAIAN</h2>
                            <h2>FAKULTAS ILMU KOMPUTER</h2>
                            <h2>PROGRAM STUDI SISTEM INFORMASI</h2>
                            <span>Jalan Tuanku Tambusai, Kumu Rambah Hilir, Telp. 085265853585 Kode Pos : 28557</span>
                        </header>
                    </div>

                    <div id="garis-tebal"></div>

                    <div class="col-md-12 text-center">
                        <h4>DAFTAR HADIR MAHASISWA</h4>
                        <h4>{{ $title }} TUGAS AKHIR I</h4>
                    </div>

                    <div class="col-md-12">
                        <table class="table">
                            <tbody>
                                <tr>
                                    <td style="width: 30%">Hari/Tanggal</td>
                                    <td style="width: 1%">:</td>
                                    <td>{{ $sempro->tanggal_seminar ? \Carbon\Carbon::parse($sempro->tanggal_seminar)->translatedFormat('l, d F Y') : '-' }}
                                    </td>
                                </tr>
                                <tr>
                                    <td>Waktu</td>
                                    <td>:</td>
                                    <td>{{ $sempro->jam? \Carbon\Carbon::parse($sempro->jam)->translatedFormat('H:i') .' s/d ' .\Carbon\Carbon::parse($sempro->jam)->addHours(1)->translatedFormat('H:i'): '-' }}
                                        WIB</td>
                                </tr>
                                <tr>
                                    <td>Penyaji</td>
                                    <td>:</td>
                                    <td>{{ $sempro->judul->mahasiswa->name }}</td>
                                </tr>

                                <tr>
                                    <td>Judul Proposal</td>
                                    <td>:</td>
                                    <td>{{ \Str::title($sempro->judul->judul) }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="col-md-12">
                        <table class="table " id="table">
                            <thead id="thead">
                                <tr class="text-center">
                                    <th style="width: 5%">No</th>
                                    <th>NIM</th>
                                    <th>Nama</th>
                                    <th colspan="2">Tanda Tangan</th>
                                </tr>
                            </thead>
                            <tbody id="tbody">
                                <tr>
                                    <td>1.</td>
                                    <td></td>
                                    <td></td>
                                    <td rowspan="2">1.</td>
                                    <td rowspan="2">2.</td>
                                </tr>
                                <tr>
                                    <td>2.</td>
                                    <td></td>
                                    <td></td>
                                </tr>

                                <tr>
                                    <td>3.</td>
                                    <td></td>
                                    <td></td>
                                    <td rowspan="2">3.</td>
                                    <td rowspan="2">4.</td>
                                </tr>
                                <tr>
                                    <td>4.</td>
                                    <td></td>
                                    <td></td>
                                </tr>

                                <tr>
                                    <td>5.</td>
                                    <td></td>
                                    <td></td>
                                    <td rowspan="2">5.</td>
                                    <td rowspan="2">6.</td>
                                </tr>
                                <tr>
                                    <td>6.</td>
                                    <td></td>
                                    <td></td>
                                </tr>

                                <tr>
                                    <td>7.</td>
                                    <td></td>
                                    <td></td>
                                    <td rowspan="2">7.</td>
                                    <td rowspan="2">8.</td>
                                </tr>
                                <tr>
                                    <td>8.</td>
                                    <td></td>
                                    <td></td>
                                </tr>

                                <tr>
                                    <td>9.</td>
                                    <td></td>
                                    <td></td>
                                    <td rowspan="2">9.</td>
                                    <td rowspan="2">10.</td>
                                </tr>
                                <tr>
                                    <td>10.</td>
                                    <td></td>
                                    <td></td>
                                </tr>

                                <tr>
                                    <td>11.</td>
                                    <td></td>
                                    <td></td>
                                    <td rowspan="2">11.</td>
                                    <td rowspan="2">12.</td>
                                </tr>
                                <tr>
                                    <td>12.</td>
                                    <td></td>
                                    <td></td>
                                </tr>

                                <tr>
                                    <td>13.</td>
                                    <td></td>
                                    <td></td>
                                    <td rowspan="2">13.</td>
                                    <td rowspan="2">14.</td>
                                </tr>
                                <tr>
                                    <td>14.</td>
                                    <td></td>
                                    <td></td>
                                </tr>

                                <tr>
                                    <td>15.</td>
                                    <td></td>
                                    <td></td>
                                    <td rowspan="2">15.</td>
                                    <td rowspan="2">16.</td>
                                </tr>
                                <tr>
                                    <td>16.</td>
                                    <td></td>
                                    <td></td>
                                </tr>

                                <tr>
                                    <td>17.</td>
                                    <td></td>
                                    <td></td>
                                    <td rowspan="2">17.</td>
                                    <td rowspan="2">18.</td>
                                </tr>
                                <tr>
                                    <td>18.</td>
                                    <td></td>
                                    <td></td>
                                </tr>

                                <tr>
                                    <td>19.</td>
                                    <td></td>
                                    <td></td>
                                    <td rowspan="2">19.</td>
                                    <td rowspan="2">20.</td>
                                </tr>
                                <tr>
                                    <td>20.</td>
                                    <td></td>
                                    <td></td>
                                </tr>

                                <tr>
                                    <td>21.</td>
                                    <td></td>
                                    <td></td>
                                    <td rowspan="2">21.</td>
                                    <td rowspan="2">22.</td>
                                </tr>
                                <tr>
                                    <td>22.</td>
                                    <td></td>
                                    <td></td>
                                </tr>

                                <tr>
                                    <td>23.</td>
                                    <td></td>
                                    <td></td>
                                    <td rowspan="2">23.</td>
                                    <td rowspan="2">24.</td>
                                </tr>
                                <tr>
                                    <td>24.</td>
                                    <td></td>
                                    <td></td>
                                </tr>

                                <tr>
                                    <td>25.</td>
                                    <td></td>
                                    <td></td>
                                    <td rowspan="2">25.</td>
                                    <td rowspan="2">26.</td>
                                </tr>
                                <tr>
                                    <td>26.</td>
                                    <td></td>
                                    <td></td>
                                </tr>

                                <tr>
                                    <td>27.</td>
                                    <td></td>
                                    <td></td>
                                    <td rowspan="2">27.</td>
                                    <td rowspan="2">28.</td>
                                </tr>
                                <tr>
                                    <td>28.</td>
                                    <td></td>
                                    <td></td>
                                </tr>

                                <tr>
                                    <td>29.</td>
                                    <td></td>
                                    <td></td>
                                    <td rowspan="2">29.</td>
                                    <td rowspan="2">30.</td>
                                </tr>
                                <tr>
                                    <td>30.</td>
                                    <td></td>
                                    <td></td>
                                </tr>

                            </tbody>
                        </table>
                    </div>

                </div>

                <div id="header"></div>

                <div class="col-md-12">
                    <div class="col-md-12">
                        {{-- <img src="" alt=""> --}}
                        <header class="text-center">
                            <h2>UNIVERSITAS PASIR PENGARAIAN</h2>
                            <h2>FAKULTAS ILMU KOMPUTER</h2>
                            <h2>PROGRAM STUDI SISTEM INFORMASI</h2>
                            <span>Jalan Tuanku Tambusai, Kumu Rambah Hilir, Telp. 085265853585 Kode Pos :
                                28557</span>
                        </header>
                    </div>
                    <div id="garis-tebal"></div>

                    <div class="col-md-12 text-center">
                        <h4>BERITA ACARA PELAKSANAAN {{ $title }} TUGAS AKHIR I</h4>
                    </div>

                    <p class="mt-5">
                        Pada hari ini
                        {{ $sempro->tanggal_seminar ? \Carbon\Carbon::parse($sempro->tanggal_seminar)->translatedFormat('l, d F Y') : '-' }}
                        Proposal Tugas Akhir atas nama :
                    </p>

                    <div class="col-md-12">
                        <table class="table">
                            <tbody>
                                <tr>
                                    <td style="width: 30%">NAMA</td>
                                    <td style="width: 1%">:</td>
                                    <td>{{ $sempro->judul->mahasiswa->name }}</td>
                                </tr>
                                <tr>
                                    <td>NIM</td>
                                    <td>:</td>
                                    <td>{{ $sempro->judul->mahasiswa->nim_or_nidn }}</td>
                                </tr>
                                <tr>
                                    <td>JUDUL PROPOSAL</td>
                                    <td>:</td>
                                    <td>{{ \Str::title($sempro->judul->judul) }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-12">
                        Dinyatakan :
                        <ul class="list-group list-group-numbered">
                            <li class="list-group-item">Diterima</li>
                            <li class="list-group-item">Ditolak</li>
                            <li class="list-group-item">Diseminar Ulang</li>
                        </ul>
                    </div>

                    <p class="mt-4">
                        Dengan catatan terlampir.
                    </p>

                    <p>
                        Demikian berita acara ini dibuat untuk dapat digunakan seperlunya. Ditetapkan di Pasir
                        Pengaraian
                        tanggal ...... bulan ...... tahun {{ date('Y') }}
                    </p>

                    <div class="col-md-12">
                        <table id="table" class="table text-center">
                            <thead id="thead">
                                <tr>
                                    <th>No</th>
                                    <th>NAMA</th>
                                    <th>JABATAN</th>
                                    <th>TANDA TANGAN</th>
                                </tr>
                            </thead>
                            <tbody id="tbody">
                                <tr>
                                    <td class="pb-4">1</td>
                                    <td>{{ $sempro->judul->pembimbing1->name ?? '-' }}</td>
                                    <td>KETUA</td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td class="pb-4">2</td>
                                    <td>{{ $sempro->judul->pembimbing2->name ?? '-' }}</td>
                                    <td>SEKRETARIS</td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td class="pb-4">3</td>
                                    <td>{{ $sempro->penguji1->name ?? '-' }}</td>
                                    <td>PENGUJI 1</td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td class="pb-4">4</td>
                                    <td>{{ $sempro->penguji2->name ?? '-' }}</td>
                                    <td>PENGUJI 2</td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td class="pb-4">5</td>
                                    <td>{{ $sempro->penguji3->name ?? '-' }}</td>
                                    <td>PENGUJI 3</td>
                                    <td></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div id="header"></div>

                <div class="col-md-12">
                    <div class="col-md-12">
                        {{-- <img src="" alt=""> --}}
                        <header class="text-center">
                            <h2>UNIVERSITAS PASIR PENGARAIAN</h2>
                            <h2>FAKULTAS ILMU KOMPUTER</h2>
                            <h2>PROGRAM STUDI SISTEM INFORMASI</h2>
                            <span>Jalan Tuanku Tambusai, Kumu Rambah Hilir, Telp. 085265853585 Kode Pos :
                                28557</span>
                        </header>
                        <div id="garis-tebal"></div>
                    </div>

                    <div class="col-md-12 text-center">
                        <h4>DAFTAR HADIR TIM PENGUJI</h4>
                        <h4>SIDANG PROPOSAL TUGAS AKHIR I</h4>
                    </div>

                    <div class="col-md-12">
                        <table class="table">
                            <tbody>
                                <tr>
                                    <td style="width: 30%">NAMA</td>
                                    <td style="width: 1%">:</td>
                                    <td>{{ $sempro->judul->mahasiswa->name }}</td>
                                </tr>
                                <tr>
                                    <td>NIM</td>
                                    <td>:</td>
                                    <td>{{ $sempro->judul->mahasiswa->nim_or_nidn }}</td>
                                </tr>
                                <tr>
                                    <td>JUDUL PROPOSAL</td>
                                    <td>:</td>
                                    <td>{{ \Str::title($sempro->judul->judul) }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="col-md-12">
                        <table id="table" class="table text-center">
                            <thead id="thead">
                                <tr>
                                    <th>No</th>
                                    <th>NAMA</th>
                                    <th>JABATAN</th>
                                    <th>TANDA TANGAN</th>
                                </tr>
                            </thead>
                            <tbody id="tbody">
                                <tr>
                                    <td class="pb-4">1</td>
                                    <td>{{ $sempro->judul->pembimbing1->name ?? '-' }}</td>
                                    <td>KETUA</td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td class="pb-4">2</td>
                                    <td>{{ $sempro->judul->pembimbing2->name ?? '-' }}</td>
                                    <td>SEKRETARIS</td>

                                    <td></td>
                                </tr>
                                <tr>
                                    <td class="pb-4">3</td>
                                    <td>{{ $sempro->penguji1->name ?? '-' }}</td>
                                    <td>PENGUJI 1</td>

                                    <td></td>
                                </tr>
                                <tr>
                                    <td class="pb-4">4</td>
                                    <td>{{ $sempro->penguji2->name ?? '-' }}</td>
                                    <td>PENGUJI 2</td>

                                    <td></td>
                                </tr>
                                <tr>
                                    <td class="pb-4">5</td>
                                    <td>{{ $sempro->penguji3->name ?? '-' }}</td>
                                    <td>PENGUJI 3</td>

                                    <td></td>
                                </tr>

                            </tbody>
                        </table>
                    </div>

                    <div class="col-md-6 offset-7">
                        <p>Pasir Pengaraian, ......................... {{ date('Y') }}</p>
                        <div>
                            <p class="m-0">Ketua/Sekretaris</p>
                            <p class="mb-5">Sidang Proposal TA</p>
                            <p class="m-0">...........................................</p>
                            <p class="m-0">NIDN. ...............................</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>

</html>
