<?php $title = 'laporan';?>
@extends('admin.layout')
@section('css')

  <link href="/assets/plugins/select2/select2.min.css" rel="stylesheet">

@endsection
@section('content')
    <div class="row">
      <div class="col-md-6 col-sm-12 col-xs-12">
        <div class="box-contain">
        <form action="{{url('/adm/laporan/pembayaran')}}" method="post">
        {{csrf_field()}}
          <div class="box-header">
            Laporan Pembayaran
            <div class="clearfix"></div>
          </div>
          <div class="box-body">
              <div class="form-group">
                <label class="control-label" for="name">
                Jenis Pembayaran
                </label>
              <div class="ln_solid"></div>
              @foreach($jenis_transaksi as $j)
                <div class="col-md-4">
                  <label>
                    <input required type="radio" name="id_jenis_transaksi" value="{{$j->id_jenis_transaksi}}"> {{$j->nama_transaksi}}
                  </label>
                </div>
              @endforeach
              </div>

              <div class="clearfix"></div>

              <div class="col-md-4">
                <div class="form-group">
                  <label class="control-label" for="name">
                  Tingkat
                  </label>
                  <select name="id_kelas" class="form-control">
                    @foreach($kelas as $j)
                      <option value="{{$j->id_kelas}}">{{$j->tingkat}}</option>
                    @endforeach
                  </select>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label class="control-label" for="name">
                  Jenjang
                  </label>
                  <select name="id_jenjang" class="form-control">
                    @foreach($jenjang as $j)
                      <option value="{{$j->id_jenjang}}">{{$j->nama_jenjang}}</option>
                    @endforeach
                  </select>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label class="control-label" for="name">
                  Rentang
                  </label>
                  <select name="rentang" class="form-control">
                    <option value="1">Bulan</option>
                    <option value="2">Semester</option>
                    <option value="3">Tahun</option>
                  </select>
                          
                </div>
              </div>
              <div class="clearfix"></div>
              <div class="ln_solid"></div>

          </div>
          <div class="box-footer">
            <button id="send" type="submit" class="btn btn-success">Cari</button>
          </div>
          </form>
        </div>
      </div>
      <div class="col-md-6 col-sm-12 col-xs-12">
        <div class="box-contain">
        <form action="{{url('/adm/laporan/topup')}}" method="post">
        {{csrf_field()}}
          <div class="box-header">
            Laporan Topup
            <div class="clearfix"></div>
          </div>
          <div class="box-body">
              <div class="clearfix"></div>

              <div class="col-md-4">
                <div class="form-group">
                  <label class="control-label" for="name">
                  Tingkat
                  </label>
                  <select name="id_kelas" class="form-control">
                    <option value="0">semua</option>
                    @foreach($kelas as $j)
                      <option value="{{$j->id_kelas}}">{{$j->tingkat}}</option>
                    @endforeach
                  </select>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label class="control-label" for="name">
                  Jenjang
                  </label>
                  <select name="id_jenjang" class="form-control">
                    <option value="0">semua</option>
                    @foreach($jenjang as $j)
                      <option value="{{$j->id_jenjang}}">{{$j->nama_jenjang}}</option>
                    @endforeach
                  </select>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label class="control-label" for="name">
                  Rentang
                  </label>
                  <select name="rentang" class="form-control">
                    <option value="1">Bulan</option>
                    <option value="2">Semester</option>
                    <option value="3">Tahun</option>
                  </select>
                          
                </div>
              </div>
              <div class="clearfix"></div>
              <div class="ln_solid"></div>

          </div>
          <div class="box-footer">
            <button id="send" type="submit" class="btn btn-success">Cari</button>
          </div>
          </form>
        </div>
      </div>
      @if(count(@$result) !=0)
      <?php
      $jml = count($result);
      ?>
        @if(@$laporan['name'] == 'pembayaran')
        @for($i=0;$i < $jml; $i++)
        @if(count($result[$i])!==0)
        <div class="col-md-12 col-sm-12 col-xs-12">
          <div class="box-contain">
            <div class="box-header">
              Laporan {{$laporan['jenis'][0]->nama_transaksi}} - Kelas {{$laporan['kelas'][0]->tingkat}} / {{$laporan['jenjang'][0]->nama_jenjang}} - ({{$result[$i]->name}})
              <div class="clearfix"></div>
            </div>
            <div class="box-body">
                <table id="datatable-responsive{{$i}}" class="table table-hover table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Nama</th>
                      <th>Pembayaran</th>
                      <th>Nominal</th>
                      <th>Tanggal</th>
                    </tr>
                  </thead>
                  <tbody>
                      @foreach($result[$i] as $k=>$ru)
                      <tr>
                        <td>{{$k+1}}</td>
                        <td>{{$ru->user->nama}}</td>
                        <td>{{$laporan['jenis'][0]->nama_transaksi}}</td>
                        <td>{{$ru->pembayaran->nominal}}</td>
                        <td>{{$ru->created_at}}</td>
                      </tr>
                      @endforeach
                  </tbody>
                </table>
              </div>
            </div>
          </div>
          @endif
        @endfor
        @endif
        @if(@$laporan['name'] == 'topup')
        @for($i=0;$i < $jml; $i++)
        @if(count($result[$i])!==0)
        <div class="col-md-12 col-sm-12 col-xs-12">
          <div class="box-contain">
            <div class="box-header">
              Laporan Topup - ({{$result[$i]->name}})
              <div class="clearfix"></div>
            </div>
            <div class="box-body">
                <table id="datatable-responsive{{$i}}" class="table table-hover table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Nama</th>
                      <th>Nominal</th>
                      <th>Tanggal</th>
                    </tr>
                  </thead>
                  <tbody>
                      @foreach($result[$i] as $k=>$ru)
                      <tr>
                        <td>{{$k+1}}</td>
                        <td>{{$ru->user->nama}}</td>
                        <td>{{$ru->nominal}}</td>
                        <td>{{$ru->created_at}}</td>
                      </tr>
                      @endforeach
                  </tbody>
                </table>
              </div>
            </div>
          </div>
          @endif
        @endfor
        @endif
      @endif

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
  for(var i = 0;i<12;i++){
      $('#datatable-responsive'+i).DataTable({
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
  }

  $('#tags_1').tagsInput({
    defaultText: 'add email', 
    width: 'auto',
  });
  $('#editor').wysiwyg({
    fileUploadError: showErrorAlert
  });
  $(".select2_single").select2({
    placeholder: "Select a state",
    allowClear: true
  });

  window.prettyPrint;
  prettyPrint();
  nameHide();
});
function nameShow(){
  $("#nameType").show();
}
function nameHide(){
  $("#nameType").hide();
}
function onAddTag(tag) {
  alert("Added a email: " + tag);
}

function onRemoveTag(tag) {
  alert("Removed a email: " + tag);
}

function onChangeTag(input, tag) {
  alert("Changed a email: " + tag);
}
// Text editor
function initToolbarBootstrapBindings() {
  var fonts = ['Serif', 'Sans', 'Arial', 'Arial Black', 'Courier',
      'Courier New', 'Comic Sans MS', 'Helvetica', 'Impact', 'Lucida Grande', 'Lucida Sans', 'Tahoma', 'Times',
      'Times New Roman', 'Verdana'
    ],
    fontTarget = $('[title=Font]').siblings('.dropdown-menu');
  $.each(fonts, function(idx, fontName) {
    fontTarget.append($('<li><a data-edit="fontName ' + fontName + '" style="font-family:\'' + fontName + '\'">' + fontName + '</a></li>'));
  });
  $('a[title]').tooltip({
    container: 'body'
  });
  $('.dropdown-menu input').click(function() {
      return false;
    })
    .change(function() {
      $(this).parent('.dropdown-menu').siblings('.dropdown-toggle').dropdown('toggle');
    })
    .keydown('esc', function() {
      this.value = '';
      $(this).change();
    });

  $('[data-role=magic-overlay]').each(function() {
    var overlay = $(this),
      target = $(overlay.data('target'));
    overlay.css('opacity', 0).css('position', 'absolute').offset(target.offset()).width(target.outerWidth()).height(target.outerHeight());
  });

  if ("onwebkitspeechchange" in document.createElement("input")) {
    var editorOffset = $('#editor').offset();

    $('.voiceBtn').css('position', 'absolute').offset({
      top: editorOffset.top,
      left: editorOffset.left + $('#editor').innerWidth() - 35
    });
  } else {
    $('.voiceBtn').hide();
  }
}

function showErrorAlert(reason, detail) {
  var msg = '';
  if (reason === 'unsupported-file-type') {
    msg = "Unsupported format " + detail;
  } else {
    console.log("error uploading file", reason, detail);
  }
  $('<div class="alert"> <button type="button" class="close" data-dismiss="alert">&times;</button>' +
    '<strong>File upload error</strong> ' + msg + ' </div>').prependTo('#alerts');
}

initToolbarBootstrapBindings();

</script>
@endsection