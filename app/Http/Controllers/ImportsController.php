<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class ImportsController extends Controller
{
    public function index()
    {
        // update changes log
        DB::table('version')
            ->where('tables', 'progress_unduhan_rapor')
            ->update([
                'version' => DB::raw('version + 1'),
                'updated_at' => now(),
            ]);

        return view('admin.imports.choose');
    }
}
