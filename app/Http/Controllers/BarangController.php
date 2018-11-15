<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Barang;
use App\Kategori;
use App\Barang_Relation;
use App\Warna;
use App\Ukuran;
use JWTAuth;

class BarangController extends Controller
{
    private $photos_path;
 
    public function __construct()
    {
        $this->photos_path = public_path('/images/barang');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $barang = Barang::with(['kategori','subkategori'])->get();
        return $barang;
    }
    public function newItem()
    {
        $barang = Barang::orderby('created_at','desc')->with('subkategori')->get();
        return $barang;
    }
    public function detailBarang($slug)
    {
        $barang = Barang::where('slug',$slug)->with(['ukuran','warna','kategori'])->first();
        return $barang;
    }
    public function recomendedItem(){
        $barang = Barang::inRandomOrder()->with('subkategori')->get();
        return $barang;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validateWith([
            'nama' => 'required',
            'deskripsi' => 'required',
            'berat' => 'required',
            'harga' => 'required',
            'stok' => 'required',
            'slug' => 'required',
          ]);

          $photos = $request->file('file');
 
        if (!is_array($photos)) {
            $photos = [$photos];
        }

        if (!is_dir($this->photos_path)) {
            mkdir($this->photos_path, 0777);
        }

        $photo = $photos[0];
        $name = sha1(date('YmdHis') . str_random(30));
        $save_name = $name . '.' . $photo->getClientOriginalExtension();

        $photo->move($this->photos_path, $save_name);
        $barang = new Barang();
        $barang->nama = $request->nama;
        $barang->slug = $request->slug;
        $barang->filename = $save_name;
        $barang->originalName = basename($photo->getClientOriginalName());
        $barang->deskripsi = $request->deskripsi;
        $barang->berat = $request->berat;
        $barang->harga = $request->harga;
        $barang->stok = $request->stok;
        $barang->id_pemilik = $user = JWTAuth::parseToken()->authenticate()->id;
        $barang->save();

        $arr = json_decode($request->sub);
        $warnas = json_decode($request->warna);
        $ukurans = json_decode($request->ukuran);
        foreach($arr as $subcategory){
            $relation = new Barang_Relation();
            $relation->barang()->associate($barang);
            $relation->kategori_id = $request->kat_id;
            $relation->subkategori_id = $subcategory;
            $relation->save();
        };
        foreach($warnas as $warna){
            $data = Warna::findOrFail($warna);
            $barang->warna()->attach($data);
        };
        foreach($ukurans as $ukuran){
            $data = Ukuran::findOrFail($ukuran);
            $barang->ukuran()->attach($data);
        };

          return response()->json(['status' => 'success','msg'=>'Kategori berhasil dibuat']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($kategori, $subkategori)
    {
        $kategori = Kategori::where('name', $kategori)->first();
        $subkategori = $kategori->subkategori()->where('name', $subkategori)->first();
        $barang = $subkategori->barang;
        return $barang;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $uploaded_image = Barang::findOrFail($id);
 
        if (empty($uploaded_image)) {
            return response()->json(['message' => 'Sorry file does not exist'], 400);
        }
 
        $file_path = $this->photos_path . '/' . $uploaded_image->filename;
 
        if (file_exists($file_path)) {
            unlink($file_path);
        }
 
        if (!empty($uploaded_image)) {
            $uploaded_image->delete();
        }
        
        return "Terhapus";
    }

    public function apiCheckUnique(Request $request)
    {
        return json_encode(!Barang::where('slug', '=', $request->slug)->exists());
    }
}
