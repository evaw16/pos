@extends('layout.app')
@section('content')
  <div class="row-fluid">
    <div class="span10">
      <div class="widget-box">
        <div class="widget-title"> <span class="icon"> <i class="fas fa-users"></i> </span>
          <h5>Customer</h5>
        </div>
        <div class="widget-content nopadding">
          <form action="/customer/edit/{{$customer->id_customer}}" method="post" class="form-horizontal">
            <div class="control-group">
              <label class="control-label">Nama Toko:</label>
              <div class="controls">
                <input type="text" class="span11" placeholder="Nama Toko" name="nama" value="{{$customer->nama}}"/>
              </div>
            </div>
            <div class="control-group">
              <label class="control-label">Alamat :</label>
              <div class="controls">
                <input type="text" class="span11" placeholder="Alamat" name="alamat" value="{{$customer->alamat}}"/>
              </div>
            </div>
            <div class="control-group">
              <label class="control-label">Email :</label>
              <div class="controls">
                <input type="email"  class="span11" placeholder="Email" name="email" value="{{$customer->email}}"/>
              </div>
            </div>
            <div class="control-group">
              <label class="control-label">No. Telepon :</label>
              <div class="controls">
                <input type="number" class="span11" placeholder="No. Telepon" name="telepon" value="{{$customer->telepon}}"/>
              </div>
            </div>
            <div class="control-group">
              <label class="control-label">Kategori :</label>
              <div class="controls">
                <select class="form-control custom-select-value" name="keterangan">
                  <option>{{$customer->keterangan}}</option>
                  <option>Perorangan</option>
                  <option>Grosiran</option>
                  <option>Kelontong</option>
                  <option>Perusahaan</option>
                </select>
              </div>
            </div>
            <div class="form-actions" style="margin-left:690px">
              <button class="btn btn-white" type="submit">Cancel</button>
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
