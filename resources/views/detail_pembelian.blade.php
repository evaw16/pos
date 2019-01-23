@extends('layout.app')
@section('content')
  <div class="row-fluid">
    <div class="span12">
      <div class="widget-box">
        <div class="widget-title"> <span class="icon"> <i class="fas fa-users"></i> </span>
          <h5>Pembelian</h5>
        </div>
      </div>
    </div>
  </div>
  <div class="widget-content nopadding">
    <div id="detail_sup">
      <table class="table table-bordered table-striped">
        <thead>
          <tr>
            <th>No</th>
            <th>No Faktur</th>
            <th>Tanggal</th>
            <th>No Bukti</th>
            <th>Supplier</th>
            <th>Jenis Transaksi</th>
            <th>Jatuh Tempo</th>
            <th>Neto</th>
            <th>Uang Muka</th>
            <th>Sisa Piutang</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          <?php $no = 0?>
          @foreach($pembelian as $item)
            <?php
            $no++?>
            <tr>
              <td>{{$no}}</td>
              <td>{{$item->id_pembelian}}</td>
              <td>{{$item->tanggal}}</td>
              <td>{{$item->no_bukti}}</td>
              <td>{{$item->nama}}</td>
              <td>{{$item->jenis_transaksi}}</td>
              <td>{{$item->jatuh_tempo}}</td>
              <td>{{$item->neto}}</td>
              <td>{{$item->uang_muka}}</td>
              <td>{{$item->sisa_piutang}}</td>
              <td>
                <form action="#" method="get"
                style="display: inline">
                <button class="btn btn-primary" style="width: 37px;">
                  <i class="icon-pencil"></i>
                </button>
              </form>
              <form action="/pembelian/detail/{{$item->id_pembelian}}" method="Get"
                style="display: inline">
                <button class="btn btn-success">
                  <i class="fa fa-eye"></i>
                </button>
              </form>
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>

@endsection
