<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DetailUserAktif;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\DetailUserAktifImport;

class DashboardController extends Controller
{
    public function index()
    {
        return view('admin.dashboard.index');
    }
}
