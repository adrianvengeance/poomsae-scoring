<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Poomsae</title>
  <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
  @yield('header')
</head>

<body data-bs-theme="light">

  <nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
      <a class="navbar-brand" href="/home">
        <img src="{{ asset('/images/rocket.svg') }}" alt="Brand" width="30" height="24">
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarScroll"
        aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarScroll">
        <ul class="navbar-nav me-auto my-2 my-lg-0 navbar-nav-scroll" style="--bs-scroll-height: 100px;">
          <li class="nav-item mx-1">
            <a class="nav-link {{ Route::is('home') ? 'active' : '' }}" href="{{ route('home') }}">Home</a>
          </li>
          <li class="nav-item mx-1">
            <a class="nav-link {{ Route::is('data') ? 'active' : '' }}" href="{{ route('data') }}">Data</a>
          </li>
          <li class="nav-item mx-1">
            <a class="nav-link {{ Route::is('individu') ? 'active' : '' }}" href="{{ route('individu') }}">Individu</a>
          </li>
          <li class="nav-item mx-1">
            <a class="nav-link {{ Route::is('team') ? 'active' : '' }}" href="{{ route('team') }}">Pair or Group</a>
          </li>
          <li class="nav-item mx-1">
            <a class="nav-link {{ Route::is('history') ? 'active' : '' }}" href="{{ route('history') }}">History</a>
          </li>
        </ul>
        {{-- <div class="d-flex">
          <button class="btn" id="theme-toggler">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
              viewBox="0 0 16 16">
              <path
                d="M6 .278a.77.77 0 0 1 .08.858 7.2 7.2 0 0 0-.878 3.46c0 4.021 3.278 7.277 7.318 7.277q.792-.001 1.533-.16a.79.79 0 0 1 .81.316.73.73 0 0 1-.031.893A8.35 8.35 0 0 1 8.344 16C3.734 16 0 12.286 0 7.71 0 4.266 2.114 1.312 5.124.06A.75.75 0 0 1 6 .278" />
            </svg>
          </button>
        </div> --}}
      </div>
    </div>
  </nav>

  <div class="container-fluid">
    <div class="row">

      @yield('content')

    </div>
  </div>

  <script src="{{ asset('js/bootstrap.min.js') }}"></script>
  <script src="{{ asset('js/layout.js') }}"></script>

  @yield('scripts')

</body>

</html>
