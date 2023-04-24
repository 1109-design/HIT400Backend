@extends('layouts.app')

@section('page-css')
@livewireStyles
    <style>
        #map {
            height: 80vh;
            width: 70vw;
        }
    </style>
    <style>
        .my-custom-dialog {
  max-width: 1000px;
  width: 100%;
  height: 100%;
  margin: 0 auto;
}
    </style>

    <style>
        .modal-dialog-slideout .modal-content {
  min-height: 100vh;
}

.modal-dialog-slideout .modal-dialog {
  position: fixed;
  margin-left: auto;
  width: 400px;
  height: 100%;
  top: 0;
  right: -400px;
  transition: right 0.3s ease-in-out;
}

.modal-dialog-slideout.show .modal-dialog {
  right: 0;
}

.modal-dialog-vertical-right {
  height: 100%;
  display: flex;
  flex-direction: column;
  justify-content: space-between;
}

.modal-header {
  flex: none;
}

.modal-body {
  flex: 1 1 auto;
  overflow-y: auto;
}

.modal-body form {
  margin-bottom: 20px;
}

.input-group-append button {
  border-top-left-radius: 0;
  border-bottom-left-radius: 0;
}

.input-group-append button:hover {
  background-color: #f0f0f0;
}

.search-suggestion {
  display: block;
  margin-bottom: 10px;
  color: #1a0dab;
  text-decoration: none;
}

.search-suggestion:hover {
  text-decoration: underline;
}

.search-results {
  height: 300px;
  overflow-y: scroll;
}
.modal-lg {
  max-width: 90%;
  max-height: 90%;
}

    </style>




@endsection
@section('content')
    <div class="card bg-primary">
        <div class="card-header">
            <h4 class="card-title mb-0 text-center text-blue">Location Information For Complaint #{{$complaintId}}  <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#search-modal">
    Complaint analysis
  </button></h4>



        </div>


    </div>




        <div class="container mt-5">

            <div id="map"></div>
        </div>



{{-- <div class="fixed-bottom mr-3 mb-3">
  <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#search-modal">
    Search
  </button>
</div> --}}
@livewire('search')









@endsection



@section('page-js')
@livewireScripts
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
