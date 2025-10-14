<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Siswa; // tambahkan model Siswa

class UserController extends Controller
{
    public function index()
    {
        // Ambil semua data siswa
        $siswas = Siswa::all();
        

        // Kirim ke view
        return view('user.dashboard', compact('siswas'));
    }
}
