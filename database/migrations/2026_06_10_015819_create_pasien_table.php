<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pasien', function (Blueprint $table) {
            $table->id();
            $table->string('no_rekam_medis')->unique();
            $table->string('nama_pasien');
            $table->enum('jenis_kelamin', ['laki-laki', 'perempuan']);
            $table->date('tanggal_lahir');
            $table->string('no_identitas')->nullable();
            $table->text('alamat');
            $table->string('no_telepon');
            $table->string('nama_ibu_kandung')->nullable();
            $table->enum('status_kawin', ['belum', 'kawin', 'cerai'])->nullable();
            $table->enum('status_asuransi', ['umum', 'bpjs', 'asuransi_lain'])->default('umum');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pasien');
    }
};
