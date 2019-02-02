<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0">
    <title>Solicitud registro</title>
</head>
<body>
<h3>Solicitud de registro en la aplicación desde la ip --> {{$request->ip()}}</h3>
<div>
    <h2>Nombre del club:</h2> <b>{{$request->input('club-name')}}</b>
</div>
<h2>Telefono: </h2><b>{{$request->input('club-telephone')}}</b>
<h2>País: </h2><b>{{$request->input('club-country')}}</b>
<h2>Comunidad: </h2><b>{{$request->input('club-state')}}</b>
<h2>Provincia: </h2><b>{{$request->input('club-province')}}</b>
<h2>Dirección: </h2><b>{{$request->input('club-address')}}</b>
<h2>Email: </h2><b>{{$request->input('club-email')}}</b>
</body>
</html>