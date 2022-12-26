@if($userSearch)
    <form action="{{ route('searchUser') }}?searchType=user" method="post" class="searchbar">
@else
    <form action="{{ route('searchPost') }}?searchType=post" method="post" class="searchbar">
@endif

    {{ csrf_field() }}
    <input type="search" placeholder="Search" name="search" id="search" value="{{ request()->input('search') }}">
    <p></p> <!-- will not do a proper break with br -->

    @if(!$userSearch)
        <div class="accordion" id="accordionTags">
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingOne">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                        Tags
                    </button>
                </h2>
                <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                        <div class="container text-center">
                            <div class="row">
                                @foreach(App\Models\Tag::all() as $tag)
                                    <div class="form-check col-4">
                                        <input class="form-check-input" type="checkbox" value="{{ $tag->id }}" id="{{ $tag->tagname }}" name="tag[]">
                                        <label class="form-check-label" for="{{ $tag->tagname }}">{{ $tag->tagname }}</label>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <br>

        <select class="form-select" id = "orderby" name = "orderby">
            <!-- <option name = "mostvoted">Most Voted</option> -->
            <!-- <option name = "lessvoted">Less Voted</option> -->
            <option value = "newest">Newest</option>
            <option value = "oldest">Oldest</option>
        </select>
    @endif
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