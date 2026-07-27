<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class PetugasExport implements FromCollection, WithHeadings, WithMapping, WithStyles
{
    public function collection()
    {
        return User::where('role', 'petugas')->get();
    }

    public function headings(): array
    {
        return [
            'No',
            'Nama Lengkap',
            'Username',
            'Email',
            'NIK',
            'Jenis Kelamin',
            'Tanggal Lahir',
            'No HP',
            'Wilayah Tugas',
            'Alamat',
            'Status',
        ];
    }

    public function map($row): array
    {
        static $no = 0;
        $no++;
        return [
            $no,
            $row->nama_lengkap,
            $row->username,
            $row->email,
            $row->nik,
            $row->jenis_kelamin,
            $row->tanggal_lahir,
            $row->no_hp,
            $row->wilayah_tugas,
            $row->alamat,
            $row->status,
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => [
                'font' => ['bold' => true, 'color' => ['rgb' => 'FFFFFF']],
                'fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '0F6E56']],
            ],
        ];
    }
}