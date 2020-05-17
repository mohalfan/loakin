<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Keranjang extends Model
{
    protected $fillable = [
        'id_user', 'id_toko','id_barang','qty','total','status','created_at','updated_at'
    ];
}
