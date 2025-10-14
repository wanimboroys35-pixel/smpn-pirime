<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Siswa;

class SiswaController extends Controller
{
    // Tampilkan form pendaftaran siswa
    public function create()
    {
        return view('user.formulir'); 
        // pastikan ada file resources/views/user/formulir.blade.php
    }

    // Simpan data pendaftaran siswa baru
    public function store(Request $request)
    {
        $request->validate([
            'nama'           => 'required|string|max:255',
            'email'          => 'required|email|unique:siswas,email',
            'tempat_lahir'   => 'nullable|string|max:255',
            'tanggal_lahir'  => 'nullable|date',
            'jenis_kelamin'  => 'nullable|in:Laki-laki,Perempuan',
            'alamat'         => 'nullable|string',
            'asal_sekolah'   => 'nullable|string',
            'tahun_angkatan' => 'nullable|numeric',
        ]);

        Siswa::create([
            'nama'           => $request->nama,
            'tempat_lahir'   => $request->tempat_lahir,
            'tanggal_lahir'  => $request->tanggal_lahir,
            'jenis_kelamin'  => $request->jenis_kelamin,
            'alamat'         => $request->alamat,
            'asal_sekolah'   => $request->asal_sekolah,
            'tahun_angkatan' => $request->tahun_angkatan,
            'email'          => $request->email,
            'user_id'        => auth()->id(),
        ]);

        return redirect()->route('user.dashboard')->with('success', 'Data siswa berhasil disimpan!');
    }

    // Form edit siswa
    public function edit(Siswa $siswa)
    {
        return view('user.siswas.edit', compact('siswa'));
    }

    // Update data siswa
    public function update(Request $request, Siswa $siswa)
    {
        if ($siswa->user_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }

        $request->validate([
            'nama'           => 'required|string|max:255',
            'tempat_lahir'   => 'required|string|max:100',
            'tanggal_lahir'  => 'required|date',
            'jenis_kelamin'  => 'required',
            'asal_sekolah'   => 'required|string|max:255',
            'tahun_angkatan' => 'required|integer',
            'email'          => 'required|email|unique:siswas,email,' . $siswa->id,
        ]);

        $siswa->update($request->all());

        return redirect()->route('user.dashboard')->with('success', 'Data siswa berhasil diperbarui!');
    }

    // Hapus data siswa
    public function destroy(Siswa $siswa)
    {
        if ($siswa->user_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }

        $siswa->delete();

        return redirect()->route('user.dashboard')->with('success', 'Data siswa berhasil dihapus!');
    }
}
