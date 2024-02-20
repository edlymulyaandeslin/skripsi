@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-12 bg-light rounded h-100 p-4 d-flex flex-column">
            <h3>Berita Acara Seminar Komprehensif</h3>

            <div class="d-flex justify-content-between mb-3 mt-1">
                <div class="col-md-5">
                    <form>
                        <input type="text" placeholder="search" class="form-control">
                    </form>
                </div>
                @can('koordinator')
                    <div>
                        <a href="/cetak/list-mahasiswa-kompre" class="btn btn-danger btn-sm"><i class="fa fa-file-download"></i>
                            Mahasiswa
                            Komprehensif</a>
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
