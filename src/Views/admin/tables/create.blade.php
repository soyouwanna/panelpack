@extends('admin.layouts.master')
@section('section-title') Setari tabela @endsection
@section('footer-assets')
<script>
    $(document).ready(function(){

        $( "select[id^='tip_']" ).change(function() {
            var id = '';
            id += $( this ).attr('id');
            var counter = id.replace(/tip_/,'');

            var sel = 'select_';
            var txt = 'text_';
            var select = sel.concat(counter);
            var text = txt.concat(counter);
            switch( $("#" + id + " option:selected").text() ){
                case 'select':
                    $("#" + select).css('display','block');
                    $("#" + text).css('display','none');
                    break;
                case 'text':
                    $("#" + select).css('display','none');
                    $("#" + text).css('display','block');
                    break;
                default:
                    $("#" + text).css('display','none');
                    $("#" + select).css('display','none');
            }
        });

        var table;
        $('#tableName').change( function(){
            if (typeof table !== 'undefined') {
                $(".selectTable option[value='" + table + "']").remove();
            }

            table = $('#tableName').val();
            $('.selectTable').prepend($('<option>', {
                value: table,
                text: table
            }));

        });
        $("#myTable").tableDnD();
    });
</script>
@endsection
@section('section-content')
    @if(session()->has('mesaj'))
        <div class="alert alert-success text-center" role="alert">
            {{ session()->get('mesaj') }}
        </div>
    @endif
    <?php
        if(isset($_GET['coloane']) && !empty($_GET['coloane']) && is_numeric($_GET['coloane'])){
            $coloane = (int)$_GET['coloane'];
        }else{
            $coloane = 1;
        }
    ?>
{!! Form::open(['method'=>'POST','url'=>'admin/table-settings/table','class'=>'form-horizontal']) !!}
<table id="myTable" class="table">
    <tbody>
        <tr class="nodrop nodrag"><th colspan="2" class="active">Setari afisare</th></tr>
    <tr class="nodrop nodrag"><td>Nume tabela</td><td><input type="text" name="tableName" id="tableName"></td></tr>
    <tr class="nodrop nodrag"><td>Nume pagina</td><td><input type="text" name="pageName"></td></tr>
    <tr class="nodrop nodrag"><td>Model</td><td><input type="text" name="model"></td></tr>
    <tr class="nodrop nodrag"><td>Nume afisat</td><td><input type="text" name="displayedName" value="name"></td></tr>
    <tr class="nodrop nodrag"><td>Nume friendly afisat</td><td><input type="text" name="displayedFriendlyName" value="Nume"></td></tr>
    <tr class="nodrop nodrag"><td>Limita pe pagina</td><td><input type="number" name="limitPerPage" value="10"></td></tr>
        <tr class="nodrop nodrag"><th colspan="2" class="active">Functii</th></tr>
    <tr class="nodrop nodrag"><td>Adaugare</td><td><input type="checkbox" name="functionAdd" checked="checked" value="1"></td></tr>
    <tr class="nodrop nodrag"><td>Editare</td><td><input type="checkbox" name="functionEdit" checked="checked" value="1"></td></tr>
    <tr class="nodrop nodrag"><td>Stergere</td><td><input type="checkbox" name="functionDelete" checked="checked" value="1"></td></tr>
    <tr class="nodrop nodrag"><td>Seteaza ordinea</td><td><input type="checkbox" name="functionSetOrder" checked="checked" value="1"></td></tr>
    <tr class="nodrop nodrag"><td>Imagini</td>
        <td><div class="col_1"><input type="checkbox" name="functionImages" value="1"></div>
            <div class="col_2">Maxim: <input class="numar" type="number" name="imagesMax"></div>
        </td>
    </tr>
    <tr class="nodrop nodrag"><td>Fisiere</td>
        <td><div class="col_1"><input type="checkbox" name="functionFile" value="1"></div>
            <div class="col_2">Maxim: <input class="numar" type="number" name="filesMax"></div>
            <div class="col_2">Extensii permise: <input type="text" name="filesExt" value="pdf"></div>
        </td>
    </tr>
    <tr class="nodrop nodrag"><td>Vizibil pe site</td><td><input type="checkbox" name="functionVisible" checked="checked" value="1"></td></tr>
    <tr class="nodrop nodrag"><td>Creaza tabela</td><td><input type="checkbox" name="functionCreateTable" checked="checked" value="1"></td></tr>
    <tr class="nodrop nodrag"><td>Recursiv</td>
        <td><div class="col_1"><input type="checkbox" name="functionRecursive" value="1"></div>
            <div class="col_2">Nivel maxim: <input type="number" name="recursiveMax"></div>
        </td>
    </tr>
        <tr class="nodrop nodrag"><th colspan="2" class="active">Mesaje</th></tr>
    <tr class="nodrop nodrag"><td>Adauga</td><td><input class="form-control input-sm" type="text" name="add" value="Adauga un element"></td></tr>
    <tr class="nodrop nodrag"><td>Editeaza</td><td><input class="form-control input-sm" type="text" name="edit" value="Editeaza elementul"></td></tr>
    <tr class="nodrop nodrag"><td>Nu sunt imagini</td><td><input class="form-control input-sm" type="text" name="no_images" value="Nu exista poze pentru acest element"></td></tr>
    <tr class="nodrop nodrag"><td>Nu sunt fisiere</td><td><input class="form-control input-sm" type="text" name="no_files" value="Nu exista fisiere pentru acest element"></td></tr>
    <tr class="nodrop nodrag"><td>A fost adaugat</td><td><input class="form-control input-sm" type="text" name="added" value="Elementul a fost adaugat cu succes"></td></tr>
    <tr class="nodrop nodrag"><td>A fost sters</td><td><input class="form-control input-sm" type="text" name="deleted" value="Elementul a fost sters cu succes"></td></tr>
        <tr class="nodrop nodrag"><th colspan="2" class="active">Filtre</th></tr>
    <tr class="nodrop nodrag"><td>Numele campurilor din tabel separate cu "," (virgula)</td><td><input class="form-control input-sm" type="text" name="filter"></td></tr>
        <tr class="nodrop nodrag"><th colspan="2" class="active">Coloane</th></tr>

    <?php $count=0; ?>
    @for($i = $coloane; $i>0; $i--)
    <tr>
        <td style="width:40%;">
            <div class="form-group">
                <label for="friendlyName_{{ $count }}" class="col-md-4 control-label">Nume friendly</label>
                <div class="col-md-8">
                    <input type="text" class="form-control" name="elements[{{ $count }}][friendlyName]" id="friendlyName_{{ $count }}" placeholder="">
                </div>
            </div>
            <div class="form-group">
                <label for="dbName_{{ $count }}" class="col-md-4 control-label">Nume DB</label>
                <div class="col-md-8">
                <input type="text" class="form-control" name="elements[{{ $count }}][databaseName]" id="dbName_{{ $count }}" placeholder="">
                </div>
            </div>
            {{--<div class="form-group">
                <label for="tip_{{ $count }}" class="col-md-4 control-label">Tip</label>
                <div class="col-md-8">
                    <select class="form-control" id="tip_{{ $count }}" name="elements[{{ $count }}][type]">
                        <option selected="selected">text</option>
                        <option>textarea</option>
                        <option>editor</option>
                        <option>select</option>
                        <option>checkbox</option>
                        <option>calendar</option>
                    </select>

                </div>
            </div>--}}
            <div class="form-group">
                {!! Form::label('tip_'.$count,'Tip:',['class'=>'col-sm-4 control-label']) !!}
                <div class="col-md-8">
                    {!! Form::select("elements[$count][type]",$types,null,['class'=>'form-control','id'=>'tip_'.$count]) !!}
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-4 control-label">Obligatoriu</label>
                <div class="radio col-md-8">
                    <label class="radio-inline">{!! Form::radio("elements[$count][required]", 0) !!} Nu</label>
                    <label class="radio-inline">{!! Form::radio("elements[$count][required]", 1,true) !!} Da</label>
                </div>
            </div>
            <div class="form-group">
                <label for="colType_{{ $count }}" class="col-md-4 control-label">Tip coloana</label>
                <div class="col-md-8">
                    <input type="text" class="form-control" name="elements[{{ $count }}][colType]" id="colType_{{ $count }}" placeholder="">
                </div>
            </div>
        </td>
        <td>
            <div class="form-group">
                <div class="col-md-6" id="text_{{ $count }}" >
                    <label class="checkbox-inline">
                        <input type="checkbox" name="elements[{{ $count }}][readonly]" id="text_{{ $count }}" value="1"> Readonly
                    </label>
                </div>
            </div>
            <span id="select_{{ $count }}" style="display:none;">
                <div class="form-group">
                    <div class="col-md-8 col-md-offset-3 checkbox">
                        <label class="checkbox-inline">
                            <input type="checkbox" name="elements[{{ $count }}][selectMultiple]" value="1"> Multiplu
                        </label>
                    </div>
                </div>
                <div class="form-group">
                        {!! Form::label('','Prima valoare:',['class'=>'col-md-3 control-label']) !!}
                    <div class="col-md-8">
                        {!! Form::text("elements[$count][selectFirstEntry]", null, ['class'=>'form-control', 'id'=>'','placeholder'=>'']) !!}
                    </div>
                </div>
                <div class="form-group">
                    {!! Form::label('','Din tabelul:',['class'=>'col-sm-3 control-label']) !!}
                    <div class="col-sm-8">
                    {!! Form::select("elements[$count][selectTable]",$tabele ,null,['class'=>'form-control selectTable']) !!}
                    </div>
                </div>
                <div class="form-group">
                        {!! Form::label('','Valori fixe:',['class'=>'col-md-3 control-label']) !!}
                    <div class="col-md-8">
                        {!! Form::textarea("elements[$count][selectExtra]", null, ['class'=>'form-control', 'id'=>'','rows'=>2]) !!}
                    </div>
                </div>
            </span>

        </td>
    </tr>
        <?php $count++; ?>
    @endfor
    </tbody>
</table>
<div class="col-sm-12">
    {!! Form::submit('Submit',['class' => 'btn btn-success btn-sm']) !!}
</div>
{!! Form::close() !!}


@endsection