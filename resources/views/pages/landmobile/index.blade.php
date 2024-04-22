@extends('layouts.app', ['title' => 'Data Landmobile'])

@push('style')
    <link href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css" rel="stylesheet">
@endpush

@section('content')
    <div class="container-fluid pt-4 px-4">
        @if (auth()->user()->role == 'admin' || auth()->user()->role == 'operator')
            <form id="import" action="{{ route('landmobiles.import') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="import_file" class="form-label">Import File :</label>
                    <input class="form-control" type="file" name="import_file" id="import_file">
                </div>
                <button type="submit" class="btn btn-primary mb-3"><i class="fa fa-upload me-2"></i>Import</button>
            </form>
        @endif
        <div class="col-12">
            <div class="bg-light rounded h-100 p-4">
                <h6 class="mb-4">Data Landmobile</h6>
                <div class="table-responsive">
                    <table class="table table-bordered table-hover" id="tbl-landmobile">
                        <thead>
                            <tr>
                                <th scope="col">LICENSE_ID</th>
                                <th scope="col">APPL_ID</th>
                                <th scope="col">CLNT_NAME</th>
                                <th scope="col">STN_NAME</th>
                                <th scope="col">FREQ</th>
                                <th scope="col">EQUIP_TYPE</th>
                                <th scope="col">EQ_MDL</th>
                                <th scope="col">STN_ADDR</th>
                                <th scope="col">CITY</th>
                                <th scope="col">MASA_LAKU</th>
                                @if (auth()->user()->role == 'admin' || auth()->user()->role == 'operator')
                                    <th scope="col">Action</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($landmobiles as $landmobile)
                                <tr>
                                    <td>{{ $landmobile->license_id }}</td>
                                    <td>{{ $landmobile->appl_id }}</td>
                                    <td>{{ $landmobile->clnt_name }}</td>
                                    <td>{{ $landmobile->stn_name }}</td>
                                    <td>{{ $landmobile->freq }}</td>
                                    <td>{{ $landmobile->equip_type }}</td>
                                    <td>{{ $landmobile->eq_mdl }}</td>
                                    <td>{{ $landmobile->stn_addr }}</td>
                                    <td>{{ $landmobile->city }}</td>
                                    <td>{{ $landmobile->masa_laku }}</td>
                                    @if (auth()->user()->role == 'admin' || auth()->user()->role == 'operator')
                                        <td>
                                            <div
                                                class="d-grid
                                            gap-2 d-md-block text-center">
                                                <a href="{{ route('landmobiles.edit', $landmobile->id) }}"
                                                    class="btn btn-warning btn-sm mx-2"><i class="fas fa-edit"></i> Edit</a>
                                                <form action="{{ route('landmobiles.destroy', $landmobile->id) }}"
                                                    method="POST">
                                                    <input type="hidden" name="_method" value="DELETE" />
                                                    <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                                                    <button class="btn btn-danger btn-sm show_confirm" type="submit"><i
                                                            class="fa fa-trash"></i>
                                                        Hapus</button>
                                                </form>
                                            </div>
                                        </td>
                                    @endif
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
    <script>
        new DataTable('#tbl-landmobile');
    </script>
    <script src="{{ asset('dashmin') }}/assets/js/sweetalert2.all.min.js"></script>

    <script>
        $('.show_confirm').click(function(event) {
            var form = $(this).closest("form");
            var name = $(this).data("name");
            event.preventDefault();

            Swal.fire({
                    title: "Apakah Anda Yakin Ingin Menghapus Data Berikut?",
                    text: "Data Yang Dihapus Tidak Dapat Dikembalikan.",
                    icon: "warning",
                    showCloseButton: true,
                    showCancelButton: true,
                    confirmButtonColor: "#28a745",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Hapus",
                    cancelButtonText: "Batal",
                })
                .then((willDelete) => {
                    if (willDelete.isConfirmed) {
                        form.submit();
                    }
                });
        });
    </script>

    <script>
        $(document).ready(function() {
            $('#import').on('submit', function(e) {
                e.preventDefault(); // Prevent the form from submitting normally
                let timerInterval;
                Swal.fire({
                    title: "Data Sedang Diimport..",
                    timer: 360000,
                    allowOutsideClick: false,
                    timerProgressBar: true,
                    didOpen: () => {
                        Swal.showLoading();
                        const timer = Swal.getPopup().querySelector("b");
                        timerInterval = setInterval(() => {
                            timer.textContent = `${Swal.getTimerLeft()}`;
                        }, 100);
                    },
                    willClose: () => {
                        clearInterval(timerInterval);
                    },
                    onBeforeOpen: () => {
                        Swal.showLoading();
                    }
                });
                setTimeout(() => {
                    e.target.submit();
                }, 500);
            });
        });
    </script>
@endpush
