<?php

namespace App\Http\Controllers;

use App\Pembelian;
use App\Supplier;
//use Darryldecode\Cart\Cart;
use Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PembelianController extends Controller
{
  /**
  * Display a listing of the resource.
  *
  * @return \Illuminate\Http\Response
  */
  public function index()
  {
    $supplier = Supplier::all();
    $data = Cart::getContent();
    return view('pembelian', ['supplier' => $supplier], ['data' => $data]);
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
    <select class="form-control custom-select-value"
    name="satuan">
    <option>' . $data->satuan_satu . '</option>
    <option>' . $data->satuan_dua . '</option>
    <option>' . $data->satuan_tiga . '</option>
    <option>' . $data->satuan_empat . '</option>
    </select>
    </div>
    </div>
    </div>';
    echo $output;
  }
  public function fetch($id)
  {
    //        $value = $_GET['id'];
    $data = DB::table('suppliers')
    ->where('id', $id)
    ->first();
    $output = '<table class="table sparkle-table">
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
  public function store(Request $request)
  {
    $barang = DB::table('barangs')
    ->where('id_barang', $request->id_barang)
    ->first();
    $diskon = $request->diskon_satu / 100 * $request->harga_beli;
    $add = Cart::add([
      'id' => $request->id_barang,
      'price' => $request->harga_beli,
      'name' => $barang->nama_barang,
      'quantity' => $request->jumlah,
      'attributes' => [
        'satuan' => $request->satuan,
        'diskon_satu' => $request->diskon_satu,
        'diskon_dua' => $diskon
      ]
    ]);
    if ($add) {
      return redirect('pembelian');
    }
  }
  public function clear()
  {
    Cart::clear();
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
}
