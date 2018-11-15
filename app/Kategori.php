<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Barang_Relation;

class Kategori extends Model
{
    public function subkategori(){
        return $this->belongsToMany('App\Subkategori','kategoris_subkategoris','kategori_id','subkategori_id');
    }
    function relations() {
        return $this->hasMany(Barang_Relation::class);
     }
}
