<?php

namespace App\Http\Controllers;

use App\Models\Berangkat;
use App\Models\Pembayaran;
use App\Models\Petani;
use App\Models\Pg;
use App\Models\Sopir;
use App\Models\Wilayah;
use Illuminate\Http\Request;

class BerangkatController extends Controller
{

    public function index(Berangkat $berangkat)
    {
        if (request('id') !== null) {
            $dau = $berangkat->where('id_keberangkatan', request('id'))->orderBy('id_keberangkatan', 'desc')->get();
            $update = ['sopir' => Sopir::get(), 'wilayah' => Wilayah::get(), 'pg' => Pg::get(), 'petani' => Petani::get(), 'data' => $dau];
            return view('tampil-data-berangkat', $update);
        } else {
            $list = $berangkat->whereDate('created_at', now())->orderBy('id_keberangkatan', 'desc')->get();
            $data = ['sopir' => Sopir::get(), 'wilayah' => Wilayah::get(), 'pg' => Pg::get(), 'petani' => Petani::get(), 'data' => $list, 'title' => 'Berangkat'];
            return view('tampil-data-berangkat', $data);
        }
    }

    public function addView()
    {
        $data = ['sopir' => Sopir::get(), 'wilayah' => Wilayah::get(), 'pg' => Pg::get(), 'petani' => Petani::get()];
        return view('berangkat', $data);
    }

    public function add(Request $req)
    {
        return Berangkat::insert([
            'tanggal_keberangkatan' => tanggal($req->tanggal_berangkat),
            'tipe' => $req->tipe,
            'no_sp' => $req->no_sp,
            'no_induk' => $req->no_induk,
            'wilayah' => $req->wilayah,
            'nama_petani' => $req->nama_petani,
            'nama_sopir' => $req->nama_sopir,
            'pabrik_tujuan' => $req->nama_pabrik,
            'sangu' => $req->sangu,
            'berat_timbang' => $req->berat_timbang,
            'tara_mbl' => $req->tara_mbl,
            'netto' => $req->netto,
            'harga' => $req->harga,
        ])
            ? redirect('/berangkat')->with('sukses', 'sukses tambah data')
            : redirect()->back()->with('error', 'gagal menambah data');
    }

    public function update(Request $req, $id)
    {
        return Berangkat::where('id_keberangkatan', $id)->update([
            'tanggal_keberangkatan' => tanggal($req->utanggal_berangkat),
            'tipe' => $req->utipe,
            'no_sp' => $req->uno_sp,
            'no_induk' => $req->uno_induk,
            'wilayah' => $req->uwilayah,
            'nama_petani' => $req->unama_petani,
            'nama_sopir' => $req->unama_sopir,
            'pabrik_tujuan' => $req->upabrik_tujuan,
            'sangu' => $req->usangu,
            'berat_timbang' => $req->uberat_timbang,
            'tara_mbl' => $req->utara_mbl,
            'netto' => $req->unetto,
            'harga' => $req->uharga,
        ])
            ? redirect('/berangkat')->with('sukses', 'sukses update data')
            : redirect()->back()->with('error', 'gagal menambah data');
    }

    public function delete($id)
    {
        return Berangkat::where('id_keberangkatan', $id)->delete()
            ? redirect('/berangkat')->with('sukses', 'sukses delete data')
            : redirect()->back()->with('error', 'gagal delete data');
    }

    public function search(Berangkat $berangkat)
    {
        return response()->json([
            'data' => $berangkat
                ->where('no_induk', 'LIKE', '%' . request('s') . '%')
                ->orWhere('wilayah', 'LIKE', '%' . request('s') . '%')
                ->orWhere('pabrik_tujuan', 'LIKE', '%' . request('s') . '%')
                ->get()
        ]);
    }

    public function filter(Request $req, Berangkat $berangkat)
    {
        return response()->json([
            'data' => $berangkat->whereBetween('created_at', [$req->tgl1, $req->tgl2])->get()
        ]);
    }

    public function getUpdate(Berangkat $berangkat, $id)
    {
        return response()->json([
            'data' => $berangkat->where('id_keberangkatan', $id)->first()
        ]);
    }

    public function cetak(Berangkat $berangkat)
    {
        return view('laporan-berangkat', [
            'data' => $berangkat->whereNull('tanggal_pulang')->whereDate('created_at', now())->get()
        ]);
    }
}
