<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Siswa;
use App\Models\Kelas;

class DashboardController extends Controller
{
    public function index()
    {
        $totalSiswa = Siswa::where('status', 'Aktif')->count();
        $totalGuru = User::where('role', 'Guru')->count();
        $totalOrangTua = User::where('role', 'Orang Tua')->count();
        $totalKelas = Kelas::count();
        
        return view('admin.dashboard', compact(
            'totalSiswa',
            'totalGuru',
            'totalOrangTua',
            'totalKelas'
        ));
    }
}