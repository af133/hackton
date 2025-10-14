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
       Schema::create('sesi_live', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kelas_id')->constrained('kelass')->onDelete('cascade');
            $table->string('judul');
            $table->date('tanggal');
            $table->time('waktu_mulai'); 
            $table->time('waktu_selesai');
            $table->string('zona_waktu', 10)->default('WIB'); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sesi_live');
    }
};
