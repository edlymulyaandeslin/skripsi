@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-12 bg-light rounded h-100 p-4 d-flex flex-column">
            <h3>List Judul Skripsi</h3>

            <div class="d-flex justify-content-between mb-3 mt-1">
                <div class="col-md-5">
                    <form>
                        <input type="text" placeholder="search" class="form-control">
                    </form>
                </div>
                <a href="{{ route('judul.create') }}" class="btn btn-sm btn-primary">Ajukan Judul <i
                        class="fa fa-plus"></i></a>
            </div>

            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr class="text-center">
                            <th scope="col">No</th>
                            <th scope="col">NIM</th>
                            <th scope="col">Mahasiswa</th>
                            <th scope="col">Judul</th>
                            <th scope="col">tanggal pengajuan</th>
                            <th scope="col">Status</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($listjudul->count() !== 0)
                            @foreach ($listjudul as $judul)
                                <tr key="{{ $judul->id }}" class="text-center">
                                    <th scope="row">{{ $loop->index + 1 }}</th>
                                    <td>{{ $judul->mahasiswa->nim_or_nidn }}</td>
                                    <td>{{ $judul->mahasiswa->name }}</td>
                                    <td>{{ $judul->judul }}</td>
                                    <td>{{ $judul->created_at->format('d M Y') }}</td>
                                    <td class="text-center">
                                        <span
                                            class="bg-{{ $judul->status == 'diterima' ? 'success' : ($judul->status == 'ditolak' ? 'danger' : 'warning') }} rounded text-white px-3 py-1">
                                            {{ $judul->status }}
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
                                                    <a href="javascript:void(0)" id="show-judul"
                                                        data-url="{{ route('judul.show', $judul->id) }}"
                                                        class="dropdown-item"><i class="bi bi-search text-info"></i>
                                                        Show</a>
                                                </li>

                                                <li>
                                                    <a class="dropdown-item" href="/judul/{{ $judul->id }}/edit">
                                                        <i class="bi bi-pencil-square text-warning"></i>
                                                        Update
                                                    </a>
                                                </li>

                                                <li>
                                                    <hr class="dropdown-divider">
                                                </li>

                                                <li>
                                                    <a href="{{ route('judul.destroy', $judul->id) }}"
                                                        class="dropdown-item" data-confirm-delete="true"><i
                                                            class="bi bi-trash-fill text-danger"></i> Delete</a>
                                                </li>

                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <td colspan="7" class="text-center">No Data</td>
                        @endif

                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal show -->
    <div class="modal fade" id="judulView" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable">
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
                                <label for="latar_belakang" class="form-label">Latar Belakang</label>
                                <textarea id="latar_belakang" class="form-control" disabled rows="4"></textarea>
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
            $('body').on('click', '#show-judul', function() {

                let judulUrl = $(this).data('url');
                $.get(judulUrl, function(data) {
                    $('#judulView').modal('show');
                    console.log(data)
                    $('#mahasiswa').val(data.mahasiswa.name);
                    $('#judul').val(data.judul);
                    $('#latar_belakang').val(data.latar_belakang);
                    $('#status').val(data.status);

                    data.pembimbing1 !== null ? $('#pembimbing1').val(data.pembimbing1.name) :
                        $('#pembimbing1').val('-');

                    data.pembimbing2 !== null ? $('#pembimbing2').val(data.pembimbing2.name) :
                        $('#pembimbing2').val('-');

                })
            })
        })
    </script>
@endsection
