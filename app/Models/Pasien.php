<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pasien extends Model
{
    protected $table = 'pasien';

    protected $fillable = [
        'no_rekam_medis',
        'nama_pasien',
        'jenis_kelamin',
        'tanggal_lahir',
        'no_identitas',
        'alamat',
        'no_telepon',
        'nama_ibu_kandung',
        'status_kawin',
        'status_asuransi',
    ];
}
