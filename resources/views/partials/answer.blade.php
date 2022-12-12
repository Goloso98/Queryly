<article class="post" data-id="{{ $answer->id }}" user-id="{{Auth::id()}}">
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
            <a href="{{route('posts.comments', $answer->id)}}">Comments</a>
            <a href="{{route('addComment', $answer->id)}}">Comment Answer</a>
            <br>

            @php
                $correct = $answer->iscorrect;
            @endphp
            @if( $correct )
                <i class="fa-solid fa-circle-check check"></i>
            @else
                <i class="fa-regular fa-circle-check check"></i>
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
        </div>
    </div>
</article>
<p></p>



