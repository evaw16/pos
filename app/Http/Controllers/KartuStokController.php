<?php

namespace App\Http\Controllers;

use App\Barang;
use App\Kartu_Stok;
use Faker\Provider\DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KartuStokController extends Controller
{
  /**
  * Display a listing of the resource.
  *
  * @return \Illuminate\Http\Response
  */
  public function index()
  {
    $barang = Barang::all();
    return view('kartu_stok', ['barang' => $barang]);
  }
  public function fetch($id)
  {
    $data = DB::table('detail_pembelians')
    ->join('pembelians', function ($join) {
      $join->on('detail_pembelians.id_pembelian', '=', 'pembelians.id_pembelian');
    })
    ->join('suppliers', function ($join) {
      $join->on('pembelians.id_supplier', '=', 'suppliers.id');
    })
    ->join('barangs', function ($join) {
      $join->on('detail_pembelians.id_barang', '=', 'barangs.id_barang');
    })
    ->where('detail_pembelians.id_barang', $id)
    ->get();
    $no = 0;
    $penjualan = DB::table('detail_penjualans')
    ->join('penjualans', function ($join) {
      $join->on('detail_penjualans.id_penjualan', '=', 'penjualans.id_penjualan');
    })
    ->join('customer', function ($join) {
      $join->on('penjualans.id_customer', '=', 'customer.id_customer');
    })
    ->join('barangs', function ($join) {
      $join->on('detail_penjualans.id_barang', '=', 'barangs.id_barang');
    })
    ->where('detail_penjualans.id_barang', $id)
    ->get();
    $output = '<table id="results" class="table sparkle-table">
    <thead>
    <tr>
    <th>Tanggal</th>
    <th>Hari</th>
    <th>Faktur</th>
    <th>Keterangan</th>
    <th>Masuk</th>
    <th>Keluar</th>
    <th>Saldo</th>
    </tr>
    </thead>
    <tbody>';
    foreach ($data as $item) {
      $timestamp = strtotime($item->tanggal);
      $day = date('D', $timestamp);
      $no++;
      $output .= '                     <tr>
      <td>' . date("d/m/Y", strtotime($item->tanggal)) . '</td>
      <td>' . $this->translate_date($day) . '</td>
      <td>' . $item->id_pembelian . '</td>
      <td>' . $item->nama . '(Masuk)</td>
      <td>' . $item->jumlah . '</td>
      <td></td>
      <td>' . $item->stok . '</td>
      </tr>';
    }
    foreach ($penjualan as $item) {
      $timestamp = strtotime($item->tanggal);
      $day = date('D', $timestamp);
      $no++;
      $output .= '                     <tr>
      <td>' . date("d/m/Y", strtotime($item->tanggal)) . '</td>
      <td>' . $this->translate_date($day) . '</td>
      <td>' . $item->id_penjualan . '</td>
      <td>' . $item->nama . '(Keluar)</td>
      <td></td>
      <td>' . $item->jumlah . '</td>
      <td>' . $item->stok . '</td>
      </tr>';
    }
    $output .= '
    </tbody>
    </table>';
    echo $output;
  }
  function translate_date($day)
  {
    $translated_days = array(
      'Mon' => 'Senin',
      'Tue' => 'Selasa',
      'Wed' => 'Rabu',
      'Thu' => 'Kamis',
      'Fri' => 'Jumat',
      'Sat' => 'Sabtu',
      'Sun' => 'Minggu',
    );
    return $translated_days[$day];
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
  * @param  \App\Kartu_Stok  $kartu_Stok
  * @return \Illuminate\Http\Response
  */
  public function show(Kartu_Stok $kartu_Stok)
  {
    //
  }

  /**
  * Show the form for editing the specified resource.
  *
  * @param  \App\Kartu_Stok  $kartu_Stok
  * @return \Illuminate\Http\Response
  */
  public function edit(Kartu_Stok $kartu_Stok)
  {
    //
  }

  /**
  * Update the specified resource in storage.
  *
  * @param  \Illuminate\Http\Request  $request
  * @param  \App\Kartu_Stok  $kartu_Stok
  * @return \Illuminate\Http\Response
  */
  public function update(Request $request, Kartu_Stok $kartu_Stok)
  {
    //
  }

  /**
  * Remove the specified resource from storage.
  *
  * @param  \App\Kartu_Stok  $kartu_Stok
  * @return \Illuminate\Http\Response
  */
  public function destroy(Kartu_Stok $kartu_Stok)
  {
    //
  }
}
