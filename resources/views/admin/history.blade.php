<?php $title = 'history';?>
@extends('admin.layout')
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