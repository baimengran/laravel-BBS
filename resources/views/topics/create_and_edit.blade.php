@extends('layouts.base')
@section('subhead',isset($topic)?'编辑话题':'新建话题')
@section('nav',isset($topic)?'编辑话题':'新建话题')
@section('title',isset($topic)?'编辑话题':'新建话题')
@section('styles')
    <link rel="stylesheet" type="text/css" href="{{asset('css/simditor.css')}}">
@stop
@section('scripts')
    <script type="text/javascript" src="{{asset('js/module.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/hotkeys.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/uploader.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/simditor.js')}}"></script>
@stop


@section('content')

    <section class="call-to-action with-borders button-centered mb-xl col-md-10 col-md-offset-1">
        <div class="call-to-action-content " style="margin-left: 0px">
            @if($topic->id)
                <h3 class=""><i class="fa fa-edit"></i> 编辑话题</h3>
            @else
                <h3><i class="fa fa-paint-brush"></i> 新建话题</h3>
            @endif
        </div>
        <hr>

        @if($topic->id)
            <form class="form-horizontal form-bordered" action="{{route('topics.update',[$topic])}}" method="post"
                  accept-charset="UTF-8">
                <input type="hidden" name="_method" value="PUT"/>
                @else
                    <form class="form-horizontal form-bordered" action="{{route('topics.store')}}" method="post"
                          accept-charset="UTF-8">
                        @endif
                        <input type="hidden" name="_token" value="{{csrf_token()}}"/>

                        <div class="form-group">
                            <div class="col-md-2 {{$errors->has('category_id')?'has-error':''}}">
                                <select name="category_id" data-plugin-selecttwo=""
                                        class="form-control populate input-lg">
                                    <option value="" class="hidden disabled {{$topic->id?'':'selected'}}">分类</option>

                                    @foreach($categories as $category)
                                        @if($category['name']!='公告')
                                            <option {{$category['id']==$topic->category_id?'selected':''}} value="{{$category['id']}}"
                                                    style="font-weight: bold">{{$category['name']}}</option>
                                        @endif
                                        @foreach($category['children'] as $value)
                                            <option {{$value['id']==$topic->category_id?'selected':''}} value="{{$value['id']}}">&nbsp&nbsp{{$value['name']}}</option>
                                        @endforeach

                                    @endforeach
                                </select>
                                @if($errors->has('category_id'))
                                    <span>
                                        <label style="color: #b7281f;">{{$errors->first('category_id')}}</label>
                                    </span>
                                @endif
                            </div>
                            <div class="col-md-10 {{$errors->has('title')?'has-error':''}}">
                                <input class="form-control input-lg mb-md" name="title"
                                       value="{{old('title',$topic->title)}}" type="text" placeholder="标题" required>
                                @if($errors->has('title'))
                                    <span>
                                        <label style="color: #b7281f;">{{$errors->first('title')}}</label>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-12 {{$errors->has('body')?'has-error':''}}">
                                <textarea id="editor" class="form-control" placeholder="话题内容" name="body"
                                          rows="3" required>{{old('body',$topic->body)}}</textarea>
                            </div>
                            @if($errors->has('body'))
                                <span>
                                    <label style="color: #b7281f;">{{$errors->first('body')}}</label>
                                </span>
                            @endif
                        </div>
                        <div class="well well-sm">
                            <button type="submit" class="btn btn-info mr-xs " style="width: 150px;"><i
                                        class="fa fa-check"></i> 发布
                            </button>
                        </div>
                    </form>

    </section>
    <script>
        $(document).ready(function () {
            let editor = new Simditor({
                textarea: $("#editor"),
                upload: {
                    url: '{{route('topics.uploadImage')}}',
                    params: {_token: '{{csrf_token()}}'},
                    fileKey: 'upload_file',
                    connectionCount: 3,
                    leaveConfirm: '文件上传中,关闭此页面将取消上传.',
                },
                pasteImage: true,
            });
        });
    </script>
@endsection
