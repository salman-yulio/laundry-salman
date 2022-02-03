<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Outlet extends Model
{
    use HasFactory;

    protected $primarykey = 'id';
    public $incrementing = false;
    protected $table = 'outlet';
    protected $guarded = ['id'];

    public function paket()
    {
        return $this->hasMany(Paket::class);
    }

}
