<form action="{{ route('exactMatchSearch') }}" method="post" class="searchbar">
    {{ csrf_field() }}
    <input type="text" placeholder="Search" name="search" id="search" value="{{ request()->input('search') }}">
    <p></p> <!-- will not do a proper break with br -->
    <div class="mb-3"> 
        @foreach(App\Models\Tag::all() as $tag)
        <div class="form-check">
            <input class="form-check-input" type="checkbox" value="{{ $tag->id }}" id="{{ $tag->tagname }}" name="tag[]">
            <label class="form-check-label" for="{{ $tag->tagname }}">{{ $tag->tagname }}</label>
        </div>
        @endforeach
    </div>
    <div class = "dropdown">
        <select id = "orderby" name = "orderby">
           <!-- <option name = "mostvoted">Most Voted</option> -->
           <!-- <option name = "lessvoted">Less Voted</option> -->
            <option value = "newest">Newest</option>
            <option value = "oldest">Oldest</option>
        </select>
    </div>
    <br>
    <input type="submit" value="Submit">
    <br>
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    <br>
</form>