<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $table = 'users';

    protected $primaryKey = 'id_user';

    protected $fillable = [
        'username',
        'email',
        'password',
        'nik',
        'nama_lengkap',
        'jenis_kelamin',
        'tanggal_lahir',
        'no_hp',
        'wilayah_tugas',
        'alamat',
        'role',
        'foto',
        'status',
        'fcm_token',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    
}