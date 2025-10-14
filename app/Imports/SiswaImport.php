<?php

namespace App\Imports;

use App\Models\Siswa;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\Importable;

class SiswaImport implements ToModel
{
    use Importable;

    public function model(array $row)
    {
        return new Siswa([
            'nik' => $row[0],
            'nama' => $row[1],
            'tgl_lahir' => $row[2],
            'jenis_kelamin' => $row[3],
            'no_hp' => $row[4],
            'email' => $row[5],
            'asal_sekolah' => $row[6],
            'kk' => $row[7],
            'akte' => $row[8] ?? null,
            'rapot' => $row[9] ?? null,
            'ijazah' => $row[10] ?? null,
            'nama_ayah' => $row[11],
            'pekerjaan_ayah' => $row[12] ?? null,
            'nama_ibu' => $row[13],
            'pekerjaan_ibu' => $row[14] ?? null,
        ]);
    }
}
