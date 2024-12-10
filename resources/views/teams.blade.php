@extends('layout/layout')

@section('header')
  @laravelViewsStyles
@endsection

@section('content')
  <div class="row">
    @livewire('teams-table-view')
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
