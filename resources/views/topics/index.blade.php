@extends('layouts.base')
@section('nav','话题列表')
@section('subhead',@isset($category)?$category->name:'话题列表')
@section('title',@isset($category)?$category->description:'话题列表')

@section('content')
    <div class="container">
        @if(session('success'))
        <div class="alert alert-success alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <strong>{{session('success')}}</strong>
        </div>
        @endif
        <div class="row">
            <div class="col-md-9">
                <div class="blog-posts">

                    @include('topics.__topic_list')

                    {{$topics->links()}}


                </div>
            </div>


            <div id="leftmenu" class="col-md-3">
                @include('topics.__topic_sidebar')
            </div>
        </div>

    </div>
@endsection