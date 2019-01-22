@extends('layout.app')
@section('content')
  <div class="row-fluid">
    <div class="span12">
      <div class="widget-box">
        <div class="widget-title"> <span class="icon"> <i class="fas fa-store-alt"></i> </span>
          <h3>Kartu Stok</h3>
        </div>
        <div class="widget-content nopadding">
          <table class="table table-bordered table-striped">
            <thead>
              <tr>
                <th>Tanggal</th>
                <th>No. Bukti</th>
                <th>Keterangan</th>
                <th>Masuk</th>
                <th>Keluar</th>
                <th>Saldo</th>
              </tr>
            </thead>
            <tbody>
              <?php $no = 0?>
              @foreach($barang as $item)
                <?php $no++?>
                <tr>
                  <td></td>
                  <td></td>
                  <td>
                    <a href="/barang/edit/{{$item->id_barang}}" class="btn btn-primary">
                      <i class="fa fa-pencil-square-o" style="color: #fff;"></i>
                    </a>
                    <form action="/barang/{{$item->id_barang}}" method="POST">
                      <input class="btn btn-danger;fas fa-trash-alt" type="submit" name="submit"
                      value="Delete">
                      {{csrf_field()}}
                      <input type="hidden" name="_method" value="DELETE">
                    </form>
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>

      <div class="sparkline13-graph">
        <div class="datatable-dashv1-list custom-datatable-overright">
          <div id="toolbar">
            <a href="/barang/create" class="btn btn-primary">
              Tambah
            </a>
          </div>

        @endsection
