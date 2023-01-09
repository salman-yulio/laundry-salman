<?php

namespace App\Imports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class UserImport implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new User([
            'name' => $row['nama'],
            'username' => $row['username'],
            'email' => $row['email'],
            'harga' => $row['outlet'],
            'role' => $row['role']
        ]);
    }

    public function headingRow(): int
    {
        return 3;
    }
}
