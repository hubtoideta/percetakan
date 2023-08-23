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
        Schema::create('pembelian_pakets', function (Blueprint $table) {
            $table->ulid("code_pembelian")->primary();
            $table->char("id_store", 36);
            $table->timestamps();
            $table->foreign("id_store")->references("information_stores")->on("id_store");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pembelian_pakets');
    }
};
