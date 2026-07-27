<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
  public function up()
{
    Schema::table('kelurahan', function (Blueprint $table) {
        $table->unsignedInteger('id_kecamatan')->nullable()->after('nama_kelurahan');
    });
}

public function down()
{
    Schema::table('kelurahan', function (Blueprint $table) {
        $table->dropColumn('id_kecamatan');
    });
}
};
