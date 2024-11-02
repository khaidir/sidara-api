<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailUserAktif extends Model
{
    use HasFactory;

    protected $table = 'detail_user_aktif';

    protected $fillable = [
        'npsn',
        'nama_sekolah',
        'jenjang',
        'provinsi',
        'kabupaten_kota',
        'kecamatan',
        'tipe_akun',
        'email',
    ];
}
