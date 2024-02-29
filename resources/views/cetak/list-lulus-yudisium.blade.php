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
                                        width="140px" alt="404">
                                </td>
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

                    <h3 class="text-center my-3 text-uppercase text-decoration-underline">surat pernyataan</h3>

                    <p class="text-center">Nomor: ...../SI/UPP/UN/X/{{ Carbon\Carbon::now()->format('Y') }}</p>

                    <p>Saya yang bertanda tangan dibawah ini :</p>

                    <div class="col-md-12">
                        <table class="table">
                            <tbody>
                                <tr>
                                    <td style="width: 20%">Nama</td>
                                    <td style="width: 1%">:</td>
                                    <td>{{ $kaprodi[0]->name }}</td>
                                </tr>
                                <tr>
                                    <td>NIDN</td>
                                    <td>:</td>
                                    <td>{{ $kaprodi[0]->nim_or_nidn }}</td>
                                </tr>
                                <tr>
                                    <td>Jabatan</td>
                                    <td>:</td>
                                    <td>Ketua Program Studi Sistem Informasi</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <p>Dengan ini menyatakan mahasiswa dalam daftar dibawah ini sudah <span class="fw-bold"> Lulus Ujian
                            Komprehensif</span> dan sudah
                        dinyatakan <span class="fw-bold">Lulus Yudisium</span> pada semester genap TA.
                        {{ Carbon\Carbon::now()->format('Y') }} /
                        {{ Carbon\Carbon::now()->format('Y') + 1 }}, namun belum mengikuti Wisuda.
                        Adapun nama mahasiswa tersebut adalah:</p>

                    <div class="col-md-12">
                        <table class="table" id="table">
                            <thead id="thead">
                                <tr class="text-center align-middle">
                                    <th scope="col">No</th>
                                    <th scope="col">Nim</th>
                                    <th scope="col">Mahasiswa</th>
                                    <th scope="col">Tanggal Lulus</th>
                                    <th scope="col">Nilai Akhir</th>
                                </tr>
                            </thead>
                            <tbody id="tbody" class="text-center">
                                @if ($users->count() !== 0)
                                    @foreach ($users as $index => $user)
                                        @foreach ($user->judul as $judul)
                                            @if ($judul->status == 'diterima')
                                                <tr>
                                                    <td>{{ $index + 1 }}</td>
                                                    <td>{{ $user->nim_or_nidn }}</td>
                                                    <td>{{ $user->name }}</td>
                                                    <td>{{ \Carbon\Carbon::parse($judul->kompre[0]->updated_at)->translatedFormat('d F Y') }}
                                                    </td>
                                                    @php
                                                        $judul->sempro[0]->nilaisempro
                                                            ? ($nilaisempro =
                                                                ($judul->sempro[0]->nilaisempro->nilai1_pem1 +
                                                                    $judul->sempro[0]->nilaisempro->nilai2_pem1 +
                                                                    $judul->sempro[0]->nilaisempro->nilai3_pem1 +
                                                                    $judul->sempro[0]->nilaisempro->nilai4_pem1 +
                                                                    $judul->sempro[0]->nilaisempro->nilai5_pem1 +
                                                                    $judul->sempro[0]->nilaisempro->nilai6_pem1 +
                                                                    $judul->sempro[0]->nilaisempro->nilai7_pem1 +
                                                                    $judul->sempro[0]->nilaisempro->nilai1_pem2 +
                                                                    $judul->sempro[0]->nilaisempro->nilai2_pem2 +
                                                                    $judul->sempro[0]->nilaisempro->nilai3_pem2 +
                                                                    $judul->sempro[0]->nilaisempro->nilai4_pem2 +
                                                                    $judul->sempro[0]->nilaisempro->nilai5_pem2 +
                                                                    $judul->sempro[0]->nilaisempro->nilai6_pem2 +
                                                                    $judul->sempro[0]->nilaisempro->nilai7_pem2 +
                                                                    $judul->sempro[0]->nilaisempro->nilai1_peng1 +
                                                                    $judul->sempro[0]->nilaisempro->nilai2_peng1 +
                                                                    $judul->sempro[0]->nilaisempro->nilai3_peng1 +
                                                                    $judul->sempro[0]->nilaisempro->nilai4_peng1 +
                                                                    $judul->sempro[0]->nilaisempro->nilai5_peng1 +
                                                                    $judul->sempro[0]->nilaisempro->nilai1_peng2 +
                                                                    $judul->sempro[0]->nilaisempro->nilai2_peng2 +
                                                                    $judul->sempro[0]->nilaisempro->nilai3_peng2 +
                                                                    $judul->sempro[0]->nilaisempro->nilai4_peng2 +
                                                                    $judul->sempro[0]->nilaisempro->nilai5_peng2 +
                                                                    $judul->sempro[0]->nilaisempro->nilai1_peng3 +
                                                                    $judul->sempro[0]->nilaisempro->nilai2_peng3 +
                                                                    $judul->sempro[0]->nilaisempro->nilai3_peng3 +
                                                                    $judul->sempro[0]->nilaisempro->nilai4_peng3 +
                                                                    $judul->sempro[0]->nilaisempro->nilai5_peng3) /
                                                                5)
                                                            : ($nilaisempro = 0);

                                                        $judul->kompre[0]->nilaikompre
                                                            ? ($nilaikompre =
                                                                ($judul->kompre[0]->nilaikompre->nilai1_pem1 +
                                                                    $judul->kompre[0]->nilaikompre->nilai2_pem1 +
                                                                    $judul->kompre[0]->nilaikompre->nilai3_pem1 +
                                                                    $judul->kompre[0]->nilaikompre->nilai4_pem1 +
                                                                    $judul->kompre[0]->nilaikompre->nilai1_pem2 +
                                                                    $judul->kompre[0]->nilaikompre->nilai2_pem2 +
                                                                    $judul->kompre[0]->nilaikompre->nilai3_pem2 +
                                                                    $judul->kompre[0]->nilaikompre->nilai4_pem2 +
                                                                    $judul->kompre[0]->nilaikompre->nilai1_peng1 +
                                                                    $judul->kompre[0]->nilaikompre->nilai2_peng1 +
                                                                    $judul->kompre[0]->nilaikompre->nilai3_peng1 +
                                                                    $judul->kompre[0]->nilaikompre->nilai4_peng1 +
                                                                    $judul->kompre[0]->nilaikompre->nilai1_peng2 +
                                                                    $judul->kompre[0]->nilaikompre->nilai2_peng2 +
                                                                    $judul->kompre[0]->nilaikompre->nilai3_peng2 +
                                                                    $judul->kompre[0]->nilaikompre->nilai4_peng2 +
                                                                    $judul->kompre[0]->nilaikompre->nilai1_peng3 +
                                                                    $judul->kompre[0]->nilaikompre->nilai2_peng3 +
                                                                    $judul->kompre[0]->nilaikompre->nilai3_peng3 +
                                                                    $judul->kompre[0]->nilaikompre->nilai4_peng3) /
                                                                25)
                                                            : ($nilaikompre = 0);
                                                    @endphp
                                                    <td>
                                                        {{ ($nilaisempro + $nilaikompre) / 2 }}
                                                    </td>
                                                </tr>
                                            @endif
                                        @endforeach
                                    @endforeach
                                @else
                                    <td colspan="8" class="text-center">No Data</td>
                                @endif
                            </tbody>
                        </table>
                    </div>

                    <p>Demikian surat pernyataan ini dibuat untuk dapat dipergunakan sebagaimana mestinya, atas
                        perhatian dan kerjasama yang baik diucapkan terima kasih.</p>

                    <div class="col-md-6 offset-7">
                        <p>Pasir Pengaraian, {{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}</p>
                        <div>
                            <p class="mb-5">Ketua Program Studi</p>
                            <p class="m-0">{{ $kaprodi[0]->name ?? '-' }}</p>
                            <p class="m-0">NIDN. {{ $kaprodi[0]->nim_or_nidn ?? '-' }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>

</html>
