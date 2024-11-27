@extends('layout/layout')

@section('header')
  @laravelViewsStyles
@endsection

@section('content')
  <div class="row mt-3">
    <a class="link-offset-2 link-underline link-underline-opacity-0 text-black" href="{{ route('active') }}">
      <p class="h3 text-center mb-4">{!! $title !!}</p>
    </a>

    @livewire('individu-active-table-view')
    @csrf


    {{-- <div class="table-responsive">
      <table class="table ">
        <thead>
          <tr>
            <th>Name</th>
            <th>Dojang</th>
            <th>A1</th>
            <th>P1</th>
            <th>A2</th>
            <th>P2</th>
            <th>A3</th>
            <th>P3</th>
            <th>Accuracy</th>
            <th>Presentation</th>
            <th>Total</th>
            <th>Ranking</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($participants as $p)
            <tr class="">
              <td>{{ $p->name }}</td>
              <td>{{ $p->dojang }}</td>
              <td class="text-center">{{ $p->acc_scores[0] ?? '' }}</td>
              <td class="text-center">{{ $p->pre_scores[0] ?? '' }}</td>
              <td class="text-center">{{ $p->acc_scores[1] ?? '' }}</td>
              <td class="text-center">{{ $p->pre_scores[1] ?? '' }}</td>
              <td class="text-center">{{ $p->acc_scores[2] ?? '' }}</td>
              <td class="text-center">{{ $p->pre_scores[2] ?? '' }}</td>
              <td class="text-center">{{ $p->sum_acc }}</td>
              <td class="text-center">{{ $p->sum_pre }}</td>
              <td class="text-center">{{ $p->total }}</td>
              <td class="text-center" style="background-color: {{ $p->ranking ? $colors[$loop->iteration] : '' }}">
                {{ $p->ranking }}
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div> --}}

  </div>
@endsection

@section('scripts')
  @laravelViewsScripts

  <script>
    // function autoRefresh() {
    //   window.location = window.location.href;
    // }
    // setInterval('autoRefresh()', 10000); // 10 seconds
  </script>
@endsection
