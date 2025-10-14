@extends('layouts.app')

@section('title', 'Dashboard User')

@section('content')
<div class="container py-4">
    <h1 class="mb-4">📊 Dashboard User </h1>

    <!-- Alert Sukses -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="bi bi-check-circle-fill me-2"></i>
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- Tombol Daftar Siswa Baru -->
    <div class="mb-4 text-end">
        <a href="{{ route('siswas.create') }}" class="btn btn-success btn-lg">
            <i class="bi bi-person-plus-fill me-2"></i> Daftar Siswa Baru
        </a>
    </div>

    <!-- Kartu Statistik -->
    <div class="row g-4 mb-4">
        <!-- Jumlah Siswa -->
        <div class="col-md-6">
            <div class="card shadow-sm border-0 text-white bg-gradient-primary">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <h5 class="mb-1">Jumlah Siswa</h5>
                        <h2>{{ \App\Models\Siswa::count() }}</h2>
                    </div>
                    <i class="bi bi-people-fill fs-1"></i>
                </div>
            </div>
        </div>

        <!-- Jumlah Pendaftar -->
        <div class="col-md-6">
            <div class="card shadow-sm border-0 text-white bg-gradient-warning">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <h5 class="mb-1">Jumlah Pendaftar</h5>
                        <h2>{{ \App\Models\Pendaftar::count() }}</h2>
                    </div>
                    <i class="bi bi-journal-check fs-1"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Tabel Data Siswa -->
    <div class="card mb-4 shadow-sm rounded-4 border-0">
        <div class="card-header bg-gradient-primary text-white d-flex justify-content-between align-items-center">
            <h5 class="mb-0"><i class="bi bi-people-fill me-2"></i>Data Siswa</h5>
            <span class="badge bg-light text-primary">{{ \App\Models\Siswa::count() }} Siswa</span>
        </div>
        <div class="card-body table-responsive">
            <table class="table table-striped table-bordered align-middle mb-0">
                <thead class="table-dark">
                    <tr>
                        <th>No</th>
                        <th>NIK</th>
                        <th>Nama</th>
                        <th>JK</th>
                        <th>Tanggal Lahir</th>
                        <th>No HP</th>
                        <th>Email</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach(\App\Models\Siswa::all() as $index => $siswa)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $siswa->nik }}</td>
                            <td>{{ $siswa->nama }}</td>
                            <td>{{ $siswa->jk }}</td>
                            <td>{{ \Carbon\Carbon::parse($siswa->tanggal_lahir)->format('d-m-Y') }}</td>
                            <td>{{ $siswa->no_hp }}</td>
                            <td>{{ $siswa->email }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Custom Styles -->
<style>
.bg-gradient-primary { background: linear-gradient(90deg, #0d6efd, #6610f2); }
.bg-gradient-warning { background: linear-gradient(90deg, #ffc107, #ff922b); }
.card:hover { transform: translateY(-3px); transition: all 0.2s ease-in-out; }
.table th, .table td { vertical-align: middle; }
</style>
@endsection
