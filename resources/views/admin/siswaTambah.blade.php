<?php $title = 'siswa';?>
@extends('admin.layout')
@section('content')
    <div class="title-page">
      Data Siswa
    </div>
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="box-contain">
          <div class="box-header">
            Tambah Siswa
            <div class="clearfix"></div>
          </div>
          <div class="box-body">
            <form class="form" method="post" action="{{url('/adm/siswa/tambah/process')}}">
              {{csrf_field()}}
              <div class="form-group">
                <label class="control-label" for="name">
                Nama
                </label>
                <input class="form-control" name="nama" placeholder="Nama" required type="text">
              </div>
              <div class="form-group">
                <label class="control-label" for="name">
                RFID
                </label>
                <input class="form-control" name="rfid" placeholder="RFID" required type="text">
              </div>
              <div class="form-group">
                <label class="control-label" for="name">
                NIK
                </label>
                <input class="form-control" name="nik" placeholder="NIK" required type="text">
              </div>
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label class="control-label">Jenjang</label>
                      <select name="id_jenjang" class="form-control">
                        @foreach($jenjang as $j)
                          <option value="{{$j->id_jenjang}}">{{$j->nama_jenjang}}</option>
                        @endforeach
                      </select>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label class="control-label">Kelas</label>
                      <select name="id_kelas" class="form-control">
                        @foreach($kelas as $j)
                          <option value="{{$j->id_kelas}}">{{$j->tingkat}}</option>
                        @endforeach
                      </select>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label class="control-label" for="name">
                    Tahun Ajaran
                    </label>
                    <input class="form-control" name="tahun_ajaran" placeholder="20**/20**" required type="text">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label class="control-label" for="name">
                    Saldo
                    </label>
                    <input class="form-control" name="saldo" placeholder="0000" required type="number">
                  </div>
                </div>
              </div>
              <div class="form-group">
                <label class="control-label" for="name">
                PIN
                </label>
                <input class="form-control" name="password" placeholder="****" required type="password">
              </div>
              <button class="btn-success btn">Submit</button>
              <div class="ln_solid"></div>
            </form>
          </div>
        </div>
      </div>

    </div>
@endsection
@section('js')
<script>
$(document).ready(function(){
  $('#datatable-responsive').DataTable({
    keys: true,
    dom: "Bfrtip",
    buttons: [
      {
        extend: "copy",
        className: "btn-sm"
      },
      {
        extend: "csv",
        className: "btn-sm"
      },
      {
        extend: "excel",
        className: "btn-sm"
      },
      {
        extend: "pdfHtml5",
        className: "btn-sm"
      },
      {
        extend: "print",
        className: "btn-sm"
      },
    ],
  });

});
</script>
@endsection