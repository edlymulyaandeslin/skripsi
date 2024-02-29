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

            #berita tr td {
                padding-bottom: 60px;
                border-bottom: 1px solid black
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

            #tableheader {
                width: 100%;
            }

            #tableheader #td {
                text-align: center;
            }
        </style>
    </head>

    <body>
        <div class="container-fluid">
            <div class="row">

                <div class="col-md-12">
                    <div class="col-md-12">
                        <table id="tableheader">
                            <tr>
                                <td id="td"><img
                                        src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('img/upp.png'))) }}"
                                        width="140px" alt="404"></td>
                                <td id="td">
                                    <h2>UNIVERSITAS PASIR PENGARAIAN</h2>
                                    <h2>FAKULTAS ILMU KOMPUTER</h2>
                                    <h2>PROGRAM STUDI SISTEM INFORMASI</h2>
                                    <span>Jalan Tuanku Tambusai, Kumu Rambah Hilir, Telp. 085265853585 Kode Pos :
                                        28557</span>
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div id="garis-tebal"></div>

                    <div class="col-md-12 text-center">
                        <h4>BERITA ACARA</h4>
                        <h4>UJIAN KOMPREHENSIF</h4>
                        <h4>TAHUN AKADEMIK {{ \Carbon\Carbon::now()->year }} / {{ \Carbon\Carbon::now()->year + 1 }}
                        </h4>
                    </div>

                    <p class="m-0">
                        Pada
                    </p>

                    <div class="col-md-12">
                        <table class="table">
                            <tbody>
                                <tr>
                                    <td style="width: 20%">Hari/Tanggal</td>
                                    <td style="width: 1%">:</td>
                                    <td>{{ \Carbon\Carbon::parse($kompre->tanggal_seminar)->translatedFormat('l, d F Y') ?? '-' }}
                                    </td>
                                </tr>
                                <tr>
                                    <td>Pukul</td>
                                    <td style="width: 1%">:</td>
                                    <td>{{ \Carbon\Carbon::parse($kompre->jam)->translatedFormat('H:i') . ' WIB' ?? '-' }}
                                    </td>
                                </tr>
                                <tr>
                                    <td>Ruang</td>
                                    <td style="width: 1%">:</td>
                                    <td>{{ $kompre->ruang }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <p>Program Studi Sistem Informasi Fakultas Ilmu Komputer Universitas Pasir Pengaraian telah
                        melaksanakan ujian komprehensif atas nama mahasiswa.</p>
                    <div class="col-md-12">
                        <table class="table">
                            <tbody>
                                <tr>
                                    <td style="width: 20%">Nama</td>
                                    <td style="width: 1%">:</td>
                                    <td>{{ $kompre->judul->mahasiswa->name }}</td>
                                </tr>
                                <tr>
                                    <td>NIM</td>
                                    <td>:</td>
                                    <td>{{ $kompre->judul->mahasiswa->nim_or_nidn }}</td>
                                </tr>
                                <tr>
                                    <td>Judul Skripsi</td>
                                    <td>:</td>
                                    <td>{{ \Str::title($kompre->judul->judul) }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <p>
                        Demikian berita acara ini dibuat dengan sesungguhnya dan sebenar-benarnya untuk digunakan
                        sebagaimana mestinya.
                    </p>

                    <div class="col-md-12 text-end">
                        <p class="me-4">
                            Pasir Pengaraian,
                            {{ \Carbon\Carbon::parse($kompre->tanggal_seminar)->translatedFormat('d F Y') ?? '-' }}
                        </p>
                    </div>

                    <div class="col-md-12">
                        <table class="table text-center">
                            <thead>

                                <tr>
                                    <th style="width: 50%">Penguji</th>
                                    <th>Tanda Tangan</th>
                                </tr>
                            </thead>
                            <tbody id="berita">
                                <tr>
                                    <th rowspan="2">Komisi Pembimbing</th>
                                    <td class="text-start">1.</td>
                                </tr>
                                <tr>
                                    <td class="text-start">2.</td>
                                </tr>
                                <tr>
                                    <th rowspan="3">Komisi Penguji Luar Pembimbing</th>
                                    <td class="text-center">(Ketua Penguji)</td>
                                </tr>
                                <tr>
                                    <td class="text-center">(Anggota Penguji)</td>
                                </tr>
                                <tr>
                                    <td class="text-center">(Anggota Penguji)</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div id="header"></div>

                <div class="col-md-12">
                    <div class="col-md-12">
                        <table id="tableheader">
                            <tr>
                                <td id="td"><img
                                        src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('img/upp.png'))) }}"
                                        width="140px" alt="404"></td>
                                <td id="td">
                                    <h2>UNIVERSITAS PASIR PENGARAIAN</h2>
                                    <h2>FAKULTAS ILMU KOMPUTER</h2>
                                    <h2>PROGRAM STUDI SISTEM INFORMASI</h2>
                                    <span>Jalan Tuanku Tambusai, Kumu Rambah Hilir, Telp. 085265853585 Kode Pos :
                                        28557</span>
                                </td>
                            </tr>
                        </table>
                        <div id="garis-tebal"></div>
                    </div>

                    <div class="col-md-12 text-center">
                        <h4>REKAPITULASI NILAI</h4>
                        <h4>UJIAN KOMPREHENSIF</h4>
                        <h4>TAHUN AKADEMIK {{ \Carbon\Carbon::now()->year }} / {{ \Carbon\Carbon::now()->year + 1 }}
                        </h4>
                    </div>

                    <p class="m-0">
                        Penguji Ujian Komprehensif Program Studi S1 Sistem Informasi telah mengadakan ujian komprehensif
                        pada:
                    </p>

                    <div class="col-md-12">
                        <table class="table">
                            <tbody>
                                <tr>
                                    <td style="width: 20%">Hari</td>
                                    <td style="width: 1%">:</td>
                                    <td>{{ \Carbon\Carbon::parse($kompre->tanggal_seminar)->translatedFormat('l') ?? '-' }}
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width: 20%">Tanggal</td>
                                    <td style="width: 1%">:</td>
                                    <td>{{ \Carbon\Carbon::parse($kompre->tanggal_seminar)->translatedFormat('d F Y') ?? '-' }}
                                    </td>
                                </tr>

                            </tbody>
                        </table>
                    </div>
                    <p>Atas nama mahasiswa:</p>
                    <div class="col-md-12">
                        <table class="table">
                            <tbody>
                                <tr>
                                    <td style="width: 20%">Nama</td>
                                    <td style="width: 1%">:</td>
                                    <td>{{ $kompre->judul->mahasiswa->name }}</td>
                                </tr>
                                <tr>
                                    <td>NIM</td>
                                    <td>:</td>
                                    <td>{{ $kompre->judul->mahasiswa->nim_or_nidn }}</td>
                                </tr>
                                <tr>
                                    <td>Judul Proposal</td>
                                    <td>:</td>
                                    <td>{{ \Str::title($kompre->judul->judul) }}</td>
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
                                    <th>NILAI</th>
                                    <th>TANDA TANGAN</th>
                                </tr>
                            </thead>
                            <tbody id="tbody">
                                <tr>
                                    <td class="pb-4">1</td>
                                    <td>{{ $kompre->judul->pembimbing1->name ?? '-' }}</td>
                                    <td>
                                        {{ $kompre->nilaikompre ? ($nilaipem1 = ($kompre->nilaikompre->nilai1_pem1 + $kompre->nilaikompre->nilai2_pem1 + $kompre->nilaikompre->nilai3_pem1 + $kompre->nilaikompre->nilai4_pem1) / 5) : ($nilaipem1 = 0) }}
                                    </td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td class="pb-4">2</td>
                                    <td>{{ $kompre->judul->pembimbing2->name ?? '-' }}</td>
                                    <td>
                                        {{ $kompre->nilaikompre ? ($nilaipem2 = ($kompre->nilaikompre->nilai1_pem2 + $kompre->nilaikompre->nilai2_pem2 + $kompre->nilaikompre->nilai3_pem2 + $kompre->nilaikompre->nilai4_pem2) / 5) : ($nilaipem2 = 0) }}
                                    </td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td class="pb-4">3</td>
                                    <td>{{ $kompre->penguji1->name ?? '-' }}</td>
                                    <td>
                                        {{ $kompre->nilaikompre ? ($nilaipeng1 = ($kompre->nilaikompre->nilai1_peng1 + $kompre->nilaikompre->nilai2_peng1 + $kompre->nilaikompre->nilai3_peng1 + $kompre->nilaikompre->nilai4_peng1) / 5) : ($nilaipeng1 = 0) }}
                                    </td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td class="pb-4">4</td>
                                    <td>{{ $kompre->penguji2->name ?? '-' }}</td>
                                    <td>
                                        {{ $kompre->nilaikompre ? ($nilaipeng2 = ($kompre->nilaikompre->nilai1_peng2 + $kompre->nilaikompre->nilai2_peng2 + $kompre->nilaikompre->nilai3_peng2 + $kompre->nilaikompre->nilai4_peng2) / 5) : ($nilaipeng2 = 0) }}
                                    </td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td class="pb-4">5</td>
                                    <td>{{ $kompre->penguji3->name ?? '-' }}</td>
                                    <td>
                                        {{ $kompre->nilaikompre ? ($nilaipeng3 = ($kompre->nilaikompre->nilai1_peng3 + $kompre->nilaikompre->nilai2_peng3 + $kompre->nilaikompre->nilai3_peng3 + $kompre->nilaikompre->nilai4_peng3) / 5) : ($nilaipeng3 = 0) }}
                                    </td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <th colspan="2">Rata Rata</th>
                                    <td>{{ ($nilaipem1 + $nilaipem2 + $nilaipeng1 + $nilaipeng2 + $nilaipeng3) / 5 }}
                                    </td>
                                    <td style="background-color: grey;"></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <p>Hasil : <span class="fw-bold">LAYAK/TIDAK LAYAK</span></p>

                    <div class="col-md-6 offset-7">
                        <p>Pasir Pengaraian, ......................... {{ date('Y') }}</p>
                        <div>
                            <p class="mb-5">Ketua Penguji</p>
                            <p class="m-0">................................</p>
                        </div>
                    </div>
                </div>

                <div id="header"></div>

                <div class="col-md-12">
                    <div class="col-md-12">
                        <table id="tableheader">
                            <tr>
                                <td id="td"><img
                                        src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('img/upp.png'))) }}"
                                        width="140px" alt="404"></td>
                                <td id="td">
                                    <h2>UNIVERSITAS PASIR PENGARAIAN</h2>
                                    <h2>FAKULTAS ILMU KOMPUTER</h2>
                                    <h2>PROGRAM STUDI SISTEM INFORMASI</h2>
                                    <span>Jalan Tuanku Tambusai, Kumu Rambah Hilir, Telp. 085265853585 Kode Pos :
                                        28557</span>
                                </td>
                            </tr>
                        </table>
                        <div id="garis-tebal"></div>
                    </div>

                    <div class="col-md-12 text-center">
                        <h4>FORMAT PENILAIAN</h4>
                        <h4>UJIAN KOMPREHENSIF</h4>
                        <h4>TAHUN AKADEMIK {{ \Carbon\Carbon::now()->year }} / {{ \Carbon\Carbon::now()->year + 1 }}
                        </h4>
                    </div>

                    <div class="col-md-12">
                        <table class="table">
                            <tbody>
                                <tr>
                                    <td style="width: 30%">NAMA</td>
                                    <td style="width: 1%">:</td>
                                    <td>{{ $kompre->judul->mahasiswa->name }}</td>
                                </tr>
                                <tr>
                                    <td>NIM</td>
                                    <td>:</td>
                                    <td>{{ $kompre->judul->mahasiswa->nim_or_nidn }}</td>
                                </tr>
                                <tr>
                                    <td>JUDUL PROPOSAL</td>
                                    <td>:</td>
                                    <td>{{ \Str::title($kompre->judul->judul) }}</td>
                                </tr>
                                <tr>
                                    <td>PENGUJI I</td>
                                    <td>:</td>
                                    <td>{{ $kompre->judul->pembimbing1->name }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="col-md-12">
                        <table class="table" id="table">
                            <thead id="thead" class="text-center align-middle">
                                <tr>
                                    <th>No</th>
                                    <th style="width: 50%">Aspek Penilaian</th>
                                    <th>Bobot</th>
                                    <th>Nilai</th>
                                    <th>Nilai x Bobot</th>
                                </tr>
                            </thead>
                            <tbody id="tbody">
                                <tr>
                                    <td rowspan="3" class="text-center">1.</td>
                                    <td>Penguasaan Penelitian:</td>
                                    <td rowspan="3" class="text-center align-middle">{{ $bobot->bobot1 }}</td>
                                    <td rowspan="3" class="text-center align-middle">
                                        {{ $kompre->nilaikompre->nilai1_pem1 / $bobot->bobot1 }}
                                    </td>
                                    <td rowspan="3" class="text-center align-middle">
                                        {{ $nilai1_pem1 = $kompre->nilaikompre->nilai1_pem1 }}
                                    </td>
                                </tr>
                                <tr>
                                    <td>a. Sistematika penulisan</td>
                                </tr>
                                <tr>
                                    <td>b. Ketepatan penggunaan bahasa</td>
                                </tr>
                                <tr>
                                    <td rowspan="10" class="text-center">2.</td>
                                    <td>Segi Ilmiah Tulisan:</td>
                                    <td rowspan="10" class="text-center align-middle">{{ $bobot->bobot2 }}</td>
                                    <td rowspan="10" class="text-center align-middle">
                                        {{ $kompre->nilaikompre->nilai2_pem1 / $bobot->bobot2 }}
                                    </td>
                                    <td rowspan="10" class="text-center align-middle">
                                        {{ $nilai2_pem1 = $kompre->nilaikompre->nilai2_pem1 }}
                                    </td>
                                </tr>
                                <tr>
                                    <td>a. Kesesuaian judul</td>
                                </tr>
                                <tr>
                                    <td>b. Ketepatan latar belakang masalah</td>
                                </tr>
                                <tr>
                                    <td>c. Rumusan masalah</td>
                                </tr>
                                <tr>
                                    <td>d. Tujuan dan manfaat penelitian</td>
                                </tr>
                                <tr>
                                    <td>e. Keaslian penelitian</td>
                                </tr>
                                <tr>
                                    <td>f. Ketepatan tinjauan pustaka</td>
                                </tr>
                                <tr>
                                    <td>g. Perumusan hipotesis</td>
                                </tr>
                                <tr>
                                    <td>h. Penggunaan metode penelitian</td>
                                </tr>
                                <tr>
                                    <td>i. Penggunaan kepustakaan</td>
                                </tr>
                                <tr>
                                    <td rowspan="5" class="text-center">3.</td>
                                    <td>Kemampuan Penyajian:</td>
                                    <td rowspan="5" class="text-center align-middle">{{ $bobot->bobot3 }}</td>
                                    <td rowspan="5" class="text-center align-middle">
                                        {{ $kompre->nilaikompre->nilai3_pem1 / $bobot->bobot3 }}
                                    </td>
                                    <td rowspan="5" class="text-center align-middle">
                                        {{ $nilai3_pem1 = $kompre->nilaikompre->nilai3_pem1 }}

                                    </td>
                                </tr>
                                <tr>
                                    <td>a. Kemampuan mengemukakan konsep dan teori</td>
                                </tr>
                                <tr>
                                    <td>b. Kemampuan berbicara dengan jelas</td>
                                </tr>
                                <tr>
                                    <td>c. Kemampuan mengajukan materi secara sistematis</td>
                                </tr>
                                <tr>
                                    <td>d. Kemampuan teknik penyajian secara keseluruhan</td>
                                </tr>
                                <tr>
                                    <td rowspan="5" class="text-center">4.</td>
                                    <td>Kemampuan berdiskusi</td>
                                    <td rowspan="5" class="text-center align-middle">{{ $bobot->bobot4 }}</td>
                                    <td rowspan="5" class="text-center align-middle">
                                        {{ $kompre->nilaikompre->nilai4_pem1 / $bobot->bobot4 }}
                                    </td>
                                    <td rowspan="5" class="text-center align-middle">
                                        {{ $nilai4_pem1 = $kompre->nilaikompre->nilai4_pem1 }}
                                    </td>
                                </tr>
                                <tr>
                                    <td>a. Kemampuan komunikasi</td>
                                </tr>
                                <tr>
                                    <td>b. Kemampuan menjawab dengan tepat</td>
                                </tr>
                                <tr>
                                    <td>c. Kemampuan mengendalikan emosi</td>
                                </tr>
                                <tr>
                                    <td>d. Kemampuan mengemukakan pendapat</td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <th class="text-center">Jumlah Nilai</th>
                                    <td colspan="3" class="text-center">
                                        {{ ($nilai1_pem1 + $nilai2_pem1 + $nilai3_pem1 + $nilai4_pem1) / 5 }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div id="header"></div>

                <div class="col-md-12">
                    <div class="col-md-12">
                        <table id="tableheader">
                            <tr>
                                <td id="td"><img
                                        src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('img/upp.png'))) }}"
                                        width="140px" alt="404"></td>
                                <td id="td">
                                    <h2>UNIVERSITAS PASIR PENGARAIAN</h2>
                                    <h2>FAKULTAS ILMU KOMPUTER</h2>
                                    <h2>PROGRAM STUDI SISTEM INFORMASI</h2>
                                    <span>Jalan Tuanku Tambusai, Kumu Rambah Hilir, Telp. 085265853585 Kode Pos :
                                        28557</span>
                                </td>
                            </tr>
                        </table>
                        <div id="garis-tebal"></div>
                    </div>

                    <div class="col-md-12 text-center">
                        <h4>FORMAT PENILAIAN</h4>
                        <h4>UJIAN KOMPREHENSIF</h4>
                        <h4>TAHUN AKADEMIK {{ \Carbon\Carbon::now()->year }} / {{ \Carbon\Carbon::now()->year + 1 }}
                        </h4>
                    </div>

                    <div class="col-md-12">
                        <table class="table">
                            <tbody>
                                <tr>
                                    <td style="width: 30%">NAMA</td>
                                    <td style="width: 1%">:</td>
                                    <td>{{ $kompre->judul->mahasiswa->name }}</td>
                                </tr>
                                <tr>
                                    <td>NIM</td>
                                    <td>:</td>
                                    <td>{{ $kompre->judul->mahasiswa->nim_or_nidn }}</td>
                                </tr>
                                <tr>
                                    <td>JUDUL PROPOSAL</td>
                                    <td>:</td>
                                    <td>{{ \Str::title($kompre->judul->judul) }}</td>
                                </tr>
                                <tr>
                                    <td>PENGUJI II</td>
                                    <td>:</td>
                                    <td>{{ $kompre->judul->pembimbing2->name }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="col-md-12">

                        <table class="table" id="table">
                            <thead id="thead" class="text-center align-middle">
                                <tr>
                                    <th>No</th>
                                    <th style="width: 50%">Aspek Penilaian</th>
                                    <th>Bobot</th>
                                    <th>Nilai</th>
                                    <th>Nilai x Bobot</th>
                                </tr>
                            </thead>
                            <tbody id="tbody">
                                <tr>
                                    <td rowspan="3" class="text-center">1.</td>
                                    <td>Penguasaan Penelitian:</td>
                                    <td rowspan="3" class="text-center align-middle">{{ $bobot->bobot1 }}</td>
                                    <td rowspan="3" class="text-center align-middle">
                                        {{ $kompre->nilaikompre->nilai1_pem2 / $bobot->bobot1 }}
                                    </td>
                                    <td rowspan="3" class="text-center align-middle">
                                        {{ $nilai1_pem2 = $kompre->nilaikompre->nilai1_pem2 }}
                                    </td>
                                </tr>
                                <tr>
                                    <td>a. Sistematika penulisan</td>
                                </tr>
                                <tr>
                                    <td>b. Ketepatan penggunaan bahasa</td>
                                </tr>
                                <tr>
                                    <td rowspan="10" class="text-center">2.</td>
                                    <td>Segi Ilmiah Tulisan:</td>
                                    <td rowspan="10" class="text-center align-middle">{{ $bobot->bobot2 }}</td>
                                    <td rowspan="10" class="text-center align-middle">
                                        {{ $kompre->nilaikompre->nilai2_pem2 / $bobot->bobot2 }}
                                    </td>
                                    <td rowspan="10" class="text-center align-middle">
                                        {{ $nilai2_pem2 = $kompre->nilaikompre->nilai2_pem2 }}
                                    </td>
                                </tr>
                                <tr>
                                    <td>a. Kesesuaian judul</td>
                                </tr>
                                <tr>
                                    <td>b. Ketepatan latar belakang masalah</td>
                                </tr>
                                <tr>
                                    <td>c. Rumusan masalah</td>
                                </tr>
                                <tr>
                                    <td>d. Tujuan dan manfaat penelitian</td>
                                </tr>
                                <tr>
                                    <td>e. Keaslian penelitian</td>
                                </tr>
                                <tr>
                                    <td>f. Ketepatan tinjauan pustaka</td>
                                </tr>
                                <tr>
                                    <td>g. Perumusan hipotesis</td>
                                </tr>
                                <tr>
                                    <td>h. Penggunaan metode penelitian</td>
                                </tr>
                                <tr>
                                    <td>i. Penggunaan kepustakaan</td>
                                </tr>
                                <tr>
                                    <td rowspan="5" class="text-center">3.</td>
                                    <td>Kemampuan Penyajian:</td>
                                    <td rowspan="5" class="text-center align-middle">{{ $bobot->bobot3 }}</td>
                                    <td rowspan="5" class="text-center align-middle">
                                        {{ $kompre->nilaikompre->nilai3_pem2 / $bobot->bobot3 }}
                                    </td>
                                    <td rowspan="5" class="text-center align-middle">
                                        {{ $nilai3_pem2 = $kompre->nilaikompre->nilai3_pem2 }}

                                    </td>
                                </tr>
                                <tr>
                                    <td>a. Kemampuan mengemukakan konsep dan teori</td>
                                </tr>
                                <tr>
                                    <td>b. Kemampuan berbicara dengan jelas</td>
                                </tr>
                                <tr>
                                    <td>c. Kemampuan mengajukan materi secara sistematis</td>
                                </tr>
                                <tr>
                                    <td>d. Kemampuan teknik penyajian secara keseluruhan</td>
                                </tr>
                                <tr>
                                    <td rowspan="5" class="text-center">4.</td>
                                    <td>Kemampuan berdiskusi</td>
                                    <td rowspan="5" class="text-center align-middle">{{ $bobot->bobot4 }}</td>
                                    <td rowspan="5" class="text-center align-middle">
                                        {{ $kompre->nilaikompre->nilai4_pem2 / $bobot->bobot4 }}
                                    </td>
                                    <td rowspan="5" class="text-center align-middle">
                                        {{ $nilai4_pem2 = $kompre->nilaikompre->nilai4_pem2 }}
                                    </td>
                                </tr>
                                <tr>
                                    <td>a. Kemampuan komunikasi</td>
                                </tr>
                                <tr>
                                    <td>b. Kemampuan menjawab dengan tepat</td>
                                </tr>
                                <tr>
                                    <td>c. Kemampuan mengendalikan emosi</td>
                                </tr>
                                <tr>
                                    <td>d. Kemampuan mengemukakan pendapat</td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <th class="text-center">Jumlah Nilai</th>
                                    <td colspan="3" class="text-center">
                                        {{ ($nilai1_pem2 + $nilai2_pem2 + $nilai3_pem2 + $nilai4_pem2) / 5 }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div id="header"></div>

                <div class="col-md-12">
                    <div class="col-md-12">
                        <table id="tableheader">
                            <tr>
                                <td id="td"><img
                                        src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('img/upp.png'))) }}"
                                        width="140px" alt="404"></td>
                                <td id="td">
                                    <h2>UNIVERSITAS PASIR PENGARAIAN</h2>
                                    <h2>FAKULTAS ILMU KOMPUTER</h2>
                                    <h2>PROGRAM STUDI SISTEM INFORMASI</h2>
                                    <span>Jalan Tuanku Tambusai, Kumu Rambah Hilir, Telp. 085265853585 Kode Pos :
                                        28557</span>
                                </td>
                            </tr>
                        </table>
                        <div id="garis-tebal"></div>
                    </div>

                    <div class="col-md-12 text-center">
                        <h4>FORMAT PENILAIAN</h4>
                        <h4>UJIAN KOMPREHENSIF</h4>
                        <h4>TAHUN AKADEMIK {{ \Carbon\Carbon::now()->year }} / {{ \Carbon\Carbon::now()->year + 1 }}
                        </h4>
                    </div>

                    <div class="col-md-12">
                        <table class="table">
                            <tbody>
                                <tr>
                                    <td style="width: 30%">NAMA</td>
                                    <td style="width: 1%">:</td>
                                    <td>{{ $kompre->judul->mahasiswa->name }}</td>
                                </tr>
                                <tr>
                                    <td>NIM</td>
                                    <td>:</td>
                                    <td>{{ $kompre->judul->mahasiswa->nim_or_nidn }}</td>
                                </tr>
                                <tr>
                                    <td>JUDUL PROPOSAL</td>
                                    <td>:</td>
                                    <td>{{ \Str::title($kompre->judul->judul) }}</td>
                                </tr>
                                <tr>
                                    <td>PENGUJI III</td>
                                    <td>:</td>
                                    <td>{{ $kompre->penguji1->name }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="col-md-12">
                        <table class="table" id="table">
                            <thead id="thead" class="text-center align-middle">
                                <tr>
                                    <th>No</th>
                                    <th style="width: 50%">Aspek Penilaian</th>
                                    <th>Bobot</th>
                                    <th>Nilai</th>
                                    <th>Nilai x Bobot</th>
                                </tr>
                            </thead>
                            <tbody id="tbody">
                                <tr>
                                    <td rowspan="3" class="text-center">1.</td>
                                    <td>Penguasaan Penelitian:</td>
                                    <td rowspan="3" class="text-center align-middle">{{ $bobot->bobot1 }}</td>
                                    <td rowspan="3" class="text-center align-middle">
                                        {{ $kompre->nilaikompre->nilai1_peng1 / $bobot->bobot1 }}
                                    </td>
                                    <td rowspan="3" class="text-center align-middle">
                                        {{ $nilai1_peng1 = $kompre->nilaikompre->nilai1_peng1 }}
                                    </td>
                                </tr>
                                <tr>
                                    <td>a. Sistematika penulisan</td>
                                </tr>
                                <tr>
                                    <td>b. Ketepatan penggunaan bahasa</td>
                                </tr>
                                <tr>
                                    <td rowspan="10" class="text-center">2.</td>
                                    <td>Segi Ilmiah Tulisan:</td>
                                    <td rowspan="10" class="text-center align-middle">{{ $bobot->bobot2 }}</td>
                                    <td rowspan="10" class="text-center align-middle">
                                        {{ $kompre->nilaikompre->nilai2_peng1 / $bobot->bobot2 }}
                                    </td>
                                    <td rowspan="10" class="text-center align-middle">
                                        {{ $nilai2_peng1 = $kompre->nilaikompre->nilai2_peng1 }}
                                    </td>
                                </tr>
                                <tr>
                                    <td>a. Kesesuaian judul</td>
                                </tr>
                                <tr>
                                    <td>b. Ketepatan latar belakang masalah</td>
                                </tr>
                                <tr>
                                    <td>c. Rumusan masalah</td>
                                </tr>
                                <tr>
                                    <td>d. Tujuan dan manfaat penelitian</td>
                                </tr>
                                <tr>
                                    <td>e. Keaslian penelitian</td>
                                </tr>
                                <tr>
                                    <td>f. Ketepatan tinjauan pustaka</td>
                                </tr>
                                <tr>
                                    <td>g. Perumusan hipotesis</td>
                                </tr>
                                <tr>
                                    <td>h. Penggunaan metode penelitian</td>
                                </tr>
                                <tr>
                                    <td>i. Penggunaan kepustakaan</td>
                                </tr>
                                <tr>
                                    <td rowspan="5" class="text-center">3.</td>
                                    <td>Kemampuan Penyajian:</td>
                                    <td rowspan="5" class="text-center align-middle">{{ $bobot->bobot3 }}</td>
                                    <td rowspan="5" class="text-center align-middle">
                                        {{ $kompre->nilaikompre->nilai3_peng1 / $bobot->bobot3 }}
                                    </td>
                                    <td rowspan="5" class="text-center align-middle">
                                        {{ $nilai3_peng1 = $kompre->nilaikompre->nilai3_peng1 }}

                                    </td>
                                </tr>
                                <tr>
                                    <td>a. Kemampuan mengemukakan konsep dan teori</td>
                                </tr>
                                <tr>
                                    <td>b. Kemampuan berbicara dengan jelas</td>
                                </tr>
                                <tr>
                                    <td>c. Kemampuan mengajukan materi secara sistematis</td>
                                </tr>
                                <tr>
                                    <td>d. Kemampuan teknik penyajian secara keseluruhan</td>
                                </tr>
                                <tr>
                                    <td rowspan="5" class="text-center">4.</td>
                                    <td>Kemampuan berdiskusi</td>
                                    <td rowspan="5" class="text-center align-middle">{{ $bobot->bobot4 }}</td>
                                    <td rowspan="5" class="text-center align-middle">
                                        {{ $kompre->nilaikompre->nilai4_peng1 / $bobot->bobot4 }}
                                    </td>
                                    <td rowspan="5" class="text-center align-middle">
                                        {{ $nilai4_peng1 = $kompre->nilaikompre->nilai4_peng1 }}
                                    </td>
                                </tr>
                                <tr>
                                    <td>a. Kemampuan komunikasi</td>
                                </tr>
                                <tr>
                                    <td>b. Kemampuan menjawab dengan tepat</td>
                                </tr>
                                <tr>
                                    <td>c. Kemampuan mengendalikan emosi</td>
                                </tr>
                                <tr>
                                    <td>d. Kemampuan mengemukakan pendapat</td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <th class="text-center">Jumlah Nilai</th>
                                    <td colspan="3" class="text-center">
                                        {{ ($nilai1_peng1 + $nilai2_peng1 + $nilai3_peng1 + $nilai4_peng1) / 5 }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div id="header"></div>

                <div class="col-md-12">
                    <div class="col-md-12">
                        <table id="tableheader">
                            <tr>
                                <td id="td"><img
                                        src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('img/upp.png'))) }}"
                                        width="140px" alt="404"></td>
                                <td id="td">
                                    <h2>UNIVERSITAS PASIR PENGARAIAN</h2>
                                    <h2>FAKULTAS ILMU KOMPUTER</h2>
                                    <h2>PROGRAM STUDI SISTEM INFORMASI</h2>
                                    <span>Jalan Tuanku Tambusai, Kumu Rambah Hilir, Telp. 085265853585 Kode Pos :
                                        28557</span>
                                </td>
                            </tr>
                        </table>
                        <div id="garis-tebal"></div>
                    </div>

                    <div class="col-md-12 text-center">
                        <h4>FORMAT PENILAIAN</h4>
                        <h4>UJIAN KOMPREHENSIF</h4>
                        <h4>TAHUN AKADEMIK {{ \Carbon\Carbon::now()->year }} / {{ \Carbon\Carbon::now()->year + 1 }}
                        </h4>
                    </div>

                    <div class="col-md-12">
                        <table class="table">
                            <tbody>
                                <tr>
                                    <td style="width: 30%">NAMA</td>
                                    <td style="width: 1%">:</td>
                                    <td>{{ $kompre->judul->mahasiswa->name }}</td>
                                </tr>
                                <tr>
                                    <td>NIM</td>
                                    <td>:</td>
                                    <td>{{ $kompre->judul->mahasiswa->nim_or_nidn }}</td>
                                </tr>
                                <tr>
                                    <td>JUDUL PROPOSAL</td>
                                    <td>:</td>
                                    <td>{{ \Str::title($kompre->judul->judul) }}</td>
                                </tr>
                                <tr>
                                    <td>PENGUJI IV</td>
                                    <td>:</td>
                                    <td>{{ $kompre->penguji2->name }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="col-md-12">

                        <table class="table" id="table">
                            <thead id="thead" class="text-center align-middle">
                                <tr>
                                    <th>No</th>
                                    <th style="width: 50%">Aspek Penilaian</th>
                                    <th>Bobot</th>
                                    <th>Nilai</th>
                                    <th>Nilai x Bobot</th>
                                </tr>
                            </thead>
                            <tbody id="tbody">
                                <tr>
                                    <td rowspan="3" class="text-center">1.</td>
                                    <td>Penguasaan Penelitian:</td>
                                    <td rowspan="3" class="text-center align-middle">{{ $bobot->bobot1 }}</td>
                                    <td rowspan="3" class="text-center align-middle">
                                        {{ $kompre->nilaikompre->nilai1_peng2 / $bobot->bobot1 }}
                                    </td>
                                    <td rowspan="3" class="text-center align-middle">
                                        {{ $nilai1_peng2 = $kompre->nilaikompre->nilai1_peng2 }}
                                    </td>
                                </tr>
                                <tr>
                                    <td>a. Sistematika penulisan</td>
                                </tr>
                                <tr>
                                    <td>b. Ketepatan penggunaan bahasa</td>
                                </tr>
                                <tr>
                                    <td rowspan="10" class="text-center">2.</td>
                                    <td>Segi Ilmiah Tulisan:</td>
                                    <td rowspan="10" class="text-center align-middle">{{ $bobot->bobot2 }}</td>
                                    <td rowspan="10" class="text-center align-middle">
                                        {{ $kompre->nilaikompre->nilai2_peng2 / $bobot->bobot2 }}
                                    </td>
                                    <td rowspan="10" class="text-center align-middle">
                                        {{ $nilai2_peng2 = $kompre->nilaikompre->nilai2_peng2 }}
                                    </td>
                                </tr>
                                <tr>
                                    <td>a. Kesesuaian judul</td>
                                </tr>
                                <tr>
                                    <td>b. Ketepatan latar belakang masalah</td>
                                </tr>
                                <tr>
                                    <td>c. Rumusan masalah</td>
                                </tr>
                                <tr>
                                    <td>d. Tujuan dan manfaat penelitian</td>
                                </tr>
                                <tr>
                                    <td>e. Keaslian penelitian</td>
                                </tr>
                                <tr>
                                    <td>f. Ketepatan tinjauan pustaka</td>
                                </tr>
                                <tr>
                                    <td>g. Perumusan hipotesis</td>
                                </tr>
                                <tr>
                                    <td>h. Penggunaan metode penelitian</td>
                                </tr>
                                <tr>
                                    <td>i. Penggunaan kepustakaan</td>
                                </tr>
                                <tr>
                                    <td rowspan="5" class="text-center">3.</td>
                                    <td>Kemampuan Penyajian:</td>
                                    <td rowspan="5" class="text-center align-middle">{{ $bobot->bobot3 }}</td>
                                    <td rowspan="5" class="text-center align-middle">
                                        {{ $kompre->nilaikompre->nilai3_peng2 / $bobot->bobot3 }}
                                    </td>
                                    <td rowspan="5" class="text-center align-middle">
                                        {{ $nilai3_peng2 = $kompre->nilaikompre->nilai3_peng2 }}

                                    </td>
                                </tr>
                                <tr>
                                    <td>a. Kemampuan mengemukakan konsep dan teori</td>
                                </tr>
                                <tr>
                                    <td>b. Kemampuan berbicara dengan jelas</td>
                                </tr>
                                <tr>
                                    <td>c. Kemampuan mengajukan materi secara sistematis</td>
                                </tr>
                                <tr>
                                    <td>d. Kemampuan teknik penyajian secara keseluruhan</td>
                                </tr>
                                <tr>
                                    <td rowspan="5" class="text-center">4.</td>
                                    <td>Kemampuan berdiskusi</td>
                                    <td rowspan="5" class="text-center align-middle">{{ $bobot->bobot4 }}</td>
                                    <td rowspan="5" class="text-center align-middle">
                                        {{ $kompre->nilaikompre->nilai4_peng2 / $bobot->bobot4 }}
                                    </td>
                                    <td rowspan="5" class="text-center align-middle">
                                        {{ $nilai4_peng2 = $kompre->nilaikompre->nilai4_peng2 }}
                                    </td>
                                </tr>
                                <tr>
                                    <td>a. Kemampuan komunikasi</td>
                                </tr>
                                <tr>
                                    <td>b. Kemampuan menjawab dengan tepat</td>
                                </tr>
                                <tr>
                                    <td>c. Kemampuan mengendalikan emosi</td>
                                </tr>
                                <tr>
                                    <td>d. Kemampuan mengemukakan pendapat</td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <th class="text-center">Jumlah Nilai</th>
                                    <td colspan="3" class="text-center">
                                        {{ ($nilai1_peng2 + $nilai2_peng2 + $nilai3_peng2 + $nilai4_peng2) / 5 }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div id="header"></div>

                <div class="col-md-12">
                    <div class="col-md-12">
                        <table id="tableheader">
                            <tr>
                                <td id="td"><img
                                        src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('img/upp.png'))) }}"
                                        width="140px" alt="404"></td>
                                <td id="td">
                                    <h2>UNIVERSITAS PASIR PENGARAIAN</h2>
                                    <h2>FAKULTAS ILMU KOMPUTER</h2>
                                    <h2>PROGRAM STUDI SISTEM INFORMASI</h2>
                                    <span>Jalan Tuanku Tambusai, Kumu Rambah Hilir, Telp. 085265853585 Kode Pos :
                                        28557</span>
                                </td>
                            </tr>
                        </table>
                        <div id="garis-tebal"></div>
                    </div>

                    <div class="col-md-12 text-center">
                        <h4>FORMAT PENILAIAN</h4>
                        <h4>UJIAN KOMPREHENSIF</h4>
                        <h4>TAHUN AKADEMIK {{ \Carbon\Carbon::now()->year }} / {{ \Carbon\Carbon::now()->year + 1 }}
                        </h4>
                    </div>

                    <div class="col-md-12">
                        <table class="table">
                            <tbody>
                                <tr>
                                    <td style="width: 30%">NAMA</td>
                                    <td style="width: 1%">:</td>
                                    <td>{{ $kompre->judul->mahasiswa->name }}</td>
                                </tr>
                                <tr>
                                    <td>NIM</td>
                                    <td>:</td>
                                    <td>{{ $kompre->judul->mahasiswa->nim_or_nidn }}</td>
                                </tr>
                                <tr>
                                    <td>JUDUL PROPOSAL</td>
                                    <td>:</td>
                                    <td>{{ \Str::title($kompre->judul->judul) }}</td>
                                </tr>
                                <tr>
                                    <td>PENGUJI V</td>
                                    <td>:</td>
                                    <td>{{ $kompre->penguji3->name }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="col-md-12">
                        <table class="table" id="table">
                            <thead id="thead" class="text-center align-middle">
                                <tr>
                                    <th>No</th>
                                    <th style="width: 50%">Aspek Penilaian</th>
                                    <th>Bobot</th>
                                    <th>Nilai</th>
                                    <th>Nilai x Bobot</th>
                                </tr>
                            </thead>
                            <tbody id="tbody">
                                <tr>
                                    <td rowspan="3" class="text-center">1.</td>
                                    <td>Penguasaan Penelitian:</td>
                                    <td rowspan="3" class="text-center align-middle">{{ $bobot->bobot1 }}</td>
                                    <td rowspan="3" class="text-center align-middle">
                                        {{ $kompre->nilaikompre->nilai1_peng3 / $bobot->bobot1 }}
                                    </td>
                                    <td rowspan="3" class="text-center align-middle">
                                        {{ $nilai1_peng3 = $kompre->nilaikompre->nilai1_peng3 }}
                                    </td>
                                </tr>
                                <tr>
                                    <td>a. Sistematika penulisan</td>
                                </tr>
                                <tr>
                                    <td>b. Ketepatan penggunaan bahasa</td>
                                </tr>
                                <tr>
                                    <td rowspan="10" class="text-center">2.</td>
                                    <td>Segi Ilmiah Tulisan:</td>
                                    <td rowspan="10" class="text-center align-middle">{{ $bobot->bobot2 }}</td>
                                    <td rowspan="10" class="text-center align-middle">
                                        {{ $kompre->nilaikompre->nilai2_peng3 / $bobot->bobot2 }}
                                    </td>
                                    <td rowspan="10" class="text-center align-middle">
                                        {{ $nilai2_peng3 = $kompre->nilaikompre->nilai2_peng3 }}
                                    </td>
                                </tr>
                                <tr>
                                    <td>a. Kesesuaian judul</td>
                                </tr>
                                <tr>
                                    <td>b. Ketepatan latar belakang masalah</td>
                                </tr>
                                <tr>
                                    <td>c. Rumusan masalah</td>
                                </tr>
                                <tr>
                                    <td>d. Tujuan dan manfaat penelitian</td>
                                </tr>
                                <tr>
                                    <td>e. Keaslian penelitian</td>
                                </tr>
                                <tr>
                                    <td>f. Ketepatan tinjauan pustaka</td>
                                </tr>
                                <tr>
                                    <td>g. Perumusan hipotesis</td>
                                </tr>
                                <tr>
                                    <td>h. Penggunaan metode penelitian</td>
                                </tr>
                                <tr>
                                    <td>i. Penggunaan kepustakaan</td>
                                </tr>
                                <tr>
                                    <td rowspan="5" class="text-center">3.</td>
                                    <td>Kemampuan Penyajian:</td>
                                    <td rowspan="5" class="text-center align-middle">{{ $bobot->bobot3 }}</td>
                                    <td rowspan="5" class="text-center align-middle">
                                        {{ $kompre->nilaikompre->nilai3_peng3 / $bobot->bobot3 }}
                                    </td>
                                    <td rowspan="5" class="text-center align-middle">
                                        {{ $nilai3_peng3 = $kompre->nilaikompre->nilai3_peng3 }}

                                    </td>
                                </tr>
                                <tr>
                                    <td>a. Kemampuan mengemukakan konsep dan teori</td>
                                </tr>
                                <tr>
                                    <td>b. Kemampuan berbicara dengan jelas</td>
                                </tr>
                                <tr>
                                    <td>c. Kemampuan mengajukan materi secara sistematis</td>
                                </tr>
                                <tr>
                                    <td>d. Kemampuan teknik penyajian secara keseluruhan</td>
                                </tr>
                                <tr>
                                    <td rowspan="5" class="text-center">4.</td>
                                    <td>Kemampuan berdiskusi</td>
                                    <td rowspan="5" class="text-center align-middle">{{ $bobot->bobot4 }}</td>
                                    <td rowspan="5" class="text-center align-middle">
                                        {{ $kompre->nilaikompre->nilai4_peng3 / $bobot->bobot4 }}
                                    </td>
                                    <td rowspan="5" class="text-center align-middle">
                                        {{ $nilai4_peng3 = $kompre->nilaikompre->nilai4_peng3 }}
                                    </td>
                                </tr>
                                <tr>
                                    <td>a. Kemampuan komunikasi</td>
                                </tr>
                                <tr>
                                    <td>b. Kemampuan menjawab dengan tepat</td>
                                </tr>
                                <tr>
                                    <td>c. Kemampuan mengendalikan emosi</td>
                                </tr>
                                <tr>
                                    <td>d. Kemampuan mengemukakan pendapat</td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <th class="text-center">Jumlah Nilai</th>
                                    <td colspan="3" class="text-center">
                                        {{ ($nilai1_peng3 + $nilai2_peng3 + $nilai3_peng3 + $nilai4_peng3) / 5 }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </body>

</html>
