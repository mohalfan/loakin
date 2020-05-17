<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Toko extends Model
{
    protected $fillable = [
        'id', 'id_owner', 'nama_toko', 'alamat','phone','foto','created_at','updated_at'
    ];
}
