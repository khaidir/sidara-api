<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProgressUnduhanRapor extends Model
{
    use HasFactory;

    protected $table = 'progress_unduhan_rapor';

    protected $fillable = [
        'tahun',
        'nama_provinsi',
        'nama_kabupaten',
        'npsn',
        'nama_sekolah',
        'pengelompokan_jenjang',
        'pendidikan_sederajat',
        'sekolah_aktif',
        'sumber_listrik',
        'daerah_3t',
        'punya_belajar_id',
        'aktivasi_belajar_id',
        'login_level_jenjang',
        'unduh_level_jenjang',
        'login_level_npsn',
        'unduh_level_npsn',
    ];
}
