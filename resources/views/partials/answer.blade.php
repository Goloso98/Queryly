<article class="post" data-id="{{ $answer->id }}">
    <header>
        @if($showTitle)
            <h3>Answer to: {{ App\Models\Post::find($answer->parentpost)->title }} </h3>
        @endif
        @if (Auth::id() == $answer->userid)
            <a href="#" class="delete">Delete</a>
            <a class="btn" aria-current="page" href="{{  route('posts.edit', $answer->id)  }}">Edit</a>
            @if($showTitle)
                <a class="btn" aria-current="page" href="{{route('posts.postPage', $answer->parentpost)}}">See Post</a>
            @endif
        @endif
    </header>
    <p> {{ $answer->posttext }} </p>
    @if(!$showTitle)
    <p> <a class="btn" aria-current="page" href="{{route('users.profile', $answer->userid)}}">&#64;{{ $answer->user()->first()->username }}</a></p>
    @endif
    <p> {{ $answer->postdate }} </p>
    <p></p>
</article>