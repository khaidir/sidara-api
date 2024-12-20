<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Imports\ProgressUnduhanRaporImport;
use Maatwebsite\Excel\Facades\Excel;

class ProgressUnduhanRaporController extends Controller
{

    public function index()
    {
        return view('admin.progress-unduhan-rapor.form');
    }

    public function importExcel(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls'
        ]);

        Excel::import(new ProgressUnduhanRaporImport, $request->file('file'));

        // update changes log
        DB::table('version')
            ->where('tables', 'progress_unduhan_rapor')
            ->update([
                'version' => DB::raw('version + 1'),
                'updated_at' => now(),
            ]);

        return redirect()->back()->with('success', 'Data imported successfully.');
    }
}
// progress_unduhan_rapor
