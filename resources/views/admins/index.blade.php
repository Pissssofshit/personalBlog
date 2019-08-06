@extends('admins.app')

@section('title','首页')

@section('content')
<div class="container">
    <div class="row">
        @if(isset($list) && count($list))
            @foreach($list as $item)
                <div class="col-md-6 my-3">
                    <div class="card border-info text-muted">
                        <div class="card-header bg-info text-light">
                            {{ $item['name'] }}统计
                        </div>
                        <div class="card-body">
                            <p class="card-text">
                                文章数量：
                                <a href="" class="text-info" target="_blank"></a>
                            </p>
                            <div class="dropdown-divider"></div>
                            <p class="card-text">
                                评论：
                                <a href="" class="text-info" target="_blank"></a>
                            </p>
                            <div class="dropdown-divider"></div>
                            <p class="card-text">
{{--                                访问：{{ $item['value']['visits'] }}--}}
                            </p>
                            <div class="dropdown-divider"></div>
                            <p class="card-text">
{{--                                关注：{{ $item['value']['follows'] }}--}}
                            </p>
                        </div>
                    </div>
                </div>
            @endforeach
        @endif
    </div>
</div>
@endsection
