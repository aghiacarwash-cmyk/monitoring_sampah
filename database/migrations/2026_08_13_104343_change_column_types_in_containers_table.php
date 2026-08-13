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
    Schema::table('containers', function (Blueprint $table) {
        $table->decimal('latitude', 10, 8)->change();
        $table->decimal('longitude', 11, 8)->change();
        $table->tinyInteger('persen')->unsigned()->change();
        $table->tinyInteger('baterai')->unsigned()->change();
    });
}

public function down()
{
    Schema::table('containers', function (Blueprint $table) {
        $table->double('latitude')->change();
        $table->double('longitude')->change();
        $table->float('persen')->change();
        $table->float('baterai')->change();
    });
}
};
