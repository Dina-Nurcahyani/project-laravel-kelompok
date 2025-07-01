@extends('layouts.app')

@section('content')
    <h2>Daftar Pasien</h2>
    @if (auth()->user()->role === 'admin')
        <h2>
            <a href="{{ route('pasien.create') }}" class="btn btn-primary">
                <i class="bi bi-plus-circle me-2"></i> Tambah Pasien
            </a>
        </h2>
    @endif

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <table id="produk-table" class="table table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                @if (auth()->user()->role === 'admin')
                    <th>NIK</th>
                @endif
                <th>Tanggal Lahir</th>
                <th>Jenis Kelamin</th>
                <th>Alamat</th>
                <th>Status</th>
                <th>Tanggal Masuk</th>
                <th>Gambar</th>
                @if (auth()->user()->role === 'admin')
                    <th>Aksi</th>
                @endif
            </tr>
        </thead>
    </table>

    @push('scripts')
        <script>
            $(function() {
                $('#produk-table').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: '{{ route('pasien.data') }}',

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
                            data: 'nik',
                            name: 'nik'
                        },
                        {
                            data: 'tanggal_lahir',
                            name: 'tanggal_lahir'
                        },
                        {
                            data: 'jenis_kelamin',
                            name: 'jenis_kelamin'
                        },
                        {
                            data: 'alamat',
                            name: 'alamat'
                        },
                        {
                            data: 'status',
                            name: 'status'
                        },
                        {
                            data: 'tanggal_masuk',
                            name: 'tanggal_masuk'
                        },
                        {
                            data: 'gambar',
                            name: 'gambar',
                            orderable: false,
                            searchable: false
                        },
                        @if (auth()->user()->role === 'admin')
                            {
                                data: 'aksi',
                                name: 'aksi',
                                orderable: false,
                                searchable: false
                            },
                        @endif
                    ]

                });
            });
        </script>
    @endpush
@endsection
