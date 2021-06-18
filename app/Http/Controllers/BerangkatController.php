<?php

namespace App\Http\Controllers;

use App\Models\Berangkat;
use App\Models\Petani;
use App\Models\Pg;
use App\Models\Sopir;
use App\Models\Wilayah;
use Illuminate\Http\Request;

class BerangkatController extends Controller
{

    public function index(Berangkat $berangkat)
    {
        return view('tampil-data-berangkat', [
            'data' => $berangkat->whereDate('created_at', now())->get()
        ]);
    }

    public function addView()
    {
        $data = ['sopir' => Sopir::get(), 'wilayah' => Wilayah::get(), 'pg' => Pg::get(), 'petani' => Petani::get()];
        return view('berangkat', $data);
    }

    public function add(Request $req)
    {
        return Berangkat::insert([
            'tanggal_berangkat' => $req->tanggal_berangkat,
            'tipe' => $req->tipe,
            'no_sp' => $req->no_sp,
            'no_induk' => $req->no_induk,
            'wilayah' => $req->wilayah,
            'nama_petani' => $req->nama_petani,
            'nama_sopir' => $req->nama_sopir,
            'pabrik_tujuan' => $req->pabrik_tujuan,
            'sangu' => $req->sangu,
            'berat_timbang' => $req->berat_timbang,
            'tara_mbl' => $req->tara_mbl,
            'netto' => $req->netto,
            'harga' => $req->harga,
        ])
            ? redirect('/berangkat')->with('success', 'sukses tambah data')
            : redirect()->back()->with('error', 'gagal menambah data');
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
}