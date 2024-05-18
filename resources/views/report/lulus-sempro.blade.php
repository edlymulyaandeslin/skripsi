@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-12 bg-light rounded h-100 p-4 d-flex flex-column">
            <h3>Mahasiswa Lulus Seminar Proposal</h3>

            <div class="d-flex justify-content-between mb-3 mt-1">
                <div class="col-md-5">
                    <form action="/laporan/lulus-sempro">
                        <div class="input-group">
                            <input type="text" placeholder="search..." class="form-control" name="search"
                                value="{{ request('search') }}" autofocus>
                            <button type="submit" class="btn btn-primary">Search</button>
                        </div>
                    </form>
                </div>
                {{-- @can('koordinator')
                    <div>
                        <label for="">Lulus Sempro :</label>
                        <a href="/cetak/lulus-sempro" class="btn btn-danger btn-sm"><i class="fa fa-file-download"></i>
                            Cetak</a>
                    </div>
                @endcan --}}
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
                            <th scope="col">Berita Acara</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($sempros->count() !== 0)
                            @foreach ($sempros as $index => $sempro)
                                <tr key="{{ $sempro->id }}" class="text-center">
                                    <th>{{ $index + $sempros->firstItem() }}</th>
                                    <td>{{ $sempro->judul->mahasiswa->nim_or_nidn }}</td>
                                    <td>{{ $sempro->judul->mahasiswa->name }}</td>
                                    <td>{{ $sempro->judul->judul }}</td>
                                    <td>{{ \Carbon\Carbon::parse($sempro->tanggal_seminar)->translatedFormat('d F Y') }}
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

                                    <td>
                                        <a href="/cetak/berita-acara-sempro/{{ $sempro->id }}/download/pdf">
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
                    Show {{ $sempros->firstItem() ?? 0 }}
                    to {{ $sempros->lastItem() ?? 0 }} items
                    of total {{ $sempros->total() }} items
                    {{ $sempros->links() }}
                </div>
            </div>
        </div>
    </div>

@endsection
