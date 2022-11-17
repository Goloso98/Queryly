<article class="post" data-id="{{ $question->id }}">
<header>
    <h3>Title: {{ $question->title }}</h3>
    <a href="/posts/{{ $question->id }}">See Post</a>
    @if (Auth::id() == $question->userid)
        <a href="#" class="delete">Delete Question</a>
    @endif
</header>
<p> {{ $question->posttext }} </p>
<p> {{ $question->postdate }} </p>
</article>
<p></p>
