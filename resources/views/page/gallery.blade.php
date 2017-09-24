@extends('layout.admin')
@section('css')
    <style>
        .img-container{
            width: 100px;
            height:100px;
            float: left;
            overflow: hidden;
        }
        .img-container img{
            height:100%;
            width: auto;
        }
        .cover{
            width:100px;
            height:100px;
            background: rgba(0,0,0,0.5);
            position: absolute;
            text-align: right;
            display: none;
        }
        .img-container:hover .cover{
            display: block;
        }
        .cover a i{
            color: #fff;
        }
    </style>
@endsection
@section('content')
    <h1>Gallery Page</h1>
    <div class="row">
        <div class="col-md-6 col-sm-12 col-xs-12">
            <div class="box-contain">
                <div class="box-header">
                    Data of Gallery
                </div>
                <div class="box-body">
                    @foreach($data as $d)
                        <div class="img-container">
                            <div class="cover">
                                <a href="{{asset('assets/images/gallery/'.$d->path)}}" target="_blank" class="label label-primary"><i class="fa fa-eye"></i></a>
                                <a href="javascript:;" onclick="edit({{$d->id}})" class="label label-warning"><i class="fa fa-edit"></i></a>
                                <a href="{{url('gallery/delete/'.$d->id)}}" onclick="return confirm('are you sure?')" class="label label-danger"><i class="fa fa-trash"></i></a>
                            </div>
                            <img src="{{asset('assets/images/gallery/'.$d->path)}}">
                        </div>
                    @endforeach
                    <div class="clearfix"></div>
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
                <form action="{{url('gallery/input')}}" id="inputArticle" enctype="multipart/form-data" method="POST">
                    {{csrf_field()}}
                    <div class="box-header">
                        Input Gallery
                        <div class="clearfix"></div>
                    </div>
                    <div class="box-body">
                        <div class="form-group">
                            <label class="control-label" for="name">Image
                            </label>
                            <input type="file" class="form-control" placeholder="cover" name="path">
                            <input type="hidden" name="id">
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="name">Info
                            </label>
                            <textarea class="form-control" placeholder="Title" required name="info"></textarea>
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
    <script>
        function edit(id){
            ajax("<?= env('APP_URL')?>"+"/api/gallery/detail/"+id,'get',{},function(data){
                $("textarea[name=info]").val(data.info);
                $("input[name=id]").val(data.id);
            });
        }
        function resetForm(){
            $('textarea').val('');
            $("input[name=id]").removeAttr('value');
        }
    </script>
@endsection