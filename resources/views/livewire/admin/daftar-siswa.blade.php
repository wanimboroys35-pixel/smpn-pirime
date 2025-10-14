<div class="container py-4">
    <h2 class="mb-3">📋 Daftar Siswa</h2>

    @if (session()->has('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <!-- Form Input -->
    <div class="card mb-4">
        <div class="card-body">
            <form wire:submit.prevent="store">
                <div class="row g-2">
                    <div class="col-md-3">
                        <input type="text" wire:model="nik" class="form-control" placeholder="NIK">
                        @error('nik') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>
                    <div class="col-md-3">
                        <input type="text" wire:model="nama" class="form-control" placeholder="Nama">
                        @error('nama') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>
                    <div class="col-md-3">
                        <input type="date" wire:model="tanggal_lahir" class="form-control">
                        @error('tanggal_lahir') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>
                    <div class="col-md-3">
                        <select wire:model="jk" class="form-control">
                            <option value="">-- Pilih JK --</option>
                            <option value="L">Laki-laki</option>
                            <option value="P">Perempuan</option>
                        </select>
                        @error('jk') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>
                </div>

                <div class="row g-2 mt-2">
                    <div class="col-md-3">
                        <input type="text" wire:model="no_hp" class="form-control" placeholder="No HP">
                        @error('no_hp') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>
                    <div class="col-md-3">
                        <input type="email" wire:model="email" class="form-control" placeholder="Email">
                        @error('email') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>
                    <div class="col-md-4">
                        <input type="text" wire:model="asal_sekolah" class="form-control" placeholder="Asal Sekolah">
                        @error('asal_sekolah') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>
                    <div class="col-md-2">
                        <button type="submit" class="btn btn-success w-100">
                            {{ $siswa_id ? 'Update' : 'Tambah' }}
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Tabel Data -->
    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead class="table-dark">
                <tr>
                    <th>No</th>
                    <th>NIK</th>
                    <th>Nama</th>
                    <th>Tanggal Lahir</th>
                    <th>JK</th>
                    <th>No HP</th>
                    <th>Email</th>
                    <th>Asal Sekolah</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($siswas as $index => $siswa)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $siswa->nik }}</td>
                        <td>{{ $siswa->nama }}</td>
                        <td>{{ $siswa->tanggal_lahir }}</td>
                        <td>{{ $siswa->jk }}</td>
                        <td>{{ $siswa->no_hp }}</td>
                        <td>{{ $siswa->email }}</td>
                        <td>{{ $siswa->asal_sekolah }}</td>
                        <td>
                            <button class="btn btn-warning btn-sm" wire:click="edit({{ $siswa->id }})">Edit</button>
                            <button class="btn btn-danger btn-sm" wire:click="delete({{ $siswa->id }})"
                                onclick="return confirm('Yakin hapus data ini?')">Hapus</button>
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
</div>
