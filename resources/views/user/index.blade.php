<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Siswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" />
    <script src="https://kit.fontawesome.com/a2e0b4f3b1.js" crossorigin="anonymous"></script>
</head>
<body class="p-4">

<div class="container">
    <h2 class="mb-4"><i class="fas fa-users"></i> Data Siswa Anda</h2>

    {{-- Notifikasi sukses --}}
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="mb-3 d-flex gap-2 align-items-center">
        <!-- Export Excel -->
        <a href="{{ route('user.siswas.export') }}" class="btn btn-success">
            <i class="fas fa-file-excel"></i> Download Excel
        </a>

        <!-- Import Excel -->
        <form action="{{ route('user.siswas.import') }}" method="POST" enctype="multipart/form-data" class="d-inline-flex gap-2 align-items-center">
            @csrf
            <input type="file" name="file" class="form-control" style="width:auto" required>
            <button type="submit" class="btn btn-primary"><i class="fas fa-upload"></i> Import Excel</button>
        </form>

        <!-- Cetak PDF -->
        <a href="{{ route('user.siswas.cetak') }}" target="_blank" class="btn btn-warning text-white">
            <i class="fas fa-print"></i> Cetak PDF
        </a>
    </div>

    <!-- Tabel Data Siswa -->
    <div class="table-responsive">
        <table class="table table-bordered table-striped align-middle">
            <thead class="table-primary">
                <tr>
                    <th>NIK</th>
                    <th>Nama</th>
                    <th>Tempat Lahir</th>
                    <th>Tanggal Lahir</th>
                    <th>Jenis Kelamin</th>
                    <th>No HP</th>
                    <th>Email</th>
                    <th>Asal Sekolah</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse($siswas as $siswa)
                <tr>
                    <td>{{ $siswa->nik ?? '-' }}</td>
                    <td>{{ $siswa->nama }}</td>
                    <td>{{ $siswa->tempat_lahir ?? '-' }}</td>
                    <td>{{ $siswa->tanggal_lahir ?? '-' }}</td>
                    <td>{{ $siswa->jenis_kelamin ?? '-' }}</td>
                    <td>{{ $siswa->no_hp ?? '-' }}</td>
                    <td>{{ $siswa->email ?? '-' }}</td>
                    <td>{{ $siswa->asal_sekolah ?? '-' }}</td>
                    <td>
                        @if($siswa->status == 'pending')
                            <span class="badge bg-warning">Pending</span>
                        @elseif($siswa->status == 'accepted')
                            <span class="badge bg-success">Diterima</span>
                        @elseif($siswa->status == 'rejected')
                            <span class="badge bg-danger">Ditolak</span>
                        @else
                            <span class="badge bg-secondary">-</span>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="9" class="text-center text-muted">Belum ada data siswa.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="mt-3 d-flex justify-content-center">
        {{ $siswas->links('pagination::bootstrap-5') }}
    </div>
</div>

<!-- JS -->
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

</body>
</html>
