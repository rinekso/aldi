<?php $title = 'jenis';?>
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
      <div class="col-md-7 col-sm-12 col-xs-12">
        <div class="box-contain">
          <div class="box-header">
            Data jenis Pembayaran
          </div>
          <div class="box-body">
            <table id="datatable-responsive" class="table table-hover table-bordered">
              <thead>
                <tr>
                  <th>Nama Pembayaran</th>
                  <th>Nominal</th>
                  <th>Mulai Pembayaran</th>
                  <th>Jenjang</th>
                  <th>Kelas</th>
                  <th>Keterangan</th>
                  <th>Opsi</th>
                </tr>
              </thead>
              <tbody>
                @foreach($pembayaran as $p)
                <tr>
                  <td>{{$p->nama}}</td>
                  <td align="right">Rp. {{number_format($p->nominal,0,",",".")}}</td>
                  <td>{{$p->tanggal_start}} {{date('F', mktime(0, 0, 0, $p->bulan_start, 10))}} {{$p->tahun}}</td>
                  @if(!empty($p->jenjang))
                    <td>{{$p->jenjang->nama_jenjang}}</td>
                  @else
                    <td>Semua Jenjang</td>
                  @endif
                  @if(!empty($p->kelas))
                    <td>{{$p->kelas->tingkat}}</td>
                  @else
                    <td>Semua Kelas</td>
                  @endif
                  <td>{{substr($p->keterangan,0,30)}}</td>
                  <td>
                    <a class="label label-success" href="{{url('/adm/pembayaran/laporan/'.$p->id_pembayaran)}}" title="laporan" data-toggle="tooltip" data-placement="top"><i class="fa fa-list"></i></a>
                    <a class="label label-warning" href="{{url('/adm/pembayaran/edit/'.$p->id_pembayaran)}}" title="edit" data-toggle="tooltip" data-placement="top"><i class="fa fa-edit"></i></a>
                    <a class="label label-danger" href="{{url('/adm/pembayaran/delete/'.$p->id_pembayaran)}}" title="hapus" data-toggle="tooltip" data-placement="top" onclick="return confirm('are you sure?')"><i class="fa fa-trash"></i></a>
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
      <div class="col-md-5 col-sm-12 col-xs-12">
        <div class="box-contain">
        <form action="{{url('/adm/pembayaran/tambah')}}" method="post">
        {{csrf_field()}}
          <div class="box-header">
            Tambah Jenis Pembayaran
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
                  <input class="form-control" name="nama" placeholder="Nama Pembayaran" required type="text">                          
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label class="control-label" for="name">
                  Jenjang
                  </label>
                  <select name="id_jenjang" id="jenjang" class="form-control" onchange="jenjangChange()">
                    <option value="0">Semua jenjang</option>
                    @foreach($jenjang as $j)
                      <option value="{{$j->id_jenjang}}"  data-max="{{$j->max_tingkat}}">{{$j->nama_jenjang}}</option>
                    @endforeach
                  </select>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label class="control-label" for="name">
                  Tingkat
                  </label>
                  <select name="id_kelas" id="kelas" class="form-control">
                    <option value="0">Semua tingkat</option>
                    @foreach($kelas as $j)
                      <option value="{{$j->id_kelas}}" >{{$j->tingkat}}</option>
                    @endforeach
                  </select>
                </div>
              </div>
              <div class="col-md-12">
                <div class="form-group">
                  <label class="control-label" for="name">
                  Periode
                  </label>
                  <select name="periode" required id="periode" class="form-control" onchange="periodeChange()">
                    <option selected disabled>pilih periode</option>
                    <option value="1">bulanan</option>
                    <option value="3">3 bulanan</option>
                    <option value="6">semester</option>
                    <option value="12">tahunan</option>
                    <option value="0">sekali</option>
                  </select>
                </div>
              </div>
              <div class="col-md-12" id="calendar">
                <span>klik bulan dimana pembayaran dimulai</span>
                <input type="hidden" name="start" id="startPembayaran">
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

                <div class="form-group">
                  <label class="control-label" for="name">
                  Tanggal Mulai Pembayaran
                  </label>
                  <input class="form-control" name="tanggal_start" placeholder="Tanggal" required type="number">                          
                </div>
              </div>
              <div class="col-md-12">
                <div class="form-group">
                  <label class="control-label" for="name">
                  Nominal
                  </label>
                  <input class="form-control" name="nominal" placeholder="Nominal" required type="number">                          
                </div>
              </div>
              <div class="col-md-12">
                <div class="form-group">
                  <label class="control-label" for="name">
                  Keterangan
                  </label>
                  <textarea class="form-control" name="keterangan" placeholder="keterangan" style="resize: none;"></textarea>
                </div>
              </div>
              <div class="clearfix"></div>
              <div class="ln_solid"></div>
          </div>
          <div class="box-footer">
            <button id="send" type="submit" class="btn btn-success" onclick="return confirm('are you sure?')">Tambah</button>
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
function jenjangChange(){
  hideKelas();
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
function hideKelas(){
  var val = $("#jenjang").val();
  var max = Number($("#jenjang option[value="+val+"]").attr('data-max'));
  var coundTd = $("#kelas option").length;
  for (var i = 0; i < coundTd; i++) {
    if(i<=max)
      $("#kelas option:eq("+i+")").show();
    else
      $("#kelas option:eq("+i+")").hide();
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
  hideCalendar();

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