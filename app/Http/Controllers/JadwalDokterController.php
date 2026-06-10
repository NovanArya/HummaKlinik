<?php
namespace App\Http\Controllers;
use App\Models\JadwalDokter;
use Illuminate\Http\Request;

class JadwalDokterController extends Controller {
    public function index() {
        $jadwals = JadwalDokter::orderBy('hari')->get();
        return view('jadwaldokter', compact('jadwals'));
    }

    public function store(Request $request) {
        $request->validate([
            'nama_dokter' => 'required|string',
            'spesialis'   => 'required|string',
            'hari'        => 'required|in:Senin,Selasa,Rabu,Kamis,Jumat,Sabtu,Minggu',
            'jam_mulai'   => 'required',
            'jam_selesai' => 'required',
        ]);
        JadwalDokter::create($request->only(['nama_dokter','spesialis','hari','jam_mulai','jam_selesai']));
        return back()->with('success','Jadwal dokter berhasil ditambahkan.');
    }

    public function update(Request $request, JadwalDokter $jadwaldokter) {
        $request->validate([
            'nama_dokter' => 'required|string',
            'spesialis'   => 'required|string',
            'hari'        => 'required|in:Senin,Selasa,Rabu,Kamis,Jumat,Sabtu,Minggu',
            'jam_mulai'   => 'required',
            'jam_selesai' => 'required',
        ]);
        $jadwaldokter->update($request->only(['nama_dokter','spesialis','hari','jam_mulai','jam_selesai']));
        return back()->with('success','Jadwal dokter berhasil diperbarui.');
    }

    public function destroy(JadwalDokter $jadwaldokter) {
        $jadwaldokter->delete();
        return back()->with('success','Jadwal dokter berhasil dihapus.');
    }
}
