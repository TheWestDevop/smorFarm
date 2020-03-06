
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
  <style>
    .form-group input {
      width: 100%;
    background-color: transparent;
    border: 1px solid #999999;
    border-radius: 0;
    line-height: 23px;
    padding: 10px 20px;
    font-size: 14px;
    color: #7a7a7a;
    margin-bottom: 15px;
    }
  </style>
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

  <!--   Optional JS   -->
  <script src="{{asset('js/plugins/chart.js/dist/Chart.min.js')}}"></script>
  <script src="{{asset('js/plugins/chart.js/dist/Chart.extension.js')}}"></script>
 <!--   Argon JS   -->
 <script src="{{asset('js/argon-dashboard.min.js?v=1.1.0')}}"></script>


</body>

</html>
