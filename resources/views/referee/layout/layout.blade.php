<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Poomsae</title>
  <link rel="stylesheet" href="{{ asset('css/app.css') }}">
  @yield('header')
</head>

<body data-bs-theme="white">

  {{-- <div class="d-sm-none d-md-block">entah a</div>
    <div class="d-none d-sm-block d-md-none">entah b</div> --}}
  <nav class="navbar bg-body-tertiary">
    <div class="container-fluid">
      <span class="navbar-brand mb-0 h5">Poomsae</span>
      <!-- Button trigger modal -->
      <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#exampleModal">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
          <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0" />
          <path fill-rule="evenodd"
            d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8m8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1" />
        </svg>
      </button>
    </div>
  </nav>


  @yield('content')


  <!-- Modal -->
  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Nama Wasit</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <input type="text" name="name" id="refereeName" class="form-control" placeholder="Masukkan Nama Wasit">
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary">Save changes</button>
        </div>
      </div>
    </div>
  </div>
  </div>

  <script src="{{ asset('js/app.js') }}"></script>
  {{-- <script src="{{ asset('js/layout.js') }}"></script> --}}

  @yield('scripts')

</body>

</html>
