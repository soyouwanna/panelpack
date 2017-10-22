@extends('vendor.decoweb.admin.layouts.master')
@section('section-title') Setari transport @endsection
@section('section-content')
    @if(session()->has('mesaj'))
        <br>
        <br>
        <div class="alert alert-success text-center" role="alert">
            {{ session()->get('mesaj') }}
        </div>
    @endif
    {!! Form::open(['method'=>'POST','url'=>'admin/shop/transport/','class'=>'form-horizontal']) !!}
    <fieldset>
        <legend>Adaugare transport</legend>
        <div class="form-group">
            {!! Form::label('name','Nume transport:',['class'=>'col-sm-2 control-label']) !!}
            <div class="col-sm-5">
                {!! Form::text('name', null, ['class'=>'form-control', 'id'=>'','placeholder'=>'']) !!}
            </div>
        </div>
        <div class="form-group">
            {!! Form::label('price','Pret:',['class'=>'col-sm-2 control-label']) !!}
            <div class="col-sm-5">
                {!! Form::text('price', null, ['class'=>'form-control', 'id'=>'','placeholder'=>'']) !!}
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <div class="checkbox">
                    <label>
                        {!!  Form::checkbox('visible', null, true).' '.'Vizibil' !!}
                    </label>
                </div>
            </div>
        </div>
        <div class="col-sm-10 col-sm-offset-2">
            {!! Form::submit('Salveaza',['class' => 'btn btn-success']) !!}
            <a href="{{ url('admin/shop/transport') }}" class="btn btn-default">Renunta</a>
        </div>
    </fieldset>
    {!! Form::close() !!}
@endsection