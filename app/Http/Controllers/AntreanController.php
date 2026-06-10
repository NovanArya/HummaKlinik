<?php
namespace App\Http\Controllers;
use App\Models\Antrean;
use App\Models\JadwalDokter;
use App\Models\RiwayatPasien;
use Illuminate\Http\Request;

class AntreanController extends Controller {

    public function index() {
        $antreens     = Antrean::orderBy('no_antrean')->get();
        $jadwals      = JadwalDokter::orderBy('nama_dokter')->get();
        $nextNo       = (Antrean::max('no_antrean') ?? 0) + 1;
        $currentQueue = Antrean::where('status','diperiksa')->orderBy('no_antrean')->first();
        $nextQueue    = Antrean::where('status','menunggu')->orderBy('no_antrean')->first();
        return view('antrean', compact('antreens','jadwals','nextNo','currentQueue','nextQueue'));
    }

    public function store(Request $request) {
        $request->validate([
            'nama_pasien' => 'required|string',
            'poli'        => 'required|string',
            'dokter'      => 'nullable|string',
        ]);
        $nextNo = (Antrean::max('no_antrean') ?? 0) + 1;
        Antrean::create([
            'no_antrean'  => $nextNo,
            'nama_pasien' => $request->nama_pasien,
            'poli'        => $request->poli,
            'dokter'      => $request->dokter,
            'status'      => 'menunggu',
            'tanggal'     => today(),
        ]);
        return back()->with('success', 'Antrean #' . str_pad($nextNo,3,'0',STR_PAD_LEFT) . ' berhasil ditambahkan.');
    }

    public function update(Request $request, Antrean $antrean) {
        $request->validate([
            'nama_pasien' => 'required|string',
            'poli'        => 'required|string',
            'dokter'      => 'nullable|string',
            'status'      => 'required|in:menunggu,diperiksa,selesai',
        ]);
        $antrean->update($request->only(['nama_pasien','poli','dokter','status']));
        return back()->with('success', 'Antrean berhasil diperbarui.');
    }

    public function destroy(Antrean $antrean) {
        $antrean->delete();
        return back()->with('success', 'Antrean berhasil dihapus.');
    }

    // Panggil berikutnya: set menunggu pertama → diperiksa
    public function panggilBerikutnya() {
        // Selesaikan yang sedang diperiksa dulu (ubah ke selesai lalu pindah ke riwayat)
        $sedangDiperiksa = Antrean::where('status','diperiksa')->orderBy('no_antrean')->first();
        if ($sedangDiperiksa) {
            $sedangDiperiksa->update(['status' => 'selesai']);
        }
        // Panggil menunggu berikutnya
        $berikutnya = Antrean::where('status','menunggu')->orderBy('no_antrean')->first();
        if ($berikutnya) {
            $berikutnya->update(['status' => 'diperiksa']);
            return back()->with('success', 'Pasien ' . $berikutnya->nama_pasien . ' dipanggil.');
        }
        return back()->with('info', 'Tidak ada antrean yang menunggu.');
    }

    // Selesai: pindah antrean ke riwayat pasien
    public function selesai(Antrean $antrean) {
        RiwayatPasien::create([
            'antrean_id'        => $antrean->id,
            'nama_pasien'       => $antrean->nama_pasien,
            'poli'              => $antrean->poli,
            'dokter'            => $antrean->dokter,
            'tanggal_kunjungan' => $antrean->tanggal ?? today(),
            'keluhan'           => null,
            'diagnosa'          => null,
            'tindakan'          => null,
            'resep'             => null,
        ]);
        $antrean->update(['status' => 'selesai']);
        return back()->with('success', $antrean->nama_pasien . ' selesai dan masuk ke riwayat pasien.');
    }
}
