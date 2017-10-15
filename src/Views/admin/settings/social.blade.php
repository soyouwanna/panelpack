@extends('admin.layouts.master')
@section('section-title') Retele sociale @endsection
@section('header-assets')
    <script type="text/javascript" src="{{ asset('js/jquery.validate.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/messages_ro.min.js') }}"></script>
@endsection
@section('section-content')

    {!! Form::open(['method'=>'POST','files'=>true,'url'=>'admin/settings/social/update','id'=>'myForm','class'=>'form-horizontal']) !!}
    <h4>Adrese sociale</h4>
    <div class="form-group">
        {!! Form::label('facebook_address','Facebook:',['class'=>'col-sm-2 control-label']) !!}
        <div class="col-sm-10">
            <div class="input-group">
                <div class="input-group-addon">https://www.facebook.com/</div>
            {!! Form::text('facebook_address', $site_settings['facebook_address'], ['class'=>'form-control', 'id'=>'facebook_address','placeholder'=>'']) !!}
            </div>
        </div>
    </div>
    <div class="form-group">
        {!! Form::label('twitter_address','Twitter:',['class'=>'col-sm-2 control-label']) !!}
        <div class="col-sm-10">
            <div class="input-group">
                <div class="input-group-addon">https://twitter.com/</div>
            {!! Form::text('twitter_address', $site_settings['twitter_address'], ['class'=>'form-control', 'id'=>'twitter_address','placeholder'=>'']) !!}
            </div>
        </div>
    </div>
    <div class="form-group">
        {!! Form::label('google_plus','Google+:',['class'=>'col-sm-2 control-label']) !!}
        <div class="col-sm-10">
            <div class="input-group">
                <div class="input-group-addon">https://plus.google.com/</div>
            {!! Form::text('google_plus', $site_settings['google_plus'], ['class'=>'form-control', 'id'=>'google_plus','placeholder'=>'']) !!}
            </div>
        </div>
    </div>
    <div class="form-group">
        {!! Form::label('youtube','Youtube:',['class'=>'col-sm-2 control-label']) !!}
        <div class="col-sm-10">
            <div class="input-group">
                <div class="input-group-addon">https://www.youtube.com/</div>
                {!! Form::text('youtube', $site_settings['youtube'], ['class'=>'form-control', 'id'=>'youtube','placeholder'=>'']) !!}
            </div>
        </div>
    </div>
    <div class="form-group">
        {!! Form::label('pinterest','Pinterest:',['class'=>'col-sm-2 control-label']) !!}
        <div class="col-sm-10">
            <div class="input-group">
                <div class="input-group-addon">https://</div>
                {!! Form::text('pinterest', $site_settings['pinterest'], ['class'=>'form-control', 'id'=>'pinterest','placeholder'=>'']) !!}
            </div>
        </div>
    </div>
    <h4>Facebook Meta</h4>
    <div class="form-group">
        {!! Form::label('og', 'Alege o poza:', ['class'=>'col-sm-2 control-label']) !!}
        <div class="col-sm-10">
            {!! Form::file('og',['class'=>'form-control']) !!}
        </div>
    </div>
    <div class="col-sm-offset-2">
        <img style="margin-bottom: 10px;" src="{{ url('images/small/'.$site_settings['og_pic']) }}" alt="">
    </div>
    <div class="col-sm-10 col-sm-offset-2">
        {!! Form::submit('Submit',['class' => 'btn btn-success']) !!}
    </div>
    {!! Form::close() !!}

{{--<script>
    $().ready(function() {
        $("#myForm").validate({
            rules : {
                'facebook_address': {
                required: true,
                minlength : 3,
                maxlength: 50
                },

            }
        });
    });
</script>--}}
@endsection