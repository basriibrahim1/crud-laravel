<?php

namespace App\Http\Controllers;

use App\Models\mahasiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class MahasiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = $request->katakunci;
        if(strlen($query)){
            $data = mahasiswa::where('nim', 'like', "%$query%")
                    ->orWhere('nama', 'like', "%$query%")
                    ->orWhere('jurusan', 'like', "%$query%")
                    ->paginate(2);
        } else {
            $data = mahasiswa::orderBy('nim','desc')->paginate(2);
        }
        return view('mahasiswa.index')->with('data', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if(Auth::user()->role == 'admin'){
            return view('mahasiswa.create');
        }
        return redirect('/mahasiswa');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Session::flash('nim',$request->nim);
        Session::flash('nama',$request->nama);
        Session::flash('jurusan',$request->jurusan);

        $request->validate([
            'nim'=>'required|numeric|unique:mahasiswa,nim',
            'nama'=>'required',
            'jurusan'=>'required',
        ],[
            'nim.required'=>'NIM wajib diisi',
            'nim.numeric'=>'NIM wajib angka',
            'nim.unique'=>'NIM yang diisikan sudah ada dalam database',
            'nama.required'=>'Nama wajib diisi',
            'jurusan.required'=>'Jurusan wajib diisi',
        ]);
        $data = [
            'nim'=>$request->nim,
            'nama'=>$request->nama,
            'jurusan'=>$request->jurusan,
        ];
        mahasiswa::create($data);
        return redirect()->to('mahasiswa')->with('success','Berhasil menambahkan data mahasiswa');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = mahasiswa::where('nim',$id)->first();
        return view('mahasiswa.edit')->with('data', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            
            'nama'=>'required',
            'jurusan'=>'required',
        ],[
            'nama.required'=>'Nama wajib diisi',
            'jurusan.required'=>'Jurusan wajib diisi',
        ]);
        $data = [
            'nama'=>$request->nama,
            'jurusan'=>$request->jurusan,
        ];
        mahasiswa::where('nim', $id)->update($data);
        return redirect()->to('mahasiswa')->with('success','Berhasil mengupdate data mahasiswa');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
       mahasiswa::where('nim', $id)->delete();
       return redirect()->to('mahasiswa')->with('success','Berhasil menghapus data mahasiswa');
    }
}
