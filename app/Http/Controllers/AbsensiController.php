<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
// use App\Http\Requests\StoreAbsensiRequest;
// use App\Http\Requests\UpdateAbsensiRequest;
use Illuminate\Http\Request;
use App\Exports\AbsensiExport;
use App\Imports\AbsensiImport;
use Maatwebsite\Excel\Facades\Excel;

class AbsensiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.absensi.index', [
            'absensi' => Absensi::all()
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
            'tanggal_masuk' => 'required',
            'waktu_masuk' => 'required',
            'status' => 'required',
        ]);

        Absensi::create($validatedData);

        return redirect(request()->segment(1) . '/absensi')->with('success', 'Data baru telah ditambahkan!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Absensi  $absensi
     * @return \Illuminate\Http\Response
     */
    public function show(Absensi $absensi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Absensi  $absensi
     * @return \Illuminate\Http\Response
     */
    public function edit(Absensi $absensi)
    {
        return view('dashboard.absensi.edit', [
            'absensi' => Absensi::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Absensi  $absensi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Absensi $absensi)
    {
        $validatedData = $request->validate([
            'nama' => 'required',
            'tanggal_masuk' => 'required',
            'waktu_masuk' => 'required'
        ]);

        Absensi::where('id', $absensi->id)
            ->update($validatedData);

        return redirect(request()->segment(1) . '/absensi')->with('success', 'Data telah diubah!');
    }


    public function status(request $request)
    {
        $data = Absensi::where('id', $request->id)->first();
        $data->status = $request->status;
        if (request()->status == 'masuk') {
            $data->waktu_selesai = now();
        } else {
            $data->waktu_selesai = '00:00:00';
        }
        $update = $data->save();

        return response()->json([
            'waktu_selesai' => date('h:i:s', strtotime($data->waktu_selesai))
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
        $validatedData = Absensi::find($id);
        $validatedData->delete();
        return redirect(request()->segment(1) . '/absensi')->with('success', 'Data telah dihapus!');
    }

    public function exportData()
    {
        $date =  date('Y-m-d H:i:s');
        return Excel::download(new AbsensiExport, $date . '_absensi.xlsx');
    }

    public function importData(Request $request)
    {
        $request->validate([
            'file2' => 'file|mimes:xlsx, xls, xlsm, xlsb'
        ]);

        if ($request) {
            Excel::import(new AbsensiImport, $request->file('file2'));
        } else {
            return back()->withErrors([
                'file2' => "File Bukan Excel"
            ]);
        }

        return back()->with('success', 'Impor data berhasil!');
    }
}
