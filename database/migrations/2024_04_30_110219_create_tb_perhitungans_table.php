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
        Schema::create('tb_perhitungan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_kabupaten')->references('id')->on('tb_kabupaten')->onUpdate('cascade')->onDelete('cascade');
            // $table->string('id_kabupaten',255);
            $table->foreignId('nama_kabupaten')->references('id')->on('tb_kabupaten')->onUpdate('cascade')->onDelete('cascade');
            $table->string('tahun',255);
            $table->float('luas_panen');
            $table->float('produktivitas');
            $table->float('produksi');
            $table->string('cluster', 255);
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
        Schema::dropIfExists('tb_perhitungan');
    }
};