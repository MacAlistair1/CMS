@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <a class="btn btn-primary btn-lg" href="/posts/create">Create Post</a>
                    <h1>Your Posts</h1>
                    <table class="table table-striped">
                        <tr>
                            <th>Title</th>
                            <th></th>
                            <th></th>
                        </tr>
                       
                           @if (count($posts) > 0)
                            @foreach ($posts as $post)
                            <tr>
                            <td>{{ $post->title }}</td>
                            <td><a href="/posts/{{ $post->id }}/edit" class="btn btn-primary">Edit</a></td>
                            <td>
                                    {!! Form::open(['action' => ['PostsController@destroy', $post->id], 'method' => 'POST']) !!}
                                    {{ Form::hidden('_method', 'DELETE') }}
                                    {{ Form::submit('Delete', ['class' => 'btn btn-danger']) }}
                                    {!! Form::close() !!}
                            </td>
                            </tr>
                            @endforeach                               
                           @else
                               <h3>You have no Post!</h3>
                           @endif
                           
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
