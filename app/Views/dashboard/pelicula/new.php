<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Pelicula</title>
</head>
<body>
    <?= view('partials/_session')?>
    <form action="/dashboard/pelicula/create" method="post">
    <?= view('dashboard/pelicula/_form',['op' =>'Crear'])?>
    </form>
</body>
</html>