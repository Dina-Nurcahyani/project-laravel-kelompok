@extends('layouts.app')

@section('content')
    <h2>Tambah Produk Wisata</h2>

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

    <form action="{{ route('pasien.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="form-group mb-3">
            <label>Nama Pasien</label>
            <input type="text" name="name" class="form-control" placeholder="Contoh: Agus" required>
        </div>

        <div class="form-group mb-3">
            <label>NIK</label>
            <input type="text" name="nik" class="form-control" placeholder="Contoh: 321321321321" required>
        </div>

        <div class="form-group mb-3">
            <label>Tanggal Lahir</label>
            <input type="date" name="tanggal_lahir" class="form-control" required></input>
        </div>

        <div class="form-group mb-3">
            <label>Jenis Kelamin</label>
            <select name="jenis_kelamin" class="form-control" required>
                <option value="L" selected>Laki-laki</option>
                <option value="P">Perempuan</option>
            </select>
        </div>

        <div class="form-group mb-3">
            <label>Alamat</label>
            <input type="text" name="alamat" class="form-control" required>
        </div>

        <div class="form-group mb-3">
            <label>Status</label>
            <select name="status" class="form-control" required>
                <option value="Rawat Jalan" selected>Rawat Jalan</option>
                <option value="Rawat Inap">Rawat Inap</option>
                <option value="Rujuk Keluar">Rujuk Keluar</option>
            </select>
        </div>

        <div class="form-group mb-3">
            <div class="form-group mb-3">
                <label>Tanggal Masuk</label>
                <input type="date" name="tanggal_masuk" class="form-control" required></input>
            </div>
        </div>

        <div class="form-group mb-4">
            <label>Gambar</label>
            <input type="file" name="gambar" class="form-control-file" onchange="previewImage(event)">
            <br>
            <img id="preview" src="#" alt="Preview Gambar"
                style="max-width: 300px; display: none; margin-top: 10px;" />
        </div>

        <button type="submit" class="btn btn-primary">Simpan Data</button>
        <a href="{{ route('pasien.index') }}" class="btn btn-secondary">Kembali</a>
    </form>

    <script>
        function previewImage(event) {
            const input = event.target;
            const preview = document.getElementById('preview');
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.style.display = 'block';
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
@endsection
