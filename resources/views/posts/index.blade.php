@extends('layouts.app')

@section('content')
@include('includes.message')
    <h1>Posts</h1>
    @if (count($posts) > 0)
        @foreach ($posts as $post)
        <div class="jumbotron p-3 p-md-5 text-white rounded bg-dark">
            <div class="row">
                <div class="col-md-4 col-sm-4">
                        <img style="width:200px; height:200px" src="<?php echo asset('img/'.$post->blog_image); ?>" alt="Blog Image">
                </div>
                <div class="col-md-8 col-sm-8">
                        <h3><a href="/posts/{{ $post->id }}">{{ $post->title }}</h3></a>
                        <small>Created on{{ $post->created_at }} by {{ $post->user->name }}</small>
                </div>
				
            </div>
           
        </div>
        @endforeach    
        {{ $posts->links() }}
    @else
    <h3>No Posts Found!!</h3>   
    @endif
@endsection
