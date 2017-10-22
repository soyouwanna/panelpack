@extends('vendor.decoweb.admin.layouts.master')
@section('section-title') Google Map @endsection
@section('section-content')
    <style>
        #map {
            height: 600px;
            width: 800px;
            display: block;
        }
    </style>
    <div>
        <h5>Instructiuni de folosire:</h5>
        <ol type="1">
            <li>Pozitionati mouse-ul pe locatia exacta a sediului firmei.</li>
            <li>Click dreapta pe harta (va aparea un simbol ce indica locatia firmei).</li>
            <li> Apasati butonul de mai jos pentru a salva locatia.</li>
        </ol>
    </div>
    <div id="map"></div>
    
    <hr>
    
    {!! Form::open(['method'=>'POST','url'=>'admin/maps/update','class'=>'form-horizontal']) !!}
    
        <div class="form-group">
            {!! Form::label('latitude','Latitudine:',['class'=>'col-sm-2 control-label']) !!}
            <div class="col-sm-5">
                {!! Form::text('latitude',$map->latitude, ['class'=>'form-control', 'id'=>'latitude']) !!}
            </div>
        </div>
    
        <div class="form-group">
            {!! Form::label('longitude','Longitudine:',['class'=>'col-sm-2 control-label']) !!}
            <div class="col-sm-5">
                {!! Form::text('longitude', $map->longitude, ['class'=>'form-control', 'id'=>'longitude']) !!}
            </div>
        </div>

        <div class="form-group">
            {!! Form::label('company','Companie:',['class'=>'col-sm-2 control-label']) !!}
            <div class="col-sm-5">
                {!! Form::text('company', $map->company, ['class'=>'form-control', 'id'=>'company']) !!}
            </div>
        </div>

        <div class="form-group">
            {!! Form::label('region','Judet:',['class'=>'col-sm-2 control-label']) !!}
            <div class="col-sm-5">
                {!! Form::text('region', $map->region, ['class'=>'form-control', 'id'=>'region','placeholder'=>'']) !!}
            </div>
        </div>

        <div class="form-group">
            {!! Form::label('city','Oras:',['class'=>'col-sm-2 control-label']) !!}
            <div class="col-sm-5">
                {!! Form::text('city', $map->city, ['class'=>'form-control', 'id'=>'city','placeholder'=>'']) !!}
            </div>
        </div>

        <div class="form-group">
            {!! Form::label('address','Adresa:',['class'=>'col-sm-2 control-label']) !!}
            <div class="col-sm-5">
                {!! Form::text('address', $map->address, ['class'=>'form-control', 'id'=>'address','placeholder'=>'']) !!}
            </div>
        </div>

        <div class="col-sm-10 col-sm-offset-2">
            {!! Form::submit('Submit',['class' => 'btn btn-success']) !!}
        </div>
    {!! Form::close() !!}

    <script>
        function initMap() {
            var myLatlng = {lat: {{ $map->latitude }}, lng: {{ $map->longitude }}};
            var infowindow = new google.maps.InfoWindow();
            var map = new google.maps.Map(document.getElementById('map'), {
                zoom: 16,
                mapTypeId: google.maps.MapTypeId.ROADMAP,
                center: myLatlng
            });

            var marker = new google.maps.Marker({
                position: myLatlng,
                map: map
            });

            contentString = "<b style='font-size: 12px;'>Companie: {{ $map->company }}</b>";
            contentString += "<br/><b style='font-size: 12px;'>Judet:</b><span  style='font-size: 12px;'> {{ $map->region }}</span><br/><b style='font-size: 12px;'>Oras:</b> <span  style='font-size: 12px;'>{{ $map->city }}</span><br/><b style='font-size: 12px;'>Adresa</b><span style='font-size: 12px;'>: {{ $map->address }}</span>";
            infowindow.setContent(contentString);
            infowindow.setPosition(myLatlng);
            infowindow.open(map);

            map.addListener('rightclick', function(event) {
                new_location = event.latLng;
                marker.setPosition(new_location);
                document.getElementById('latitude').value = new_location.lat();
                document.getElementById('longitude').value = new_location.lng();
            });
        }

        window.onload = initMap;
    </script>
    <script async defer
            src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA6utf7v7LOyA24khe4OL-HfiAkgV85OcM&callback=initMap">
    </script>
@endsection