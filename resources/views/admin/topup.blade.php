<?php $title = 'topup';?>
@extends('admin.layout')
@section('css')

  <link href="/assets/plugins/select2/select2.min.css" rel="stylesheet">

@endsection
@section('content')
    <div class="row">
      <div class="col-md-2"></div>
      <div class="col-md-8 col-sm-12 col-xs-12">
        <div class="box-contain">
          <form action="{{url('/adm/topup/process')}}" method="post">
          {{csrf_field()}}
          <div class="box-header">
            Top Up
            <div class="clearfix"></div>
          </div>
          <div class="box-body">
<!--               <div class="form-group">
                <label class="control-label">Pilih Siswa</label>
                  <select name="id" class="select2_single form-control" tabindex="-1">
                    @foreach($siswa as $s)
                      @if($s->id_user_role==2)
                        <option value="{{$s->id}}">{{$s->nama}}</option>
                      @endif
                    @endforeach
                  </select>
              </div>
 -->
              <div class="form-group">
                <label class="control-label" for="name">
                RFID
                </label>
                <input class="form-control" name="rfid" placeholder="RFID" required type="rfid">
              </div>
              <div class="form-group">
                <label class="control-label" for="name">
                Nominal
                </label>
                <input class="form-control" name="nominal" placeholder="Nominal" required type="number">                          
              </div>
              <div class="ln_solid"></div>

          </div>
          <div class="box-footer">
            <button id="send" type="submit" class="btn btn-success">Top Up</button>
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
<script>
@if(@$errors->first('text') != "")
  alert("{{$errors->first('text')}}");
@endif

$(document).ready(function(){
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
});
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