<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->foreignId('kelas_id')->constrained('kelass')->onDelete('cascade');
            $table->date('tanggal_pembelian')->nullable();
            $table->decimal('rating', 2, 1)->default(0);

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
