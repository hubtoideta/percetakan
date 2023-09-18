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
        Schema::create('employed_owners', function (Blueprint $table) {
            $table->id();
            $table->uuid("id_store");
            $table->string('username')->unique();
            $table->enum('role', ['Administrasi','Desainer','Produksi','Pemasang']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employed_owners');
    }
};
