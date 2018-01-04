@extends('vendor.decoweb.admin.layouts.master')
@section('section-title') Setari generale -  @endsection
@section('section-content')
    {!! Form::open(['method'=>'POST','url'=>'admin/settings/update','class'=>'form-horizontal']) !!}
    <div class="form-group">
        {!! Form::label('analytics','Google analytics:',['class'=>'col-sm-2 control-label']) !!}
        <div class="col-sm-5">
            {!! Form::textarea('analytics', $site_settings['analytics'], ['class'=>'form-control', 'id'=>'analytics','placeholder'=>'']) !!}
        </div>
    </div>
    <h4>Setari Site</h4>
    <hr>
    <div class="form-group">
        {!! Form::label('city','Oras companie:',['class'=>'col-md-2 control-label']) !!}
        <div class="col-md-5">
            {!! Form::text('city', $site_settings['city'], ['class'=>'form-control', 'id'=>'city','placeholder'=>'']) !!}
        </div>
    </div>
    <div class="form-group">
        {!! Form::label('system_email','Email de sistem:',['class'=>'col-sm-2 control-label']) !!}
        <div class="col-sm-5">
            {!! Form::text('system_email', $site_settings['system_email'], ['class'=>'form-control', 'id'=>'system_email','placeholder'=>'']) !!}
        </div>
    </div>
    <div class="form-group">
        {!! Form::label('contact_email','Email de contact:',['class'=>'col-sm-2 control-label']) !!}
        <div class="col-sm-5">
            {!! Form::text('contact_email', $site_settings['contact_email'], ['class'=>'form-control', 'id'=>'contact_email','placeholder'=>'']) !!}
        </div>
    </div>
    <div class="form-group">
        {!! Form::label('phone','Telefon:',['class'=>'col-sm-2 control-label']) !!}
        <div class="col-sm-5">
            {!! Form::text('phone', $site_settings['phone'], ['class'=>'form-control', 'id'=>'phone','placeholder'=>'']) !!}
        </div>
    </div>
    <h4>Setari SEO</h4>
    <hr>
    <div class="form-group">
        {!! Form::label('site_name','Numele site-ului:',['class'=>'col-sm-2 control-label']) !!}
        <div class="col-sm-5">
            {!! Form::text('site_name', $site_settings['site_name'], ['class'=>'form-control', 'id'=>'site_name','placeholder'=>'']) !!}
        </div>
    </div>
    <div class="form-group">
        {!! Form::label('meta_keywords','Cuvinte cheie:',['class'=>'col-sm-2 control-label']) !!}
        <div class="col-sm-5">
            {!! Form::text('meta_keywords', $site_settings['meta_keywords'], ['class'=>'form-control', 'id'=>'meta_keywords','placeholder'=>'10-12 cuvinte, separate prin virgula']) !!}
        </div>
    </div>
    <div class="form-group">
        {!! Form::label('meta_description','Meta descriere:',['class'=>'col-sm-2 control-label']) !!}
        <div class="col-sm-5">
            {!! Form::textarea('meta_description', $site_settings['meta_description'], ['class'=>'form-control', 'id'=>'meta_description','placeholder'=>'Descriere site - max 180 de caractere...']) !!}
        </div>
    </div>
    <div class="col-sm-10 col-sm-offset-2">
        {!! Form::submit('Submit',['class' => 'btn btn-success']) !!}
    </div>
    {!! Form::close() !!}
@endsection