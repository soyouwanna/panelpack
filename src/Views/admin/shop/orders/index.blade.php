@extends('admin.layouts.master')
@section('footer-assets')
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
@section('section-title') Comenzi @endsection
@section('section-content')
<div class="x_panel">
    <div class="x_title">
        <h2><i class="fa fa-bars"></i> Filtre</h2>
        <ul class="nav navbar-right panel_toolbox">
            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
            </li>
        </ul>
        <div class="clearfix"></div>
    </div>
    <div class="x_content">
        {!! Form::open(['method'=>'POST','url'=>'admin/shop/ordersByStatus','class'=>'form-horizontal']) !!}

        <div class="form-group">
            {!! Form::label('status','Status :',['class'=>'col-sm-2 control-label']) !!}
            <div class="col-sm-5">
                {!! Form::select('status',$selectStatus ,session('status'),['class'=>'form-control','id'=>'status']) !!}
            </div>
        </div>
        <hr>
        <button type="submit" name="filter" value="1" class="btn btn-info btn-sm"><i class="fa fa-filter"></i> Filtreaza</button>
        @if( session()->has('status') )
            <button type="submit" name="deleteFilter" value="1" class="btn btn-warning btn-sm"><i class="fa fa-close"></i> Sterge filtrele</button>
        @endif
        {!! Form::close() !!}
    </div>
</div>
{!! Form::open(['method'=>'POST','url'=>'admin/shop/orders/deleteMultiple','class'=>'form-horizontal']) !!}
<div class="table-responsive">
    <table class="table">
        <thead>
        <tr>
            <th><input type="checkbox" id="all_records" class=""></th>
            <th>Id#</th>
            <th><?php $date = (request('date') == 'asc')?'desc':'asc'; ?>
                <a href="{{ url('admin/shop/orders?date='.$date) }}">Data
                    @if( request()->has('date'))
                    <i class="fa @if(request('date') == 'asc') fa-caret-down @else fa-caret-up @endif"></i>
                    @endif
                </a>
            </th>
            <th><?php $name = (request('name') == 'asc')?'desc':'asc'; ?>
                <a href="{{ url('admin/shop/orders?name='.$name) }}">Nume
                    @if( request()->has('name'))
                    <i class="fa @if(request('name') == 'asc') fa-caret-down @else fa-caret-up @endif"></i>
                    @endif
                </a>
            </th>
            <th><?php $name = (request('price') == 'asc')?'desc':'asc'; ?>
                <a href="{{ url('admin/shop/orders?price='.$name) }}">Suma
                    @if( request()->has('price'))
                        <i class="fa @if(request('price') == 'asc') fa-caret-down @else fa-caret-up @endif"></i>
                    @endif
                </a>
            </th>
            <th>Stare</th>
            <th colspan="2" class="text-center">Actiuni</th>
        </tr>
        </thead>
        <tbody>
        @foreach($orders as $order)
            <tr @if($order->read == 1) class="alert alert-info" @endif>
                <td><input type="checkbox" class="records" name="item[{{ $order->id }}]"></td>
                <td>{{ $order->id }}</td>
                <td>{{ date_format($order->created_at,'d/m/Y H:i') }}</td>
                <td>{{ $order->customerName() }}</td>
                <td>{{ $order->finalPrice() }} {{ config('settings.magazin.currency') }}</td>
                <td>{{ $order->status->name }}</td>
                <td class="text-center"><a data-toggle="tooltip" data-placement="top" href="{{ url('admin/shop/orders/'.$order->id.'/edit/') }}" class="panelIcon invoice" title="Detalii"></a></td>
                <td class="text-center"><a data-toggle="tooltip" data-placement="top" href="{{ url('admin/shop/orders/'.$order->id.'/delete/') }}" class="panelIcon deleteItem" title="Delete" onclick="return confirm('Sunteti sigur ca doriti sa stergeti?')"></a></td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
<button type="submit" name="deleteMultiple" class="btn btn-danger btn-sm" onclick="return confirm('Sunteti sigur ca doriti sa stergeti?')"><i class="fa fa-trash"></i> Delete</button>
{!! Form::close() !!}
{{ $orders->links() }}
{!! Form::open(['method'=>'POST','url'=>'admin/shop/orders/updateLimit','class'=>'form-inline pull-right']) !!}
    <div class="input-group">
        <span class="input-group-btn">
            <button type="submit" class="btn btn-primary btn-sm">Arata:</button>
        </span>
        {!! Form::number('perPage', $perPage, ['style'=>'max-width:60px;','class'=>'form-control input-sm','min'=>5]) !!}
    </div>
{!! Form::close() !!}
@endsection