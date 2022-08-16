<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Enercare/Sales Ranking</title>
    <link rel="stylesheet" href="{{ asset('vendor/adminlte/dist/css/adminlte.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/salesShow.css') }}">


</head>

<body>
    <div id="carouselExampleSlidesOnly" class="carousel slide carousel-fade" data-ride="carousel" data-interval="10000">
        <div class="carousel-inner">
            @include('salesShow.serviceSales')
            @include('salesShow.billingSales')
            @include('salesShow.offlineSales')
            @include('salesShow.obaSales')
            @include('salesShow.outboundSales')
            @include('salesShow.overNigthSales')
            @include('salesShow.serviceCoversion')
            @include('salesShow.billingConversion')
            @include('salesShow.offlineConversion')
            @include('salesShow.obaConversion')
            @include('salesShow.outboundConversion')
            @include('salesShow.overNightConversion')
        </div>
    </div>
    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('vendor/adminlte/dist/js/adminlte.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/canvas-confetti@1.3.2/dist/confetti.browser.min.js"></script>
    <script>
        //Cuando la página esté cargada completamente
        $(document).ready(function() {
            //Cada 10 segundos (10000 milisegundos) se ejecutará la función refrescar
            setTimeout(refrescar, 12000000);
            var duration = 5 * 1000;
        var animationEnd = Date.now() + duration;
        var defaults = { startVelocity: 30, spread: 360, ticks: 60, zIndex: 1 };

        function randomInRange(min, max) {
          return Math.random() * (max - min) + min;
        }
        var interval = setInterval(function() {
          var timeLeft = animationEnd - Date.now();

          if (timeLeft <= 0) {
            return clearInterval(interval);
          }

          var particleCount = 50 * (timeLeft / duration);
          // since particles fall down, start a bit higher than random
          confetti(Object.assign({}, defaults, { particleCount, origin: { x: randomInRange(0.1, 0.3), y: Math.random() - 0.2 } }));
          confetti(Object.assign({}, defaults, { particleCount, origin: { x: randomInRange(0.7, 0.9), y: Math.random() - 0.2 } }));
        }, 250);
        });

        function refrescar() {
            //Actualiza la página
            location.reload();
        }

    </script>

</body>

</html>
