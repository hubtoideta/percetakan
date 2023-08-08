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
        Schema::create('information_stores', function (Blueprint $table) {
            $table->uuid("id_store")->primary();
            $table->string("username_owner")->unique();
            $table->string("store_name", 150);
            $table->string("store_email", 50);
            $table->text("deskripsi");
            
            $table->timestamps();
            $table->foreign("username_owner")->references("username")->on("users");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('information_stores');
    }
};
