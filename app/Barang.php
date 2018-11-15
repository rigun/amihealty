<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Barang_Relation;
class Barang extends Model
{
   
    function relations() {
        return $this->hasMany(Barang_Relation::class);
     }
    public function kategori(){
        return $this->belongsToMany('App\Kategori','barang__relations','barang_id','kategori_id');
    }
    public function subkategori(){
        return $this->belongsToMany('App\Subkategori','barang__relations','barang_id','subkategori_id');
    }
    public function warna(){
        return $this->belongsToMany('App\Warna','barang_warna','barang_id','warna_id');
    }
    public function ukuran(){
        return $this->belongsToMany('App\Ukuran','barang_ukuran','barang_id','ukuran_id');
    }
}
