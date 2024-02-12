<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>{{ $title }}</title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">

        <style>
            body {
                font-family: Arial, sans-serif;
                margin: 0;
                padding: 0;
                line-height: 1.6;
                /* height: 1000px; */
                line-height: 1.6;
            }

            .container {
                max-width: 800px;
                margin: 0 auto;
                padding: 20px;
            }

            header {
                text-align: center;
            }

            h2,
            h3 {
                margin: 0;
            }

            span {
                display: block;
            }

            #garis-tebal {
                border-bottom: 4px solid black;
                margin-bottom: 10px;
            }

            h4 {
                margin: 0;
                text-align: center;
            }

            table {
                width: 100%;
                border-collapse: collapse;
                margin-bottom: 20px;
            }

            table tbody tr th {
                width: 30%;
            }

            th,
            td {
                padding: 8px;
                border: 1px solid black;
            }

            th {
                text-align: left;
                background-color: #f2f2f2;
            }

            table thead #th {
                text-align: center;
            }

            td {
                vertical-align: top;
            }

            #colspan {
                text-align: center;
            }

            tbody td:nth-child(odd) {
                background-color: #f9f9f9;
            }

            tfoot td {
                background-color: #f2f2f2;
            }

            small {
                display: block;
                margin-top: 20px;
            }

            .row {
                display: flex;
                flex-wrap: wrap;
            }

            .col-md-12 {
                width: 100%;
            }

            .col-md-6 {
                width: 50%;
                box-sizing: border-box;
                padding-right: 20px;
                /* Untuk memberikan ruang di antara kolom */
            }

            .col-md-6:last-child {
                padding-right: 0;
                /* Hapus padding kanan dari kolom terakhir */
            }

            /* Gaya untuk pencetakan */
            @page {
                margin: 1cm;
                /* Atur margin sesuai kebutuhan */
            }

            .row {
                page-break-inside: avoid;
                /* Hindari pemisahan baris di tengah halaman */
            }

            .col-md-12 {
                display: block;
                width: 100%;
                clear: both;
            }

            .col-md-6 {
                float: left;
                width: 50%;
                box-sizing: border-box;
            }
        </style>
    </head>

    <body>
        <div class="container">
            <header class="d-flex justify-content-center">
                {{-- <img src="{{ asset('img/upp.png') }}" style="width: 130px;height: 130px;" alt="img"> --}}
                <nav>
                    <h2>UNIVERSITAS PASIR PENGARAIAN</h2>
                    <h2>FAKULTAS ILMU KOMPUTER</h2>
                    <h2>PROGRAM STUDI SISTEM INFORMASI</h2>
                    <span>Jalan Tuanku Tambusai, Kumu Rambah Hilir, Telp. 085265853585 Kode Pos :
                        28557</span>
                </nav>
            </header>
            <div id="garis-tebal"></div>
            <div class="content">
                <h4>LEMBAR KONTROL BIMBINGAN {{ $title }} TUGAS AKHIR</h4>
                <div class="row">
                    <div class="table1">
                        <table>
                            <tbody>
                                <tr>
                                    <th>Nama</th>
                                    <td>{{ $logbooks[0]->judul->mahasiswa->name ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <th>NIM</th>
                                    <td>{{ $logbooks[0]->judul->mahasiswa->nim_or_nidn ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <th>Judul Proposal Tugas Akhir</th>
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

                    <div class="table2">
                        <table>
                            <thead>
                                <tr>
                                    <th id="th">No</th>
                                    <th id="th">Tanggal Bimbingan</th>
                                    <th id="th">Target Bimbingan</th>
                                    <th id="th">Hasil Bimbingan dan Rencana Selanjutnya</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($logbooks->count() !== 0)

                                    @foreach ($logbooks as $logbook)
                                        <tr>
                                            <td>{{ $loop->index + 1 }}</td>
                                            <td>{{ $logbook->created_at->format('d M Y') }}</td>
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

                    <small>Catatan : Formulir ini agar disimpan oleh mahasiswa dan salinan dari formulir ini wajib
                        dilampirkan pada laporan tugas akhir, serta berkas asli formulir dibawa saat sidang.</small>

                    <div class="row mt-5">
                        <div class="col-md-12">
                            <span>Pasir Pengaraian,
                                {{ $logbooks->count() !== 0 ? $logbooks[0]->updated_at->format('d F Y') : '-' }}</span>
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

            </div>
        </div>
    </body>

</html>
