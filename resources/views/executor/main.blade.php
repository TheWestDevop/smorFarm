
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="csrf-token" content="{{ csrf_token() }}" />
  <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
  <title>
 SmorFarm Executor
  </title>
  <!-- Favicon -->
  <link rel="icon" href="../icon.png">
  <!-- Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
  <!-- Font Awesome -->
<link rel="stylesheet" href="{{asset('css/font-awesome.min.css')}}">
  <!-- Icons -->
  <link href="{{asset('js/plugins/nucleo/css/nucleo.css')}}" rel="stylesheet" />
  <link href="{{asset('js/plugins/fontawesome/fontawesome-free/css/all.min.css')}}" rel="stylesheet" />
  <!-- CSS Files -->
  <link href="{{asset('css/argon-dashboard.css?v=1.1.0')}}" rel="stylesheet" />
  <link rel="stylesheet" type="text/css" href="https://js.api.here.com/v3/3.1/mapsjs-ui.css" />

   <script>
 if (@json($executor->id)) {
  localStorage.setItem('executor_api_token', @json($executor->api_token));
  localStorage.setItem('executor_user_id', @json($executor->id));

}
</script>
</head>

<body class="bg-default">

  <div id="executor"></div>
  <script>
    const BASE_URL = '{{URL::to('/')}}';
  </script>
  <script src="{{asset('js/executor.js')}}"></script>
  <script src="{{asset('js/plugins/jquery/dist/jquery.min.js')}}"></script>
  <script src="{{asset('js/plugins/bootstrap/dist/js/bootstrap.bundle.min.js')}}"></script>
  <script type="text/javascript" src="https://js.api.here.com/v3/3.1/mapsjs-core.js"></script>
  <script type="text/javascript" src="https://js.api.here.com/v3/3.1/mapsjs-service.js"></script>
  <script type="text/javascript" src="https://js.api.here.com/v3/3.1/mapsjs-ui.js"></script>
  <script type="text/javascript" src="https://js.api.here.com/v3/3.1/mapsjs-mapevents.js"></script>
 <!--   Argon JS   -->
 <script src="{{asset('js/argon-dashboard.min.js?v=1.1.0')}}"></script>
 <script>
   function moveMapToBerlin(map){
  map.setCenter({lat:52.5159, lng:13.3777});
  map.setZoom(14);
}

/**
 * Boilerplate map initialization code starts below:
 */

//Step 1: initialize communication with the platform
// In your own code, replace variable window.apikey with your own apikey
var platform = new H.service.Platform({
  apikey: "OcTEbIGbMuGF56h_Z1E_Ammaoy-SROE8DWJsaUZBkFc"
});
var defaultLayers = platform.createDefaultLayers();

//Step 2: initialize a map - this map is centered over Europe
var map = new H.Map(document.getElementById('map'),
  defaultLayers.vector.normal.map,{
  center: {lat:50, lng:5},
  zoom: 4,
  pixelRatio: window.devicePixelRatio || 1
});
// add a resize listener to make sure that the map occupies the whole container
window.addEventListener('resize', () => map.getViewPort().resize());

//Step 3: make the map interactive
// MapEvents enables the event system
// Behavior implements default interactions for pan/zoom (also on mobile touch environments)
var behavior = new H.mapevents.Behavior(new H.mapevents.MapEvents(map));

// Create the default UI components
var ui = H.ui.UI.createDefault(map, defaultLayers);

// Now use the map as required...
window.onload = function () {
  moveMapToBerlin(map);
}
 </script>

</body>

</html>
