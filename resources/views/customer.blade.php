@extends('layout.app')
@section('content')
  <div class="row-fluid">
    <div class="span12">
      <div class="widget-box">
        <div class="widget-title"> <span class="icon"> <i class="fas fa-users"></i></span>
          <h3>Customer</h3>
        </div>
        <div class="widget-content nopadding">
          <table class="table table-bordered table-striped">
            <thead>
              <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Email</th>
                <th>Alamat</th>
                <th>No. Telepon</th>
                <th>Kategori</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              <?php $no = 0?>
              @foreach($customer as $item)
                <?php $no++?>
                <tr>
                  <td class="center">{{$no}}</td>
                  <td class="center">{{$item->nama}}</td>
                  <td class="center">{{$item->email}}</td>
                  <td class="center">{{$item->alamat}}</td>
                  <td class="center">{{$item->telepon}}</td>
                  <td class="center">{{$item->keterangan}}</td>
                  <td>
                    <center>
                      <form action="/customer/edit/{{$item->id_customer}}"
                        style="display: inline">
                        <button class="btn btn-primary" style="width: 37px;">
                          <i class="icon-edit"></i>
                        </button>
                      </form>
                      <form action="/customer/{{$item->id_customer}}" method="POST"
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

      <div class="sparkline13-graph">
        <div class="datatable-dashv1-list custom-datatable-overright">
          <div id="toolbar">
            <a href="/customer/create" class="btn btn-primary">Tambah</a>
          </div>
        </div>
      </div>
    @endsection
