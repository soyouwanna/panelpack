@extends('admin.layouts.master')
@section('section-title')
    <a href="{{ url('admin/core/'.$tabela) }}">{{ $pageName }}</a> / {{ $record->$name }}
@endsection
@section('section-content')

    {!! Form::open(['method'=>'POST','files'=>true, 'route'=>['store.pic', $tabela, $record->id ],'class'=>'form-horizontal']) !!}
    <div class="form-group">
        {!! Form::label('description','Titlu poza:',['class'=>'col-sm-2 control-label']) !!}
        <div class="col-sm-5">
            {!! Form::textarea('description', null, ['class'=>'form-control textarea-small', 'id'=>'description','placeholder'=>'(maxim 50 de caractere)']) !!}
        </div>
    </div>
    <div class="form-group">
        {!! Form::label('pic', 'Alege o poza:', ['class'=>'col-sm-2 control-label']) !!}
        <div class="col-sm-5">
            {!! Form::file('pic',['class'=>'form-control']) !!}
        </div>
    </div>
    <div class="col-sm-10 col-sm-offset-2">
        {!! Form::submit('Adauga poza',['class' => 'btn btn-primary btn-sm']) !!}
        <a class="btn btn-default btn-sm" href="{{ url('admin/core/'.$tabela) }}">Renunta</a>
        <button class="btn btn-default btn-sm" type="reset" value="Reset">Reset</button>
    </div>
    {!! Form::close() !!}
    <span style="display: block; height: 40px;"></span>
    @if($poze->count() != 0)
    {!! Form::open(['method'=>'POST','route'=>['update.picsOrder', $idTabela, $record->id],'class'=>'form-horizontal']) !!}
<div class="table-responsive">
    <table class="table">
        <thead>
        <tr>
            <th>Imagine</th>
            <th>Titlu</th>
            <th class="text-center">Ordine</th>
            <th class="text-center">Actiuni</th>
        </tr>
        </thead>
        <tbody>
    @foreach($poze as $poza)
        <tr>
            <td style="width: 136px;">
                <img src="{{ url('images/small/'.$poza->name) }}" alt="{{ str_limit($poza->description, 50) }}" title="{{ str_limit($poza->description, 50) }}" data-toggle="tooltip" data-placement="right">
            </td>
            <td>
                {!! Form::textarea('description_'.$poza->id, $poza->description, ['class'=>'form-control textarea-small']) !!}
            </td>
            <td class="text-center">
                {!! Form::text('ordine_'.$poza->id, $poza->ordine, ['class'=>'numar margin-top-34']) !!}
            </td>
            <td class='text-center'>
                <a data-toggle="tooltip" style="margin-top: 35px;" data-placement="top" href="{{ url('admin/core/deletePic/'.$poza->id) }}" class="panelIcon deleteItem" title='Sterge' onclick="return confirm('Sunteti sigur ca doriti sa stergeti?')"></a>
            </td>
        </tr>
    @endforeach
        </tbody>
    </table>
</div>
    <div class="col-sm-12">
        {!! Form::submit('Modifica',['class' => 'btn btn-success btn-sm']) !!}
    </div>
    {!! Form::close() !!}
    @else
        {{ $noImages }}
    @endif
    <hr>
    <a href="{{ url('admin/core/'.$tabela) }}" class="btn btn-default">Inapoi la listare</a>
    <a href="{{ url('admin/core/'.$tabela.'/edit/'.$record->id) }}" class="btn btn-default">Inapoi la editare</a>
@endsection