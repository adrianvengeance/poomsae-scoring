<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Poomsae</title>
  <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
  <style>
    /* HTML: <div class="loader"></div>
    /* .loader {
      width: fit-content;
      font-weight: bold;
      font-family: monospace;
      font-size: 30px;
      background: radial-gradient(circle closest-side, #000 94%, #0000) right/calc(200% - 1em) 100%;
      animation: l24 1s infinite alternate linear;
    }

    .loader::before {
      content: "Loading...";
      line-height: 1em;
      color: #0000;
      background: inherit;
      background-image: radial-gradient(circle closest-side, #fff 94%, #000);
      -webkit-background-clip: text;
      background-clip: text;
    }

    @keyframes l24 {
      100% {
        background-position: left
      }
    } */

    /* HTML: <div class="loader"></div> */
    /* .loader {
      width: 60px;
      aspect-ratio: 2;
      --_g: no-repeat radial-gradient(circle closest-side, #000 90%, #0000);
      background:
        var(--_g) 0% 50%,
        var(--_g) 50% 50%,
        var(--_g) 100% 50%;
      background-size: calc(100%/3) 50%;
      animation: l3 1s infinite linear;
    }

    @keyframes l3 {
      20% {
        background-position: 0% 0%, 50% 50%, 100% 50%
      }

      40% {
        background-position: 0% 100%, 50% 0%, 100% 50%
      }

      60% {
        background-position: 0% 50%, 50% 100%, 100% 0%
      }

      80% {
        background-position: 0% 50%, 50% 50%, 100% 100%
      }
    } */


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
        @if (count($participants) > 0)
          <div class="table-responsive">
            <table class="table fs-4">
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
                  <tr class="align-middle">
                    <td>{{ $p->name }}</td>
                    <td>{{ $p->dojang }}</td>
                    <td class="fs-2 text-center">{{ $p->acc_scores[0] ?? '' }}</td>
                    <td class="fs-2 text-center">{{ $p->pre_scores[0] ?? '' }}</td>
                    <td class="fs-2 text-center">{{ $p->acc_scores[1] ?? '' }}</td>
                    <td class="fs-2 text-center">{{ $p->pre_scores[1] ?? '' }}</td>
                    <td class="fs-2 text-center">{{ $p->acc_scores[2] ?? '' }}</td>
                    <td class="fs-2 text-center">{{ $p->pre_scores[2] ?? '' }}</td>
                    <td class="fs-1 text-center">{{ $p->sum_acc }}</td>
                    <td class="fs-1 text-center">{{ $p->sum_pre }}</td>
                    <td class="fs-1 text-center">{{ $p->total }}</td>
                    <td class="fs-1 fw-bold text-center" style="background-color: {{ $colors[$loop->iteration] }}">
                      {{ $loop->iteration }}
                    </td>
                  </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        @else
          <div class="position-relative mt-5 pt-5">
            <div class="position-absolute top-100 start-50 translate-middle">
              <div class="loader"></div>
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
    setInterval('autoRefresh()', 000);
  </script>

</body>

</html>
