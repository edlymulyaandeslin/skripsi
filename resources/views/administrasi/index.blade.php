@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-12 bg-light rounded h-100 p-4 d-flex flex-column">
            <h3>Honor Seminar TA {{ \Carbon\Carbon::now()->format('Y') . '/' . \Carbon\Carbon::now()->format('Y') + 1 }}
            </h3>

            <div class="d-flex row justify-content-between mb-3 mt-1">
                <div class="col-md-5">
                    <form action="{{ route('adm') }}">
                        <div class="input-group">
                            <input type="text" placeholder="search..." class="form-control" name="search"
                                value="{{ request('search') }}" autofocus>
                            <button type="submit" class="btn btn-primary">Search</button>
                        </div>
                    </form>
                </div>

            </div>

            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr class="text-center align-middle">
                            <th scope="col" rowspan="3">No</th>
                            <th scope="col" rowspan="3">Nama Dosen</th>
                            <th scope="col" colspan="2" style="width: 15%">Sempro</th>
                            <th scope="col" colspan="2" style="width: 15%">Kompre</th>
                            <th scope="col" rowspan="3">Total</th>
                            <th scope="col" rowspan="3">Dibayar</th>
                            <th scope="col" rowspan="3">Sisa</th>
                            @can('koordinator')
                                <th scope="col" rowspan="3">Aksi</th>
                            @endcan
                        </tr>
                        <tr class="text-center align-middle">
                            <th scope="col">Pembimbing</th>
                            <th scope="col">Penguji</th>
                            <th scope="col">Pembimbing</th>
                            <th scope="col">Penguji</th>
                        </tr>
                        <tr class="text-center align-middle">
                            <th scope="col">x{{ $hargapemSempro = 130000 }}</th>
                            <th scope="col">x{{ $hargapengSempro = 65000 }}</th>
                            <th scope="col">x{{ $hargapemKompre = 200000 }}</th>
                            <th scope="col">x{{ $hargapengKompre = 95000 }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($dosens->count() != 0)
                            @foreach ($dosens as $index => $dosen)
                                <tr key="{{ $dosen->id }}" class="text-center">
                                    <td>{{ $index + $dosens->firstItem() }}</td>
                                    <td>{{ $dosen->name }}</td>

                                    @php
                                        $pembimbingSemproCount = 0;
                                        $pengujiSemproCount = 0;
                                    @endphp
                                    @foreach ($sempros as $sempro)
                                        @if ($dosen->id == $sempro->judul->pembimbing1_id || $dosen->id == $sempro->judul->pembimbing2_id)
                                            @php
                                                $pembimbingSemproCount++;
                                            @endphp
                                        @endif

                                        @if ($dosen->id == $sempro->penguji1_id || $dosen->id == $sempro->penguji2_id || $dosen->id == $sempro->penguji3_id)
                                            @php
                                                $pengujiSemproCount++;
                                            @endphp
                                        @endif
                                    @endforeach
                                    <td>{{ $pemSempro = $pembimbingSemproCount }}</td>
                                    <td>{{ $pengSempro = $pengujiSemproCount }}</td>

                                    @php
                                        $pembimbingKompreCount = 0;
                                        $pengujiKompreCount = 0;
                                    @endphp
                                    @foreach ($kompres as $kompre)
                                        @if ($dosen->id == $kompre->judul->pembimbing1_id || $dosen->id == $kompre->judul->pembimbing2_id)
                                            @php
                                                $pembimbingKompreCount++;
                                            @endphp
                                        @endif

                                        @if ($dosen->id == $kompre->penguji1_id || $dosen->id == $kompre->penguji2_id || $dosen->id == $kompre->penguji3_id)
                                            @php
                                                $pengujiKompreCount++;
                                            @endphp
                                        @endif
                                    @endforeach
                                    <td>{{ $pemKompre = $pembimbingKompreCount }}</td>
                                    <td>{{ $pengKompre = $pengujiKompreCount }}</td>

                                    @php
                                        $totalPemSempro = $hargapemSempro * $pemSempro;
                                        $totalPengSempro = $hargapengSempro * $pengSempro;
                                        $totalPemKompre = $hargapemKompre * $pemKompre;
                                        $totalPengKompre = $hargapengKompre * $pengKompre;
                                        $total =
                                            $totalPemSempro + $totalPengSempro + $totalPemKompre + $totalPengKompre;
                                    @endphp
                                    <td>Rp{{ number_format($total, 0, '.', '.') }}</td>

                                    @php
                                        $totalBayar = 0;
                                        foreach ($administrasi as $adm) {
                                            if ($adm->dosen_id == $dosen->id) {
                                                $totalBayar += $adm->bayar;
                                            }
                                        }
                                    @endphp
                                    <td>-Rp{{ number_format($totalBayar, 0, '.', '.') }}</td>
                                    <td>Rp{{ number_format($sisa = $total - $totalBayar, 0, '.', '.') }}</td>

                                    @can('koordinator')
                                        <td>
                                            <a href="{{ route('adm.pay', [$dosen->id, $total]) }}"
                                                class="btn btn-sm btn-outline-dark text-warning"><i
                                                    class="fa fa-money-bill-wave"></i>
                                                Pay</a>
                                        </td>
                                    @endcan
                                </tr>
                            @endforeach
                        @else
                            <td colspan="11" class="text-center">No Data.</td>
                        @endif

                    </tbody>
                </table>

                {{-- pagination --}}
                <div class="col-md-12 d-flex justify-content-between">
                    Show {{ $dosens->firstItem() ?? 0 }}
                    to {{ $dosens->lastItem() ?? 0 }} items
                    of total {{ $dosens->total() }} items
                    {{ $dosens->links() }}
                </div>

            </div>
        </div>
    </div>
@endsection
