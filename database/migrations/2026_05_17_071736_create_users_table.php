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
        Schema::create('users', function (Blueprint $table) {

            $table->id('id_user');

            // akun login
            $table->string('username', 50);
            $table->string('email', 100)->unique();
            $table->string('password', 255);

            // data pegawai
            $table->string('nik', 20)->unique();
            $table->string('nama_lengkap', 100);
            $table->string('jenis_kelamin', 10)->nullable();
            $table->date('tanggal_lahir')->nullable();
            $table->string('no_hp', 15)->nullable();
            $table->text('alamat')->nullable();

            // data dinas kebersihan
            // $table->string('jabatan', 50)->nullable(); 
            // contoh: petugas, koordinator, admin, supir

            $table->string('wilayah_tugas', 100)->nullable();
            // contoh: Kecamatan A, Zona 1, dll

            $table->string('role', 20);
            // admin / petugas / kepala_dinas

            // foto pegawai
            $table->string('foto')->nullable();

            // status aktif/nonaktif
            $table->enum('status', ['aktif', 'nonaktif'])->default('aktif');

            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};