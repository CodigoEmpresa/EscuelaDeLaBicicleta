<!doctype html>
<html lang="s">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style type="text/css">
        *{margin:0;padding:0}
        .back {
            width: 100%;
            height: 100%;
            position:absolute;
            margin-top: -20px;
        }
        h4 {
            font-family: Verdana, Helvetica, "Gill Sans", sans-serif;
            font-weight: 300;
            position: absolute;
            top: 300px;
            width: 100%;
            text-align: center;
            z-index: 10;
            font-size: 30px;
        }
    </style>
</head>
<body>
    <img src="{{ asset('public/Img/diploma.jpg') }}" alt="" class="back">
    <h4>{{ $nombre }}</h4>
</body>
</html>