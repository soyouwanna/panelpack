@extends('admin.layouts.master')
@section('header-assets')
    <!-- iCheck -->
    <link href="{{ asset('assets/admin/vendors/iCheck/skins/flat/green.css') }}" rel="stylesheet">
    <!-- Datatables -->
    <link href="{{ asset('assets/admin/vendors/datatables.net-bs/css/dataTables.bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/admin/vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/admin/vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/admin/vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/admin/vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css') }}" rel="stylesheet">
@endsection
@section('footer-assets')
    <!-- iCheck -->
    <script src="{{ asset('assets/admin/vendors/iCheck/icheck.min.js') }}"></script>
    <!-- Datatables -->
    <script src="{{ asset('assets/admin/vendors/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/admin/vendors/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/admin/vendors/datatables.net-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('assets/admin/vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/admin/vendors/datatables.net-buttons/js/buttons.flash.min.js') }}"></script>
    <script src="{{ asset('assets/admin/vendors/datatables.net-buttons/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('assets/admin/vendors/datatables.net-buttons/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('assets/admin/vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js') }}"></script>
    <script src="{{ asset('assets/admin/vendors/datatables.net-keytable/js/dataTables.keyTable.min.js') }}"></script>
    <script src="{{ asset('assets/admin/vendors/datatables.net-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('assets/admin/vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js') }}"></script>
    <script src="{{ asset('assets/admin/vendors/datatables.net-scroller/js/datatables.scroller.min.js') }}"></script>
    <script src="{{ asset('assets/admin/vendors/jszip/dist/jszip.min.js') }}"></script>
    <script src="{{ asset('assets/admin/vendors/pdfmake/build/pdfmake.min.js') }}"></script>
    <script src="{{ asset('assets/admin/vendors/pdfmake/build/vfs_fonts.js') }}"></script>
    <!-- Datatables -->
    <script>

        $(document).ready(function(){
            $("#all_tables").change(function(){
                if(this.checked) {
                    $('.tables').prop('checked', true);
                }else{
                    $('.tables').prop('checked', false);
                }
            });
        });
    </script>
@endsection
@section('section-title') Tabele @endsection
@section('section-content')
    {!! Form::open(['method'=>'GET','url'=>'admin/table-settings/create','class'=>'form-horizontal']) !!}
    <div class="form-group">
        {!! Form::label('coloane','Numar coloane:',['class'=>'col-sm-2 control-label']) !!}
        <div class="col-sm-5">
            {!! Form::number('coloane', null, ['class'=>'form-control', 'id'=>'coloane','min'=>'1']) !!}
        </div>
    </div>
    <div class="col-sm-12">
        {!! Form::submit('Tabela noua',['class' => 'btn btn-success btn-sm']) !!}
    </div>
    {!! Form::close() !!}

    {!! Form::open(['method'=>'POST','url'=>url('admin/table-settings/tablesOrder'),'class'=>'form-horizontal']) !!}
    <table class="table table-hover bulk_action">
        <thead>
        <tr>
            <th><input type="checkbox" id="all_tables" class=""></th>
            <th>Nume</th>
            <th class='text-center'>Ordine</th>
            <th class='text-center'>Vizibil</th>
            <th colspan="2" class='text-center'>Actiuni</th>
        </tr>
        </thead>
        <tbody>
        @foreach($tabele as $tabela)
            <tr>
                <td><input type="checkbox" class="tables" name="item[{{ $tabela->id }}]"></td>
                <td>{{ $tabela->name }}</td>
                <td class='text-center'><input type="text" name="order_{{ $tabela->id }}" class="text-center numar" value="{{ $tabela->order }}"></td>
                <td class='text-center'>@if($tabela->visible == 1) <span class='panelIcon visible'></span> @else <span class='panelIcon notVisible'></span> @endif</td>
                <td class='text-center'><a data-toggle="tooltip" data-placement="top" href="{{ route('tables.edit',['id'=>$tabela->id]) }}" class="panelIcon editItem" title='Editeaza'></a></td>
                <td class='text-center'><a data-toggle="tooltip" data-placement="top" href="{{ url('admin/table-settings/tableDelete/'.$tabela->id) }}" class="panelIcon deleteItem" title='Sterge' onclick="return confirm('Sunteti sigur ca doriti sa stergeti?')"></a></td>
            </tr>
        @endforeach

        </tbody>
    </table>
    <div class="col-sm-12">
        {!! Form::submit('Schimba ordinea',['class' => 'btn btn-success btn-sm']) !!}
    </div>
    {!! Form::close() !!}

@endsection