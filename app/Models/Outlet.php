<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Outlet extends Model
{
    use HasFactory;

    protected $primarykey = 'id';
    public $incrementing = true;
    protected $table = 'outlet';
    protected $guarded = ['id'];

    public function paket()
    {
        return $this->hasMany(Paket::class, 'id_outlet');
    }

    public function user()
    {
        return $this->hasMany(User::class, 'id_outlet');
    }

}
