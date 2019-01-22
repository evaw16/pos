<?php

namespace App\Http\Controllers;

use App\Barang;
use App\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BarangController extends Controller
{
  /**
  * Display a listing of the resource.
  *
  * @return \Illuminate\Http\Response
  */
  public function index()
  {
    $barang = Barang::join('suppliers', function ($join) {
      $join->on('barangs.id_supplier', '=', 'suppliers.id');
    })
    ->join('kategoris', function ($join) {
      $join->on('barangs.id_kategori', '=', 'kategoris.id_kategori');
    })
    ->get();
    return view('barang', ['barang' => $barang]);
  }

  /**
  * Show the form for creating a new resource.
  *
  * @return \Illuminate\Http\Response
  */
  public function create()
  {
    $supplier = Supplier::all();
    $kategori = DB::table('kategoris')->get();
    return view('create_barang', ['supplier' => $supplier, 'kategori' => $kategori]);
  }

  /**
  * Store a newly created resource in storage.
  *
  * @param  \Illuminate\Http\Request $request
  * @return \Illuminate\Http\Response
  */
  public function store(Request $request)
  {
    $this->validate($request, [
      'nama_barang' => 'required|string|max:255',
      'id_supplier' => 'required|integer',
      'id_kategori' => 'required|integer',
      'harga_beli' => 'required|integer',
      'harga_jual' => 'required|integer',
      'satuan_satu' => 'required|string',
      'stok' => 'required|integer',
      'satuan_terakhir' => 'required|string'
    ]);
    $barang = new Barang();
    $barang->nama_barang = $request->nama_barang;
    $barang->id_kategori = $request->id_kategori;
    $barang->id_supplier = $request->id_supplier;
    $barang->harga_beli = $request->harga_beli;
    $barang->harga_jual = $request->harga_jual;
    $laba = (($request->harga_jual - $request->harga_beli) / $request->harga_beli) * 100;
    $barang->laba = $laba;
    if ($request->satuan_terakhir == $request->satuan_satu) {
      $barang->stok = $request->stok;
      $barang->satuan_terakhir = $request->satuan_terakhir;
      $barang->satuan_satu = $request->satuan_satu;
      $barang->satuan_dua = $request->satuan_dua;
      $barang->stok_dua = $request->stok_dua;
      $barang->satuan_turunan_dua = $request->satuan_turunan_dua;
      $barang->satuan_tiga = $request->satuan_tiga;
      $barang->stok_tiga = $request->stok_tiga;
      $barang->satuan_turunan_tiga = $request->satuan_turunan_tiga;
      $barang->satuan_empat = $request->satuan_empat;
      $barang->stok_empat = $request->stok_empat;
      $barang->satuan_turunan_empat = $request->satuan_turunan_empat;
    } else if ($request->satuan_terakhir == $request->satuan_dua) {
      $stokbaru = $request->stok * $request->stok_dua;
      $barang->stok = $stokbaru;
      $barang->satuan_terakhir = $request->satuan_terakhir;
      $barang->satuan_satu = $request->satuan_satu;
      $barang->satuan_dua = $request->satuan_dua;
      $barang->stok_dua = $request->stok_dua;
      $barang->satuan_turunan_dua = $request->satuan_turunan_dua;
      $barang->satuan_tiga = $request->satuan_tiga;
      $barang->stok_tiga = $request->stok_tiga;
      $barang->satuan_turunan_tiga = $request->satuan_turunan_tiga;
      $barang->satuan_empat = $request->satuan_empat;
      $barang->stok_empat = $request->stok_empat;
      $barang->satuan_turunan_empat = $request->satuan_turunan_empat;
    } else if ($request->satuan_terakhir == $request->satuan_tiga) {
      if ($request->satuan_turunan_tiga == $request->satuan_satu) {
        $stokbaru = $request->stok * $request->stok_tiga;
        $barang->stok = $stokbaru;
        $barang->satuan_terakhir = $request->satuan_terakhir;
        $barang->satuan_satu = $request->satuan_satu;
        $barang->satuan_dua = $request->satuan_dua;
        $barang->stok_dua = $request->stok_dua;
        $barang->satuan_turunan_dua = $request->satuan_turunan_dua;
        $barang->satuan_tiga = $request->satuan_tiga;
        $barang->stok_tiga = $request->stok_tiga;
        $barang->satuan_turunan_tiga = $request->satuan_turunan_tiga;
        $barang->satuan_empat = $request->satuan_empat;
        $barang->stok_empat = $request->stok_empat;
        $barang->satuan_turunan_empat = $request->satuan_turunan_empat;
      } else {
        $stokbaru = $request->stok * $request->stok_dua * $request->stok_tiga;
        $barang->stok = $stokbaru;
        $barang->satuan_terakhir = $request->satuan_terakhir;
        $barang->satuan_satu = $request->satuan_satu;
        $barang->satuan_dua = $request->satuan_dua;
        $barang->stok_dua = $request->stok_dua;
        $barang->satuan_turunan_dua = $request->satuan_turunan_dua;
        $barang->satuan_tiga = $request->satuan_tiga;
        $barang->stok_tiga = $request->stok_tiga;
        $barang->satuan_turunan_tiga = $request->satuan_turunan_tiga;
        $barang->satuan_empat = $request->satuan_empat;
        $barang->stok_empat = $request->stok_empat;
        $barang->satuan_turunan_empat = $request->satuan_turunan_empat;
      }
    } else if ($request->satuan_terakhir == $request->satuan_empat) {
      if ($request->satuan_turunan_empat == $request->satuan_satu) {
        $stokbaru = $request->stok * $request->stok_empat;
        $barang->stok = $stokbaru;
        $barang->satuan_terakhir = $request->satuan_terakhir;
        $barang->satuan_satu = $request->satuan_satu;
        $barang->satuan_dua = $request->satuan_dua;
        $barang->stok_dua = $request->stok_dua;
        $barang->satuan_turunan_dua = $request->satuan_turunan_dua;
        $barang->satuan_tiga = $request->satuan_tiga;
        $barang->stok_tiga = $request->stok_tiga;
        $barang->satuan_turunan_tiga = $request->satuan_turunan_tiga;
        $barang->satuan_empat = $request->satuan_empat;
        $barang->stok_empat = $request->stok_empat;
        $barang->satuan_turunan_empat = $request->satuan_turunan_empat;
      } else if ($request->satuan_turunan_empat == $request->satuan_dua) {
        $stokbaru = $request->stok * $request->stok_dua * $request->stok_empat;
        $barang->stok = $stokbaru;
        $barang->satuan_terakhir = $request->satuan_terakhir;
        $barang->satuan_satu = $request->satuan_satu;
        $barang->satuan_dua = $request->satuan_dua;
        $barang->stok_dua = $request->stok_dua;
        $barang->satuan_turunan_dua = $request->satuan_turunan_dua;
        $barang->satuan_tiga = $request->satuan_tiga;
        $barang->stok_tiga = $request->stok_tiga;
        $barang->satuan_turunan_tiga = $request->satuan_turunan_tiga;
        $barang->satuan_empat = $request->satuan_empat;
        $barang->stok_empat = $request->stok_empat;
        $barang->satuan_turunan_empat = $request->satuan_turunan_empat;
      } else if ($request->satuan_turunan_tiga == $request->satuan_satu) {
        $stokbaru = $request->stok * $request->stok_tiga * $request->stok_empat;
        $barang->stok = $stokbaru;
        $barang->satuan_terakhir = $request->satuan_terakhir;
        $barang->satuan_satu = $request->satuan_satu;
        $barang->satuan_dua = $request->satuan_dua;
        $barang->stok_dua = $request->stok_dua;
        $barang->satuan_turunan_dua = $request->satuan_turunan_dua;
        $barang->satuan_tiga = $request->satuan_tiga;
        $barang->stok_tiga = $request->stok_tiga;
        $barang->satuan_turunan_tiga = $request->satuan_turunan_tiga;
        $barang->satuan_empat = $request->satuan_empat;
        $barang->stok_empat = $request->stok_empat;
        $barang->satuan_turunan_empat = $request->satuan_turunan_empat;
      } else {
        $stokbaru = $request->stok * $request->stok_dua * $request->stok_tiga * $request->stok_empat;
        $barang->stok = $stokbaru;
        $barang->satuan_terakhir = $request->satuan_terakhir;
        $barang->satuan_satu = $request->satuan_satu;
        $barang->satuan_dua = $request->satuan_dua;
        $barang->stok_dua = $request->stok_dua;
        $barang->satuan_turunan_dua = $request->satuan_turunan_dua;
        $barang->satuan_tiga = $request->satuan_tiga;
        $barang->stok_tiga = $request->stok_tiga;
        $barang->satuan_turunan_tiga = $request->satuan_turunan_tiga;
        $barang->satuan_empat = $request->satuan_empat;
        $barang->stok_empat = $request->stok_empat;
        $barang->satuan_turunan_empat = $request->satuan_turunan_empat;
      }
    }
    $barang->save();
    return redirect('barang');
  }

  /**
  * Display the specified resource.
  *
  * @param  \App\Barang $barang
  * @return \Illuminate\Http\Response
  */
  public function show(Barang $barang)
  {
    //
  }

  /**
  * Show the form for editing the specified resource.
  *
  * @param  \App\Barang $barang
  * @return \Illuminate\Http\Response
  */
  public function edit(Barang $barang)
  {
    //
  }

  /**
  * Update the specified resource in storage.
  *
  * @param  \Illuminate\Http\Request $request
  * @param  \App\Barang $barang
  * @return \Illuminate\Http\Response
  */
  public function update(Request $request, Barang $barang)
  {
    //
  }

  /**
  * Remove the specified resource from storage.
  *
  * @param  \App\Barang $barang
  * @return \Illuminate\Http\Response
  */
  public function destroy(Barang $barang)
  {
    //
  }
}
