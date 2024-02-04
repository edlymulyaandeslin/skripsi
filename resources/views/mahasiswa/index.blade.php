@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-12 bg-light rounded h-100 p-4 d-flex flex-column">
            <h3>Mahasiswa Skripsi</h3>

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
                <a href="{{ route('teampenguji.create') }}" class="btn btn-sm btn-primary">Team Baru <i
                        class="fa fa-plus"></i></a>
            </div>

            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr class="text-center">
                            <th scope="col">No</th>
                            <th scope="col">Nama Team</th>
                            <th scope="col">Penguji 1</th>
                            <th scope="col">Penguji 2</th>
                            <th scope="col">Penguji 3</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- @if ($listteampenguji->count() !== 0)
                            @foreach ($listteampenguji as $team)
                                <tr key="{{ $team->id }}" class="text-center">
                                    <th scope="row" class="text-center">{{ $loop->index + 1 }}</th>
                                    <td>{{ $team->name }}</td>
                                    <td>{{ $team->penguji1 ?? '-' }}</td>
                                    <td>{{ $team->penguji2 ?? '-' }}</td>
                                    <td>{{ $team->penguji3 ?? '-' }}</td>
                                    <td>
                                        <div>
                                            <button type="button" class="btn btn-sm btn-outline-dark"
                                                data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="bi bi-list"></i>
                                            </button>
                                            <ul class="dropdown-menu">
                                                <li>
                                                    <a href="javascript:void(0)" id="show-teampenguji"
                                                        data-url="{{ route('teampenguji.show', $team->id) }}"
                                                        class="dropdown-item"><i class="bi bi-search text-info"></i>
                                                        Show</a>
                                                </li>

                                                <li>
                                                    <a class="dropdown-item"
                                                        href="/manajemen/teampenguji/{{ $team->id }}/edit">
                                                        <i class="bi bi-pencil-square text-warning"></i>
                                                        Update
                                                    </a>
                                                </li>

                                                <li>
                                                    <hr class="dropdown-divider">
                                                </li>

                                                <li>
                                                    <form action="/manajemen/teampenguji/{{ $team->id }}"
                                                        method="POST">
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
                            <td colspan="7" class="text-center">No Data</td>
                        @endif --}}

                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal show -->
    <div class="modal fade" id="teampengujiView" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Detail Team Penguji</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label for="team" class="form-label">Nama Team</label>
                                <input type="text" id="team" class="form-control" disabled>
                            </div>

                            <div class="mb-3">
                                <label for="penguji1" class="form-label">Penguji 1</label>
                                <input type="text" id="penguji1" class="form-control" disabled />
                            </div>
                            <div class="mb-3">
                                <label for="penguji2" class="form-label">Penguji 2</label>
                                <input type="text" id="penguji2" class="form-control" disabled />
                            </div>
                            <div class="mb-3">
                                <label for="penguji3" class="form-label">Penguji 3</label>
                                <input type="text" id="penguji3" class="form-control" disabled />
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
            $('body').on('click', '#show-teampenguji', function() {

                let judulUrl = $(this).data('url');
                $.get(judulUrl, function(data) {
                    $('#teampengujiView').modal('show');
                    $('#team').val(data.name);
                    $('#penguji1').val(data.penguji1);
                    $('#penguji2').val(data.penguji2);
                    $('#penguji3').val(data.penguji3);
                })
            })
        })
    </script>
@endsection
