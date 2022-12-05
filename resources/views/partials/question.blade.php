<article class="post" data-id="{{ $question->id }}">
    <div class="card">
        <div class="card-body">
            <h3 class="card-title">{{ $question->title }}</h3>
            <p>
                <a href="{{route('posts.postPage', $question->id)}}">See Post</a>
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
        </div>
    </div>
</article>
<p></p>