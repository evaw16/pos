@extends('layout.app')
@section('content')
  <div class="row-fluid">
    <div class="span6">
      <div class="widget-box">
        <div class="widget-title"> <span class="icon"> <i class="icon-briefcase"></i> </span>
          <h5>Barang</h5>
        </div>

        <div class="widget-content nopadding">
          <form action="#" class="form-horizontal">
            <div class="control-group">
              <label for="normal" class="control-label">Pilih Barang</label>
              <div class="controls">
                <select class="form-control" onchange="kartuStok()" id="kartu" name="kartu">
                  <option></option>
                  @foreach($barang as $item)
                    <option value="{{$item->id_barang}}">{{$item->nama_barang}}</option>
                  @endforeach
                </select>
                {{csrf_field()}}
              </div>
            </div>
          </div>
        {{-- <div class="control-group">
          <label class="control-label">Barang</label>
          <div class="controls">
            <select class="form-control" onchange="kartuStok()" id="kartu" name="kartu">
              <option></option>
              @foreach($barang as $item)
                <option value="{{$item->id_barang}}">{{$item->nama_barang}}</option>
              @endforeach
            </select>
            {{ csrf_field() }}
          </div>
        </div> --}}
      </div>
    </div>

  <div class="span6">
    <div class="widget-box">
      <div class="widget-title"> <span class="icon"> <i class="icon-file"></i> </span>
        <h5>Kartu Stok</h5>
      </div>

      <div class="widget-content nopadding">
        <div id="detail_sup">
          <table class="table table-bordered table-striped">
            <thead>
              <tr>
                <th>Tanggal</th>
                <th>Hari</th>
                <th>Faktur</th>
                <th>Keterangan</th>
                <th>Masuk</th>
                <th>Keluar</th>
                <th>Saldo</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>

  <script>
  function kartuStok() {
    var xmlhttp = new XMLHttpRequest();
    var value = document.getElementById("kartu").value;
    if (value != "") {
      xmlhttp.open("GET", "/kartu_stok/fetch/" + value, false);
      xmlhttp.send(null);
      document.getElementById("detail_sup").innerHTML = xmlhttp.responseText;
      var tbody = document.querySelector("#results tbody");
      // get trs as array for ease of use
      var rows = [].slice.call(tbody.querySelectorAll("tr"));
      rows.sort(function(a,b) {
        return convertDate(a.cells[0].innerHTML) - convertDate(b.cells[0].innerHTML);
      });
      rows.forEach(function(v) {
        tbody.appendChild(v); // note that .appendChild() *moves* elements
      });
    } else {
      alert('Barang Kosong')
    }
  }
  function convertDate(d) {
    var p = d.split("/");
    return +(p[2]+p[1]+p[0]);
  }
  function sortByDate() {
  }
  </script>

@endsection
