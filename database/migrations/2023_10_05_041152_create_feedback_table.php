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
        Schema::create('feedback', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('ID_Mahasiswa');
            $table->date('Tanggal');
            $table->text('Isi_Feedback');
            $table->boolean('Tampilkan_Nama')->default(true); // Kolom untuk preferensi tampilan nama
            $table->timestamps();

            $table->foreign('ID_Mahasiswa')->references('id')->on('mahasiswa');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('feedback');
    }
};
