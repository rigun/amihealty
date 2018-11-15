<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bag extends Model
{
    public function barang(){
        return $this->belongsTo('App\Barang','barang_id');
    }
    public function warna(){
        return $this->belongsTo('App\Warna','warna_id');
    }
    public function ukuran(){
        return $this->belongsTo('App\Ukuran','ukuran_id');
    }
    public function pemilik(){
        return $this->belongsTo('App\User','pemilik_id');
    }
}
