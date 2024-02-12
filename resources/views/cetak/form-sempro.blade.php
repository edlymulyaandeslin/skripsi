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
                Atur margin sesuai kebutuhan
            }

            .col-md-6 {
                float: left;
                width: 50%;
                box-sizing: border-box;
            }
        </style>
    </head>

    <body>
        <div class="container-fluid">
            <div class="row">
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
                    Tanggal {{ $sempro->created_at->format('d F Y') }}
                </p>
                <div class="garis-putus-putus"></div>
                <div class="col-md-12 d-flex justify-content-center">
                    <table id="table" class="table caption-top">
                        <caption class="fw-bold">Ka. Program Studi Sistem Informasi telah memeriksa persyaratan seminar
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
                                <td>Teah lunas biaya ujian proposal TA</td>
                                <td>Fc. Slip Pembayaran</td>
                                <td></td>
                            </tr>

                            <tr>
                                <td rowspan="2">3</td>
                                <td rowspan="2">5 Rangkap Proposal TA yang sudah disetujui pembimbing 1 dan 2 dan 6
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

                <p class="text-end mt-2">No : ............./SI-FILKOM/............./............./{{ date('Y') }}
                </p>

                <p>Ketua Program Studi Sistem Informasi dengan ini mengusulkan kepada Dekan Fakultas Ilmu Komputer agar
                    nama-nama dibawah ini dibuatkan Surat Keputusan untuk menjadi tim Tim Penguji Proposal Tugas Akhir
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
                                <td>{{ $sempro->penguji1->name }}</td>
                                <td>{{ $sempro->penguji1->nim_or_nidn }}</td>
                            </tr>
                            <tr>
                                <td>Penguji 2</td>
                                <td>{{ $sempro->penguji2->name }}</td>
                                <td>{{ $sempro->penguji2->nim_or_nidn }}</td>
                            </tr>
                            <tr>
                                <td>Penguji 3</td>
                                <td>{{ $sempro->penguji3->name }}</td>
                                <td>{{ $sempro->penguji3->nim_or_nidn }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="col-md-12">

                    <div class="col-md-6">
                        <p>Yang akan dilaksanakan pada:</p>
                        <table class="table">
                            <tbody>
                                <tr>
                                    <td>Hari/Tanggal</td>
                                    <td>:</td>
                                    <td>{{ \Carbon\Carbon::parse($sempro->tanggal_seminar)->translatedFormat('l, d F Y') }}
                                    </td>
                                </tr>
                                <tr>
                                    <td>Tempat</td>
                                    <td>:</td>
                                    <td>filkom place</td>
                                </tr>
                                <tr>
                                    <td>Waktu</td>
                                    <td>:</td>
                                    <td>{{ \Carbon\Carbon::parse($sempro->jam)->format('H:i') }} WIB</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-6">
                        <p class="m-0">Pasir Pengaraian, ..................../...../{{ date('Y') }}</p>
                        <p class="mb-5">Ka. Program Studi Sistem Informasi</p>
                        <span>{{ $admin[0]->name ?? '-' }}</span>
                        <p>NIDN. {{ $admin[0]->nim_or_nidn ?? '-' }}</p>
                    </div>
                </div>

            </div>
        </div>
    </body>

</html>
