@extends('vendor.decoweb.admin.layouts.master')
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
@section('section-title') Utilizatori @endsection
@section('section-content')
    <a class="btn btn-primary btn-small" href="{{ url('admin/shop/customers/create') }}"><i class="fa fa-plus-circle"></i> Adauga un user</a>
    <br>
    <br>
    {!! Form::open(['method'=>'POST','url'=>'admin/shop/customers/deleteMultiple','class'=>'form-horizontal']) !!}
    <div class="table-responsive">
        <table class="table">
            <thead>
            <tr>
                <th><input type="checkbox" id="all_records" class=""></th>
                <th class="text-center">#</th>
                <?php
                $name = (request('name') == 'asc')?'desc':'asc';
                $caretName = (request('name') == 'asc')?'down':'up';
                ?>
                <th><a href="{{ url('admin/shop/customers/?name='.$name) }}">Email @if( request('name') )<i class="fa fa-caret-{{ $caretName }}"></i>@endif</a></th>
                <?php
                $active = (request('active') == 'asc')?'desc':'asc';
                $caretActive = (request('active') == 'asc')?'down':'up';
                ?>
                <th class="text-center"><a href="{{ url('admin/shop/customers/?active='.$active) }}">Activ @if( request('active') )<i class="fa fa-caret-{{ $caretActive }}"></i>@endif</a></th>
                <th colspan="2" class="text-center">Actiuni</th>
            </tr>
            </thead>
            <tbody>
            <?php $counter=0; ?>
            @foreach($customers as $customer)
                <tr>
                    <td><input type="checkbox" class="records" name="item[{{ $customer->id }}]"></td>
                    <th class="text-center">{{ $customers->perPage()*($customers->currentPage()-1)+(++$counter) }}</th>
                    <td>
                        @if( empty(trim($customer->email)) )
                        {{ $customer->name }}
                        @else
                        {{ $customer->email }}
                        @endif
                    </td>
                    <td class="text-center">@if($customer->verified == 1) <span class='panelIcon visible'></span> @else <span class='panelIcon notVisible'></span> @endif</td>
                    <td class="text-center"><a data-toggle="tooltip" data-placement="top" href="{{ url('admin/shop/customers/'.$customer->id.'/edit/') }}" class="panelIcon editItem" title='Editeaza'></a></td>
                    <td class="text-center"><a data-toggle="tooltip" data-placement="top" href="{{ url('admin/shop/customers/'.$customer->id.'/delete') }}" class="panelIcon deleteItem" title='Sterge' onclick="return confirm('Sunteti sigur ca doriti sa stergeti?')"></a></td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    <button type="submit" name="deleteMultiple" class="btn btn-danger btn-sm" onclick="return confirm('Sunteti sigur ca doriti sa stergeti?')"><i class="fa fa-trash"></i> Delete</button>
    {!! Form::close() !!}
    {{ $customers->links() }}
    {!! Form::open(['method'=>'POST','url'=>'admin/shop/customers/updateLimit','class'=>'form-inline pull-right']) !!}
    <div class="input-group">
        <span class="input-group-btn">
            <button type="submit" class="btn btn-primary btn-sm">Arata:</button>
        </span>
        {!! Form::number('perPage', $perPage, ['style'=>'max-width:60px;','class'=>'form-control input-sm','min'=>5]) !!}
    </div>
    {!! Form::close() !!}
@endsection
