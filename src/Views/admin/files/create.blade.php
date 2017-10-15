@extends('admin.layouts.master')
@section('section-title')
    <a href="{{ url('admin/core/'.$tabela) }}">{{ $pageName }}</a> / {{ $record->$name }}
@endsection
@section('section-content')

    {!! Form::open(['method'=>'POST','files'=>true, 'route'=>['store.file', $tabela, $record->id ],'class'=>'form-horizontal']) !!}
    <div class="form-group">
        {!! Form::label('title','Nume fisier:',['class'=>'col-sm-2 control-label']) !!}
        <div class="col-sm-5">
            {!! Form::text('title', null, ['class'=>'form-control', 'id'=>'title','placeholder'=>'(maxim 50 de caractere)']) !!}
        </div>
    </div>
    <div class="form-group">
        {!! Form::label('file', 'Alege un fisier:', ['class'=>'col-sm-2 control-label']) !!}
        <div class="col-sm-5">
            {!! Form::file('file',['class'=>'form-control']) !!}
        </div>
    </div>
    <div class="col-sm-10 col-sm-offset-2">
        {!! Form::submit('Adauga fisier',['class' => 'btn btn-primary btn-sm']) !!}
        <a class="btn btn-default btn-sm" href="{{ url('admin/core/'.$tabela) }}">Renunta</a>
        <button class="btn btn-default btn-sm" type="reset" value="Reset">Reset</button>
    </div>
    {!! Form::close() !!}
    <span style="display: block; height: 40px;"></span>
    @if($files->count() != 0)
        {!! Form::open(['method'=>'POST','route'=>['update.filesOrder', $idTabela, $record->id],'class'=>'form-horizontal']) !!}
        <div class="table-responsive">
            <table class="table">
                <thead>
                <tr>
                    <th>Fisier</th>
                    <th>Nume</th>
                    <th class="text-center">Ordine</th>
                    <th class="text-center">Actiuni</th>
                </tr>
                </thead>
                <tbody>
                @foreach($files as $file)
                    <tr>
                        <td style="width: 136px;">
                            <a target="_blank" href="{{ asset('files/'.$file->name) }}" class="btn btn-info btn-sm">{{ $file->title }}</a>
                        </td>
                        <td>
                            {!! Form::text('title_'.$file->id, $file->title, ['class'=>'form-control input-sm']) !!}
                        </td>
                        <td class="text-center">
                            {!! Form::text('ordine_'.$file->id, $file->ordine, ['class'=>'numar']) !!}
                        </td>
                        <td class='text-center'>
                            <a data-toggle="tooltip" style="" data-placement="top" href="{{ url('admin/core/deleteFile/'.$file->id) }}" class="panelIcon deleteItem" title='Sterge' onclick="return confirm('Sunteti sigur ca doriti sa stergeti?')"></a>
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
        {{ $noFiles }}
    @endif
    <hr>
    <a href="{{ url('admin/core/'.$tabela) }}" class="btn btn-default">Inapoi la listare</a>
    <a href="{{ url('admin/core/'.$tabela.'/edit/'.$record->id) }}" class="btn btn-default">Inapoi la editare</a>
@endsection