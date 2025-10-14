@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h1><i class="fas fa-plus"></i> Tambah Siswa</h1>

    <form action="{{ route('siswas.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="nama" class="form-label">Nama</label>
            <input type="text" name="nama" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" name="email" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="status" class="form-label">Status</label>
            <select name="status" class="form-control">
                <option value="pending">Pending</option>
                <option value="accepted">Diterima</option>
                <option value="rejected">Ditolak</option>
            </select>
        </div>
        <button class="btn btn-success"><i class="fas fa-save"></i> Simpan</button>
        <a href="{{ route('siswas.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection
