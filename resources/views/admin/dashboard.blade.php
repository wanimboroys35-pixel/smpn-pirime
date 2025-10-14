@extends('layouts.app')

@section('content')
<div class="container-fluid py-4 px-3 px-md-5 bg-light min-vh-100">

    {{-- Judul Dashboard --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold text-primary mb-0">
            <i class="fas fa-tachometer-alt me-2"></i> Dashboard Admin 
        </h2>
        <span class="text-muted small">
            <i class="far fa-calendar-alt"></i> {{ now()->format('d M Y') }}
        </span>
    </div>

    {{-- Statistik --}}
    <div class="row g-4 mb-4">
        <div class="col-6 col-md-3">
            <div class="card border-0 shadow-lg rounded-4 stat-card bg-gradient-primary text-white">
                <div class="card-body text-center py-4">
                    <i class="fas fa-users fa-2x mb-2"></i>
                    <h6>Total Siswa</h6>
                    <h3 class="fw-bold">{{ $totalSiswa }}</h3>
                </div>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="card border-0 shadow-lg rounded-4 stat-card bg-gradient-warning text-dark">
                <div class="card-body text-center py-4">
                    <i class="fas fa-hourglass-half fa-2x mb-2"></i>
                    <h6>Pending</h6>
                    <h3 class="fw-bold">{{ $totalPending }}</h3>
                </div>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="card border-0 shadow-lg rounded-4 stat-card bg-gradient-success text-white">
                <div class="card-body text-center py-4">
                    <i class="fas fa-check-circle fa-2x mb-2"></i>
                    <h6>Diterima</h6>
                    <h3 class="fw-bold">{{ $totalDiterima }}</h3>
                </div>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="card border-0 shadow-lg rounded-4 stat-card bg-gradient-danger text-white">
                <div class="card-body text-center py-4">
                    <i class="fas fa-times-circle fa-2x mb-2"></i>
                    <h6>Ditolak</h6>
                    <h3 class="fw-bold">{{ $totalDitolak }}</h3>
                </div>
            </div>
        </div>
    </div>

    {{-- Filter & Search --}}
    <div class="card shadow-lg border-0 mb-4 rounded-4">
        <div class="card-body">
            <form method="GET" class="row g-2 align-items-center">
                <div class="col-md-5">
                    <div class="input-group">
                        <span class="input-group-text bg-primary text-white"><i class="fas fa-search"></i></span>
                        <input type="text" name="search" value="{{ request('search') }}" class="form-control"
                            placeholder="Cari nama siswa...">
                    </div>
                </div>
                <div class="col-md-4">
                    <select name="status" class="form-select">
                        <option value="">-- Semua Status --</option>
                        <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="accepted" {{ request('status') == 'accepted' ? 'selected' : '' }}>Diterima</option>
                        <option value="rejected" {{ request('status') == 'rejected' ? 'selected' : '' }}>Ditolak</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <button type="submit" class="btn btn-primary w-100">
                        <i class="fas fa-filter"></i> Terapkan Filter
                    </button>
                </div>
            </form>
        </div>
    </div>

    {{-- Tabel Data Siswa --}}
    <div class="card shadow-lg border-0 rounded-4">
        <div class="card-body">
            <h5 class="fw-bold mb-3 text-primary">
                <i class="fas fa-list me-2"></i> Data Siswa Lengkap
            </h5>

            <div class="table-responsive">
                <table class="table table-hover align-middle table-borderless">
                    <thead class="table-primary text-center">
                        <tr>
                            <th>#</th>
                            <th>Foto</th>
                            <th>Nama Lengkap</th>
                            <th>Email</th>
                            <th>Orang Tua / Wali</th>
                            <th>Dokumen</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($siswas as $siswa)
                        <tr class="align-middle">
                            <td class="text-center">{{ $loop->iteration }}</td>
                            <td class="text-center">
                                @if($siswa->foto)
                                    <img src="{{ asset('storage/'.$siswa->foto) }}" class="rounded-circle shadow-sm" width="45" height="45">
                                @else
                                    <i class="fas fa-user-circle fa-2x text-muted"></i>
                                @endif
                            </td>
                            <td>{{ $siswa->nama }}</td>
                            <td>{{ $siswa->email }}</td>
                            <td>
                                <small>
                                    <b>Ayah:</b> {{ $siswa->nama_ayah ?? '-' }} <br>
                                    <b>Ibu:</b> {{ $siswa->nama_ibu ?? '-' }} <br>
                                    <b>Wali:</b> {{ $siswa->wali ?? '-' }}
                                </small>
                            </td>
                            <td>
                                @if($siswa->kk)
                                    <a href="{{ asset('storage/'.$siswa->kk) }}" target="_blank" class="badge bg-info text-dark">KK</a>
                                @endif
                                @if($siswa->akte)
                                    <a href="{{ asset('storage/'.$siswa->akte) }}" target="_blank" class="badge bg-success">Akte</a>
                                @endif
                                @if($siswa->raport)
                                    <a href="{{ asset('storage/'.$siswa->raport) }}" target="_blank" class="badge bg-warning text-dark">Raport</a>
                                @endif
                            </td>
                            <td class="text-center">
                                @if($siswa->status == 'pending')
                                    <span class="badge bg-warning text-dark">Pending</span>
                                @elseif($siswa->status == 'accepted')
                                    <span class="badge bg-success">Diterima</span>
                                @else
                                    <span class="badge bg-danger">Ditolak</span>
                                @endif
                            </td>
                            <td class="text-center">
                                <div class="btn-group mb-1">
                                    <a href="{{ route('admin.siswa.show', $siswa->id) }}" class="btn btn-sm btn-info"><i class="fas fa-eye"></i></a>
                                    <a href="{{ route('admin.siswa.edit', $siswa->id) }}" class="btn btn-sm btn-warning"><i class="fas fa-edit"></i></a>
                                    <form action="{{ route('admin.siswa.destroy', $siswa->id) }}" method="POST" class="d-inline">
                                        @csrf @method('DELETE')
                                        <button class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>
                                    </form>
                                </div>
                                <div class="btn-group">
                                    <form action="{{ route('admin.siswa.updateStatus', $siswa->id) }}" method="POST" class="d-inline">
                                        @csrf @method('PATCH')
                                        <input type="hidden" name="status" value="accepted">
                                        <button class="btn btn-sm btn-success" title="Terima"><i class="fas fa-check"></i></button>
                                    </form>
                                    <form action="{{ route('admin.siswa.updateStatus', $siswa->id) }}" method="POST" class="d-inline">
                                        @csrf @method('PATCH')
                                        <input type="hidden" name="status" value="rejected">
                                        <button class="btn btn-sm btn-danger" title="Tolak"><i class="fas fa-times"></i></button>
                                    </form>
                                    <form action="{{ route('admin.siswa.updateStatus', $siswa->id) }}" method="POST" class="d-inline">
                                        @csrf @method('PATCH')
                                        <input type="hidden" name="status" value="pending">
                                        <button class="btn btn-sm btn-secondary" title="Pending"><i class="fas fa-undo"></i></button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8" class="text-center text-muted py-4">
                                <i class="fas fa-exclamation-circle"></i> Belum ada data siswa.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Pagination --}}
            <div class="mt-3 d-flex justify-content-center">
                {{ $siswas->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>
</div>

{{-- Styling tambahan --}}
<style>
    .bg-gradient-primary { background: linear-gradient(45deg, #007bff, #00c6ff); }
    .bg-gradient-success { background: linear-gradient(45deg, #28a745, #4cd964); }
    .bg-gradient-warning { background: linear-gradient(45deg, #ffc107, #ffdf7e); }
    .bg-gradient-danger { background: linear-gradient(45deg, #dc3545, #ff6b81); }
    .stat-card:hover {
        transform: translateY(-4px);
        transition: 0.3s ease;
    }
    .table-hover tbody tr:hover {
        background-color: #f1f9ff !important;
        transition: 0.2s ease;
    }
</style>
@endsection
