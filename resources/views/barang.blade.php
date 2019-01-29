@extends('layout.app')
@section('content')
  <div class="row-fluid">
    <div class="span12">
      <div class="widget-box">
        <div class="widget-title"> <span class="icon"> <i class="icon-briefcase"></i> </span>
          <h3>Barang</h3>
        </div>
        <div class="widget-content nopadding">
          <table class="table table-bordered table-striped">
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
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              <?php $no = 0?>
              @foreach($barang as $item)
                <?php
                $no++?>
                <tr>
                  <td>{{$no}}</td>
                  <td>{{$item->nama_barang}}</td>
                  <td>{{$item->nama}}</td>
                  <td>{{$item->kategori}}</td>
                  <td>Rp. {{number_format($item->harga_beli,0,".",".")}}</td>
                  <td>Rp. {{number_format($item->harga_jual,0,".",".")}}</td>
                  <td>{{$item->laba}} %</td>
                  <td>{{$item->stok." ".$item->satuan_satu}}</td>
                  <td>
                    @if($item->satuan_empat != "")
                      {{
                        floor($item->stok/$item->stok_empat/$item->stok_tiga/$item->stok_dua)." ".$item->satuan_empat
                        ." ".floor(($item->stok % ($item->stok_dua*$item->stok_empat*$item->stok_tiga))/($item->stok_tiga*$item->stok_dua))." ".$item->satuan_tiga
                        ." ".floor((($item->stok % ($item->stok_dua*$item->stok_empat*$item->stok_tiga)) % ($item->stok_tiga*$item->stok_dua))/$item->stok_dua)." ".$item->satuan_dua
                        ." ".(($item->stok % ($item->stok_dua*$item->stok_empat*$item->stok_tiga)) % ($item->stok_tiga*$item->stok_dua))%$item->stok_dua." ".$item->satuan_satu
                      }}
                    @elseif($item->satuan_tiga != "")
                      @if($item->satuan_turunan_tiga == $item->satuan_satu)
                        {{floor($item->stok/$item->stok_tiga)." ".$item->satuan_tiga." ".floor(($item->stok % $item->stok_tiga) / $item->stok_dua)." ".
                          $item->satuan_dua." ".(($item->stok % $item->stok_tiga) % $item->stok_dua)." ".$item->satuan_satu}}
                        @else
                          {{floor($item->stok/$item->stok_tiga/$item->stok_dua)." ".$item->satuan_tiga." ".floor(($item->stok % ($item->stok_tiga*$item->stok_dua)/$item->stok_dua)).
                            " ".$item->satuan_dua." ".($item->stok % ($item->stok_tiga * $item->stok_dua) % $item->stok_dua)." ".$item->satuan_satu}}
                          @endif
                        @elseif($item->satuan_dua != "")
                          {{floor($item->stok/$item->stok_dua)." ".$item->satuan_dua." ".($item->stok % $item->stok_dua." ".$item->satuan_satu)}}
                        @else
                          {{$item->stok." ".$item->satuan_satu}}
                        @endif
                      </td>
                      <td>
                        <center>
                          <form action="/barang/edit/{{$item->id_barang}}" method="get"
                            style="display: inline">
                            <button class="btn btn-primary" style="width: 37px;">
                              <i class="icon-edit"></i>
                            </button>
                          </form>
                          <form action="/barang/{{$item->id_barang}}" method="POST"
                            style="display: inline">
                            <button class="btn btn-danger">
                              <i class="fa fa-trash"></i>
                            </button>
                            {{csrf_field()}}
                            <input type="hidden" name="_method" value="DELETE">
                          </form>
                        </center>
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
