<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;
    protected $table = "transaksi";
    protected $guarded = ['id'];

    /**
     * untuk merelasikan model transaksi dengan model outlet sesuai id_outlet yang berada di model transaksi
     */
    public function outlet()
    {
        return $this->belongsTo(outlet::class, 'id_outlet');
    }

    /**
     * untuk merelasikan model transaksi dengan model member sesuai id_member yang berada di model transaksi
     */
    public function member()
    {
        return $this->belongsTo(member::class, 'id_member');
    }

    /**
     * untuk merelasikan model transaksi dengan model user sesuai id_user yang berada di model transaksi
     */
    public function user()
    {
        return $this->belongsTo(user::class, 'id_user');
    }
}
