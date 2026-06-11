<?php
namespace App\Http\Controllers;
use App\Models\Antrean;
use App\Models\RiwayatPasien;
use App\Models\JadwalDokter;
use Illuminate\Http\Request;

class DashboardController extends Controller {
    public function index() {
        $antreens       = Antrean::orderBy('no_antrean')->take(5)->get();
        $totalAntrean   = Antrean::whereDate('tanggal', today())->count();

        $totalDokter    = JadwalDokter::distinct('nama_dokter')->count('nama_dokter');

        // Jumlah pasien unik dari antrean + riwayat pasien
        $pasienAntrean  = Antrean::distinct()->pluck('nama_pasien');
        $pasienRiwayat  = RiwayatPasien::distinct()->pluck('nama_pasien');
        $totalPasien    = $pasienAntrean->merge($pasienRiwayat)->unique()->count();

        $totalJanji     = Antrean::whereDate('tanggal', today())
                            ->whereIn('status', ['menunggu', 'diperiksa'])
                            ->count();

        return view('dashboard', compact('antreens', 'totalAntrean', 'totalDokter', 'totalPasien', 'totalJanji'));
    }
}
