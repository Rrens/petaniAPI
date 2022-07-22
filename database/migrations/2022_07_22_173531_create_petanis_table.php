<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('petanis', function (Blueprint $table) {
            $table->id();
            $table->string('nama_petani');
            $table->string('nik');
            $table->string('alamat');
            $table->string('telp');
            $table->string('foto', 100);
            $table->unsignedBigInteger('id_kelompok_jenis');
            $table->foreign('id_kelompok_jenis')->references('id')->on('kelompok_jenis');
            $table->string('status');
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
        Schema::dropIfExists('petanis');
    }
};
