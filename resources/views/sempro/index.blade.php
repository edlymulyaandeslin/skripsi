@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-12 bg-light rounded h-100 p-4 d-flex flex-column">
            <h3>Mahasiswa Seminar Proposal</h3>

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
                            <th scope="col">Tanggal Seminar</th>
                            <th scope="col">Jam</th>
                            <th scope="col">Ruang</th>
                            <th scope="col">Team Penguji</th>
                            <th scope="col">Status</th>
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
                                    <td>{{ $sempro->tanggal_seminar ? Carbon\Carbon::parse($sempro->tanggal_seminar)->format('d F Y') : '-' }}
                                    </td>
                                    <td>{{ $sempro->jam ?? '-' }}</td>
                                    <td>{{ $sempro->ruang ?? '-' }}</td>
                                    <td>{{ $sempro->teampenguji->name ?? '-' }}</td>
                                    <td class="text-center">
                                        <span
                                            class="bg-{{ $sempro->status == 'diterima' ? 'success' : ($sempro->status == 'ditolak' ? 'danger' : 'warning') }} rounded text-white px-4 ">
                                            {{ $sempro->status }}
                                        </span>
                                    </td>
                                    <td>
                                        <div>
                                            <button type="button" class="btn btn-sm btn-outline-dark"
                                                data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="bi bi-list"></i>
                                            </button>
                                            <ul class="dropdown-menu">
                                                <li>
                                                    <a href="javascript:void(0)" id="show-sempro"
                                                        data-url="/sempro/{{ $sempro->id }}" class="dropdown-item"><i
                                                            class="bi bi-search text-info"></i>
                                                        Show</a>
                                                </li>

                                                <li>
                                                    <a class="dropdown-item" href="/sempro/{{ $sempro->id }}/edit">
                                                        <i class="bi bi-pencil-square text-warning"></i>
                                                        Update
                                                    </a>
                                                </li>

                                                <li>
                                                    <hr class="dropdown-divider">
                                                </li>

                                                <li>
                                                    <form action="/sempro/{{ $sempro->id }}" method="POST">
                                                        @method('delete')
                                                        @csrf
                                                        <button type="submit" class="dropdown-item"
                                                            onclick="return confirm('Yakin ingin menghapus data ini?')"><i
                                                                class="bi bi-trash-fill text-danger"></i>
                                                            Delete</button>
                                                    </form>
                                                </li>

                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <td colspan="9" class="text-center">No Data</td>
                        @endif

                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal show -->
    <div class="modal fade" id="semproView" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
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
                                <label for="tanggal_seminar" class="form-label">Tanggal Seminar</label>
                                <input type="text" id="tanggal_seminar" class="form-control" disabled />
                            </div>

                            <div class="mb-3">
                                <label for="jam" class="form-label">Jam</label>
                                <input type="text" id="jam" class="form-control" disabled />
                            </div>

                            <div class="mb-3">
                                <label for="ruang" class="form-label">Ruang</label>
                                <input type="text" id="ruang" class="form-control" disabled />
                            </div>

                            <div class="mb-3">
                                <label for="status" class="form-label">Status</label>
                                <input type="text" id="status" class="form-control" disabled>
                            </div>
                        </div>

                        <h1 class="modal-header modal-title fs-5">Team Penguji</h1>
                        <span id="teampenguji" class="text-center h5 m-0 p-0"></span>
                        <hr>
                        <div class="row">
                            <div class="col-md-6">

                                <div class="mb-3">
                                    <label for="penguji1" class="form-label">Penguji 1</label>
                                    <input type="text" id="penguji1" class="form-control" disabled>
                                </div>
                                <div class="mb-3">
                                    <label for="penguji2" class="form-label">Penguji 2</label>
                                    <input type="text" id="penguji2" class="form-control" disabled>
                                </div>

                            </div>
                            <div class="col-md-6">

                                <div class="mb-3">
                                    <label for="penguji3" class="form-label">Penguji 3</label>
                                    <input type="text" id="penguji3" class="form-control" disabled>
                                </div>

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
            $('body').on('click', '#show-sempro', function() {

                let judulUrl = $(this).data('url');
                $.get(judulUrl, function(data) {
                    $('#semproView').modal('show');

                    console.log(data)
                    $('#mahasiswa').val(data.judul.mahasiswa.name);

                    $('#judul').val(data.judul.judul);

                    data.tanggal_seminar ? $('#tanggal_seminar').val(data.tanggal_seminar) : $(
                        '#tanggal_seminar').val('-');

                    data.jam ? $('#jam').val(data.jam) : $('#jam').val('-');

                    data.ruang ? $('#ruang').val(data.ruang) : $('#ruang').val('-');

                    $('#status').val(data.status);

                    if (data.teampenguji !== null) {
                        $('#teampenguji').text(data.teampenguji.name);
                        $('#penguji1').val(data.teampenguji.penguji1);
                        $('#penguji2').val(data.teampenguji.penguji2);
                        $('#penguji3').val(data.teampenguji.penguji3);
                    } else {
                        $('#teampenguji').text('-');
                        $('#penguji1').val('-');
                        $('#penguji2').val('-');
                        $('#penguji3').val('-');
                    }


                })
            })
        })
    </script>
@endsection
