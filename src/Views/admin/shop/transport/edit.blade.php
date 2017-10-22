@extends('vendor.decoweb.admin.layouts.master')
@section('section-title') Setari transport @endsection
@section('section-content')
    {!! Form::open(['method'=>'PUT','url'=>'admin/shop/transport/'.$transport->id,'class'=>'form-horizontal']) !!}
    <fieldset>
        <legend>Editeaza transportul</legend>
        <div class="form-group">
            {!! Form::label('name','Nume transport:',['class'=>'col-sm-2 control-label']) !!}
            <div class="col-sm-5">
                {!! Form::text('name', $transport->name, ['class'=>'form-control', 'id'=>'','placeholder'=>'']) !!}
            </div>
        </div>
        <div class="form-group">
            {!! Form::label('price','Pret:',['class'=>'col-sm-2 control-label']) !!}
            <div class="col-sm-5">
                {!! Form::text('price', $transport->price, ['class'=>'form-control', 'id'=>'','placeholder'=>'']) !!}
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <div class="checkbox">
                    <label>
                        <?php $checked = ($transport->visible == 1)? true : false ; ?>
                        {!!  Form::checkbox('visible', null, $checked).' '.'Vizibil' !!}
                    </label>
                </div>
            </div>
        </div>
        <div class="col-sm-10 col-sm-offset-2">
            {!! Form::submit('Salveaza',['class' => 'btn btn-success']) !!}
            <a href="{{ url('admin/shop/transport') }}" class="btn btn-default">Inapoi la listare</a>
        </div>
    </fieldset>
    {!! Form::close() !!}
@endsection