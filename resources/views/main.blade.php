
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="csrf-token" content="{{ csrf_token() }}" />
  <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests"> 
  <title>
 SmorFarm Admin
  </title>
  <!-- Favicon -->
  <link href="/img/brand/favicon.png" rel="icon" type="image/png">
  <!-- Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
  <!-- Font Awesome -->
<link rel="stylesheet" href="{{asset('css/font-awesome.min.css')}}">
  <!-- Icons -->
  <link href="{{asset('js/plugins/nucleo/css/nucleo.css')}}" rel="stylesheet" />
  <link href="{{asset('js/plugins/fontawesome/fontawesome-free/css/all.min.css')}}" rel="stylesheet" />
  <!-- CSS Files -->
  <link href="{{asset('css/argon-dashboard.css?v=1.1.0')}}" rel="stylesheet" />

</head>

<body class="bg-default">

  <div id="admin"></div>
  <script>
    const BASE_URL = '{{URL::to('/')}}';
  </script>
  <script src="{{asset('js/admin.js')}}"></script>
  <script src="{{asset('js/plugins/jquery/dist/jquery.min.js')}}"></script>
  <script src="{{asset('js/plugins/bootstrap/dist/js/bootstrap.bundle.min.js')}}"></script>

  <!--   Optional JS   -->
  <script src="{{asset('js/plugins/chart.js/dist/Chart.min.js')}}"></script>
  <script src="{{asset('js/plugins/chart.js/dist/Chart.extension.js')}}"></script>
 <!--   Argon JS   -->
 <script src="{{asset('js/argon-dashboard.min.js?v=1.1.0')}}"></script>

<script>

if (@json($admin)) {
  localStorage.setItem('admin_id', @json($admin->id));
  localStorage.setItem('admin_api_token', @json($admin->api_token));
}


</script>


</body>

</html>
