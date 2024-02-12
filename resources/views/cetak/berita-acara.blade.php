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
                    <h4>BERITA ACARA PELAKSANAAN {{ $title }} TUGAS AKHIR I</h4>
                </div>

                <p class="mt-5">
                    Pada hari ini, {{ \Carbon\Carbon::parse($sempro->tanggal_seminar)->translatedFormat('l, d F Y') }}
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
                                <td>{{ $sempro->judul->judul }}</td>
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
                    Demikian berita acara ini dibuat untuk dapat digunakan seperlunya. Ditetapkan di Pasir Pengaraian
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
                                <td>{{ $sempro->judul->pembimbing1->name }}</td>
                                <td>KETUA</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td class="pb-4">2</td>
                                <td>{{ $sempro->judul->pembimbing2->name }}</td>
                                <td>SEKRETARIS</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td class="pb-4">3</td>
                                <td>{{ $sempro->penguji1->name }}</td>
                                <td>PENGUJI 1</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td class="pb-4">4</td>
                                <td>{{ $sempro->penguji2->name }}</td>
                                <td>PENGUJI 2</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td class="pb-4">5</td>
                                <td>{{ $sempro->penguji3->name }}</td>
                                <td>PENGUJI 3</td>
                                <td></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </body>

</html>
