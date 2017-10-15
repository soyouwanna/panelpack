@extends('admin.layouts.master')
@section('section-title') Comanda #{{ $order->id }} @endsection
@section('section-content')
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h3 class="panel-title">Factura proforma</h3>
        </div>
        <div class="panel-body">
            <a class="btn btn-default" target="_blank" href="{{ url('cart/vizualizareProforma/'.$order->id.'/'.$proformaCode) }}">Vizualizati proforma</a>
            <button class="btn btn-primary pull-right" style="margin-right: 5px;"><i class="fa fa-download"></i> Generate PDF</button>
        </div>
    </div>
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h3 class="panel-title">Informatii despre comanda</h3>
        </div>
        <table class="table" id="orders">
            <tr><th>Data:</th><td>{{ date_format($order->created_at,'d/m/Y H:i') }}</td></tr>
            {!! Form::open(['method'=>'PUT','url'=>'admin/shop/orders/'.$order->id.'/updateStatus','class'=>'form-horizontal']) !!}
            <tr>
            <div class="form-group">
                <th>{!! Form::label('status','Status:',['class'=>'control-label','style'=>'padding:0;']) !!}</th>
                <td>
                    <div class="col-sm-5" style="padding:0;">
                        {!! Form::select('status',$selectStatus ,$order->status_id,['class'=>'form-control input-sm','id'=>'status']) !!}
                    </div>
                    <div class="col-sm-5">
                            {!! Form::submit('Schimba',['class' => 'btn btn-success btn-sm']) !!}
                    </div>
                </td>
            </div>
            </tr>
            {!! Form::close() !!}
            <tr><th>Tip transport:</th><td>{{ $order->transport->name }}</td></tr>
            {!! Form::open(['method'=>'PUT','url'=>'admin/shop/orders/'.$order->id.'/updateTransportPrice','class'=>'form-horizontal','style'=>'padding:0;']) !!}
            <tr>
                <div class="form-group">
                    <th>{!! Form::label('price_transport','Valoare transport:',['class'=>'control-label','style'=>'padding:0;']) !!}</th>
                    <td>
                    <div class="col-sm-2" style="padding:0;">
                        <div class="input-group">
                        {!! Form::text('price_transport', $order->price_transport, ['class'=>'form-control input-sm', 'id'=>'price-transport']) !!}
                            <div class="input-group-addon input-sm">{{ config('settings.magazin.currency') }}</div>
                        </div>
                    </div>
                        <div class="col-sm-5">
                            {!! Form::submit('Schimba',['class' => 'btn btn-success btn-sm']) !!}
                        </div>
                    </td>
                </div>
            </tr>
            {!! Form::close() !!}
            <tr><th>Valoare produse:</th><td>{{ $order->price.' '.config('settings.magazin.currency') }}</td></tr>
            <tr><th>Valoare TOTAL:</th><td>{{ $order->finalPrice().' '.config('settings.magazin.currency') }}</td></tr>
            <tr><th>Nr. produse comandate:</th><td>{{ $order->quantity }}</td></tr>
        </table>
        <div class="panel-body">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th>Produse comandate</th>
                        <th>Culoare</th>
                        <th>Marime</th>
                        <th>Buc.</th>
                        <th>Pret unitar</th>
                        <th>Pret total</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    {!! Form::open(['method'=>'POST','url'=>'admin/shop/orders/'.$order->id.'/updateQuantity/','class'=>'form-horizontal']) !!}

                    @foreach($order->items as $item)
                    <tr>
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->color }}</td>
                        <td>{{ $item->size }}</td>
                        {{--<td>{{ $item->quantity }}</td>--}}
                        <td><input type="text" class="form-control numarb input-sm" value="{{ $item->quantity }}" name="item_{{ $item->id }}"></td>
                        <td>{{ $item->price.' '.config('settings.magazin.currency') }}</td>
                        <td>{{ number_format($item->price * $item->quantity,2).' '.config('settings.magazin.currency') }}</td>
                        <td class="text-center"><a data-toggle="tooltip" data-placement="top" href="{{ url('/admin/shop/orders/'.$order->id.'/item/'.$item->id.'/delete/') }}" class="panelIcon deleteRedItem" title="Delete" onclick="return confirm('Sunteti sigur ca doriti sa stergeti?')"></a></td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
                <div class="col-sm-10">
                    {!! Form::submit('Schimba cantitatile',['class' => 'btn btn-success btn-sm']) !!}
                </div>
                {!! Form::close() !!}
            </div>
        </div>

        <div class="table-responsive">
            <table class="table">
                <thead>
                <tr>
                    <th class="success" colspan="2"><h5>Date identificare client</h5></th>
                </tr>
                </thead>
                <tfoot>
                <tr>
                    <td colspan="2">@if( !is_null($order->customer_id) )
                            <a class="btn btn-default btn-sm" href="{{ url('admin/shop/customers/'.$order->customer_id.'/edit') }}"><i class="fa fa-user"></i> Profil</a>
                            @else
                            Clientul nu are cont pe site.
                        @endif
                    </td>
                </tr>
                </tfoot>
                <tbody>
                <tr><th>Nume</th><td>{{ $order->customerName() }}</td></tr>
                <tr><th>Email</th><td>{{ $order->email }}</td></tr>
                @if( $order->account_type == 0 )
                    <tr><th>Telefon</th><td>{{ $order->phone }}</td></tr>
                    <tr><th>Judet</th><td>{{ $order->region }}</td></tr>
                    <tr><th>Oras</th><td>{{ $order->city }}</td></tr>
                    <tr><th>CNP</th><td>{{ $order->cnp }}</td></tr>
                    @else
                    <tr><th>Banca</th><td>{{ $order->bank_name }}</td></tr>
                    <tr><th>Cont bancar</th><td>{{ $order->bank_account }}</td></tr>
                    <tr><th>Nr. Reg. Com.</th><td>{{ $order->rc }}</td></tr>
                    <tr><th>CIF</th><td>{{ $order->cif }}</td></tr>
                @endif
                <tr><th>Adresa</th><td>{{ $order->address }}</td></tr>
                </tbody>
            </table>
        </div>
        <ul class="list-group">
            <li class="list-group-item active"><h3 class="panel-title">Date transport</h3></li>
            <li class="list-group-item ">Adresa de livrare:
                <?= ( empty($order->delivery_address) )?'Coincide cu adresa de facturare.':$order->delivery_address; ?>
            </li>
        </ul>
    </div>
@endsection