@extends('layouts.app')

@section('content')
<br>
<h2 class="centering">Post Your Question</h2>
<hr>
<br>
<form method="POST" action="{{ route('addQuestion') }}">
    {{ csrf_field() }}
    <div class="mb-3">
      <h4>Title</h4>
      @if ($errors->has('title'))
        <span class="error">
          {{ $errors->first('title') }}
        </span>
      @endif
      <textarea name="title" id="postTitle" class="form-control" rows="2" maxlength="200"></textarea>
      <div id="count-postTitle">
        <span id="current-postTitle">0</span>
        <span id="maximum-postTitle">/ 200</span>
      </div>
    </div>
    <div class="mb-3">
      <h5>Text</h5>
      @if ($errors->has('postText'))
        <span class="error">
          {{ $errors->first('postText') }}
        </span>
      @endif
      <textarea name="postText" id="postText" class="form-control" rows="8" maxlength="1000"></textarea>
      <div id="count-postText">
        <span id="current-postText">0</span>
        <span id="maximum-postText">/ 1000</span>
      </div>
    </div>
    <br>
    <div class="accordion" id="accordionQTags">
      <div class="accordion-item">
        <h2 class="accordion-header" id="headingTag">
        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTag" aria-expanded="true" aria-controls="collapseTag">
            Tags
        </button>
      </h2>
      <div id="collapseTag" class="accordion-collapse collapse" aria-labelledby="headingTag" data-bs-parent="#accordionQTags">
        <div class="accordion-body">
            <div class="container centering">
              <div class="row">
                @foreach(App\Models\Tag::all() as $tag)
                  <div class="form-check col-4">
                    <input class="form-check-input" type="checkbox" value="{{ $tag->id }}" id="{{ $tag->tagname }}" name="{{ $tag->tagname }}">
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
    <div class="buttons">
      <button type="submit" class="btn outlined">
        Ask
      </button>
      <p><a href="#" onclick="history.back()" class="btn">Cancel</a></p>
    </div>
    <br>
</form>
@endsection