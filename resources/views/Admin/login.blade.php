<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">


        <head>
            <meta charset="utf-8" />
            <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
            <meta csrf_token="{{csrf_token()}}">
            <title>SmorFarm Admin</title>
            <!-- Favicon -->
            <link href="../assets/img/brand/favicon.png" rel="icon" type="image/png">
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

          <body  class="bg-default">



                <div class="main-content">
                    <!-- Navbar -->
                    <nav class="navbar navbar-top navbar-horizontal navbar-expand-md navbar-dark">
                        <div class="container px-4">
                            <a class="navbar-brand" href="../index.html">
                                <div class="h1 text-white">
                                    <strong class=" font-italic">SMOR</strong>
                                    Farm <i class="fa fa-cart"></i>
                                </div>

                            </a>

                        </div>
                    </nav>
                    <!-- Header -->
                    <div class="header bg-gradient-primary py-7 py-lg-8">
                        <div class="container">
                            <div class="header-body text-center mb-7">
                                <div class="row justify-content-center">
                                    <div class="col-lg-5 col-md-6">
                                        <h1 class="text-white">Welcome Admin!</h1>
                                        <p class="text-lead text-light">Kindly Login With Your SmorFarm Given Username and Password.</p>

                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="separator separator-bottom separator-skew zindex-100">
                            <svg x="0" y="0" viewBox="0 0 2560 100" preserveAspectRatio="none" version="1.1" xmlns="http://www.w3.org/2000/svg">
                                <polygon class="fill-default" points="2560 0 2560 100 0 100"></polygon>
                            </svg>
                        </div>
                    </div>
                    <!-- Page content -->
                    <div class="container mt--8 pb-5">
                        <div class="row justify-content-center">
                            <div class="col-lg-5 col-md-7">
                                <div class="card bg-secondary shadow border-0">
                                    <div class="card-body px-lg-5 py-lg-5">
                                        <div class="text-center text-muted mb-4">
                                            <small>SmorFarm Admin</small>
                                        </div>
                                        @if ($errors)
                                            @foreach ($errors->all() as $message)
                                            <p class="text-danger text-italic text-center">{{$message}}</p>
                                            @endforeach

                                        @endif
                                       
                                        
                                        
                                        <form action="/api/auth/admin/login" method="POST" role="form">
                                            @csrf
                                            <div class="form-group mb-3">
                                                <div class="input-group input-group-alternative">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"></span>
                                                    </div>
                                                    <input class="form-control" name="email" placeholder="Username" type="email">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="input-group input-group-alternative">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"></span>
                                                    </div>
                                                    <input class="form-control" name="password" placeholder="Password" type="password">
                                                </div>
                                            </div>

                                            <div class="text-center">
                                                <button type="submit" class="btn btn-primary btn-block my-4">Login </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                </div>


          <script src="{{asset('js/plugins/jquery/dist/jquery.min.js')}}"></script>
          <script src="{{asset('js/plugins/bootstrap/dist/js/bootstrap.bundle.min.js')}}"></script>
          <!--   Optional JS   -->
          <!--   Argon JS   -->
          <script src="{{asset('js/argon-dashboard.min.js?v=1.1.0')}}"></script>


            </body>
        </html>

