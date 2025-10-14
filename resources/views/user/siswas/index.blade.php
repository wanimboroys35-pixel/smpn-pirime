<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data Siswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/a2e0b4f3b1.js" crossorigin="anonymous"></script>
</head>
<body class="p-4">

<div class="container">
    <h2 class="mb-4"><i class="fas fa-users"></i> Data Siswa Saya</h2>

    {{-- Notifikasi sukses --}}
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    {{-- Export Excel --}}
    <a href="{{ route('user.siswas.export') }}" class="btn btn-success mb-3">
        <i class="fas fa-download"></i> Download Excel
    </a>

    {{-- Import Excel --}}
    <form action="{{ route('user.siswas.import') }}" method="POST" enctype="multipart/form-data" class="mb-3 d-flex gap-2">
        @csrf
        <input type="file" name="file" class="form-control" required>
        <button type="submit" class="btn btn-primary"><i class="fas fa-upload"></i> Import Excel</button>
    </form>

    {{-- Tabel Data Siswa --}}
    <div class="table-responsive">
        <table class="table table-bordered table-hover align-middle">
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
                    <th>Aksi</th>
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
                    <td class="d-flex gap-1">
                        {{-- Edit --}}
                        <a href="{{ route('user.siswas.edit', $siswa->id) }}" class="btn btn-warning btn-sm">
                            <i class="fas fa-edit"></i>
                        </a>

                        {{-- Hapus --}}
                        <form action="{{ route('user.siswas.destroy', $siswa->id) }}" method="POST" onsubmit="return confirm('Apakah yakin ingin menghapus data ini?');">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>

                        {{-- Preview File --}}
                        @if($siswa->foto)
                            <a href="{{ asset('storage/'.$siswa->foto) }}" target="_blank" class="btn btn-info btn-sm" title="Preview Foto">
                                <i class="fas fa-image"></i>
                            </a>
                        @endif
                        @if($siswa->kk)
                            <a href="{{ asset('storage/'.$siswa->kk) }}" target="_blank" class="btn btn-secondary btn-sm" title="Preview KK">
                                <i class="fas fa-id-card"></i>
                            </a>
                        @endif
                        @if($siswa->akte)
                            <a href="{{ asset('storage/'.$siswa->akte) }}" target="_blank" class="btn btn-dark btn-sm" title="Preview Akte">
                                <i class="fas fa-file"></i>
                            </a>
                        @endif
                        @if($siswa->raport)
                            <a href="{{ asset('storage/'.$siswa->raport) }}" target="_blank" class="btn btn-primary btn-sm" title="Preview Raport">
                                <i class="fas fa-file-alt"></i>
                            </a>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="9" class="text-center text-muted">Belum ada data siswa</td>
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

{{-- Script Bootstrap --}}
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
