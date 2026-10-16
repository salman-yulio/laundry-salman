<?php

namespace App\Imports;

use App\Models\Outlet;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class UserImport implements ToModel, WithHeadingRow
{
    public const PASSWORD_AWAL = 'password123';

    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row): \Illuminate\Database\Eloquent\Model|array|null
    {
        // Lewati user yang sudah ada (email/username unik), misalnya saat mengimpor ulang file hasil export
        if (User::where('email', $row['email'])->orWhere('username', $row['username'])->exists()) {
            return null;
        }

        // Kolom "Outlet" berisi nama outlet (sesuai UserExport), jadi cari id-nya
        $idOutlet = Outlet::where('nama', $row['outlet'])->value('id');
        if (!$idOutlet) {
            return null;
        }

        return new User([
            'name' => $row['nama'],
            'username' => $row['username'],
            'email' => $row['email'],
            'id_outlet' => $idOutlet,
            'role' => $row['role'],
            // File export tidak berisi password, jadi user hasil import diberi password awal
            'password' => Hash::make(self::PASSWORD_AWAL),
        ]);
    }

    public function headingRow(): int
    {
        return 3;
    }
}
