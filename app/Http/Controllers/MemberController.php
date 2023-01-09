<?php

namespace App\Http\Controllers;

use App\Models\Member;
use Illuminate\Http\Request;
use App\Exports\MemberExport;
use App\Imports\MemberImport;
use Maatwebsite\Excel\Facades\Excel;

class MemberController extends Controller
{
    /**
     * Menampilkan view dan mengirimkan data dari model
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.member.index', [
            'member' => member::all()
        ]);
    }

    /**
     * Menampilkan view create data
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.member.create');
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
            'jenis_kelamin' => 'required',
            'telepon' => 'required'
        ]);

        Member::create($validatedData);

        return redirect(request()->segment(1) . '/member')->with('success', 'Data baru telah ditambahkan!');
    }

    /**
     * Menampilkan view edit dan menampilkan data yang akan diupdate
     *
     * @param  \App\Models\Member  $member
     * @return \Illuminate\Http\Response
     */
    public function edit(Member $member)
    {
        return view('dashboard.member.edit', [
            'member' => $member
        ]);
    }

    /**
     * Proses update data
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Member  $member
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Member $member)
    {
        $validatedData = $request->validate([
            'nama' => 'required',
            'alamat' => 'required',
            'jenis_kelamin' => 'required',
            'telepon' => 'required'
        ]);

        Member::where('id', $member->id)
            ->update($validatedData);

        return redirect(request()->segment(1) . '/member')->with('success', 'Data telah diubah!');
    }

    /**
     * Menghapus data sesuai id
     *
     * @param  \App\Models\Member  $member
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $validatedData = Member::find($id);
        $validatedData->delete();
        return redirect(request()->segment(1) . '/member')->with('success', 'Data telah dihapus!');
    }

    /**
     * Melakukan export data dari view dan database menjadi file excel
     */
    public function exportMember()
    {
        return Excel::download(new MemberExport, 'member.xlsx');
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
            Excel::import(new MemberImport, $request->file('file2'));
        } else {
            return back()->withErrors([
                'file2' => 'file belum terisi',
            ]);
        }

        return redirect(request()->segment(1) . '/member')->with('success', 'Data berhasil diimport!');
        // return redirect()->route('member.index')->with('success', 'Data berhasil diimport!');
    }
}
