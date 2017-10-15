@extends('admin.layouts.master')
@section('section-title') Setari factura @endsection
@section('section-content')

    {!! Form::open(['method'=>'PUT','url'=>'admin/shop/invoice/'.$invoice->id,'class'=>'form-horizontal']) !!}
    <div class="form-group">
        {!! Form::label('bank_name','Banca',['class'=>'col-sm-2 control-label']) !!}
        <div class="col-sm-5">
            {!! Form::text('bank_name', $invoice->bank_name, ['class'=>'form-control', 'id'=>'','placeholder'=>'']) !!}
        </div>
    </div>
    <div class="form-group">
        {!! Form::label('cif','CIF',['class'=>'col-sm-2 control-label']) !!}
        <div class="col-sm-5">
            {!! Form::text('cif', $invoice->cif, ['class'=>'form-control', 'id'=>'','placeholder'=>'']) !!}
        </div>
    </div>
    <div class="form-group">
        {!! Form::label('bank_account','Cont bancar',['class'=>'col-sm-2 control-label']) !!}
        <div class="col-sm-5">
            {!! Form::text('bank_account', $invoice->bank_account, ['class'=>'form-control', 'id'=>'','placeholder'=>'']) !!}
        </div>
    </div>
    <div class="form-group">
        {!! Form::label('company','Furnizor',['class'=>'col-sm-2 control-label']) !!}
        <div class="col-sm-5">
            {!! Form::text('company', $invoice->company, ['class'=>'form-control', 'id'=>'','placeholder'=>'']) !!}
        </div>
    </div>
    <div class="form-group">
        {!! Form::label('region','Judet',['class'=>'col-sm-2 control-label']) !!}
        <div class="col-sm-5">
            {!! Form::text('region', $invoice->region, ['class'=>'form-control', 'id'=>'','placeholder'=>'']) !!}
        </div>
    </div>
    <div class="form-group">
        {!! Form::label('city','Oras',['class'=>'col-sm-2 control-label']) !!}
        <div class="col-sm-5">
            {!! Form::text('city', $invoice->city, ['class'=>'form-control', 'id'=>'','placeholder'=>'']) !!}
        </div>
    </div>
    <div class="form-group">
        {!! Form::label('rc','Nr R.C.',['class'=>'col-sm-2 control-label']) !!}
        <div class="col-sm-5">
            {!! Form::text('rc', $invoice->rc, ['class'=>'form-control', 'id'=>'','placeholder'=>'']) !!}
        </div>
    </div>
    <div class="form-group">
        {!! Form::label('address','Sediu social',['class'=>'col-sm-2 control-label']) !!}
        <div class="col-sm-5">
            {!! Form::textarea('address', $invoice->address, ['class'=>'form-control','rows'=>3 ,'id'=>'','placeholder'=>'']) !!}
        </div>
    </div>
    <div class="form-group">
        {!! Form::label('serie','Serie factura',['class'=>'col-sm-2 control-label']) !!}
        <div class="col-sm-5">
            {!! Form::text('serie', $invoice->serie, ['class'=>'form-control', 'id'=>'','placeholder'=>'']) !!}
        </div>
    </div>
    <div class="form-group">
        {!! Form::label('tva','TVA',['class'=>'col-sm-2 control-label']) !!}
        <div class="col-sm-2">
            <div class="input-group">
            {!! Form::text('tva', $invoice->tva, ['class'=>'form-control numarb', 'id'=>'','placeholder'=>'']) !!}
                <div class="input-group-addon">&#37;</div>
            </div>
        </div>
    </div>
    <div class="col-sm-10 col-sm-offset-2">
        {!! Form::submit('Submit',['class' => 'btn btn-success']) !!}
    </div>
    {!! Form::close() !!}
@endsection