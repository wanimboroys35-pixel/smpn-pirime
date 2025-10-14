@extends('layouts.app')

@section('title', 'Formulir Pendaftaran')

@section('content')
<h2 class="mb-3">Formulir Pendaftaran Siswa</h2>
<form method="POST" action="{{ route('siswas.store') }}">
    @csrf
    <div class="mb-3">
        <label>Nama</label>
        <input type="text" name="nama" class="form-control" required>
    </div>
    <div class="mb-3">
        <label>Email</label>
        <input type="email" name="email" class="form-control" required>
    </div>

    <a href="{{ route('siswas.create') }}" class="btn btn-primary">Tambah Data</a>
    <button type="submit" class="btn btn-success">Daftar</button>
    <a href="{{ route('user.dashboard') }}" class="btn btn-secondary">Kembali</a>
</form>
@endsection
