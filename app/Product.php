<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['kd_barang', 'nama_barang', 'jumlah', 'harga'];
}
