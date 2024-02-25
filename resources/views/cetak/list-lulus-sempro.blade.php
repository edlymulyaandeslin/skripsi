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
                    <h3 class="text-center mt-3 text-uppercase">lulus seminar proposal</h3>
                    <h3 class="text-center mb-3 text-uppercase">program studi sistem informasi</h3>
                    <div class="col-md-12">
                        <table class="table" id="table">
                            <thead id="thead">
                                <tr class="text-center">
                                    <th style="width: 2%">No</th>
                                    <th style="width: 10%">Nim</th>
                                    <th style="width: 20%">Nama</th>
                                    <th>Judul</th>
                                    <th style="width: 18%">Tanggal Seminar</th>
                                    <th style="width: 10%">Nilai</th>
                                </tr>
                            </thead>
                            <tbody id="tbody">
                                @if ($sempros->count() !== 0)

                                    @foreach ($sempros as $sempro)
                                        <tr class="text-center">
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $sempro->judul->mahasiswa->nim_or_nidn ?? '-' }}</td>
                                            <td>{{ $sempro->judul->mahasiswa->name ?? '-' }}
                                            </td>
                                            <td>{{ $sempro->judul->judul ?? '-' }}</td>
                                            <td>{{ \Carbon\Carbon::parse($sempro->tanggal_seminar)->translatedFormat('d F Y') ?? '-' }}
                                            </td>
                                            <td>{{ $sempro->nilaisempro
                                                ? ($sempro->nilaisempro->nilai1_pem1 +
                                                        $sempro->nilaisempro->nilai2_pem1 +
                                                        $sempro->nilaisempro->nilai3_pem1 +
                                                        $sempro->nilaisempro->nilai4_pem1 +
                                                        $sempro->nilaisempro->nilai5_pem1 +
                                                        $sempro->nilaisempro->nilai6_pem1 +
                                                        $sempro->nilaisempro->nilai7_pem1 +
                                                        $sempro->nilaisempro->nilai1_pem2 +
                                                        $sempro->nilaisempro->nilai2_pem2 +
                                                        $sempro->nilaisempro->nilai3_pem2 +
                                                        $sempro->nilaisempro->nilai4_pem2 +
                                                        $sempro->nilaisempro->nilai5_pem2 +
                                                        $sempro->nilaisempro->nilai6_pem2 +
                                                        $sempro->nilaisempro->nilai7_pem2 +
                                                        $sempro->nilaisempro->nilai1_peng1 +
                                                        $sempro->nilaisempro->nilai2_peng1 +
                                                        $sempro->nilaisempro->nilai3_peng1 +
                                                        $sempro->nilaisempro->nilai4_peng1 +
                                                        $sempro->nilaisempro->nilai5_peng1 +
                                                        $sempro->nilaisempro->nilai1_peng2 +
                                                        $sempro->nilaisempro->nilai2_peng2 +
                                                        $sempro->nilaisempro->nilai3_peng2 +
                                                        $sempro->nilaisempro->nilai4_peng2 +
                                                        $sempro->nilaisempro->nilai5_peng2 +
                                                        $sempro->nilaisempro->nilai1_peng3 +
                                                        $sempro->nilaisempro->nilai2_peng3 +
                                                        $sempro->nilaisempro->nilai3_peng3 +
                                                        $sempro->nilaisempro->nilai4_peng3 +
                                                        $sempro->nilaisempro->nilai5_peng3) /
                                                    5
                                                : 0 }}
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="6" class="text-center">
                                            No Data.
                                        </td>
                                    </tr>
                                @endif

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </body>

</html>
