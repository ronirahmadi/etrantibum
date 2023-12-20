<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLaporansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('laporans', function (Blueprint $table) {
            $table->string('kodeunik_laporan')->primary();
            $table->integer('nip_verifikator');
            $table->integer('grup_id');
            $table->date('tanggal_laporan');
            $table->string('judul_laporan');
            $table->longText('deskripsi_laporan');
            $table->integer('lokasi_kec_laporan');
            $table->integer('lokasi_kel_laporan');
            $table->longText('detail_lokasi_laporan');
            $table->string('bukti_laporan');
            $table->string('bukti_laporan_path');
            $table->enum('status_laporan', ['Belum Diverifikasi', 'Laporan Ditolak', 'Laporan Diterima'])->default('Belum Diverifikasi');
            $table->longText('keterangan_verifikasi_laporan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('laporans');
    }
}
