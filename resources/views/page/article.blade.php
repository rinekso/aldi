@extends('layout.admin')
@section('css')
    <!-- Datatables -->
    <link href="{{asset('assets/plugins/datatables.net-bs/css/dataTables.bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('assets/plugins/datatables.net-buttons-bs/css/buttons.bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('assets/plugins/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css')}}" rel="styleszheet">
    <link href="{{asset('assets/plugins/datatables.net-responsive-bs/css/responsive.bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('assets/plugins/datatables.net-scroller-bs/css/scroller.bootstrap.min.css')}}" rel="stylesheet">
    {{--editor.md--}}
    <link rel="stylesheet" href="{{asset('assets/plugins/editor.md/css/editormd.min.css')}}" />
@endsection
@section('content')
    <h1>Article Page</h1>
    <div class="row">
        <div class="col-md-6 col-sm-12 col-xs-12">
            <div class="box-contain">
                <div class="box-header">
                    Data of Articles
                </div>
                <div class="box-body">
                    <table id="datatable-responsive">
                        <thead>
                            <th>#</th>
                            <th>Name</th>
                            <th>Action</th>
                        </thead>
                        <tbody>
                        @foreach($data as $key=>$d)
                            <tr>
                                <td>{{$key+1}}</td>
                                <td>{{$d->title}}</td>
                                <td width="100">
                                    <a class="icon-sm label label-warning" href="javascript:;" onclick="edit({{$d->id}})"><i class="fa fa-edit"></i></a>
                                    <a class="icon-sm label label-primary" href="" target="_blank"><i class="fa fa-eye"></i></a>
                                    <a class="icon-sm label label-danger" href="{{url('article/delete/'.$d->id)}}" onclick="return confirm('are you sure?');"><i class="fa fa-trash"></i></a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-sm-12 col-xs-12">
            <div class="box-contain">
                @if(isset($errors))
                    <div class="alert-danger" style="text-align: center;">
                        {{$errors->first()}}
                    </div>
                @endif
                <form action="{{url('article/input')}}" id="inputArticle" enctype="multipart/form-data" method="POST">
                    {{csrf_field()}}
                    <div class="box-header">
                        Input Article
                        <div class="clearfix"></div>
                    </div>
                    <div class="box-body">
                        <div class="form-group">
                            <label class="control-label" for="name">Title
                            </label>
                            <input class="form-control" placeholder="Title" required type="text" name="title">
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="name">Cover
                            </label>
                            <input type="file" class="form-control" placeholder="cover" name="cover">
                            <input type="hidden" name="id">
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="content">Content
                            </label>
                            <div id="test-editormd"></div>
                        </div>
                        <div class="ln_solid"></div>
                    </div>
                    <div class="box-footer">
                        <button type="button" onclick="resetForm()" class="btn btn-primary">Cancel</button>
                        <button id="send" type="submit" class="btn btn-success">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <!-- Datatables -->
    <script src="{{asset('assets/plugins/datatables.net/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('assets/plugins/datatables.net-bs/js/dataTables.bootstrap.min.js')}}"></script>
    <script src="{{asset('assets/plugins/datatables.net-buttons/js/dataTables.buttons.min.js')}}"></script>
    <script src="{{asset('assets/plugins/datatables.net-buttons-bs/js/buttons.bootstrap.min.js')}}"></script>
    <script src="{{asset('assets/plugins/datatables.net-buttons/js/buttons.flash.min.js')}}"></script>
    <script src="{{asset('assets/plugins/datatables.net-buttons/js/buttons.html5.min.js')}}"></script>
    <script src="{{asset('assets/plugins/datatables.net-buttons/js/buttons.print.min.js')}}"></script>
    <script src="{{asset('assets/plugins/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js')}}"></script>
    <script src="{{asset('assets/plugins/datatables.net-keytable/js/dataTables.keyTable.min.js')}}"></script>
    <script src="{{asset('assets/plugins/datatables.net-responsive/js/dataTables.responsive.min.js')}}"></script>
    <script src="{{asset('assets/plugins/datatables.net-responsive-bs/js/responsive.bootstrap.js')}}"></script>
    <script src="{{asset('assets/plugins/datatables.net-scroller/js/dataTables.scroller.min.js')}}"></script>
    <script src="{{asset('assets/plugins/jszip/dist/jszip.min.js')}}"></script>
    <script src="{{asset('assets/plugins/pdfmake/build/pdfmake.min.js')}}"></script>
    <script src="{{asset('assets/plugins/pdfmake/build/vfs_fonts.js')}}"></script>
    {{--editor.md--}}
    <script src="{{asset('assets/plugins/editor.md/js/editormd.js')}}"></script>
    <script>
        var testEditor;

        $(function() {
            testEditor = editormd("test-editormd", {
                width: "100%",
                height: 400,
                emoji : true,
                path : './assets/plugins/editor.md/lib/',
                saveHTMLToTextarea : true
            });
            editormd.loadScript("./assets/plugins/editor.md/languages/en", function() {
                testEditor.lang = editormd.defaults.lang;
                testEditor.recreate();
            });
        });
        function edit(id){
            ajax("<?= env('APP_URL')?>"+"/api/article/detail/"+id,'get',{},function(data){
                $("input[name=title]").val(data.title);
                $("input[name=id]").val(data.id);
                testEditor.setMarkdown(data.markdown);
            });
        }
        function resetForm(){
            $('input').val('');
            $('input[name=id]').removeAttr('value');
            $.proxy(testEditor.toolbarHandlers.clear, testEditor)();
        }
    </script>
    {{--datatables--}}
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
                    }
                ]
            });
        });
        </script>
@endsection