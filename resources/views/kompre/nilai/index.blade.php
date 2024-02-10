@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-12 bg-light rounded h-100 p-4 d-flex flex-column">
            <h3>Penilaian Seminar Komprehensif</h3>

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
                            <th scope="col">Pembimbing 1</th>
                            <th scope="col">Pembimbing 2</th>
                            <th scope="col">Penguji 1</th>
                            <th scope="col">Penguji 2</th>
                            <th scope="col">Penguji 3</th>
                            <th scope="col">Rata-rata</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>

                        @if ($kompres->count() !== 0)
                            @foreach ($kompres as $kompre)
                                <tr key="{{ $kompre->id }}" class="text-center">
                                    <th scope="row" class="text-center">{{ $loop->index + 1 }}</th>
                                    <td>{{ $kompre->judul->mahasiswa->name }}</td>
                                    <td>{{ $kompre->judul->judul }}</td>
                                    <td>{{ $kompre->nilaikompre ? ($nilaiPem1 = $kompre->nilaikompre->nilai1_pem1 + $kompre->nilaikompre->nilai2_pem1 + $kompre->nilaikompre->nilai3_pem1 + $kompre->nilaikompre->nilai4_pem1 + $kompre->nilaikompre->nilai5_pem1 + $kompre->nilaikompre->nilai6_pem1 + $kompre->nilaikompre->nilai7_pem1) : ($nilaiPem1 = 0) }}
                                    </td>
                                    <td>{{ $kompre->nilaikompre ? ($nilaiPem2 = $kompre->nilaikompre->nilai1_pem2 + $kompre->nilaikompre->nilai2_pem2 + $kompre->nilaikompre->nilai3_pem2 + $kompre->nilaikompre->nilai4_pem2 + $kompre->nilaikompre->nilai5_pem2 + $kompre->nilaikompre->nilai6_pem2 + $kompre->nilaikompre->nilai7_pem2) : ($nilaiPem2 = 0) }}
                                    </td>
                                    <td>{{ $kompre->nilaikompre ? ($nilaiPenguji1 = $kompre->nilaikompre->nilai1_peng1 + $kompre->nilaikompre->nilai2_peng1 + $kompre->nilaikompre->nilai3_peng1 + $kompre->nilaikompre->nilai4_peng1 + $kompre->nilaikompre->nilai5_peng1) : ($nilaiPenguji1 = 0) }}
                                    </td>
                                    <td>{{ $kompre->nilaikompre ? ($nilaiPenguji2 = $kompre->nilaikompre->nilai1_peng2 + $kompre->nilaikompre->nilai2_peng2 + $kompre->nilaikompre->nilai3_peng2 + $kompre->nilaikompre->nilai4_peng2 + $kompre->nilaikompre->nilai5_peng2) : ($nilaiPenguji2 = 0) }}
                                    </td>
                                    <td>{{ $kompre->nilaikompre ? ($nilaiPenguji3 = $kompre->nilaikompre->nilai1_peng3 + $kompre->nilaikompre->nilai2_peng3 + $kompre->nilaikompre->nilai3_peng3 + $kompre->nilaikompre->nilai4_peng3 + $kompre->nilaikompre->nilai5_peng3) : ($nilaiPenguji3 = 0) }}
                                    </td>
                                    <td>
                                        {{ number_format(($nilaiPenguji1 + $nilaiPenguji2 + $nilaiPenguji3 + $nilaiPem1 + $nilaiPem2) / 5, 2) }}
                                    </td>

                                    <td>
                                        <div>
                                            <button type="button" class="btn btn-sm btn-outline-dark"
                                                data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="bi bi-list"></i>
                                            </button>
                                            <ul class="dropdown-menu">
                                                <li>
                                                    <a href="javascript:void(0)" id="show-nilaikompre"
                                                        data-url="{{ route('nilai.kompre.show', $kompre->id) }}}}"
                                                        class="dropdown-item"><i class="bi bi-search text-info"></i>
                                                        Show</a>
                                                </li>

                                                <li>
                                                    <a class="dropdown-item" href="/nilai/kompre/{{ $kompre->id }}/edit">
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
    <div class="modal fade " id="nilaikompreView" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5">Detail Penilaian</h1>
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
                        <hr>
                        <div class="col-md-4">
                            <h1 class="modal-title fs-5">Penguji 1</h1>
                            <div class="mb-3">
                                <label for="nilai1_peng1" class="form-label">Menjawab Latar Belakang Masalah</label>
                                <input type="text" id="nilai1_peng1" class="form-control" disabled />
                            </div>
                            <div class="mb-3">
                                <label for="nilai2_peng1" class="form-label">Menguasai Teori Pendukung TA</label>
                                <input type="text" id="nilai2_peng1" class="form-control" disabled />
                            </div>
                            <div class="mb-3">
                                <label for="nilai3_peng1" class="form-label">Menguasai Materi Terkait Tools
                                    Pemodelan</label>
                                <input type="text" id="nilai3_peng1" class="form-control" disabled />
                            </div>
                            <div class="mb-3">
                                <label for="nilai4_peng1" class="form-label">Pemaparan Cara Menjawab</label>
                                <input type="text" id="nilai4_peng1" class="form-control" disabled />
                            </div>
                            <div class="mb-3">
                                <label for="nilai5_peng1" class="form-label">Komunikasi Interpersonal</label>
                                <input type="text" id="nilai5_peng1" class="form-control" disabled />
                            </div>
                            <div class="mb-3">
                                <label for="totalPenguji1" class="form-label">Total</label>
                                <input type="text" id="totalPenguji1" class="form-control" disabled />
                            </div>
                            <div class="mb-3">
                                <label for="notes1" class="form-label">Catatan</label>
                                <textarea id="notes1" class="form-control" disabled></textarea>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <h1 class="modal-title fs-5">Penguji 2</h1>
                            <div class="mb-3">
                                <label for="nilai1_peng2" class="form-label">Menjawab Latar Belakang Masalah</label>
                                <input type="text" id="nilai1_peng2" class="form-control" disabled />
                            </div>
                            <div class="mb-3">
                                <label for="nilai2_peng2" class="form-label">Menguasai Teori Pendukung TA</label>
                                <input type="text" id="nilai2_peng2" class="form-control" disabled />
                            </div>
                            <div class="mb-3">
                                <label for="nilai3_peng2" class="form-label">Menguasai Materi Terkait Tools</label>
                                <input type="text" id="nilai3_peng2" class="form-control" disabled />
                            </div>
                            <div class="mb-3">
                                <label for="nilai4_peng2" class="form-label">Pemaparan Cara Menjawab</label>
                                <input type="text" id="nilai4_peng2" class="form-control" disabled />
                            </div>
                            <div class="mb-3">
                                <label for="nilai5_peng2" class="form-label">Komunikasi Interpersonal</label>
                                <input type="text" id="nilai5_peng2" class="form-control" disabled />
                            </div>
                            <div class="mb-3">
                                <label for="totalPenguji2" class="form-label">Total</label>
                                <input type="text" id="totalPenguji2" class="form-control" disabled />
                            </div>
                            <div class="mb-3">
                                <label for="notes2" class="form-label">Catatan</label>
                                <textarea id="notes2" class="form-control" disabled></textarea>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <h1 class="modal-title fs-5">Penguji 3</h1>
                            <div class="mb-3">
                                <label for="nilai1_peng3" class="form-label">Menjawab Latar Belakang Masalah</label>
                                <input type="text" id="nilai1_peng3" class="form-control" disabled />
                            </div>
                            <div class="mb-3">
                                <label for="nilai2_peng3" class="form-label">Menguasai Teori Pendukung TA</label>
                                <input type="text" id="nilai2_peng3" class="form-control" disabled />
                            </div>
                            <div class="mb-3">
                                <label for="nilai3_peng3" class="form-label">Menguasai Materi Terkait Tools</label>
                                <input type="text" id="nilai3_peng3" class="form-control" disabled />
                            </div>
                            <div class="mb-3">
                                <label for="nilai4_peng3" class="form-label">Pemaparan Cara Menjawab</label>
                                <input type="text" id="nilai4_peng3" class="form-control" disabled />
                            </div>
                            <div class="mb-3">
                                <label for="nilai5_peng3" class="form-label">Komunikasi Interpersonal</label>
                                <input type="text" id="nilai5_peng3" class="form-control" disabled />
                            </div>
                            <div class="mb-3">
                                <label for="totalPenguji3" class="form-label">Total</label>
                                <input type="text" id="totalPenguji3" class="form-control" disabled />
                            </div>
                            <div class="mb-3">
                                <label for="notes3" class="form-label">Catatan</label>
                                <textarea id="notes3" class="form-control" disabled></textarea>
                            </div>
                        </div>
                        <hr>
                        <div class="col-md-4">
                            <h1 class="modal-title fs-5">Pembimbing 1</h1>
                            <div class="mb-3">
                                <label for="nilai1_pem1" class="form-label">Kemampuan Memilih Tema</label>
                                <input type="text" id="nilai1_pem1" class="form-control" disabled />
                            </div>
                            <div class="mb-3">
                                <label for="nilai2_pem1" class="form-label">Cara menyajikan pertanyaan penelitian/problem
                                    statement</label>
                                <input type="text" id="nilai2_pem1" class="form-control" disabled />
                            </div>
                            <div class="mb-3">
                                <label for="nilai3_pem1" class="form-label">Problem Solving</label>
                                <input type="text" id="nilai3_pem1" class="form-control" disabled />
                            </div>
                            <div class="mb-3">
                                <label for="nilai4_pem1" class="form-label">Pemilihan model atau metode</label>
                                <input type="text" id="nilai4_pem1" class="form-control" disabled />
                            </div>
                            <div class="mb-3">
                                <label for="nilai5_pem1" class="form-label">Rencana implementasi
                                    simulasi/komputasi</label>
                                <input type="text" id="nilai5_pem1" class="form-control" disabled />
                            </div>
                            <div class="mb-3">
                                <label for="nilai6_pem1" class="form-label">Kemandirian dalam penyusunal proposal</label>
                                <input type="text" id="nilai6_pem1" class="form-control" disabled />
                            </div>
                            <div class="mb-3">
                                <label for="nilai7_pem1" class="form-label">Proses bimbingan</label>
                                <input type="text" id="nilai7_pem1" class="form-control" disabled />
                            </div>
                            <div class="mb-3">
                                <label for="totalPem1" class="form-label">Total</label>
                                <input type="text" id="totalPem1" class="form-control" disabled />
                            </div>
                        </div>

                        <div class="col-md-4">
                            <h1 class="modal-title fs-5">Pembimbing 2</h1>
                            <div class="mb-3">
                                <label for="nilai1_pem2" class="form-label">Kemampuan Memilih Tema</label>
                                <input type="text" id="nilai1_pem2" class="form-control" disabled />
                            </div>
                            <div class="mb-3">
                                <label for="nilai2_pem2" class="form-label">Cara menyajikan pertanyaan penelitian/problem
                                    statement</label>
                                <input type="text" id="nilai2_pem2" class="form-control" disabled />
                            </div>
                            <div class="mb-3">
                                <label for="nilai3_pem2" class="form-label">Problem Solving</label>
                                <input type="text" id="nilai3_pem2" class="form-control" disabled />
                            </div>
                            <div class="mb-3">
                                <label for="nilai4_pem2" class="form-label">Pemilihan model atau metode</label>
                                <input type="text" id="nilai4_pem2" class="form-control" disabled />
                            </div>
                            <div class="mb-3">
                                <label for="nilai5_pem2" class="form-label">Rencana implementasi
                                    simulasi/komputasi</label>
                                <input type="text" id="nilai5_pem2" class="form-control" disabled />
                            </div>
                            <div class="mb-3">
                                <label for="nilai6_pem2" class="form-label">Kemandirian dalam penyusunal proposal</label>
                                <input type="text" id="nilai6_pem2" class="form-control" disabled />
                            </div>
                            <div class="mb-3">
                                <label for="nilai7_pem2" class="form-label">Proses bimbingan</label>
                                <input type="text" id="nilai7_pem2" class="form-control" disabled />
                            </div>
                            <div class="mb-3">
                                <label for="totalPem2" class="form-label">Total</label>
                                <input type="text" id="totalPem2" class="form-control" disabled />
                            </div>
                        </div>
                        <hr>
                        <div class="col-md-4">
                            <h1 class="modal-title fs-5">Rata Rata Nilai</h1>
                            <input type="text" id="rata-rata" class="form-control" disabled />
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
            $('body').on('click', '#show-nilaikompre', function() {

                let judulUrl = $(this).data('url');
                $.get(judulUrl, function(data) {
                    $('#nilaikompreView').modal('show');

                    console.log(data)
                    $('#mahasiswa').val(data.judul.mahasiswa.name);

                    $('#judul').val(data.judul.judul);

                    if (data.nilaikompre != null) {
                        $('#nilai1_peng1').val(data.nilaikompre.nilai1_peng1)
                        $('#nilai2_peng1').val(data.nilaikompre.nilai2_peng1)
                        $('#nilai3_peng1').val(data.nilaikompre.nilai3_peng1)
                        $('#nilai4_peng1').val(data.nilaikompre.nilai4_peng1)
                        $('#nilai5_peng1').val(data.nilaikompre.nilai5_peng1)

                        $('#nilai1_peng2').val(data.nilaikompre.nilai1_peng2)
                        $('#nilai2_peng2').val(data.nilaikompre.nilai2_peng2)
                        $('#nilai3_peng2').val(data.nilaikompre.nilai3_peng2)
                        $('#nilai4_peng2').val(data.nilaikompre.nilai4_peng2)
                        $('#nilai5_peng2').val(data.nilaikompre.nilai5_peng2)

                        $('#nilai1_peng3').val(data.nilaikompre.nilai1_peng3)
                        $('#nilai2_peng3').val(data.nilaikompre.nilai2_peng3)
                        $('#nilai3_peng3').val(data.nilaikompre.nilai3_peng3)
                        $('#nilai4_peng3').val(data.nilaikompre.nilai4_peng3)
                        $('#nilai5_peng3').val(data.nilaikompre.nilai5_peng3)

                        $('#nilai1_pem1').val(data.nilaikompre.nilai1_pem1)
                        $('#nilai2_pem1').val(data.nilaikompre.nilai2_pem1)
                        $('#nilai3_pem1').val(data.nilaikompre.nilai3_pem1)
                        $('#nilai4_pem1').val(data.nilaikompre.nilai4_pem1)
                        $('#nilai5_pem1').val(data.nilaikompre.nilai5_pem1)
                        $('#nilai6_pem1').val(data.nilaikompre.nilai6_pem1)
                        $('#nilai7_pem1').val(data.nilaikompre.nilai7_pem1)

                        $('#nilai1_pem2').val(data.nilaikompre.nilai1_pem2)
                        $('#nilai2_pem2').val(data.nilaikompre.nilai2_pem2)
                        $('#nilai3_pem2').val(data.nilaikompre.nilai3_pem2)
                        $('#nilai4_pem2').val(data.nilaikompre.nilai4_pem2)
                        $('#nilai5_pem2').val(data.nilaikompre.nilai5_pem2)
                        $('#nilai6_pem2').val(data.nilaikompre.nilai6_pem2)
                        $('#nilai7_pem2').val(data.nilaikompre.nilai7_pem2)

                        $('#notes1').val(data.nilaikompre.notes1);
                        $('#notes2').val(data.nilaikompre.notes2);
                        $('#notes3').val(data.nilaikompre.notes3);

                    } else {
                        $('#nilai1_peng1').val('-')
                        $('#nilai2_peng1').val('-')
                        $('#nilai3_peng1').val('-')
                        $('#nilai4_peng1').val('-')
                        $('#nilai5_peng1').val('-')

                        $('#nilai1_peng2').val('-')
                        $('#nilai2_peng2').val('-')
                        $('#nilai3_peng2').val('-')
                        $('#nilai4_peng2').val('-')
                        $('#nilai5_peng2').val('-')

                        $('#nilai1_peng3').val('-')
                        $('#nilai2_peng3').val('-')
                        $('#nilai3_peng3').val('-')
                        $('#nilai4_peng3').val('-')
                        $('#nilai5_peng3').val('-')

                        $('#nilai1_pem1').val('-')
                        $('#nilai2_pem1').val('-')
                        $('#nilai3_pem1').val('-')
                        $('#nilai4_pem1').val('-')
                        $('#nilai5_pem1').val('-')
                        $('#nilai6_pem1').val('-')
                        $('#nilai7_pem1').val('-')

                        $('#nilai1_pem2').val('-')
                        $('#nilai2_pem2').val('-')
                        $('#nilai3_pem2').val('-')
                        $('#nilai4_pem2').val('-')
                        $('#nilai5_pem2').val('-')
                        $('#nilai6_pem2').val('-')
                        $('#nilai7_pem2').val('-')

                        $('#notes1').val('-');
                        $('#notes2').val('-');
                        $('#notes3').val('-');
                    }

                    // perhitungan total nilai
                    let totalPenguji1 = 0
                    data.nilaikompre ? totalPenguji1 =
                        data.nilaikompre.nilai1_peng1 + data.nilaikompre.nilai2_peng1 +
                        data.nilaikompre.nilai3_peng1 + data.nilaikompre.nilai4_peng1 +
                        data.nilaikompre.nilai5_peng1 : totalPenguji1 = 0;

                    let totalPenguji2 = 0
                    data.nilaikompre ? totalPenguji2 =
                        data.nilaikompre.nilai1_peng2 + data.nilaikompre.nilai2_peng2 +
                        data.nilaikompre.nilai3_peng2 + data.nilaikompre.nilai4_peng2 +
                        data.nilaikompre.nilai5_peng2 : totalPenguji2 = 0;

                    let totalPenguji3 = 0
                    data.nilaikompre ? totalPenguji3 =
                        data.nilaikompre.nilai1_peng3 + data.nilaikompre.nilai2_peng3 +
                        data.nilaikompre.nilai3_peng3 + data.nilaikompre.nilai4_peng3 +
                        data.nilaikompre.nilai5_peng3 : totalPenguji3 = 0;

                    let totalPem1 = 0
                    data.nilaikompre ? totalPem1 =
                        data.nilaikompre.nilai1_pem1 + data.nilaikompre.nilai2_pem1 +
                        data.nilaikompre.nilai3_pem1 + data.nilaikompre.nilai4_pem1 +
                        data.nilaikompre.nilai5_pem1 + data.nilaikompre.nilai6_pem1 +
                        data.nilaikompre.nilai7_pem1 : totalPem1 = 0;

                    let totalPem2 = 0
                    data.nilaikompre ? totalPem2 =
                        data.nilaikompre.nilai1_pem2 + data.nilaikompre.nilai2_pem2 +
                        data.nilaikompre.nilai3_pem2 + data.nilaikompre.nilai4_pem2 +
                        data.nilaikompre.nilai5_pem2 + data.nilaikompre.nilai6_pem2 +
                        data.nilaikompre.nilai7_pem2 : totalPem2 = 0;

                    // memasukkan nilai kedalam field
                    $('#totalPenguji1').val(totalPenguji1);
                    $('#totalPenguji2').val(totalPenguji2);
                    $('#totalPenguji3').val(totalPenguji3);
                    $('#totalPem1').val(totalPem1);
                    $('#totalPem2').val(totalPem2);

                    let ratarata = (totalPenguji1 + totalPenguji2 + totalPenguji3 + totalPem1 +
                        totalPem2) / 5;
                    ratarata != 0 ? $('#rata-rata').val(ratarata.toFixed(2)) :
                        $('#rata-rata').val('0.00');

                })
            })
        })
    </script>
@endsection
