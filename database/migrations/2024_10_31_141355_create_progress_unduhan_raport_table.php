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
        Schema::create('progress_unduhan_rapor', function (Blueprint $table) {
            $table->id();
            $table->integer('tahun')->nullable();
            $table->string('nama_provinsi')->nullable();
            $table->string('nama_kabupaten')->nullable();
            $table->string('npsn')->nullable();
            $table->string('nama_sekolah')->nullable();
            $table->string('pengelompokan_jenjang')->nullable();
            $table->string('pendidikan_sederajat')->nullable();
            $table->string('sekolah_aktif')->nullable();
            $table->string('sumber_listrik')->nullable();
            $table->string('daerah_3t')->nullable();
            $table->string('punya_belajar_id')->nullable();
            $table->string('aktivasi_belajar_id')->nullable();
            $table->string('login_level_jenjang')->nullable();
            $table->string('unduh_level_jenjang')->nullable();
            $table->string('login_level_npsn')->nullable();
            $table->string('unduh_level_npsn')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('progress_unduhan_rapor');
    }
};
