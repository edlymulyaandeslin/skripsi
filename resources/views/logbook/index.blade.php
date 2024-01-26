@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-12">

            <div class="bg-light rounded h-100 p-4 d-flex flex-column">
                <h3>History Bimbingan</h3>

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
                    <a href="{{ route('logbook.create') }}" class="btn btn-sm btn-primary">Isi Logbook <i
                            class="fa fa-plus"></i></a>
                </div>

                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr class="text-center">
                                <th scope="col">No</th>
                                <th scope="col">Mahasiswa</th>
                                <th scope="col">Judul</th>
                                <th scope="col">Deskripsi</th>
                                <th scope="col">Tanggal Bimbingan</th>
                                <th scope="col">Status</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($logbooks as $logbook)
                                <tr key="{{ $logbook->id }}" class="text-center">
                                    <th scope="row">{{ $loop->index + 1 }}</th>
                                    <td class="text-start">{{ $logbook->judul->mahasiswa->name }}</td>
                                    <td class="text-start">{{ $logbook->judul->judul }}</td>
                                    <td>{{ $logbook->deskripsi }}</td>
                                    <td>{{ $logbook->created_at->format('d M Y') }}</td>
                                    <td>
                                        <span
                                            class="bg-{{ $logbook->status == 'diterima' ? 'success' : ($logbook->status == 'ditolak' ? 'danger' : 'warning') }} rounded text-white px-4 ">
                                            {{ $logbook->status }}
                                        </span>
                                    </td>
                                    <td>
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-sm btn-outline-dark"
                                                data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="bi bi-list"></i>
                                            </button>
                                            <ul class="dropdown-menu">
                                                <li>
                                                    <a href="javascript:void(0)" id="show-logbook"
                                                        data-url="{{ route('logbook.show', $logbook->id) }}"
                                                        class="dropdown-item"><i class="bi bi-search text-info"></i>
                                                        Show</a>
                                                </li>

                                                <li>
                                                    <a class="dropdown-item" href="/logbook/{{ $logbook->id }}/edit">
                                                        <i class="bi bi-pencil-square text-warning"></i>
                                                        Update
                                                    </a>
                                                </li>

                                                <li>
                                                    <hr class="dropdown-divider">
                                                </li>

                                                <li>
                                                    <form action="/logbook/{{ $logbook->id }}" method="POST">
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

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal show -->
    <div class="modal fade" id="logbookView" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Detail Log Book</h1>
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
                                <label for="deskripsi" class="form-label">Deskripsi</label>
                                <textarea id="deskripsi" class="form-control" disabled rows="4"></textarea>
                            </div>

                            <div class="mb-3">
                                <label for="status" class="form-label">Status</label>
                                <input type="text" id="status" class="form-control" disabled>
                            </div>
                        </div>

                        <h1 class="modal-header modal-title fs-5">Pembimbing</h1>
                        <hr>
                        <div class="row">
                            <div class="col-md-6">

                                <div class="mb-3">
                                    <label for="pembimbing1" class="form-label">Pembimbing 1</label>
                                    <input type="text" id="pembimbing1" class="form-control" disabled>
                                </div>
                            </div>
                            <div class="col-md-6">

                                <div class="mb-3">
                                    <label for="pembimbing2" class="form-label">Pembimbing 2</label>
                                    <input type="text" id="pembimbing2" class="form-control" disabled>
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
            $('body').on('click', '#show-logbook', function() {

                let judulUrl = $(this).data('url');
                $.get(judulUrl, function(data) {
                    $('#logbookView').modal('show');

                    $('#mahasiswa').val(data.judul.mahasiswa.name);
                    $('#judul').val(data.judul.judul);
                    $('#deskripsi').val(data.deskripsi);
                    $('#status').val(data.status);

                    data.judul.pembimbing1 !== null ? $('#pembimbing1').val(data.judul.pembimbing1
                        .name) : $('#pembimbing1').val('-');

                    data.judul.pembimbing2 !== null ? $('#pembimbing2').val(data.judul.pembimbing2
                        .name) : $('#pembimbing2').val('-');

                    console.log(data)
                })
            })
        })
    </script>
@endsection
