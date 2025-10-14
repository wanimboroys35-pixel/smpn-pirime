<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\Siswa;

class DaftarSiswa extends Component
{
    public $siswa_id, $nik, $nama, $tanggal_lahir, $jk, $no_hp, $email, $asal_sekolah;

    public $siswas;

    protected $rules = [
        'nik' => 'required|unique:siswas,nik',
        'nama' => 'required|string',
        'tanggal_lahir' => 'required|date',
        'jk' => 'required|in:L,P',
        'no_hp' => 'required',
        'email' => 'required|email',
        'asal_sekolah' => 'required|string',
    ];

    public function mount()
    {
        $this->loadSiswas();
    }

    public function loadSiswas()
    {
        $this->siswas = Siswa::all();
    }

    public function store()
    {
        $validatedData = $this->validate();

        if ($this->siswa_id) {
            $siswa = Siswa::find($this->siswa_id);
            $siswa->update($validatedData);
            session()->flash('success', 'Data siswa berhasil diupdate.');
        } else {
            Siswa::create($validatedData);
            session()->flash('success', 'Data siswa berhasil ditambahkan.');
        }

        $this->resetInput();
        $this->loadSiswas();
    }

    public function edit($id)
    {
        $siswa = Siswa::findOrFail($id);
        $this->siswa_id = $siswa->id;
        $this->nik = $siswa->nik;
        $this->nama = $siswa->nama;
        $this->tanggal_lahir = $siswa->tanggal_lahir;
        $this->jk = $siswa->jk;
        $this->no_hp = $siswa->no_hp;
        $this->email = $siswa->email;
        $this->asal_sekolah = $siswa->asal_sekolah;
    }

    public function delete($id)
    {
        Siswa::findOrFail($id)->delete();
        session()->flash('success', 'Data siswa berhasil dihapus.');
        $this->loadSiswas();
    }

    public function resetInput()
    {
        $this->siswa_id = null;
        $this->nik = '';
        $this->nama = '';
        $this->tanggal_lahir = '';
        $this->jk = '';
        $this->no_hp = '';
        $this->email = '';
        $this->asal_sekolah = '';
    }

    public function render()
    {
        return view('livewire.admin.daftar-siswa');
    }
}
