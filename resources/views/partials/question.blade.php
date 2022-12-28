<article class="post" data-id="{{ $question->id }}" user-id="{{ Auth::id() }}">
    <div class="card">
        <div class="card-body">
            <h3 class="card-title">{{ $question->title }}</h3>
            <p>
                <a href="{{route('posts.postPage', $question->id)}}">See Post</a>
                @can('delete', $question)
                <a class="delete" id="delete-post" href="#"> Delete Question </a>
                @endcan
                <form method="post" action="{{ route('posts.report', $question->id) }}">
                    {{ csrf_field() }}
                    <button type="submit"> Report Question </button>
                </form>
            </p>
            <p class="card-text">{{ $question->posttext }}</p>
            {{ $question->postdate }}
            @if($showUser)
                @php
                $username = DB::table('users')->find($question->userid)->username;
                @endphp
                <a class="btn" aria-current="page" href="{{route('users.profile', $question->userid)}}">&#64;{{$username}}</a>
            @endif
            <br>
            @php
                $stars = DB::table('stars')->where('postid', $question->id)->get();
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
        </div>
    </div>
</article>
<br>