@extends('referee/layout/layout')
@section('content')
  <div class="container-sm">
    <div class="row mt-4 text-center">
      <h4 class="fs-5">{!! $title !!}</h4>
      <div class="table-responsive">
        <table class="table table-sm table-striped">
          <thead>
            <tr class="fs-6">
              <th>#</th>
              <th>Nama</th>
              <th>Dojang</th>
              <th>Akurasi</th>
              <th>Presentasi</th>
              <th></th>
            </tr>
          </thead>
          <tbody>
            @foreach ($participants as $item)
              <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $item->name }}</td>
                <td>{{ $item->dojang }}</td>
                <td>{{ $item->accuration }}</td>
                <td>{{ $item->presentation }}</td>
                <td>
                  <a class="btn btn-sm btn-success" id="penjurian" href="{{ route('judging.show', $item->id) }}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16 " fill="currentColor"
                      viewBox="1 1 16 16">
                      <path fill-rule="evenodd"
                        d="M6 3.5a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-2a.5.5 0 0 0-1 0v2A1.5 1.5 0 0 0 6.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-8A1.5 1.5 0 0 0 5 3.5v2a.5.5 0 0 0 1 0z" />
                      <path fill-rule="evenodd"
                        d="M11.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 1 0-.708.708L10.293 7.5H1.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708z" />
                    </svg></a>
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
@endsection

@section('scripts')
  {{-- <script src="{{ asset('js/referee.js') }}"></script> --}}
@endsection
