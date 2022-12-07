<form action="{{ route('exactMatchSearch') }}" method="post" class="searchbar">
    {{ csrf_field() }}
    <input type="text" placeholder="Search" name="search" id="search" value="{{ request()->input('search') }}">
    <br>
    <!-- <input type="text" placeholder="Tags" name="tags" id="tags" value="{{ request()->input('tags') }}"> -->
    <br>
    <div class = "dropdown">
        <select id = "orderby" name = "orderby">
           <!-- <option name = "mostvoted">Most Voted</option> -->
           <!-- <option name = "lessvoted">Less Voted</option> -->
            <option value = "newest">Newest</option>
            <option value = "oldest">Oldest</option>
        </select>
    </div>
    <br>
    <div class = "dropdown">
        <select id = "searchfor" name = "searchfor">
            <option value = "questions">Questions</option>
            <!-- {{ old('searchfor') == "users" ? "selected":"" }} -->
            <option value = "users">Users</option>
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