<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    protected $fillable=[
    	'id_kategori','id_toko','nama_barang','deskripsi','harga','stok','foto'
    ];
}
