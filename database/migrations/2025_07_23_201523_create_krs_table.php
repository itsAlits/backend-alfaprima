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
        Schema::create('krs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users');
            $table->foreignId('kelas_id')->constrained('kelas');
            $table->string('nilai_huruf')->nullable();
            $table->decimal('nilai_angka', 5, 2)->nullable();
            $table->string('tahun_akademik')->nullable();
            $table->string('status')->default('menunggu'); // Statusnya bisa 'Aktif', 'Tidak Aktif', 'Menunggu'
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('krs');
    }
};
