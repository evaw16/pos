@extends('layout.app')
@section('content')
  <div class="row-fluid">
    <div class="span6">
      <div class="widget-box">
        <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
          <h5>Tambah Barang</h5>
        </div>
        <div class="widget-content nopadding">
          <form action="/barang" method="POST" class="form-horizontal">
            <div class="control-group">
              <label class="control-label">Kode Barang :</label>
              <div class="controls">
                <input type="number" class="form-control" name="id_barang"
                placeholder="Kode Barang"
                value="0000{{$id}}"/>
                @if($errors->has('id_barang'))
                  <p>{{$errors->first('id_barang')}}</p>
                @endif
              </div>
            </div>
            <div class="control-group">
              <label class="control-label">Nama Barang :</label>
              <div class="controls">
                <input type="text" class="span11" name="nama_barang" placeholder="Nama Barang" value="{{old('nama_barang')}}"
                @if($errors->has('nama_barang')) <p>{{$errors->first('nama_barang')}}</p>
                @endif />
              </div>
            </div>
            <div class="control-group">
              <label class="control-label">Supplier :</label>
              <div class="controls">
                <select class="span11" placeholder="Nama Supplier" name="id_supplier">
                  @foreach($supplier as $item)
                    <option value="{{$item->id}}">{{$item->nama}}</option>
                  @endforeach
                </select>
                @if($errors->has('id_supplier'))
                  <p>{{$errors->first('id_supplier')}}</p>
                @endif
              </div>
            </div>
            <div class="control-group">
              <label class="control-label">Kategori :</label>
              <div class="controls">
                <select  class="span11" placeholder="Kategori" name="id_kategori">
                  @foreach($kategori as $item)
                    <option value="{{$item->id_kategori}}">{{$item->kategori}}</option>
                  @endforeach
                </select>
                @if($errors->has('id_kategori'))
                  <p>{{$errors->first('id_kategori')}}</p>
                @endif
              </div>
            </div>
            <div class="control-group">
              <label class="control-label">Harga Beli (Rp.) :</label>
              <div class="controls">
                <input type="number" class="span11 harga" id="beli" placeholder="Harga Beli" name="harga_beli"
                value="{{old('harga_beli')}}">
                @if($errors->has('harga_beli'))
                  <p>{{$errors->first('harga_beli')}}</p>
                @endif
              </div>
            </div>
            <div class="control-group">
              <label class="control-label">Harga Jual (Rp.) :</label>
              <div class="controls">
                <input type="number" class="span11 harga" id="jual" placeholder="Harga Jual"
                class="form-control harga" name="harga_jual" value="{{old('harga_jual')}}">
                @if($errors->has('harga_jual'))
                  <p>{{$errors->first('harga_jual')}}</p>
                @endif
              </div>
            </div>
            <div class="control-group">
              <label class="control-label">Laba (%) :</label>
              <div class="controls">
                <input type="number" id="laba" name="laba" placeholder="0" class="form-control" disabled
                value="{{old('laba')}}">
                @if($errors->has('laba'))
                  <p>{{$errors->first('laba')}}</p>
                @endif
                <span class="input-group-addon">%</span>
              </div>
            </div>

            <div class="control-group">
              <label class="control-label">Satuan 1 :</label>
              <div class="controls">
                <select id="ddSatuan_satu"
                class="form-control custom-select-value" name="satuan_satu" onchange="satuanDua();">
                <option></option>
                <option value="PCS">PCS</option>
                <option value="Gr">Gr</option>
              </select>
              @if($errors->has('satuan_satu'))
                <p>{{$errors->first('satuan_satu')}}</p>
              @endif
            </div>
            <div class="control-group">
              <label class="control-label">Satuan 2 :</label>
              <div class="controls">
                <input id="txtSatuan_dua" type="text" onkeyup="satuanTiga();" placeholder="Satuan"
                class="form-control satuandua" name="satuan_dua" value="">
                <input type="text" id="beli" placeholder="Jumlah" class="form-control harga" name="stok_dua" value="">
                <select id="ddSatuan_dua" class="form-control custom-select-value" name="satuan_turunan_dua"></select>
              </div>
            </div>
            <div class="control-group">
              <label class="control-label">Satuan 3 :</label>
              <div class="controls">
                <input id="txtSatuan_tiga" type="text" onkeyup="satuanEmpat();" placeholder="Satuan"
                class="form-control harga" name="satuan_tiga" value="">
                <input type="text" id="beli" placeholder="Jumlah" class="form-control harga" name="stok_tiga" value="">
                <select id="ddSatuan_tiga" class="form-control custom-select-value" name="satuan_turunan_tiga"></select>
              </div>
            </div>
            <div class="control-group">
              <label class="control-label">Satuan 4 :</label>
              <div class="controls">
                <input id="txtSatuan_empat" type="text" onkeyup="satuansatuan()" placeholder="Satuan"
                class="form-control harga" name="satuan_empat" value="">
                <input type="text" id="beli" placeholder="Jumlah"
                class="form-control harga" name="stok_empat" value="">
                <select id="ddSatuan_empat" class="form-control custom-select-value" name="satuan_turunan_empat"></select>
              </div>
            </div>

            <div class="form-actions">
              <button type="submit" class="btn btn-success">Save</button>
              <button class="btn btn-white" type="submit">Cancel</button>
            </div>
            {{csrf_field()}}
          </form>
        </div>
      </div>
    </div>
  </div>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script type="text/javascript">
  $('.controls').on('input', '.harga', function () {
    var laba = 0;
    $('.controls .harga').each(function () {
      var beli = $('#beli').val();
      var jual = $('#jual').val();
      var input = $(this).val();
      if ($.isNumeric(input)) {
        laba = parseFloat((jual - beli) / beli) * 100;
      }
    })
    $('#laba').val(laba);
  })
</script>
<script>
function satuanDua() {
  var s1 = document.getElementById("ddSatuan_satu").value;
  var s2 = document.getElementById("ddSatuan_dua");
  var stok = document.getElementById("ddStok");
  s2.innerHTML = "";
  if (s1 == "PCS") {
    var optionArray = ["|","PCS|PCS"];
  } else {
    var optionArray = ["|","Gr|Gr"];
  }
  for (var option in optionArray) {
    var pair = optionArray[option].split("|");
    var newOption = document.createElement("option");
    newOption.value = pair[0];
    newOption.innerHTML = pair [1];
    s2.options.add(newOption);
  }
  stok.innerHTML = "";
  for (var option in optionArray) {
    var pair = optionArray[option].split("|");
    var newOption = document.createElement("option");
    newOption.value = pair[0];
    newOption.innerHTML = pair [1];
    stok.options.add(newOption);
  }
}
function satuanTiga() {
  var s2 = $('#txtSatuan_dua').val();
  var s1 = document.getElementById("ddSatuan_satu").value;
  var s3 = document.getElementById("ddSatuan_tiga");
  var stok = document.getElementById("ddStok");
  s3.innerHTML = '';
  var optionArray = ["|", s1 + "|" + s1, s2 + "|" + s2];
  for (var option in optionArray) {
    var pair = optionArray[option].split("|");
    var newOption = document.createElement("option");
    newOption.value = pair[0];
    newOption.innerHTML = pair [1];
    s3.options.add(newOption);
  }
  stok.innerHTML = "";
  for (var option in optionArray) {
    var pair = optionArray[option].split("|");
    var newOption = document.createElement("option");
    newOption.value = pair[0];
    newOption.innerHTML = pair [1];
    stok.options.add(newOption);
  }
}
function satuanEmpat() {
  var s3 = $('#txtSatuan_tiga').val();
  var s1 = document.getElementById("ddSatuan_satu").value;
  var s2 = document.getElementById("txtSatuan_dua").value;
  var s4 = document.getElementById("ddSatuan_empat");
  var stok = document.getElementById("ddStok");
  s4.innerHTML = '';
  var optionArray = ["|", s1 + "|" + s1, s2 + "|" + s2, s3 + "|" + s3];
  for (var option in optionArray) {
    var pair = optionArray[option].split("|");
    var newOption = document.createElement("option");
    newOption.value = pair[0];
    newOption.innerHTML = pair [1];
    s4.options.add(newOption);
  }
  stok.innerHTML = "";
  for (var option in optionArray) {
    var pair = optionArray[option].split("|");
    var newOption = document.createElement("option");
    newOption.value = pair[0];
    newOption.innerHTML = pair [1];
    stok.options.add(newOption);
  }
}
function satuansatuan() {
  var s4 = $('#txtSatuan_empat').val();
  var s3 = document.getElementById("txtSatuan_tiga").value;
  var s1 = document.getElementById("ddSatuan_satu").value;
  var s2 = document.getElementById("txtSatuan_dua").value;
  var stok = document.getElementById("ddStok");
  var optionArray = ["|", s1 + "|" + s1, s2 + "|" + s2, s3 + "|" + s3, s4 + "|" + s4];
  stok.innerHTML = "";
  for (var option in optionArray) {
    var pair = optionArray[option].split("|");
    var newOption = document.createElement("option");
    newOption.value = pair[0];
    newOption.innerHTML = pair [1];
    stok.options.add(newOption);
  }
}
</script>
@endsection
