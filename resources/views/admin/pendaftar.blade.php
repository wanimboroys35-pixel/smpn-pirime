@extends('layouts.app')

@section('title', 'Formulir Pendaftaran Siswa')

@section('content')
<div class="container py-4">

    {{-- Judul --}}
    <h1 class="fw-bold text-primary mb-4">
        <i class="bi bi-person-plus-fill me-2"></i> Formulir Pendaftaran Siswa
    </h1>

    {{-- Notifikasi error --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Formulir --}}
    <form action="{{ route('user.siswas.store') }}" method="POST" enctype="multipart/form-data">
        
        @csrf

        {{-- Data Siswa --}}
        <h5 class="text-primary fw-bold mb-3">Data Siswa</h5>

        <div class="row mb-3">
            <div class="col-md-6">
                <label for="nama" class="form-label">Nama Lengkap</label>
                <input type="text" class="form-control" id="nama" name="nama" value="{{ old('nama') }}" required>
            </div>
            <div class="col-md-6">
                <label for="foto" class="form-label">Foto Profil</label>
                <input type="file" class="form-control" id="foto" name="foto" accept="image/*">
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-4">
                <label for="tempat_lahir" class="form-label">Tempat Lahir</label>
                <input type="text" class="form-control" id="tempat_lahir" name="tempat_lahir" value="{{ old('tempat_lahir') }}" required>
            </div>
            <div class="col-md-4">
                <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
                <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir" value="{{ old('tanggal_lahir') }}" required>
            </div>
            <div class="col-md-4">
                <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                <select class="form-select" id="jenis_kelamin" name="jenis_kelamin" required>
                    <option value="">-- Pilih --</option>
                    <option value="Laki-laki" {{ old('jenis_kelamin')=='Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                    <option value="Perempuan" {{ old('jenis_kelamin')=='Perempuan' ? 'selected' : '' }}>Perempuan</option>
                </select>
            </div>
        </div>

        <div class="mb-3">
            <label for="alamat" class="form-label">Alamat Lengkap</label>
            <textarea class="form-control" id="alamat" name="alamat" rows="3" required>{{ old('alamat') }}</textarea>
        </div>

        <div class="mb-3">
            <label for="asal_sekolah" class="form-label">Asal Sekolah</label>
            <input type="text" class="form-control" id="asal_sekolah" name="asal_sekolah" value="{{ old('asal_sekolah') }}">
        </div>

        <div class="row mb-3">
            <div class="col-md-6">
                <label for="tahun_angkatan" class="form-label">Tahun Angkatan</label>
                <input type="number" class="form-control" id="tahun_angkatan" name="tahun_angkatan" value="{{ old('tahun_angkatan') }}">
            </div>
            <div class="col-md-6">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" required>
            </div>
        </div>

        {{-- Data Orang Tua / Wali --}}
        <h5 class="text-primary fw-bold mb-3 mt-4">Data Orang Tua / Wali</h5>

        <div class="row mb-3">
            <div class="col-md-6">
                <label for="nama_ayah" class="form-label">Nama Ayah</label>
                <input type="text" class="form-control" id="nama_ayah" name="nama_ayah" value="{{ old('nama_ayah') }}">
            </div>
            <div class="col-md-6">
                <label for="pekerjaan_ayah" class="form-label">Pekerjaan Ayah</label>
                <input type="text" class="form-control" id="pekerjaan_ayah" name="pekerjaan_ayah" value="{{ old('pekerjaan_ayah') }}">
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-6">
                <label for="nama_ibu" class="form-label">Nama Ibu</label>
                <input type="text" class="form-control" id="nama_ibu" name="nama_ibu" value="{{ old('nama_ibu') }}">
            </div>
            <div class="col-md-6">
                <label for="pekerjaan_ibu" class="form-label">Pekerjaan Ibu</label>
                <input type="text" class="form-control" id="pekerjaan_ibu" name="pekerjaan_ibu" value="{{ old('pekerjaan_ibu') }}">
            </div>
        </div>

        <div class="mb-3">
            <label for="wali" class="form-label">Nama Wali (Jika Ada)</label>
            <input type="text" class="form-control" id="wali" name="wali" value="{{ old('wali') }}">
        </div>

        {{-- Upload Dokumen --}}
        <h5 class="text-primary fw-bold mb-3 mt-4">Upload Dokumen</h5>

        <div class="row mb-3">
            <div class="col-md-4">
                <label for="kk" class="form-label">Kartu Keluarga (KK)</label>
                <input type="file" class="form-control" id="kk" name="kk" accept=".pdf,.jpg,.jpeg,.png">
            </div>
            <div class="col-md-4">
                <label for="akte" class="form-label">Akte Kelahiran</label>
                <input type="file" class="form-control" id="akte" name="akte" accept=".pdf,.jpg,.jpeg,.png">
            </div>
            <div class="col-md-4">
                <label for="raport" class="form-label">Raport (Nilai Rata-rata)</label>
                <input type="file" class="form-control" id="raport" name="raport" accept=".pdf,.jpg,.jpeg,.png">
            </div>
        </div>

        {{-- Submit --}}
        <div class="d-flex gap-2 mt-4">
            <button type="submit" class="btn btn-success">
                <i class="bi bi-save me-2"></i> Simpan Data
            </button>
            <a href="{{ route('user.dashboard') }}" class="btn btn-secondary">
                <i class="bi bi-arrow-left me-2"></i> Kembali
            </a>
        </div>
    </form>
</div>
@endsection
