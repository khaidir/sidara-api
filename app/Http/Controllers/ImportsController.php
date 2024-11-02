<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ImportsController extends Controller
{
    public function index()
    {
        return view('admin.imports.choose');
    }
}
