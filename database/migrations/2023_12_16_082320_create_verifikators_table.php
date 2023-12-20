<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVerifikatorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('verifikators', function (Blueprint $table) {
            $table->integer('nip')->primary();
            $table->string('nama_verifikator');
            $table->string('email_verifikator')->unique();
            $table->string('fp_verifikator')->nullable();
            $table->string('fp_verifikator_path')->nullable();
            $table->string('password');
            $table->rememberToken();
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
        Schema::dropIfExists('verifikators');
    }
}
