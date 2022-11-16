<article class="question" data-id="{{ $question->id }}">
<header>
    <h3>Title: {{ $question->title }} </h3>
    <a href="#" class="delete">Delete</a>
</header>
<p> {{ $question->posttext }} </p>
<p> {{ $question->postdate }} </p>
</article>
<p></p>
