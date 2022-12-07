<article class="post" data-id="{{ $question->id }}" user-id="{{ Auth::id() }}">
    <div class="card">
        <div class="card-body">
            <h3 class="card-title">{{ $question->title }}</h3>
            <p>
                <a href="{{route('posts.postPage', $question->id)}}">See Post</a>
                <a href="{{route('posts.comments', $question->id)}}">Comments</a>
            </p>
            <p class="card-text">{{ $question->posttext }}</p>
            {{ $question->postdate }}
            @if($showUser)
            @php
            $username = DB::table('users')->find($question->userid)->username;
            @endphp
            <a class="btn" aria-current="page" href="{{route('users.profile', $question->userid)}}">&#64;{{$username}}</a>
            @endif
            <p></p>
            @can('delete', $question)
                <a class="delete" href="#"> Delete Question </a>
            @endcan
            <br>
            @php
                $stars = DB::table('stars')->where('postid', $question->id)->get();
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
        </div>
    </div>
</article>
<p></p>