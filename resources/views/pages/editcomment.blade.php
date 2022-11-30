@extends('layouts.app')

@section('title', $comment->id)

@section('content')
    <form method="post" action="{{ route('comments.edit', $comment->id) }}">
        {{ csrf_field() }}
        {{ method_field('patch') }}
        <h3>Edit your comment</h3>
        <br>
        <div class="mb-3">
            <h5>Text</h5>
            <textarea name="commenttext" id="commenttext" class="form-control" rows="8">{{ $comment->commenttext }}</textarea>
        </div>

        <div class="text-center">
            <button type="submit">
                Save Changes
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