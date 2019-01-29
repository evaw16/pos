@extends('layout.app')
@section('content')
  <div class="row-fluid">
    <div class="span12">
      <div class="widget-box">
        <div class="widget-title"> <span class="icon"> <i class="icon-tasks"></i> </span>
          <h3>Supplier</h3>
        </div>
        <div class="widget-content nopadding">
          <table class="table table-bordered table-striped">
            <thead>
              <tr>
                <th>Nama</th>
                <th>Alamat</th>
                <th>Email</th>
                <th>No. Telepon</th>
                <th>Fax</th>
                <th>Website</th>
                <th>Nama CP</th>
                <th>No. Telepon CP</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($supplier as $item)
                <tr>
                  <td class="center">{{$item->nama}}</td>
                  <td class="center">{{$item->alamat}}</td>
                  <td class="center">{{$item->email}}</td>
                  <td class="center">{{$item->telepon}}</td>
                  <td class="center">{{$item->fax}}</td>
                  <td class="center">{{$item->website}}</td>
                  <td class="center">{{$item->nama_cp}}</td>
                  <td class="center">{{$item->telepon_cp}}</td>
                  <td>
                    <center>
                      <form action="/supplier/edit/{{$item->id}}"
                        style="display: inline">
                        <button class="btn btn-primary" style="width: 37px;">
                          <i class="icon-edit"></i>
                        </button>
                      </form>
                      <form action="/supplier/{{$item->id}}" method="POST"
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
    </div>
  </div>
  <div class="sparkline13-graph">
    <div class="datatable-dashv1-list custom-datatable-overright">
      <div id="toolbar">
        <a href="/supplier/create" class="btn btn-primary">
          Tambah
        </a>
      </div>
    @endsection
