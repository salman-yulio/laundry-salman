<?php

namespace App\Http\Controllers;

use App\Models\Penjemputan;
use App\Models\Member;
use Illuminate\Http\Request;
use App\Imports\PenjemputanImport;
use App\Exports\PenjemputanExport;
use Maatwebsite\Excel\Facades\Excel;

class PenjemputanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.penjemputan.index', [
            'penjemputan' => Penjemputan::all(),
            'member' => Member::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.penjemputan.create', [
            'member' => Member::all()
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
            'id_member' => 'required',
            'petugas' => 'required',
            'status' => 'required'
        ]);

        Penjemputan::create($validatedData);

        return redirect(request()->segment(1) . '/penjemputan')->with('success', 'Data baru telah ditambahkan!');
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
        return view('dashboard.penjemputan.edit', [
            'penjemputan' => Penjemputan::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Penjemputan $penjemputan)
    {
        $validatedData = $request->validate([
            'id_member' => 'required',
            'petugas' => 'required',
            'status' => 'required'
        ]);

        Penjemputan::where('id', $penjemputan->id)
            ->update($validatedData);

        return redirect(request()->segment(1) . '/penjemputan')->with('success', 'Data telah diubah!');
    }

    public function status(request $request)
    {
        $data = Penjemputan::where('id', $request->id)->first();
        $data->status = $request->status;
        $update = $data->save();

        return 'Data Gagal Ditarik';
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $validatedData = Penjemputan::find($id);
        $validatedData->delete();
        return redirect(request()->segment(1) . '/penjemputan')->with('success', 'Data telah dihapus!');
    }

        public function exportData()
    {
        $date =  date('Y-m-d H:i:s');
        return Excel::download(new PenjemputanExport, $date . '_penjemputan.xlsx');
    }

    public function importData(Request $request)
    {
        $request->validate([
            'file2' => 'file|mimes:xlsx, xls, xlsm, xlsb'
        ]);

        if ($request) {
            Excel::import(new PenjemputanImport, $request->file('file2'));
        } else {
            return back()->withErrors([
                'file2' => "File Bukan Excel"
            ]);
        }

        return back()->with('success', 'All good!');
    }
}
