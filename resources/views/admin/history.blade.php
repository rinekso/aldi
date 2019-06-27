<?php $title = 'history';?>
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
      Data Transaksi
    </div>
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="box-contain">
          <div class="box-header">
            <div class="clearfix"></div>
          </div>
          <div class="box-body">
              <table id="datatable-responsive" class="table table-hover table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                <thead>
                  <tr>
                    <th>Id</th>
                    <th>Tipe Transaksi</th>
                    <th>Oleh</th>
                    <th>Jumlah</th>
                    <th>Status</th>
                    <th>Tanggal Transaksi</th>
                    <th>Opsi</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>AA2931</td>
                    <td>SPP</td>
                    <td>Ani</td>
                    <td>300.000</td>
                    <td>Selesai</td>
                    <td>2013/03/20</td>
                    <td>
                      <a class="label label-danger" href="javascript:;"><i class="fa fa-trash"></i></a>
                      <a class="label label-warning" href="javascript:;"><i class="fa fa-edit"></i></a>
                    </td>
                  </tr>
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
@endsection('js')