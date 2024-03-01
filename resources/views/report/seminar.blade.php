@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-12 bg-light rounded h-100 p-4 d-flex flex-column">
            <h3>Mahasiswa Seminar</h3>

            <div class="d-flex justify-content-between mb-3 mt-1">
                <div class="col-md-5">
                    <form action="/laporan/seminar">
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
                        <a href="/cetak/list-mahasiswa-seminar" class="btn btn-danger btn-sm"><i
                                class="fa fa-file-download"></i>
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
                            <th scope="col">Dosen Pembimbing</th>
                            <th scope="col">Dosen Penguji</th>
                            <th scope="col">Tanggal Seminar</th>
                            <th scope="col">Jenis Seminar</th>
                        </tr>
                    </thead>
                    <tbody class="text-center">
                        @if ($users->count() !== 0)
                            @foreach ($users as $index => $user)
                                @foreach ($user->judul as $judul)
                                    @if ($judul->status == 'diterima')
                                        <tr>
                                            <td rowspan="3">{{ $index + $users->firstItem() }}</td>
                                            <td rowspan="3">{{ $user->nim_or_nidn }}</td>
                                            <td rowspan="3">{{ $user->name }}</td>
                                            <td rowspan="3">{{ $judul->judul }}</td>
                                            <td>{{ $judul->pembimbing1->name }}</td>

                                            @if ($judul->sempro[0]->status == 'diterima')
                                                <td>{{ $judul->sempro[0]->penguji1->name }}</td>
                                                <td rowspan="3">
                                                    {{ $judul->sempro[0]->tanggal_seminar ? \Carbon\Carbon::parse($judul->sempro[0]->tanggal_seminar)->translatedFormat('d F Y') : '-' }}
                                                </td>
                                                <td rowspan="3">Proposal</td>
                                            @elseif ($judul->kompre[0]->status == 'diterima')
                                                <td>{{ $judul->kompre[0]->penguji1->name }}</td>
                                                <td rowspan="3">
                                                    {{ $judul->kompre[0]->tanggal_seminar ? \Carbon\Carbon::parse($judul->kompre[0]->tanggal_seminar)->translatedFormat('d F Y') : '-' }}
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
                                    @endif
                                @endforeach
                            @endforeach
                        @else
                            <td colspan="8" class="text-center">No Data</td>
                        @endif
                    </tbody>
                </table>

                {{-- pagination --}}
                <div class="col-md-12 d-flex justify-content-between">
                    Show {{ $users->firstItem() ?? 0 }}
                    to {{ $users->lastItem() ?? 0 }} items
                    of total {{ $users->total() }} items
                    {{ $users->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
