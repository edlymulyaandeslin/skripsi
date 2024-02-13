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
                            <span>Jalan Tuanku Tambusai, Kumu Rambah Hilir, Telp. 085265853585 Kode Pos :
                                28557</span>
                        </header>
                        <div id="garis-tebal"></div>
                    </div>

                    <div class="col-md-12 text-center">
                        <h4>REKAPITULASI PENILAIAN</h4>
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
                                    <th>NILAI</th>
                                    <th>TANDA TANGAN</th>
                                </tr>
                            </thead>
                            <tbody id="tbody">
                                <tr>
                                    <td class="pb-4">1</td>
                                    <td>{{ $sempro->judul->pembimbing1->name ?? '-' }}</td>
                                    <td>KETUA</td>
                                    <td>
                                        {{ $sempro->nilaisempro ? ($nilaipem1 = $sempro->nilaisempro->nilai1_pem1 + $sempro->nilaisempro->nilai2_pem1 + $sempro->nilaisempro->nilai3_pem1 + $sempro->nilaisempro->nilai4_pem1 + $sempro->nilaisempro->nilai5_pem1 + $sempro->nilaisempro->nilai6_pem1 + $sempro->nilaisempro->nilai7_pem1) : ($nilaipem1 = 0) }}
                                    </td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td class="pb-4">2</td>
                                    <td>{{ $sempro->judul->pembimbing2->name ?? '-' }}</td>
                                    <td>SEKRETARIS</td>
                                    <td>
                                        {{ $sempro->nilaisempro ? ($nilaipem2 = $sempro->nilaisempro->nilai1_pem2 + $sempro->nilaisempro->nilai2_pem2 + $sempro->nilaisempro->nilai3_pem2 + $sempro->nilaisempro->nilai4_pem2 + $sempro->nilaisempro->nilai5_pem2 + $sempro->nilaisempro->nilai6_pem2 + $sempro->nilaisempro->nilai7_pem2) : ($nilaipem2 = 0) }}
                                    </td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td class="pb-4">3</td>
                                    <td>{{ $sempro->penguji1->name ?? '-' }}</td>
                                    <td>PENGUJI 1</td>
                                    <td>
                                        {{ $sempro->nilaisempro ? ($nilaipeng1 = $sempro->nilaisempro->nilai1_peng1 + $sempro->nilaisempro->nilai2_peng1 + $sempro->nilaisempro->nilai3_peng1 + $sempro->nilaisempro->nilai4_peng1 + $sempro->nilaisempro->nilai5_peng1) : ($nilaipeng1 = 0) }}
                                    </td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td class="pb-4">4</td>
                                    <td>{{ $sempro->penguji2->name ?? '-' }}</td>
                                    <td>PENGUJI 2</td>
                                    <td>
                                        {{ $sempro->nilaisempro ? ($nilaipeng2 = $sempro->nilaisempro->nilai1_peng2 + $sempro->nilaisempro->nilai2_peng2 + $sempro->nilaisempro->nilai3_peng2 + $sempro->nilaisempro->nilai4_peng2 + $sempro->nilaisempro->nilai5_peng2) : ($nilaipeng2 = 0) }}
                                    </td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td class="pb-4">5</td>
                                    <td>{{ $sempro->penguji3->name ?? '-' }}</td>
                                    <td>PENGUJI 3</td>
                                    <td>
                                        {{ $sempro->nilaisempro ? ($nilaipeng3 = $sempro->nilaisempro->nilai1_peng3 + $sempro->nilaisempro->nilai2_peng3 + $sempro->nilaisempro->nilai3_peng3 + $sempro->nilaisempro->nilai4_peng3 + $sempro->nilaisempro->nilai5_peng3) : ($nilaipeng3 = 0) }}
                                    </td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <th colspan="3">Rata Rata</th>
                                    <td>{{ ($nilaipem1 + $nilaipem2 + $nilaipeng1 + $nilaipeng2 + $nilaipeng3) / 5 }}
                                    </td>
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
                        <h4>LEMBAR NILAI BIMBINGAN PROPOSAL TUGAS AKHIR</h4>
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
                        <table id="table" class="table">
                            <thead id="thead">
                                <tr class="text-center">
                                    <th colspan="2">Komponen Penilaian</th>
                                    <th>Kriteria Penilaian</th>
                                    <th>Rentang Nilai</th>
                                    <th>Nilai</th>
                                </tr>
                            </thead>
                            <tbody id="tbody" class="p-4">
                                <tr>
                                    <td rowspan="5">Pembuatan Proposal</td>
                                    <td>Pemilihan Tema</td>
                                    <td>Kemampuan memilih dan menjustifikasi Tema yang akan diangkat dari sisi Latar
                                        Belakang dan Rumusan Masalah</td>
                                    <td>0 - 15</td>
                                    <td>{{ $nilai1 = $sempro->nilaisempro->nilai1_pem1 ?? ($nilai1 = 0) }}</td>
                                </tr>
                                <tr>
                                    <td>Pertanyaan Penelitian</td>
                                    <td>Cara menyajikan pertanyaan penelitian/problem statement untuk membangun Rumusan
                                        Masalah dan Tujuan</td>
                                    <td>0 - 15</td>
                                    <td>{{ $nilai2 = $sempro->nilaisempro->nilai2_pem1 ?? ($nilai2 = 0) }}</td>
                                </tr>
                                <tr>
                                    <td rowspan="2">Studi Literatur</td>
                                    <td>Ide/gagasan/strategi untuk menyelesaikan masalah</td>
                                    <td>0 - 10</td>
                                    <td>{{ $nilai3 = $sempro->nilaisempro->nilai3_pem1 ?? ($nilai3 = 0) }}</td>
                                </tr>
                                <tr>
                                    <td>Justifikasi pemilihan model/ metode/ teori baik model simulasi, komputasi atau
                                        model
                                        pembangunan aplikasi/perangkat lunak dengan melakukan studi literatur</td>
                                    <td>0 - 10</td>
                                    <td>{{ $nilai4 = $sempro->nilaisempro->nilai4_pem1 ?? ($nilai4 = 0) }}</td>
                                </tr>
                                <tr>
                                    <td>Rencana Implementasi Simulasi/Komputasi</td>
                                    <td>Penjelasan tentang bagaimana membangun Implementasi/ Simulasi/ Komputasi yang
                                        diturunkan dari pemodelan</td>
                                    <td>0 - 10</td>
                                    <td>{{ $nilai5 = $sempro->nilaisempro->nilai5_pem1 ?? ($nilai5 = 0) }}</td>
                                </tr>
                                <tr>
                                    <td rowspan="2">Expert Judgement</td>
                                    <td colspan="2">Kemandirian mahasiswa dalam penyusunan proposal</td>
                                    <td>0 - 20</td>
                                    <td>{{ $nilai6 = $sempro->nilaisempro->nilai6_pem1 ?? ($nilai6 = 0) }}</td>
                                </tr>
                                <tr>
                                    <td colspan="2">Proses Bimbingan</td>
                                    <td>0 - 20</td>
                                    <td>{{ $nilai7 = $sempro->nilaisempro->nilai7_pem1 ?? ($nilai7 = 0) }}</td>
                                </tr>
                                <tr>
                                    <th colspan="3">Jumlah</th>
                                    <td>0 - 100</td>
                                    <td>{{ $nilai1 + $nilai2 + $nilai3 + $nilai4 + $nilai5 + $nilai6 + $nilai7 }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="col-md-6 offset-7">
                        <p>Pasir Pengaraian, ......................... {{ date('Y') }}</p>
                        <div>
                            <p class="mb-5">Pembimbing 1</p>
                            <p class="m-0">{{ $sempro->judul->pembimbing1->name ?? '-' }}</p>
                            <p class="m-0">NIDN. {{ $sempro->judul->pembimbing1->nim_or_nidn ?? '-' }}</p>
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
                            <span>Jalan Tuanku Tambusai, Kumu Rambah Hilir, Telp. 085265853585 Kode Pos :
                                28557</span>
                        </header>
                        <div id="garis-tebal"></div>
                    </div>

                    <div class="col-md-12 text-center">
                        <h4>LEMBAR NILAI BIMBINGAN PROPOSAL TUGAS AKHIR</h4>
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
                        <table id="table" class="table">
                            <thead id="thead">
                                <tr class="text-center">
                                    <th colspan="2">Komponen Penilaian</th>
                                    <th>Kriteria Penilaian</th>
                                    <th>Rentang Nilai</th>
                                    <th>Nilai</th>
                                </tr>
                            </thead>
                            <tbody id="tbody" class="p-4">
                                <tr>
                                    <td rowspan="5">Pembuatan Proposal</td>
                                    <td>Pemilihan Tema</td>
                                    <td>Kemampuan memilih dan menjustifikasi Tema yang akan diangkat dari sisi Latar
                                        Belakang dan Rumusan Masalah</td>
                                    <td>0 - 15</td>
                                    <td>{{ $nilai1 = $sempro->nilaisempro->nilai1_pem2 ?? ($nilai1 = 0) }}</td>
                                </tr>
                                <tr>
                                    <td>Pertanyaan Penelitian</td>
                                    <td>Cara menyajikan pertanyaan penelitian/problem statement untuk membangun Rumusan
                                        Masalah dan Tujuan</td>
                                    <td>0 - 15</td>
                                    <td>{{ $nilai2 = $sempro->nilaisempro->nilai2_pem2 ?? ($nilai2 = 0) }}</td>
                                </tr>
                                <tr>
                                    <td rowspan="2">Studi Literatur</td>
                                    <td>Ide/gagasan/strategi untuk menyelesaikan masalah</td>
                                    <td>0 - 10</td>
                                    <td>{{ $nilai3 = $sempro->nilaisempro->nilai3_pem2 ?? ($nilai3 = 0) }}</td>
                                </tr>
                                <tr>
                                    <td>Justifikasi pemilihan model/ metode/ teori baik model simulasi, komputasi atau
                                        model
                                        pembangunan aplikasi/perangkat lunak dengan melakukan studi literatur</td>
                                    <td>0 - 10</td>
                                    <td>{{ $nilai4 = $sempro->nilaisempro->nilai4_pem2 ?? ($nilai4 = 0) }}</td>
                                </tr>
                                <tr>
                                    <td>Rencana Implementasi Simulasi/Komputasi</td>
                                    <td>Penjelasan tentang bagaimana membangun Implementasi/ Simulasi/ Komputasi yang
                                        diturunkan dari pemodelan</td>
                                    <td>0 - 10</td>
                                    <td>{{ $nilai5 = $sempro->nilaisempro->nilai5_pem2 ?? ($nilai5 = 0) }}</td>
                                </tr>
                                <tr>
                                    <td rowspan="2">Expert Judgement</td>
                                    <td colspan="2">Kemandirian mahasiswa dalam penyusunan proposal</td>
                                    <td>0 - 20</td>
                                    <td>{{ $nilai6 = $sempro->nilaisempro->nilai6_pem2 ?? ($nilai6 = 0) }}</td>
                                </tr>
                                <tr>
                                    <td colspan="2">Proses Bimbingan</td>
                                    <td>0 - 20</td>
                                    <td>{{ $nilai7 = $sempro->nilaisempro->nilai7_pem2 ?? ($nilai7 = 0) }}</td>
                                </tr>
                                <tr>
                                    <th colspan="3">Jumlah</th>
                                    <td>0 - 100</td>
                                    <td>{{ $nilai1 + $nilai2 + $nilai3 + $nilai4 + $nilai5 + $nilai6 + $nilai7 }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="col-md-6 offset-7">
                        <p>Pasir Pengaraian, ......................... {{ date('Y') }}</p>
                        <div>
                            <p class="mb-5">Pembimbing 2</p>
                            <p class="m-0">{{ $sempro->judul->pembimbing2->name ?? '-' }}</p>
                            <p class="m-0">NIDN. {{ $sempro->judul->pembimbing2->nim_or_nidn ?? '-' }}</p>
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
                        <div id="garis-tebal"></div>
                    </div>

                    <div class="col-md-12 text-center">
                        <h4>LEMBAR NILAI SEMINAR PROPOSAL TUGAS AKHIR</h4>
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
                                <tr>
                                    <td>TANGGAL SEMINAR</td>
                                    <td>:</td>
                                    <td>{{ \Carbon\Carbon::parse($sempro->tanggal_seminar)->translatedFormat('d F Y') ?? '-' }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="col-md-12">
                        <table id="table" class="table">
                            <thead id="thead">
                                <tr class="text-center">
                                    <th>Komponen Penilaian</th>
                                    <th>Kriteria Penilaian</th>
                                    <th>Rentang Nilai</th>
                                    <th>Nilai</th>
                                </tr>
                            </thead>
                            <tbody id="tbody" class="p-4">
                                <tr>
                                    <td rowspan="3">Pembuatan Proposal</td>
                                    <td>Menjawab latar belakang permasalahan, perumusan masalah, tujuan dan metodologi
                                        secara terstruktur</td>
                                    <td>0 - 25</td>
                                    <td>{{ $nilai1 = $sempro->nilaisempro->nilai1_peng1 ?? ($nilai1 = 0) }}</td>
                                </tr>
                                <tr>
                                    <td>Menguasai teori pendukung TA</td>
                                    <td>0 - 15</td>
                                    <td>{{ $nilai2 = $sempro->nilaisempro->nilai2_peng1 ?? ($nilai2 = 0) }}</td>
                                </tr>
                                <tr>
                                    <td>Menguasai materi terkait dengan tools pemodelan, simulasi ataupun implementasi
                                    </td>
                                    <td>0 - 25</td>
                                    <td>{{ $nilai3 = $sempro->nilaisempro->nilai3_peng1 ?? ($nilai3 = 0) }}</td>
                                </tr>
                                <tr>
                                    <td rowspan="2">Expert Judgement</td>
                                    <td>Pemaparan/cara menjawab</td>
                                    <td>0 - 25</td>
                                    <td>{{ $nilai4 = $sempro->nilaisempro->nilai4_peng1 ?? ($nilai4 = 0) }}</td>
                                </tr>
                                <tr>
                                    <td>Komunikasi interpersonal</td>
                                    <td>0 - 25</td>
                                    <td>{{ $nilai5 = $sempro->nilaisempro->nilai5_peng1 ?? ($nilai5 = 0) }}</td>
                                </tr>
                                <tr>
                                    <th colspan="2">Jumlah</th>
                                    <td>0 - 100</td>
                                    <td>{{ $nilai1 + $nilai2 + $nilai3 + $nilai4 + $nilai5 }}</td>
                                </tr>
                                <tr>
                                    <th colspan="2">Rata-rata nilai Calon Pembimbing</th>
                                    <td colspan="2"></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="col-md-6 offset-7">
                        <p>Pasir Pengaraian, ......................... {{ date('Y') }}</p>
                        <div>
                            <p class="mb-5">Penguji 1</p>
                            <p class="m-0">{{ $sempro->penguji1->name ?? '-' }}</p>
                            <p class="m-0">NIDN. {{ $sempro->penguji1->nim_or_nidn ?? '-' }}</p>
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
                        <div id="garis-tebal"></div>
                    </div>

                    <div class="col-md-12 text-center">
                        <h4>LEMBAR NILAI SEMINAR PROPOSAL TUGAS AKHIR</h4>
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
                                <tr>
                                    <td>TANGGAL SEMINAR</td>
                                    <td>:</td>
                                    <td>{{ \Carbon\Carbon::parse($sempro->tanggal_seminar)->translatedFormat('d F Y') ?? '-' }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="col-md-12">
                        <table id="table" class="table">
                            <thead id="thead">
                                <tr class="text-center">
                                    <th>Komponen Penilaian</th>
                                    <th>Kriteria Penilaian</th>
                                    <th>Rentang Nilai</th>
                                    <th>Nilai</th>
                                </tr>
                            </thead>
                            <tbody id="tbody" class="p-4">
                                <tr>
                                    <td rowspan="3">Pembuatan Proposal</td>
                                    <td>Menjawab latar belakang permasalahan, perumusan masalah, tujuan dan metodologi
                                        secara terstruktur</td>
                                    <td>0 - 25</td>
                                    <td>{{ $nilai1 = $sempro->nilaisempro->nilai1_peng2 ?? ($nilai1 = 0) }}</td>
                                </tr>
                                <tr>
                                    <td>Menguasai teori pendukung TA</td>
                                    <td>0 - 15</td>
                                    <td>{{ $nilai2 = $sempro->nilaisempro->nilai2_peng2 ?? ($nilai2 = 0) }}</td>
                                </tr>
                                <tr>
                                    <td>Menguasai materi terkait dengan tools pemodelan, simulasi ataupun implementasi
                                    </td>
                                    <td>0 - 25</td>
                                    <td>{{ $nilai3 = $sempro->nilaisempro->nilai3_peng2 ?? ($nilai3 = 0) }}</td>
                                </tr>
                                <tr>
                                    <td rowspan="2">Expert Judgement</td>
                                    <td>Pemaparan/cara menjawab</td>
                                    <td>0 - 25</td>
                                    <td>{{ $nilai4 = $sempro->nilaisempro->nilai4_peng2 ?? ($nilai4 = 0) }}</td>
                                </tr>
                                <tr>
                                    <td>Komunikasi interpersonal</td>
                                    <td>0 - 25</td>
                                    <td>{{ $nilai5 = $sempro->nilaisempro->nilai5_peng2 ?? ($nilai5 = 0) }}</td>
                                </tr>
                                <tr>
                                    <th colspan="2">Jumlah</th>
                                    <td>0 - 100</td>
                                    <td>{{ $nilai1 + $nilai2 + $nilai3 + $nilai4 + $nilai5 }}</td>
                                </tr>
                                <tr>
                                    <th colspan="2">Rata-rata nilai Calon Pembimbing</th>
                                    <td colspan="2"></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="col-md-6 offset-7">
                        <p>Pasir Pengaraian, ......................... {{ date('Y') }}</p>
                        <div>
                            <p class="mb-5">Penguji 2</p>
                            <p class="m-0">{{ $sempro->penguji2->name ?? '-' }}</p>
                            <p class="m-0">NIDN. {{ $sempro->penguji2->nim_or_nidn ?? '-' }}</p>
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
                        <div id="garis-tebal"></div>
                    </div>

                    <div class="col-md-12 text-center">
                        <h4>LEMBAR NILAI SEMINAR PROPOSAL TUGAS AKHIR</h4>
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
                                <tr>
                                    <td>TANGGAL SEMINAR</td>
                                    <td>:</td>
                                    <td>{{ \Carbon\Carbon::parse($sempro->tanggal_seminar)->translatedFormat('d F Y') }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="col-md-12">
                        <table id="table" class="table">
                            <thead id="thead">
                                <tr class="text-center">
                                    <th>Komponen Penilaian</th>
                                    <th>Kriteria Penilaian</th>
                                    <th>Rentang Nilai</th>
                                    <th>Nilai</th>
                                </tr>
                            </thead>
                            <tbody id="tbody" class="p-4">
                                <tr>
                                    <td rowspan="3">Pembuatan Proposal</td>
                                    <td>Menjawab latar belakang permasalahan, perumusan masalah, tujuan dan metodologi
                                        secara terstruktur</td>
                                    <td>0 - 25</td>
                                    <td>{{ $nilai1 = $sempro->nilaisempro->nilai1_peng3 ?? ($nilai1 = 0) }}</td>
                                </tr>
                                <tr>
                                    <td>Menguasai teori pendukung TA</td>
                                    <td>0 - 15</td>
                                    <td>{{ $nilai2 = $sempro->nilaisempro->nilai2_peng3 ?? ($nilai2 = 0) }}</td>
                                </tr>
                                <tr>
                                    <td>Menguasai materi terkait dengan tools pemodelan, simulasi ataupun implementasi
                                    </td>
                                    <td>0 - 25</td>
                                    <td>{{ $nilai3 = $sempro->nilaisempro->nilai3_peng3 ?? ($nilai3 = 0) }}</td>
                                </tr>
                                <tr>
                                    <td rowspan="2">Expert Judgement</td>
                                    <td>Pemaparan/cara menjawab</td>
                                    <td>0 - 25</td>
                                    <td>{{ $nilai4 = $sempro->nilaisempro->nilai4_peng3 ?? ($nilai4 = 0) }}</td>
                                </tr>
                                <tr>
                                    <td>Komunikasi interpersonal</td>
                                    <td>0 - 25</td>
                                    <td>{{ $nilai5 = $sempro->nilaisempro->nilai5_peng3 ?? ($nilai5 = 0) }}</td>
                                </tr>
                                <tr>
                                    <th colspan="2">Jumlah</th>
                                    <td>0 - 100</td>
                                    <td>{{ $nilai1 + $nilai2 + $nilai3 + $nilai4 + $nilai5 }}</td>
                                </tr>
                                <tr>
                                    <th colspan="2">Rata-rata nilai Calon Pembimbing</th>
                                    <td colspan="2"></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="col-md-6 offset-7">
                        <p>Pasir Pengaraian, ......................... {{ date('Y') }}</p>
                        <div>
                            <p class="mb-5">Penguji 3</p>
                            <p class="m-0">{{ $sempro->penguji3->name ?? '-' }}</p>
                            <p class="m-0">NIDN. {{ $sempro->penguji3->nim_or_nidn ?? '-' }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>

</html>
