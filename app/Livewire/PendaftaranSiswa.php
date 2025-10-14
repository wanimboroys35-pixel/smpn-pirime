<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Pendaftar;

class PendaftaranSiswa extends Component
{
    public $nik, $nama, $tanggal_lahir, $jk, $no_hp, $email, $asal_sekolah;
    public $kk, $akte, $rapot, $ijazah;
    public $nama_ayah, $pekerjaan_ayah, $nama_ibu, $pekerjaan_ibu;

    public function rules()
    {
        return [
            'nik' => 'required|unique:pendaftars,nik',
            'nama' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'jk' => 'required|in:L,P',
            'no_hp' => 'required|string',
            'email' => 'required|email',
            'asal_sekolah' => 'required|string|max:255',
            'nama_ayah' => 'required|string|max:255',
            'pekerjaan_ayah' => 'required|string|max:255',
            'nama_ibu' => 'required|string|max:255',
            'pekerjaan_ibu' => 'required|string|max:255',
        ];
    }

    public function submit()
    {
        $this->validate();

        Pendaftar::create([
            'nik' => $this->nik,
            'nama' => $this->nama,
            'tanggal_lahir' => $this->tanggal_lahir,
            'jk' => $this->jk,
            'no_hp' => $this->no_hp,
            'email' => $this->email,
            'asal_sekolah' => $this->asal_sekolah,
            'kk' => $this->kk,
            'akte' => $this->akte,
            'rapot' => $this->rapot,
            'ijazah' => $this->ijazah,
            'nama_ayah' => $this->nama_ayah,
            'pekerjaan_ayah' => $this->pekerjaan_ayah,
            'nama_ibu' => $this->nama_ibu,
            'pekerjaan_ibu' => $this->pekerjaan_ibu,
        ]);

        session()->flash('success', 'Pendaftaran berhasil dikirim ke admin!');
        $this->reset();
    }

    public function render()
    {
        return view('livewire.pendaftaran-siswa');
    }
}
