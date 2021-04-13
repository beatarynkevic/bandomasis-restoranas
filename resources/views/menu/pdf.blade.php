<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <title>{{$menu->title}}</title>
        <style>
            @font-face {
            font-family: 'Roboto';
            font-style: normal;
            font-weight: 400;
            src: url({{ asset('fonts/Roboto-Regular.ttf') }});
            }
            @font-face {
            font-family: 'Roboto';
            font-style: normal;
            font-weight: bold;
            src: url({{ asset('fonts/Roboto-Bold.ttf') }});
            }
            body {
                font-family: 'Roboto';
            }
        </style>
    </head>
    <body>
        <h1>{{$menu->title}}</h1>
        <h2>Kaina: {{$menu->price}}</h2>
        <h2>Svoris: {{$menu->weight}}</h2>
        <h2>Mesos: {{$menu->meat}}</h2>
        <div>{!!$menu->about!!}</div>
    </body>
</html>