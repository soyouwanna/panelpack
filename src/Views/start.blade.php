<?php
use App\User;
?>
@extends('vendor.decoweb.layouts.app')
@section('content')
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <h5 class="text-center">Starter kit page</h5>
                <h1 class="text-center">Welcome to Decoweb Panelpack</h1>
                <h3 class="text-center">Admin panel for Laravel</h3>
                <hr>
                <?php

                $admin = User::first();
                if( null == $admin){
                ?>
                <p class="text-warning text-center">
                    Apparently, there is no admin registered for your app. <br>
                    Please fill the form bellow with the right credentials.
                </p>
                {!! Form::open(['method'=>'post','url'=>url('/kit'),'class'=>'form-horizontal']) !!}
                <div class="form-group">
                    {!! Form::label('email','Email:',['class'=>'col-sm-2 control-label']) !!}
                    <div class="col-sm-5">
                        {!! Form::email('email', null, ['class'=>'form-control', 'id'=>'','placeholder'=>'']) !!}
                    </div>
                </div>
                <div class="form-group">
                    {!! Form::label('password','Password:',['class'=>'col-sm-2 control-label']) !!}
                    <div class="col-sm-5">
                        {!! Form::text('password', null, ['class'=>'form-control', 'id'=>'','placeholder'=>'']) !!}
                    </div>
                </div>
                <div class="col-sm-10 col-sm-offset-2">
                    {!! Form::submit('Submit',['class' => 'btn btn-success']) !!}
                </div>
                {!! Form::close() !!}

                <?php
                }else{
                ?>
                <p>Admin email is <strong>{{ $admin->email }}</strong></p>
                <a href="{{ url('/admin/login') }}" class="btn btn-info">Admin Login</a>

                <?php
                }
                ?>
            </div>
        </div>
    </div>
@endsection