<article class="post" data-id="{{ $answer->id }}">
    <header>
        <h3>Answer to: {{ $answer->parentpost }} </h3>
        <a href="#" class="delete">Delete</a>
        <a class="btn" aria-current="page" href="{{  route('posts.edit', $answer->id)  }}">Edit</a>
    </header>
    <p> {{ $answer->posttext }} </p>
    <p> {{ $answer->postdate }} </p>
    <p></p>
</article>