<?php $title = 'siswa';?>
@extends('admin.layout')
@section('css')
  <link href="/assets/plugins/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
  <link href="/assets/plugins/datatables.net-buttons-bs/css/buttons.bootstrap.min.css" rel="stylesheet">
  <link href="/assets/plugins/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css" rel="stylesheet">
  <link href="/assets/plugins/datatables.net-responsive-bs/css/responsive.bootstrap.min.css" rel="stylesheet">
  <link href="/assets/plugins/datatables.net-scroller-bs/css/scroller.bootstrap.min.css" rel="stylesheet">
@endsection
@section('content')
    <div class="title-page">
      Data Siswa
    </div>
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="box-contain">
          <div class="box-header">
            <a href="{{url('/adm/siswa/tambah')}}" class="btn btn-primary">Tambah Siswa</a>
            <a href="{{url('/example/download')}}" class="btn btn-warning">Download Struktur Excel</a>
            <a href="#" class="btn btn-success" id="btnExcel" onclick="toggleExcel()">Import Excel</a>
            <form enctype="multipart/form-data" id="excel" class="form" style="width: 700px; display: inline-block;" method="post" action="{{url('/adm/siswa/tambah/excel')}}">
              {{csrf_field()}}
              <div class="col-md-4">
                <input type="file" class="form-control" name="data">
              </div>
              <button type="submit" class="btn btn-success">Import</button>
              <button type="button" onclick="toggleExcel()" class="btn btn-danger">Cancel</button>
            </form>
            <div class="clearfix"></div>
          </div>
          <div class="box-body">
              <table id="datatable-responsive" class="table table-hover table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                <thead>
                  <tr>
                    <th>NIK</th>
                    <th>Nama Siswa</th>
                    <th>Kelas</th>
                    <th>Saldo</th>
                    <th>Opsi</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($siswa as $s)
                  <tr>
                    <td>{{$s->nik}}</td>
                    <td>{{$s->nama}}</td>
                    <td>{{$s->kelas->tingkat}}/{{$s->jenjang->nama_jenjang}}</td>
                    <td>{{$s->saldo}}</td>
                    <td>
                      <a class="label label-success" href="{{url('/adm/siswa/mutasi/'.$s->id)}}" title="laporan" data-toggle="tooltip" data-placement="top"><i class="fa fa-list"></i></a>
                      <a class="label label-danger" href="{{url('/adm/siswa/delete/'.$s->id)}}" title="delete" data-toggle="tooltip" data-placement="top"><i class="fa fa-trash"></i></a>
                      <a class="label label-warning" href="{{url('/adm/siswa/edit/'.$s->id)}}" title="edit" data-toggle="tooltip" data-placement="top"><i class="fa fa-edit"></i></a>
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
<script src="/assets/plugins/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="/assets/plugins/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<script src="/assets/plugins/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
<script src="/assets/plugins/datatables.net-buttons-bs/js/buttons.bootstrap.min.js"></script>
<script src="/assets/plugins/datatables.net-buttons/js/buttons.flash.min.js"></script>
<script src="/assets/plugins/datatables.net-buttons/js/buttons.html5.min.js"></script>
<script src="/assets/plugins/datatables.net-buttons/js/buttons.print.min.js"></script>
<script src="/assets/plugins/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js"></script>
<script src="/assets/plugins/datatables.net-keytable/js/dataTables.keyTable.min.js"></script>
<script src="/assets/plugins/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
<script src="/assets/plugins/datatables.net-responsive-bs/js/responsive.bootstrap.js"></script>
<script src="/assets/plugins/datatables.net-scroller/js/dataTables.scroller.min.js"></script>
<script src="/assets/plugins/jszip/dist/jszip.min.js"></script>
<script src="/assets/plugins/pdfmake/build/pdfmake.min.js"></script>
<script src="/assets/plugins/pdfmake/build/vfs_fonts.js"></script>
<script>
  var ex = false;
function toggleExcel(){
  if(!ex){
    showExcel();
  }else{
    hideExcel();
  }
  ex = !ex;
}
function showExcel(){
  $("#excel").show();
  $("#btnExcel").hide();
}
function hideExcel(){
  $("#excel").hide();
  $("#btnExcel").show();
}
$(document).ready(function(){
  $('[data-toggle="tooltip"]').tooltip();

  hideExcel();
  $('#datatable-responsive').DataTable({
    keys: true,
    dom: "Bfrtip",
    buttons: [
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