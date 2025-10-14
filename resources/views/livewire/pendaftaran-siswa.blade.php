<div class="container py-4">
    <div class="card shadow-sm border-0">
        <div class="card-header bg-primary text-white">📝 Form Pendaftaran Siswa Baru</div>
        <div class="card-body">
            @if(session()->has('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <form wire:submit.prevent="submit" enctype="multipart/form-data">
                <div class="row g-3">
                    <!-- NIK & Nama -->
                    <div class="col-md-6">
                        <input type="text" wire:model="nik" class="form-control" placeholder="NIK">
                        @error('nik') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>
                    <div class="col-md-6">
                        <input type="text" wire:model="nama" class="form-control" placeholder="Nama Lengkap">
                        @error('nama') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>

                    <!-- Tanggal Lahir & JK -->
                    <div class="col-md-6">
                        <input type="date" wire:model="tanggal_lahir" class="form-control">
                        @error('tanggal_lahir') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>
                    <div class="col-md-6">
                        <select wire:model="jk" class="form-control">
                            <option value="">-- Pilih Jenis Kelamin --</option>
                            <option value="L">Laki-laki</option>
                            <option value="P">Perempuan</option>
                        </select>
                        @error('jk') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>

                    <!-- Kontak & Sekolah -->
                    <div class="col-md-6">
                        <input type="text" wire:model="no_hp" class="form-control" placeholder="No HP">
                        @error('no_hp') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>
                    <div class="col-md-6">
                        <input type="email" wire:model="email" class="form-control" placeholder="Email">
                        @error('email') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>
                    <div class="col-md-12">
                        <input type="text" wire:model="asal_sekolah" class="form-control" placeholder="Asal Sekolah">
                        @error('asal_sekolah') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>

                    <!-- Data Orang Tua -->
                    <div class="col-md-6">
                        <input type="text" wire:model="nama_ayah" class="form-control" placeholder="Nama Ayah">
                        @error('nama_ayah') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>
                    <div class="col-md-6">
                        <input type="text" wire:model="pekerjaan_ayah" class="form-control" placeholder="Pekerjaan Ayah">
                        @error('pekerjaan_ayah') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>
                    <div class="col-md-6">
                        <input type="text" wire:model="nama_ibu" class="form-control" placeholder="Nama Ibu">
                        @error('nama_ibu') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>
                    <div class="col-md-6">
                        <input type="text" wire:model="pekerjaan_ibu" class="form-control" placeholder="Pekerjaan Ibu">
                        @error('pekerjaan_ibu') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>

                    <!-- Dokumen Opsional -->
                    <div class="col-md-3">
                        <input type="text" wire:model="kk" class="form-control" placeholder="KK (link)">
                    </div>
                    <div class="col-md-3">
                        <input type="text" wire:model="akte" class="form-control" placeholder="Akte (link)">
                    </div>
                    <div class="col-md-3">
                        <input type="text" wire:model="rapot" class="form-control" placeholder="Rapot (link)">
                    </div>
                    <div class="col-md-3">
                        <input type="text" wire:model="ijazah" class="form-control" placeholder="Ijazah (link)">
                    </div>

                    <div class="col-12">
                        <button type="submit" class="btn btn-success w-100 mt-3">Kirim Pendaftaran</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
.card:hover { transform: translateY(-3px); transition: all 0.2s ease-in-out; }
.bg-primary { background: #0d6efd; }
</style>
