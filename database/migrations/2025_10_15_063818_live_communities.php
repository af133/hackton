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
        Schema::create('live_communites', function (Blueprint $table) {
            $table->id();
            $table->foreignId('komunitas_id')->constrained('communities')->onDelete('cascade');
            $table->string('judul');
            $table->date('tanggal');
            $table->time('waktu_mulai'); 
            $table->string('zona_waktu', 10)->default('WIB'); 
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('live_communites');
    }
};
