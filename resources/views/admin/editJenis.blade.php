<?php $title = 'periode';?>
@extends('admin.layout')
@section('css')

  <link href="/assets/plugins/select2/select2.min.css" rel="stylesheet">

  <link href="/assets/plugins/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
  <link href="/assets/plugins/datatables.net-buttons-bs/css/buttons.bootstrap.min.css" rel="stylesheet">
  <link href="/assets/plugins/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css" rel="stylesheet">
  <link href="/assets/plugins/datatables.net-responsive-bs/css/responsive.bootstrap.min.css" rel="stylesheet">
  <link href="/assets/plugins/datatables.net-scroller-bs/css/scroller.bootstrap.min.css" rel="stylesheet">

@endsection
@section('content')
    <div class="row">
      <div class="col-md-2"></div>
      <div class="col-md-8 col-sm-12 col-xs-12">
        <div class="box-contain">
        <form action="{{url('/adm/pembayaran/edit')}}" method="post">
        {{csrf_field()}}
          <div class="box-header">
            Edit Jenis Pembayaran
            <div class="clearfix"></div>
          </div>
          <div class="box-body">
              <div class="form-group">
                <label class="control-label" for="name">
                Jenis Pembayaran
                </label>
                <div class="ln_solid"></div>
              </div>

              <div class="clearfix"></div>

              <div class="col-md-4">
                <div class="form-group">
                  <label class="control-label" for="name">
                  Nama Pembayaran
                  </label>
                  <input class="form-control" name="nama" value="{{$data->nama}}" placeholder="Nama Pembayaran" required type="text">                          
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label class="control-label" for="name">
                  Jenjang
                  </label>
                  <select name="id_jenjang" class="form-control">
                    @foreach($jenjang as $j)
                      <option @if($data->id_jenjang == $j->id_jenjang) selected @endif value="{{$j->id_jenjang}}">{{$j->nama_jenjang}}</option>
                    @endforeach
                    <option @if($data->id_jenjang == 0) selected @endif value="0">Semua jenjang</option>
                  </select>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label class="control-label" for="name">
                  Tingkat
                  </label>
                  <select name="id_kelas" class="form-control">
                    @foreach($kelas as $j)
                      <option @if($data->id_kelas == $j->id_jenjang) selected @endif value="{{$j->id_kelas}}">{{$j->tingkat}}</option>
                    @endforeach
                    <option @if($data->id_kelas == 0) selected @endif value="0">Semua tingkat</option>
                  </select>
                </div>
              </div>
              <div class="col-md-12">
                <div class="form-group">
                  <label class="control-label" for="name">
                  Periode
                  </label>
                  <select name="periode" required id="periode" class="form-control" onchange="periodeChange()">
                    <option @if($data->periode == 1) selected @endif value="1">bulanan</option>
                    <option @if($data->periode == 3) selected @endif value="3">3 bulanan</option>
                    <option @if($data->periode == 6) selected @endif value="6">1 semester</option>
                    <option @if($data->periode == 12) selected @endif value="12">tahunan</option>
                    <option @if($data->periode == 13) selected @endif value="13">sekali</option>
                  </select>
                </div>
              </div>
              <div class="col-md-12" id="calendar">
                <span>klik bulan dimana pembayaran dimulai</span>
                <input type="hidden" name="start" value="{{$data->bulan_start}}" id="startPembayaran">
                <table class="table table-bordered">
                  <tr>
                    <td onclick="changePeriodeStart(1)">Januari</td>
                    <td onclick="changePeriodeStart(2)">Februari</td>
                    <td onclick="changePeriodeStart(3)">Maret</td>
                    <td onclick="changePeriodeStart(4)">April</td>
                    <td onclick="changePeriodeStart(5)">Mei</td>
                    <td onclick="changePeriodeStart(6)">Juni</td>
                  </tr>
                  <tr>
                    <td onclick="changePeriodeStart(7)">Juli</td>
                    <td onclick="changePeriodeStart(8)">Agustus</td>
                    <td onclick="changePeriodeStart(9)">September</td>
                    <td onclick="changePeriodeStart(10)">Oktober</td>
                    <td onclick="changePeriodeStart(11)">November</td>
                    <td onclick="changePeriodeStart(12)">Desember</td>
                  </tr>
                </table>
              </div>
              <div class="col-md-12">
                <div class="form-group">
                  <label class="control-label" for="name">
                  Nominal
                  </label>
                  <input class="form-control" name="nominal" value="{{$data->nominal}}" placeholder="Nominal" required type="number">
                </div>
              </div>
              <div class="col-md-12">
                <div class="form-group">
                  <label class="control-label" for="name">
                  Keterangan
                  </label>
                  <textarea class="form-control" name="keterangan" placeholder="keterangan" style="resize: none;">{{$data->keterangan}}</textarea>
                </div>
              </div>
              <div class="clearfix"></div>
              <div class="ln_solid"></div>
          </div>
          <div class="box-footer">
            <input type="hidden" name="id" value="{{$data['id_pembayaran']}}">
            <button id="send" type="submit" class="btn btn-success" onclick="return confirm('are you sure?')">Edit</button>
          </div>
          </form>
        </div>
      </div>

    </div>
@endsection
@section('js')
<!-- jQuery custom content scroller -->
<script src="/assets/plugins/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.concat.min.js"></script>
<!-- bootstrap-daterangepicker -->
<script src="/assets/plugins/moment/moment.min.js"></script>
<script src="/assets/plugins/datepicker/daterangepicker.js"></script>
<!-- bootstrap-wysiwyg -->
<script src="/assets/plugins/bootstrap-wysiwyg/js/bootstrap-wysiwyg.min.js"></script>
<script src="/assets/plugins/google-code-prettify/src/prettify.js"></script>
<script src="/assets/plugins/jquery.hotkeys/jquery.hotkeys.js"></script>
<!-- validator -->
<script src="/assets/plugins/validator/validator.min.js"></script>
<!-- jQuery Tags Input Custom For Email -->
<script src="/assets/plugins/jquery.tagsinput/src/jquery.tagsinput.js"></script>
<!-- select2 -->
<script src="/assets/plugins/select2/select2.full.js"></script>
<!-- Table -->
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
var arrBg = ['bg-danger','bg-warning','bg-success','bg-info'];
function periodeChange(){
  removeClassCalender();
  showCalendar();
  changePeriodeStart(1);
}
function changePeriodeStart(month){
  $("#startPembayaran").val(month);
  var devide = $("#periode").val();
  removeClassCalender();
  if(devide == 13){
    $("#calendar tr td:eq("+(month-1)+")").addClass(arrBg[0]);
  }else{
    devideMonth(devide,month);
  }

}
function devideMonth(devide,start){
  var coundTd = $("#calendar tr td").length;
  var devideIterasi = 0;
  var bgIterasi = 0;
  for (var i = start-1; i < coundTd; i++) {
    $("#calendar tr td:eq("+i+")").addClass(arrBg[bgIterasi]);
    if(devideIterasi == devide-1){
      devideIterasi = 0;
      bgIterasi++;
      if(bgIterasi == arrBg.length){
        bgIterasi = 0;
      }
    }else{
      devideIterasi++;
    }
  }
}
function removeClassCalender(){
  var coundTd = $("#calendar tr td").length;
  for (var i = 0; i < coundTd; i++) {
    $("#calendar tr td:eq("+i+")").removeAttr("class");
  }
}
function showCalendar(){
    $("#calendar").show();
}
function hideCalendar(){
    $("#calendar").hide();
}
$(document).ready(function(){
  $('[data-toggle="tooltip"]').tooltip();
  showCalendar();
  changePeriodeStart($('#startPembayaran').val());

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