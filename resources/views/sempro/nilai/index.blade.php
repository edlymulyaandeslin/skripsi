@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-12 bg-light rounded h-100 p-4 d-flex flex-column">
            <h3>Penilaian Mahasiswa Sempro</h3>

            <div class="d-flex justify-content-between mb-3 mt-1">
                <div class="col-md-5">
                    <form>
                        <input type="text" placeholder="search" class="form-control">
                    </form>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr class="text-center">
                            <th scope="col">No</th>
                            <th scope="col">Mahasiswa</th>
                            <th scope="col">Judul</th>
                            <th scope="col">Penilaian Penguji 1</th>
                            <th scope="col">Penilaian Penguji 2</th>
                            <th scope="col">Penilaian Penguji 3</th>
                            <th scope="col">Rata-rata</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>

                        @if ($sempros->count() !== 0)
                            @foreach ($sempros as $sempro)
                                <tr key="{{ $sempro->id }}" class="text-center">
                                    <th scope="row" class="text-center">{{ $loop->index + 1 }}</th>
                                    <td>{{ $sempro->judul->mahasiswa->name }}</td>
                                    <td>{{ $sempro->judul->judul }}</td>
                                    <td>{{ $nilai1 = $sempro->nilaisempro->nilai1 + $sempro->nilaisempro->nilai2 + $sempro->nilaisempro->nilai3 + $sempro->nilaisempro->nilai4 + $sempro->nilaisempro->nilai5 }}
                                    </td>
                                    <td>{{ $nilai2 = $sempro->nilaisempro->nilai6 + $sempro->nilaisempro->nilai7 + $sempro->nilaisempro->nilai8 + $sempro->nilaisempro->nilai9 + $sempro->nilaisempro->nilai10 }}
                                    </td>
                                    <td>{{ $nilai3 = $sempro->nilaisempro->nilai11 + $sempro->nilaisempro->nilai12 + $sempro->nilaisempro->nilai13 + $sempro->nilaisempro->nilai14 + $sempro->nilaisempro->nilai15 }}
                                    </td>
                                    <td>{{ number_format(($nilai1 + $nilai2 + $nilai3) / 3, 2) }}</td>

                                    {{-- <td>{{ $sempro->nilaisempro ? ($nilai = ) : ($nilai = 0) }}
                                    </td> --}}

                                    <td>
                                        <div>
                                            <button type="button" class="btn btn-sm btn-outline-dark"
                                                data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="bi bi-list"></i>
                                            </button>
                                            <ul class="dropdown-menu">
                                                <li>
                                                    <a href="javascript:void(0)" id="show-nilaisempro"
                                                        data-url="{{ route('nilai.sempro.show', $sempro->id) }}}}"
                                                        class="dropdown-item"><i class="bi bi-search text-info"></i>
                                                        Show</a>
                                                </li>

                                                <li>
                                                    <a class="dropdown-item" href="/nilai/sempro/{{ $sempro->id }}/edit">
                                                        <i class="bi bi-pencil-square text-warning"></i>
                                                        Update
                                                    </a>
                                                </li>

                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <td colspan="11" class="text-center">No Data</td>
                        @endif

                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal show -->
    <div class="modal fade " id="nilaisemproView" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Detail Penilaian</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label for="mahasiswa" class="form-label">Mahasiswa</label>
                                <input type="text" id="mahasiswa" class="form-control" disabled>
                            </div>

                            <div class="mb-3">
                                <label for="judul" class="form-label">Judul</label>
                                <input type="text" id="judul" class="form-control" disabled />
                            </div>
                        </div>
                        <div class="col-md-4">
                            <h1 class="modal-title fs-5" id="staticBackdropLabel">Penguji 1</h1>
                            <div class="mb-3">
                                <label for="nilai1" class="form-label">Nilai 1</label>
                                <input type="text" id="nilai1" class="form-control" disabled />
                            </div>
                            <div class="mb-3">
                                <label for="nilai2" class="form-label">Nilai 2</label>
                                <input type="text" id="nilai2" class="form-control" disabled />
                            </div>
                            <div class="mb-3">
                                <label for="nilai3" class="form-label">Nilai 3</label>
                                <input type="text" id="nilai3" class="form-control" disabled />
                            </div>
                            <div class="mb-3">
                                <label for="nilai4" class="form-label">Nilai 4</label>
                                <input type="text" id="nilai4" class="form-control" disabled />
                            </div>
                            <div class="mb-3">
                                <label for="nilai5" class="form-label">Nilai 5</label>
                                <input type="text" id="nilai5" class="form-control" disabled />
                            </div>
                            <div class="mb-3">
                                <label for="total1" class="form-label">Total</label>
                                <input type="text" id="total1" class="form-control" disabled />
                            </div>
                            <div class="mb-3">
                                <label for="notes1" class="form-label">Catatan</label>
                                <textarea id="notes1" class="form-control" disabled></textarea>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <h1 class="modal-title fs-5" id="staticBackdropLabel">Penguji 2</h1>
                            <div class="mb-3">
                                <label for="nilai6" class="form-label">Nilai 6</label>
                                <input type="text" id="nilai6" class="form-control" disabled />
                            </div>
                            <div class="mb-3">
                                <label for="nilai7" class="form-label">Nilai 7</label>
                                <input type="text" id="nilai7" class="form-control" disabled />
                            </div>
                            <div class="mb-3">
                                <label for="nilai8" class="form-label">Nilai 8</label>
                                <input type="text" id="nilai8" class="form-control" disabled />
                            </div>
                            <div class="mb-3">
                                <label for="nilai9" class="form-label">Nilai 9</label>
                                <input type="text" id="nilai9" class="form-control" disabled />
                            </div>
                            <div class="mb-3">
                                <label for="nilai10" class="form-label">Nilai 10</label>
                                <input type="text" id="nilai10" class="form-control" disabled />
                            </div>
                            <div class="mb-3">
                                <label for="total2" class="form-label">Total</label>
                                <input type="text" id="total2" class="form-control" disabled />
                            </div>
                            <div class="mb-3">
                                <label for="notes2" class="form-label">Catatan</label>
                                <textarea id="notes2" class="form-control" disabled></textarea>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <h1 class="modal-title fs-5" id="staticBackdropLabel">Penguji 3</h1>
                            <div class="mb-3">
                                <label for="nilai11" class="form-label">Nilai 11</label>
                                <input type="text" id="nilai11" class="form-control" disabled />
                            </div>
                            <div class="mb-3">
                                <label for="nilai12" class="form-label">Nilai 12</label>
                                <input type="text" id="nilai12" class="form-control" disabled />
                            </div>
                            <div class="mb-3">
                                <label for="nilai13" class="form-label">Nilai 13</label>
                                <input type="text" id="nilai13" class="form-control" disabled />
                            </div>
                            <div class="mb-3">
                                <label for="nilai14" class="form-label">Nilai 14</label>
                                <input type="text" id="nilai14" class="form-control" disabled />
                            </div>
                            <div class="mb-3">
                                <label for="nilai15" class="form-label">Nilai 15</label>
                                <input type="text" id="nilai15" class="form-control" disabled />
                            </div>
                            <div class="mb-3">
                                <label for="total3" class="form-label">Total</label>
                                <input type="text" id="total3" class="form-control" disabled />
                            </div>
                            <div class="mb-3">
                                <label for="notes3" class="form-label">Catatan</label>
                                <textarea id="notes3" class="form-control" disabled></textarea>
                            </div>
                        </div>
                        <div class="col-md-4 offset-8">
                            <div class="w-30">
                                <label for="rata-rata">Rata rata</label>
                                <input type="text" id="rata-rata" class="form-control" disabled />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>

    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            $('body').on('click', '#show-nilaisempro', function() {

                let judulUrl = $(this).data('url');
                $.get(judulUrl, function(data) {
                    $('#nilaisemproView').modal('show');

                    console.log(data)
                    $('#mahasiswa').val(data.judul.mahasiswa.name);

                    $('#judul').val(data.judul.judul);

                    if (data.nilaisempro !== null) {
                        $('#nilai1').val(data.nilaisempro.nilai1)
                        $('#nilai2').val(data.nilaisempro.nilai2)
                        $('#nilai3').val(data.nilaisempro.nilai3)
                        $('#nilai4').val(data.nilaisempro.nilai4)
                        $('#nilai5').val(data.nilaisempro.nilai5)
                        $('#nilai6').val(data.nilaisempro.nilai6)
                        $('#nilai7').val(data.nilaisempro.nilai7)
                        $('#nilai8').val(data.nilaisempro.nilai8)
                        $('#nilai9').val(data.nilaisempro.nilai9)
                        $('#nilai10').val(data.nilaisempro.nilai10)
                        $('#nilai11').val(data.nilaisempro.nilai11)
                        $('#nilai12').val(data.nilaisempro.nilai12)
                        $('#nilai13').val(data.nilaisempro.nilai13)
                        $('#nilai14').val(data.nilaisempro.nilai14)
                        $('#nilai15').val(data.nilaisempro.nilai15)
                    } else {
                        $('#nilai1').val('-')
                        $('#nilai2').val('-')
                        $('#nilai3').val('-')
                        $('#nilai4').val('-')
                        $('#nilai5').val('-')
                        $('#nilai6').val('-')
                        $('#nilai7').val('-')
                        $('#nilai8').val('-')
                        $('#nilai9').val('-')
                        $('#nilai10').val('-')
                        $('#nilai11').val('-')
                        $('#nilai12').val('-')
                        $('#nilai13').val('-')
                        $('#nilai14').val('-')
                        $('#nilai15').val('-')
                    }

                    let total1 = 0
                    data.nilaisempro ? total1 = data.nilaisempro.nilai1 + data.nilaisempro
                        .nilai2 + data
                        .nilaisempro.nilai3 + data.nilaisempro.nilai4 +
                        data.nilaisempro.nilai5 : total1 = 0;

                    let total2 = 0
                    data.nilaisempro ? total2 = data.nilaisempro.nilai6 + data.nilaisempro
                        .nilai7 + data
                        .nilaisempro.nilai8 + data.nilaisempro.nilai9 +
                        data.nilaisempro.nilai10 : total2 = 0;

                    let total3 = 0
                    data.nilaisempro ? total3 = data.nilaisempro.nilai11 + data.nilaisempro
                        .nilai12 + data
                        .nilaisempro.nilai13 + data.nilaisempro.nilai14 +
                        data.nilaisempro.nilai15 : total3 = 0;

                    $('#total1').val(total1);
                    $('#total2').val(total2);
                    $('#total3').val(total3);

                    $('#notes1').val(data.nilaisempro.notes1);
                    $('#notes2').val(data.nilaisempro.notes2);
                    $('#notes3').val(data.nilaisempro.notes3);

                    let ratarata = (total1 + total2 + total3) / 3;
                    $('#rata-rata').val(ratarata.toFixed(2));
                })
            })
        })
    </script>
@endsection
