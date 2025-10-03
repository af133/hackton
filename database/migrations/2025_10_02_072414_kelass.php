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
        Schema::create('kelass', function (Blueprint $table) {
            $table->id();
            $table->string('nama_kelas');
            $table->integer('harga_koin');
            $table->string('Keterangan');
            $table->integer('durasi_jam');
            $table->decimal('rating', 2, 1)->default(0);
            $table->dateTime('tanggal_kelas')->nullable();
            $table->foreignId('dibuat_oleh')->constrained('users')->onDelete('cascade');
            $table->unsignedBigInteger('level_id');
            $table->foreign('level_id')->references('id')->on('level_kelas')->onDelete('cascade');
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('class');
    }
};
