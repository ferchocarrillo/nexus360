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
    <script>
        //Cuando la página esté cargada completamente
        $(document).ready(function() {
            //Cada 10 segundos (10000 milisegundos) se ejecutará la función refrescar
            setTimeout(refrescar, 12000000);
        });

        function refrescar() {
            //Actualiza la página
            location.reload();
        }

    </script>

</body>

</html>
