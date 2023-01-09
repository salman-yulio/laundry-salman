<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Outlet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Exports\UserExport;
use App\Imports\UserImport;
use Maatwebsite\Excel\Facades\Excel;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.user.index', [
            'user' => User::all(),
            'outlet' => Outlet::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.user.create', [
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
            'name' => 'required',
            'username' => 'required',
            'email' => 'required',
            'password' => 'required',
            'id_outlet' => 'required',
            'role' => 'required'
        ]);

        $validatedData['password'] = Hash::make($validatedData['password']);
        User::create($validatedData);

        return redirect(request()->segment(1) . '/user')->with('success', 'Data baru telah ditambahkan!');
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
     * @param  \App\Models\user  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, user $user)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'email' => 'required',
            'id_outlet' => 'required',
            'role' => 'required'
        ]);


        user::where('id', $user->id)
            ->update($validatedData);

        return redirect(request()->segment(1) . '/user')->with('success', 'Post has been edited!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $validatedData = User::find($id);
        $validatedData->delete();
        return redirect(request()->segment(1) . '/user')->with('success', 'Data telah dihapus!');
    }

    public function exportData()
    {
        $date =  date('Y-m-d H:i:s');
        return Excel::download(new UserExport, $date . '_user.xlsx');
    }

    public function importData(Request $request)
    {
        $request->validate([
            'file2' => 'file|mimes:xlsx, xls, xlsm, xlsb'
        ]);

        if ($request) {
            Excel::import(new UserImport, $request->file('file2'));
        } else {
            return back()->withErrors([
                'file2' => "File Bukan Excel"
            ]);
        }

        return back()->with('success', 'Impor data berhasil!');
    }
}
