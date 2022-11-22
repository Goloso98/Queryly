@extends('layouts.app')

@section('title', $post->title)

@section('content')
    <form method="post" action="{{ route('posts.edit', $post->id) }}">
        {{ csrf_field() }}
        {{ method_field('patch') }}

        @if (($post->posttype) == 'question')
            <label>Title</label> <br>
            <input type="text" name="title"  value="{{ $post->title }}" />
            <p></p>
        @endif
        <label>Text</label> <br>
        <input type="text" name="posttext"  value="{{ $post->posttext }}" />
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
    </form>
@endsection