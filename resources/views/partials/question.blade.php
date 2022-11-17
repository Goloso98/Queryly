<article class="post" data-id="{{ $question->id }}">
<header>
    <h3>Title: {{ $question->title }}</h3>
    <a href="/posts/{{ $question->id }}">See Post</a>
    <a href="#" class="delete">Delete</a>
</header>
<p> {{ $question->posttext }} </p>
<p> {{ $question->postdate }} </p>
</article>
<p></p>
