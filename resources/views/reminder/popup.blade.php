<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{asset('css/reminders.css')}}">
    <title>🔔🔔 ALERT 🔔🔔</title>
</head>
<body>
    <header class="bg_animate">
        <section class="banner contenedor">
            <div class="banner_img">
                <img src="/img/CP360_Logo_REV.png" alt="">
            </div>
            <section class="banner_title">
                <h2 id="msg">{{$reminderUser->reminder->reminder}}</h2>
            </section>
            @if ($reminderUser->acknowledge_required == 1 &&  $reminderUser->acknowledge != 1)
            {!! Form::model($reminderUser, ['route' => ['reminder.acknowledge',$reminderUser->id],'method' => 'post']) !!}
            <input type="submit" class="banner_button close" id="acknowledge"   value="acknowledge" >
            {!! Form::close() !!}
            </form>
            @endif
        </section>
        <div class="burbujas">
            <div class="burbuja"></div>
            <div class="burbuja"></div>
            <div class="burbuja"></div>
            <div class="burbuja"></div>
            <div class="burbuja"></div>
            <div class="burbuja"></div>
            <div class="burbuja"></div>
            <div class="burbuja"></div>
            <div class="burbuja"></div>
            <div class="burbuja"></div>
        </div>
    </header>
    <audio autoplay>
        <source src="/sounds/alert.mp3" type="audio/mpeg">
    </audio>
</body>
</html>
