<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Barang_Relation;

class Subkategori extends Model
{
    public function kategori(){
        return $this->belongsToMany('App\Kategori','kategoris_subkategoris','subkategori_id','kategori_id');
    }
    function relations() {
        return $this->hasMany(Barang_Relation::class);
     }
     public function barang(){
        return $this->belongsToMany('App\Barang','barang__relations','subkategori_id','barang_id');
    }
}
