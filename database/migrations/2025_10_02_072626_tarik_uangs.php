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
        Schema::create('tarik_uangs', function (Blueprint $table) {
            $table->id();

            // bikin kolom user_id + relasi ke users
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');

            // bikin kolom detail_pembelian_id + relasi ke detail_pembelians
            $table->foreignId('detail_pembelian_id')->constrained('detail_pembelians')->onDelete('cascade');

            $table->integer('jumlah_tarik');
            $table->string('status')->default('pending');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tarik_uangs');
    }
};
