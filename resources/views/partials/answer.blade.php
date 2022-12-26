<article class="post" data-id="{{ $answer->id }}" user-id="{{Auth::id()}}" id="answer-{{ $answer->id}}">
    <div class="card">
        <div class="card-body">
            @if($showTitle)
                <h3 class="card-title">Answer to: {{ App\Models\Post::find($answer->parentpost)->title }}</h3>
                <p>
                    <a href="{{route('posts.postPage', $answer->parentpost)}}#answer-{{ $answer->id}}">See Post</a>
                    @can('delete', $answer)
                       <a href="#" class="delete" id="delete-post">Delete Answer</a>
                    @endcan
                    @can('update', $answer)
                        <a class="btn" aria-current="page" href="{{  route('posts.edit', $answer->id)  }}">Edit</a>
                    @endcan
                </p>
            @else
                <p>
                    @can('delete', $answer)
                       <a href="#" class="delete" id="delete-post">Delete Answer</a>
                    @endcan
                    @can('update', $answer)
                        <a class="btn" aria-current="page" href="{{  route('posts.edit', $answer->id)  }}">Edit</a>
                    @endcan
                </p>
            @endif
            <p class="card-text">{{ $answer->posttext }}</p>
            {{ $answer->postdate }}
            @if(!$showTitle)
                <a class="btn" aria-current="page" href="{{route('users.profile', $answer->userid)}}">&#64;{{ $answer->user()->first()->username }}</a>
                @if( $answer->edited )<p>Edited</p>@endif
            @endif
            <br>
            @if(!$showTitle)
                @php
                    $correct = $answer->iscorrect;
                @endphp
                @if( $correct )
                    <i class="fa-solid fa-circle-check check"></i>
                @else
                    <i class="fa-regular fa-circle-check check"></i>
                @endif
            @endif

            @php
                $stars = DB::table('stars')->where('postid', $answer->id)->get();
            @endphp
            @if(Auth::check())
                @php
                    $userStar = false;
                    for($i = 0; $i < count($stars); $i++){
                        if($stars[$i]->userid === Auth::id()) $userStar = true;
                    }
                @endphp
                @if($userStar)
                    <i class="fa-solid fa-star star">{{ count($stars) }}</i>  
                @else
                    <i class="fa-regular fa-star star">{{ count($stars) }}</i>  
                @endif
            @else
                <i class="fa-regular fa-star">{{ count($stars) }}</i>
            @endif
            <br>

            @if(!$showTitle)
                <a class="btn" aria-current="page" href="{{route('addComment', $answer->id)}}">Add Comment</a>
                <br>
                @php
                    $answerComments = app\Http\Controllers\CommentController::showComments($answer->id);
                @endphp
                <div class="accordion" id="accordionExample">
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingTwo">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#answer-{{ $answer->id }}" aria-expanded="false" aria-controls="collapseTwo">
                                Show Comments ({{count($answerComments)}})
                            </button>
                        </h2>
                        <div id="answer-{{ $answer->id }}" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                                @foreach($answerComments as $comment)
                                    @include('partials.comment')
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
</article>
<br>



