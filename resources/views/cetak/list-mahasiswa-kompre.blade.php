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
        </style>
    </head>

    <body>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="col-md-12">
                        {{-- <img src="{{ asset('img/upp.png') }}" class="img-fluid" alt=""> --}}
                        <header class="text-center">
                            <h2>UNIVERSITAS PASIR PENGARAIAN</h2>
                            <h2>FAKULTAS ILMU KOMPUTER</h2>
                            <h2>PROGRAM STUDI SISTEM INFORMASI</h2>
                            <span>Jalan Tuanku Tambusai, Kumu Rambah Hilir, Telp. 085265853585 Kode Pos :
                                28557</span>
                        </header>
                        <div id="garis-tebal"></div>
                    </div>
                    <h3 class="text-center my-3 text-uppercase">mahasiswa seminar komprehensif</h3>
                    <div class="col-md-12">
                        <table class="table" id="table">
                            <thead id="thead">
                                <tr class="text-center">
                                    <th style="width: 3%">No</th>
                                    <th style="width: 10%">Nim</th>
                                    <th style="width: 20%">Nama</th>
                                    <th>Judul</th>
                                    <th style="width: 18%">Tanggal</th>
                                </tr>
                            </thead>
                            <tbody id="tbody">
                                @if ($kompres->count() !== 0)

                                    @foreach ($kompres as $kompre)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $kompre->judul->mahasiswa->nim_or_nidn ?? '-' }}</td>
                                            <td>{{ $kompre->judul->mahasiswa->name ?? '-' }}</td>
                                            <td>{{ $kompre->judul->judul ?? '-' }}</td>
                                            <td>{{ \Carbon\Carbon::parse($kompre->tanggal_seminar)->translatedFormat('d F Y') ?? '-' }}
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
