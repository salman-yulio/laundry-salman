<?php

namespace App\Http\Controllers;

use App\Models\Outlet;
use Illuminate\Http\Request;
use App\Exports\OutletExport;
use App\Imports\OutletImport;
use Maatwebsite\Excel\Facades\Excel;

class OutletController extends Controller
{
    /**
     * Menampilkan view dan mengirimkan data dari model
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.outlet.index', [
            'outlet' => outlet::all()
        ]);
    }

    /**
     * Menampilkan view create data
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.outlet.create');
    }

    /**
     * Menyimpan data ke database
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama' => 'required',
            'alamat' => 'required',
            'telepon' => 'required'
        ]);

        Outlet::create($validatedData);

        return redirect(request()->segment(1) . '/outlet')->with('success', 'Data baru telah ditambahkan!');
    }

    /**
     * Menampilkan view edit dan menampilkan data yang akan diupdate
     *
     * @param  \App\Models\Outlet  $outlet
     * @return \Illuminate\Http\Response
     */
    public function edit(Outlet $outlet)
    {
        return view('dashboard.outlet.edit', [
            'outlet' => $outlet
        ]);
    }

    /**
     * Proses update data
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Outlet  $outlet
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Outlet $outlet)
    {
        $validatedData = $request->validate([
            'nama' => 'required',
            'alamat' => 'required',
            'telepon' => 'required'
        ]);

        Outlet::where('id', $outlet->id)
            ->update($validatedData);

        return redirect(request()->segment(1) . '/outlet')->with('success', 'Data telah diubah!');
    }

    /**
     * Menghapus data sesuai id
     *
     * @param  \App\Models\Outlet  $outlet
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $validatedData = Outlet::find($id);
        $validatedData->delete();
        return redirect(request()->segment(1) . '/outlet')->with('success', 'Data telah dihapus!');
    }

    /**
     * Melakukan export data dari view dan database menjadi file excel
     */
    public function exportOutlet()
    {
        return Excel::download(new OutletExport, 'outlet.xlsx');
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
            Excel::import(new OutletImport, $request->file('file2'));
        } else {
            return back()->withErrors([
                'file2' => 'file belum terisi',
            ]);
        }

        // return redirect(request()->segment(1).'/outlet')->route('outlet.index')->with('success', 'Data berhasil diimport!');
        return redirect()->route('outlet.index')->with('success', 'Data berhasil diimport!');
    }
}
