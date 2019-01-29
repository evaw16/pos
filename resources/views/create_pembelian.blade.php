@extends('layout.app')
@section('content')
  <div class="row-fluid">
    <div class="span6">
      <div class="widget-box">
        <div class="widget-title"> <span class="icon"> <i class="fas fa-users"></i> </span>
          <h5>Pembelian</h5>
        </div>
        <div class="widget-content nopadding">
          <form action="/pembelian/barang" method="post" class="form-horizontal">
            <div class="control-group">
              <label class="control-label">Nama Barang:</label>
              <div class="controls">
                <select id="barang"
                class="form-control custom-select-value"
                name="id_barang" onchange="pilihBarang();">
                <option></option>
                @foreach($barang as $item)
                  <option value="{{$item->id_barang}}">{{$item->nama_barang}}</option>
                @endforeach
              </select>
              @if($errors->has('id_barang'))
                <p>{{$errors->first('id_barang')}}</p>
              @endif
            </div>
          </div>
          <div id="detail_barang">
            <div class="control-group">
              <label class="control-label">Harga Beli :</label>
              <div class="controls">
                <input type="number" class="form-control diskon" id="harga" name="harga_beli"
                placeholder="Harga Beli" value="{{old('harga_beli')}}" required/>
                @if($errors->has('harga_beli'))
                  <p>{{$errors->first('harga_beli')}}</p>
                @endif
              </div>
            </div>

            <div class="control-group">
              <label class="control-label">Satuan :</label>
              <div class="controls">
                <select class="form-control custom-select-value" name="satuan" id="satuan">
                  <option></option>
                </select>
              </div>
            </div>
          </div>
          <div class="control-group">
            <label class="control-label">Jumlah :</label>
            <div class="controls">
              <input onkeyup="subTotal()" id="jumlah" type="number"
              class="form-control" name="jumlah"
              placeholder="Jumlah"/>
            </div>
          </div>
          <div class="control-group">
            <label class="control-label">Diskon (%) :</label>
            <div class="controls">
              <input onkeyup="diskonSatu()"
              type="number" id="diskon_satu" min="0" max="100"
              class="form-control" name="diskon_satu"
              placeholder="Diskon (%)"/>
            </div>
          </div>
          <div class="control-group">
            <label class="control-label">Diskon (Rp.) :</label>
            <div class="controls">
              <input onkeyup="diskonDua()"
              type="number" id="diskon_dua"
              class="form-control"
              name="diskon_dua"
              placeholder="Diskon (Rp.)"
              value="{{old('diskon_dua')}}"/>
            </div>
          </div>
          <div class="control-group">
            <label class="control-label">Sub Total :</label>
            <div class="controls">
              <input type="number" id="total"
              class="form-control"
              name="sub_total"
              placeholder="Sub Total (Rp.)"
              disabled/>
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
</div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script type="text/javascript">
function subTotal() {
  var jumlah = +document.getElementById("jumlah").value;
  var satuan_satu = document.getElementById("satuan_satu").value;
  var satuan_dua = document.getElementById("satuan_dua").value;
  var satuan_tiga = document.getElementById("satuan_tiga").value;
  var satuan_empat = document.getElementById("satuan_empat").value;
  var stok_dua = +document.getElementById("stok_dua").value;
  var stok_tiga = +document.getElementById("stok_tiga").value;
  var stok_empat = +document.getElementById("stok_empat").value;
  var satuan_turunan_dua = document.getElementById("satuan_turunan_dua").value;
  var satuan_turunan_tiga = document.getElementById("satuan_turunan_tiga").value;
  var satuan_turunan_empat = document.getElementById("satuan_turunan_empat").value;
  var satuan = document.getElementById("satuan").value;
  var total = document.getElementById("total");
  var harga = +document.getElementById("harga").value;
  if (satuan == satuan_satu) {
    total.value = parseFloat(jumlah * harga);
  } else if (satuan == satuan_dua) {
    total.value = parseFloat(jumlah * stok_dua * harga);
  } else if (satuan == satuan_tiga) {
    if (satuan_turunan_tiga == satuan_satu) {
      total.value = parseFloat(jumlah * stok_tiga * harga);
    } else {
      total.value = parseFloat(jumlah * stok_tiga * stok_dua * harga);
    }
  } else if (satuan == satuan_empat) {
    if (satuan_turunan_empat == satuan_satu) {
      total.value = parseFloat(jumlah * stok_empat * harga);
    } else if (satuan_turunan_empat == satuan_dua) {
      total.value = parseFloat(jumlah * stok_dua * stok_empat * harga);
    } else if (satuan_turunan_tiga == satuan_satu) {
      total.value = parseFloat(jumlah * stok_tiga * stok_empat * harga);
    } else {
      total.value = parseFloat(jumlah * stok_dua * stok_tiga * stok_empat * harga);
    }
  } else {
    alert("satuan Kosong");
  }
}
function pilihBarang() {
  var xmlhttp = new XMLHttpRequest();
  var value = document.getElementById("barang").value;
  if (value != "") {
    xmlhttp.open("GET", "/pembelian/barang/" + value, false);
    xmlhttp.send(null);
    document.getElementById("detail_barang").innerHTML = xmlhttp.responseText;
  } else {
    alert('Supplier Kosong')
  }
}
function diskonSatu() {
  var diskon_satu = document.getElementById("diskon_satu").value;
  var total = document.getElementById("total").value;
  total.value = parseFloat((diskon_satu / 100) * total);
}
function diskonDua() {
  var total = document.getElementById("total").value;
  var diskon_dua = document.getElementById("diskon_dua").value;
  total.value = parseFloat((diskon_dua / 100).value);
}
</script>

@endsection
