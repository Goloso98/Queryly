<article class="post" data-id="{{ $question->id }}">
    <div class="card">
        <div class="card-body">
            <h3 class="card-title">{{ $question->title }}</h3>
            <p><a href="{{route('posts.postPage', $question->id)}}">See Post</a></p>
            <p class="card-text">{{ $question->posttext }}</p>
            @if (Auth::id() == $question->userid)
                <p></p>
                <a href="#" class="delete">Delete Question</a>
                <a class="btn" aria-current="page" href="{{  route('posts.edit', $question->id)  }}">Edit</a>
            @endif
            {{ $question->postdate }}
            @if($showUser)
                @php
                    $username = DB::table('users')->find($question->userid)->username;
                @endphp
                <a class="btn" aria-current="page" href="{{route('users.profile', $question->userid)}}">&#64;{{$username}}</a>
            @endif
        </div>
    </div>
</article>
<p></p>