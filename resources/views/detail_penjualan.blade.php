@extends('layout.app')
@section('content')
  <div class="row-fluid">
    <div class="span12">
      <div class="widget-box">
        <div class="widget-title"> <span class="icon"> <i class="icon-external-link"></i> </span>
          <h5>Penjualan</h5>
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
            <th>Customer</th>
            <th>Total</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          <?php $no = 0?>
          @foreach($penjualan as $item)
            <?php
            $no++?>
            <tr>
              <td>{{$no}}</td>
              <td>{{$item->id_penjualan}}</td>
              <td>{{$item->tanggal}}</td>
              <td>{{$item->nama}}</td>
              <td>{{$item->total}}</td>
              <td>
                <center>
                  <form action="#" method="get"
                  style="display: inline">
                  <button class="btn btn-primary" style="width: 37px;">
                    <i class="icon-edit"></i>
                  </button>
                </form>
                <form action="/penjualan/detail/{{$item->id_penjualan}}" method="GET"
                  style="display: inline">
                  <button class="btn btn-success">
                    <i class="fa fa-eye"></i>
                  </button>
                </form>
              </center>
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>

@endsection
