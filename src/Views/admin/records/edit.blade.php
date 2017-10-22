@extends('vendor.decoweb.admin.layouts.master')
@section('section-title')
    {{ $fields['config']['pageName'] }}
@endsection
@section('section-content')
    {!! Form::model($record, [
            'route' => ['record.update', $fields['config']['tableName'] ,$record->id],
            'method' => 'put',
            'class'=>'form-horizontal'
            ])
    !!}
<fieldset>
    <legend>{{ $fields['messages']['edit'] }}</legend>
    @foreach($fields['elements'] as $name=>$field)
        <?php
            $required = ( $field['required'] == '')?'':"*";
            $id = $name;
            $type = $field['type'];
            $default = null;
            if($field['type'] == 'editor'){
                if(!defined('EDITOR')){
                    define('EDITOR',true);
                }
                $type = 'textarea';
                $id = "my-editor";
            }

            if($field['type'] == 'checkbox'){
                $colType = explode('|',$field['colType']);
                $value = ($colType[0] == 'enum')?'da':1;
                $checked = ($record->$name == $value)? true : false ;
            }
        ?>

        @if($field['type'] == 'checkbox')
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <div class="checkbox">
                        <label>
            {!!  Form::checkbox($name, null, $checked).' '.$field['friendlyName'].' '.$required  !!}
                        </label>
                    </div>
                </div>
            </div>
        @elseif($field['type'] == 'select')
                <div class="form-group">
                    {!! Form::label('',$field['friendlyName'].' '.$required,['class'=>'col-sm-2 control-label']) !!}
                    <div class="col-sm-5">
                        {!! Form::select($name,$field['options'] ,null,['class'=>'form-control']) !!}
                    </div>
                </div>
        @else
            <div class="form-group">
                {{ Form::label($id, $field['friendlyName'].' '.$required,['class'=>'col-sm-2 control-label']) }}
                <div class="col-sm-10">
                    {{ Form::$type($name, $default, ['class'=>'form-control', 'id'=>"$id",'placeholder'=>'']) }}
                </div>
            </div>
        @endif
    @endforeach
    @if($fields['config']['functionVisible'] == 1)
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <div class="checkbox">
                    <label>
                        <?php $checked = ($record->visible == 1)? true : false ; ?>
                        {!!  Form::checkbox('visible', null, $checked).' '.'Vizibil' !!}
                    </label>
                </div>
            </div>
        </div>
    @endif
    <div class="col-sm-10 col-sm-offset-2">
        {!! Form::submit('Submit',['class' => 'btn btn-success btn-sm']) !!}
    </div>
</fieldset>
    {!! Form::close() !!}

@endsection