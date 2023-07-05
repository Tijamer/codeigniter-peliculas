<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actualizar Categoria</title>
</head>
<body>
    <form action="/dashboard/categoria/update/<?=$categoria['id']?>" method="post">
        <?= view('/dashboard/categoria/_form',['op' =>'Actualizar'])?>
    </form>
</body>
</html>