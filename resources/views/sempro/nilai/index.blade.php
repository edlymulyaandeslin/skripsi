@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-12 bg-light rounded h-100 p-4 d-flex flex-column">
            <h3>Penilaian Seminar Proposal</h3>

            @cannot('mahasiswa')
                <div class="d-flex justify-content-between mb-3 mt-1">
                    <div class="col-md-5">
                        <form action="{{ route('nilai-sempro.index') }}">
                            <div class="input-group">
                                <input type="text" placeholder="search..." class="form-control" name="search"
                                    value="{{ request('search') }}" autofocus>
                                <button type="submit" class="btn btn-primary">Search</button>
                            </div>
                        </form>
                    </div>
                </div>
            @endcannot

            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr class="text-center align-middle">
                            <th scope="col">No</th>
                            @cannot('mahasiswa')
                                <th scope="col">Mahasiswa</th>
                            @endcannot
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

                        @if ($sempros->count() !== 0)
                            @foreach ($sempros as $index => $sempro)
                                <tr key="{{ $sempro->id }}" class="text-center">
                                    <th scope="row" class="text-center">{{ $index + $sempros->firstItem() }}</th>
                                    @cannot('mahasiswa')
                                        <td>{{ $sempro->judul->mahasiswa->name }}</td>
                                    @endcannot
                                    <td>{{ $sempro->judul->judul }}</td>

                                    <td>{{ $sempro->nilaisempro ? ($nilaiPem1 = $sempro->nilaisempro->nilai1_pem1 + $sempro->nilaisempro->nilai2_pem1 + $sempro->nilaisempro->nilai3_pem1 + $sempro->nilaisempro->nilai4_pem1 + $sempro->nilaisempro->nilai5_pem1 + $sempro->nilaisempro->nilai6_pem1 + $sempro->nilaisempro->nilai7_pem1) : ($nilaiPem1 = 0) }}
                                    </td>
                                    <td>{{ $sempro->nilaisempro ? ($nilaiPem2 = $sempro->nilaisempro->nilai1_pem2 + $sempro->nilaisempro->nilai2_pem2 + $sempro->nilaisempro->nilai3_pem2 + $sempro->nilaisempro->nilai4_pem2 + $sempro->nilaisempro->nilai5_pem2 + $sempro->nilaisempro->nilai6_pem2 + $sempro->nilaisempro->nilai7_pem2) : ($nilaiPem2 = 0) }}
                                    </td>
                                    <td>{{ $sempro->nilaisempro ? ($nilaiPenguji1 = $sempro->nilaisempro->nilai1_peng1 + $sempro->nilaisempro->nilai2_peng1 + $sempro->nilaisempro->nilai3_peng1 + $sempro->nilaisempro->nilai4_peng1 + $sempro->nilaisempro->nilai5_peng1) : ($nilaiPenguji1 = 0) }}
                                    </td>
                                    <td>{{ $sempro->nilaisempro ? ($nilaiPenguji2 = $sempro->nilaisempro->nilai1_peng2 + $sempro->nilaisempro->nilai2_peng2 + $sempro->nilaisempro->nilai3_peng2 + $sempro->nilaisempro->nilai4_peng2 + $sempro->nilaisempro->nilai5_peng2) : ($nilaiPenguji2 = 0) }}
                                    </td>
                                    <td>{{ $sempro->nilaisempro ? ($nilaiPenguji3 = $sempro->nilaisempro->nilai1_peng3 + $sempro->nilaisempro->nilai2_peng3 + $sempro->nilaisempro->nilai3_peng3 + $sempro->nilaisempro->nilai4_peng3 + $sempro->nilaisempro->nilai5_peng3) : ($nilaiPenguji3 = 0) }}
                                    </td>
                                    <td>
                                        {{ number_format($totalNilai = ($nilaiPenguji1 + $nilaiPenguji2 + $nilaiPenguji3 + $nilaiPem1 + $nilaiPem2) / 5, 2) }}
                                    </td>

                                    <td>
                                        @can('dosen')
                                            <div>
                                                <button type="button" class="btn btn-sm btn-outline-dark"
                                                    data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="bi bi-list"></i>
                                                </button>
                                                <ul class="dropdown-menu">
                                                    <li>
                                                        <a href="javascript:void(0)" id="show-nilaisempro"
                                                            data-url="{{ route('nilai-sempro.show', $sempro->id) }}"
                                                            class="dropdown-item"><i class="bi bi-search text-info"></i>
                                                            Lihat</a>
                                                    </li>

                                                    <li>
                                                        <a class="dropdown-item"
                                                            href="{{ route('nilai-sempro.edit', $sempro->id) }}">
                                                            <i class="bi bi-pencil-square text-warning"></i>
                                                            Input Nilai
                                                        </a>
                                                    </li>

                                                </ul>
                                            </div>
                                        @endcan

                                        @cannot('dosen')
                                            <a href="javascript:void(0)" id="show-nilaisempro"
                                                data-url="{{ route('nilai-sempro.show', $sempro->id) }}"
                                                class="btn btn-sm btn-outline-primary"><i class="bi bi-eye-fill"></i>
                                            </a>
                                        @endcannot

                                    </td>

                                </tr>
                            @endforeach
                        @else
                            <td colspan="11" class="text-center">No Data</td>
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

                @can('mahasiswa')
                    @if ($sempros[0]->status == 'lulus')
                        <div class="alert alert-success mt-3" role="alert">
                            <h4 class="alert-heading">Selamat, Kamu Telah Lulus!</h4>
                            <p>Kamu memperoleh nilai {{ $totalNilai }} dalam seminar proposal. Kamu berhasil melewati
                                seminar proposal.</p>
                            <p>Inilah awal dari pencapaian lebih besar. Tetap semangat dan teruskan pencapaian Kamu.
                            </p>
                            <hr>
                            <p>#Nextkomprehensif!</p>
                        </div>
                    @elseif ($sempros[0]->status == 'tidak lulus')
                        <div class="alert alert-danger mt-3" role="alert">
                            <h4 class="alert-heading">Maaf, Kamu Belum Lulus!</h4>
                            <p>Kamu memperoleh nilai {{ $totalNilai }} dalam seminar proposal. Kamu belum berhasil
                                melewati
                                seminar proposal.</p>
                            <p>Jangan putus asa! Gunakan pengalaman ini untuk memperbaiki diri dan terus berjuang.</p>
                            <hr>
                            <p>Tetap Semangat!</p>
                        </div>
                    @endif
                @endcan
            </div>
        </div>
    </div>

    <!-- Modal show -->
    <div class="modal fade" id="nilaisemproView" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
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
                        <div class="col-md-12 row justify-content-evenly">

                            <div class="col-md-4">
                                <h1 class="modal-title fs-5">Pembimbing 1</h1>
                                <div class="mb-3">
                                    <label for="nilai1_pem1" class="form-label">Kemampuan Memilih Tema</label>
                                    <input type="text" id="nilai1_pem1" class="form-control" disabled />
                                    <small>(0 - 15)</small>
                                </div>
                                <div class="mb-3">
                                    <label for="nilai2_pem1" class="form-label">Cara menyajikan pertanyaan
                                        penelitian/problem
                                        statement</label>
                                    <input type="text" id="nilai2_pem1" class="form-control" disabled />
                                    <small>(0 - 15)</small>
                                </div>
                                <div class="mb-3">
                                    <label for="nilai3_pem1" class="form-label">Problem Solving</label>
                                    <input type="text" id="nilai3_pem1" class="form-control" disabled />
                                    <small>(0 - 10)</small>
                                </div>
                                <div class="mb-3">
                                    <label for="nilai4_pem1" class="form-label">Pemilihan model atau metode</label>
                                    <input type="text" id="nilai4_pem1" class="form-control" disabled />
                                    <small>(0 - 10)</small>
                                </div>
                                <div class="mb-3">
                                    <label for="nilai5_pem1" class="form-label">Rencana implementasi
                                        simulasi/komputasi</label>
                                    <input type="text" id="nilai5_pem1" class="form-control" disabled />
                                    <small>(0 - 10)</small>
                                </div>
                                <div class="mb-3">
                                    <label for="nilai6_pem1" class="form-label">Kemandirian dalam penyusunan
                                        proposal</label>
                                    <input type="text" id="nilai6_pem1" class="form-control" disabled />
                                    <small>(0 - 20)</small>
                                </div>
                                <div class="mb-3">
                                    <label for="nilai7_pem1" class="form-label">Proses bimbingan</label>
                                    <input type="text" id="nilai7_pem1" class="form-control" disabled />
                                    <small>(0 - 20)</small>
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
                                    <small>(0 - 15)</small>
                                </div>
                                <div class="mb-3">
                                    <label for="nilai2_pem2" class="form-label">Cara menyajikan pertanyaan
                                        penelitian/problem
                                        statement</label>
                                    <input type="text" id="nilai2_pem2" class="form-control" disabled />
                                    <small>(0 - 15)</small>
                                </div>
                                <div class="mb-3">
                                    <label for="nilai3_pem2" class="form-label">Problem Solving</label>
                                    <input type="text" id="nilai3_pem2" class="form-control" disabled />
                                    <small>(0 - 10)</small>
                                </div>
                                <div class="mb-3">
                                    <label for="nilai4_pem2" class="form-label">Pemilihan model atau metode</label>
                                    <input type="text" id="nilai4_pem2" class="form-control" disabled />
                                    <small>(0 - 10)</small>
                                </div>
                                <div class="mb-3">
                                    <label for="nilai5_pem2" class="form-label">Rencana implementasi
                                        simulasi/komputasi</label>
                                    <input type="text" id="nilai5_pem2" class="form-control" disabled />
                                    <small>(0 - 10)</small>
                                </div>
                                <div class="mb-3">
                                    <label for="nilai6_pem2" class="form-label">Kemandirian dalam penyusunan
                                        proposal</label>
                                    <input type="text" id="nilai6_pem2" class="form-control" disabled />
                                    <small>(0 - 20)</small>
                                </div>
                                <div class="mb-3">
                                    <label for="nilai7_pem2" class="form-label">Proses bimbingan</label>
                                    <input type="text" id="nilai7_pem2" class="form-control" disabled />
                                    <small>(0 - 20)</small>
                                </div>
                                <div class="mb-3">
                                    <label for="totalPem2" class="form-label">Total</label>
                                    <input type="text" id="totalPem2" class="form-control" disabled />
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="col-md-4">
                            <h1 class="modal-title fs-5">Penguji 1</h1>
                            <div class="mb-3">
                                <label for="nilai1_peng1" class="form-label">Menjawab Latar Belakang Masalah</label>
                                <input type="text" id="nilai1_peng1" class="form-control" disabled />
                                <small>(0 - 25)</small>
                            </div>
                            <div class="mb-3">
                                <label for="nilai2_peng1" class="form-label">Menguasai Teori Pendukung TA</label>
                                <input type="text" id="nilai2_peng1" class="form-control" disabled />
                                <small>(0 - 15)</small>
                            </div>
                            <div class="mb-3">
                                <label for="nilai3_peng1" class="form-label">Menguasai Materi Terkait Tools
                                    Pemodelan</label>
                                <input type="text" id="nilai3_peng1" class="form-control" disabled />
                                <small>(0 - 10)</small>
                            </div>
                            <div class="mb-3">
                                <label for="nilai4_peng1" class="form-label">Pemaparan Cara Menjawab</label>
                                <input type="text" id="nilai4_peng1" class="form-control" disabled />
                                <small>(0 - 25)</small>
                            </div>
                            <div class="mb-3">
                                <label for="nilai5_peng1" class="form-label">Komunikasi Interpersonal</label>
                                <input type="text" id="nilai5_peng1" class="form-control" disabled />
                                <small>(0 - 25)</small>
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
                                <small>(0 - 25)</small>
                            </div>
                            <div class="mb-3">
                                <label for="nilai2_peng2" class="form-label">Menguasai Teori Pendukung TA</label>
                                <input type="text" id="nilai2_peng2" class="form-control" disabled />
                                <small>(0 - 15)</small>
                            </div>
                            <div class="mb-3">
                                <label for="nilai3_peng2" class="form-label">Menguasai Materi Terkait Tools</label>
                                <input type="text" id="nilai3_peng2" class="form-control" disabled />
                                <small>(0 - 10)</small>
                            </div>
                            <div class="mb-3">
                                <label for="nilai4_peng2" class="form-label">Pemaparan Cara Menjawab</label>
                                <input type="text" id="nilai4_peng2" class="form-control" disabled />
                                <small>(0 - 25)</small>
                            </div>
                            <div class="mb-3">
                                <label for="nilai5_peng2" class="form-label">Komunikasi Interpersonal</label>
                                <input type="text" id="nilai5_peng2" class="form-control" disabled />
                                <small>(0 - 25)</small>
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
                                <small>(0 - 25)</small>
                            </div>
                            <div class="mb-3">
                                <label for="nilai2_peng3" class="form-label">Menguasai Teori Pendukung TA</label>
                                <input type="text" id="nilai2_peng3" class="form-control" disabled />
                                <small>(0 - 15)</small>
                            </div>
                            <div class="mb-3">
                                <label for="nilai3_peng3" class="form-label">Menguasai Materi Terkait Tools</label>
                                <input type="text" id="nilai3_peng3" class="form-control" disabled />
                                <small>(0 - 10)</small>
                            </div>
                            <div class="mb-3">
                                <label for="nilai4_peng3" class="form-label">Pemaparan Cara Menjawab</label>
                                <input type="text" id="nilai4_peng3" class="form-control" disabled />
                                <small>(0 - 25)</small>
                            </div>
                            <div class="mb-3">
                                <label for="nilai5_peng3" class="form-label">Komunikasi Interpersonal</label>
                                <input type="text" id="nilai5_peng3" class="form-control" disabled />
                                <small>(0 - 25)</small>
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
            $('body').on('click', '#show-nilaisempro', function() {

                let judulUrl = $(this).data('url');

                $.get(judulUrl, function(data) {
                    $('#nilaisemproView').modal('show');

                    $('#mahasiswa').val(data.judul.mahasiswa.name);

                    $('#judul').val(data.judul.judul);

                    if (data.nilaisempro !== null) {
                        $('#nilai1_peng1').val(data.nilaisempro.nilai1_peng1)
                        $('#nilai2_peng1').val(data.nilaisempro.nilai2_peng1)
                        $('#nilai3_peng1').val(data.nilaisempro.nilai3_peng1)
                        $('#nilai4_peng1').val(data.nilaisempro.nilai4_peng1)
                        $('#nilai5_peng1').val(data.nilaisempro.nilai5_peng1)

                        $('#nilai1_peng2').val(data.nilaisempro.nilai1_peng2)
                        $('#nilai2_peng2').val(data.nilaisempro.nilai2_peng2)
                        $('#nilai3_peng2').val(data.nilaisempro.nilai3_peng2)
                        $('#nilai4_peng2').val(data.nilaisempro.nilai4_peng2)
                        $('#nilai5_peng2').val(data.nilaisempro.nilai5_peng2)

                        $('#nilai1_peng3').val(data.nilaisempro.nilai1_peng3)
                        $('#nilai2_peng3').val(data.nilaisempro.nilai2_peng3)
                        $('#nilai3_peng3').val(data.nilaisempro.nilai3_peng3)
                        $('#nilai4_peng3').val(data.nilaisempro.nilai4_peng3)
                        $('#nilai5_peng3').val(data.nilaisempro.nilai5_peng3)

                        $('#nilai1_pem1').val(data.nilaisempro.nilai1_pem1)
                        $('#nilai2_pem1').val(data.nilaisempro.nilai2_pem1)
                        $('#nilai3_pem1').val(data.nilaisempro.nilai3_pem1)
                        $('#nilai4_pem1').val(data.nilaisempro.nilai4_pem1)
                        $('#nilai5_pem1').val(data.nilaisempro.nilai5_pem1)
                        $('#nilai6_pem1').val(data.nilaisempro.nilai6_pem1)
                        $('#nilai7_pem1').val(data.nilaisempro.nilai7_pem1)

                        $('#nilai1_pem2').val(data.nilaisempro.nilai1_pem2)
                        $('#nilai2_pem2').val(data.nilaisempro.nilai2_pem2)
                        $('#nilai3_pem2').val(data.nilaisempro.nilai3_pem2)
                        $('#nilai4_pem2').val(data.nilaisempro.nilai4_pem2)
                        $('#nilai5_pem2').val(data.nilaisempro.nilai5_pem2)
                        $('#nilai6_pem2').val(data.nilaisempro.nilai6_pem2)
                        $('#nilai7_pem2').val(data.nilaisempro.nilai7_pem2)

                        $('#notes1').val(data.nilaisempro.notes1);
                        $('#notes2').val(data.nilaisempro.notes2);
                        $('#notes3').val(data.nilaisempro.notes3);

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
                    let totalPenguji2 = 0
                    let totalPenguji3 = 0
                    let totalPem1 = 0
                    let totalPem2 = 0

                    if (data.nilaisempro) {
                        totalPenguji1 = data.nilaisempro.nilai1_peng1 + data.nilaisempro
                            .nilai2_peng1 + data.nilaisempro.nilai3_peng1 + data.nilaisempro
                            .nilai4_peng1 + data.nilaisempro.nilai5_peng1

                        totalPenguji2 = data.nilaisempro.nilai1_peng2 + data.nilaisempro
                            .nilai2_peng2 + data.nilaisempro.nilai3_peng2 + data.nilaisempro
                            .nilai4_peng2 + data.nilaisempro.nilai5_peng2

                        totalPenguji3 = data.nilaisempro.nilai1_peng3 + data.nilaisempro
                            .nilai2_peng3 + data.nilaisempro.nilai3_peng3 + data.nilaisempro
                            .nilai4_peng3 + data.nilaisempro.nilai5_peng3

                        totalPem1 = data.nilaisempro.nilai1_pem1 + data.nilaisempro.nilai2_pem1 +
                            data.nilaisempro.nilai3_pem1 + data.nilaisempro.nilai4_pem1 +
                            data.nilaisempro.nilai5_pem1 + data.nilaisempro.nilai6_pem1 +
                            data.nilaisempro.nilai7_pem1

                        totalPem2 = data.nilaisempro.nilai1_pem2 + data.nilaisempro.nilai2_pem2 +
                            data.nilaisempro.nilai3_pem2 + data.nilaisempro.nilai4_pem2 +
                            data.nilaisempro.nilai5_pem2 + data.nilaisempro.nilai6_pem2 +
                            data.nilaisempro.nilai7_pem2
                    }


                    // memasukkan nilai kedalam field
                    $('#totalPenguji1').val(totalPenguji1);
                    $('#totalPenguji2').val(totalPenguji2);
                    $('#totalPenguji3').val(totalPenguji3);
                    $('#totalPem1').val(totalPem1);
                    $('#totalPem2').val(totalPem2);

                    let ratarata = (totalPenguji1 + totalPenguji2 + totalPenguji3 + totalPem1 +
                        totalPem2) / 5;
                    $('#rata-rata').val(ratarata.toFixed(2))
                })
            })
        })
    </script>
@endsection
