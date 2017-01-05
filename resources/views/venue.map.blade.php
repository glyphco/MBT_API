


@extends('app')

@section('content')
    <div class="container">
        <div class="row">
            <div id="map-canvas"></div>
        </div>
    </div>

    <script type="text/javascript">

            var mapOptions = {
                zoom: 4,
                center: new google.maps.LatLng({{$items[0]->location}})
            }
            var map = new google.maps.Map(document.getElementById("map-canvas"), mapOptions);


            @foreach($items as $item)
                var marker{{$item->id}} = new google.maps.Marker({
                    position: new google.maps.LatLng({{$item->location}}),
                    map: map,
                    title: "{{$item->title}}"
                });
            @endforeach


    </script>


@endsection
