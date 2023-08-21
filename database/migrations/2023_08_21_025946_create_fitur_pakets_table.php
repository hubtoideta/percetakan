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
        Schema::create('fitur_pakets', function (Blueprint $table) {
            $table->id();
            $table->text('nama_fitur_paket');
            $table->enum('Premium', ['y','n','5']);
            $table->enum('Business', ['y','n','15']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fitur_pakets');
    }
};
