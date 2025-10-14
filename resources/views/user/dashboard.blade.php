@extends('layouts.app')

@section('content')
<div class="container-fluid py-4" id="dashboard">

    {{-- ====== HEADER ====== --}}
    <div class="text-center mb-5">
        <h3 class="fw-bold text-success mb-2 animate__animated animate__fadeInDown">
            <i class="fas fa-user-circle"></i> Selamat Datang di Dashboard Siswa
        </h3>
        <p class="text-muted fs-5">
            Hai, <span class="fw-semibold text-primary">{{ auth()->user()->name }}</span> 👋  
            Anda berhasil login ke sistem PPDB Online SMP Negeri 1 Pirime.
        </p>
    </div>

    {{-- ====== AKSI BAR ====== --}}
    <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">
        <h5 class="fw-bold text-primary mb-0">
            <i class="fas fa-list-check"></i> Lengkapi data pendaftaran Anda di bawah ini.
        </h5>
        <div class="d-flex gap-2">
            <a href="{{ route('user.siswa.create') }}" class="btn btn-success shadow-sm rounded-pill px-4">
                <i class="fas fa-user-plus"></i> Tambah Data
            </a>
            <button id="toggleDarkMode" class="btn btn-outline-secondary btn-sm rounded-pill">
                <i class="fas fa-moon"></i> Mode Gelap
            </button>
        </div>
    </div>

    {{-- ====== STATISTIK ====== --}}
    <div class="row g-4 mb-5">
        <div class="col-md-4">
            <div class="card stat-card border-0 shadow-sm bg-gradient-primary text-white text-center p-3">
                <i class="fas fa-users fa-3x mb-2"></i>
                <h6>Total Siswa</h6>
                <h3>{{ $siswas->count() }}</h3>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card stat-card border-0 shadow-sm bg-gradient-info text-white text-center p-3">
                <i class="fas fa-male fa-3x mb-2"></i>
                <h6>Laki-laki</h6>
                <h3>{{ $siswas->where('jenis_kelamin','Laki-laki')->count() }}</h3>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card stat-card border-0 shadow-sm bg-gradient-danger text-white text-center p-3">
                <i class="fas fa-female fa-3x mb-2"></i>
                <h6>Perempuan</h6>
                <h3>{{ $siswas->where('jenis_kelamin','Perempuan')->count() }}</h3>
            </div>
        </div>
    </div>

    {{-- ====== GRAFIK ====== --}}
    <div class="row mb-5">
        <div class="col-md-6">
            <div class="card shadow-sm rounded-3 border-0">
                <div class="card-header bg-primary text-white fw-bold">
                    <i class="fas fa-chart-pie"></i> Grafik Jenis Kelamin
                </div>
                <div class="card-body">
                    <canvas id="genderChart" height="200"></canvas>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card shadow-sm rounded-3 border-0">
                <div class="card-header bg-success text-white fw-bold">
                    <i class="fas fa-chart-bar"></i> Grafik Tahun Angkatan
                </div>
                <div class="card-body">
                    <canvas id="angkatanChart" height="200"></canvas>
                </div>
            </div>
        </div>
    </div>

    {{-- ====== DATA SISWA ====== --}}
    <div class="card shadow-lg rounded-4 mb-5 border-0">
        <div class="card-header bg-dark text-white fw-bold">
            <i class="fas fa-table"></i> Data Pendaftaran Anda
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light text-center">
                        <tr>
                            <th>#</th>
                            <th>Nama</th>
                            <th>TTL</th>
                            <th>Jenis Kelamin</th>
                            <th>Alamat</th>
                            <th>Angkatan</th>
                            <th>Tanggal Daftar</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="text-center">
                        @forelse($siswas as $i => $siswa)
                            <tr>
                                <td>{{ $i+1 }}</td>
                                <td class="fw-semibold">{{ $siswa->nama }}</td>
                                <td>{{ $siswa->tempat_lahir }}, {{ \Carbon\Carbon::parse($siswa->tanggal_lahir)->format('d-m-Y') }}</td>
                                <td>
                                    @if($siswa->jenis_kelamin == 'Laki-laki')
                                        <span class="badge bg-info"><i class="fas fa-male"></i> Laki-laki</span>
                                    @else
                                        <span class="badge bg-danger"><i class="fas fa-female"></i> Perempuan</span>
                                    @endif
                                </td>
                                <td>{{ $siswa->alamat }}</td>
                                <td>{{ $siswa->tahun_angkatan }}</td>
                                <td>{{ $siswa->created_at->format('d-m-Y') }}</td>
                                <td>
                                    <div class="d-flex justify-content-center gap-2">
                                        <a href="{{ route('user.siswas.edit', $siswa->id) }}" class="btn btn-warning btn-sm rounded-pill">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('user.siswas.destroy', $siswa->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-danger btn-sm rounded-pill">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="py-4 text-muted">
                                    <i class="fas fa-info-circle"></i> Belum ada data siswa terdaftar.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

{{-- ====== SCRIPT GRAFIK ====== --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const genderChart = new Chart(document.getElementById('genderChart'), {
        type: 'doughnut',
        data: {
            labels: ['Laki-laki', 'Perempuan'],
            datasets: [{
                data: [
                    {{ $siswas->where('jenis_kelamin','Laki-laki')->count() }},
                    {{ $siswas->where('jenis_kelamin','Perempuan')->count() }}
                ],
                backgroundColor: ['#0d6efd', '#dc3545'],
                borderWidth: 2,
                borderColor: '#fff'
            }]
        }
    });

    const angkatanData = @json($siswas->groupBy('tahun_angkatan')->map->count());
    new Chart(document.getElementById('angkatanChart'), {
        type: 'bar',
        data: {
            labels: Object.keys(angkatanData),
            datasets: [{
                label: 'Jumlah Siswa',
                data: Object.values(angkatanData),
                backgroundColor: '#198754'
            }]
        },
        options: { scales: { y: { beginAtZero: true } } }
    });

    // ====== DARK MODE ======
    const toggle = document.getElementById('toggleDarkMode');
    const dashboard = document.getElementById('dashboard');

    if (localStorage.getItem('dark-mode') === 'enabled') {
        dashboard.classList.add('dark-mode');
        toggle.innerHTML = '<i class="fas fa-sun"></i> Mode Terang';
    }

    toggle.addEventListener('click', () => {
        dashboard.classList.toggle('dark-mode');
        if (dashboard.classList.contains('dark-mode')) {
            localStorage.setItem('dark-mode', 'enabled');
            toggle.innerHTML = '<i class="fas fa-sun"></i> Mode Terang';
        } else {
            localStorage.setItem('dark-mode', 'disabled');
            toggle.innerHTML = '<i class="fas fa-moon"></i> Mode Gelap';
        }
    });
</script>

{{-- ====== STYLE TAMBAHAN ====== --}}
<style>
    .bg-gradient-primary {
        background: linear-gradient(45deg, #007bff, #00b4d8);
    }
    .bg-gradient-info {
        background: linear-gradient(45deg, #0dcaf0, #17a2b8);
    }
    .bg-gradient-danger {
        background: linear-gradient(45deg, #dc3545, #f87171);
    }
    .stat-card {
        border-radius: 1rem;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    .stat-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 0.75rem 1.5rem rgba(0,0,0,0.15);
    }
    .dark-mode {
        background-color: #121212 !important;
        color: #f5f5f5 !important;
    }
    .dark-mode .card {
        background-color: #1e1e1e !important;
        border: 1px solid #2a2a2a;
    }
    .dark-mode .card-header {
        background-color: #333 !important;
        color: #fff !important;
    }
    .dark-mode .table {
        color: #ddd !important;
    }
    .dark-mode .table thead {
        background-color: #222 !important;
    }
</style>
@endsection
