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
            <a href="{{url('/adm/siswa/tambah')}}" class="btn btn-primary">Tambah Siswa</a>
            <div class="clearfix"></div>
          </div>
          <div class="box-body">
              <table id="datatable-responsive" class="table table-hover table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                <thead>
                  <tr>
                    <th>Id</th>
                    <th>Nama Siswa</th>
                    <th>Kelas</th>
                    <th>Saldo</th>
                    <th>Opsi</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($siswa as $s)
                  <tr>
                    <td>{{$s->id}}</td>
                    <td>{{$s->nama}}</td>
                    <td>{{$s->kelas->tingkat}} - {{$s->jenjang->nama_jenjang}}</td>
                    <td>{{$s->saldo}}</td>
                    <td>
                      <a class="label label-danger" href="{{url('/adm/siswa/delete/'.$s->id)}}"><i class="fa fa-trash"></i></a>
                      <a class="label label-warning" href="{{url('/adm/siswa/edit/'.$s->id)}}"><i class="fa fa-edit"></i></a>
                    </td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
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