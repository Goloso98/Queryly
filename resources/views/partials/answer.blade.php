<article class="post" data-id="{{ $answer->id }}">
    <div class="card">
        <div class="card-body">
            @if($showTitle)
                <h3 class="card-title">Answer to: {{ App\Models\Post::find($answer->parentpost)->title }}</h3>
                <p>
                    <a href="{{route('posts.postPage', $answer->parentpost)}}">See Post</a>
                    <a href="{{route('posts.comments', $answer->id)}}">Comments</a>
                </p>
            @endif
            <p class="card-text">{{ $answer->posttext }}</p>
            @if($showTitle)
                <p></p>
            @endif
            {{ $answer->postdate }}
            @if(!$showTitle)
                <a class="btn" aria-current="page" href="{{route('users.profile', $answer->userid)}}">&#64;{{ $answer->user()->first()->username }}</a>
            @endif
            <p></p>
            @can('delete', $answer)
                <a href="#" class="delete">Delete</a>
            @endcan
            @can('update', $answer)
                <a class="btn" aria-current="page" href="{{  route('posts.edit', $answer->id)  }}">Edit</a>
            @endcan
            <a class="btn" aria-current="page" href="{{route('addComment', $answer->id)}}">Add Comment</a>
            <p></p>
            @php
                $answerComments = app\Http\Controllers\CommentController::showComments($answer->id);
            @endphp
            <div class="accordion" id="accordionExample">
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingTwo">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                            Show Comments ({{count($answerComments)}})
                        </button>
                    </h2>
                    <div id="collapseTwo" class="accordion-collapse collapse show" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            @foreach($answerComments as $comment)
                                @include('partials.comment')
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</article>
<p></p>