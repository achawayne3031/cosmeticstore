
@extends('layouts.app')


@section('content')


<!------
    <a href="/post" class="btn btn-info" role="btn">Go Back</a>
    <hr>

    <h3>{{ $post->title}}</h3>
    <h4>{{$post->body}}</h4>
    <small>{{ $post->created_at}}</small>
    <br>
    <br>


    
    
        @if(!Auth::guest())

            @if($user->id == $post->user_id)

            <a href="/post/{{$post->id}}/edit" class="btn btn-secondary" role="btn">Edit</a>

            {!! Form::open(['action' => ['PostController@destroy', $post->id], 'method' => 'POST', 'class' => 'pull right']) !!}

                {{ Form::hidden('_method', 'DELETE')}}
                {{ Form::submit('Delete', ['class' => 'btn btn-danger'])}}
               
            {!! Form::close() !!}

            @endif

        @endif
    --->
    
@endsection