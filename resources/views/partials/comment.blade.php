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
            <div>
                @can('delete', $comment)
                    <form method="post" action="{{ route('comments.delete', $comment->id) }}">
                        @csrf
                        @method('PATCH')
                        <button type="submit" class="delete btn">  Delete Comment </button>
                    </form>
                @endcan
                @can('update', $comment)
                    <a class="btn cardBtn" aria-current="page" href="{{  route('comments.edit', $comment->id)  }}">Edit</a>
                @endcan
            </div>
            <p class="card-text">{{ $comment->commenttext }}</p>
            @if(Auth::check() && !$report)
                <form method="post" action="{{ route('comments.report', $comment->id) }}">
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