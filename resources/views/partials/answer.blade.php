<article class="post" data-id="{{ $answer->id }}">
    <header>
        <h3>Answer to: {{ $answer->parentpost }} </h3>
        <a href="#" class="delete">Delete</a>
    </header>
    <p> {{ $answer->posttext }} </p>
    <p> {{ $answer->postdate }} </p>
    <p></p>
</article>