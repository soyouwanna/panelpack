<?php define('NOERRORS',1); ?>
@extends('vendor.decoweb.admin.layouts.master')
@section('section-title') Utilizatori @endsection
@section('section-content')

    @if(session()->has('mesaj'))
        <br>
        <br>
        <div class="alert alert-success text-center" role="alert">
            {{ session()->get('mesaj') }}
        </div>
    @endif

    {!! Form::open(['method'=>'POST','url'=>'admin/shop/customers','id'=>'myform','class'=>'form-horizontal']) !!}
    <fieldset>
        <legend>Adaugare utilizator</legend>
        <div class="form-group">
            {!! Form::label('account_type','Tip cont * :',['class'=>'col-sm-2 control-label']) !!}
            <div class="col-sm-5">
                {!! Form::select('account_type',[0=>'Persoana fizica',1=>'Persoana juridica'] ,null,['class'=>'form-control input-sm','id'=>'cont']) !!}
                @if ($errors->has('account_type'))
                    <span class="help-block">
                <strong>{{ $errors->first('account_type') }}</strong>
            </span>
                @endif
            </div>
        </div>

            <div class="form-group">
                {!! Form::label('email','Email * :',['class'=>'col-sm-2 control-label']) !!}
                <div class="col-sm-5">
                    {!! Form::email('email', null, ['class'=>'form-control input-sm', 'id'=>'email','placeholder'=>'']) !!}
                    @if ($errors->has('email'))
                        <span class="help-block"><strong>{{ $errors->first('email') }}</strong></span>
                    @endif
                </div>
            </div>
        <input type="hidden" name="length" value="6">
        <div class="form-group">
            {!! Form::label('password','Parola * :',['class'=>'col-sm-2 control-label']) !!}
            <div class="col-sm-2">
                {!! Form::text('password', null, ['class'=>'form-control input-sm', 'id'=>'password','placeholder'=>'']) !!}
            </div>
            <div class="col-sm-8">
                <input type="button" class="btn btn-success btn-sm" value="Genereaza" onClick="generate();" tabindex="2">
            </div>
            @if ($errors->has('password'))
                <div class="col-sm-5 col-sm-offset-2">
                    <span class="help-block"><strong>{{ $errors->first('password') }}</strong></span>
                </div>
            @endif
        </div>
        <div id="pers_fizica">
            <div class="form-group">
                {!! Form::label('name','Nume :',['class'=>'col-sm-2 control-label']) !!}
                <div class="col-sm-5">
                    {!! Form::text('name', null, ['class'=>'form-control input-sm', 'id'=>'name','placeholder'=>'(doar litere, spatii si cratima)']) !!}
                    @if ($errors->has('name'))
                        <span class="help-block">
                    <strong>{{ $errors->first('name') }}</strong>
                </span>
                    @endif
                </div>
            </div>
            <div class="form-group">
                {!! Form::label('phone','Telefon :',['class'=>'col-sm-2 control-label']) !!}
                <div class="col-sm-5">
                    {!! Form::text('phone', null, ['class'=>'form-control input-sm', 'id'=>'phone','placeholder'=>'(doar cifre)']) !!}
                    @if ($errors->has('phone'))
                        <span class="help-block">
                    <strong>{{ $errors->first('phone') }}</strong>
                </span>
                    @endif
                </div>
            </div>
            <div class="form-group">
                {!! Form::label('cnp','CNP :',['class'=>'col-sm-2 control-label']) !!}
                <div class="col-sm-5">
                    {!! Form::text('cnp', null, ['class'=>'form-control input-sm', 'id'=>'cnp','placeholder'=>'(doar cifre)']) !!}
                    @if ($errors->has('cnp'))
                        <span class="help-block">
                    <strong>{{ $errors->first('cnp') }}</strong>
                </span>
                    @endif
                </div>
            </div>
            <div class="form-group">
                {!! Form::label('region','Judet :',['class'=>'col-sm-2 control-label']) !!}
                <div class="col-sm-5">
                    {!! Form::text('region', null, ['class'=>'form-control input-sm', 'id'=>'region','placeholder'=>'(doar litere, spatii si cratima)']) !!}
                    @if ($errors->has('region'))
                        <span class="help-block">
                    <strong>{{ $errors->first('region') }}</strong>
                </span>
                    @endif
                </div>
            </div>
            <div class="form-group">
                {!! Form::label('city','Oras :',['class'=>'col-sm-2 control-label']) !!}
                <div class="col-sm-5">
                    {!! Form::text('city', null, ['class'=>'form-control input-sm', 'id'=>'city','placeholder'=>'(doar litere, spatii si cratima)']) !!}
                    @if ($errors->has('city'))
                        <span class="help-block">
                    <strong>{{ $errors->first('city') }}</strong>
                </span>
                    @endif
                </div>
            </div>
        </div>
        <div id="pers_juridica">
            <div class="form-group">
                {!! Form::label('company','Companie :',['class'=>'col-sm-2 control-label']) !!}
                <div class="col-sm-5">
                    {!! Form::text('company', null, ['class'=>'form-control input-sm', 'id'=>'company','placeholder'=>'(doar litere, cifre, spatii si cratima)']) !!}
                    @if ($errors->has('company'))
                        <span class="help-block">
                    <strong>{{ $errors->first('company') }}</strong>
                </span>
                    @endif
                </div>
            </div>
            <div class="form-group">
                {!! Form::label('rc','Nr. Reg. Com. :',['class'=>'col-sm-2 control-label']) !!}
                <div class="col-sm-5">
                    {!! Form::text('rc', null, ['class'=>'form-control input-sm', 'id'=>'rc','placeholder'=>'(doar litere si cifre)']) !!}
                    @if ($errors->has('rc'))
                        <span class="help-block">
                    <strong>{{ $errors->first('rc') }}</strong>
                </span>
                    @endif
                </div>
            </div>
            <div class="form-group">
                {!! Form::label('cif','CIF :',['class'=>'col-sm-2 control-label']) !!}
                <div class="col-sm-5">
                    {!! Form::text('cif', null, ['class'=>'form-control input-sm', 'id'=>'cif','placeholder'=>'(doar cifre)']) !!}
                    @if ($errors->has('cif'))
                        <span class="help-block">
                    <strong>{{ $errors->first('cif') }}</strong>
                </span>
                    @endif
                </div>
            </div>
            <div class="form-group">
                {!! Form::label('bank_account','Cont bancar :',['class'=>'col-sm-2 control-label']) !!}
                <div class="col-sm-5">
                    {!! Form::text('bank_account', null, ['class'=>'form-control input-sm', 'id'=>'bank_account','placeholder'=>'(doar litere si cifre)']) !!}
                    @if ($errors->has('bank_account'))
                        <span class="help-block">
                    <strong>{{ $errors->first('bank_account') }}</strong>
                </span>
                    @endif
                </div>
            </div>
            <div class="form-group">
                {!! Form::label('bank_name','Nume banca :',['class'=>'col-sm-2 control-label']) !!}
                <div class="col-sm-5">
                    {!! Form::text('bank_name', null, ['class'=>'form-control input-sm', 'id'=>'bank_name','placeholder'=>'(doar litere, spatii si cratima)']) !!}
                    @if ($errors->has('bank_name'))
                        <span class="help-block">
                    <strong>{{ $errors->first('bank_name') }}</strong>
                </span>
                    @endif
                </div>
            </div>
        </div>
        <div class="form-group">
            {!! Form::label('address','Adresa :',['class'=>'col-sm-2 control-label']) !!}
            <div class="col-sm-5">
                {!! Form::textarea('address', null, ['class'=>'form-control input-sm', 'rows'=>3,'id'=>'address','placeholder'=>'(adresa)']) !!}
                @if ($errors->has('address'))
                    <span class="help-block">
                    <strong>{{ $errors->first('address') }}</strong>
                </span>
                @endif
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <div class="checkbox">
                    <label>
                        <input type="checkbox" value="1" name="verified" checked> Activ
                    </label>
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <div class="checkbox">
                    <label>
                        <input type="checkbox" value="1" name="notify"> Notifica utilizator
                    </label>
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-5 col-sm-offset-2">
                {!! Form::submit('Salveaza', ['class'=>'btn btn-primary btn-sm']) !!}
            </div>
        </div>
    </fieldset>
    {!! Form::close() !!}

@endsection
@section('footer-assets')
    <script>
        function randomPassword(length) {
            var chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOP1234567890";
            var pass = "";
            for (var x = 0; x < length; x++) {
                var i = Math.floor(Math.random() * chars.length);
                pass += chars.charAt(i);
            }
            return pass;
        }
        function generate() {
            myform.password.value = randomPassword(myform.length.value);
        }
    </script>
@endsection