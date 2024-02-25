<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>LEMBAR BIMBINGAN {{ $title }}</title>
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
                padding: 4px;
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
                    <h4>LEMBAR KONTROL BIMBINGAN {{ $title }} TUGAS AKHIR</h4>
                </div>

                <div class="col-md-12">
                    <table id="table" class="table">
                        <tbody id="tbody">
                            <tr>
                                <th>Nama</th>
                                <td>{{ $logbooks[0]->judul->mahasiswa->name ?? '-' }}</td>
                            </tr>
                            <tr>
                                <th>NIM</th>
                                <td>{{ $logbooks[0]->judul->mahasiswa->nim_or_nidn ?? '-' }}</td>
                            </tr>
                            <tr>
                                <th style="width: 30%">Judul Proposal Tugas Akhir</th>
                                <td>{{ $logbooks[0]->judul->judul ?? '-' }}</td>
                            </tr>
                            <tr>
                                <th>Pembimbing 1</th>
                                <td>{{ $logbooks[0]->judul->pembimbing1->name ?? '-' }}</td>
                            </tr>
                            <tr>
                                <th>Pembimbing 2</th>
                                <td>{{ $logbooks[0]->judul->pembimbing2->name ?? '-' }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="col-md-12">
                    <table id="table" class="table">
                        <thead id="thead">
                            <tr class="text-center align-middle">
                                <th id="th">No</th>
                                <th id="th">Hari/Tanggal Bimbingan</th>
                                <th id="th">Dospem</th>
                                <th id="th">Target Bimbingan</th>
                                <th id="th">Hasil Bimbingan dan Rencana Selanjutnya</th>
                            </tr>
                        </thead>
                        <tbody id="tbody">
                            @if ($logbooks->count() !== 0)
                                @foreach ($logbooks as $logbook)
                                    <tr class="text-center align-items-center">
                                        <td>{{ $loop->index + 1 }}</td>
                                        <td>{{ $logbook->created_at->translatedFormat('l, d F Y') }}</td>
                                        <td>{{ $logbook->pembimbing->name }}</td>
                                        <td>{{ $logbook->target_bimbingan ?? '-' }}</td>
                                        <td>{{ $logbook->hasil ?? '-' }}</td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td id="colspan" colspan="5">No data</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>

                <p>Catatan : Formulir ini agar disimpan oleh mahasiswa dan salinan dari formulir ini wajib
                    dilampirkan pada laporan tugas akhir, serta berkas asli formulir dibawa saat sidang.</p>

                <div class="col-md-12 mt-5">
                    <span>Pasir Pengaraian,
                        {{ $logbooks->count() !== 0 ? $logbooks[0]->updated_at->translatedFormat('l d F Y') : '-' }}</span>
                </div>
                <div class="col-md-12">
                    <div class="col-md-6">
                        <p class="mb-5">Pembimbing 1</p>
                        <span class="">{{ $logbooks[0]->judul->pembimbing1->name ?? '-' }}</span>
                        <p>NIDN. {{ $logbooks[0]->judul->pembimbing1->nim_or_nidn ?? '-' }}</p>
                    </div>
                    <div class="col-md-6">
                        <p class="mb-5">Pembimbing 2</p>
                        <span class="">{{ $logbooks[0]->judul->pembimbing2->name ?? '-' }}</span>
                        <p>NIDN. {{ $logbooks[0]->judul->pembimbing2->nim_or_nidn ?? '-' }}</p>
                    </div>
                </div>

            </div>
        </div>
    </body>

</html>
