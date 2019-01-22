@extends('layout.app')
@section('content')
  <div class="row-fluid">
    <div class="span10">
      <div class="widget-box">
        <div class="widget-title"> <span class="icon"> <i class="fas fa-users"></i> </span>
          <h5>Customer</h5>
        </div>
        <div class="widget-content nopadding">
          <form action="/customer" method="post" class="form-horizontal">
            <div class="control-group">
              <label class="control-label">Nama Toko:</label>
              <div class="controls">
                <input type="text" class="span11" placeholder="Nama Toko" name="nama" value="{{old('nama')}}" required/>
                @if($errors->has('nama'))
                  <p>{{$errors->first('nama')}}</p>
                @endif
              </div>
            </div>
            <div class="control-group">
              <label class="control-label">Email :</label>
              <div class="controls">
                <input type="email" class="span11" placeholder="Email" name="email" value="{{old('email')}}" required/>
                @if($errors->has('email'))
                  <p>{{$errors->first('email')}}</p>
                @endif
              </div>
            </div>
            <div class="control-group">
              <label class="control-label">Alamat :</label>
              <div class="controls">
                <input type="text" class="span11" placeholder="Alamat" name="alamat" value="{{old('alamat')}}" required/>
                @if($errors->has('alamat'))
                  <p>{{$errors->first('alamat')}}</p>
                @endif
              </div>
            </div>
            <div class="control-group">
              <label class="control-label">No. Telepon :</label>
              <div class="controls">
                <input type="number" class="span11" placeholder="No. Telepon" name="telepon" value="{{old('telepon')}}" required/>
                @if($errors->has('telepon'))
                  <p>{{$errors->first('telepon')}}</p>
                @endif
              </div>
            </div>
            <div class="control-group">
              <label class="control-label">Keterangan :</label>
              <div class="controls">
                <select class="form-control custom-select-value"
                name="keterangan">
                <option>Perorangan</option>
                <option>Grosiran</option>
                <option>Kelontong</option>
                <option>Perusahaan</option>
              </select>
              @if($errors->has('keterangan'))
                <p>{{$errors->first('keterangan')}}</p>
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
</div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  @endsection
