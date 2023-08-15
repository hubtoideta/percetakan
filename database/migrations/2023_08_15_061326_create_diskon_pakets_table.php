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
        Schema::create('diskon_pakets', function (Blueprint $table) {
            $table->string('nama_paket_diskon')->primary();
            $table->bigInteger('tiga_bulan')->default(0);
            $table->bigInteger('enam_bulan')->default(0);
            $table->bigInteger('dua_belas_bulan')->default(0);
            $table->bigInteger('dua_puluh_empat_bulan')->default(0);
            $table->timestamps();
            $table->foreign('nama_paket_diskon')->references('nama_paket')->on('data_pakets');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('diskon_pakets');
    }
};
