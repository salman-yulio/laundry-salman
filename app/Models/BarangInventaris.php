<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BarangInventaris extends Model
{
    use HasFactory;

    protected $primarykey = 'id';
    public $incrementing = true;
    protected $table = 'barang_inventaris';
    protected $guarded = ['id'];
}
