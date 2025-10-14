<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Siswa; // pastikan model Siswa ada

class AdminController extends Controller
{
    public function index()
    {
        // ambil semua data siswa
        $siswa = Siswa::all();

        return view('dashboards.admin', compact('siswa'));
    }
}
