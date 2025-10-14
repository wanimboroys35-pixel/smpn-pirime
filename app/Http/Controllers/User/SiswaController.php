<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


use App\Models\Siswa;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class SiswaController extends Controller
{
    // Menampilkan form tambah siswa
    public function create()
    {
        return view('user.siswas.create');
    }

    // Menyimpan data siswa
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'tempat_lahir' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'alamat' => 'required|string',
            'asal_sekolah' => 'nullable|string|max:255',
            'tahun_angkatan' => 'nullable|integer',
            'email' => 'nullable|email|max:255',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'kk' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
            'akte' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
            'raport' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
        ]);

        $data = $request->only([
            'nama', 'tempat_lahir', 'tanggal_lahir', 'jenis_kelamin', 
            'alamat', 'asal_sekolah', 'tahun_angkatan', 'email'
        ]);

        // Upload file jika ada
        $data['foto'] = $this->uploadFile($request, 'foto', 'siswa/foto');
        $data['kk'] = $this->uploadFile($request, 'kk', 'siswa/kk');
        $data['akte'] = $this->uploadFile($request, 'akte', 'siswa/akte');
        $data['raport'] = $this->uploadFile($request, 'raport', 'siswa/raport');

        $data['user_id'] = Auth::id();

        Siswa::create($data);

        return redirect()->route('user.siswas.index')->with('success', 'Data berhasil disimpan!');

    }

    // Fungsi bantu upload file
    private function uploadFile(Request $request, $field, $path)
    {
        if ($request->hasFile($field)) {
            return $request->file($field)->store($path, 'public');
        }
        return null;
    }

    // Menampilkan daftar siswa milik user (dengan pagination)
    public function index()
    {
        $siswas = Siswa::where('user_id', Auth::id())
                       ->orderBy('created_at', 'desc')
                       ->paginate(10); // 10 per halaman
        return view('user.siswas.index', compact('siswas'));
    }

    // Menampilkan detail siswa
    public function show(Siswa $siswa)
    {
        // Hapus authorize jika belum buat policy
        // $this->authorize('view', $siswa);

        // Pastikan hanya user yang punya data bisa melihat
        if ($siswa->user_id != Auth::id()) {
            abort(403);
        }

        return view('user.siswas.show', compact('siswa'));
    }


     // Export Excel
    public function export() {
        return Excel::download(new SiswaExport, 'siswa.xlsx');
    }

    // Import Excel
    public function import(Request $request) {
        Excel::import(new SiswaImport, $request->file('file'));
        return redirect()->back()->with('success', 'Data berhasil diimport!');
        
    }

    // Cetak PDF
    public function cetak() {
        $siswas = Siswa::where('user_id', auth()->id())->get();
        $pdf = \PDF::loadView('user.siswas.cetak', compact('siswas'));
        return $pdf->download('siswa.pdf');
    }
}
