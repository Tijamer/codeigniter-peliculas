<DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Peliculas</title>
</head>
</html>
<body>
    <?= view('partials/_session')?>
    <h1>Listado de Peliculas</h1>
    <a href="/dashboard/pelicula/new">Create</a>
    <table>
        <tr>
            <th>
                id
            </th>
            <th>
                Titulo
            </th>
            <th>
                Descripcion
            </th>
            <th>
                Opciones
            </th>
        </tr>
            <?php foreach($pelicula as $key => $p) : ?>
                <tr>
                    <td><?=$p['id']?></td>
                    <td><?=$p['titulo']?></td>
                    <td><?=$p['descripcion']?></td>
                    <td>
                    <a href="/dashboard/pelicula/show/<?=$p['id']?>">Show</a>
                        <a href="/dashboard/pelicula/edit/<?=$p['id']?>">Edits</a>
                        <form action="/dashboard/pelicula/delete/<?=$p['id']?>" method="post">
                        <button type="submit">Delete </button>
                        </form>
                    </td>
                </tr>
            <?php endforeach?>
        </tr>
    </table>
</body>
</html>