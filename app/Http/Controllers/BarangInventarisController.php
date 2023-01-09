<?php

namespace App\Http\Controllers;

use App\Models\BarangInventaris;
use Illuminate\Http\Request;

class BarangInventarisController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.inventaris.index',[
            'barang_inventaris' => BarangInventaris::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.inventaris.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama_barang' => 'required',
            'merk_barang' => 'required',
            'qty' => 'required',
            'kondisi' => 'required',
            'tanggal_pengadaan' => 'required'
        ]);

        BarangInventaris::create($validatedData);

        return redirect(request()->segment(1).'/inventaris')->with('success', 'Data Baru telah ditambahkan!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\BarangInventaris  $barang_inventaris
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\BarangInventaris  $barang_inventaris
     * @return \Illuminate\Http\Response
     */
    public function edit(BarangInventaris $barang_inventaris)
    {
        return view('dashboard.inventaris.edit', [
            'barang_inventaris' => $barang_inventaris
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\BarangInventaris  $barang_inventaris
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BarangInventaris $barang_inventaris, $id)
    {
        $validatedData = $request->validate([
            'nama_barang' => 'required',
            'merk_barang' => 'required',
            'qty' => 'required',
            'kondisi' => 'required',
            'tanggal_pengadaan' => 'required'
        ]);

        BarangInventaris::where('id', $barang_inventaris->id)
            ->update($validatedData);

        return redirect(request()->segment(1).'/inventaris')->with('success', 'Data telah diubah!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\BarangInventaris  $barang_inventaris
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $validatedData = BarangInventaris::find($id);
        $validatedData->delete();
        return redirect(request()->segment(1).'/inventaris')->with('success', 'Data telah dihapus!');;
    }
}
