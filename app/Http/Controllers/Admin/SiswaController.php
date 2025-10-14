<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Siswa;
use App\Models\User;
use App\Models\Guru;

class SiswaController extends Controller
{
    /**
     * Dashboard siswa dengan filter & pagination
     */
    public function dashboard(Request $request)
    {
        $query = Siswa::query();

        if ($request->filled('search')) {
            $query->where('nama', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $siswas = $query->latest()->paginate(10);

        return view('admin.siswas.dashboard', [
            'siswas'         => $siswas,
            'totalSiswa'     => Siswa::count(),
            'totalPending'   => Siswa::where('status', 'pending')->count(),
            'totalDiterima'  => Siswa::where('status', 'accepted')->count(),
            'totalDitolak'   => Siswa::where('status', 'rejected')->count(),
            'totalUser'      => User::count(),
            'totalGuru'      => Guru::count(),
            'totalPendaftar' => Siswa::count(),
        ]);
    }

    /**
     * List siswa (resource index)
     */
    public function index()
    {
        $siswas = Siswa::latest()->paginate(10);
        return view('admin.siswas.index', compact('siswas'));
    }

    /**
     * Form tambah siswa
     */
    public function create()
    {
        return view('admin.siswas.create');
    }

    /**
     * Simpan siswa baru
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama'  => 'required|string|max:255',
            'email' => 'required|email|unique:siswas,email',
        ]);

        Siswa::create([
            'nama'   => $request->nama,
            'email'  => $request->email,
            'status' => 'pending',
        ]);

        return redirect()->route('admin.siswas.index')
                         ->with('success', 'Siswa berhasil ditambahkan');
    }

    /**
     * Form edit siswa
     */
    public function edit($id)
    {
        $siswa = Siswa::findOrFail($id);
        return view('admin.siswas.edit', compact('siswa'));
    }

    /**
     * Update data siswa
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama'  => 'required|string|max:255',
            'email' => 'required|email|unique:siswas,email,' . $id,
        ]);

        $siswa = Siswa::findOrFail($id);
        $siswa->update([
            'nama'  => $request->nama,
            'email' => $request->email,
        ]);

        return redirect()->route('admin.siswas.index')
                         ->with('success', 'Data siswa berhasil diperbarui');
    }

    /**
     * Hapus siswa
     */
    public function destroy($id)
    {
        $siswa = Siswa::findOrFail($id);
        $siswa->delete();

        return redirect()->route('admin.siswas.index')
                         ->with('success', 'Siswa berhasil dihapus');
    }

    /**
     * Update status siswa (pending -> accepted / rejected)
     */
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:pending,accepted,rejected',
        ]);

        try {
            $siswa = Siswa::findOrFail($id);
            $siswa->status = $request->status;
            $siswa->save();

            return redirect()->back()->with('success', 'Status siswa berhasil diperbarui!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal memperbarui status!');
        }
    }

    /**
     * Export data siswa ke CSV
     */
    public function export()
    {
        $siswas = Siswa::all();

        $csv = "ID,Nama,Email,Status\n";
        foreach ($siswas as $siswa) {
            $csv .= "{$siswa->id},{$siswa->nama},{$siswa->email},{$siswa->status}\n";
        }

        return response($csv)
            ->header('Content-Type', 'text/csv')
            ->header('Content-Disposition', 'attachment; filename=\"siswa.csv\"');
    }

    /**
     * Import data siswa dari CSV
     */
    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:csv,txt',
        ]);

        $file = fopen($request->file('file')->getPathname(), 'r');
        while (($data = fgetcsv($file, 1000, ',')) !== false) {
            if ($data[0] != 'ID') {
                Siswa::updateOrCreate(
                    ['email' => $data[2]],
                    [
                        'nama'   => $data[1],
                        'status' => $data[3] ?? 'pending'
                    ]
                );
            }
        }
        fclose($file);

        return back()->with('success', 'Data siswa berhasil diimport');
    }
}
