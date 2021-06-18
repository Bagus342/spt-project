<?php

namespace App\Http\Controllers;

use App\Models\Wilayah;
use Illuminate\Http\Request;

class WilayahController extends Controller
{
    // CRUD Wilayah ya Guys

    public function index()
    {
        return view('tampil-data-wilayah', [
            'wilayah' => Wilayah::get()
        ]);
    }

    public function add(Request $req)
    {
        return Wilayah::insert([
            'nama_wilayah' => $req->nama_wilayah,
            'harga_wilayah' => $req->harga_wilayah,
        ])
            ? redirect('/wilayah')->with('success', 'data berhasil di tambah')
            : redirect()->back()->with('error', 'data gagal di tambah');
    }

    public function update(Request $req, $id)
    {
        return Wilayah::where('id_wilayah', $id)->update([
            'nama_wilayah' => $req->nama_wilayah,
            'harga_wilayah' => $req->harga_wilayah,
        ])
            ? redirect('/wilayah')->with('success', 'data berhasil di update')
            : redirect()->back()->with('error', 'data gagal di update');
    }

    public function delete($id)
    {
        return Wilayah::where('id_wilayah', $id)->delete()
            ? redirect('/wilayah')->with('success', 'data berhasil di delete')
            : redirect()->back()->with('error', 'data gagal di delete');
    }

    public function getUpdate($id)
    {
        return response()->json([
            'data_update' => Wilayah::where('id_wilayah', $id)->first(),
        ]);
    }

    public function viewAdd()
    {
        return view('wilayah');
    }
}