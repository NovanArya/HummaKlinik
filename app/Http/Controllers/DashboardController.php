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
        // Hitung pasien unik dari antrean + riwayat
        $pasienAntrean  = Antrean::distinct()->pluck('nama_pasien');
        $pasienRiwayat  = RiwayatPasien::distinct()->pluck('nama_pasien');
        $totalPasien    = $pasienAntrean->merge($pasienRiwayat)->unique()->count() + 28;

        return view('dashboard', compact('antreens','totalAntrean','totalPasien'));
    }
}
