@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-12 bg-light rounded h-100 p-4 d-flex flex-column">
            <h3>Penilaian Mahasiswa Komprehensif</h3>

            @if (session()->has('success'))
                <div class="alert alert-success" role="alert">
                    {{ session('success') }}
                </div>
            @endif

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
                            <th scope="col">Nilai 1</th>
                            <th scope="col">Nilai 2</th>
                            <th scope="col">Nilai 3</th>
                            <th scope="col">Nilai 4</th>
                            <th scope="col">Nilai 5</th>
                            <th scope="col">Rata-rata</th>
                            <th scope="col">Prediket</th>
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
                                    <td>{{ $kompre->nilaikompre->nilai1 ?? 0 }}</td>
                                    <td>{{ $kompre->nilaikompre->nilai2 ?? 0 }}</td>
                                    <td>{{ $kompre->nilaikompre->nilai3 ?? 0 }}</td>
                                    <td>{{ $kompre->nilaikompre->nilai4 ?? 0 }}</td>
                                    <td>{{ $kompre->nilaikompre->nilai5 ?? 0 }}</td>
                                    <td>{{ $kompre->nilaikompre ? ($nilai = $kompre->nilaikompre->nilai1 + $kompre->nilaikompre->nilai2 + $kompre->nilaikompre->nilai3 + $kompre->nilaikompre->nilai4 + $kompre->nilaikompre->nilai5) : ($nilai = 0) }}
                                    </td>
                                    @if ($nilai >= 95)
                                        <td>A+</td>
                                    @elseif ($nilai >= 90)
                                        <td>A</td>
                                    @elseif ($nilai >= 85)
                                        <td>B+</td>
                                    @elseif ($nilai >= 80)
                                        <td>B</td>
                                    @elseif ($nilai >= 75)
                                        <td>B-</td>
                                    @elseif ($nilai >= 70)
                                        <td>C</td>
                                    @elseif ($nilai >= 60)
                                        <td>D</td>
                                    @else
                                        <td>E</td>
                                    @endif
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
    <div class="modal fade" id="nilaikompreView" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Detail</h1>
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
                                <label for="ratarata" class="form-label">Rata-rata</label>
                                <input type="text" id="ratarata" class="form-control" disabled />
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
            $('body').on('click', '#show-nilaikompre', function() {

                let judulUrl = $(this).data('url');
                $.get(judulUrl, function(data) {
                    $('#nilaikompreView').modal('show');

                    console.log(data)
                    $('#mahasiswa').val(data.judul.mahasiswa.name);

                    $('#judul').val(data.judul.judul);

                    if (data.nilaikompre !== null) {
                        $('#nilai1').val(data.nilaikompre.nilai1)
                        $('#nilai2').val(data.nilaikompre.nilai2)
                        $('#nilai3').val(data.nilaikompre.nilai3)
                        $('#nilai4').val(data.nilaikompre.nilai4)
                        $('#nilai5').val(data.nilaikompre.nilai5)
                    } else {
                        $('#nilai1').val('-')
                        $('#nilai2').val('-')
                        $('#nilai3').val('-')
                        $('#nilai4').val('-')
                        $('#nilai5').val('-')
                    }

                    let ratarata = 0
                    data.nilaikompre ? ratarata = data.nilaikompre.nilai1 + data.nilaikompre
                        .nilai2 + data
                        .nilaikompre.nilai3 + data.nilaikompre.nilai4 +
                        data.nilaikompre.nilai5 : ratarata = 0

                    $('#ratarata').val(ratarata);

                    if (data.teampenguji !== null) {
                        $('#teampenguji').text(data.teampenguji.name);
                        $('#penguji1').val(data.teampenguji.penguji1);
                        $('#penguji2').val(data.teampenguji.penguji2);
                        $('#penguji3').val(data.teampenguji.penguji3);
                        $('#penguji4').val(data.teampenguji.penguji4);
                        $('#penguji5').val(data.teampenguji.penguji5);
                    } else {
                        $('#teampenguji').text('-');
                        $('#penguji1').val('-');
                        $('#penguji2').val('-');
                        $('#penguji3').val('-');
                        $('#penguji4').val('-');
                        $('#penguji5').val('-');
                    }


                })
            })
        })
    </script>
@endsection
