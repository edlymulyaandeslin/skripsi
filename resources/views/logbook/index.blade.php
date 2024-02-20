@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-12 bg-light rounded h-100 p-4 d-flex flex-column">

            <h3>History Bimbingan</h3>

            <div class="d-flex row justify-content-between mb-3 mt-1">
                <div class="col-md-5">
                    <form>
                        <input type="text" placeholder="search" class="form-control">
                    </form>
                </div>

                @can('mahasiswa')
                    <div class="col d-flex align-items-end justify-content-end">

                        <a href="{{ route('logbook.create') }}" class="btn btn-sm btn-primary">Bimbingan <i
                                class="fa fa-plus"></i></a>
                    </div>
                @endcan
            </div>

            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr class="text-center align-middle">
                            <th scope="col">No</th>
                            @cannot('mahasiswa')
                                <th scope="col">NIM</th>
                                <th scope="col">Mahasiswa</th>
                            @endcannot
                            <th scope="col">Tanggal Bimbingan</th>
                            <th scope="col">Kategori</th>
                            @can('mahasiswa')
                                <th scope="col">Dospem</th>
                            @endcan
                            <th scope="col">Judul</th>
                            <th scope="col">Target Bimbingan</th>
                            <th scope="col">Status</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($logbooks->count() !== 0)
                            @foreach ($logbooks as $index => $logbook)
                                <tr key="{{ $logbook->id }}" class="text-center">
                                    <th scope="row">{{ $index + $logbooks->firstItem() }}</th>
                                    @cannot('mahasiswa')
                                        <td>{{ $logbook->judul->mahasiswa->nim_or_nidn }}</td>
                                        <td>{{ $logbook->judul->mahasiswa->name }}</td>
                                    @endcannot
                                    <td>{{ $logbook->created_at->translatedFormat('d F Y') }}</td>
                                    <td>{{ $logbook->kategori }}</td>
                                    @can('mahasiswa')
                                        <td>{{ $logbook->pembimbing->name }}</td>
                                    @endcan
                                    <td>{{ $logbook->judul->judul }}</td>
                                    <td>{{ $logbook->target_bimbingan }}</td>
                                    <td>
                                        <p
                                            class="bg-{{ $logbook->status == 'diterima' ? 'success' : ($logbook->status == 'ditolak' ? 'danger' : ($logbook->status == 'acc proposal' || $logbook->status == 'acc komprehensif' ? 'primary' : 'warning')) }} rounded text-white px-3 py-1">
                                            {{ $logbook->status }}
                                        </p>
                                    </td>
                                    <td>
                                        @cannot('admin')
                                            <div>
                                                <button type="button" class="btn btn-sm btn-outline-dark"
                                                    data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="bi bi-list"></i>
                                                </button>
                                                <ul class="dropdown-menu">
                                                    <li>
                                                        <a href="javascript:void(0)" id="show-logbook"
                                                            data-url="{{ route('logbook.show', $logbook->id) }}"
                                                            class="dropdown-item"><i class="bi bi-search text-info"></i>
                                                            Lihat</a>
                                                    </li>

                                                    @can('dosen')
                                                        <li>
                                                            <a class="dropdown-item" href="/logbook/{{ $logbook->id }}/edit">
                                                                <i class="bi bi-pencil-square text-warning"></i>
                                                                Verifikasi
                                                            </a>
                                                        </li>
                                                    @endcan

                                                    <li>
                                                        <hr class="dropdown-divider">
                                                    </li>

                                                    @can('mahasiswa')
                                                        <li>
                                                            <a href="{{ route('logbook.destroy', $logbook->id) }}"
                                                                class="dropdown-item" data-confirm-delete="true"><i
                                                                    class="bi bi-trash-fill text-danger"></i> Batalkan</a>
                                                        </li>
                                                    @endcan

                                                </ul>
                                            </div>
                                        @endcannot

                                        @can('admin')
                                            <a href="javascript:void(0)" id="show-logbook"
                                                data-url="{{ route('logbook.show', $logbook->id) }}"
                                                class="btn btn-sm btn-outline-primary"><i class="bi bi-eye-fill"></i>
                                            </a>
                                        @endcan

                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <td colspan="7" class="text-center">No Data</td>
                        @endif

                    </tbody>
                </table>
            </div>

            @can('mahasiswa')
                <div class="col-md-12 d-flex justify-content-end gap-2 mb-3">
                    @if ($accProposal->count() >= 2)
                        <a href="cetak/bimbingan-proposal/download/pdf" class="btn btn-sm btn-danger"><i
                                class="fa fa-file-pdf"></i> Bimbingan
                            Proposal</a>
                    @endif
                    @if ($accKomprehensif->count() >= 2)
                        <a href="cetak/bimbingan-kompre/download/pdf" class="btn btn-sm btn-danger"><i
                                class="fa fa-file-pdf"></i> Bimbingan
                            Komprehensif </a>
                    @endif
                </div>
            @endcan
            {{-- pagination --}}
            <div class="col-md-12 d-flex justify-content-between">

                Show {{ $logbooks->firstItem() ?? 0 }}
                to {{ $logbooks->lastItem() ?? 0 }} items
                of total {{ $logbooks->total() }} items

                {{ $logbooks->links() }}

            </div>

        </div>
    </div>

    <!-- Modal show -->
    <div class="modal fade" id="logbookView" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable">
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
                                <input type="text" id="judul" class="form-control" disabled>
                            </div>

                            <div class="mb-3">
                                <label for="kategori" class="form-label">Kategori Bimbingan</label>
                                <input type="text" id="kategori" class="form-control" disabled>
                            </div>

                            <div class="mb-3">
                                <label for="target_bimbingan" class="form-label">Target Bimbingan</label>
                                <textarea id="target_bimbingan" class="form-control" disabled rows="4"></textarea>
                            </div>

                            <div class="mb-3">
                                <label for="file_proposal" class="form-label">File Bimbingan</label>
                                <a href="#" id="file_proposal" class="form-control"></i>
                                </a>

                            </div>

                            <div class="mb-3">
                                <label for="status" class="form-label">Status</label>
                                <input type="text" id="status" class="form-control" disabled>
                            </div>
                        </div>

                        <h1 class="modal-header modal-title fs-5">Hasil Bimbingan</h1>
                        <hr>

                        <div class="mb-3">
                            <textarea id="hasil" class="form-control" disabled rows="4"></textarea>
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

                    $('#kategori').val(data.kategori);

                    $('#judul').val(data.judul.judul);

                    $('#target_bimbingan').val(data.target_bimbingan);

                    data.file_proposal ? $('#file_proposal').attr('href', 'storage/' + data
                        .file_proposal).html('<i class="bi bi-download"></i> Download') : $(
                        '#file_proposal').attr('href', '#').html('Tidak ada file.');

                    $('#status').val(data.status);

                    data.hasil ? $('#hasil').val(data.hasil) : $(
                        '#hasil').val('Belum ada catatan');

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
