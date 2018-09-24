@extends('layouts.app')

@section('content')
<a href="/posts" class="btn btn-secondary">Go Back</a>
<div class="jumbotron">
<h1 class="display-4">{{$post->title}}</h1>
<div>
        <img style="width:100%" src="<?php echo asset('img/'.$post->blog_image); ?>" alt="Blog Image">
 <p class="lead my-3">{{ $post->body}}</p>   
</div>
<hr>
<small>Written on {{ $post->created_at}} by {{ $post->user->name }}</small>
<hr>
@if (!Auth::guest())
    @if(auth()->user()->id == $post->user_id)
        <a href="/posts/{{ $post->id }}/edit" class="btn btn-primary">Edit</a>
        {!! Form::open(['action' => ['PostsController@destroy', $post->id], 'method' => 'POST']) !!}
        {{ Form::hidden('_method', 'DELETE') }}
        {{ Form::submit('Delete', ['class' => 'btn btn-danger']) }}
        {!! Form::close() !!}
    @endif
@endif
@endsection