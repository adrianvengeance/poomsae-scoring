<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Poomsae</title>
  <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">

</head>

<body data-bs-theme="dark">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-4">
        <h3 class="text-center mt-5 mb-3">Login Page</h3>
        @if (session()->has('loginError'))
          <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Error!</strong> {{ session('loginError') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
        @endif
        <form action="{{ route('login.post') }}" method="POST">
          @csrf
          <div class="form-floating mb-3">
            <input type="email" class="form-control @error('email') is-invalid @enderror" id="floatingInput"
              name="email" placeholder="name@example.com" value="" autofocus required>
            <label for="floatingInput">Email address</label>
            @error('email')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>
          <div class="form-floating mb-3">
            <input type="password" class="form-control" id="floatingPassword" name="password" placeholder="Password"
              required>
            <label for="floatingPassword">Password</label>
          </div>
          <div class="text-center">
            <button type="submit" class="btn btn-primary btn-block">Login</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <script src="{{ asset('js/bootstrap.min.js') }}"></script>

</body>

</html>
