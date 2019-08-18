@extends('admins.app')

@section('title', '评论管理')

@section('content')
<div class="container-fluid">
    <div class="card text-muted">
        <div class="card-header bg-white">

            <div class="d-flex justify-content-between">
                <div class="p-2 bd-highlight">评论管理</div>
            </div>
        </div>
        @if(isset($comments) && count($comments))
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">评论内容</th>
                                <th scope="col">所属文章</th>
                                <th scope="col">评论用户</th>
                                <th scope="col">评论时间</th>
                                <th scope="col">操作</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($comments as $comment)
                                <tr>
                                    <th scope="row">{{ $comment->id }}</th>
                                    <td class="text-truncate" style="max-width: 150px;" title="{{ $comment->content }}">{{ $comment->content }}</td>
                                    <td class="text-truncate" style="max-width: 150px;" title="{{ $comment->title }}">
                                        <a class="text-info" href="" target="_blank">
                                            {{ $comment->title }}
                                        </a>
                                    </td>
                                    <td>
                                        <i class="fa fa-user mr-1 text-info"></i>
                                        <a class="text-info" href="">
                                            {{ $comment->name }}
                                        </a>
                                    </td>
                                    <td title="{{ $comment->created_at }}">{{ $comment->created_at }}</td>
                                    <td>
                                        <a class="btn btn-info btn-sm m-1" href="{{ url('/admins/comments/'.$comment->id.'/edit') }}">
                                            <i class="fa fa-edit"></i> 编辑
                                        </a>
                                        <a class="btn btn-info btn-sm m-1" href="{{ url('/admins/comments/delete/'.$comment->id) }}">
                                            <i class="fa fa-edit"></i> 删除
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card-footer bg-white">
                {{ $comments->links() }}
            </div>
        @else
            <div class="card-body">
                <p class="text-muted">
                    没有任何分类 ～
                </p>
            </div>
        @endif
    </div>
</div>
@stop

@section('script')
<script type="text/javascript">
    $('.js-btn-del').on('click',function(){
        var oForm = $(this).children('form');
        swal_delete(function(){
            oForm.submit();
        });
    });
</script>
@stop
