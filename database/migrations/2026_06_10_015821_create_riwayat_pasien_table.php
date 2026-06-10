<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('riwayat_pasien', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('antrean_id')->nullable();
            $table->string('nama_pasien');
            $table->string('poli');
            $table->string('dokter')->nullable();
            $table->date('tanggal_kunjungan');
            $table->text('keluhan')->nullable();
            $table->text('diagnosa')->nullable();
            $table->text('tindakan')->nullable();
            $table->text('resep')->nullable();
            $table->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('riwayat_pasien'); }
};
