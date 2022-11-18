<article class="post" data-id="{{ $question->id }}">
<header>
    <h3>Title: {{ $question->title }} </h3>
    <a href="#" class="delete">Delete</a>
    <a class="btn" aria-current="page" href="{{  route('posts.edit', $question->id)  }}">Edit</a>
</header>
<p> {{ $question->posttext }} </p>
<p> {{ $question->postdate }} </p>
</article>
<p></p>
