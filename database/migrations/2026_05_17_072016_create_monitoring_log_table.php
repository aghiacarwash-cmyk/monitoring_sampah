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
        Schema::create('monitoring_log', function (Blueprint $table) {

            $table->id('id_log');

            $table->dateTime('waktu');

            $table->string('kode_container', 30);

            $table->integer('id_kecamatan');

            $table->integer('id_kelurahan');

            $table->float('persen');

            $table->float('baterai');

            $table->string('status', 30);

            $table->double('latitude');

            $table->double('longitude');

            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('monitoring_log');
    }
};