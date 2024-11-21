<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DetailUserAktif;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\DetailUserAktifImport;

class DetailUserAktifController extends Controller
{

    public function index()
    {
        return view('admin.detail-user-aktif.form');
    }

    public function importExcel(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls,csv',
        ]);

        Excel::import(new DetailUserAktifImport, $request->file('file'));

        // update changes log
        DB::table('version')
            ->where('tables', 'detail_user_aktif')
            ->update([
                'version' => DB::raw('version + 1'),
                'updated_at' => now(),
            ]);

        return redirect()->back()->with('success', 'Data berhasil diimport.');
    }
}
