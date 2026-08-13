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
        $table->boolean('notif_sensor1')->default(false);
        $table->boolean('notif_sensor2')->default(false);
        $table->boolean('notif_sensor3')->default(false);
        $table->boolean('notif_sensor4')->default(false);
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
