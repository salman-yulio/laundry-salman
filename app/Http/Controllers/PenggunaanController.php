<?php

namespace App\Http\Controllers;

use App\Models\Penggunaan;
use Illuminate\Http\Request;
// use App\Http\Requests\StorePenggunaanRequest;
// use App\Http\Requests\UpdatePenggunaanRequest;
use App\Exports\PenggunaanExport;
use App\Imports\PenggunaanImport;
use Maatwebsite\Excel\Facades\Excel;

class PenggunaanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.penggunaan.index', [
            'penggunaan' => Penggunaan::all()
        ]);
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
        $validatedData = $request->validate([
            'nama' => 'required',
            'qty' => 'required',
            'harga' => 'required',
            'waktu_beli' => 'required',
            'supplier' => 'required',
            'status' => 'required'
        ]);

        Penggunaan::create($validatedData);

        return redirect(request()->segment(1) . '/penggunaan')->with('success', 'Data baru telah ditambahkan!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Penggunaan  $penggunaan
     * @return \Illuminate\Http\Response
     */
    public function show(Penggunaan $penggunaan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Penggunaan  $penggunaan
     * @return \Illuminate\Http\Response
     */
    public function edit(Penggunaan $penggunaan)
    {
        return view('dashboard.penggunaan.edit', [
            'penggunaan' => Penggunaan::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Penggunaan  $penggunaan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Penggunaan $penggunaan)
    {
        $validatedData = $request->validate([
            'nama' => 'required',
            'qty' => 'required',
            'harga' => 'required',
            'waktu_beli' => 'required',
            'supplier' => 'required'
        ]);

        Penggunaan::where('id', $penggunaan->id)
            ->update($validatedData);

        return redirect(request()->segment(1) . '/penggunaan')->with('success', 'Data telah diubah!');
    }

    public function status(request $request)
    {
        $data = Penggunaan::where('id', $request->id)->first();
        $data->status = $request->status;
        $data->update_status = now();
        $update = $data->save();

        return response()->json([
            'update_status' => date('Y-m-d h:i:s', strtotime($data->update_status))
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $validatedData = Penggunaan::find($id);
        $validatedData->delete();
        return redirect(request()->segment(1) . '/penggunaan')->with('success', 'Data telah dihapus!');
    }

    public function exportData()
    {
        $date =  date('Y-m-d H:i:s');
        return Excel::download(new PenggunaanExport, $date . '_penggunaan.xlsx');
    }

    public function importData(Request $request)
    {
        $request->validate([
            'file2' => 'file|mimes:xlsx, xls, xlsm, xlsb'
        ]);

        if ($request) {
            Excel::import(new PenggunaanImport, $request->file('file2'));
        } else {
            return back()->withErrors([
                'file2' => "File Bukan Excel"
            ]);
        }

        return back()->with('success', 'All good!');
    }
}
