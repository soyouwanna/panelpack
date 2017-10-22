<?php define('NOERRORS',1); ?>
@extends('vendor.decoweb.admin.layouts.master')
@section('section-title') Utilizatori @endsection
@section('section-content')
    <div class="panel panel-default">
        <div class="panel-body">
            Numar comenzi : {{ count($customer->orders) }}
        </div>
    </div>
    {{--{{ $customer->orders[0]->items[0]->name }}
    {{ $customer->orders[0]->items[0]->price }}--}}
    {!! Form::open(['method'=>'PUT','url'=>'admin/shop/customers/'.$customer->id,'id'=>'myform','class'=>'form-horizontal']) !!}
    <fieldset>
        <?php $name = ( $customer->email != '')?$customer->email:$customer->name; ?>
        <legend>Utilizator: <strong>{{ $name }}</strong></legend>
        <div class="form-group">
            {!! Form::label('account_type','Tip cont * :',['class'=>'col-sm-2 control-label']) !!}
            <div class="col-sm-5">
                {!! Form::select('account_type',[0=>'Persoana fizica',1=>'Persoana juridica'] ,$customer->account_type,['class'=>'form-control input-sm','id'=>'cont']) !!}
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
                    {!! Form::email('email', $customer->email, ['class'=>'form-control input-sm', 'id'=>'email','placeholder'=>'']) !!}
                    @if ($errors->has('email'))
                        <span class="help-block"><strong>{{ $errors->first('email') }}</strong></span>
                    @endif
                </div>
            </div>
        <div id="pers_fizica">
            <div class="form-group">
                {!! Form::label('name','Nume :',['class'=>'col-sm-2 control-label']) !!}
                <div class="col-sm-5">
                    {!! Form::text('name',$customer->name, ['class'=>'form-control input-sm', 'id'=>'name','placeholder'=>'(doar litere, spatii si cratima)']) !!}
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
                    {!! Form::text('phone', $customer->phone, ['class'=>'form-control input-sm', 'id'=>'phone','placeholder'=>'(doar cifre)']) !!}
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
                    {!! Form::text('cnp', $customer->cnp, ['class'=>'form-control input-sm', 'id'=>'cnp','placeholder'=>'(doar cifre)']) !!}
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
                    {!! Form::text('region', $customer->region, ['class'=>'form-control input-sm', 'id'=>'region','placeholder'=>'(doar litere, spatii si cratima)']) !!}
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
                    {!! Form::text('city', $customer->city, ['class'=>'form-control input-sm', 'id'=>'city','placeholder'=>'(doar litere, spatii si cratima)']) !!}
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
                    {!! Form::text('company', $customer->company, ['class'=>'form-control input-sm', 'id'=>'company','placeholder'=>'(doar litere, cifre, spatii si cratima)']) !!}
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
                    {!! Form::text('rc', $customer->rc, ['class'=>'form-control input-sm', 'id'=>'rc','placeholder'=>'(doar litere si cifre)']) !!}
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
                    {!! Form::text('cif', $customer->cif, ['class'=>'form-control input-sm', 'id'=>'cif','placeholder'=>'(doar cifre)']) !!}
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
                    {!! Form::text('bank_account', $customer->bank_account, ['class'=>'form-control input-sm', 'id'=>'bank_account','placeholder'=>'(doar litere si cifre)']) !!}
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
                    {!! Form::text('bank_name', $customer->bank_name, ['class'=>'form-control input-sm', 'id'=>'bank_name','placeholder'=>'(doar litere, spatii si cratima)']) !!}
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
                {!! Form::textarea('address', $customer->address, ['class'=>'form-control input-sm', 'rows'=>3,'id'=>'address','placeholder'=>'(adresa)']) !!}
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
                        <?php $checked = ( ! $customer->verified )?:'checked'; ?>
                        <input type="checkbox" value="1" name="verified" {{ $checked }}> Activ
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