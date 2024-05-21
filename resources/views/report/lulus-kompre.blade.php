@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-12 bg-light rounded h-100 p-4 d-flex flex-column">
            <h3>Mahasiswa Lulus Seminar Komprehensif</h3>

            <div class="d-flex justify-content-between mb-3 mt-1">
                <div class="col-md-5">
                    <form action="/laporan/lulus-kompre">
                        <div class="input-group">
                            <input type="text" placeholder="search..." class="form-control" name="search"
                                value="{{ request('search') }}" autofocus>
                            <button type="submit" class="btn btn-primary">Search</button>
                        </div>
                    </form>
                </div>
                @can('koordinator')
                    <div>
                        <a href="/cetak/lulus-kompre" class="btn btn-danger btn-sm"><i class="fa fa-file-download"></i>
                            Cetak</a>
                    </div>
                @endcan
            </div>

            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr class="text-center">
                            <th scope="col">No</th>
                            <th scope="col">Nim</th>
                            <th scope="col">Mahasiswa</th>
                            <th scope="col">Judul</th>
                            <th scope="col">Tanggal Seminar</th>
                            <th scope="col">Nilai</th>
                            <th scope="col">Tahun Ajaran</th>
                            <th scope="col">Berita Acara</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($kompres->count() !== 0)
                            @foreach ($kompres as $index => $kompre)
                                <tr key="{{ $kompre->id }}" class="text-center">
                                    <th>{{ $index + $kompres->firstItem() }}</th>
                                    <td>{{ $kompre->judul->mahasiswa->nim_or_nidn }}</td>
                                    <td>{{ $kompre->judul->mahasiswa->name }}</td>
                                    <td>{{ $kompre->judul->judul }}</td>
                                    <td>{{ \Carbon\Carbon::parse($kompre->tanggal_seminar)->translatedFormat('d F Y') }}
                                    </td>
                                    @if ($kompre->nilaikompre)
                                        @php
                                            $nilaipem1 =
                                                ($kompre->nilaikompre->nilai1_pem1 +
                                                    $kompre->nilaikompre->nilai2_pem1 +
                                                    $kompre->nilaikompre->nilai3_pem1 +
                                                    $kompre->nilaikompre->nilai4_pem1) /
                                                5;
                                            $nilaipem2 =
                                                ($kompre->nilaikompre->nilai1_pem2 +
                                                    $kompre->nilaikompre->nilai2_pem2 +
                                                    $kompre->nilaikompre->nilai3_pem2 +
                                                    $kompre->nilaikompre->nilai4_pem2) /
                                                5;
                                            $nilaipeng1 =
                                                ($kompre->nilaikompre->nilai1_peng1 +
                                                    $kompre->nilaikompre->nilai2_peng1 +
                                                    $kompre->nilaikompre->nilai3_peng1 +
                                                    $kompre->nilaikompre->nilai4_peng1) /
                                                5;
                                            $nilaipeng2 =
                                                ($kompre->nilaikompre->nilai1_peng2 +
                                                    $kompre->nilaikompre->nilai2_peng2 +
                                                    $kompre->nilaikompre->nilai3_peng2 +
                                                    $kompre->nilaikompre->nilai4_peng2) /
                                                5;
                                            $nilaipeng3 =
                                                ($kompre->nilaikompre->nilai1_peng3 +
                                                    $kompre->nilaikompre->nilai2_peng3 +
                                                    $kompre->nilaikompre->nilai3_peng3 +
                                                    $kompre->nilaikompre->nilai4_peng3) /
                                                5;
                                        @endphp
                                        <td>{{ ($nilaipem1 + $nilaipem2 + $nilaipeng1 + $nilaipeng2 + $nilaipeng3) / 5 }}
                                        </td>
                                    @else
                                        <td>{{ 0 }}</td>
                                    @endif
                                    <td>{{ $kompre->judul->mahasiswa->tahun_ajaran }}</td>

                                    <td>
                                        <a href="/cetak/berita-acara-kompre/{{ $kompre->id }}/download/pdf">
                                            <i class="fa fa-file-pdf text-danger"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <td colspan="7" class="text-center">No Data</td>
                        @endif

                    </tbody>
                </table>

                {{-- pagination --}}
                <div class="col-md-12 d-flex justify-content-between">
                    Show {{ $kompres->firstItem() ?? 0 }}
                    to {{ $kompres->lastItem() ?? 0 }} items
                    of total {{ $kompres->total() }} items
                    {{ $kompres->links() }}
                </div>
            </div>
        </div>
    </div>

@endsection
