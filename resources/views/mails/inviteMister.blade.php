<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0">
    <title>Invitación a DBASE</title>
</head>
<body>
<p>Hola! El presidente del club {{$club->name}}</p>
<p>le ha invitado como entrenador del {{$team}}</p>
<p>Visite este enlace para acceder al registro <br><a href="{{$url.'/register/misterRegister/'.$team.'/'}}">http://dBase.com/registro</a></p>
</body>
</html>