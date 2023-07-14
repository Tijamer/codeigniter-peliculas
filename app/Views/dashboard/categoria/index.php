<?= $this->extend('Layouts/dashboard')?>

<?= $this->section('contenido')?>
<?= view('partials/_session')?>
<a href="/dashboard/categoria/new" class="btn btn-success btn-lg mb-4">Create</a>
    <table class="table">
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
                    <a href="/dashboard/categoria/show/<?=$p->id?>" class="btn btn-secondary btn-sm mt-1">Show</a>
                        <a href="/dashboard/categoria/edit/<?=$p->id?>" class="btn btn-primary btn-sm mt-1">Edits</a>
                        <form action="/dashboard/categoria/delete/<?=$p->id?>" method="post">
                        <button type="submit" class="btn btn-danger btn-sm mt-1">Delete </button>
                        </form>
                    </td>
                </tr>
            <?php endforeach?>
        </tr>
    </table>
    <?= $pager->links()?>
<?= $this->endSection()?>
