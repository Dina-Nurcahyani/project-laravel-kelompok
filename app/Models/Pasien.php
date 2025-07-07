<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pasien extends Model
{
    protected $fillable = [
        'name',
        'nik',
        'tanggal_lahir',
        'jenis_kelamin',
        'alamat',
        'status',
        'tanggal_masuk',
        'gambar'
    ];
}
