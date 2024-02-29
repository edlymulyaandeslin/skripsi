@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-12 bg-light rounded h-100 p-4 d-flex flex-column">

            <div class="d-flex row justify-content-between mb-3 mt-1">
                <h4>Pembayaran Administrasi</h4>
                <div class="px-3">

                    <table class="w-50">
                        <tbody>
                            <tr>
                                <td style="width: 30%">Nama Dosen</td>
                                <td style="width: 1%">:</td>
                                <td>{{ $dosen->name }}</td>
                            </tr>
                            <tr>
                                <td style="width: 30%">Yang Harus Dibayar</td>
                                <td style="width: 1%">:</td>
                                <td class="text-success">Rp{{ number_format($totalbayar, 0, '.', '.') }}</td>
                            </tr>
                            <tr>
                                <td style="width: 30%">Yang Sudah Dibayar</td>
                                <td style="width: 1%">:</td>
                                @php
                                    $totalSudahBayar = 0;
                                    foreach ($administrasi as $index => $adm) {
                                        $totalSudahBayar += $adm->bayar;
                                    }
                                @endphp
                                <td class="text-danger">Rp{{ number_format($totalSudahBayar, 0, '.', '.') }}-</td>
                            </tr>
                            <tr>
                                <td style="width: 30%">Sisa</td>
                                <td style="width: 1%">:</td>
                                <td>Rp{{ number_format($sisa = $totalbayar - $totalSudahBayar, 0, '.', '.') }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <div>
                <a href="/adm-seminar/create/{{ $dosen->id }}/{{ $totalbayar }}"
                    class="btn btn-sm btn-warning text-white"><i class="fa fa-money-bill-wave"></i>
                    Bayar</a>
            </div>

            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr class="text-center align-middle">
                            <th scope="col">No</th>
                            <th scope="col">Tanggal Transaksi</th>
                            <th scope="col">Jumlah Bayar</th>
                            <th scope="col">Aksi</th>
                        </tr>

                    </thead>
                    <tbody>
                        @if ($administrasi->count() != 0)
                            @foreach ($administrasi as $index => $adm)
                                <tr>
                                    <td class="text-center">{{ $index + $administrasi->firstItem() }}</td>
                                    <td class="text-center">
                                        {{ \Carbon\Carbon::parse($adm->created_at)->translatedFormat('d F Y, H:i') }}
                                    </td>
                                    <td class="text-center">
                                        Rp{{ number_format($adm->bayar, 0, '.', '.') }}
                                    </td>
                                    <td class="text-center">
                                        <form action="/adm-seminar/{{ $adm->id }}" method="post">
                                            @method('delete')
                                            @csrf
                                            <button type="submit" class="btn btn-sm btn-danger"
                                                onclick="return confirm('Kamu ingin menghapus?')"><i
                                                    class="fa fa-trash"></i></button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <td colspan="4" class="text-center">No Data.</td>
                        @endif

                    </tbody>
                </table>

                {{-- pagination --}}
                <div class="col-md-12 d-flex justify-content-between">
                    Show {{ $administrasi->firstItem() ?? 0 }}
                    to {{ $administrasi->lastItem() ?? 0 }} items
                    of total {{ $administrasi->total() }} items
                    {{ $administrasi->links() }}
                </div>

            </div>
        </div>
    </div>
@endsection
