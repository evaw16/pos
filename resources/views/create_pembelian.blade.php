@extends('layout.app')
@section('content')
  <div class="row-fluid">
    <div class="span6">
      <div class="widget-box">
        <div class="widget-title"> <span class="icon"> <i class="fas fa-users"></i> </span>
          <h5>Pembelian</h5>
        </div>
        <div class="widget-content nopadding">
          <form action="/pembelian" method="post" class="form-horizontal">
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
                <select class="form-control custom-select-value" name="satuan">
                  <option></option>
                </select>
              </div>
            </div>
          </div>
          <div class="control-group">
            <label class="control-label">Jumlah :</label>
            <div class="controls">
              <input type="number" class="form-control" name="jumlah" placeholder="Jumlah" value="{{old('jumlah')}}" required/>
              @if($errors->has('jumlah'))
                <p>{{$errors->first('jumlah')}}</p>
              @endif
            </div>
          </div>
          <div class="control-group">
            <label class="control-label">Diskon (%) :</label>
            <div class="controls">
              <input type="number" id="diskon_satu" min="0" max="100"
              class="form-control diskon" name="diskon_satu" placeholder="Diskon (%)" value="{{old('diskon_satu')}}" required/>
              <span class="input-group-addon">%</span>
              @if($errors->has('diskon_satu'))
                <p>{{$errors->first('diskon_satu')}}</p>
              @endif
            </div>
          </div>
          <div class="control-group">
            <label class="control-label">Diskon (Rp.) :</label>
            <div class="controls">
              <input type="number" id="diskon_dua" class="form-control"
              name="diskon_dua" placeholder="Diskon (Rp.)"
              value="{{old('diskon_dua')}}" disabled/>
              @if($errors->has('diskon_dua'))
                <p>{{$errors->first('diskon_dua')}}</p>
              @endif
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
  $('.input-group').on('input', '.diskon', function () {
    var laba = 0;
    $('.input-group .diskon').each(function () {
      var harga = $('#harga').val();
      var diskon_satu = $('#diskon_satu').val();
      var input = $(this).val();
      if ($.isNumeric(input)) {
        laba = parseFloat(diskon_satu / 100 * harga);
      }
    });
    $('#diskon_dua').val(laba);
  });
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
</script>
@endsection
