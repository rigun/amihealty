<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Subkategori;
use App\Kategori;
class SubkategoriController extends Controller
{
    private $photos_path;
 
    public function __construct()
    {
        $this->photos_path = public_path('/images/kategori/subkategori');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subkategori = Subkategori::with('kategori')->get();
        return $subkategori;
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
            'name' => 'required',
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
        $subkategori = new Subkategori();
        $subkategori->name = $request->name;
        $subkategori->filename = $save_name;
        $subkategori->originalName = basename($photo->getClientOriginalName());
        $subkategori->save();

        $kategori = Kategori::findOrFail($request->kategori_id); 

        $kategori->subkategori()->attach($subkategori);
        

        return response()->json(['status' => 'success','msg'=>'Subkategori berhasil dibuat']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($kategori)
    {
        $kategori = Kategori::where('name',$kategori)->first();
        $subkategori = $kategori->subkategori;
        return $subkategori;
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
        $uploaded_image = Subkategori::findOrFail($id);
 
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
}
