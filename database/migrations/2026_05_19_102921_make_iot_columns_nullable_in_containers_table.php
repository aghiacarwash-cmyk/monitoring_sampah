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
        $table->double('latitude')->nullable()->change();
        $table->double('longitude')->nullable()->change();
        $table->double('persen')->nullable()->change();
        $table->double('baterai')->nullable()->change();
        $table->string('status')->nullable()->change();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('containers', function (Blueprint $table) {
            //
        });
    }
};
