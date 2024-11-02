<?php

namespace App\Imports;

use App\Models\DetailUserAktif;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class DetailUserAktifImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        return new DetailUserAktif([
            'npsn' => @$row['npsn'],
            'nama_sekolah' => @$row['nama_sekolah'],
            'jenjang' => @$row['jenjang'],
            'provinsi' => @$row['provinsi'],
            'kabupaten_kota' => @$row['kabupaten_kota'],
            'kecamatan' => @$row['kecamatan'],
            'tipe_akun' => @$row['tipe_akun'],
            'email' => @$row['email'],
        ]);
    }
}
