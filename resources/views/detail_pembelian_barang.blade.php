@extends('layout.app')
@section('content')
  <div class="data-table-area mg-b-15">
    <div class="container-fluid">
      <div class="row">
        <div class="col-lg-12">
          <div class="sparkline13-list shadow-reset">
            <div class="sparkline13-graph">
              <div class="datatable-dashv1-list custom-datatable-overright">
                <div id="toolbar" style="text-align: justify">
                  <label style="font-size: 15pt;">No Faktur : {{$data->id_pembelian}}</label>
                  <br>
                  <label style="font-size: 15pt;">Tanggal : {{$data->tanggal}}</label>
                  <br>
                  <label style="font-size: 15pt;">Supplier : {{$data->nama}}</label>
                  <br>
                  <?php if($data->sisa_piutang == 0){
                    $lunas = "Lunas";
                  } else {
                    $lunas = "Belum lunas";
                  }
                  ?>
                  <label style="font-size: 15pt;">Status : {{$lunas}}</label>
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
                    <?php $no = 0?>
                    @foreach($pembelian as $item)
                      <?php
                      $no++?>
                      <tr>
                        <td>{{$no}}</td>
                        <td>{{$item->id_barang}}</td>
                        <td>{{$item->nama_barang}}</td>
                        <td>{{$item->jumlah}}</td>
                        <td>Rp. {{number_format($item->harga_beli,0,".",".")}}</td>
                        <td>{{$item->diskon_satu}}%</td>
                        <td>Rp. {{number_format($item->diskon_dua,0,".",".")}}</td>
                        <td>Rp. {{number_format($item->total_harga,0,".",".")}}</td>
                      </tr>
                    @endforeach
                  </tbody>
                </table>
                <div class="row">
                  <div class="col-lg-11">

                  </div>
                  <div class="col-lg-1" style="margin-top: 10px;">
                    <a href="/detail_pembelian/print/{{$data->id_pembelian}}" class="btn btn-sm btn-primary login-submit-cs">Print</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
