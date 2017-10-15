@extends('admin.layouts.master')
@section('section-title') Setari transport @endsection
@section('section-content')

    <a class="btn btn-primary btn-small" href="{{ url('admin/shop/transport/create') }}"><i class="fa fa-plus-circle"></i> Adauga un transport</a><hr>
    {!! Form::open(['method'=>'POST','url'=>'admin/shop/transport/updateOrder','class'=>'form-horizontal']) !!}
    <div class="table-responsive">
        <table class="table">
            <thead>
            <tr>
                <th>Nume transport</th>
                <th class='text-center'>Ordine</th>
                <th class='text-center'>Vizibil</th>
                <th colspan="2" class='text-center'>Actiuni</th>
            </tr>
            </thead>
            <tbody>
            @foreach($transport as $t)
                <tr>
                    <td>{{ $t->name }}</td>
                    <td class="text-center"><input type="text" name="orderId_{{ $t->id }}" class="numar" value="{{ $t->ordine }}"></td>
                    <td class='text-center'>@if($t->visible == 1) <span class='panelIcon visible'></span> @else <span class='panelIcon notVisible'></span> @endif</td>
                    <td class='text-center'><a data-toggle="tooltip" data-placement="top" href="{{ url('admin/shop/transport/'.$t->id.'/edit/') }}" class="panelIcon editItem" title='Editeaza'></a></td>
                    <td class='text-center'><a data-toggle="tooltip" data-placement="top" href="{{ url('admin/shop/transport/'.$t->id.'/delete') }}" class="panelIcon deleteItem" title='Sterge' onclick="return confirm('Sunteti sigur ca doriti sa stergeti?')"></a></td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    <div class="col-md-12">
        <button type="submit" class="btn btn-success"><i class="fa fa-list-ol"></i> Schimba ordinea</button>
    </div>
    {!! Form::close() !!}
@endsection