<?php

namespace App\Exports;

use App\Models\Container;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class ContainersExport implements FromCollection, WithHeadings, WithMapping
{
    private $number = 0;

    public function collection()
    {
        return Container::with(['kelurahan', 'kelurahan.kecamatan'])->get();
    }

    public function headings(): array
    {
        return [
            'No',
            'Kode Container',
            'Nama Lokasi',
            'Persentase',
            'Status',
            'Baterai',
            'System status',
            'Latitude',
            'Longitude',
            'Kecamatan',
            'Kelurahan',
            // 'Dibuat Pada',
            'Update Terakhir',
        ];
    }

    public function map($container): array
    {
        $this->number++;

        return [
            $this->number,
            $container->kode_containers,
            $container->nama_lokasi,
            $container->persen,
            $container->status,
            $container->baterai,
            $container->status_system,
            $container->latitude,
            $container->longitude,
            $container->kelurahan->kecamatan->nama_kecamatan ?? '-',
            $container->kelurahan->nama_kelurahan ?? '-',
            // $container->created_at,
            $container->updated_at,
        ];
    }
}