@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-12 bg-light rounded h-100 p-4 d-flex flex-column">
            <h3>Mahasiswa Seminar Komprehensif yang akan di Uji</h3>

            <div class="d-flex justify-content-between mb-3 mt-1">
                <div class="col-md-5">
                    <form action="/mahasiswa-uji-kompre">
                        <div class="input-group">
                            <input type="text" placeholder="search..." class="form-control" name="search"
                                value="{{ request('search') }}" autofocus>
                            <button type="submit" class="btn btn-primary">Search</button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr class="text-center">
                            <th scope="col">No</th>
                            <th scope="col">Nim</th>
                            <th scope="col">Mahasiswa</th>
                            <th scope="col">Judul</th>
                            <th scope="col">Tanggal Seminar</th>
                            <th scope="col">Status</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($kompres->count() !== 0)
                            @foreach ($kompres as $index => $kompre)
                                <tr key="{{ $kompre->id }}" class="text-center">
                                    <th scope="row" class="text-center">{{ $index + $kompres->firstItem() }}</th>
                                    <td>{{ $kompre->judul->mahasiswa->nim_or_nidn }}</td>
                                    <td>{{ $kompre->judul->mahasiswa->name }}</td>
                                    <td>{{ $kompre->judul->judul }}</td>
                                    <td>{{ \Carbon\Carbon::parse($kompre->tanggal_seminar)->translatedFormat('d F Y') ?? '-' }}
                                    </td>
                                    <td>
                                        <span
                                            class="bg-{{ $kompre->judul->mahasiswa->status == 'active' ? 'success' : 'danger' }} text-white px-3 py-1 rounded">
                                            {{ $kompre->judul->mahasiswa->status }}
                                        </span>
                                    </td>
                                    <td>
                                        <a href="javascript:void(0)" id="show-mahasiswa"
                                            data-url="/mahasiswa-skripsi/{{ $kompre->judul->mahasiswa->id }}"
                                            class="btn btn-sm btn-outline-primary"><i class="bi bi-eye-fill"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <td colspan="7" class="text-center">No Data</td>
                        @endif

                    </tbody>
                </table>
                {{-- paginate --}}
                <div class="col-md-12 d-flex justify-content-between">
                    Show {{ $kompres->firstItem() ?? 0 }}
                    to {{ $kompres->lastItem() ?? 0 }} items
                    of total {{ $kompres->total() }} items
                    {{ $kompres->links() }}
                </div>
            </div>
        </div>
    </div>
    <!-- Modal show -->
    <div class="modal fade" id="mahasiswaView" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Detail Mahasiswa</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="nim" class="form-label">NIM</label>
                                <input type="text" id="nim" class="form-control" disabled>
                            </div>

                            <div class="mb-3">
                                <label for="name" class="form-label">Nama</label>
                                <input type="text" id="name" class="form-control" disabled>
                            </div>

                            <div class="mb-3">
                                <label for="tempatlahir" class="form-label">Tempat Lahir</label>
                                <input type="text" id="tempatlahir" class="form-control" disabled />
                            </div>
                            <div class="mb-3">
                                <label for="tanggallahir" class="form-label">Tanggal Lahir</label>
                                <input type="text" id="tanggallahir" class="form-control" disabled />
                            </div>
                            <div class="mb-3">
                                <label for="jeniskelamin" class="form-label">Jenis Kelamin</label>
                                <input type="text" id="jeniskelamin" class="form-control" disabled />
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="text" id="email" class="form-control" disabled />
                            </div>

                            <div class="mb-3">
                                <label for="nohp" class="form-label">Nomor Handphone</label>
                                <input type="text" id="nohp" class="form-control" disabled />
                            </div>

                            <div class="mb-3">
                                <label for="alamat" class="form-label">Alamat</label>
                                <input type="text" id="alamat" class="form-control" disabled />
                            </div>

                            <div class="mb-3">
                                <label for="angkatan" class="form-label">Angkatan</label>
                                <input type="text" id="angkatan" class="form-control" disabled />
                            </div>

                            <div class="mb-3">
                                <label for="status" class="form-label">Status</label>
                                <input type="text" id="status" class="form-control" disabled />
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
            $('body').on('click', '#show-mahasiswa', function() {

                let judulUrl = $(this).data('url');
                $.get(judulUrl, function(data) {
                    $('#mahasiswaView').modal('show');
                    console.log(data)
                    $('#nim').val(data.nim_or_nidn);
                    $('#name').val(data.name);
                    $('#status').val(data.status);

                    data.tempat_lahir ? $('#tempatlahir').val(data.tempat_lahir) :
                        $('#tempatlahir').val('-');

                    data.tanggal_lahir ? $('#tanggallahir').val(data.tanggal_lahir) :
                        $('#tanggallahir').val('-');

                    data.jenis_kelamin ? $('#jeniskelamin').val(data.jenis_kelamin) :
                        $('#jeniskelamin').val('-');

                    data.email ? $('#email').val(data.email) : $('#email').val('-');

                    data.no_hp ? $('#nohp').val(data.no_hp) : $('#nohp').val('-');

                    data.alamat ? $('#alamat').val(data.alamat) : $('#alamat').val('-');

                    data.angkatan ? $('#angkatan').val(data.angkatan) : $('#angkatan').val('-');

                })
            })
        })
    </script>
@endsection
