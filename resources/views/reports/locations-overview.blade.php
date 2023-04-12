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
                        <h4 class="card-title mb-0 text-center text-blue">All Affected Locations Summary </h4>
        </div>

    </div>




    <div class="container mt-5">

        <div id="map"></div>
    </div>

@endsection



@section('page-js')
    <script src="https://code.jquery.com/jquery-3.4.1.js"></script>
    <script>
        function initMap() {
            var map = new google.maps.Map(document.getElementById('map'), {
                zoom: 10,
                center: {lat: -17.8377146, lng: 31.006443} // center the map around Harare Institute Of Technology
            });

            // create an array of markers with their positions and titles
            var markers = [
                <?php echo json_encode($complaints); ?>
            ];
            // console.log(markers[0][0]);
            // console.log( markers[0].length)

            // loop through the markers array and add each marker to the map
            for (var i = 0; i < markers[0].length; i++) {
                var position = {
                    lat: markers[0][i].latitude,
                    lng: markers[0][i].longitude

                };
                // console.log(position);
                var marker = new google.maps.Marker({
                    position: position,
                    title: markers[0][i].status,
                    map: map
                });
            }
        }
    </script>


    <script type="text/javascript"
            src="https://maps.google.com/maps/api/js?key={{ env('GOOGLE_MAP_KEY') }}&callback=initMap"></script>
@endsection
