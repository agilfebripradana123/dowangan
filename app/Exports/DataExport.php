<?php

namespace App\Exports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class DataExport implements FromCollection, WithHeadings
{
    protected $filtered;

    public function __construct($filtered)
    {
        $this->filtered = $filtered;
    }

    public function collection()
    {
        return $this->filtered->map(function ($item) {
            return [
                'NIK' => $item->nik,
                'No KK' => $item->no_kk,
                'Nama Lengkap' => $item->nama_lengkap,
                'Alamat' => $item->alamat,
                'RT/RW' => $item->rt . '/' . $item->rw,
                'Tempat/Tgl Lahir' => $item->tempat_lahir . ', ' . $item->tanggal_lahir,
                'Jenis Kelamin' => $item->jenis_kelamin,
                'Agama' => $item->agama,
                'Pekerjaan' => $item->pekerjaan,
                'Tgl Input' => $item->created_at->format('Y-m-d'),
            ];
        });
    }

    public function headings(): array
    {
        return [
            'NIK', 'No KK', 'Nama Lengkap', 'Alamat', 'RT/RW', 'Tempat/Tgl Lahir', 'Jenis Kelamin',
            'Agama', 'Pekerjaan', 'Tgl Input',
        ];
    }
}
