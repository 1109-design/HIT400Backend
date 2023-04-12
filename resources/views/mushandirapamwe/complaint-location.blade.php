@extends('layouts.app')

@section('page-css')
    <style>
        #map {
            height: 80vh;
            width: 70vw;
        }
    </style>
@endsection
@section('content')
    <div class="card bg-primary">
        <div class="card-header">
            <h4 class="card-title mb-0 text-center text-blue">Location Information For Complaint #{{$complaintId}}</h4>
        </div>

    </div>




        <div class="container mt-5">

            <div id="map"></div>
        </div>



@endsection



@section('page-js')
    <script src="https://code.jquery.com/jquery-3.4.1.js"></script>
    <script type="text/javascript">
        function initMap() {
            const myLatLng = {lat: <?php echo json_encode($latitude); ?>, lng: <?php echo json_encode($longitude); ?>};

            const map = new google.maps.Map(document.getElementById("map"), {
                zoom: 16,
                center: myLatLng,
            });
            // create a LatLngBounds object to hold our coordinates
            // var bounds = new google.maps.LatLngBounds();
            // // add the coordinates to the bounds object
            // bounds.extend(new google.maps.LatLng(myLatLng.lat,myLatLng.lng));
            // map.fitBounds(bounds);


            new google.maps.Marker({
                position: myLatLng,
                map,
                title:  <?php echo json_encode('Resolution Status:'. ' '.$status); ?>,
            });

            // create a LatLngBounds object to hold our coordinates
            // var bounds = new google.maps.LatLngBounds();
            //
            // // add the coordinates to the bounds object
            // bounds.extend(new google.maps.LatLng(myLatLng.lat,myLatLng.lng));
            // console.log(myLatLng.lat);
            //
            // // fit the map to the bounds
            // let mapDiv = map.getDiv()
            //
            // let padding = {
            //     bottom: mapDiv.offsetHeight * 0.1,
            //     left: mapDiv.offsetWidth * 0.1,
            //     right: mapDiv.offsetWidth * 0.1,
            //     top: mapDiv.offsetHeight * 0.1,
            // }
            // map.fitBounds(bounds, padding);
        }

        window.initMap = initMap;
    </script>

    <script type="text/javascript"
            src="https://maps.google.com/maps/api/js?key={{ env('GOOGLE_MAP_KEY') }}&callback=initMap"></script>
@endsection
