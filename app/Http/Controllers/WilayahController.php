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
            'wilayah' => Wilayah::get(),
            'title' => 'Wilayah'
        ]);
    }

    public function add(Request $req)
    {
        $trimHarga = explode(' ', $req->harga_wilayah);
        return Wilayah::insert([
            'nama_wilayah' => $req->nama_wilayah,
            'harga_wilayah' => str_replace('.', '', $trimHarga[1]),
        ])
            ? redirect('/wilayah')->with('sukses', 'data berhasil di tambah')
            : redirect()->back()->with('error', 'data gagal di tambah');
    }

    public function update(Request $req, $id)
    {
        $trimHarga = explode(' ', $req->harga_wilayah);
        return Wilayah::where('id_wilayah', $id)->update([
            'nama_wilayah' => $req->nama_wilayah,
            'harga_wilayah' => str_replace('.', '', $trimHarga[1]),
        ])
            ? redirect('/wilayah')->with('sukses', 'data berhasil di update')
            : redirect()->back()->with('error', 'data gagal di update');
    }

    public function delete($id)
    {
        return Wilayah::where('id_wilayah', $id)->delete()
            ? redirect('/wilayah')->with('sukses', 'data berhasil di delete')
            : redirect()->back()->with('error', 'data gagal di delete');
    }

    public function getUpdate($id)
    {
        return response()->json([
            'data_update' => Wilayah::where('id_wilayah', $id)->first(),
        ]);
    }

    public function getHarga($id)
    {
        return response()->json([
            'data' => Wilayah::select('id_wilayah', 'harga_wilayah')->where('nama_wilayah', $id)->get()
        ]);
    }

    public function search()
    {
        $trim = explode(' ', request('name'));
        if (count($trim) === 2) {
            $param = '%' . $trim[1] . '%';
            $data = Wilayah::where('harga_wilayah', 'LIKE', $param)->get();
            return response()->json(['data' => $data]);
        } else {
            $param = '%' . request('name') . '%';
            $data = Wilayah::where('nama_wilayah', 'LIKE', $param)->get();
            return response()->json(['data' => $data]);
        }
    }

    public function updateHarga()
    {
        return response()->json([
            'status' => Wilayah::where('id_wilayah', request('id'))->update([
                'harga_wilayah' => request('harga')
            ]) ? 'sukses' : 'gagal'
        ]);
    }

    public function viewAdd()
    {
        return view('wilayah', [
            'title' => 'Tambah | Wilayah'
        ]);
    }
}
