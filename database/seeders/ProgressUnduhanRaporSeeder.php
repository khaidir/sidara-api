<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ProgressUnduhanRapor;

class ProgressUnduhanRaporSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ProgressUnduhanRapor::create([
            'tahun' => 2024,
            'nama_provinsi' => 'Prov. Aceh',
            'nama_kabupaten' => 'Kab. Aceh Besar',
            'npsn' => '10100184',
            'nama_sekolah' => 'SDN LIENG SA',
            'pengelompokan_jenjang' => 'SD',
            'pendidikan_sederajat' => 'SD',
            'sekolah_aktif' => 'Ya',
            'sumber_listrik' => 'PLN',
            'daerah_3t' => 'Tidak',
            'punya_belajar_id' => 'Sudah',
            'aktivasi_belajar_id' => 'Sudah',
            'login_level_jenjang' => 'Sudah',
            'unduh_level_jenjang' => 'Sudah',
            'login_level_npsn' => 'Sudah',
            'unduh_level_npsn' => 'Sudah',
        ]);
    }
}
