@extends('layout.app')
@section('content')
  <div class="row-fluid">
    <div class="span10">
      <div class="widget-box">
        <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
          <h5>Supplier</h5>
        </div>
        <div class="widget-content nopadding">
          <form action="/barang/{{$barang->id_barang}}/edit" method="POST">
            <label class="login2 pull-right pull-right-pro">Kode Barang </label>
            <input type="number" class="form-control" name="id_barang" placeholder="Kode Barang" value="{{$barang->id_barang}}"/>
          </div>
          <form action="/barang/edit/{{$barang->id_barang}}" method="post" class="form-horizontal">
            <div class="control-group">
              <label class="control-label">Nama Barang :</label>
              <div class="controls">
                <input type="text" class="form-control" name="nama_barang" placeholder="Nama Barang" value="{{$barang->nama_barang}}"/>
              </div>
            </div>
            <div class="control-group">
              <label class="control-label">Nama Supplier :</label>
              <div class="controls">
                <select class="form-control custom-select-value" name="id_supplier">
                  <option value="{{$barang->id_supplier}}">{{$barang->nama}}</option>
                  @foreach($supplier as $item)
                    <option value="{{$item->id}}">{{$item->nama}}</option>
                  @endforeach
                </select>
              </div>
            </div>
            <div class="control-group">
              <label class="control-label">Kategori :</label>
              <div class="controls">
                <select class="form-control custom-select-value" name="id_kategori">
                  <option value="{{$barang->id_kategori}}">{{$barang->kategori}}</option>
                  @foreach($kategori as $item)
                    <option value="{{$item->id_kategori}}">{{$item->kategori}}</option>
                  @endforeach
                </select>
              </div>
            </div>
            <div class="control-group">
              <label class="control-label">Harga Beli (Rp.) :</label>
              <div class="controls">
                <input type="number" id="beli" placeholder="Harga Beli" class="form-control harga" name="harga_beli"
                value="{{$barang->harga_beli}}">
              </div>
            </div>
            <div class="control-group">
              <label class="control-label">Harga Jual (Rp.) :</label>
              <div class="controls">
                <input type="number" id="jual" placeholder="Harga Jual" class="form-control harga" name="harga_jual"
                value="{{$barang->harga_jual}}">
              </div>
            </div>
            <div class="control-group">
              <label class="control-label">Laba :</label>
              <div class="controls">
                <input type="number" id="laba" name="laba" placeholder="0" class="form-control" disabled
                value="{{$barang->laba}}">
                <span class="input-group-addon">%</span>
              </div>
            </div>
            <div class="control-group">
              <label class="control-label">Satuan 1 :</label>
              <div class="controls">
                <select id="ddSatuan_satu" class="form-control custom-select-value"  name="satuan_satu"
                onchange="satuanDua();">
                <option>{{$barang->satuan_satu}}</option>
                <option value="pcs">pcs</option>
                <option value="gr">gr</option>
              </select>
            </div>
          </div>
          <div class="control-group">
            <label class="control-label">Satuan 2:</label>
            <div class="controls">
              <input id="txtSatuan_dua" type="text" onkeyup="satuanTiga();"
              placeholder="Satuan" class="form-control satuandua" name="satuan_dua"
              value="{{$barang->satuan_dua}}">
            </div>
          </div>
          <div class="control-group">
            <input type="text" id="beli" placeholder="Stok"
            class="form-control harga" name="stok_dua"
            value="{{$barang->stok_dua}}">
          </div>
          <div class="controls">
          <select id="ddSatuan_dua"
          class="form-control custom-select-value"
          name="satuan_turunan_dua">
          <option>{{$barang->satuan_turunan_dua}}</option>
        </select>
      </div>
        <div class="form-actions">
          <button type="submit" class="btn btn-success">Save</button>
        </div>
        {{ csrf_field() }}
        <input type="hidden" name="_method" value="PUT">
      </form>
    </div>
  </div>
</div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
@endsection
