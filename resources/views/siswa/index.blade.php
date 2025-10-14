@extends('layouts.app')

@section('content')
<div class="container py-5">
    <h2 class="mb-4">Daftar Siswa Terdaftar</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="table-responsive">
        <table class="table table-bordered table-striped align-middle">
            <thead class="table-dark">
                <tr>
                    <th>No</th>
                    <th>NIK</th>
                    <th>Nama</th>
                    <th>Tgl Lahir</th>
                    <th>JK</th>
                    <th>No HP</th>
                    <th>Email</th>
                    <th>Asal Sekolah</th>
                    <th>Nama Ayah</th>
                    <th>Nama Ibu</th>
                    <th>Berkas</th>
                </tr>
            </thead>
            <tbody>
                @foreach($siswas as $index => $siswa)
                <tr>
                    <td>{{ $index+1 }}</td>
                    <td>{{ $siswa->nik }}</td>
                    <td>{{ $siswa->nama }}</td>
                    <td>{{ $siswa->tanggal_lahir }}</td>
                    <td>{{ $siswa->jk }}</td>
                    <td>{{ $siswa->no_hp }}</td>
                    <td>{{ $siswa->email }}</td>
                    <td>{{ $siswa->asal_sekolah }}</td>
                    <td>{{ $siswa->nama_ayah }}</td>
                    <td>{{ $siswa->nama_ibu }}</td>
                    <td>
                        @if($siswa->kk)
                            <a href="{{ asset('uploads/siswa/'.$siswa->kk) }}" target="_blank" class="btn btn-sm btn-primary">KK</a>
                        @endif
                        @if($siswa->akte)
                            <a href="{{ asset('uploads/siswa/'.$siswa->akte) }}" target="_blank" class="btn btn-sm btn-secondary">Akte</a>
                        @endif
                        @if($siswa->rapot)
                            <a href="{{ asset('uploads/siswa/'.$siswa->rapot) }}" target="_blank" class="btn btn-sm btn-success">Rapot</a>
                        @endif
                        @if($siswa->ijazah)
                            <a href="{{ asset('uploads/siswa/'.$siswa->ijazah) }}" target="_blank" class="btn btn-sm btn-danger">Ijazah</a>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
