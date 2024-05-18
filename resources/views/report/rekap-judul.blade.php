@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-12 bg-light rounded h-100 p-4 d-flex flex-column">
            <h3>Judul yang telah diterima</h3>

            <div class="d-flex justify-content-between mb-3 mt-1">
                <div class="col-md-5">
                    <form action="/laporan/rekap-judul" method="GET">
                        <div class="input-group">
                            <input type="text" placeholder="search..." class="form-control" name="search"
                                value="{{ request('search') }}" autofocus>
                            <button type="submit" class="btn btn-primary">Search</button>
                        </div>
                    </form>
                </div>

                @can('koordinator')
                    <div>
                        <label for="">Mahasiswa Seminar : </label>
                        <a href="/cetak/list-judul" class="btn btn-danger btn-sm"><i class="fa fa-file-download"></i>
                            Cetak</a>
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
                            <th scope="col">Tahun Ajaran</th>
                        </tr>
                    </thead>
                    <tbody class="text-center">
                        @if ($juduls->count() != 0)
                            @foreach ($juduls as $index => $judul)
                                <tr>
                                    <td>{{ $index + $juduls->firstItem() }}</td>
                                    <td>{{ $judul->mahasiswa->nim_or_nidn }}</td>
                                    <td>{{ $judul->mahasiswa->name }}</td>
                                    <td>{{ $judul->judul }}</td>
                                    <td>{{ $judul->mahasiswa->tahun_ajaran }}
                                    </td>

                                </tr>
                            @endforeach
                        @else
                            <td colspan="8" class="text-center">No Data</td>
                        @endif
                    </tbody>
                </table>

                {{-- pagination --}}
                <div class="col-md-12 d-flex justify-content-between">
                    Show {{ $juduls->firstItem() ?? 0 }}
                    to {{ $juduls->lastItem() ?? 0 }} items
                    of total {{ $juduls->total() }} items
                    {{ $juduls->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
