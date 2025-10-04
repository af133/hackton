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
       Schema::create('detail_pembelians', function (Blueprint $table) {
            $table->id();

            $table->foreignId('pembelian_id')->constrained('pembelians')->onDelete('cascade');

            // kolom kelas_id
            $table->foreignId('kelas_id')->constrained('kelass')->onDelete('cascade');

            // tanggal default hari ini
            $table->date('tanggal_pembelian');

        });


    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
              Schema::dropIfExists('detail_pembelians');
    }
};
