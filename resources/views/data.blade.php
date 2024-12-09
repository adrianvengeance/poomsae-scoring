@extends('layout/layout')

@section('content')
  <div class="row mt-3">
    <h1 class="h1">Hello World from Data</h1>
    <form action="{{ route('upload') }}" method="post" class="my-3" enctype="multipart/form-data">
      {{ csrf_field() }}
      <div class="row">
        @if (session()->has('inserted'))
          <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('inserted') }}
            <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
        @endif
        @if (session()->has('created'))
          <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('created') }}
            <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
        @endif
        @if (session()->has('uncreated'))
          <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('uncreated') }}
            <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
        @endif
        <div class="col-md-6">
          <div class="input-group">
            <label class="input-group-text bg-success" for="inputGroupFile01">Excel</label>
            <input type="file" name="file" class="form-control @error('file') is-invalid @enderror"
              id="inputGroupFile01">
            @error('file')
              <span class="invalid-feedback">{{ $message }}</span>
            @enderror
          </div>
          <div class="form-text">{{ $files }}</div>
        </div>
        <div class="col-md-6 row">
          <div class="col-6">
            <div class="d-flex align-items-center">
              <button type="submit" class="btn btn-outline-primary">Submit</button>
            </div>
          </div>
          <div class="col-6">
            <div class="text-end">
              <a class="btn btn-success" href="{{ route('create-teams') }}">Create Pair & Group</a>
            </div>
          </div>
        </div>


      </div>
    </form>

    <div class="table-responsive">
      <table class="table table-hover">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Nama</th>
            <th scope="col">Tanggal Lahir</th>
            <th scope="col">Jenis Kelamin</th>
            <th scope="col">Dojang</th>
            <th scope="col">Tipe</th>
            <th scope="col">Kelas</th>
            <th scope="col">Kategori</th>
            <th scope="col">Sesi</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($data as $d)
            <tr>
              <th scope="row">{{ $loop->iteration }}</th>
              <td>{{ $d->name }}</td>
              <td>{{ $d->birthdate ?? '-' }}</td>
              <td>{{ strtolower($d->gender) == 'm' ? 'Male' : (strtolower($d->gender) == 'f' ? 'Female' : '-') }}
              </td>
              <td>{{ $d->dojang }}</td>
              <td>{{ $d->type }}</td>
              <td>{{ $d->class }}</td>
              <td>{{ $d->category }}</td>
              <td>{{ $d->session }}</td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
@endsection
