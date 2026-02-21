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
        Schema::create('sewas', function (Blueprint $table) {
            $table->id();

            $table->foreignId('unit_id')->constrained('units')->cascadeOnDelete();
            $table->foreignId('penyewa_id')->constrained('penyewas')->cascadeOnDelete();
            $table->string('nama_toko')->nullable();
            $table->date('tanggal_mulai')->nullable();
            $table->date('tanggal_selesai')->nullable();
            $table->integer('harga_sewa');
            $table->integer('total_dibayar')->default(0);
            $table->enum('status', ['booking', 'aktif', 'selesai', 'batal'])->default('aktif');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sewas');
    }
};
