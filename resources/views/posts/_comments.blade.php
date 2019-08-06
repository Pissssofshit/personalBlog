<div class="card my-3">
    <div class="card-header bg-white">
        <h5 class="card-title text-muted">评论</h5>
    </div>
    <div class="card-body">
        @if(!empty($post) && count($post->comments))
            @foreach($post->comments as $comment)
                <div class="card my-3">
                    <div class="card-header">
                        <img class="rounded" src="" alt="" height="22">
                        <a href="" class="text-info font-weight-light font-italic mx-2">
                                {{ $comment->name }}
                        </a>
                        <small class="text-info font-weight-light pull-right">
                            <i class="fa fa-clock-o"></i>
                            {{ $comment->time }}
{{--                            <script>Date.parse({{ $comment->time }})</script>--}}
                        </small>
                    </div>
                    <div class="card-body text-muted">
                        {{ ($comment->content) }}
                    </div>
                </div>
            @endforeach
        @else
            <p class="text-muted">还没有人评论 ～</p>
        @endif
    </div>
</div>
