<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class BackupController extends Controller
{
    // Tampilkan halaman backup
    public function index()
    {
        // Ambil list backup yang ada
        $backups = $this->getBackupFiles();
        
        return view('admin.backup.index', compact('backups'));
    }
    
    // Buat backup database baru
    public function create()
    {
        try {
            // Nama file backup dengan timestamp
            $filename = 'backup_' . Carbon::now()->format('Y-m-d_His') . '.sql';
            
            // Path untuk simpan file
            $path = storage_path('app/backups/' . $filename);
            
            // Buat folder kalau belum ada
            if (!file_exists(storage_path('app/backups'))) {
                mkdir(storage_path('app/backups'), 0755, true);
            }
            
            // Ambil config database dari .env
            $host = env('DB_HOST');
            $username = env('DB_USERNAME');
            $password = env('DB_PASSWORD');
            $database = env('DB_DATABASE');
            
            // Command mysqldump
            $command = sprintf(
                'mysqldump --user=%s --password=%s --host=%s %s > %s',
                escapeshellarg($username),
                escapeshellarg($password),
                escapeshellarg($host),
                escapeshellarg($database),
                escapeshellarg($path)
            );
            
            // Jalankan command
            exec($command, $output, $returnCode);
            
            // Cek apakah berhasil
            if ($returnCode !== 0) {
                throw new \Exception('Backup gagal dibuat');
            }
            
            return redirect()->route('admin.backup.index')
                ->with('success', 'Backup database berhasil dibuat: ' . $filename);
                
        } catch (\Exception $e) {
            return redirect()->route('admin.backup.index')
                ->with('error', 'Backup gagal: ' . $e->getMessage());
        }
    }
    
    //Download File Backup
    public function download($filename)
    {
        $path = storage_path('app/backups/' . $filename);
        
        if (file_exists($path)) {
            return response()->download($path);
        }
        
        return redirect()->route('admin.backup.index')
            ->with('error', 'File backup tidak ditemukan');
    }
    
    // Hapus File Backup
    public function delete($filename)
    {
        $path = storage_path('app/backups/' . $filename);
        
        if (file_exists($path)) {
            unlink($path);
            return redirect()->route('admin.backup.index')
                ->with('success', 'Backup berhasil dihapus');
        }
        
        return redirect()->route('admin.backup.index')
            ->with('error', 'File backup tidak ditemukan');
    }
    
    //Helper: Ambil list file backup
    private function getBackupFiles()
    {
        $backups = [];
        $path = storage_path('app/backups');
        
        if (file_exists($path)) {
            $files = scandir($path);
            
            foreach ($files as $file) {
                if ($file != '.' && $file != '..') {
                    $backups[] = [
                        'name' => $file,
                        'size' => $this->formatBytes(filesize($path . '/' . $file)),
                        'date' => date('d M Y H:i', filemtime($path . '/' . $file))
                    ];
                }
            }
        }
        
        return $backups;
    }
    
    //Helper: Format ukuran file
    private function formatBytes($bytes)
    {
        if ($bytes >= 1073741824) {
            return number_format($bytes / 1073741824, 2) . ' GB';
        } elseif ($bytes >= 1048576) {
            return number_format($bytes / 1048576, 2) . ' MB';
        } elseif ($bytes >= 1024) {
            return number_format($bytes / 1024, 2) . ' KB';
        } else {
            return $bytes . ' bytes';
        }
    }
}

