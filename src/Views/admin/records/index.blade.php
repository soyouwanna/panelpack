@extends('vendor.decoweb.admin.layouts.master')
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
            $("#all_records").change(function(){
                if(this.checked) {
                    $('.records').prop('checked', true);
                }else{
                    $('.records').prop('checked', false);
                }
            });
        });
    </script>
@endsection
@section('section-title') {{ $core->name }} @endsection
@section('section-content')
    @if($settings['config']['functionAdd'] == 1)
    <a class="btn btn-primary btn-small" href="{{ url('admin/core/'.$core->table_name.'/create') }}"><i class="fa fa-plus-circle"></i> {{ $settings['messages']['add'] }}</a><hr>
    @endif

    @if( !empty(array_filter($settings['filter'])) )
        {!! Form::open(['method'=>'POST','url'=>'admin/core/'.$core->table_name,'class'=>'form-horizontal']) !!}

        <div class="panel panel-default">
            <div class="panel-heading"><h4>Filtre</h4></div>
            <div class="panel-body">
        @foreach( $filters as $filter )
            @if( $filter['type'] == 'select')
                <div class="form-group">
                    {!! Form::label($filter['column'],$filter['name'],['class'=>'col-sm-2 control-label']) !!}
                    <div class="col-sm-5">
                        {!! Form::select($filter['column'],$filter['options'] ,session('filters.'.$core->table_name.'.'.$filter['column']),['class'=>'form-control','id'=>'']) !!}
                    </div>
                </div>
                @elseif( $filter['type'] == 'text')
                <div class="form-group">
                    {!! Form::label($filter['column'],$filter['name'],['class'=>'col-sm-2 control-label']) !!}
                    <div class="col-sm-5">
                        {!! Form::text($filter['column'], session('filters.'.$core->table_name.'.'.$filter['column']), ['class'=>'form-control', 'id'=>'','placeholder'=>'']) !!}
                    </div>
                </div>
            @endif
        @endforeach
            </div>
            <div class="panel-footer">
            <button type="submit" class="btn btn-info btn-sm"><i class="fa fa-filter"></i> Filtreaza</button>
                @if( session()->has('filters.'.$core->table_name) )
            <a href="{{ url('admin/core/'.$core->table_name.'/resetFilters') }}" class="btn btn-warning btn-sm"><i class="fa fa-close"></i> Sterge filtrele</a>
                @endif
            </div>
        </div>
        {!! Form::close() !!}
    @endif
    {{--{{ dd($settings) }}--}}
{!! Form::open(['method'=>'POST','route'=>['records.action',$core->table_name],'class'=>'form-horizontal']) !!}
<div class="table-responsive">
    <table class="table table-hover bulk_action">
        <thead>
        <tr>
            <th><input type="checkbox" id="all_records" class=""></th>
            <?php $dir = (request('dir') == 'asc')?'desc':'asc'; ?>
            <?php $caret = (request('dir') == 'asc')?'down':'up'; ?>
            <th><a href="{{ url('admin/core/'.$core->table_name.'/?order='.$settings['config']['displayedName'].'&dir='.$dir) }}">
                    {{ $settings['config']['displayedFriendlyName'] }}
                    @if(request('order') == $settings['config']['displayedName'] )<i class="fa fa-caret-{{ $caret }}"></i> @endif
                </a>
            </th>
            @if($settings['config']['functionSetOrder'] == 1)
            <th class='text-center'>
                <a href="{{ url('admin/core/'.$core->table_name.'/?order=order&dir='.$dir) }}">
                    Ordine
                    @if(request('order') == 'order' )<i class="fa fa-caret-{{ $caret }}"></i> @endif
                </a>
            </th>
            @endif
            @if($settings['config']['functionVisible'] == 1)
                <th class='text-center'>
                    <a href="{{ url('admin/core/'.$core->table_name.'/?order=visible&dir='.$dir) }}">
                        Vizibil
                        @if(request('order') == 'visible' )<i class="fa fa-caret-{{ $caret }}"></i> @endif
                    </a>
                </th>
            @endif
            <th colspan="{{ $spanActions }}" class='text-center'>Actiuni</th>
            @if($settings['config']['functionImages'] == 1)
            <th class='text-center'>Imagine</th>
            @endif
        </tr>
        </thead>
        <tbody>
            @foreach($tabela as $t)
            <tr>
                <td><input type="checkbox" class="records" name="item[{{ $t['id'] }}]"></td>
                <?php $name = $settings['config']['displayedName']; ?>
                <td>{{ $t[$name] }}</td>
                @if($settings['config']['functionSetOrder'] == 1)
                <td class="text-center"><input type="text" name="orderId[{{ $t['id'] }}]" class="numar" value="{{ $t['order'] }}"></td>
                @endif
                @if($settings['config']['functionVisible'] == 1)
                <td class='text-center'>@if($t['visible'] == 1) <span class='panelIcon visible'></span> @else <span class='panelIcon notVisible'></span> @endif</td>
                @endif
                @if($settings['config']['functionEdit'] == 1)
                <td class='text-center'><a data-toggle="tooltip" data-placement="top" href="{{ url('admin/core/'.$core->table_name.'/edit/'.$t['id']) }}" class="panelIcon editItem" title='Editeaza'></a></td>
                @endif
                @if($settings['config']['functionDelete'] == 1)
                <td class='text-center'><a data-toggle="tooltip" data-placement="top" href="{{ url('admin/core/'.$core->table_name.'/recordDelete/'.$t['id']) }}" class="panelIcon deleteItem" title='Sterge' onclick="return confirm('Sunteti sigur ca doriti sa stergeti?')"></a></td>
                @endif
                @if($settings['config']['functionFile'] == 1)
                    <td class='text-center'><a data-toggle="tooltip" data-placement="top" class='panelIcon pdf' href="{{ url('admin/core/'.$core->table_name.'/addFile/'.$t['id']) }}" title='Fisiere'></a></td>
                @endif
                @if($settings['config']['functionImages'] == 1)
                    <td class='text-center'><a data-toggle="tooltip" data-placement="top" class='panelIcon addImage' href="{{ url('admin/core/'.$core->table_name.'/addPic/'.$t['id']) }}" title='Imagini ({{ (isset($pics[$t['id']]))?count($pics[$t['id']]):0 }})'></a></td>
                    <td class='text-center'>
                        @if(isset($pics[$t['id']]) && count($pics[$t['id']]) > 0)
                            <img src="{{ url('images/xsmall/'.array_shift($pics[$t['id']])) }}" alt="">
                        @else
                            <span class='panelIcon noImage'></span>
                        @endif
                    </td>
                @else <td style="width:0; padding:8px 0;"></td> @endif
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<div class="col-sm-12">
    @if($settings['config']['functionSetOrder'] == 1)
    <button type="submit" name="changeOrder" class="btn btn-success btn-sm" value="1"><i class="fa fa-reorder"></i> Schimba ordinea</button>
    @endif
    @if($settings['config']['functionDelete'] == 1)
    <button type="submit" name="deleteItems" class="btn btn-danger btn-sm" value="1" onclick="return confirm('Sunteti sigur ca doriti sa stergeti?')"><i class="fa fa-trash"></i> Delete</button>
    @endif
</div>
{!! Form::close() !!}

    {{ $tabela->setPath(url('/admin/core/'.$core->table_name))->render() }}

    {!! Form::open(['method'=>'POST','url'=>'admin/core/limit/'.$core->id,'class'=>'form-inline pull-right']) !!}
    <div class="input-group">
        <span class="input-group-btn">
            <button type="submit" class="btn btn-primary btn-sm">Arata:</button>
        </span>
        {!! Form::number('perPage', $settings['config']['limitPerPage'], ['style'=>'max-width:60px;','class'=>'form-control input-sm','min'=>5]) !!}
    </div>
    {!! Form::close() !!}
@endsection