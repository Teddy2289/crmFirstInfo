<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <meta name="description" content="Admin template built with Bootstrap, Angular & Laravel. 300+ UI Components and pages for your next web application project">
    <meta name="keywords" content="Angular Admin, Laravel admin, Bootstrap Admin, ng bootstrap admin, Project management template, UI Lib">
    <meta name="author" content="UI Lib">
    <link href="https://fonts.googleapis.com/css?family=Nunito:300,400,400i,600,700,800,900" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/styles/css/themes/lite-purple.min.css') }}"></head>
    <style>
      .loadscreen {
          text-align: center;
          position: fixed;
          width: 100%;
          left: 0;
          right: 0;
          margin: auto;
          top: 0;
          height: 100vh;
          background: #ffffff;
      }

      .loadscreen .loader {
          position: absolute;
          top: calc(50vh - 50px);
          left: 0;
          right: 0;
          margin: auto;
      }

      .loadscreen .logo {
          display: inline-block !important;
          width: 80px;
          height: 80px;
      }
  </style>
<body>

    <section class="homepage">
        <div class="container">
            <div class="main-content text-center">
                <div class="logo">
                    <img src="{{ asset('assets/images/logo.avif') }}" alt="">
                </div>
                <h1 class="mb-24 font-weight-bold">Plateforme<br>Gestion Ferme</h1>
                <p class="p-readable text-muted mx-auto mb-32">Indentifier vous pour demarer la session!</p>
                @if (Route::has('login'))
                <div class="cta d-flex justify-content-center mb-48">
                    <a class="btn btn-raised btn-raised-primary btn-xl rounded" href="{{ route('login') }}">S'identifier</a>
                    <span style="width: 20px"></span>
                    <a class="btn btn-raised btn-raised-secondary btn-xl rounded" href="#">S'inscrire</a>
                </div>
                @endif
                <div class="dashboard-photo">
                    <img src="assets/images/home.png" alt="">
                </div>
            </div>
        </div>
    </section>



    <!-- <section class="features bg-off-white">
        <div class="container">
            
            <div class="row">
                <div class="col-md-3 mb-3">
                    <div class="features-wrap pt-5 mt-3">
                        <div class="card feature-card active" data-tab="skit">
                            <div class="card-icon">
                                <i data-feather="bar-chart-2"></i>
                            </div>
                            <div class="card-title">
                                <h6>Great Kick <br>
                                    Starter</h6>
                            </div>
                        </div>
                        
                        <div class="card feature-card">
                            <div class="card-icon">
                                <i data-feather="layout"></i>
                            </div>
                            <div class="card-title">
                                <h6>Mutiple<br>
                                    Layouts</h6>
                            </div>
                        </div>
                        <div class="card feature-card">
                            <div class="card-icon">
                                <i data-feather="layout"></i>
                            </div>
                            <div class="card-title">
                                <h6>Large collection <br>
                                    of UI Kits</h6>
                            </div>
                        </div>
                        <div class="card feature-card" data-tab="ss">
                            <div class="card-icon">
                                <i data-feather="book-open"></i>
                            </div>
                            <div class="card-title">
                                <h6>Pure Angular<br>
                                    version</h6>
                            </div>
                        </div>
                        <div class="card feature-card">
                            <div class="card-icon">
                                <i data-feather="code"></i>
                            </div>
                            <div class="card-title">
                                <h6>Fuctional <br>
                                  Applications</h6>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-9">
                    <div class="features-photo tab-panel active" id="skit">
                            <div class="text-center mb-4">
                                <h2 class="font-weight-bold">Great starter kit for your <br> HTML/Laravel/Angular project</h2>
                                <p class="p-readable m-auto"></p>
                            </div>
                            <div class="card o-hidden">
                                <img src="assets/images/gull-large-sidebar.png" alt="">
                            </div>
                    </div>
                    <div class="features-photo tab-panel" id="ss">
                            <div class="text-center mb-3">
                                <h2>Features you wile Love ss</h2>
                                
                            </div>
                            <div class="card o-hidden">
                                <img src="assets/images/gull-large-sidebar.png" alt="">
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </section> -->
    


    <div class="loadscreen">
      <div class="loader">
          <img src="assets/images/logo.avif" class="logo mb-3" style="display: none" alt="">
          <div class="loader-bubble loader-bubble-primary d-block"></div>
      </div>
    </div>

    <script src="assets/js/vendor/jquery-3.3.1.min.js"></script>
    <script src="assets/js/vendor/bootstrap.bundle.min.js"></script>
    <script src="assets/js/vendor/feather.min.js"></script>
    <script src="assets/js/landing.script.js"></script>

    <script>
      /* ----------------------------- 
      Pre Loader
      ----------------------------- */
      $(window).on('load', function () {
          'use strict';
          $('.loadscreen').delay(500).fadeOut();
          // $('#preloader').delay(800).fadeOut('slow');
      });
  </script>
</body>
</html>