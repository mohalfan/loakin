<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    protected $fillable = [
    	'id', 'id_toko', 'id_user', 'rating', 'komentar','created_at','updated_at'
    ];
}
