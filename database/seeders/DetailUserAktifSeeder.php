<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\DetailUserAktif;

class DetailUserAktifSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DetailUserAktif::create([
            'npsn' => 10105584,
            'nama_sekolah' => 'SD NEGERI 5 MUARA SATU',
            'jenjang' => 'SD',
            'provinsi' => 'Prov. Aceh',
            'kabupaten_kota' => 'Kota Lhokseumawe',
            'kecamatan' => 'MUARA SATU',
            'tipe_akun' => 'Peserta Didik',
            'email' => 'afifa.fitia2932@sd.belajar.id',
        ]);
    }
}
