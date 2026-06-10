<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Antrean extends Model {
    protected $table = 'antrean';
    protected $fillable = ['no_antrean','nama_pasien','poli','dokter','status','tanggal'];
}
