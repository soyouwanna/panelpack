@extends('vendor.decoweb.admin.layouts.master')
@section('section-title') Profil @endsection
@section('section-content')

    @if(session()->has('mesaj'))
        <br>
        <br>
        <div class="alert alert-success text-center" role="alert">
            {{ session()->get('mesaj') }}
        </div>
    @endif

    {!! Form::open(['method'=>'PUT','route'=>['update.password', $user->id],'class'=>'form-horizontal']) !!}
    {{--<div class="form-group">
        {!! Form::label('email','Email',['class'=>'col-sm-3 control-label']) !!}
        <div class="col-sm-4">
            {!! Form::email('email', null, ['class'=>'form-control', 'id'=>'email','placeholder'=>'']) !!}
        </div>
    </div>--}}
    <div class="form-group">
        {!! Form::label('password','Parola noua *',['class'=>'col-sm-3 control-label']) !!}
        <div class="col-sm-4">
            {!! Form::password('password', ['class'=>'form-control', 'id'=>'password','placeholder'=>'']) !!}
        </div>
    </div>
    <div class="form-group">
        {!! Form::label('passwordAgain','Retasteaza parola *',['class'=>'col-sm-3 control-label']) !!}
        <div class="col-sm-4">
            {!! Form::password('passwordAgain', ['class'=>'form-control', 'id'=>'passwordAgain','placeholder'=>'']) !!}
        </div>
    </div>
    <div class="col-sm-10 col-sm-offset-3">
        {!! Form::submit('Submit',['class' => 'btn btn-success btn-sm']) !!}
    </div>
    {!! Form::close() !!}
@endsection