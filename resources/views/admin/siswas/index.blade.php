@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h1><i class="fas fa-users"></i> Data Siswa</h1>

    {{-- Alert sukses dinamis --}}
    <div id="alert-success" class="alert alert-success alert-dismissible fade d-none mt-3" role="alert">
        <i class="fas fa-check-circle"></i> <span id="alert-message"></span>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>

    <table class="table table-bordered mt-3">
        <thead class="table-primary">
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($siswas as $index => $siswa)
            <tr id="siswa-{{ $siswa->id }}">
                <td>{{ $index + 1 }}</td>
                <td>{{ $siswa->nama }}</td>
                <td>
                    <span class="badge 
                        @if($siswa->status == 'diterima') bg-success
                        @elseif($siswa->status == 'ditolak') bg-danger
                        @else bg-warning text-dark @endif">
                        {{ ucfirst($siswa->status) }}
                    </span>
                </td>
                <td>
                    <button class="btn btn-success btn-sm" onclick="updateStatus({{ $siswa->id }}, 'diterima')">
                        <i class="fas fa-check"></i> Terima
                    </button>
                    <button class="btn btn-danger btn-sm" onclick="updateStatus({{ $siswa->id }}, 'ditolak')">
                        <i class="fas fa-times"></i> Tolak
                    </button>
                    <button class="btn btn-secondary btn-sm" onclick="updateStatus({{ $siswa->id }}, 'pending')">
                        <i class="fas fa-clock"></i> Pending
                    </button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<script>
async function updateStatus(siswaId, newStatus) {
    try {
        const response = await fetch(`/admin/siswa/${siswaId}/update-status`, {
            method: "PATCH",
            headers: {
                "X-CSRF-TOKEN": "{{ csrf_token() }}",
                "Accept": "application/json",
                "Content-Type": "application/json",
            },
            body: JSON.stringify({ status: newStatus }),
        });

        if (!response.ok) throw new Error('Gagal memperbarui status');

        // ubah badge status langsung di tabel
        const badge = document.querySelector(`#siswa-${siswaId} td span`);
        badge.textContent = newStatus.charAt(0).toUpperCase() + newStatus.slice(1);
        badge.className = `badge ${
            newStatus === "diterima" ? "bg-success" :
            newStatus === "ditolak" ? "bg-danger" : "bg-warning text-dark"
        }`;

        // tampilkan alert sukses
        const alertBox = document.getElementById("alert-success");
        const alertMessage = document.getElementById("alert-message");
        alertMessage.textContent = `Status siswa berhasil diubah menjadi "${newStatus}".`;
        alertBox.classList.remove("d-none");
        alertBox.classList.add("show");

        // otomatis hilang setelah 3 detik
        setTimeout(() => {
            alertBox.classList.remove("show");
            alertBox.classList.add("d-none");
        }, 3000);

    } catch (error) {
        alert("❌ Gagal memperbarui status!");
        console.error(error);
    }
}
</script>
@endsection
