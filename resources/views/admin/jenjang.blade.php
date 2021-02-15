<?php $title = 'jenjang';?>
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
            Data Jenjang
          </div>
          <div class="box-body">
            <table id="datatable-responsive" class="table table-hover table-bordered">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Nama Jenjang</th>
                  <th>Maksimum Tingkatan</th>
                  <th>Jenjang Berikutnya</th>
                  <th>Opsi</th>
                </tr>
              </thead>
              <tbody>
                @foreach($jenjang as $key=>$j)
                <tr>
                  <td>{{$key+1}}</td>
                  <td>{{$j->nama_jenjang}}</td>
                  <td>{{$j->max_tingkat}}</td>
                  <td>@if($j->next_jenjang > 0) {{$j->Jenjang->nama_jenjang}} @else Tidak ada @endif</td>
                  <td>
                    <a class="label label-warning" href="{{url('/adm/jenjang/edit/'.$j->id_jenjang)}}" title="edit" data-toggle="tooltip" data-placement="top"><i class="fa fa-edit"></i></a>
                    <a class="label label-danger" href="{{url('/adm/jenjang/delete/'.$j->id_jenjang)}}" title="hapus" data-toggle="tooltip" data-placement="top" onclick="return confirm('are you sure?')"><i class="fa fa-trash"></i></a>
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
        <form action="{{url('/adm/jenjang/tambah')}}" method="post">
        {{csrf_field()}}
          <div class="box-header">
            Tambah Jenjang
            <div class="clearfix"></div>
          </div>
          <div class="box-body">
              <div class="form-group">
                <label class="control-label" for="name">
                Jenjang
                </label>
                <div class="ln_solid"></div>
              </div>

              <div class="clearfix"></div>

              <div class="col-md-4">
                <div class="form-group">
                  <label class="control-label" for="name">
                  Nama Jenjang
                  </label>
                  <input class="form-control" name="nama_jenjang" placeholder="Nama jenjang" required type="text">                          
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label class="control-label" for="name">
                  Maksimal Tingkat
                  </label>
                  <select name="max_tingkat" class="form-control">
                    @foreach($kelas as $j)
                      <option value="{{$j->tingkat}}">{{$j->tingkat}}</option>
                    @endforeach
                  </select>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label class="control-label" for="name">
                  Jenjang Selanjutnya
                  </label>
                  <select name="next_jenjang" class="form-control">
                    <option selected>Tidak ada</option>
                    @foreach($jenjang as $j)
                      <option value="{{$j->id_jenjang}}">{{$j->nama_jenjang}}</option>
                    @endforeach
                  </select>
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
function changePeriodeStart(month){
  $("#startjenjang").val(month);
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