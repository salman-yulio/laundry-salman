<?php

namespace App\Http\Controllers;

use App\Models\Paket;
use App\Models\Outlet;
use Illuminate\Http\Request;
use App\Exports\PaketExport;
use App\Imports\PaketImport;
use Maatwebsite\Excel\Facades\Excel;

class PaketController extends Controller
{
    /**
     * Menampilkan view dan mengirimkan data dari model
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.paket.index', [
            'paket' => Paket::all(),
            'outlet' => Outlet::all()
        ]);
    }

    /**
     * Menampilkan view create data
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.paket.create', [
            'outlet' => Outlet::all()
        ]);
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
            'id_outlet' => 'required',
            'jenis' => 'required',
            'nama_paket' => 'required',
            'harga' => 'required'
        ]);

        Paket::create($validatedData);

        return redirect(request()->segment(1) . '/paket')->with('success', 'Data baru telah ditambahkan!');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Paket  $paket
     * @return \Illuminate\Http\Response
     */
    public function edit(Paket $paket)
    {
        return view('dashboard.paket.edit', [
            'paket' => paket::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Paket  $paket
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Paket $paket)
    {
        $validatedData = $request->validate([
            'id_outlet' => 'required',
            'jenis' => 'required',
            'nama_paket' => 'required',
            'harga' => 'required'
        ]);

        Paket::where('id', $paket->id)
            ->update($validatedData);

        return redirect(request()->segment(1) . '/paket')->with('success', 'Data telah diubah!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Paket  $paket
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $validatedData = Paket::find($id);
        $validatedData->delete();
        return redirect(request()->segment(1) . '/paket')->with('success', 'Data telah dihapus!');
    }

    /**
     * Melakukan export data dari view dan database menjadi file excel
     */
    public function exportPaket()
    {
        return Excel::download(new PaketExport, 'paket.xlsx');
    }

    /**
     * Melakukan upload data excel dan meng importnya untuk dimasukan ke dalam database
     * dan menampilkan datanya ke view
     */
    public function import(Request $request)
    {
        $request->validate([
            'file2' => 'file|required|mimes:xlsx',
        ]);

        if ($request) {
            Excel::import(new PaketImport, $request->file('file2'));
        } else {
            return back()->withErrors([
                'file2' => 'file belum terisi',
            ]);
        }

        return redirect(request()->segment(1) . '/paket')->with('success', 'Data berhasil diimport!');
        // return redirect()->route('paket.index')->with('success', 'Data berhasil diimport!');
    }
}
