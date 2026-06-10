<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('antrean', function (Blueprint $table) {
            $table->id();
            $table->integer('no_antrean');
            $table->string('nama_pasien');
            $table->string('poli');
            $table->string('dokter')->nullable();
            $table->enum('status', ['menunggu', 'diperiksa', 'selesai'])->default('menunggu');
            $table->date('tanggal')->default(now());
            $table->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('antrean'); }
};
