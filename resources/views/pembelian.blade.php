@extends('layout.app')
@section('content')
  <div class="row-fluid">
    <div class="span6">
      <div class="widget-box">
        <div class="widget-title"> <span class="icon"> <i class="fas fa-users"></i> </span>
          <h5>Pembelian</h5>
        </div>
        <div class="widget-content nopadding">
          <form action="/pembelian/create" method="post" class="form-horizontal">
            <div class="control-group">
              <label class="control-label">No. Entry:</label>
              <div class="controls">
                <input type="number" class="form-control" name="id_pembelian" placeholder="No Faktur"/>
              </div>
            </div>
            <div class="control-group">
              <label class="control-label">Tanggal :</label>
              <div class="controls">
                <input type="date" class="form-control" name="tanggal" data-date-format="yyyy-MM-dd" required/>
              </div>
            </div>
            <div class="control-group">
              <label class="control-label">No. Bukti :</label>
              <div class="controls">
                <input type="number" class="form-control" name="no_bukti" placeholder="No Bukti" required/>
              </div>
            </div>
            <div class="control-group">
              <label class="control-label">Jenis Bayar :</label>
              <div class="controls">
                <select id="jenis_transaksi"
                class="form-control custom-select-value"
                name="jenis_transaksi" onchange="pilihBayar();">
                <option value="Tunai">Tunai</option>
                <option value="Kredit">Kredit</option>
              </select>
            </div>
          </div>
          <div id="jatuh_tempo" class="control-group" style="display: none;">
            <label class="control-label">Jatuh Tempo :</label>
            <div class="controls">
              <input type="date" class="form-control" name="tanggal" data-date-format="yyyy-MM-dd" required/>
            </div>
          </div>
          <div class="form-actions">
            <button type="submit" class="btn btn-success">Save</button>
            <button class="btn btn-white" type="submit">Cancel</button>
          </div>
          {{ csrf_field() }}
        </form>
      </div>
    </div>
  </div>

  <div class="span6">
    <div class="widget-box">
      <div class="widget-title"> <span class="icon"> <i class="fas fa-truck-moving"></i> </span>
        <h5>Data Supplier</h5>
      </div>
      <div class="widget-content nopadding">
        <form action="#" class="form-horizontal">
          <div class="control-group">
            <label for="normal" class="control-label">Pilih Supplier</label>
            <div class="controls">
              <select id="supplier" class="form-control" name="id_supplier"  onchange="pilihSupplier()">
                <option></option>
                @foreach($supplier as $item)
                  <option value="{{$item->id}}">{{$item->nama}}</option>
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
                  <td>No. Telepon Perusahaan</td>
                  <td></td>
                </tr>
                <tr>
                  <td>Nama CP</td>
                  <td></td>
                </tr>
                <tr>
                  <td>No. Telepon CP</td>
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
        <div class="widget-title"> <span class="icon"> <i class="icon-th"></i> </span>
          <h5>Tabel Pembelian</h5>
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
                <th>Satuan</th>
                <th>Diskon (%)</th>
                <th>Diskon (Rp.)</th>
                <th>Sub Total</th>
              </tr>
            </thead>
            <tbody>
              <?php $no = 0;
              $totalBayar = 0;
              ?>
              @foreach($data as $item)
                <?php
                $total = ($item->price - $item->attributes['diskon_dua']) * $item->quantity;
                $totalBayar += $total;
                $no++?>
                <tr>
                  <td>{{$no}}</td>
                  <td>{{$item->id}}</td>
                  <td>{{$item->name}}</td>
                  <td>Rp. {{number_format($item->price,0,".",".")}}</td>
                  <td>{{$item->quantity}}</td>
                  <td>{{$item->attributes['satuan']}}</td>
                  <td>{{$item->attributes['diskon_satu']}} %</td>
                  <td>
                    Rp. {{number_format($item->attributes['diskon_dua'],0,".",".")}}</td>
                    <td>
                      Rp. {{number_format(($item->price-$item->attributes['diskon_dua'])*$item->quantity,0,".",".")}}
                    </td>
                    <?php
                    ?>
                  </tr>
                @endforeach
                <tr>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                </table>
              </tr>
            </tbody>
          </div>
        </form>

        <div class="sparkline13-graph">
          <div class="datatable-dashv1-list custom-datatable-overright">
            <div id="toolbar" >
              <a href="#" class="btn btn-primary" onclick="onClick();">Tambah</a>
            </div>
          </div>
        </div>

      </div>

      <div class="widget-content nopadding">
        <form action="/pembelian" method="post" class="form-horizontal">
          <div class="control-group">
            <label class="control-label">Biaya Kirim:</label>
            <div class="controls">
              <input type="number" class="form-control" name="" placeholder="Biaya Kirim"/>
            </div>
          </div>
          <div class="control-group">
            <label class="control-label">Jenis Bayar :</label>
            <div class="controls">
              <select id="jenis_transaksi"
              class="form-control custom-select-value"
              name="jenis_transaksi" onchange="pilihBayar();">
              <option value="Tunai">Tunai</option>
              <option value="Kredit">Kredit</option>
            </select>
          </div>
        </div>
        <div class="control-group">
          <label class="control-label">Uang Muka :</label>
          <div class="controls">
            <input type="number" class="form-control" name="" placeholder="Uang Muka" required/>
          </div>
        </div>
        <div class="control-group">
          <label class="control-label";"col-md-8" >Sisa Piutang :</label>
          <div class="controls">
            <input type="number" class="form-control" name="" placeholder="Sisa Piutang" required/>
          </div>
        </div>
        {{-- <div class="form-actions">
        <button type="submit" class="btn btn-success">Save</button>
        <button class="btn btn-white" type="submit">Cancel</button>
      </div> --}}
      {{ csrf_field() }}
    </form>
  </div>


</div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<script type="text/javascript">
function pilihSupplier() {
  var xmlhttp = new XMLHttpRequest();
  var value = document.getElementById("supplier").value;
  if (value != "") {
    xmlhttp.open("GET", "/pembelian/fetch/" + value, false);
    xmlhttp.send(null);
    document.getElementById("detail_sup").innerHTML = xmlhttp.responseText;
  } else {
    alert('Supplier Kosong')
  }
}

function onClick() {
  var value = document.getElementById("supplier").value;
  if (value != "") {
    window.location.href = "/pembelian/create/" + value;
  } else {
    alert('Supplier Kosong');
  }
}

function pilihBayar() {
  var bayar = document.getElementById("jenis_transaksi").value;
  var tempo = document.getElementById("jatuh_tempo");
  if (bayar == "Kredit") {
    tempo.style.display = "inline";
  } else {
    tempo.style.display = "none";
  }
}

function biayaKirim() {
  var kirim = +document.getElementById("biaya_kirim").value;
  var total = +'<?=$totalBayar?>';
  var totall = document.getElementById("total").value = parseInt(total + kirim);
}

function diskonSatu() {
  var diskon_satu = +document.getElementById("diskon_satu").value;
  var kirim = +document.getElementById("biaya_kirim").value;
  var total = +'<?=$totalBayar?>' + kirim;
  var diskon_dua = document.getElementById("diskon_dua").value = parseFloat((total / 100) * diskon_satu);
  var netto = document.getElementById("netto").value = parseFloat(total - diskon_dua);

}

function uangMuka() {
  var uang = +document.getElementById("uang").value;
  var netto = +document.getElementById("netto").value;
  document.getElementById("sisa").value = parseFloat(netto - uang);
}
</script>
@endsection
