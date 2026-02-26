<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Status Pendaftaran - TK Al-Istiqomah</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 min-h-screen">

    <!-- Header -->
    <header class="bg-green-700 text-white py-4 px-6 shadow">
        <div class="max-w-3xl mx-auto flex items-center justify-between">
            <h1 class="text-xl font-bold">TK Al-Istiqomah</h1>
            <a href="{{ url('/') }}" class="text-green-200 hover:text-white text-sm">← Kembali ke Beranda</a>
        </div>
    </header>

    <div class="max-w-3xl mx-auto py-8 px-4">

        @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            {{ session('success') }}
        </div>
        @endif

        <div class="bg-white rounded-lg shadow p-6">
            <h2 class="text-2xl font-bold text-gray-800 mb-1">Status Pendaftaran</h2>
            <p class="text-gray-500 text-sm mb-6">Berikut adalah detail dan status pendaftaran Anda.</p>

            <!-- Nomor & Status -->
            <div class="flex items-center justify-between bg-gray-50 border rounded p-4 mb-6">
                <div>
                    <p class="text-xs text-gray-500 uppercase tracking-wide">Nomor Pendaftaran</p>
                    <p class="text-xl font-bold text-gray-800">{{ $pendaftaran->nomor_pendaftaran }}</p>
                </div>
                <div>
                    @if($pendaftaran->status == 'Pending')
                        <span class="px-4 py-2 bg-yellow-100 text-yellow-800 rounded-full font-semibold text-sm">Menunggu Review</span>
                    @elseif($pendaftaran->status == 'Disetujui')
                        <span class="px-4 py-2 bg-green-100 text-green-800 rounded-full font-semibold text-sm">Diterima</span>
                    @else
                        <span class="px-4 py-2 bg-red-100 text-red-800 rounded-full font-semibold text-sm">Ditolak</span>
                    @endif
                </div>
            </div>

            @if($pendaftaran->status == 'Pending')
            <div class="bg-yellow-50 border border-yellow-200 rounded p-4 mb-6 text-sm text-yellow-700">
                Pendaftaran Anda sedang dalam proses review oleh admin. Silakan simpan nomor pendaftaran di atas untuk mengecek status sewaktu-waktu.
            </div>
            @elseif($pendaftaran->status == 'Disetujui')
            <div class="bg-green-50 border border-green-200 rounded p-4 mb-6 text-sm text-green-700">
                Selamat! Pendaftaran anak Anda telah <strong>disetujui</strong>. Silakan hubungi pihak sekolah untuk informasi selanjutnya.
            </div>
            @else
            <div class="bg-red-50 border border-red-200 rounded p-4 mb-6 text-sm text-red-700">
                Mohon maaf, pendaftaran anak Anda <strong>tidak dapat diterima</strong>. Silakan hubungi pihak sekolah untuk informasi lebih lanjut.
            </div>
            @endif

            <!-- Detail Data -->
            <div class="grid grid-cols-2 gap-4 text-sm mb-6">
                <div>
                    <p class="text-gray-400 uppercase text-xs tracking-wide mb-1">Data Calon Siswa</p>
                    <table class="w-full">
                        <tr><td class="py-1 text-gray-500 w-40">Nama Lengkap</td><td class="py-1 font-medium">{{ $pendaftaran->nama_lengkap_anak }}</td></tr>
                        <tr><td class="py-1 text-gray-500">Tanggal Lahir</td><td class="py-1 font-medium">{{ \Carbon\Carbon::parse($pendaftaran->tanggal_lahir_anak)->format('d M Y') }}</td></tr>
                        <tr><td class="py-1 text-gray-500">Jenis Kelamin</td><td class="py-1 font-medium">{{ $pendaftaran->jenis_kelamin_anak == 'L' ? 'Laki-laki' : 'Perempuan' }}</td></tr>
                        <tr><td class="py-1 text-gray-500">Alamat</td><td class="py-1 font-medium">{{ $pendaftaran->alamat }}</td></tr>
                    </table>
                </div>
                <div>
                    <p class="text-gray-400 uppercase text-xs tracking-wide mb-1">Data Pendaftar</p>
                    <table class="w-full">
                        <tr><td class="py-1 text-gray-500 w-40">Nama</td><td class="py-1 font-medium">{{ $pendaftaran->nama_pendaftar }}</td></tr>
                        <tr><td class="py-1 text-gray-500">Hubungan</td><td class="py-1 font-medium">{{ $pendaftaran->hubungan_pendaftar }}</td></tr>
                        <tr><td class="py-1 text-gray-500">Telepon</td><td class="py-1 font-medium">{{ $pendaftaran->nomor_telepon ?? '-' }}</td></tr>
                        <tr><td class="py-1 text-gray-500">Email</td><td class="py-1 font-medium">{{ $pendaftaran->email_pendaftar ?? '-' }}</td></tr>
                        <tr><td class="py-1 text-gray-500">Tgl Daftar</td><td class="py-1 font-medium">{{ \Carbon\Carbon::parse($pendaftaran->tanggal_pendaftaran)->format('d M Y') }}</td></tr>
                    </table>
                </div>
            </div>

            <!-- Dokumen -->
            @if($pendaftaran->dokumen->isNotEmpty())
            <div class="border-t pt-4">
                <p class="text-gray-400 uppercase text-xs tracking-wide mb-3">Dokumen Terupload</p>
                <div class="grid grid-cols-2 gap-2">
                    @foreach($pendaftaran->dokumen as $dok)
                    <div class="flex items-center gap-2 bg-gray-50 border rounded px-3 py-2 text-sm">
                        <span class="text-gray-400">📎</span>
                        <div>
                            <p class="font-medium text-gray-700">{{ $dok->jenis_dokumen }}</p>
                            <p class="text-xs text-gray-400">{{ $dok->nama_file }}</p>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            @endif

            <div class="mt-6 pt-4 border-t">
                <a href="{{ route('pendaftaran.create') }}"
                   class="text-green-600 hover:underline text-sm">← Daftar siswa lain</a>
            </div>
        </div>

        <!-- Cek Status Lain -->
        <div class="bg-white rounded-lg shadow p-4 mt-4">
            <p class="text-sm font-semibold text-gray-700 mb-2">Cek status pendaftaran lain</p>
            <form method="GET" action="" id="cek-form" class="flex gap-2">
                <input type="text" id="nomor-input" placeholder="Masukkan nomor pendaftaran"
                       class="flex-1 border rounded px-3 py-2 text-sm" value="">
                <button type="button" onclick="cekStatus()"
                        class="bg-green-600 text-white px-4 py-2 rounded text-sm hover:bg-green-700">
                    Cek
                </button>
            </form>
        </div>
    </div>

    <script>
        function cekStatus() {
            const nomor = document.getElementById('nomor-input').value.trim();
            if (nomor) {
                window.location.href = '/pendaftaran/status/' + encodeURIComponent(nomor);
            }
        }
    </script>
</body>
</html>
