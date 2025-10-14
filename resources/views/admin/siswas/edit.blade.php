@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h1><i class="fas fa-edit"></i> Edit Siswa</h1>

    <form action="{{ route('siswas.update', $siswa->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="nama" class="form-label">Nama</label>
            <input type="text" name="nama" class="form-control" value="{{ $siswa->nama }}" required>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" name="email" class="form-control" value="{{ $siswa->email }}" required>
        </div>
        <div class="mb-3">
            <label for="status" class="form-label">Status</label>
            <select name="status" class="form-control">
                <option value="pending" {{ $siswa->status == 'pending' ? 'selected' : '' }}>Pending</option>
                <option value="accepted" {{ $siswa->status == 'accepted' ? 'selected' : '' }}>Diterima</option>
                <option value="rejected" {{ $siswa->status == 'rejected' ? 'selected' : '' }}>Ditolak</option>
            </select>
        </div>
        <button class="btn btn-warning"><i class="fas fa-save"></i> Update</button>
        <a href="{{ route('siswas.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection
