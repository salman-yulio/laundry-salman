<?php

namespace App\Imports;

use App\Models\Absensi;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithLimit;

class AbsensiImport implements ToModel, WithHeadingRow
{
    /**
     * @param Collection $collection
     */
    public function model(array $row)
    {
        return new Absensi([
            'nama' => $row['nama_karyawan'],
            'tanggal_masuk' => $row['tanggal_masuk'],
            'waktu_masuk' => $row['waktu_masuk'],
            'status' => $row['status'],
            'waktu_selesai' => $row['waktu_selesai_kerja'],
        ]);
    }

    public function headingrow(): int
    {
        return 3;
    }
}
