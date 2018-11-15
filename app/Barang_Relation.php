<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Barang_Relation extends Model
{
    public function barang(){
        return $this->belongsTo('App\Barang','barang_id');
    }
    public function kategori(){
        return $this->belongsTo('App\Kategori','kategori_id');
    }
    public function subkategori(){
        return $this->belongsTo('App\Subkategori','subkategori_id');
    }
}
