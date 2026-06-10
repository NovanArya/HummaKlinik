<?php
namespace Database\Seeders;
use App\Models\User;
use App\Models\JadwalDokter;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder {
    public function run(): void {
        // Seed users awal
        User::firstOrCreate(['username' => 'admin'], [
            'name' => 'Admin Utama', 'email' => 'admin@poliklinik.com',
            'password' => Hash::make('admin123'), 'role' => 'Admin',
        ]);
        User::firstOrCreate(['username' => 'rani'], [
            'name' => 'Petugas Rani', 'email' => 'rani@poliklinik.com',
            'password' => Hash::make('rani123'), 'role' => 'Petugas',
        ]);
        User::firstOrCreate(['username' => 'drbudi'], [
            'name' => 'Dr. Budi Santoso', 'email' => 'budi@poliklinik.com',
            'password' => Hash::make('budi123'), 'role' => 'Dokter',
        ]);
        User::firstOrCreate(['username' => 'drsari'], [
            'name' => 'Dr. Sari Amelia', 'email' => 'sari@poliklinik.com',
            'password' => Hash::make('sari123'), 'role' => 'Dokter',
        ]);
        User::firstOrCreate(['username' => 'andi'], [
            'name' => 'Pasien Andi', 'email' => 'andi@poliklinik.com',
            'password' => Hash::make('andi123'), 'role' => 'Pasien',
        ]);

        // Seed jadwal dokter awal
        $jadwals = [
            ['nama_dokter'=>'Dr. Budi Santoso','spesialis'=>'Umum','hari'=>'Senin','jam_mulai'=>'08:00','jam_selesai'=>'12:00'],
            ['nama_dokter'=>'Dr. Sari Amelia','spesialis'=>'Gigi','hari'=>'Selasa','jam_mulai'=>'09:00','jam_selesai'=>'13:00'],
            ['nama_dokter'=>'Dr. Andi Wijaya','spesialis'=>'Anak','hari'=>'Rabu','jam_mulai'=>'10:00','jam_selesai'=>'14:00'],
            ['nama_dokter'=>'Dr. Lestari','spesialis'=>'Kandungan','hari'=>'Kamis','jam_mulai'=>'08:00','jam_selesai'=>'12:00'],
            ['nama_dokter'=>'Dr. Budi Santoso','spesialis'=>'Umum','hari'=>'Jumat','jam_mulai'=>'08:00','jam_selesai'=>'12:00'],
        ];
        foreach ($jadwals as $j) {
            JadwalDokter::firstOrCreate(
                ['nama_dokter' => $j['nama_dokter'], 'hari' => $j['hari']],
                $j
            );
        }
    }
}
