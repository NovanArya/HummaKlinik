<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Dokter extends Model
{
    protected $table = 'dokter';

    protected $fillable = [
        'nip',
        'nama_dokter',
        'email',
        'no_telepon',
        'poli_id',
        'spesialisasi',
        'status',
        'biografi',
    ];
}
