<form action="{{ route('exactMatchSearch') }}" method="post">
    {{ csrf_field() }}
    <input type="text" placeholder="Search" name="search" id="search" value="{{ request()->input('search') }}">
    <p></p>
    <input type="text" placeholder="Tags" name="tags" id="tags" value="{{ request()->input('tags') }}">
    <p></p>
    <div class = "dropdown">
        <select id = "orderby" name = "orderby">
            <option name = "mostvoted">Most Voted</option>
            <option name = "lessvoted">Less Voted</option>
            <option name = "newest">Newest</option>
            <option name = "oldest">Oldest</option>
        </select>
    </div>
    <p></p>
    <div class = "dropdown">
        <select id = "searchfor" name = "searchfor">
            <option name = "questions">Questions</option>
            <option name = "users">Users</option>
            <option name = "both">Both</option>
        </select>
    </div>
    <p></p>

    <input type="submit" value="Submit">
    <p></p>
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    <p></p>
</form>