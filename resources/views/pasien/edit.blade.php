@extends('layouts.app')

@section('content')
    <h2>Edit Produk</h2>
    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Ups!</strong> Ada kesalahan saat input data:<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('pasien.update', $pasien->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="form-group mb-3">
            <label>Nama</label>
            <input type="text" name="name" value="{{ $pasien->name }}" class="form-control" required>
        </div>

        <div class="form-group mb-3">
            <label>NIK</label>
            <input type="text" name="nik" value="{{ $pasien->nik }}" class="form-control" required>
        </div>

        <div class="form-group mb-3">
            <label>Tanggal Lahir</label>
            <input type="date" name="tanggal_lahir" value="{{ $pasien->tanggal_lahir }}" class="form-control" required>
        </div>

        <div class="form-group mb-3">
            <label>Jenis Kelamin</label>
            <select name="jenis_kelamin" class="form-control" required>
                <option value="L" {{ $pasien->jenis_kelamin == 'L' ? 'selected' : '' }}>Laki-laki</option>
                <option value="P" {{ $pasien->jenis_kelamin == 'P' ? 'selected' : '' }}>Perempuan</option>
            </select>
        </div>

        <div class="form-group mb-3">
            <label>Alamat</label>
            <input type="text" name="alamat" class="form-control" value="{{ $pasien->alamat }}" required>
        </div>

        <div class="form-group mb-3">
            <label>Status</label>
            <select name="status" class="form-control" required>
                <option value="Rawat Jalan" {{ $pasien->status == 'Rawat Jalan' ? 'selected' : '' }}>Rawat Jalan</option>
                <option value="Rawat Inap" {{ $pasien->status == 'Rawat Inap' ? 'selected' : '' }}>Rawat Inap</option>
                <option value="Rujuk Keluar" {{ $pasien->status == 'Rujuk Keluar' ? 'selected' : '' }}>Rujuk Keluar
                </option>
            </select>
        </div>

        <div class="form-group mb-3">
            <label>Tanggal Masuk</label>
            <input type="date" name="tanggal_masuk" value="{{ $pasien->tanggal_masuk }}" class="form-control" required>
        </div>

        <div class="form-group mb-3">
            <label>Gambar</label><br>
            <img id="preview" src="{{ $pasien->gambar ? asset('storage/' . $pasien->gambar) : '#' }}"
                style="max-height: 100px; {{ $pasien->gambar ? '' : 'display:none;' }}">
        </div>

        <div class="form-group mb-3">
            <label>Ganti Gambar</label>
            <input type="file" name="gambar" class="form-control-file" onchange="previewGambar(event)">
        </div>

        <button type="submit" class="btn btn-success btn-sm shadow-sm">
            <i class="fas fa-save"></i> Update
        </button>
    </form>

    <script>
        function previewGambar(event) {
            const input = event.target;
            const preview = document.getElementById('preview');

            if (input.files && input.files[0]) {
                const reader = new FileReader();

                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.style.display = 'block';
                };

                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
@endsection
