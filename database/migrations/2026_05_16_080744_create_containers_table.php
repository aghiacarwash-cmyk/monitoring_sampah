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
        Schema::create('containers', function (Blueprint $table) {

            $table->increments('id_container');

            $table->string('kode_containers', 30);

            $table->double('latitude');

            $table->double('longitude');

            $table->string('nama_lokasi', 100);

            $table->integer('id_kecamatan');

            $table->integer('id_kelurahan');

            $table->integer('kapasitas');

            $table->float('persen');

            $table->float('baterai');

            $table->string('status', 30);

            $table->dateTime('updated_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('containers');
    }
};