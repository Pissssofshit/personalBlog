@extends('layouts/app')

@section('css')
{{--{!! markdown_preview_css() !!}--}}
@stop

@section('title',isset($post) ? $post['title'] : '博客')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
        <div class="col-md-9">
            <div class="card mb-3 text-muted">
                <div class="card-body">
                    <h3 class="card-title">{{ $post['title'] }}</h3>
                    <h5 class="card-subtitle my-4">
                        <a href="" class=" font-italic text-info">
{{--                            {{ $post->user->name }}--}}
                        </a>
                        <small class="font-italic text-muted mx-3" title="发布时间：{{ $post['time'] }}">
                            <i class="fa fa-clock-o"></i>
{{--                            {{ $post->created_at->diffForHumans() }}--}}
                        </small>
                        <small class="pull-right">
                            访问：<span class="badge badge-light text-muted mr-3"></span>
                            评论：<span class="badge badge-light text-muted"></span>
                            关注：<span class="badge badge-light text-muted"></span>
                        </small>
                    </h5>
                    <hr>
                    <article class="markdown-body">
                        {!! $post->content !!}
                    </article>
                </div>
            </div>
{{--            @include('posts._follow_users')--}}
            @include('posts._comments')
            @include('posts._post_comment')
        </div>
        <div class="col-md-3">
            @include('posts._sidebar')
        </div>
    </div>
    </div>
@stop

@section('script')

{{--{!! markdown_preview_js() !!}--}}

@stop
