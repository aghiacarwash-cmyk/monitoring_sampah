<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Container extends Model
{
    public $timestamps = false;
    protected $primaryKey = 'id_container';
    protected $fillable = [
        'kode_containers',
        'latitude',
        'longitude',
        'nama_lokasi',
        'id_kecamatan',
        'id_kelurahan',
        'kapasitas',
        'persen',
        'baterai',
        'status',
        'status_system',
        'notif_terkirim',
        'notif_level',
        'notif_baterai',
        'notif_sensor1',
        'notif_sensor2',
        'notif_sensor3',
        'notif_sensor4',
        'updated_at',
    ];

    public function kecamatan()
    {
        return $this->belongsTo(
            Kecamatan::class,
            'id_kecamatan',
            'id_kecamatan'
        );
    }

    public function kelurahan()
    {
        return $this->belongsTo(
            Kelurahan::class,
            'id_kelurahan',
            'id_kelurahan'
        );
    }
}