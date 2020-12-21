
@extends('layouts.app')

    @section('content')

        <h3 class="text-center">Create New Post</h3>

            {!! Form::open(['method' => 'POST', 'action' => 'PostController@store', 'enctype' => 'multipart/form-data']) !!}

                <div class="form-group">
                    {{ Form::label('title', 'Title')}}
                    {{ Form::text('title', '', ['class' => 'form-control', 'placeholder' => 'Enter the title'])}}
                </div>

                <div class="form-group">
                    {{ Form::label('body', 'Body')}}
                    {{ Form::textarea('body', '', ['class' => 'form-control', 'placeholder' => 'Enter the body'])}}
                </div>

                <div class="form-group">
                    {{ Form::file('cover')}}
                </div>

                <div class="form-group">
                    {{ Form::submit('Submit', ['class' => 'btn btn-success'])}}
                </div>

            
            {!! Form::close() !!}

        

        
    @endsection





