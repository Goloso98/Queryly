@extends('layouts.app')

@section('title', $post->id)

@section('content')
<p></p>
@if($post->posttype == 'question') @include('partials.question', ['question' => $post, 'showUser' => TRUE])
@else @include('partials.answer', ['answer' => $post, 'showTitle' => TRUE])
@endif
<ul>
  @foreach($comments as $comment)
    @include('partials.comment', ['showUser' => TRUE])
  @endforeach
</ul>

@endsection