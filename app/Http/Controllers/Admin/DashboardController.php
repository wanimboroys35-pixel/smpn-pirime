<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Siswa;
use App\Models\User;
use App\Models\Guru;
use App\Models\Pendaftar;

class DashboardController extends Controller
{
    public function index()
    {
        // Hitung total data
        $totalSiswa     = Siswa::count();
        $totalUser      = User::count();
        $totalGuru      = Guru::count();
        $totalPendaftar = Pendaftar::count();

        // Hitung berdasarkan status
        $totalPending  = Pendaftar::where('status', 'pending')->count();
        $totalDiterima = Pendaftar::where('status', 'accepted')->count();
        $totalDitolak  = Pendaftar::where('status', 'rejected')->count();

        // Ambil siswa pendaftar dengan pagination (10 per halaman)
        $siswas = Pendaftar::latest()->paginate(10);

        return view('admin.dashboard', compact(
            'totalSiswa',
            'totalUser',
            'totalGuru',
            'totalPendaftar',
            'totalPending',
            'totalDiterima',
            'totalDitolak',
            'siswas'
        ));
    }
}
