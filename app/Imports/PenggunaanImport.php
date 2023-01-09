<?php

namespace App\Imports;

use App\Models\Penggunaan;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithLimit;

class PenggunaanImport implements ToModel, WithHeadingRow
{
    /**
     * @param Collection $collection
     */
    public function model(array $row)
    {
        return new Penggunaan([
            'nama' => $row['nama_barang'],
            'qty' => $row['qty'],
            'harga' => $row['harga'],
            'waktu_beli' => $row['waktu_beli'],
            'supplier' => $row['supplier'],
            'status' => $row['status'],
        ]);
    }

    public function headingrow(): int
    {
        return 3;
    }
}
