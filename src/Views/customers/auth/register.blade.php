@extends('vendor.decoweb.layouts.app')
@section('content')
    @if(session()->has('mesaj'))
        <br>
        <br>
        <div class="alert alert-success text-center" role="alert">
            {{ session()->get('mesaj') }}
        </div>
    @endif
<div class="panel panel-default">
    <div class="panel-heading"><h1>Cont nou</h1></div>
    <div class="panel-body">
        <form class="form-horizontal" role="form" method="POST" action="{{ url('customer/register') }}">
            {{ csrf_field() }}

            <h3>Date autentificare</h3>
            <hr>
            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                <div class="col-md-6">
                    <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

                    @if ($errors->has('email'))
                        <span class="help-block">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                    @endif
                </div>
            </div>

            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                <label for="password" class="col-md-4 control-label">Password</label>

                <div class="col-md-6">
                    <input id="password" type="password" class="form-control" name="password" required>

                    @if ($errors->has('password'))
                        <span class="help-block">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                    @endif
                </div>
            </div>

            <div class="form-group">
                <label for="password-confirm" class="col-md-4 control-label">Confirm Password</label>

                <div class="col-md-6">
                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                </div>
            </div>
            <h3>Tip cont</h3>
            <hr>
            <div class="form-group">
                {!! Form::label('account_type','Tip cont :',['class'=>'col-sm-2 control-label']) !!}
                <div class="col-sm-5">
                    {!! Form::select('account_type',[0=>'Persoana fizica',1=>'Persoana juridica'] ,null,['class'=>'form-control','id'=>'cont']) !!}
                    @if ($errors->has('account_type'))
                        <span class="help-block">
                            <strong>{{ $errors->first('account_type') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
            <h3>Date personale</h3>
            <hr>
            <div id="pers_fizica" @if(old('account_type') == 1) style="display:none;" @endif>
                <div class="form-group">
                    {!! Form::label('name','Nume :',['class'=>'col-sm-2 control-label']) !!}
                    <div class="col-sm-5">
                        {!! Form::text('name', null, ['class'=>'form-control', 'id'=>'name','placeholder'=>'']) !!}
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
                        {!! Form::text('phone', null, ['class'=>'form-control', 'id'=>'phone','placeholder'=>'']) !!}
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
                        {!! Form::text('cnp', null, ['class'=>'form-control', 'id'=>'cnp','placeholder'=>'']) !!}
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
                        {!! Form::text('region', null, ['class'=>'form-control', 'id'=>'region','placeholder'=>'']) !!}
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
                        {!! Form::text('city', null, ['class'=>'form-control', 'id'=>'city','placeholder'=>'']) !!}
                        @if ($errors->has('city'))
                            <span class="help-block">
                    <strong>{{ $errors->first('city') }}</strong>
                </span>
                        @endif
                    </div>
                </div>
            </div>
            <div id="pers_juridica" @if(old('account_type') == 0) style="display:none;" @endif>
                <div class="form-group">
                    {!! Form::label('company','Companie :',['class'=>'col-sm-2 control-label']) !!}
                    <div class="col-sm-5">
                        {!! Form::text('company', null, ['class'=>'form-control', 'id'=>'company','placeholder'=>'']) !!}
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
                        {!! Form::text('rc', null, ['class'=>'form-control', 'id'=>'rc','placeholder'=>'']) !!}
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
                        {!! Form::text('cif', null, ['class'=>'form-control', 'id'=>'cif','placeholder'=>'']) !!}
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
                        {!! Form::text('bank_account', null, ['class'=>'form-control', 'id'=>'bank_account','placeholder'=>'']) !!}
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
                        {!! Form::text('bank_name', null, ['class'=>'form-control', 'id'=>'bank_name','placeholder'=>'']) !!}
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
                    {!! Form::textarea('address', null, ['class'=>'form-control', 'id'=>'address','placeholder'=>'']) !!}
                    @if ($errors->has('address'))
                        <span class="help-block">
                    <strong>{{ $errors->first('address') }}</strong>
                </span>
                    @endif
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-6 col-md-offset-4">
                    <button type="submit" class="btn btn-primary">
                        Register
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
@section('footer-assets')
    <script>
        $(document).ready(function(){
            $("#cont").change(function(){
                switch( $("#cont").val() ){
                    case '0':    $("#pers_fizica").show();
                        $("#pers_juridica").hide();
                        break;
                    case '1':    $("#pers_fizica").hide();
                        $("#pers_juridica").show();
                        break;
                }
            });
            var type = $("#cont").val();
            if( type == 1){
                $("#pers_fizica").hide();
                $("#pers_juridica").show();
            }
        });
    </script>
@endsection