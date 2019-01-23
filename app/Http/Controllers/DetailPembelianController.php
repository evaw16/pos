<?php

namespace App\Http\Controllers;

use App\Detail_Pembelian;
use App\Pembelian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DetailPembelianController extends Controller
{
  /**
  * Display a listing of the resource.
  *
  * @return \Illuminate\Http\Response
  */
  public function index()
  {
    $pembelian = Pembelian::join('suppliers', function ($join) {
      $join->on('pembelians.id_supplier', '=', 'suppliers.id');
    })
    ->orderBy('pembelians.created_at', 'DESC')
    ->get();
    return view('detail_pembelian', ['pembelian' => $pembelian]);
  }
  public function pdf($id)
  {
    $pdf = \App::make('dompdf.wrapper');
    $pdf->loadHTML($this->
    convert_barang($id));
    return $pdf->stream();
  }
  function convert_barang($id)
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
    if ($pembelian->sisa_piutang == 0) {
      $lunas = "Lunas";
    } else {
      $lunas = "Belum lunas";
    }
    $output = '
    <div class="datatable-dashv1-list custom-datatable-overright">
    <div id="toolbar" style="text-align: justify">
    <label style="font-size: 15pt;">No Faktur : ' . $pembelian->id_pembelian . '</label>
    <br>
    <label style="font-size: 15pt;">Tanggal : ' . $pembelian->tanggal . '</label>
    <br>
    <label style="font-size: 15pt;">Supplier : ' . $pembelian->nama . '</label>
    <br>

    <label style="font-size: 15pt;">Status : ' . $lunas . '</label>
    </div>
    <table id="table" data-toggle="table" data-toolbar="#toolbar">
    <thead>
    <tr>
    <th>No</th>
    <th>Kode Barang</th>
    <th>Nama Barang</th>
    <th>Jumlah</th>
    <th>Harga Beli</th>
    <th>Diskon Satu</th>
    <th>Diskon Dua</th>
    <th>Total</th>
    </tr>
    </thead>
    <tbody>

    ';
    $no = 0;
    foreach ($pembelians as $item) {
      $no++;
      $output .= '

      <tr>
      <td>' . $no . '</td>
      <td>' . $item->id_barang . '</td>
      <td>' . $item->nama_barang . '</td>
      <td>' . $item->jumlah . '</td>
      <td>Rp. ' . number_format($item->harga_beli, 0, ".", ".") . '</td>
      <td>' . $item->diskon_satu . '%</td>
      <td>Rp. ' . number_format($item->diskon_dua, 0, ".", ".") . '</td>
      <td>Rp. ' . number_format($item->total_harga, 0, ".", ".") . '</td>
      </tr>';
    }
    $output .= '</tbody>
    </table>
    </div>';
    return $output;
  }
  /**
  * Show the form for creating a new resource.
  *
  * @return \Illuminate\Http\Response
  */
  public function create()
  {
    //
  }

  /**
  * Store a newly created resource in storage.
  *
  * @param  \Illuminate\Http\Request  $request
  * @return \Illuminate\Http\Response
  */
  public function store(Request $request)
  {
    //
  }

  /**
  * Display the specified resource.
  *
  * @param  \App\Detail_Pembelian  $detail_Pembelian
  * @return \Illuminate\Http\Response
  */
  public function show(Detail_Pembelian $detail_Pembelian)
  {
    //
  }

  /**
  * Show the form for editing the specified resource.
  *
  * @param  \App\Detail_Pembelian  $detail_Pembelian
  * @return \Illuminate\Http\Response
  */
  public function edit(Detail_Pembelian $detail_Pembelian)
  {
    //
  }

  /**
  * Update the specified resource in storage.
  *
  * @param  \Illuminate\Http\Request  $request
  * @param  \App\Detail_Pembelian  $detail_Pembelian
  * @return \Illuminate\Http\Response
  */
  public function update(Request $request, Detail_Pembelian $detail_Pembelian)
  {
    //
  }

  /**
  * Remove the specified resource from storage.
  *
  * @param  \App\Detail_Pembelian  $detail_Pembelian
  * @return \Illuminate\Http\Response
  */
  public function destroy(Detail_Pembelian $detail_Pembelian)
  {
    //
  }
}
