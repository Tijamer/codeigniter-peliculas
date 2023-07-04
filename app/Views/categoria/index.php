<DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Categorias</title>
</head>
</html>
<body>
    <h1>Listado de Categorias</h1>
    <a href="categoria/new">Create</a>
    <table>
        <tr>
            <th>
                id
            </th>
            <th>
                Titulos
            </th>
            <th>
                Opciones
            </th>
        </tr>
            <?php foreach($categoria as $key => $p) : ?>
                <tr>
                    <td><?=$p['id']?></td>
                    <td><?=$p['titulos']?></td>
                    <td>
                    <a href="/categoria/show/<?=$p['id']?>">Show</a>
                        <a href="/categoria/edit/<?=$p['id']?>">Edits</a>
                        <form action="/categoria/delete/<?=$p['id']?>" method="post">
                        <button type="submit">Delete </button>
                        </form>
                    </td>
                </tr>
            <?php endforeach?>
        </tr>
    </table>
</body>
</html>