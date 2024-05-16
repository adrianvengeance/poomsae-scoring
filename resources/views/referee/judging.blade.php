@extends('referee/layout/layout')
@section('content')
  <div class="container-sm ps-0 pe-3">
    <div class="row mt-4 text-center">
      <h4 class="fs-5 mb-0">{{ $participant->name }}</h4>
      <h5 class="fs-6">{{ $participant->dojang }} SD Islam Al-Azhar 31</h5>
    </div>
    <div class="row text-center mt-3">
      <div class="col-6">
        <span class="">Accuracy</span>
        <h1 class="p-2" id="accuracyPoint">2.0</h1>
      </div>
      <div class="col-6">
        <span>Presentation</span>
        <h1 class="p-2" id="presentationPoint">3.0</h1>
      </div>
      <div class="col-12">
        <span>Total</span>
        <h1 class="p-2" id="totalPoint">5.0</h1>
      </div>
    </div>
    <div class="row">
      <div class="col text-center">
        <button type="button" class="btn btn-primary" id="modalSubmitBtn" data-bs-toggle="modal"
          data-bs-target="#exampleModal">Submit</button>
      </div>
    </div>
    <hr class="mt-4">
    <div class="row mt-2 mx-0">
      <p class="text-center">Accuracy</p>
      <div class="col-3 d-grid px-1">
        <button class="btn btn-outline-danger py-4 fs-1 mb-0" id="accuracyMinusOne">-0.1</button>
      </div>
      <div class="col-3 d-grid px-1">
        <button class="btn btn-outline-danger py-4 fs-1 mb-0" id="accuracyMinusThree">-0.3</button>
      </div>
      <div class="col-3 d-grid px-1">
        <button class="btn btn-outline-success py-4 fs-1 mb-0" id="accuracyPlusThree">+0.3</button>
      </div>
      <div class="col-3 d-grid px-1">
        <button class="btn btn-outline-success py-4 fs-1 mb-0" id="accuracyPlusOne">+0.1</button>
      </div>
    </div>
    <hr class="mt-5">
    <div class="row mt-2 mx-0">
      <p class="text-center">Presentation</p>
      <div class="col-12 mb-4">
        <label for="speedPower" class="form-label">Speed & Power</label>
        <span class="float-end" id="speedPowerValue"> 1.0</span>
        <input type="range" class="form-range" min="0" max="2" step="0.1" id="speedPower">
      </div>
      <div class="col-12 mb-4">
        <label for="rhythmTempo" class="form-label">Rhythm & Tempo</label>
        <span class="float-end" id="rhythmTempoValue">1.0</span>
        <input type="range" class="form-range" min="0" max="2" step="0.1" id="rhythmTempo">
      </div>
      <div class="col-12">
        <label for="expressionOfEnergy" class="form-label">Expression of Energy</label>
        <span class="float-end" id="expressionOfEnergyValue">1.0</span>
        <input type="range" class="form-range" min="0" max="2" step="0.1" id="expressionOfEnergy">
      </div>
    </div>
  </div>

  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <form action="{{ route('judging.submit') }}" method="POST">
          @csrf
          <input type="hidden" name="participant_id" value="{{ $participant->id }}">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel">Are you sure to submit?</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <div class="mb-3">
              <label class="form-label mb-0">Nama</label>
              <input type="email" class="form-control-plaintext " readonly value="{{ $participant->name }}">
            </div>
            <div class="mb-3">
              <label class="form-label mb-0">Dojang</label>
              <input type="email" class="form-control-plaintext " readonly
                value="{{ $participant->dojang . 'SD ISLAM AL-AZHAR 31' }}">
            </div>
            <div class="row text-center">
              <div class="col-6">
                <label for="">Accuracy</label>
                <input type="text" readonly class="form-control-plaintext text-center" name="accuration"
                  value="">
              </div>
              <div class="col-6">
                <label for="">Presentation</label>
                <input type="text" readonly class="form-control-plaintext text-center" name="presentation"
                  value="">
              </div>
            </div>
            <div class="mb-3 text-center">
              <label for="">Total</label>
              <input type="text" readonly class="form-control-plaintext text-center" name="total" value="">
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary btn-sm text-start" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary btn-sm">Submit</button>
          </div>
        </form>
      </div>
    </div>
  </div>
@endsection

@section('scripts')
  <script src="{{ asset('js/referee.js') }}"></script>
  <script src="{{ asset('js/scores.js') }}"></script>
@endsection
