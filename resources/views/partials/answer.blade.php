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
    <p> {{ $answer->user()->first()->username }}</p>
    <p> {{ $answer->postdate }} </p>
    <p></p>
</article>