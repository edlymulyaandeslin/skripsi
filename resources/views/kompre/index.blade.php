@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-12 bg-light rounded h-100 p-4 d-flex flex-column">
            <h3>Seminar Komprehensif</h3>

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
                        <tr class="text-center align-middle">
                            <th scope="col">No</th>

                            @cannot('mahasiswa')
                                <th scope="col">NIM</th>
                                <th scope="col">Mahasiswa</th>
                            @endcannot
                            <th scope="col">Judul</th>
                            <th scope="col">Tanggal Seminar</th>
                            <th scope="col">Ruang Seminar</th>
                            <th scope="col">Status</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($kompres->count() !== 0)
                            @foreach ($kompres as $index => $kompre)
                                <tr key="{{ $kompre->id }}" class="text-center">
                                    <th scope="row">{{ $index + $kompres->firstItem() }}</th>
                                    @cannot('mahasiswa')
                                        <td>{{ $kompre->judul->mahasiswa->nim_or_nidn }}</td>
                                        <td>{{ $kompre->judul->mahasiswa->name }}</td>
                                    @endcannot
                                    <td>{{ $kompre->judul->judul }}</td>
                                    <td>{{ $kompre->tanggal_seminar ? Carbon\Carbon::parse($kompre->tanggal_seminar)->translatedFormat('d F Y') : '-' }}
                                    </td>
                                    <td>{{ $kompre->ruang ?? '-' }}</td>
                                    <td>
                                        <span
                                            class="bg-{{ $kompre->status == 'diterima' ? 'success' : ($kompre->status == 'lulus' ? 'primary' : ($kompre->status == 'tidak lulus' ? 'danger' : 'warning')) }} rounded text-white px-3 py-1">
                                            {{ $kompre->status }}
                                        </span>
                                    </td>
                                    <td>
                                        @unless (auth()->user()->can('admin') || auth()->user()->can('dosen'))
                                            <div>
                                                <button type="button" class="btn btn-sm btn-outline-dark"
                                                    data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="bi bi-list"></i>
                                                </button>
                                                <ul class="dropdown-menu">
                                                    <li>
                                                        <a href="javascript:void(0)" id="show-kompre"
                                                            data-url="/kompre/{{ $kompre->id }}" class="dropdown-item"><i
                                                                class="bi bi-search text-info"></i>
                                                            Lihat</a>
                                                    </li>

                                                    @can('koordinator')
                                                        <li>
                                                            <a class="dropdown-item" href="/kompre/{{ $kompre->id }}/edit">
                                                                <i class="bi bi-pencil-square text-warning"></i>
                                                                Verifikasi
                                                            </a>
                                                        </li>
                                                    @endcan

                                                    <li>
                                                        <hr class="dropdown-divider">
                                                    </li>

                                                    @if ($kompre->status == 'diajukan')
                                                        @can('mahasiswa')
                                                            <li>
                                                                <a href="{{ route('kompre.destroy', $kompre->id) }}"class="dropdown-item"
                                                                    data-confirm-delete="true"><i
                                                                        class="bi bi-trash-fill text-danger"></i> Batalkan</a>
                                                            </li>
                                                        @endcan
                                                    @elseif($kompre->status == 'tidak lulus')
                                                        @can('koordinator')
                                                            <li>
                                                                <a href="{{ route('kompre.destroy', $kompre->id) }}"class="dropdown-item"
                                                                    data-confirm-delete="true"><i
                                                                        class="bi bi-trash-fill text-danger"></i> Hapus</a>
                                                            </li>
                                                        @endcan
                                                    @else
                                                        {{ '' }}
                                                    @endif

                                                </ul>
                                            </div>
                                        @endunless

                                        @unless (auth()->user()->can('mahasiswa') || auth()->user()->can('koordinator'))
                                            <a href="javascript:void(0)" id="show-kompre"
                                                data-url="/kompre/{{ $kompre->id }}"
                                                class="btn btn-sm btn-outline-primary"><i class="bi bi-eye-fill"></i>
                                            </a>
                                        @endunless

                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <td colspan="9" class="text-center">No Data</td>
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
            </div>
        </div>
    </div>

    <!-- Modal show -->
    <div class="modal fade" id="kompreView" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-scrollable">
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

                        <h1 class="modal-title fs-5 mb-3 border-bottom">Catatan</h1>

                        <div class="mb-3">
                            <textarea id="notes" class="form-control" disabled rows="4"></textarea>
                        </div>

                        <h1 class="modal-title fs-5 mb-3 border-bottom">Pembimbing</h1>

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
                        <h1 class="modal-title fs-5 mb-3 border-bottom">Penguji</h1>

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

                        <h1 class="modal-title fs-5 mb-3 border-bottom">Persyaratan</h1>

                        <div class="mb-3">
                            <label for="krs" class="form-label">KRS</label>
                            <a href="#" id="krs" class="form-control">Download</a>

                        </div>
                        <div class="mb-3">
                            <label for="transkipnilai" class="form-label">Transkip Nilai</label>
                            <a href="#" id="transkipnilai" class="form-control">Download</a>
                        </div>
                        <div class="mb-3">
                            <label for="hadirseminar" class="form-label">Hadir Seminar</label>
                            <a href="#" id="hadirseminar" class="form-control">Download</a>
                        </div>
                        <div class="mb-3">
                            <label for="lembarbimbingan" class="form-label">Lembar Bimbingan</label>
                            <a href="#" id="lembarbimbingan" class="form-control">Download</a>
                        </div>
                        <div class="mb-3">
                            <label for="pembayaran" class="form-label">Pembayaran</label>
                            <a href="#" id="pembayaran" class="form-control">Download</a>
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
            $('body').on('click', '#show-kompre', function() {

                let judulUrl = $(this).data('url');
                $.get(judulUrl, function(data) {
                    $('#kompreView').modal('show');

                    console.log(data)
                    $('#mahasiswa').val(data.judul.mahasiswa.name);

                    $('#judul').val(data.judul.judul);

                    let date = new Date(data.tanggal_seminar);

                    data.tanggal_seminar ? $('#tanggal_seminar').val(date.toLocaleDateString(
                        'id-ID', {
                            day: '2-digit',
                            month: 'long',
                            year: 'numeric'
                        })) : $(
                        '#tanggal_seminar').val('-');

                    data.jam ? $('#jam').val(data.jam.split(':').slice(0, 2).join(':') + ' WIB') :
                        $(
                            '#jam')
                        .val('-');

                    data.ruang ? $('#ruang').val(data.ruang) : $('#ruang').val('-');

                    data.notes ? $('#notes').val(data.notes) : $('#notes').val('-');

                    $('#status').val(data.status);



                    data.penguji1 ? $('#penguji1').val(data.penguji1.name) : $('#penguji1').val(
                        '-');
                    data.penguji2 ? $('#penguji2').val(data.penguji2.name) : $('#penguji2').val(
                        '-');
                    data.penguji3 ? $('#penguji3').val(data.penguji3.name) : $('#penguji3').val(
                        '-');

                    data.judul.pembimbing1 ? $('#pembimbing1').val(data.judul.pembimbing1.name) : $(
                        '#pembimbing1').val('-');
                    data.judul.pembimbing2 ? $('#pembimbing2').val(data.judul.pembimbing2.name) : $(
                        '#pembimbing2').val('-');


                    $('#krs').attr('href', 'storage/' + data.judul.mahasiswa.dokumen.krs);
                    $('#transkipnilai').attr('href', 'storage/' + data.judul.mahasiswa.dokumen
                        .transkip_nilai);
                    $('#hadirseminar').attr('href', 'storage/' + data.judul.mahasiswa.dokumen
                        .hadir_seminar);
                    $('#lembarbimbingan').attr('href', 'storage/' + data.lembar_bimbingan);
                    $('#pembayaran').attr('href', 'storage/' + data.pembayaran);


                })
            })
        })
    </script>
@endsection
