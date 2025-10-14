@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h1 class="mb-4"><i class="fas fa-users"></i> Dashboard Siswa </h1>

    {{-- Statistik --}}
    <div class="row mb-4">
        <div class="col-md-3">
            <div class="card shadow-sm text-center p-3 bg-primary text-white rounded-3">
                <h5><i class="fas fa-users"></i> Total Siswa</h5>
                <h3>{{ $totalSiswa ?? 0 }}</h3>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card shadow-sm text-center p-3 bg-warning text-dark rounded-3">
                <h5><i class="fas fa-hourglass-half"></i> Pending</h5>
                <h3>{{ $totalPending ?? 0 }}</h3>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card shadow-sm text-center p-3 bg-success text-white rounded-3">
                <h5><i class="fas fa-check-circle"></i> Diterima</h5>
                <h3>{{ $totalDiterima ?? 0 }}</h3>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card shadow-sm text-center p-3 bg-danger text-white rounded-3">
                <h5><i class="fas fa-times-circle"></i> Ditolak</h5>
                <h3>{{ $totalDitolak ?? 0 }}</h3>
            </div>
        </div>
    </div>

    {{-- Filter & Search --}}
    <form method="GET" class="row mb-3">
        <div class="col-md-4 mb-2">
            <input type="text" name="search" value="{{ request('search') }}" class="form-control"
                   placeholder="🔍 Cari nama siswa...">
        </div>

        <div class="col-md-3 mb-2">
            <select name="status" class="form-select">
                <option value="">-- Filter Status --</option>
                <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>⏳ Pending</option>
                <option value="accepted" {{ request('status') == 'accepted' ? 'selected' : '' }}>✅ Diterima</option>
                <option value="rejected" {{ request('status') == 'rejected' ? 'selected' : '' }}>❌ Ditolak</option>
            </select>
        </div>

        <div class="col-md-2 mb-2">
            <button type="submit" class="btn btn-dark w-100"><i class="fas fa-filter"></i> Filter</button>
        </div>
    </form>

    {{-- Tabel siswa --}}
    <div class="card shadow-sm border-0">
        <div class="card-body">
            <table class="table table-bordered table-striped align-middle">
                <thead class="table-dark">
                    <tr>
                        <th><i class="fas fa-id-card"></i> ID</th>
                        <th><i class="fas fa-user"></i> Nama</th>
                        <th><i class="fas fa-envelope"></i> Email</th>
                        <th><i class="fas fa-info-circle"></i> Status</th>
                        <th width="250"><i class="fas fa-cogs"></i> Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($siswas as $siswa)
                        <tr>
                            <td>{{ $siswa->id }}</td>
                            <td>{{ $siswa->nama }}</td>
                            <td>{{ $siswa->email }}</td>
                            <td>
                                @if($siswa->status == 'pending')
                                    <span class="badge bg-warning text-dark">
                                        <i class="fas fa-hourglass-half"></i> Pending
                                    </span>
                                @elseif($siswa->status == 'accepted')
                                    <span class="badge bg-success">
                                        <i class="fas fa-check-circle"></i> Diterima
                                    </span>
                                @else
                                    <span class="badge bg-danger">
                                        <i class="fas fa-times-circle"></i> Ditolak
                                    </span>
                                @endif
                            </td>

                            <td>
                                <div class="btn-group" role="group">
                                  
                                    <form action="{{ route('admin.siswa.updateStatus', $siswa->id) }}" method="POST">

                                        @csrf @method('PATCH')
                                        <input type="hidden" name="status" value="accepted">
                                        <button class="btn btn-success btn-sm"><i class="fas fa-check"></i></button>
                                    </form>
                                    <form action="{{ route('admin.siswa.updateStatus', $siswa->id) }}" method="POST" class="d-inline">
                                        @csrf @method('PATCH')
                                        <input type="hidden" name="status" value="rejected">
                                        <button class="btn btn-danger btn-sm"><i class="fas fa-times"></i></button>
                                    </form>
                                    <form action="{{ route('admin.siswa.updateStatus', $siswa->id) }}" method="POST" class="d-inline">
                                        @csrf @method('PATCH')
                                        <input type="hidden" name="status" value="pending">
                                        <button class="btn btn-warning btn-sm text-dark"><i class="fas fa-undo"></i></button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center">Belum ada data siswa</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            {{-- Pagination Bootstrap 5 --}}
            <div class="mt-3 d-flex justify-content-center">
                {{ $siswas->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>
</div>
@endsection
