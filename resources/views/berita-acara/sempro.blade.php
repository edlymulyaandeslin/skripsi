@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-12 bg-light rounded h-100 p-4 d-flex flex-column">
            <h3>Berita Acara Seminar Proposal</h3>

            <div class="d-flex justify-content-between mb-3 mt-1">
                <div class="col-md-5">
                    <form>
                        <input type="text" placeholder="search" class="form-control">
                    </form>
                </div>
                @can('koordinator')
                    <div>
                        <a href="/cetak/list-mahasiswa-sempro" class="btn btn-danger btn-sm"><i class="fa fa-file-download"></i>
                            Mahasiswa
                            Seminar</a>
                    </div>
                @endcan
            </div>

            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr class="text-center align-middle">
                            <th scope="col">No</th>
                            <th scope="col">Nim</th>
                            <th scope="col">Mahasiswa</th>
                            <th scope="col">Judul</th>
                            <th scope="col">Tanggal Seminar</th>
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
