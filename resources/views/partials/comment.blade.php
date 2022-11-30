<article class="comment" data-id="{{ $comment->id }}">
    <div class="card">
        <div class="card-body">
            <p class="card-text">{{ $comment->commenttext }}</p>
            {{ $comment->commentdate }}
            @if($showUser)
                @php
                    $username = DB::table('users')->find($comment->userid)->username;
                @endphp
                <a class="btn" aria-current="page" href="{{route('users.profile', $comment->userid)}}">&#64;{{$username}}</a>
            @endif
            @can('delete', $comment)
                <a class="delete" href="#"> Delete Comment </a>
            @endcan
            @can('update', $comment)
                <a class="btn" aria-current="page" href="{{route('comments.edit', $comment->id)}}">Edit</a>
            @endcan
        </div>
    </div>
</article>
<p></p>