<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void{
        Schema::create('pembelian_pakets', function (Blueprint $table) {
            $table->ulid("code_pembelian")->primary();
            $table->uuid("id_store");
            $table->string("paket","12");
            $table->string("jangka_waktu","20");
            $table->bigInteger("harga_normal");
            $table->bigInteger("diskon");
            $table->bigInteger("ppn");
            $table->bigInteger("total_pembayaran");
            $table->enum("status_order", ["Pending","Ditolak","Diterima"])->default("Pending");
            $table->enum("status_paket", ["Aktif","Tidak Aktif"])->default("Tidak Aktif");
            $table->bigInteger("order_at");
            $table->bigInteger("confirm_at")->default(0);
            $table->bigInteger("start_paket_at")->default(0);
            $table->bigInteger("end_paket_at")->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void{
        Schema::dropIfExists('pembelian_pakets');
    }
};
