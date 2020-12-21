
@extends('layouts.app')


@section('content')


        <h3 class="text-center">Edit Post</h3>

        {!! Form::open(['method' => 'POST', 'action' => ['PostController@update', $post->id], 'enctype' => 'multipart/form-data']) !!}

            <div class="form-group">
                {{ Form::label('title', 'Title')}}
                {{ Form::text('title', $post->title, ['class' => 'form-control', 'placeholder' => 'Enter the title'])}}
            </div>

            <div class="form-group">
                {{ Form::label('body', 'Body')}}
                {{ Form::textarea('body', $post->body, ['class' => 'form-control', 'placeholder' => 'Enter the body'])}}
            </div>

            <div class="form-group">
                {{ Form::file('cover')}}
            </div>

            <div class="form-group">
                {{ Form::hidden('_method', 'PUT')}}
                {{ Form::submit('Submit', ['class' => 'btn btn-success'])}}
            </div>


        {!! Form::close() !!}


    
@endsection