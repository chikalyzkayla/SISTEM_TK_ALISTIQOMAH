<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - Admin TK Al-Istiqomah</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100">
    <div class="min-h-screen flex">

        <!-- Sidebar -->
        <nav class="mt-4">
    <a href="{{ route('admin.dashboard') }}" 
       class="block py-2 px-4 hover:bg-gray-700 {{ Request::is('admin/dashboard') ? 'bg-gray-700' : '' }}">
        Dashboard
    </a>
    <a href="{{ route('admin.users.index') }}" 
       class="block py-2 px-4 hover:bg-gray-700 {{ Request::is('admin/users*') ? 'bg-gray-700' : '' }}">
        Kelola Pengguna
    </a>
    <a href="{{ route('admin.siswa.index') }}" 
       class="block py-2 px-4 hover:bg-gray-700 {{ Request::is('admin/siswa*') ? 'bg-gray-700' : '' }}">
        Kelola Siswa
    </a>
    <a href="{{ route('admin.pendaftaran.index') }}"
       class="block py-2 px-4 hover:bg-gray-700 {{ Request::is('admin/pendaftaran*') ? 'bg-gray-700' : '' }}">
        Pendaftaran Siswa
    </a>
    <a href="{{ route('admin.backup.index') }}"
       class="block py-2 px-4 hover:bg-gray-700 {{ Request::is('admin/backup*') ? 'bg-gray-700' : '' }}">
        Backup Database
    </a>
</nav>
                
        <!-- Main Content -->
        <div class="flex-1">
            <!-- Header -->
            <header class="bg-white shadow">
                <div class="flex justify-between items-center px-6 py-4">
                    <h1 class="text-2xl font-bold">@yield('page-title')</h1>
                    <div>
                        <span class="mr-4">Halo, {{ auth()->user()->name }}</span>
                        <form method="POST" action="{{ route('logout') }}" class="inline">
                            @csrf
                            <button type="submit" class="text-red-600 hover:text-red-800">
                                Logout
                            </button>
                        </form>
                    </div>
                </div>
            </header>
            
            <!-- Page Content -->
            <main class="p-6">
                @yield('content')
            </main>
        </div>
    </div>
</body>
</html>
