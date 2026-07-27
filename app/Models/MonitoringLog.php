<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MonitoringLog extends Model
{
    protected $table = 'monitoring_log';

    protected $primaryKey = 'id_log';

    protected $fillable = [
        'waktu',
        'kode_container',
        'id_kecamatan',
        'id_kelurahan',
        'persen',
        'baterai',
        'status',
        'latitude',
        'longitude',
    ];
        public function kecamatan()
    {
        return $this->belongsTo(Kecamatan::class,'id_kecamatan');
    }

    public function kelurahan()
    {
        return $this->belongsTo(Kelurahan::class,'id_kelurahan');
    }
}