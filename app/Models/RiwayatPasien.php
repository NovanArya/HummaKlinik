<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class RiwayatPasien extends Model {
    protected $table = 'riwayat_pasien';
    protected $fillable = ['antrean_id','nama_pasien','poli','dokter','tanggal_kunjungan','keluhan','diagnosa','tindakan','resep'];
}
