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
            $table->string('judul_kelas');
            $table->string('deskripsi');
            $table->string('kategori');
            $table->string('path_gambar')->nullable();
            $table->string('level_kelas');
            $table->integer('harga_koin');
            $table->text('tags');
            $table->boolean('is_draft')->default(true);
            $table->decimal('rating', 2, 1)->default(0);
            $table->foreignId('dibuat_oleh')->constrained('users')->onDelete('cascade');
            $table->timestamps();
        });


    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kelass');
    }
};
