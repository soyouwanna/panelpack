@extends('vendor.decoweb.admin.layouts.master')
@section('section-title') Status comenzi @endsection
@section('section-content')
    {!! Form::open(['method'=>'PUT','url'=>'admin/shop/statuses/'.$status->id,'class'=>'form-horizontal']) !!}
    <div class="form-group">
        {!! Form::label('name','Nume :',['class'=>'col-sm-2 control-label']) !!}
        <div class="col-sm-5">
            {!! Form::text('name', $status->name, ['class'=>'form-control', 'id'=>'','placeholder'=>'']) !!}
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <div class="checkbox">
                <label>
                    <?php $checked = ( $status->visible != 1 )?:'checked'; ?>
                    <input type="checkbox" value="1" name="visible" {{ $checked }}> Vizibil
                </label>
            </div>
        </div>
    </div>
    <div class="col-sm-10 col-sm-offset-2">
        {!! Form::submit('Submit',['class' => 'btn btn-success']) !!}
        <a href="{{ url('admin/shop/statuses') }}" class="btn btn-default">Inapoi la listare</a>
    </div>
    {!! Form::close() !!}
@endsection