@extends('layout.app')
@section('content')
  <div class="row-fluid">
    <div class="span10">
      <div class="widget-box">
        <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
          <h5>Supplier</h5>
        </div>
        <div class="widget-content nopadding">
          <form action="/supplier/edit/{{$supplier->id}}" method="post" class="form-horizontal">
            <div class="control-group">
              <label class="control-label">Nama :</label>
              <div class="controls">
                <input type="text" class="span11" placeholder="Nama" name="nama" value="{{$supplier->nama}}"/>
              </div>
            </div>
            <div class="control-group">
              <label class="control-label">Alamat :</label>
              <div class="controls">
                <input type="text" class="span11" placeholder="Alamat" name="alamat" value="{{$supplier->alamat}}"/>
              </div>
            </div>
            <div class="control-group">
              <label class="control-label">Email :</label>
              <div class="controls">
                <input type="email"  class="span11" placeholder="Email" name="email" value="{{$supplier->email}}"/>
              </div>
            </div>
            <div class="control-group">
              <label class="control-label">No. Telepon :</label>
              <div class="controls">
                <input type="number" class="span11" placeholder="No. Telepon" name="telepon" value="{{$supplier->telepon}}"/>
              </div>
            </div>
            <div class="control-group">
              <label class="control-label">Fax :</label>
              <div class="controls">
                <input type="number" class="span11" placeholder="Fax" name="fax" value="{{$supplier->fax}}"/>
              </div>
            </div>
            <div class="control-group">
              <label class="control-label">Website :</label>
              <div class="controls">
                <input type="text" class="span11" placeholder="Website" name="website" value="{{$supplier->website}}"/>
              </div>
            </div>
            <div class="control-group">
              <label class="control-label">Nama CP :</label>
              <div class="controls">
                <input type="text" class="span11" placeholder="Nama CP" name="nama_cp" value="{{$supplier->nama_cp}}"/>
              </div>
            </div>
            <div class="control-group">
              <label class="control-label">No. Telepon CP :</label>
              <div class="controls">
                <input type="number" class="span11" placeholder="No. Telepon CP" name="telepon_cp" value="{{$supplier->telepon_cp}}"/>
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
