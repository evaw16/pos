<?php

namespace App\Http\Controllers;

use App\Detail_Pembelian;
use App\Pembelian;
use App\Supplier;
use Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Session;

class PembelianController extends Controller
{
  /**
  * Display a listing of the resource.
  *
  * @return \Illuminate\Http\Response
  */
  public function index()
  {
    $id = DB::table('pembelians')
    ->orWhere('id_pembelian', 'like', '%' . str_replace("-", "", date("Y-m-d")) . '%')
    ->orderBy('created_at', 'DESC')
    ->take(1)
    ->first();
    if (count((array)$id) == 0) {
      $pembelian = 1;
    } else {
      $pembelian = substr($id->id_pembelian, -1) + 1;
    }
    if (session()->has('id_supplier')) {
      $supplier = DB::table('suppliers')
      ->where('id', session('id_supplier'))
      ->first();
    } else {
      $supplier = Supplier::all();
    }
    $data = Cart::getContent();
    return view('pembelian', ['supplier' => $supplier, 'data' => $data, 'id' => $pembelian]);
  }

  /**
  * Show the form for creating a new resource.
  *
  * @return \Illuminate\Http\Response
  */
  public function create($id)
  {
    $barang = DB::table('barangs')
    ->where('id_supplier', $id)
    ->get();
    return view('create_pembelian', ['barang' => $barang]);
  }

  /**
  * Store a newly created resource in storage.
  *
  * @param  \Illuminate\Http\Request  $request
  * @return \Illuminate\Http\Response
  */
  public function fetch($id)
  {
    $data = DB::table('suppliers')
    ->where('id', $id)
    ->first();
    $output = '<table class="table table-bordered table-striped">
    <tr>
    <td>Alamat</td>
    <td>' . $data->alamat . '</td>
    </tr>
    <tr>
    <td>Telepon Perusahaan</td>
    <td>' . $data->telepon . '</td>
    </tr>
    <tr>
    <td>Nama CP</td>
    <td>' . $data->nama_cp . '</td>
    </tr>
    <tr>
    <td>Telepon CP</td>
    <td>' . $data->telepon_cp . '</td>
    </tr>
    </table>';
    echo $output;
  }
  public function barang($id)
  {
    $data = DB::table('barangs')
    ->where('id_barang', $id)
    ->first();
    $harga = $data->harga_beli;
    $output = '<div class="control-group">
    <label class="control-label">Harga Beli :</label>
    <div class="controls"> <input type="number" id="harga" class="form-control diskon" name="harga_beli"
    placeholder="Harga Beli"
    value="' . $harga . '" required/>
    </div>
    </div>
    <div class="control-group">
    <label class="control-label">Satuan :</label>
    <div class="controls">
    <select id="satuan" class="form-control custom-select-value"
    name="satuan">
    <option>' . $data->satuan_satu . '</option>
    <option>' . $data->satuan_dua . '</option>
    <option>' . $data->satuan_tiga . '</option>
    <option>' . $data->satuan_empat . '</option>
    </select>
    <input type="hidden" id="satuan_satu" value="'.$data->satuan_satu.'">
    <input type="hidden" id="satuan_dua" value="'.$data->satuan_dua.'">
    <input type="hidden" id="satuan_tiga" value="'.$data->satuan_tiga.'">
    <input type="hidden" id="satuan_empat" value="'.$data->satuan_empat.'">
    <input type="hidden" id="stok_dua" value="'.$data->stok_dua.'">
    <input type="hidden" id="stok_tiga" value="'.$data->stok_tiga.'">
    <input type="hidden" id="stok_empat" value="'.$data->stok_empat.'">
    <input type="hidden" id="satuan_turunan_dua" value="'.$data->satuan_turunan_dua.'">
    <input type="hidden" id="satuan_turunan_tiga" value="'.$data->satuan_turunan_tiga.'">
    <input type="hidden" id="satuan_turunan_empat" value="'.$data->satuan_turunan_empat.'">
    </div>
    </div>
    </div>';
    echo $output;
  }
  public function tambahBarang(Request $request)
  {
    $barang = DB::table('barangs')
    ->where('id_barang', $request->id_barang)
    ->first();
    $satuan_satu = $barang->satuan_satu;
    $satuan_dua = $barang->satuan_dua;
    $satuan_tiga = $barang->satuan_tiga;
    $satuan_empat = $barang->satuan_empat;
    $satuan_terakhir_dua = $barang->satuan_turunan_dua;
    $satuan_terakhir_tiga = $barang->satuan_turunan_tiga;
    $satuan_terakhir_empat = $barang->satuan_turunan_empat;
    $stok_dua = $barang->stok_dua;
    $stok_tiga = $barang->stok_tiga;
    $stok_empat = $barang->stok_empat;
    $diskon = $request->diskon_satu / 100 * $request->harga_beli;
    if ($request->satuan == $satuan_satu) {
      $stokbaru = $request->jumlah;
      $total = ($request->harga_beli * $stokbaru) - ($diskon + $request->diskon_dua);
    } else if ($request->satuan == $satuan_dua) {
      $stokbaru = $request->jumlah * $stok_dua;
      $total = ($request->harga_beli * $stokbaru) - ($diskon + $request->diskon_dua);
    } else if ($request->satuan == $satuan_tiga) {
      if ($satuan_terakhir_tiga == $satuan_satu) {
        $stokbaru = $request->jumlah * $stok_tiga;
        $total = ($request->harga_beli * $stokbaru) - ($diskon + $request->diskon_dua);
      } else {
        $stokbaru = $request->jumlah * $stok_dua * $stok_tiga;
        $total = ($request->harga_beli * $stokbaru) - ($diskon + $request->diskon_dua);
      }
    } else if ($request->satuan == $satuan_empat) {
      if ($satuan_terakhir_empat == $satuan_satu) {
        $stokbaru = $request->jumlah * $stok_empat;
        $total = ($request->harga_beli * $stokbaru) - ($diskon + $request->diskon_dua);
      } else if ($satuan_terakhir_empat == $satuan_dua) {
        $stokbaru = $request->jumlah * $stok_dua * $stok_empat;
        $total = ($request->harga_beli * $stokbaru) - ($diskon + $request->diskon_dua);
      } else if ($satuan_terakhir_tiga == $satuan_satu) {
        $stokbaru = $request->jumlah * $stok_tiga * $stok_empat;
        $total = ($request->harga_beli * $stokbaru) - ($diskon + $request->diskon_dua);
      } else {
        $stokbaru = $request->jumlah * $stok_dua * $stok_tiga * $stok_empat;
        $total = ($request->harga_beli * $stokbaru) - ($diskon + $request->diskon_dua);
      }
    }
    Session::put('id_supplier', $request->id_supplier);
    $add = Cart::add([
      'id' => $request->id_barang,
      'price' => $request->harga_beli,
      'name' => $barang->nama_barang,
      'quantity' => $stokbaru,
      'attributes' => [
        'satuan' => $satuan_satu,
        'diskon_satu' => $request->diskon_satu,
        'diskon_dua' => $request->diskon_dua,
        'total' => $total
      ]
    ]);
    if ($add) {
      return redirect('pembelian');
    }
  }

  public function store(Request $request)
  {
    $pembelian = new Pembelian();
    $pembelian->id_pembelian = $request->id_pembelian;
    $pembelian->id_supplier = $request->id_supplier;
    $pembelian->no_bukti = $request->no_bukti;
    $pembelian->tanggal = $request->tanggal;
    $pembelian->biaya_kirim = $request->biaya_kirim;
    $pembelian->diskon_satu = $request->diskon_satu;
    $pembelian->diskon_dua = $request->diskon_dua;
    $pembelian->jenis_transaksi = $request->jenis_transaksi;
    if ($request->jatuh_tempo > 0) {
      $pembelian->jatuh_tempo = date('Y-m-d', strtotime($request->tanggal . ' + ' . $request->jatuh_tempo . ' days'));
    }
    $pembelian->neto = $request->neto;
    $pembelian->uang_muka = $request->uang_muka;
    $pembelian->sisa_piutang = $request->sisa_piutang;
    $pembelian->total = $request->total;
    $pembelian->save();
    $idpembelian = DB::table('pembelians')
    ->where('id_supplier', $request->id_supplier)
    ->orderBy('created_at', 'DESC')
    ->take(1)
    ->first();
    $data = Cart::getContent();
    foreach ($data as $item) {
      $stok = DB::table('barangs')->where("id_barang", $item->id)
      ->first();
      $laba = (($stok->harga_jual - $item->price) / $item->price) * 100;
      $barang = DB::table('barangs')
      ->where('id_barang', $item->id)
      ->update([
        'laba' => $laba,
        'stok' => $stok->stok + $item->quantity,
        'harga_beli' => $item->price
      ]);
      $detail = new Detail_Pembelian();
      $detail->id_pembelian = $idpembelian->id_pembelian;
      $detail->id_barang = $item->id;
      $detail->jumlah = $item->quantity;
      $detail->satuan = $item->attributes['satuan'];
      $detail->diskon_satu = $item->attributes['diskon_satu'];
      $detail->diskon_dua = $item->attributes['diskon_dua'];
      $detail->total_harga = $item->attributes['total'];
      $detail->save();
    }
    Cart::clear();
    Session::flush();
    return redirect('detail_pembelian');
  }
  public function clear()
  {
    Cart::clear();
    Session::flush();
    return redirect('pembelian');
  }

  /**
  * Display the specified resource.
  *
  * @param  \App\Pembelian  $pembelian
  * @return \Illuminate\Http\Response
  */
  public function show(Pembelian $pembelian)
  {
    //
  }

  /**
  * Show the form for editing the specified resource.
  *
  * @param  \App\Pembelian  $pembelian
  * @return \Illuminate\Http\Response
  */
  public function edit(Pembelian $pembelian)
  {
    //
  }

  /**
  * Update the specified resource in storage.
  *
  * @param  \Illuminate\Http\Request  $request
  * @param  \App\Pembelian  $pembelian
  * @return \Illuminate\Http\Response
  */
  public function update(Request $request, Pembelian $pembelian)
  {
    //
  }

  /**
  * Remove the specified resource from storage.
  *
  * @param  \App\Pembelian  $pembelian
  * @return \Illuminate\Http\Response
  */
  public function destroy(Pembelian $pembelian)
  {
    //
  }
  public function detail_barang($id)
  {
    $pembelians = DB::table('detail_pembelians')
    ->join('barangs', function ($join) {
      $join->on('barangs.id_barang', '=', 'detail_pembelians.id_barang');
    })
    ->where('detail_pembelians.id_pembelian', $id)
    ->get();
    $pembelian = DB::table('detail_pembelians')
    ->join('pembelians', function ($join) {
      $join->on('pembelians.id_pembelian', '=', 'detail_pembelians.id_pembelian');
    })
    ->join('suppliers', function ($join) {
      $join->on('suppliers.id', '=', 'pembelians.id_supplier');
    })
    ->where('detail_pembelians.id_pembelian', $id)
    ->first();
    return view('detail_pembelian_barang', ['pembelian' => $pembelians], ['data' => $pembelian]);
  }
}
