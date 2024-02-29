@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-12 bg-light rounded h-100 p-4 d-flex flex-column">
            <h3>Mahasiswa Yudisium</h3>

            <div class="d-flex justify-content-between mb-3 mt-1">
                <div class="col-md-6">
                    <form>
                        <input type="text" placeholder="search" class="form-control w-75">
                    </form>
                </div>
                @can('koordinator')
                    <div class="col-md-6">
                        <form action="/cetak/yudisium" class="d-flex flex-column gap-2" method="post">
                            @csrf
                            <div class="d-flex gap-2">
                                <div class="w-100">
                                    <label for="">Periode</label>
                                    <input type="date" class="form-control" name="tanggalAwal"
                                        value="{{ old('tanggalAwal') }}" required>
                                </div>
                                <div class="w-100">
                                    <label for="">Sampai</label>
                                    <input type="date" class="form-control" name="tanggalAkhir"
                                        value="{{ old('tanggalAkhir') }}" required>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-sm btn-danger"><i class="fa fa-file-download"></i>
                                Cetak</button>
                        </form>
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
                            <th scope="col">Tanggal Lulus</th>
                            <th scope="col">Nilai</th>
                            <th scope="col">Status</th>
                        </tr>
                    </thead>
                    <tbody class="text-center">
                        @if ($users->count() !== 0)
                            @foreach ($users as $index => $user)
                                @foreach ($user->judul as $judul)
                                    @if ($judul->status == 'diterima')
                                        <tr>
                                            <td>{{ $index + $users->firstItem() }}</td>
                                            <td>{{ $user->nim_or_nidn }}</td>
                                            <td>{{ $user->name }}</td>
                                            <td>{{ $judul->judul }}</td>
                                            {{ $judul->judul }}
                                            <td>{{ \Carbon\Carbon::parse($judul->kompre[0]->updated_at)->translatedFormat('d F Y') }}
                                            </td>
                                            @php
                                                $judul->sempro[0]->nilaisempro
                                                    ? ($nilaisempro =
                                                        ($judul->sempro[0]->nilaisempro->nilai1_pem1 +
                                                            $judul->sempro[0]->nilaisempro->nilai2_pem1 +
                                                            $judul->sempro[0]->nilaisempro->nilai3_pem1 +
                                                            $judul->sempro[0]->nilaisempro->nilai4_pem1 +
                                                            $judul->sempro[0]->nilaisempro->nilai5_pem1 +
                                                            $judul->sempro[0]->nilaisempro->nilai6_pem1 +
                                                            $judul->sempro[0]->nilaisempro->nilai7_pem1 +
                                                            $judul->sempro[0]->nilaisempro->nilai1_pem2 +
                                                            $judul->sempro[0]->nilaisempro->nilai2_pem2 +
                                                            $judul->sempro[0]->nilaisempro->nilai3_pem2 +
                                                            $judul->sempro[0]->nilaisempro->nilai4_pem2 +
                                                            $judul->sempro[0]->nilaisempro->nilai5_pem2 +
                                                            $judul->sempro[0]->nilaisempro->nilai6_pem2 +
                                                            $judul->sempro[0]->nilaisempro->nilai7_pem2 +
                                                            $judul->sempro[0]->nilaisempro->nilai1_peng1 +
                                                            $judul->sempro[0]->nilaisempro->nilai2_peng1 +
                                                            $judul->sempro[0]->nilaisempro->nilai3_peng1 +
                                                            $judul->sempro[0]->nilaisempro->nilai4_peng1 +
                                                            $judul->sempro[0]->nilaisempro->nilai5_peng1 +
                                                            $judul->sempro[0]->nilaisempro->nilai1_peng2 +
                                                            $judul->sempro[0]->nilaisempro->nilai2_peng2 +
                                                            $judul->sempro[0]->nilaisempro->nilai3_peng2 +
                                                            $judul->sempro[0]->nilaisempro->nilai4_peng2 +
                                                            $judul->sempro[0]->nilaisempro->nilai5_peng2 +
                                                            $judul->sempro[0]->nilaisempro->nilai1_peng3 +
                                                            $judul->sempro[0]->nilaisempro->nilai2_peng3 +
                                                            $judul->sempro[0]->nilaisempro->nilai3_peng3 +
                                                            $judul->sempro[0]->nilaisempro->nilai4_peng3 +
                                                            $judul->sempro[0]->nilaisempro->nilai5_peng3) /
                                                        5)
                                                    : ($nilaisempro = 0);

                                                $judul->kompre[0]->nilaikompre
                                                    ? ($nilaikompre =
                                                        ($judul->kompre[0]->nilaikompre->nilai1_pem1 +
                                                            $judul->kompre[0]->nilaikompre->nilai2_pem1 +
                                                            $judul->kompre[0]->nilaikompre->nilai3_pem1 +
                                                            $judul->kompre[0]->nilaikompre->nilai4_pem1 +
                                                            $judul->kompre[0]->nilaikompre->nilai1_pem2 +
                                                            $judul->kompre[0]->nilaikompre->nilai2_pem2 +
                                                            $judul->kompre[0]->nilaikompre->nilai3_pem2 +
                                                            $judul->kompre[0]->nilaikompre->nilai4_pem2 +
                                                            $judul->kompre[0]->nilaikompre->nilai1_peng1 +
                                                            $judul->kompre[0]->nilaikompre->nilai2_peng1 +
                                                            $judul->kompre[0]->nilaikompre->nilai3_peng1 +
                                                            $judul->kompre[0]->nilaikompre->nilai4_peng1 +
                                                            $judul->kompre[0]->nilaikompre->nilai1_peng2 +
                                                            $judul->kompre[0]->nilaikompre->nilai2_peng2 +
                                                            $judul->kompre[0]->nilaikompre->nilai3_peng2 +
                                                            $judul->kompre[0]->nilaikompre->nilai4_peng2 +
                                                            $judul->kompre[0]->nilaikompre->nilai1_peng3 +
                                                            $judul->kompre[0]->nilaikompre->nilai2_peng3 +
                                                            $judul->kompre[0]->nilaikompre->nilai3_peng3 +
                                                            $judul->kompre[0]->nilaikompre->nilai4_peng3) /
                                                        25)
                                                    : ($nilaikompre = 0);
                                            @endphp
                                            <td>
                                                {{ ($nilaisempro + $nilaikompre) / 2 }}
                                            </td>
                                            <td>
                                                <span class="bg-primary text-white px-3 py-1 rounded">
                                                    {{ $user->status }}
                                                </span>
                                            </td>
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
