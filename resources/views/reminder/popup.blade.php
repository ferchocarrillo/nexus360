<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>🔔🔔 ALERT 🔔🔔</title>
    <script>
        window.addEventListener("message", receiveMessage, false);
        function receiveMessage(event){
            let data = event.data;
            document.querySelector('#msg').innerHTML = data.msg;
        }

    </script>
    <style>
        
        *{
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body{
            font-family: system-ui;
        }

        .contenedor{
            min-width: 450px;
            width: 90%;
            max-width: 1200px;
            margin: auto;
            overflow:auto;
        }

        .bg_animate{
            width: 100%;
            height: 100vh;
            background: linear-gradient(to right, #231161, #3f259e);
            position: relative;
            overflow:hidden;
        }


        .banner{
            /* display: flex;
            justify-content: space-between; */
            align-items: center;
            height: 100%;
            text-align: center;
        }

        .banner_title h2{
            color: #fff;
            font-size: 5em;
            /* font-weight: 800; */
            margin-bottom: 20px;
        }


        .banner_img{
            text-align: center;
            animation: movimiento 2.5s linear infinite;
        }

        .banner_img img{
            max-height: 15em;
            width: auto;
            /* display: block; */
            
        }

        /* burbujas */

        .burbuja{
            border-radius: 50%;
            background: #ff4438;
            opacity: .3;

            position: absolute;
            bottom: -150;
            
            animation: burbujas 3s linear infinite ;
        }

        .burbuja:nth-child(1){
            width: 80px;
            height: 80px;
            left: 5%;
            animation-duration: 3s;
            animation-delay: 3s;
        }

        .burbuja:nth-child(2){
            width: 100px;
            height: 100px;
            left: 35%;
            animation-duration: 3s;
            animation-delay: 5s;
        }

        .burbuja:nth-child(3){
            width: 20px;
            height: 20px;
            left: 15%;
            animation-duration: 1.5s;
            animation-delay: 7s;
        }

        .burbuja:nth-child(4){
            width: 50px;
            height: 50px;
            left: 90%;
            animation-duration: 6s;
            animation-delay: 3s;
        }

        .burbuja:nth-child(5){
            width: 70px;
            height: 70px;
            left: 65%;
            animation-duration: 3s;
            animation-delay: 1s;
        }

        .burbuja:nth-child(6){
            width: 20px;
            height: 20px;
            left: 50%;
            animation-duration: 4s;
            animation-delay: 5s;
        }

        .burbuja:nth-child(7){
            width: 20px;
            height: 20px;
            left: 50%;
            animation-duration: 4s;
            animation-delay: 5s;
        }

        .burbuja:nth-child(8){
            width: 100;
            height: 100px;
            left: 52%;
            animation-duration: 5s;
            animation-delay: 5s;
        }

        .burbuja:nth-child(9){
            width: 65px;
            height: 65px;
            left: 51%;
            animation-duration: 3s;
            animation-delay: 2s;
        }

        .burbuja:nth-child(10){
            width: 40px;
            height: 40px;
            left: 35%;
            animation-duration: 3s;
            animation-delay: 4s;
        }


        @keyframes burbujas{
            0%{
                bottom: 0;
                opacity: 0;
            }
            30%{
                transform: translateX(30px);
            }
            50%{
                opacity: .4;
            }
            100%{
                bottom: 100vh;
                opacity: 0;
            }
        }

        @keyframes movimiento{
            0%{
                transform: translateY(0);
            }
            50%{
                transform: translateY(30px);
            }
            100%{
                transform: translateY(0);
            }
        }


        /* width */
        ::-webkit-scrollbar {
            width: 10px;
        }
        
        /* Track */
        ::-webkit-scrollbar-track {
            background: #231161; 
        }
        
        /* Handle */
        ::-webkit-scrollbar-thumb {
            background: #341e86; 
        }
        
        /* Handle on hover */
        ::-webkit-scrollbar-thumb:hover {
            background: #1d0e53; 
        }
    </style>

</head>
<body>
    <header class="bg_animate">
        <section class="banner contenedor">
            <div class="banner_img">
                <img src="/img/CP360_Logo_REV.png" alt="">
            </div>
            <section class="banner_title">
                <h2 id="msg"></h2>
            </section>
       
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