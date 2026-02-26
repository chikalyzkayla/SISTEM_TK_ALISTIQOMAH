<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pendaftaran Siswa Baru - TK Al-Istiqomah</title>
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

        <div class="bg-white rounded-lg shadow p-6">
            <h2 class="text-2xl font-bold text-gray-800 mb-1">Formulir Pendaftaran Siswa Baru</h2>
            <p class="text-gray-500 text-sm mb-6">Isi data dengan lengkap dan benar. Admin akan mereview pendaftaran Anda.</p>

            @if($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                <ul class="list-disc list-inside text-sm">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <form method="POST" action="{{ route('pendaftaran.store') }}" enctype="multipart/form-data">
                @csrf

                <!-- DATA ANAK -->
                <h3 class="text-lg font-semibold text-gray-700 border-b pb-2 mb-4">Data Calon Siswa</h3>

                <div class="mb-4">
                    <label class="block text-sm font-bold mb-1">Nama Lengkap Anak <span class="text-red-500">*</span></label>
                    <input type="text" name="nama_lengkap_anak" required
                           class="w-full border rounded px-3 py-2 @error('nama_lengkap_anak') border-red-500 @enderror"
                           value="{{ old('nama_lengkap_anak') }}"
                           placeholder="Masukkan nama lengkap anak">
                    @error('nama_lengkap_anak')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="grid grid-cols-2 gap-4 mb-4">
                    <div>
                        <label class="block text-sm font-bold mb-1">Tanggal Lahir <span class="text-red-500">*</span></label>
                        <input type="date" name="tanggal_lahir_anak" required
                               class="w-full border rounded px-3 py-2 @error('tanggal_lahir_anak') border-red-500 @enderror"
                               value="{{ old('tanggal_lahir_anak') }}">
                        @error('tanggal_lahir_anak')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-bold mb-1">Jenis Kelamin <span class="text-red-500">*</span></label>
                        <select name="jenis_kelamin_anak" required
                                class="w-full border rounded px-3 py-2 @error('jenis_kelamin_anak') border-red-500 @enderror">
                            <option value="">-- Pilih --</option>
                            <option value="L" {{ old('jenis_kelamin_anak') == 'L' ? 'selected' : '' }}>Laki-laki</option>
                            <option value="P" {{ old('jenis_kelamin_anak') == 'P' ? 'selected' : '' }}>Perempuan</option>
                        </select>
                        @error('jenis_kelamin_anak')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-bold mb-1">Alamat Lengkap <span class="text-red-500">*</span></label>
                    <textarea name="alamat" rows="3" required
                              class="w-full border rounded px-3 py-2 @error('alamat') border-red-500 @enderror"
                              placeholder="Masukkan alamat lengkap">{{ old('alamat') }}</textarea>
                    @error('alamat')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- DATA PENDAFTAR -->
                <h3 class="text-lg font-semibold text-gray-700 border-b pb-2 mb-4 mt-6">Data Orang Tua / Wali</h3>

                <div class="mb-4">
                    <label class="block text-sm font-bold mb-1">Nama Pendaftar <span class="text-red-500">*</span></label>
                    <input type="text" name="nama_pendaftar" required
                           class="w-full border rounded px-3 py-2 @error('nama_pendaftar') border-red-500 @enderror"
                           value="{{ old('nama_pendaftar') }}"
                           placeholder="Nama orang tua / wali">
                    @error('nama_pendaftar')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="grid grid-cols-2 gap-4 mb-4">
                    <div>
                        <label class="block text-sm font-bold mb-1">Hubungan dengan Anak <span class="text-red-500">*</span></label>
                        <select name="hubungan_pendaftar" required
                                class="w-full border rounded px-3 py-2 @error('hubungan_pendaftar') border-red-500 @enderror">
                            <option value="">-- Pilih --</option>
                            <option value="Ayah" {{ old('hubungan_pendaftar') == 'Ayah' ? 'selected' : '' }}>Ayah</option>
                            <option value="Ibu" {{ old('hubungan_pendaftar') == 'Ibu' ? 'selected' : '' }}>Ibu</option>
                            <option value="Wali" {{ old('hubungan_pendaftar') == 'Wali' ? 'selected' : '' }}>Wali</option>
                        </select>
                        @error('hubungan_pendaftar')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-bold mb-1">Nomor Telepon</label>
                        <input type="text" name="nomor_telepon"
                               class="w-full border rounded px-3 py-2 @error('nomor_telepon') border-red-500 @enderror"
                               value="{{ old('nomor_telepon') }}"
                               placeholder="08xxxxxxxxxx">
                        @error('nomor_telepon')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-bold mb-1">Email</label>
                    <input type="email" name="email_pendaftar"
                           class="w-full border rounded px-3 py-2 @error('email_pendaftar') border-red-500 @enderror"
                           value="{{ old('email_pendaftar') }}"
                           placeholder="email@contoh.com">
                    @error('email_pendaftar')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- DOKUMEN -->
                <h3 class="text-lg font-semibold text-gray-700 border-b pb-2 mb-4 mt-6">Upload Dokumen <span class="text-gray-400 font-normal text-sm">(opsional)</span></h3>
                <p class="text-sm text-gray-500 mb-4">Format: PDF, JPG, PNG. Maks 2MB per file.</p>

                <div class="grid grid-cols-2 gap-4 mb-6">
                    <div>
                        <label class="block text-sm font-bold mb-1">Kartu Keluarga (KK)</label>
                        <input type="file" name="dokumen_kk" accept=".pdf,.jpg,.jpeg,.png"
                               class="w-full border rounded px-3 py-2 text-sm @error('dokumen_kk') border-red-500 @enderror">
                        @error('dokumen_kk')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-bold mb-1">Akta Kelahiran</label>
                        <input type="file" name="dokumen_akta" accept=".pdf,.jpg,.jpeg,.png"
                               class="w-full border rounded px-3 py-2 text-sm @error('dokumen_akta') border-red-500 @enderror">
                        @error('dokumen_akta')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-bold mb-1">KTP Orang Tua</label>
                        <input type="file" name="dokumen_ktp" accept=".pdf,.jpg,.jpeg,.png"
                               class="w-full border rounded px-3 py-2 text-sm @error('dokumen_ktp') border-red-500 @enderror">
                        @error('dokumen_ktp')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-bold mb-1">Foto Anak</label>
                        <input type="file" name="dokumen_foto" accept=".jpg,.jpeg,.png"
                               class="w-full border rounded px-3 py-2 text-sm @error('dokumen_foto') border-red-500 @enderror">
                        @error('dokumen_foto')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="flex gap-3">
                    <button type="submit"
                            class="bg-green-600 text-white px-6 py-2 rounded hover:bg-green-700 font-semibold">
                        Kirim Pendaftaran
                    </button>
                    <a href="{{ url('/') }}"
                       class="bg-gray-500 text-white px-6 py-2 rounded hover:bg-gray-600">
                        Batal
                    </a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
