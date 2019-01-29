@extends('layout.app')
@section('content')
  <div class="row-fluid">
    <div class="span6">
      <div class="widget-box">
        <div class="widget-title"> <span class="icon"> <i class="icon-external-link"></i> </span>
          <h5>Penjualan</h5>
        </div>
        <div class="widget-content nopadding">
          <form action="/penjualan" method="post" class="form-horizontal">
            <div class="control-group">
              <label class="control-label">No. Faktur:</label>
              <div class="controls">
                <input type="number" class="form-control" name="id_penjualan" placeholder="No Faktur"/>
              </div>
            </div>
            <div class="control-group">
              <label class="control-label">Tanggal :</label>
              <div class="controls">
                <input type="date" class="form-control" name="tanggal" data-date-format="yyyy-MM-dd" required/>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>

    <div class="span6">
      <div class="widget-box">
        <div class="widget-title"> <span class="icon"> <i class="fas fa-users"></i> </span>
          <h5>Customer</h5>
        </div>
        <div class="widget-content nopadding">
          <form action="#" class="form-horizontal">
            <div class="control-group">
              <label for="normal" class="control-label">Pilih Customer</label>
              <div class="controls">
                <select id="supplier" class="form-control" name="id_customer"
                onchange="pilihSupplier()">
                <option></option>
                @foreach($customer as $item)
                  <option value="{{$item->id_customer}}">{{$item->nama}}</option>
                @endforeach
              </select>
              {{csrf_field()}}
            </div>
          </div>
        </div>
        <div class="widget-content nopadding">
          <div id="detail_sup">
            <table class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th></th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>Alamat</td>
                  <td></td>
                </tr>
                <tr>
                  <td>No. Telepon</td>
                  <td></td>
                </tr>
                <tr>
                  <td>Keterangan</td>
                  <td></td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>


  <div class="row-fluid">
    <div class="span12">
      <div class="widget-box">
        <div class="widget-title"> <span class="icon"> <i class="icon-qrcode"></i> </span>
          <h5>Tabel Penjualan</h5>
        </div>
        <div class="widget-content nopadding">
          <table id="table" class="table table-bordered table-striped">
            <thead>
              <tr>
                <th>No</th>
                <th>Kode Barang</th>
                <th>Nama Barang</th>
                <th>Harga Beli</th>
                <th>Jumlah</th>
                <th>Sub Total</th>
              </tr>
            </thead>
            <tbody>
              <?php $no = 0;
              $totalBayar = 0;
              ?>
              @foreach($data as $item)
                <?php
                $total = $item->price * $item->quantity;
                $totalBayar += $total;
                $no++?>
                <tr>
                  <td>{{$no}}</td>
                  <td>{{$item->id}}</td>
                  <td>{{$item->name}}</td>
                  <td>Rp. {{number_format($item->price,0,".",".")}}</td>
                  <td>{{$item->quantity}}</td>
                  <td>
                    Rp. {{number_format(($item->price)*$item->quantity,0,".",".")}}
                  </td>
                </tr>
                <tr>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td>Total</td>
                  <td><input type="number" value="<?=$totalBayar?>" name="total" class="form-control"></td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </form><br>


    </div>


    <div class="sparkline13-graph">
      <div class="datatable-dashv1-list custom-datatable-overright">
        <div id="toolbar" >
          <a href="#" class="btn btn-primary" onclick="onClick();">Tambah</a>
        </div>
      </div>
    </div>
  </div>
</div>





{{-- <div class="form-actions">
<button type="submit" class="btn btn-success">Save</button>
<button class="btn btn-white" type="submit">Cancel</button>
</div> --}}

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script type="text/javascript">
function pilihSupplier() {
  var xmlhttp = new XMLHttpRequest();
  var value = document.getElementById("supplier").value;
  if (value != "") {
    xmlhttp.open("GET", "/penjualan/fetch/" + value, false);
    xmlhttp.send(null);
    document.getElementById("detail_sup").innerHTML = xmlhttp.responseText;
  } else {
    alert('Supplier Kosong')
  }
}
</script>
@endsection
