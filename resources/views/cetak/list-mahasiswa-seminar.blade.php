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
                padding: 0;
                margin: 0;
                padding-left: 3px;
                padding-right: 3px;
            }

            #kop {
                text-align: center;
            }

            #kop>div,
            #kop>header {
                display: inline-block;
                vertical-align: middle;
                width: 50%;
            }
        </style>
    </head>

    <body>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="col-md-12" id="kop">
                        <img src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('img/upp.png'))) }}"
                            width="140px" alt="404">
                        <header class="text-center">
                            <h2>UNIVERSITAS PASIR PENGARAIAN</h2>
                            <h2>FAKULTAS ILMU KOMPUTER</h2>
                            <h2>PROGRAM STUDI SISTEM INFORMASI</h2>
                            <span>Jalan Tuanku Tambusai, Kumu Rambah Hilir, Telp. 085265853585 Kode Pos :
                                28557</span>
                        </header>
                    </div>
                    <div id="garis-tebal"></div>
                    <h3 class="text-center my-3 text-uppercase">Jadwal Seminar Program Studi Sistem Informasi</h3>
                    <div class="col-md-12">
                        <div class="table-responsive">
                            <table class="table text-center align-middle" id="table">
                                <thead id="thead">
                                    <tr class="align-middle">
                                        <th scope="col">No</th>
                                        <th scope="col">Nim</th>
                                        <th scope="col">Mahasiswa</th>
                                        <th scope="col">Judul</th>
                                        <th scope="col">Dosen Pembimbing</th>
                                        <th scope="col">Dosen Penguji</th>
                                        <th scope="col">Tanggal Seminar</th>
                                        <th scope="col">Jenis Seminar</th>
                                    </tr>
                                </thead>
                                <tbody id="tbody" class="text-center">
                                    @if ($users->count() !== 0)
                                        @foreach ($users as $index => $user)
                                            @foreach ($user->judul as $judul)
                                                <tr>
                                                    <td rowspan="3">{{ $index + 1 }}</td>
                                                    <td rowspan="3">{{ $user->nim_or_nidn }}</td>
                                                    <td rowspan="3">{{ $user->name }}</td>
                                                    <td rowspan="3">{{ $judul->judul }}</td>
                                                    <td>{{ $judul->pembimbing1->name }}</td>

                                                    @if ($judul->sempro[0]->status == 'diterima')
                                                        <td>{{ $judul->sempro[0]->penguji1->name }}</td>
                                                        <td rowspan="3">
                                                            {{ $judul->sempro[0]->tanggal_seminar ? \Carbon\Carbon::parse($judul->sempro[0]->tanggal_seminar)->translatedFormat('l, d F Y') : '-' }}
                                                        </td>
                                                        <td rowspan="3">Proposal</td>
                                                    @elseif ($judul->kompre[0]->status == 'diterima')
                                                        <td>{{ $judul->kompre[0]->penguji1->name }}</td>
                                                        <td rowspan="3">
                                                            {{ $judul->kompre[0]->tanggal_seminar ? \Carbon\Carbon::parse($judul->kompre[0]->tanggal_seminar)->translatedFormat('l, d F Y') : '-' }}
                                                        </td>
                                                        <td rowspan="3">Komprehensif</td>
                                                    @endif

                                                </tr>
                                                <tr>
                                                    <td>{{ $judul->pembimbing2->name }}</td>

                                                    @if ($judul->sempro[0]->status == 'diterima')
                                                        <td>{{ $judul->sempro[0]->penguji2->name }}</td>
                                                    @elseif ($judul->kompre[0]->status == 'diterima')
                                                        <td>{{ $judul->kompre[0]->penguji2->name }}</td>
                                                    @endif

                                                </tr>
                                                <tr>
                                                    <td></td>
                                                    @if ($judul->sempro[0]->status == 'diterima')
                                                        <td>{{ $judul->sempro[0]->penguji3->name }}</td>
                                                    @elseif ($judul->kompre[0]->status == 'diterima')
                                                        <td>{{ $judul->kompre[0]->penguji3->name }}</td>
                                                    @endif
                                                </tr>
                                            @endforeach
                                        @endforeach
                                    @else
                                        <td colspan="8" class="text-center">No Data</td>
                                    @endif
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>

</html>
