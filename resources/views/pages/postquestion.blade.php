@extends('layouts.app')

@section('content')
<form method="POST" action="{{ route('addQuestion') }}">
    {{ csrf_field() }}
    <h3>Post your question</h3>
    <br>
    <div class="mb-3">
      <h4>Title</h4>
      <textarea name="title" id="title" class="form-control" rows="2"></textarea>
    </div>
    <div class="mb-3">
      <h5>Text</h5>
      <textarea name="postText" id="postText" class="form-control" rows="8"></textarea>
    </div>
    <div class="mb-3">
        <h5>Tags</h5>
          @foreach(App\Models\Tag::all() as $tag)
            <div class="form-check">
              <input class="form-check-input" type="checkbox" value="{{ $tag->tagname }}" id="{{ $tag->tagname }}" name="{{ $tag->tagname }}">
              <label class="form-check-label" for="{{ $tag->tagname }}">{{ $tag->tagname }}</label>
            </div>
          @endforeach
    </div>

    <div class="text-center">
      <button type="submit">
        Ask
      </button>
      <p><a href="#" onclick="history.back()">Cancel</a></p>
    </div>
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
</form>
@endsection