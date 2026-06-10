<?php
namespace App\Http\Controllers;
use App\Models\RiwayatPasien;
use Illuminate\Http\Request;

class RiwayatPasienController extends Controller {
    public function index(Request $request) {
        $search  = $request->get('search');
        // Ambil semua riwayat, group by nama_pasien untuk tampil di list kiri
        $riwayats = RiwayatPasien::when($search, fn($q) =>
                        $q->where('nama_pasien','like',"%$search%"))
                    ->orderBy('created_at','desc')
                    ->get();
        // Pasien yang dipilih (default: pertama)
        $selectedNama  = $request->get('pasien', optional($riwayats->first())->nama_pasien);
        $detailRiwayat = RiwayatPasien::where('nama_pasien',$selectedNama)
                            ->orderBy('tanggal_kunjungan','desc')->get();
        $pasienList    = $riwayats->unique('nama_pasien')->values();
        return view('riwayatpasien', compact('riwayats','pasienList','detailRiwayat','selectedNama','search'));
    }
}
