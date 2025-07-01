@extends('layouts.app')

@section('content')
    <h2>Daftar User</h2>
    <h2>
        <a href="{{ route('pegawai.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle me-2"></i> Tambah Pengguna
        </a>
    </h2>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <table id="user-table" class="table table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Role</th>
                <th>Aksi</th>
            </tr>
        </thead>
    </table>

    @push('scripts')
        <script>
            $(function() {
                $('#user-table').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: '{{ route('pegawai.data') }}',
                    columns: [{
                            data: 'DT_RowIndex',
                            name: 'DT_RowIndex',
                            orderable: false,
                            searchable: false
                        },
                        {
                            data: 'name',
                            name: 'name'
                        },
                        {
                            data: 'role',
                            name: 'role',
                            orderable: false,
                            searchable: false
                        },
                        {
                            data: 'aksi',
                            name: 'aksi',
                            orderable: false,
                            searchable: false
                        }
                    ],
                    columnDefs: [{
                        targets: '_all',
                        defaultContent: '-', // Jika data tidak ada, tampilkan -
                    }]
                });

            });
        </script>
    @endpush
@endsection
