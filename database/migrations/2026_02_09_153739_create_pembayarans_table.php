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
        Schema::create('pembayarans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sewa_id')->constrained('sewas')->cascadeOnDelete();
            
            $table->enum('tipe', ['dp', 'pelunasan', 'sewa']);
            // dp = uang awal
            // pelunasan = sisa sebelum aktif
            // sewa = pembayaran periode berikutnya

            $table->date('periode')->nullable();
            // untuk sewa bulanan/tahunan (misal 2025-01-01)

            $table->integer('jumlah');
            $table->date('jatuh_tempo')->nullable();
            $table->date('tanggal_bayar')->nullable();
            $table->enum('status', ['belum_lunas', 'lunas'])->default('belum_lunas');
            $table->boolean('is_refunded')->default(false);
            $table->date('tanggal_refund')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pembayarans');
    }
};
