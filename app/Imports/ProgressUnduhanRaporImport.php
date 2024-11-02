<?php

namespace App\Imports;

use App\Models\ProgressUnduhanRapor;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ProgressUnduhanRaporImport implements ToModel, WithHeadingRow
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $collection)
    {
        //
    }

    public function model(array $row)
    {
        return new ProgressUnduhanRapor([
            'tahun' => @$row['tahun'],
            'nama_provinsi' => @$row['nama_provinsi'],
            'nama_kabupaten' => @$row['nama_kab_kota'],
            'npsn' => @$row['npsn'],
            'nama_sekolah' => @$row['nama_sekolah'],
            'pengelompokan_jenjang' => @$row['pengelompokan_jenjang'],
            'pendidikan_sederajat' => @$row['pendidikan_sederajat'],
            'sekolah_aktif' => @$row['sekolah_aktif'],
            'sumber_listrik' => @$row['sumber_listrik'],
            'daerah_3t' => @$row['berada_di_daerah_3t'],
            'punya_belajar_id' => @$row['punya_belajar_id'],
            'aktivasi_belajar_id' => @$row['aktivasi_belajar_id'],
            'login_level_jenjang' => @$row['login_level_jenjang'],
            'unduh_level_jenjang' => @$row['unduh_level_jenjang'],
            'login_level_npsn' => @$row['login_level_npsn'],
            'unduh_level_npsn' => @$row['unduh_level_npsn'],
        ]);
    }
}
