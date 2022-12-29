<article class="comment" data-id="{{ $comment->id }}">
    <div class="card">
        <div class="card-body">
            @if($report)
                @php
                    $post = App\Models\Post::find($comment->postid);
                @endphp
                @if($post->posttype == 'question')
                    <h4 class="card-title">Comment on Question: {{ App\Models\Post::find($comment->postid)->title }}</h4>
                @else
                    @php
                        $parentPost = App\Models\Post::find($post->parentpost)
                    @endphp
                    <h4 class="card-title">Comment on Answer to: {{ $parentPost->title }}</h4>
                @endif
            @endif
            <p>
                @can('delete', $comment)
                    <a class="delete btn" id="delete-comment" href="#"> Delete Comment </a>
                @endcan
                @can('update', $comment)
                    <a class="btn cardBtn" aria-current="page" href="{{  route('comments.edit', $comment->id)  }}">Edit</a>
                @endcan
            </p>
            <p class="card-text">{{ $comment->commenttext }}</p>
            @if(Auth::check())
                <form method="post" action="{{ route('comment.report', $comment->id) }}">
                    {{ csrf_field() }}
                    <button type="submit" class="btn cardBtn report"> Report Comment </button>
                </form>
            @endif
            {{ $comment->commentdate }}
            @php
                $username = DB::table('users')->find($comment->userid)->username;
            @endphp
            <a class="btn" aria-current="page" href="{{route('users.profile', $comment->userid)}}">&#64;{{$username}}</a>
            <br>
        </div>
    </div>
</article>
<br>