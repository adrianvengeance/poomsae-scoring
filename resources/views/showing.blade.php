<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Poomsae</title>
  <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
  <style>
    /* HTML: <div class="loader"></div> */
    .loader {
      width: 100px;
      aspect-ratio: 1;
      border-radius: 50%;
      border: 8px solid;
      border-color: #000 #0000;
      animation: l1 1s infinite;
    }

    @keyframes l1 {
      to {
        transform: rotate(.5turn)
      }
    }
  </style>

</head>

<body data-bs-theme="light">

  <div class="container-fluid">
    <div class="row">
      <div class="row mt-3">
        <p class="h3 text-center my-4">{!! $title !!}</p>
      </div>
      <div class="row px-5">
        @if ($participants)
          <div class="table-responsive">
            <table class="table fs-4">
              <thead>
                <tr>
                  <th>Name - Dojang</th>
                  <th class="text-center">A1</th>
                  <th class="text-center">P1</th>
                  <th class="text-center">A2</th>
                  <th class="text-center">P2</th>
                  <th class="text-center">A3</th>
                  <th class="text-center">P3</th>
                  <th class="text-center">Accuracy</th>
                  <th class="text-center">Presentation</th>
                  <th class="text-center">Total</th>
                  <th class="text-center">Ranking</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($participants as $p)
                  <tr class="align-middle">
                    <td class="">
                      <p class="text-decoration-underline mb-0">{{ $team ? $p->name : nameShowing($p->name) }}</p>
                      {{ $p->dojang }}
                    </td>
                    <td class="fs-1 text-center">{{ $p->acc_scores[0] ?? '' }}<br>{{ $p->acc_scores[3] ?? '' }}</td>
                    <td class="fs-1 text-center">{{ $p->pre_scores[0] ?? '' }}<br>{{ $p->pre_scores[3] ?? '' }}</td>
                    <td class="fs-1 text-center">{{ $p->acc_scores[1] ?? '' }}<br>{{ $p->acc_scores[4] ?? '' }}</td>
                    <td class="fs-1 text-center">{{ $p->pre_scores[1] ?? '' }}<br>{{ $p->pre_scores[4] ?? '' }}</td>
                    <td class="fs-1 text-center">{{ $p->acc_scores[2] ?? '' }}<br>{{ $p->acc_scores[5] ?? '' }}</td>
                    <td class="fs-1 text-center">{{ $p->pre_scores[2] ?? '' }}<br>{{ $p->pre_scores[5] ?? '' }}</td>
                    <td class="fs-1 text-center">{{ $p->sum_acc }}</td>
                    <td class="fs-1 text-center">{{ $p->sum_pre }}</td>
                    <td class="fs-1 text-center">{{ $p->total }}</td>
                    <td class="fs-1 fw-bold text-center border border-dark"
                      style="background-color: {{ $colors[$loop->iteration] }}">
                      {{ $loop->iteration }}
                    </td>
                  </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        @else
          <div class="mt-6">
            <div class="position-relative mt-5 pt-5">
              <div class="position-absolute top-100 start-50 translate-middle">
                <div class="loader"></div>
              </div>
            </div>
          </div>
      </div>
      @endif
    </div>
  </div>
  </div>

  <script src="{{ asset('js/bootstrap.min.js') }}"></script>
  <script>
    function autoRefresh() {
      window.location = window.location.href;
    }
    setInterval('autoRefresh()', 5000);
  </script>

</body>

</html>
