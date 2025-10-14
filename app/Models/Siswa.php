<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    protected $fillable = [
 
    'nama',
    'tempat_lahir',
    'tanggal_lahir',
    'jenis_kelamin',
    'alamat',
    'asal_sekolah',
    'tahun_angkatan',
    'user_id',
    'email' // ← tambahkan ini

    
];





    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
