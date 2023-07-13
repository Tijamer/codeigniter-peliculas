<?= $this->extend('Layouts/dashboard')?>

<?= $this->section('contenido')?>

<a href="/dashboard/categoria/new">Create</a>
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
                    <td><?=$p->id?></td>
                    <td><?=$p->titulos?></td>
                    <td>
                    <a href="/dashboard/categoria/show/<?=$p->id?>">Show</a>
                        <a href="/dashboard/categoria/edit/<?=$p->id?>">Edits</a>
                        <form action="/dashboard/categoria/delete/<?=$p->id?>" method="post">
                        <button type="submit">Delete </button>
                        </form>
                    </td>
                </tr>
            <?php endforeach?>
        </tr>
    </table>
    <?= $pager->links()?>
<?= $this->endSection()?>
