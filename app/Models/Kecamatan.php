<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kecamatan extends Model
{
    protected $table = 'kecamatan';
    protected $primaryKey = 'id_kecamatan';
   

    protected $fillable = ['nama_kecamatan'];

    public function kelurahans()
    {
        return $this->hasMany(Kelurahan::class, 'id_kecamatan', 'id_kecamatan');
    }
}