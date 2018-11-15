<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Warna;
class WarnaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $warna = Warna::all();
        return $warna;
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
            'nama' => 'required|max:255',
            'kodeWarna' => 'required',
          ]);

          $warna = new Warna();
          $warna->nama = $request->nama;
          $warna->kodeWarna = $request->kodeWarna;
          $warna->save();

          return $warna;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        $item = Warna::findOrFail($id);
        if($item->count()>0){
            $item->delete();
            return response()->json(['status'=>'success','msg'=>'Data berhasil dihapus']);
        } else {
            return response()->json(['status'=>'error','msg'=>'Gagal menghapus data']);
        }
    }
}
