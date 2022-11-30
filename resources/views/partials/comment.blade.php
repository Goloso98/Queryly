<article class="post" data-id="{{ $comment->id }}">
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
        </div>
    </div>
</article>
<p></p>