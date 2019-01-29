<?php

namespace App\Http\Controllers;


use App\Barang;
use PDF;
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

  public function pdf()
  {
    $pdf = \App::make('dompdf.wrapper');
    $pdf->loadHTML($this->
    convert_barang());
    return $pdf->stream();
  }
  function convert_barang()
  {
    $barang = Barang::join('suppliers', function ($join) {
      $join->on('barangs.id_supplier', '=', 'suppliers.id');
    })
    ->join('kategoris', function ($join) {
      $join->on('barangs.id_kategori', '=', 'kategoris.id_kategori');
    })
    ->get();
    $output = '
    <table id="table" data-toggle="table" data-pagination="true" data-search="true"
    data-toolbar="#toolbar">
    <thead>
    <tr>
    <th>No</th>
    <th>Nama Barang</th>
    <th>Nama Perusahaan</th>
    <th>Kategori</th>
    <th>Harga Beli</th>
    <th>Harga Jual</th>
    <th>Laba</th>
    <th>Stok</th>
    <th>Stok Kemasan</th>
    </tr>
    </thead>

    ';
    $no = 0;
    foreach ($barang as $item) {
      $no++;
      if ($item->satuan_empat != "") {
        $stok = floor($item->stok / $item->stok_empat / $item->stok_tiga / $item->stok_dua) . " " . $item->satuan_empat
        . " " . floor(($item->stok % ($item->stok_dua * $item->stok_empat * $item->stok_tiga)) / ($item->stok_tiga * $item->stok_dua)) . " " . $item->satuan_tiga
        . " " . floor((($item->stok % ($item->stok_dua * $item->stok_empat * $item->stok_tiga)) % ($item->stok_tiga * $item->stok_dua)) / $item->stok_dua) . " " . $item->satuan_dua
        . " " . (($item->stok % ($item->stok_dua * $item->stok_empat * $item->stok_tiga)) % ($item->stok_tiga * $item->stok_dua)) % $item->stok_dua . " " . $item->satuan_satu;
      } elseif ($item->satuan_tiga != "") {
        if ($item->satuan_turunan_tiga == $item->satuan_satu) {
          $stok = floor($item->stok / $item->stok_tiga) . " " . $item->satuan_tiga . " " . floor(($item->stok % $item->stok_tiga) / $item->stok_dua) . " " .
          $item->satuan_dua . " " . (($item->stok % $item->stok_tiga) % $item->stok_dua) . " " . $item->satuan_satu;
        } else {
          $stok = floor($item->stok / $item->stok_tiga / $item->stok_dua) . " " . $item->satuan_tiga . " " . floor(($item->stok % ($item->stok_tiga * $item->stok_dua) / $item->stok_dua)) .
          " " . $item->satuan_dua . " " . ($item->stok % ($item->stok_tiga * $item->stok_dua) % $item->stok_dua) . " " . $item->satuan_satu;
        }
      } elseif ($item->satuan_dua != "") {
        $stok = floor($item->stok / $item->stok_dua) . " " . $item->satuan_dua . " " . ($item->stok % $item->stok_dua . " " . $item->satuan_satu);
      } else {
        $stok = $item->stok . " " . $item->satuan_satu;
      };
      $output .= '
      <tbody>
      <tr>
      <td>' . $no . '</td>
      <td>' . $item->nama_barang . '</td>
      <td>' . $item->nama . '</td>
      <td>' . $item->kategori . '</td>
      <td>Rp. ' . number_format($item->harga_beli, 0, ".", ".") . '</td>
      <td>Rp. ' . number_format($item->harga_jual, 0, ".", ".") . '</td>
      <td>' . $item->laba . ' %</td>
      <td>' . $item->stok . " " . $item->satuan_satu . '</td>
      <td>' . $stok . '</td>
      </tr>';
    }
    $output .= '
    </tbody>
    </table>';
    return $output;
  }

  /**
  * Show the form for creating a new resource.
  *
  * @return \Illuminate\Http\Response
  */
  public function create()
  {
    $id = DB::table('barangs')
    ->orderBy('created_at', 'DESC')
    ->take(1)
    ->first();
    if (count((array)$id) == 0) {
      $barang = 1;
    } else {
      $barang = substr($id->id_barang, -2) + 1;
    }
    $supplier = Supplier::all();
    $kategori = DB::table('kategoris')->get();
    return view('create_barang', ['supplier' => $supplier, 'kategori' => $kategori, 'id' => $barang]);
  }

  /**
  * Store a newly created resource in storage.
  *
  * @param  \Illuminate\Http\Request $request
  * @return \Illuminate\Http\Response
  */
  public function store(Request $request)
  {
    // $this->validate($request, [
    //   'id_barang' => 'required|unique:barangs|max:6',
    //   'nama_barang' => 'required|string|max:255',
    //   'id_supplier' => 'required|integer',
    //   'id_kategori' => 'required|integer',
    //   'harga_beli' => 'required|integer',
    //   'harga_jual' => 'required|integer',
    //   'satuan_satu' => 'required|string'
    // ]);
    $barang = new Barang();
    $barang->id_barang = $request->id_barang;
    $barang->nama_barang = $request->nama_barang;
    $barang->id_kategori = $request->id_kategori;
    $barang->id_supplier = $request->id_supplier;
    $barang->harga_beli = $request->harga_beli;
    $barang->harga_jual = $request->harga_jual;
    $laba = (($request->harga_jual - $request->harga_beli) / $request->harga_beli) * 100;
    $barang->laba = $laba;
    $barang->stok = 0;
    $barang->satuan_terakhir = "PCS";
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
  public function edit($id_barang)
  {
    $supplier = Supplier::all();
    $kategori = DB::table('kategoris')->get();
    $barang = DB::table('barangs')
    ->join('suppliers', function ($join) {
      $join->on('barangs.id_supplier', '=', 'suppliers.id');
    })
    ->join('kategoris', function ($join) {
      $join->on('barangs.id_kategori', '=', 'kategoris.id_kategori');
    })
    ->where('id_barang', $id_barang)->first();
    $stok = $barang->stok;
    return view('edit_barang', ['barang' => $barang, 'stok' => $stok, 'supplier' => $supplier, 'kategori' => $kategori]);
  }


  /**
  * Update the specified resource in storage.
  *
  * @param  \Illuminate\Http\Request $request
  * @param  \App\Barang $barang
  * @return \Illuminate\Http\Response
  */
  public function update(Request $request, $id)
  {
    $laba = (($request->harga_jual - $request->harga_beli) / $request->harga_beli) * 100;
    if ($request->satuan_terakhir == $request->satuan_satu) {
      $stokbaru = $request->stok;
    } else if ($request->satuan_terakhir == $request->satuan_dua) {
      $stokbaru = $request->stok * $request->stok_dua;
    } else if ($request->satuan_terakhir == $request->satuan_tiga) {
      if ($request->satuan_turunan_tiga == $request->satuan_satu) {
        $stokbaru = $request->stok * $request->stok_tiga;
      } else {
        $stokbaru = $request->stok * $request->stok_dua * $request->stok_tiga;
      }
    } else if ($request->satuan_terakhir == $request->satuan_empat) {
      if ($request->satuan_turunan_empat == $request->satuan_satu) {
        $stokbaru = $request->stok * $request->stok_empat;
      } else if ($request->satuan_turunan_empat == $request->satuan_dua) {
        $stokbaru = $request->stok * $request->stok_dua * $request->stok_empat;
      } else if ($request->satuan_turunan_tiga == $request->satuan_satu) {
        $stokbaru = $request->stok * $request->stok_tiga * $request->stok_empat;
      } else {
        $stokbaru = $request->stok * $request->stok_dua * $request->stok_tiga * $request->stok_empat;
      }
    }
    $barang = DB::table('barangs')
    ->where('id_barang', $id)->
    update([
      'nama_barang' => $request->nama_barang,
      'id_kategori' => $request->id_kategori,
      'id_supplier' => $request->id_supplier,
      'harga_beli' => $request->harga_beli,
      'harga_jual' => $request->harga_jual,
      'laba' => $laba,
      'stok' => $stokbaru,
      'satuan_satu' => $request->satuan_satu,
      'satuan_dua' => $request->satuan_dua,
      'stok_dua' => $request->stok_dua,
      'satuan_turunan_dua' => $request->satuan_turunan_dua,
      'satuan_tiga' => $request->satuan_tiga,
      'stok_tiga' => $request->stok_tiga,
      'satuan_turunan_tiga' => $request->satuan_turunan_tiga,
      'satuan_empat' => $request->satuan_empat,
      'stok_empat' => $request->stok_empat,
      'satuan_turunan_empat' => $request->satuan_turunan_empat,
    ]);
    return redirect('barang');
  }

  /**
  * Remove the specified resource from storage.
  *
  * @param  \App\Barang $barang
  * @return \Illuminate\Http\Response
  */
  public function destroy($id)
  {
    $supplier = Barang::where('id_barang', $id);
    $supplier->delete();
    return redirect('barang');
  }
}
