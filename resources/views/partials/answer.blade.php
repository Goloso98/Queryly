<article class="post" data-id="{{ $answer->id }}">
    <div class="card">
        <div class="card-body">
            @if($showTitle)
                <h3 class="card-title">Answer to: {{ App\Models\Post::find($answer->parentpost)->title }}</h3>
                <p><a href="{{route('posts.postPage', $answer->parentpost)}}">See Post</a></p>
            @endif
            <p class="card-text">{{ $answer->posttext }}</p>
            @if($showTitle)
                <p></p>
            @endif
            {{ $answer->postdate }}
            @if(!$showTitle)
                <a class="btn" aria-current="page" href="{{route('users.profile', $answer->userid)}}">&#64;{{ $answer->user()->first()->username }}</a>
            @endif
            @if (Auth::id() == $answer->userid)
                <p></p>
                <a href="#" class="delete">Delete</a>
                <a class="btn" aria-current="page" href="{{  route('posts.edit', $answer->id)  }}">Edit</a>
            @endif
        </div>
    </div>
</article>