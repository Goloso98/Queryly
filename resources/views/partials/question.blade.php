<article class="post" data-id="{{ $question->id }}" user-id="{{ Auth::id() }}">
    <div class="card">
        <div class="card-body">
            @if($report)
                <h4 class="card-title shrinkTitle">{{ $question->title }}</h4>
            @else
                <h3 class="card-title shrinkTitle">{{ $question->title }}</h3>
            @endif
            <p>
                <a href="{{route('posts.postPage', $question->id)}}" class="btn cardBtn">See Post</a>
                @can('delete', $question)
                    <a class="delete btn" id="delete-post" href="#"> Delete Question </a>
                @endcan
            </p>
            <p class="card-text shrinkText">{{ $question->posttext }}</p>
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
                    <i class="fa-solid fa-star star">&nbsp;<span class="starLabel">{{ count($stars) }}</span></i>  
                @else
                    <i class="fa-regular fa-star star">&nbsp;<span class="starLabel">{{ count($stars) }}</span></i>  
                @endif
            @else
               <i class="fa-regular fa-star">&nbsp;<span class="starLabel">{{ count($stars) }}</span></i>
            @endif
        </div>
    </div>
</article>
<br>