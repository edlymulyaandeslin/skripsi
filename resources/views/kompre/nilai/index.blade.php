@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-12 bg-light rounded h-100 p-4 d-flex flex-column">
            <h3>Penilaian Seminar Komprehensif</h3>

            <div class="d-flex justify-content-between mb-3 mt-1">
                @cannot('mahasiswa')
                    <div class="col-md-5">
                        <form action="/nilai/kompre">
                            <div class="input-group">
                                <input type="text" placeholder="search..." class="form-control" name="search"
                                    value="{{ request('search') }}" autofocus>
                                <button type="submit" class="btn btn-primary">Search</button>
                            </div>
                        </form>
                    </div>
                @endcannot

                @can('koordinator')
                    <div>
                        <a href="/bobot/{{ $bobot->id }}/edit" class="btn btn-sm btn-dark">Atur Bobot Nilai</a>
                    </div>
                @endcan
            </div>

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

                        @if ($kompres->count() !== 0)
                            @foreach ($kompres as $index => $kompre)
                                <tr key="{{ $kompre->id }}" class="text-center">
                                    <th scope="row" class="text-center">{{ $index + $kompres->firstItem() }}</th>
                                    @cannot('mahasiswa')
                                        <td>{{ $kompre->judul->mahasiswa->name }}</td>
                                    @endcannot
                                    <td>{{ $kompre->judul->judul }}</td>
                                    <td>{{ $kompre->nilaikompre ? ($nilaiPem1 = ($kompre->nilaikompre->nilai1_pem1 + $kompre->nilaikompre->nilai2_pem1 + $kompre->nilaikompre->nilai3_pem1 + $kompre->nilaikompre->nilai4_pem1) / 5) : ($nilaiPem1 = 0) }}
                                    </td>
                                    <td>{{ $kompre->nilaikompre ? ($nilaiPem2 = ($kompre->nilaikompre->nilai1_pem2 + $kompre->nilaikompre->nilai2_pem2 + $kompre->nilaikompre->nilai3_pem2 + $kompre->nilaikompre->nilai4_pem2) / 5) : ($nilaiPem2 = 0) }}
                                    </td>
                                    <td>{{ $kompre->nilaikompre ? ($nilaiPenguji1 = ($kompre->nilaikompre->nilai1_peng1 + $kompre->nilaikompre->nilai2_peng1 + $kompre->nilaikompre->nilai3_peng1 + $kompre->nilaikompre->nilai4_peng1) / 5) : ($nilaiPenguji1 = 0) }}
                                    </td>
                                    <td>{{ $kompre->nilaikompre ? ($nilaiPenguji2 = ($kompre->nilaikompre->nilai1_peng2 + $kompre->nilaikompre->nilai2_peng2 + $kompre->nilaikompre->nilai3_peng2 + $kompre->nilaikompre->nilai4_peng2) / 5) : ($nilaiPenguji2 = 0) }}
                                    </td>
                                    <td>{{ $kompre->nilaikompre ? ($nilaiPenguji3 = ($kompre->nilaikompre->nilai1_peng3 + $kompre->nilaikompre->nilai2_peng3 + $kompre->nilaikompre->nilai3_peng3 + $kompre->nilaikompre->nilai4_peng3) / 5) : ($nilaiPenguji3 = 0) }}
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
                                                        <a href="javascript:void(0)" id="show-nilaikompre"
                                                            data-url="{{ route('nilai.kompre.show', $kompre->id) }}"
                                                            class="dropdown-item"><i class="bi bi-search text-info"></i>
                                                            Lihat</a>
                                                    </li>

                                                    <li>
                                                        <a class="dropdown-item" href="/nilai/kompre/{{ $kompre->id }}/edit">
                                                            <i class="bi bi-pencil-square text-warning"></i>
                                                            Input Nilai
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        @endcan

                                        @cannot('dosen')
                                            <a href="javascript:void(0)" id="show-nilaikompre"
                                                data-url="{{ route('nilai.kompre.show', $kompre->id) }}"
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
                    Show {{ $kompres->firstItem() ?? 0 }}
                    to {{ $kompres->lastItem() ?? 0 }} items
                    of total {{ $kompres->total() }} items
                    {{ $kompres->links() }}
                </div>

                @can('mahasiswa')
                    @if ($kompres[0]->status == 'lulus')
                        <div class="alert alert-success mt-3" role="alert">
                            <h4 class="alert-heading">Selamat, Kamu Telah Lulus!</h4>
                            <p>Kamu memperoleh nilai {{ $totalNilai }} dalam seminar komprehensif. Kamu berhasil melewati
                                seminar komprehensif.</p>
                            <p>Inilah awal dari pencapaian lebih besar. Tetap semangat dan teruskan pencapaian Kamu.
                            </p>
                            <hr>
                            <p>Teruslah berkarya!</p>
                        </div>
                    @elseif ($kompres[0]->status == 'tidak lulus')
                        <div class="alert alert-danger mt-3" role="alert">
                            <h4 class="alert-heading">Maaf, Kamu Belum Lulus!</h4>
                            <p>Kamu memperoleh nilai {{ $totalNilai }} dalam seminar komprehensif. Kamu belum berhasil
                                melewati
                                seminar komprehensif.</p>
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
                        <div class="col-md-12 row justify-content-evenly">

                            <div class="col-md-4">
                                <h1 class="modal-title fs-5">Pembimbing 1</h1>
                                <div class="mb-3">
                                    <label for="nilai1_pem1" class="form-label">Penguasaan Penelitian</label>
                                    <input type="text" id="nilai1_pem1" class="form-control" disabled />
                                    <small>10 - 100 (x{{ $bobot->bobot1 }})</small>
                                </div>
                                <div class="mb-3">
                                    <label for="nilai2_pem1" class="form-label">Segi Ilmiah Tulisan</label>
                                    <input type="text" id="nilai2_pem1" class="form-control" disabled />
                                    <small>10 - 100 (x{{ $bobot->bobot2 }})</small>
                                </div>
                                <div class="mb-3">
                                    <label for="nilai3_pem1" class="form-label">Kemampuan Penyajian</label>
                                    <input type="text" id="nilai3_pem1" class="form-control" disabled />
                                    <small>10 - 100 (x{{ $bobot->bobot3 }})</small>
                                </div>
                                <div class="mb-3">
                                    <label for="nilai4_pem1" class="form-label">Kemampuan Berdiskusi</label>
                                    <input type="text" id="nilai4_pem1" class="form-control" disabled />
                                    <small>10 - 100 (x{{ $bobot->bobot4 }})</small>
                                </div>

                                <div class="mb-3">
                                    <label for="totalPem1" class="form-label">Total</label>
                                    <input type="text" id="totalPem1" class="form-control" disabled />
                                </div>
                            </div>

                            <div class="col-md-4">
                                <h1 class="modal-title fs-5">Pembimbing 2</h1>
                                <div class="mb-3">
                                    <label for="nilai1_pem2" class="form-label">Penguasaan Penelitian</label>
                                    <input type="text" id="nilai1_pem2" class="form-control" disabled />
                                    <small>10 - 100 (x{{ $bobot->bobot1 }})</small>
                                </div>
                                <div class="mb-3">
                                    <label for="nilai2_pem2" class="form-label">Segi Ilmiah Tulisan</label>
                                    <input type="text" id="nilai2_pem2" class="form-control" disabled />
                                    <small>10 - 100 (x{{ $bobot->bobot2 }})</small>
                                </div>
                                <div class="mb-3">
                                    <label for="nilai3_pem2" class="form-label">Kemampuan Penyajian</label>
                                    <input type="text" id="nilai3_pem2" class="form-control" disabled />
                                    <small>10 - 100 (x{{ $bobot->bobot3 }})</small>
                                </div>
                                <div class="mb-3">
                                    <label for="nilai4_pem2" class="form-label">Kemampuan Berdiskusi</label>
                                    <input type="text" id="nilai4_pem2" class="form-control" disabled />
                                    <small>10 - 100 (x{{ $bobot->bobot4 }})</small>
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
                                <label for="nilai1_peng1" class="form-label">Penguasaan Penelitian</label>
                                <input type="text" id="nilai1_peng1" class="form-control" disabled />
                                <small>10 - 100 (x{{ $bobot->bobot1 }})</small>
                            </div>
                            <div class="mb-3">
                                <label for="nilai2_peng1" class="form-label">Segi Ilmiah Tulisan</label>
                                <input type="text" id="nilai2_peng1" class="form-control" disabled />
                                <small>10 - 100 (x{{ $bobot->bobot2 }})</small>
                            </div>
                            <div class="mb-3">
                                <label for="nilai3_peng1" class="form-label">Kemampuan Penyajian</label>
                                <input type="text" id="nilai3_peng1" class="form-control" disabled />
                                <small>10 - 100 (x{{ $bobot->bobot3 }})</small>
                            </div>
                            <div class="mb-3">
                                <label for="nilai4_peng1" class="form-label">Kemampuan Berdiskusi</label>
                                <input type="text" id="nilai4_peng1" class="form-control" disabled />
                                <small>10 - 100 (x{{ $bobot->bobot4 }})</small>
                            </div>
                            <div class="mb-3">
                                <label for="totalPenguji1" class="form-label">Total</label>
                                <input type="text" id="totalPenguji1" class="form-control" disabled />
                            </div>

                        </div>
                        <div class="col-md-4">
                            <h1 class="modal-title fs-5">Penguji 2</h1>
                            <div class="mb-3">
                                <label for="nilai1_peng2" class="form-label">Penguasaan Penelitian</label>
                                <input type="text" id="nilai1_peng2" class="form-control" disabled />
                                <small>10 - 100 (x{{ $bobot->bobot1 }})</small>
                            </div>
                            <div class="mb-3">
                                <label for="nilai2_peng2" class="form-label">Segi Ilmiah Tulisan</label>
                                <input type="text" id="nilai2_peng2" class="form-control" disabled />
                                <small>10 - 100 (x{{ $bobot->bobot2 }})</small>
                            </div>
                            <div class="mb-3">
                                <label for="nilai3_peng2" class="form-label">Kemampuan Penyajian</label>
                                <input type="text" id="nilai3_peng2" class="form-control" disabled />
                                <small>10 - 100 (x{{ $bobot->bobot3 }})</small>
                            </div>
                            <div class="mb-3">
                                <label for="nilai4_peng2" class="form-label">Kemampuan Berdiskusi</label>
                                <input type="text" id="nilai4_peng2" class="form-control" disabled />
                                <small>10 - 100 (x{{ $bobot->bobot4 }})</small>
                            </div>
                            <div class="mb-3">
                                <label for="totalPenguji2" class="form-label">Total</label>
                                <input type="text" id="totalPenguji2" class="form-control" disabled />
                            </div>

                        </div>
                        <div class="col-md-4">
                            <h1 class="modal-title fs-5">Penguji 3</h1>
                            <div class="mb-3">
                                <label for="nilai1_peng3" class="form-label">Penguasaan Penelitian</label>
                                <input type="text" id="nilai1_peng3" class="form-control" disabled />
                                <small>10 - 100 (x{{ $bobot->bobot1 }})</small>
                            </div>
                            <div class="mb-3">
                                <label for="nilai2_peng3" class="form-label">Segi Ilmiah Tulisan</label>
                                <input type="text" id="nilai2_peng3" class="form-control" disabled />
                                <small>10 - 100 (x{{ $bobot->bobot2 }})</small>
                            </div>
                            <div class="mb-3">
                                <label for="nilai3_peng3" class="form-label">Kemampuan Penyajian</label>
                                <input type="text" id="nilai3_peng3" class="form-control" disabled />
                                <small>10 - 100 (x{{ $bobot->bobot3 }})</small>
                            </div>
                            <div class="mb-3">
                                <label for="nilai4_peng3" class="form-label">Kemampuan Berdiskusi</label>
                                <input type="text" id="nilai4_peng3" class="form-control" disabled />
                                <small>10 - 100 (x{{ $bobot->bobot4 }})</small>
                            </div>
                            <div class="mb-3">
                                <label for="totalPenguji3" class="form-label">Total</label>
                                <input type="text" id="totalPenguji3" class="form-control" disabled />
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

                    $('#mahasiswa').val(data.kompres.judul.mahasiswa.name);

                    $('#judul').val(data.kompres.judul.judul);

                    if (data.kompres.nilaikompre != null) {
                        $('#nilai1_peng1').val(data.kompres.nilaikompre.nilai1_peng1 / data.bobot
                            .bobot1)
                        $('#nilai2_peng1').val(data.kompres.nilaikompre.nilai2_peng1 / data.bobot
                            .bobot2)
                        $('#nilai3_peng1').val(data.kompres.nilaikompre.nilai3_peng1 / data.bobot
                            .bobot3)
                        $('#nilai4_peng1').val(data.kompres.nilaikompre.nilai4_peng1 / data.bobot
                            .bobot4)

                        $('#nilai1_peng2').val(data.kompres.nilaikompre.nilai1_peng2 / data.bobot
                            .bobot1)
                        $('#nilai2_peng2').val(data.kompres.nilaikompre.nilai2_peng2 / data.bobot
                            .bobot2)
                        $('#nilai3_peng2').val(data.kompres.nilaikompre.nilai3_peng2 / data.bobot
                            .bobot3)
                        $('#nilai4_peng2').val(data.kompres.nilaikompre.nilai4_peng2 / data.bobot
                            .bobot4)

                        $('#nilai1_peng3').val(data.kompres.nilaikompre.nilai1_peng3 / data.bobot
                            .bobot1)
                        $('#nilai2_peng3').val(data.kompres.nilaikompre.nilai2_peng3 / data.bobot
                            .bobot2)
                        $('#nilai3_peng3').val(data.kompres.nilaikompre.nilai3_peng3 / data.bobot
                            .bobot3)
                        $('#nilai4_peng3').val(data.kompres.nilaikompre.nilai4_peng3 / data.bobot
                            .bobot4)

                        $('#nilai1_pem1').val(data.kompres.nilaikompre.nilai1_pem1 / data.bobot
                            .bobot1)
                        $('#nilai2_pem1').val(data.kompres.nilaikompre.nilai2_pem1 / data.bobot
                            .bobot2)
                        $('#nilai3_pem1').val(data.kompres.nilaikompre.nilai3_pem1 / data.bobot
                            .bobot3)
                        $('#nilai4_pem1').val(data.kompres.nilaikompre.nilai4_pem1 / data.bobot
                            .bobot4)

                        $('#nilai1_pem2').val(data.kompres.nilaikompre.nilai1_pem2 / data.bobot
                            .bobot1)
                        $('#nilai2_pem2').val(data.kompres.nilaikompre.nilai2_pem2 / data.bobot
                            .bobot2)
                        $('#nilai3_pem2').val(data.kompres.nilaikompre.nilai3_pem2 / data.bobot
                            .bobot3)
                        $('#nilai4_pem2').val(data.kompres.nilaikompre.nilai4_pem2 / data.bobot
                            .bobot4)
                    } else {
                        $('#nilai1_peng1').val('-')
                        $('#nilai2_peng1').val('-')
                        $('#nilai3_peng1').val('-')
                        $('#nilai4_peng1').val('-')

                        $('#nilai1_peng2').val('-')
                        $('#nilai2_peng2').val('-')
                        $('#nilai3_peng2').val('-')
                        $('#nilai4_peng2').val('-')

                        $('#nilai1_peng3').val('-')
                        $('#nilai2_peng3').val('-')
                        $('#nilai3_peng3').val('-')
                        $('#nilai4_peng3').val('-')

                        $('#nilai1_pem1').val('-')
                        $('#nilai2_pem1').val('-')
                        $('#nilai3_pem1').val('-')
                        $('#nilai4_pem1').val('-')

                        $('#nilai1_pem2').val('-')
                        $('#nilai2_pem2').val('-')
                        $('#nilai3_pem2').val('-')
                        $('#nilai4_pem2').val('-')

                    }

                    // perhitungan total nilai
                    let totalPenguji1 = 0
                    data.kompres.nilaikompre ? totalPenguji1 =
                        (data.kompres.nilaikompre.nilai1_peng1 +
                            data.kompres.nilaikompre.nilai2_peng1 +
                            data.kompres.nilaikompre.nilai3_peng1 +
                            data.kompres.nilaikompre.nilai4_peng1) / 5 : totalPenguji1 = 0;

                    let totalPenguji2 = 0
                    data.kompres.nilaikompre ? totalPenguji2 =
                        (data.kompres.nilaikompre.nilai1_peng2 +
                            data.kompres.nilaikompre.nilai2_peng2 +
                            data.kompres.nilaikompre.nilai3_peng2 +
                            data.kompres.nilaikompre.nilai4_peng2) / 5 : totalPenguji2 = 0;

                    let totalPenguji3 = 0
                    data.kompres.nilaikompre ? totalPenguji3 =
                        (data.kompres.nilaikompre.nilai1_peng3 +
                            data.kompres.nilaikompre.nilai2_peng3 +
                            data.kompres.nilaikompre.nilai3_peng3 +
                            data.kompres.nilaikompre.nilai4_peng3) / 5 : totalPenguji3 = 0;

                    let totalPem1 = 0
                    data.kompres.nilaikompre ? totalPem1 =
                        (data.kompres.nilaikompre.nilai1_pem1 +
                            data.kompres.nilaikompre.nilai2_pem1 +
                            data.kompres.nilaikompre.nilai3_pem1 +
                            data.kompres.nilaikompre.nilai4_pem1) / 5 : totalPem1 = 0;

                    let totalPem2 = 0
                    data.kompres.nilaikompre ? totalPem2 =
                        (data.kompres.nilaikompre.nilai1_pem2 +
                            data.kompres.nilaikompre.nilai2_pem2 +
                            data.kompres.nilaikompre.nilai3_pem2 +
                            data.kompres.nilaikompre.nilai4_pem2) / 5 : totalPem2 = 0;

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
