@extends('layout/layout')

@section('header')
  @laravelViewsStyles
@endsection

@section('content')
  <div class="row mt-3">
    <h1 class="h1">Hello World from Individu</h1>

    @livewire('individu-table-view')
    @csrf
  </div>
@endsection

@section('scripts')
  @laravelViewsScripts

  <script>
    let thead = document.getElementsByTagName('thead')[0];
    // thead.classList.add("text-black")
    // thead.classList.remove("bg-gray-100")
  </script>
@endsection
