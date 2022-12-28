<article class="post" data-id="{{ $answer->id }}" user-id="{{Auth::id()}}" id="answer-{{ $answer->id}}">
    <div class="card">
        <div class="card-body">
            @if($showTitle)
                <h3 class="card-title">Answer to: {{ App\Models\Post::find($answer->parentpost)->title }}</h3>
                <p>
                    <a href="{{route('posts.postPage', $answer->parentpost)}}#answer-{{ $answer->id}}" class="btn" id="cardBtn">See Post</a>
                    @can('delete', $answer)
                       <a href="#" class="delete btn" id="delete-post">Delete Answer</a>
                    @endcan
                    @can('update', $answer)
                        <a class="btn" id="cardBtn" aria-current="page" href="{{  route('posts.edit', $answer->id)  }}">Edit</a>
                    @endcan
                </p>
            @else
                <p>
                    @can('delete', $answer)
                       <a href="#" class="delete btn" id="delete-post">Delete Answer</a>
                    @endcan
                    @can('update', $answer)
                        <a class="btn" id="cardBtn" aria-current="page" href="{{  route('posts.edit', $answer->id)  }}">Edit</a>
                    @endcan
                </p>
            @endif
            <p class="card-text">{{ $answer->posttext }}</p>
            @if( $answer->edited )
                <span id="editedLabel">(edited)</span>
                <br>
            @endif
            {{ $answer->postdate }}
            @if(!$showTitle)
                @php
                    $username = DB::table('users')->find($answer->userid)->username;
                @endphp
                <a class="btn" aria-current="page" href="{{route('users.profile', $answer->userid)}}">&#64;{{ $username }}</a>
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
                    <i class="fa-solid fa-star star">&nbsp;{{ count($stars) }}</i>  
                @else
                    <i class="fa-regular fa-star star">&nbsp;{{ count($stars) }}</i>  
                @endif
            @else
                <i class="fa-regular fa-star">&nbsp;{{ count($stars) }}</i>
            @endif
            @if(!$showTitle)
                <a class="btn" aria-current="page" href="{{route('addComment', $answer->id)}}">Add Comment</a>
                <br>
                @php
                    $answerComments = app\Http\Controllers\CommentController::showComments($answer->id);
                @endphp
                @if($answerComments->count() != 0)
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
            @endif
        </div>
    </div>
</article>
<br>



