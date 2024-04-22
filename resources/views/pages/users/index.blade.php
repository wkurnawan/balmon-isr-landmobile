@extends('layouts.app', ['title' => 'Data Users'])

@push('style')
    <link href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css" rel="stylesheet">
@endpush

@section('content')
    <div class="container-fluid pt-4 px-4">
        <a href="{{ route('users.create') }}" class="btn btn-primary mb-3"><i class="fa fa-plus me-2"></i>Tambah User</a>
        <div class="bg-light rounded h-100 p-4">
            <h6 class="mb-4">Data Users</h6>
            <div class="table-responsive">
                <table class="table" id="tbl-users">
                    <thead>
                        <tr>
                            <th scope="col">Profile</th>
                            <th scope="col">Name</th>
                            <th scope="col">Username</th>
                            <th scope="col">Email</th>
                            <th scope="col">Phone</th>
                            <th scope="col">Roles</th>
                            @if (auth()->user()->role == 'pimpinan')
                            @elseif (auth()->user()->role == 'admin')
                                <th scope="col">Action</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <td class="text-center">
                                    @if ($user->avatar == null)
                                        <img src="{{ asset('dashmin') }}/assets/img/profile.jpg" class="rounded-circle"
                                            width="50">
                                    @elseif ($user->avatar != null)
                                        <img src="{{ asset('storage/avatars/' . $user->avatar) }}" class="rounded-circle"
                                            width="50">
                                    @endif
                                </td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->username }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->phone }}</td>
                                <td>{{ $user->role }}</td>
                                @if (auth()->user()->role == 'pimpinan')
                                @elseif (auth()->user()->role == 'admin')
                                    <td>
                                        <a href="{{ route('users.edit', $user->id) }}" class="btn btn-warning btn-sm"><i
                                                class="fas fa-edit"></i> Edit</a>
                                        @if ($user->role == 'admin')
                                        @else
                                            <form action="{{ route('users.destroy', $user->id) }}" method="POST">
                                                <input type="hidden" name="_method" value="DELETE" />
                                                <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                                                <button class="btn btn-danger btn-sm show_confirm" type="submit"><i
                                                        class="fa fa-trash"></i>
                                                    Hapus</button>
                                            </form>
                                        @endif
                                    </td>
                                @endif
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
    <script>
        new DataTable('#tbl-users');
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
@endpush
